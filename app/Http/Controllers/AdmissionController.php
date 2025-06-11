<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Application;
use App\Models\Course;
use App\Models\ParentGuardian;
use App\Models\School;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Events\ApplicationCreated;
use App\Models\User;
use App\Events\AdmissionUpdateEvent;
use Illuminate\Support\Facades\Response;


class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $student_id = $request->session()->get('student_id');
        $student = Student::find($student_id);
        return view('admission', compact('courses', 'student_id', 'student'));
    }
    
    public function store(Request $request)
    {
        try {
            
             // Get the authenticated user
            $user = Auth::user();

            // Validate student data
            $validatedStudentData = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'suffix' => 'nullable|string|max:255',
                'age' => 'required|integer|min:0|max:99',
                'sex' => 'required|string|max:10',
                'contact_number' => 'required|string|max:255',
                'religion' => 'required|string|max:255',
                'sports' => 'nullable|string|max:255',
                'residency_status' => 'required|string|max:255',
                'district' => 'nullable|string|max:255',
                'barangay' => 'nullable|string|max:255',
                'non_pasig_resident' => 'nullable|string|max:255',
                'address' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'talents' => 'nullable|string|max:255',
                'strand' => 'required|string|max:255',
                'salary' => 'required|string|max:255',
            ]);

            // Add user_id to the validated data
            $validatedStudentData['user_id'] = $user->id;

            // Create student
            $student = Student::create($validatedStudentData);

            // Validate and create school data
            $validatedSchoolData = $request->validate([
                'school_type' => 'required|string|max:255',
                'public_school' => 'nullable|string|max:255',
                'other_school' => 'nullable|string|max:255',
                'private_school' => 'nullable|string|max:255',
            ]);
            $student->schools()->create($validatedSchoolData);

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

            // Update step to 2
            $student->update(['step' => 2]);

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
        $student = Student::find($student_id);
        $courses = Course::all();
        return view('admissionform2', compact('student_id', 'courses', 'student'));
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

        // Update step to 3
        $student = Student::find($student_id);
        $student->update(['step' => 3]);

        Log::info('Application Created:', ['application' => $application]);

        return redirect()->route('admission.index')->with('status', 'Application submitted successfully! Please wait for your Email if you will proceed.');
    }

    public function triggerAdmissionUpdate(Request $request)
    {
        $message = $request->input('message');
        event(new AdmissionUpdateEvent($message));
        
        return response()->json(['status' => 'Admission update event triggered successfully']);
    }
    
    // RUD operations for Application Forms

    public function applicationFormsIndex(Request $request)
    {
        $year = session('year', date('Y'));
        $search = $request->input('search');

        $applications = Application::with('student')
            ->whereYear('created_at', $year)
            ->when($search, function ($query, $search) {
                return $query->whereHas('student', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                });
            })
            ->paginate(15);

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

    public function applicationFormsExport(Request $request)
    {
        $fields = $request->input('fields', []);
        $status = $request->input('status');

        $query = Application::with([
            'student.schools',
            'student.parentsGuardians',
            'firstChoice',
            'secondChoice',
            'thirdChoice'
        ]);

        if ($status) {
            $query->where('status', $status);
        }

        $applications = $query->get();

        // Prepare CSV headers
        $csvHeaders = [];
        foreach ($fields as $field) {
            $csvHeaders[] = ucfirst(str_replace(['student.', 'application.', 'school.', 'parent.'], '', $field));
        }

        // Prepare CSV rows
        $rows = [];
        foreach ($applications as $application) {
            $row = [];
            foreach ($fields as $field) {
                if (str_starts_with($field, 'student.')) {
                    $row[] = data_get($application->student, substr($field, 8), '');
                } elseif (str_starts_with($field, 'application.')) {
                    $appField = substr($field, 12);
                    if (in_array($appField, ['first_choice', 'second_choice', 'third_choice'])) {
                        $choiceRelation = [
                            'first_choice' => 'firstChoice',
                            'second_choice' => 'secondChoice',
                            'third_choice' => 'thirdChoice'
                        ];
                        // Defensive: check if relation exists and has a name
                        $course = $application->{$choiceRelation[$appField]} ?? null;
                        $row[] = $course && isset($course->name) ? $course->name : ($application->$appField ?? '');
                    } else {
                        $row[] = data_get($application, $appField, '');
                    }
                } elseif (str_starts_with($field, 'school.')) {
                    $row[] = optional($application->student->schools->first())[substr($field, 7)] ?? '';
                } elseif (str_starts_with($field, 'parent.')) {
                    $row[] = optional($application->student->parentsGuardians->first())[substr($field, 7)] ?? '';
                }
            }
            $rows[] = $row;
        }

        // Generate CSV
        $callback = function() use ($csvHeaders, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeaders);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        $filename = 'application_forms_export_' . now()->format('Ymd_His') . '.csv';

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}