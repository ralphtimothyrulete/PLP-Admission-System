<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function submitApplication(Request $request)
    {
        $validCourses = [
            'Bachelor in Elementary Education', 
            'Bachelor in Secondary Education Major in English',
            'Bachelor in Secondary Education Major in Filipino',
            'Bachelor in Secondary Education Major in Mathematics',
            'Bachelor of Science in Accountancy',
            'Bachelor of Science in Business Administrations Major in Marketing Management',
            'Bachelor of Science in Entrepreneurship',
            'Bachelor of Science in Hospitality Management',
            'Bachelor of Arts in Psychology',
            'Bachelor of Science in Computer Science',
            'Bachelor of Science in Information Technology',
            'Bachelor of Science in Electronics Engineering',
            'Bachelor of Science in Nursing'
        ];
    
        // Validate the submitted data
        $validatedData = $request->validate([
            'science' => 'required|numeric|min:0|max:99',
            'mathematics' => 'required|numeric|min:0|max:99',
            'english' => 'required|numeric|min:0|max:99',
            'overall_grade' => 'required|numeric|min:0|max:99',
            'first_choice' => ['required', 'string', 'in:' . implode(',', $validCourses)],
            'second_choice' => ['required', 'string', 'in:' . implode(',', $validCourses), 'different:first_choice'],
            'third_choice' => ['required', 'string', 'in:' . implode(',', $validCourses), 'different:first_choice,second_choice'],
        ]);
    
        // Redirect to a success page or homepage
        return redirect()->route('home')->with('success', 'Application submitted successfully!');
    }
}
