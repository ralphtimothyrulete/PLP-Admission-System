<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Student;

class GwaRankingController extends Controller
{

    public function index(Request $request)
    {
        $year = session('year', date('Y'));
        $program = $request->input('program');
        $search = $request->input('search');

        // Retrieve distinct programs (strands) from the students table
        $programs = Student::distinct()->pluck('strand');

        $applicationsQuery = Application::with('student')
            ->whereYear('created_at', $year)
            ->when($program, function ($query, $program) {
                return $query->whereHas('student', function ($q) use ($program) {
                    $q->where('strand', $program);
                });
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('student', function ($q2) use ($search) {
                        $q2->where('first_name', 'like', "%$search%")
                           ->orWhere('last_name', 'like', "%$search%");
                    })
                    ->orWhere('overall_grade', 'like', "%$search%");
                });
            })
            ->orderBy('overall_grade', 'desc');

        $applications = $applicationsQuery->paginate(15);

        // Calculate rank for each application
        $rankedApplications = $applications->getCollection()->map(function ($application, $index) use ($applications) {
            $application->rank = $index + 1 + (($applications->currentPage() - 1) * $applications->perPage());
            return $application;
        });

        $applications->setCollection($rankedApplications);

        return view('admin.gwa-ranking.index', compact('applications', 'program', 'programs'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.gwa-ranking.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'science_grade' => 'required|integer|min:0|max:99',
            'mathematics_grade' => 'required|integer|min:0|max:99',
            'english_grade' => 'required|integer|min:0|max:99',
            'overall_grade' => 'required|integer|min:0|max:99',
        ]);

        // Fetch the original application for this student
    $originalApplication = \App\Models\Application::where('student_id', $validatedData['student_id'])->first();

    if (!$originalApplication) {
        return back()->withErrors(['student_id' => 'No application form found for this student.']);
    }

    // Copy required fields from the original application
    $validatedData['first_choice'] = $originalApplication->first_choice;
    $validatedData['second_choice'] = $originalApplication->second_choice;
    $validatedData['third_choice'] = $originalApplication->third_choice;
    $validatedData['status'] = $originalApplication->status ?? 'Pending';

    \App\Models\Application::create($validatedData);

    return redirect()->route('gwa-ranking.index')->with('status', 'GWA Ranking created successfully!');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('gwa-ranking.index')->with('status', 'GWA Ranking deleted successfully!');
    }
}