<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntranceExamResult;

class EntranceExamResultController extends Controller
{
    public function index(Request $request)
    {
        $year = session('year', date('Y'));
        $search = $request->input('search');

        $results = EntranceExamResult::whereYear('created_at', $year)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('result', 'like', "%{$search}%");
            })
            ->paginate(15);

        return view('admin.entrance-exam-results.index', compact('results', 'search'));
    }

    public function create()
    {
        return view('admin.entrance-exam-results.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'result' => 'required|string|max:255',
        ]);

        EntranceExamResult::create($request->all());

        return redirect()->route('entrance-exam-results.index')->with('status', 'Result created successfully!');
    }

    public function destroy($id)
    {
        $result = EntranceExamResult::findOrFail($id);
        $result->delete();

        return redirect()->route('entrance-exam-results.index')->with('status', 'Result deleted successfully!');
    }
}