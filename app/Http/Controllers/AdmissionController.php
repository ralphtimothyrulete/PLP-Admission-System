<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use App\Models\Course;
use App\Models\ParentGuardian;
use App\Models\School;
use Illuminate\Support\Facades\Log;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        return view('admission', compact('courses'));
    }
    
    public function store(Request $request)
    {
        try {
            $student = Student::create($request->only([
                'last_name', 'first_name', 'middle_name', 'suffix', 'age', 'sex', 
                'contact_number', 'religion', 'sports', 'residency_status', 
                'district', 'barangay', 'non_pasig_resident', 'address', 'email', 
                'talents', 'strand', 'salary'
            ]));
        
            $student->schools()->create($request->only([
                'school_type', 'public_school', 'other_school', 'private_school'
            ]));

            $parentGuardianData = $request->input('parent_guardian');
            if ($parentGuardianData) {
                $parentGuardianData['student_id'] = $student->id;
                if ($parentGuardianData['type'] === 'parent') {
                    $request->validate([
                        'parent_guardian.parent_last_name' => 'required|string|max:255',
                        'parent_guardian.parent_first_name' => 'required|string|max:255',
                        'parent_guardian.parent_middle_name' => 'nullable|string|max:255',
                        'parent_guardian.parent_suffix' => 'nullable|string|max:255',
                        'parent_guardian.parent_age' => 'required|integer|min:0|max:99',
                        'parent_guardian.parent_contact_number' => 'required|string|max:255',
                        'parent_guardian.parent_email' => 'required|email|max:255',
                        'parent_guardian.parent_address' => 'required|string|max:255',
                    ]);
                    ParentGuardian::create([
                        'student_id' => $parentGuardianData['student_id'],
                        'type' => $parentGuardianData['type'],
                        'last_name' => $parentGuardianData['parent_last_name'],
                        'first_name' => $parentGuardianData['parent_first_name'],
                        'middle_name' => $parentGuardianData['parent_middle_name'],
                        'suffix' => $parentGuardianData['parent_suffix'],
                        'age' => $parentGuardianData['parent_age'],
                        'contact_number' => $parentGuardianData['parent_contact_number'],
                        'email' => $parentGuardianData['parent_email'],
                        'address' => $parentGuardianData['parent_address'],
                    ]);
                } elseif ($parentGuardianData['type'] === 'guardian') {
                    $request->validate([
                        'parent_guardian.guardian_last_name' => 'required|string|max:255',
                        'parent_guardian.guardian_first_name' => 'required|string|max:255',
                        'parent_guardian.guardian_middle_name' => 'nullable|string|max:255',
                        'parent_guardian.guardian_suffix' => 'nullable|string|max:255',
                        'parent_guardian.guardian_age' => 'required|integer|min:0|max:99',
                        'parent_guardian.guardian_contact_number' => 'required|string|max:255',
                        'parent_guardian.guardian_email' => 'required|email|max:255',
                        'parent_guardian.guardian_address' => 'required|string|max:255',
                    ]);
                    ParentGuardian::create([
                        'student_id' => $parentGuardianData['student_id'],
                        'type' => $parentGuardianData['type'],
                        'last_name' => $parentGuardianData['guardian_last_name'],
                        'first_name' => $parentGuardianData['guardian_first_name'],
                        'middle_name' => $parentGuardianData['guardian_middle_name'],
                        'suffix' => $parentGuardianData['guardian_suffix'],
                        'age' => $parentGuardianData['guardian_age'],
                        'contact_number' => $parentGuardianData['guardian_contact_number'],
                        'email' => $parentGuardianData['guardian_email'],
                        'address' => $parentGuardianData['guardian_address'],
                    ]);
                }
            }
            // Store student_id in the session
            $request->session()->put('student_id', $student->id);

            return redirect()->route('admissionform2.index');
        } catch (\Exception $e) {
            Log::error('Error storing admission data: ' . $e->getMessage());
            return redirect()->route('admission.index')->withErrors(['error' => 'There was an error processing your request. Please try again.']);
        }
    }

    public function form2(Request $request)
    {
        $student_id = $request->session()->get('student_id');
        if (!$student_id) {
            return redirect()->route('admission.index')->withErrors(['error' => 'Student ID not found in session.']);
        }
        $courses = Course::all();
        return view('admissionform2', compact('student_id', 'courses'));
    }

    public function submitApplication(Request $request)
    {
        Log::info('SubmitApplication - Request Data:', $request->all());

        $student_id = $request->session()->get('student_id');
        
        if (!$student_id) {
            return redirect()->route('admission.index')->withErrors(['error' => 'Student ID not found in session.']);
        }
        
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'science_grade' => 'required|integer|min:0|max:99',
            'mathematics_grade' => 'required|integer|min:0|max:99',
            'english_grade' => 'required|integer|min:0|max:99',
            'overall_grade' => 'required|integer|min:0|max:99',
            'first_choice' => 'required|string',
            'second_choice' => 'required|string',
            'third_choice' => 'nullable|string',
        ]);
        
        $validatedData['student_id'] = $student_id;
        $validatedData['status'] = 'Done'; 

        // Create and store the application
        $application = Application::create($validatedData);

        Log::info('Application Created:', ['application' => $application]);

        return redirect()->route('admission.index')->with('status', 'Application submitted successfully! Please wait for your Email if you will proceed.');
    }
    
    // RUD operations for Application Forms

    public function applicationFormsIndex(Request $request)
    {
        $search = $request->input('search');
        $applications = Application::with('student')
            ->when($search, function ($query, $search) {
                return $query->whereHas('student', function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
        ->paginate(15); // Adjust number of items per page if needed

    return view('application-forms.index', compact('applications', 'search'));
    }

    public function applicationFormsShow($id)
    {
        $application = Application::with('student')->findOrFail($id);
        return view('application-forms.show', compact('application'));
    }

    public function applicationFormsEdit($id)
    {
        $application = Application::findOrFail($id);
        $students = Student::all();
        return view('application-forms.edit', compact('application', 'students'));
    }

    public function applicationFormsUpdate(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        // Update student details
        $student = Student::findOrFail($request->student_id);
        $student->update($request->input('student'));

        // Update school details
        foreach ($request->input('schools') as $schoolId => $schoolData) {
            $school = School::findOrFail($schoolId);
            $school->update($schoolData);
        }

        // Update parent/guardian details
        foreach ($request->input('parents_guardians') as $parentGuardianId => $parentGuardianData) {
            $parentGuardian = ParentGuardian::findOrFail($parentGuardianId);
            $parentGuardian->update($parentGuardianData);
        }

        // Update application details
        $application->update($request->input('application'));

        return redirect()->route('application-forms.index')->with('status', 'Application updated successfully!');
    }

    public function applicationFormsDestroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('application-forms.index')->with('status', 'Application deleted successfully!');
    }
}