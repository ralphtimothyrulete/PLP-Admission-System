<?php

namespace App\Http\Controllers;

use App\Models\EnrollmentSlot;
use Illuminate\Http\Request;

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
            'school_year' => 'required|string',
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
}