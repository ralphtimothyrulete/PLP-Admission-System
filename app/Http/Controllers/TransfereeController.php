<?php
// app/Http/Controllers/TransfereeController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class TransfereeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->student) {
            return view('admission-req', ['error' => 'Please complete the Admission Forms first']);
        }
        $student_id = Auth::user()->student->id;
        $student = Student::find($student_id);
        $uploadedFiles = Image::where('student_id', $student_id)->get();
        return view('transferee-reqs', compact('uploadedFiles', 'student_id', 'student'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'transferee_files' => 'required',
            'transferee_files.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'student_id' => 'required|exists:students,id',
        ]);

        if ($request->hasfile('transferee_files')) {
            foreach ($request->file('transferee_files') as $file) {
                $path = $file->store('public/transferee_images');
                $name = $file->getClientOriginalName();

                // Save image metadata to the database
                Image::create([
                    'name' => $name,
                    'student_id' => $request->student_id,
                    'source' => 'transferee',
                    'path' => $path,
                ]);
            }
        }

        // Update step to 4
        $student = Student::find($request->student_id);
        $student->update(['step' => 4]);

        return response()->json(['status' => 'success', 'message' => 'Images have been uploaded successfully! Please wait for your Email if you pass']);
    }
}