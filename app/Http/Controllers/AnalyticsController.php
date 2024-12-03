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
        // Gather data for key metrics
        $totalApplications = Application::count();
        $pasiguenosCount = Student::where('residency_status', 'Pasig Resident')->count();
        $nonPasiguenosCount = Student::where('residency_status', 'Non-Pasig Resident')->count();
        $averageGrades = Application::select(
            DB::raw('avg(science_grade) as avg_science'),
            DB::raw('avg(mathematics_grade) as avg_math'),
            DB::raw('avg(english_grade) as avg_english'),
            DB::raw('avg(overall_grade) as avg_overall')
        )->first();
        $incomeDistribution = Student::select('salary', DB::raw('count(*) as total'))
            ->groupBy('salary')
            ->get();
        $strandDistribution = Student::select('strand', DB::raw('count(*) as total'))
            ->groupBy('strand')
            ->get();
        $choiceFrequency = DB::table('applications')
            ->select('first_choice as choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->union(
                DB::table('applications')
                    ->select('second_choice as choice', DB::raw('count(*) as total'))
                    ->groupBy('second_choice')
            )
            ->union(
                DB::table('applications')
                    ->select('third_choice as choice', DB::raw('count(*) as total'))
                    ->groupBy('third_choice')
            )
            ->get();
        
        $maleCount = Student::where('sex', 'Male')->count();
        $femaleCount = Student::where('sex', 'Female')->count();

        $firstChoicePrograms = Application::select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->get();

        // Religion Distribution
        $religionDistribution = Student::select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->get();

        // School Type Distribution
        $schoolTypeDistribution = DB::table('schools')
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();

        // Sports Participation
        $sportsParticipation = Student::select('sports', DB::raw('count(*) as total'))
            ->groupBy('sports')
            ->get();

        // Residency by Barangay/District
        $residencyByBarangay = Student::select('barangay', DB::raw('count(*) as total'))
            ->groupBy('barangay')
            ->get();

        // Talents Distribution
        $talentsDistribution = Student::select('talents', DB::raw('count(*) as total'))
            ->groupBy('talents')
            ->get();

        // School Type with Program Choices
        $schoolTypeWithPrograms = DB::table('schools')
            ->join('applications', 'schools.student_id', '=', 'applications.student_id')
            ->select('schools.school_type', 'applications.first_choice', DB::raw('count(*) as total'))
            ->groupBy('schools.school_type', 'applications.first_choice')
            ->get();

        // Applicants by School Type
        $applicantsBySchoolType = DB::table('schools')
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();
    
        return view('admin.analytics', compact(
            'totalApplications', 'pasiguenosCount', 'nonPasiguenosCount', 'averageGrades', 'incomeDistribution', 'strandDistribution', 'choiceFrequency', 'maleCount', 'femaleCount', 'firstChoicePrograms', 'religionDistribution', 'schoolTypeDistribution', 'sportsParticipation', 'residencyByBarangay', 'talentsDistribution', 'schoolTypeWithPrograms', 'applicantsBySchoolType'
        ));
    }

    public function getData()
    {
        // Gender Data
        $maleCount = Student::where('sex', 'Male')->count();
        $femaleCount = Student::where('sex', 'Female')->count();
    
        // Residency Data
        $pasiguenosCount = Student::where('residency_status', 'Pasig Resident')->count();
        $nonPasiguenosCount = Student::where('residency_status', 'Non-Pasig Resident')->count();
    
        // Program Trends
        $programTrends = Application::select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->get();
    
        // Admission Trends
        $admissionTrends = Application::select('first_choice', DB::raw('count(*) as total'))
            ->groupBy('first_choice')
            ->orderBy('total', 'desc')
            ->get();
    
        // Grade Performance Trends
        $averageGrades = Application::select(
            DB::raw('avg(science_grade) as avg_science'),
            DB::raw('avg(mathematics_grade) as avg_math'),
            DB::raw('avg(english_grade) as avg_english'),
            DB::raw('avg(overall_grade) as avg_overall')
        )->first();
    
        // Family and Financial Information
        $incomeDistribution = Student::select('salary', DB::raw('count(*) as total'))
            ->groupBy('salary')
            ->get();
    
        // Program-Specific Trends
        $strandDistribution = Student::select('strand', DB::raw('count(*) as total'))
            ->groupBy('strand')
            ->get();
    
        // Application Choices
        $choiceFrequency = DB::table('applications')
            ->select('choice', DB::raw('SUM(total) as total'))
            ->fromSub(function ($query) {
                $query->select('first_choice as choice', DB::raw('count(*) as total'))
                    ->from('applications')
                    ->groupBy('first_choice')
                    ->unionAll(
                        DB::table('applications')
                            ->select('second_choice as choice', DB::raw('count(*) as total'))
                            ->groupBy('second_choice')
                    )
                    ->unionAll(
                        DB::table('applications')
                            ->select('third_choice as choice', DB::raw('count(*) as total'))
                            ->groupBy('third_choice')
                    );
            }, 'choices')
            ->groupBy('choice')
            ->get();

        // Religion Distribution
        $religionDistribution = Student::select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->get();

        // School Type Distribution
        $schoolTypeDistribution = DB::table('schools')
            ->select(DB::raw('count(*) as total'), 'school_type')
            ->groupBy('school_type')
            ->get();

        // Sports Participation
        $sportsParticipation = Student::select('sports', DB::raw('count(*) as total'))
            ->groupBy('sports')
            ->get();

        // Residency by Barangay/District
        $residencyByBarangay = Student::select('barangay', DB::raw('count(*) as total'))
            ->groupBy('barangay')
            ->get();

        // Talents Distribution
        $talentsDistribution = Student::select('talents', DB::raw('count(*) as total'))
            ->groupBy('talents')
            ->get();

        // School Type with Program Choices
        $schoolTypeWithPrograms = DB::table('schools')
            ->join('applications', 'schools.student_id', '=', 'applications.student_id')
            ->select('schools.school_type', 'applications.first_choice', DB::raw('count(*) as total'))
            ->groupBy('schools.school_type', 'applications.first_choice')
            ->get();

        // Applicants by School Type
        $applicantsBySchoolType = DB::table('schools')
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