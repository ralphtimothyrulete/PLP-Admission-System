<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function applicationForms()
    {
        return view('admin.application-forms');
    }

    public function dashboard()
    {
        $year = session('year', date('Y'));

        $maleCount = Student::whereYear('created_at', $year)->where('sex', 'Male')->count();
        $femaleCount = Student::whereYear('created_at', $year)->where('sex', 'Female')->count();
        $pasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Pasig Resident')->count();
        $nonPasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Non-Pasig Resident')->count();

        return view('admin.dashboard', compact('maleCount', 'femaleCount', 'pasiguenosCount', 'nonPasiguenosCount'));
    }

    public function setSchoolYear(Request $request)
    {
        $request->validate(['year' => 'required|integer']);
        session(['year' => $request->year]);
        return redirect()->back()->with('status', 'Year updated successfully!');
    }
}