<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntranceExamResult;
use Illuminate\Support\Facades\Validator;

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

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $requiredHeaders = ['student_id', 'name', 'result'];
        if ($header === false || array_diff($requiredHeaders, $header)) {
            fclose($handle);
            return redirect()->back()->withErrors(['csv_file' => 'Invalid CSV format. Required columns: student_id, name, result.']);
        }

        $rowNumber = 1;
        $errors = [];
        $created = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            $data = array_combine($header, $row);

            $validator = Validator::make($data, [
                'student_id' => 'required|exists:students,id',
                'name' => 'required|string|max:255',
                'result' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[] = "Row $rowNumber: " . implode(', ', $validator->errors()->all());
                continue;
            }

            \App\Models\EntranceExamResult::create($data);
            $created++;
        }
        fclose($handle);

        if (!empty($errors)) {
            return redirect()->route('entrance-exam-results.index')
                ->withErrors(['csv_file' => implode(' ', $errors)]);
        }

        return redirect()->route('entrance-exam-results.index')->with('status', 'CSV uploaded successfully!');
    }
}