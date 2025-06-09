<?php

namespace App\Http\Controllers;

use App\Models\EnrollmentSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollmentSlotController extends Controller
{
    public function index(Request $request)
    {
        $year = session('year', date('Y'));
        $search = $request->input('search');

        $slots = EnrollmentSlot::whereYear('created_at', $year)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('slot_status', 'like', "%{$search}%");
            })
            ->paginate(15);

        return view('admin.enrollment-slot.index', compact('slots', 'search'));
    }

    public function create()
    {
        return view('admin.enrollment-slot.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'slot_status' => 'required|string|max:255',
        ]);

        EnrollmentSlot::create($request->all());

        return redirect()->route('enrollment-slot.index')->with('status', 'Enrollment slot created successfully!');
    }

    public function destroy($id)
    {
        $slot = EnrollmentSlot::findOrFail($id);
        $slot->delete();

        return redirect()->route('enrollment-slot.index')->with('status', 'Enrollment slot deleted successfully!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $requiredHeaders = ['student_id', 'name', 'slot_status'];
        if ($header === false || array_diff($requiredHeaders, $header)) {
            fclose($handle);
            return redirect()->back()->withErrors(['csv_file' => 'Invalid CSV format. Required columns: student_id, name, slot_status.']);
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
                'slot_status' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $errors[] = "Row $rowNumber: " . implode(', ', $validator->errors()->all());
                continue;
            }

            \App\Models\EnrollmentSlot::create($data);
            $created++;
        }
        fclose($handle);

        if (!empty($errors)) {
            return redirect()->route('enrollment-slot.index')
                ->withErrors(['csv_file' => implode(' ', $errors)]);
        }

        return redirect()->route('enrollment-slot.index')->with('status', 'CSV uploaded successfully!');
    }
}