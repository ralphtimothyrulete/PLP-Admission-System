<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $year = session('year', date('Y'));

        $totalApplications = Application::whereYear('created_at', $year)->count();
        $pasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Pasig Resident')->count();
        $nonPasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Non-Pasig Resident')->count();
        $averageGrades = Application::whereYear('created_at', $year)
            ->select(
                DB::raw('avg(science_grade) as avg_science'),
                DB::raw('avg(mathematics_grade) as avg_math'),
                DB::raw('avg(english_grade) as avg_english'),
                DB::raw('avg(overall_grade) as avg_overall')
            )->first();

        $incomeDistribution = Student::whereYear('created_at', $year)
            ->select('salary', DB::raw('count(*) as total'))
            ->groupBy('salary')
            ->get();

        $strandDistribution = Student::whereYear('created_at', $year)
            ->select('strand', DB::raw('count(*) as total'))
            ->groupBy('strand')
            ->get();

        $choiceFrequency = DB::table('applications')
            ->select('choice', DB::raw('SUM(total) as total'))
            ->fromSub(function ($query) use ($year) {
                $query->select('first_choice as choice', DB::raw('count(*) as total'))
                    ->from('applications')
                    ->whereYear('created_at', $year)
                    ->groupBy('first_choice')
                    ->unionAll(
                        DB::table('applications')
                            ->select('second_choice as choice', DB::raw('count(*) as total'))
                            ->whereYear('created_at', $year)
                            ->groupBy('second_choice')
                    )
                    ->unionAll(
                        DB::table('applications')
                            ->select('third_choice as choice', DB::raw('count(*) as total'))
                            ->whereYear('created_at', $year)
                            ->groupBy('third_choice')
                    );
            }, 'choices')
            ->groupBy('choice')
            ->get();

        $maleCount = Student::whereYear('created_at', $year)->where('sex', 'Male')->count();
        $femaleCount = Student::whereYear('created_at', $year)->where('sex', 'Female')->count();

        $firstChoicePrograms = Application::whereYear('created_at', $year)
            ->select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->get();

        $religionDistribution = Student::whereYear('created_at', $year)
            ->select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->get();

        $schoolTypeDistribution = DB::table('schools')
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();

        $sportsParticipation = Student::whereYear('created_at', $year)
            ->select('sports', DB::raw('count(*) as total'))
            ->groupBy('sports')
            ->get();

        $residencyByBarangay = Student::whereYear('created_at', $year)
            ->select('barangay', DB::raw('count(*) as total'))
            ->groupBy('barangay')
            ->get();

        $talentsDistribution = Student::whereYear('created_at', $year)
            ->select('talents', DB::raw('count(*) as total'))
            ->groupBy('talents')
            ->get();

        $schoolTypeWithPrograms = DB::table('schools')
            ->join('applications', 'schools.student_id', '=', 'applications.student_id')
            ->whereYear('applications.created_at', $year)
            ->select('schools.school_type', 'applications.first_choice', DB::raw('count(*) as total'))
            ->groupBy('schools.school_type', 'applications.first_choice')
            ->get();

        $applicantsBySchoolType = DB::table('schools')
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();

        return view('admin.analytics', compact(
            'totalApplications', 'pasiguenosCount', 'nonPasiguenosCount', 'averageGrades', 'incomeDistribution', 'strandDistribution', 'choiceFrequency', 'maleCount', 'femaleCount', 'firstChoicePrograms', 'religionDistribution', 'schoolTypeDistribution', 'sportsParticipation', 'residencyByBarangay', 'talentsDistribution', 'schoolTypeWithPrograms', 'applicantsBySchoolType'
        ));
    }
    

    

    public function getData(Request $request)
    {
        $year = $request->query('year', date('Y'));
    
        // Gender Data
        $maleCount = Student::whereYear('created_at', $year)->where('sex', 'Male')->count();
        $femaleCount = Student::whereYear('created_at', $year)->where('sex', 'Female')->count();
    
        // Residency Data
        $pasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Pasig Resident')->count();
        $nonPasiguenosCount = Student::whereYear('created_at', $year)->where('residency_status', 'Non-Pasig Resident')->count();
    
        // Program Trends
        $programTrends = Application::whereYear('created_at', $year)
            ->select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->get();
    
        // Admission Trends
        $admissionTrends = Application::whereYear('created_at', $year)
            ->select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->orderBy('total', 'desc')
            ->get();
    
        // Grade Performance Trends
        $averageGrades = Application::whereYear('created_at', $year)
            ->select(
                DB::raw('avg(science_grade) as avg_science'),
                DB::raw('avg(mathematics_grade) as avg_math'),
                DB::raw('avg(english_grade) as avg_english'),
                DB::raw('avg(overall_grade) as avg_overall')
            )->first();
    
        // Family and Financial Information
        $incomeDistribution = Student::whereYear('created_at', $year)
            ->select('salary', DB::raw('count(*) as total'))
            ->groupBy('salary')
            ->get();
    
        // Program-Specific Trends
        $strandDistribution = Student::whereYear('created_at', $year)
            ->select('strand', DB::raw('count(*) as total'))
            ->groupBy('strand')
            ->get();
    
        // Application Choices
        $choiceFrequency = DB::table('applications')
            ->select('choice', DB::raw('SUM(total) as total'))
            ->fromSub(function ($query) use ($year) {
                $query->select('first_choice as choice', DB::raw('count(*) as total'))
                    ->from('applications')
                    ->whereYear('created_at', $year)
                    ->groupBy('first_choice')
                    ->unionAll(
                        DB::table('applications')
                            ->select('second_choice as choice', DB::raw('count(*) as total'))
                            ->whereYear('created_at', $year)
                            ->groupBy('second_choice')
                    )
                    ->unionAll(
                        DB::table('applications')
                            ->select('third_choice as choice', DB::raw('count(*) as total'))
                            ->whereYear('created_at', $year)
                            ->groupBy('third_choice')
                    );
            }, 'choices')
            ->groupBy('choice')
            ->get();
    
        // Religion Distribution
        $religionDistribution = Student::whereYear('created_at', $year)
            ->select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->get();
    
        // School Type Distribution
        $schoolTypeDistribution = DB::table('schools')
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();
    
        // Sports Participation
        $sportsParticipation = Student::whereYear('created_at', $year)
            ->select('sports', DB::raw('count(*) as total'))
            ->groupBy('sports')
            ->get();
    
        // Residency by Barangay/District
        $residencyByBarangay = Student::whereYear('created_at', $year)
            ->select('barangay', DB::raw('count(*) as total'))
            ->groupBy('barangay')
            ->get();
    
        // Talents Distribution
        $talentsDistribution = Student::whereYear('created_at', $year)
            ->select('talents', DB::raw('count(*) as total'))
            ->groupBy('talents')
            ->get();
    
        // School Type with Program Choices
        $schoolTypeWithPrograms = DB::table('schools')
            ->join('applications', 'schools.student_id', '=', 'applications.student_id')
            ->whereYear('applications.created_at', $year)
            ->select('schools.school_type', 'applications.first_choice', DB::raw('count(*) as total'))
            ->groupBy('schools.school_type', 'applications.first_choice')
            ->get();
    
        // Applicants by School Type
        $applicantsBySchoolType = DB::table('schools')
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();
    
        return response()->json([
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'pasiguenosCount' => $pasiguenosCount,
            'nonPasiguenosCount' => $nonPasiguenosCount,
            'programTrends' => $programTrends,
            'admissionTrends' => $admissionTrends,
            'averageGrades' => $averageGrades,
            'incomeDistribution' => $incomeDistribution,
            'strandDistribution' => $strandDistribution,
            'choiceFrequency' => $choiceFrequency,
            'religionDistribution' => $religionDistribution,
            'schoolTypeDistribution' => $schoolTypeDistribution,
            'sportsParticipation' => $sportsParticipation,
            'residencyByBarangay' => $residencyByBarangay,
            'talentsDistribution' => $talentsDistribution,
            'schoolTypeWithPrograms' => $schoolTypeWithPrograms,
            'applicantsBySchoolType' => $applicantsBySchoolType,
        ]);
    }
}