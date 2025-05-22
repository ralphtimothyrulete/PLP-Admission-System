<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Student;

class FreshmenController extends Controller
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
        return view('freshmen-reqs', compact('uploadedFiles', 'student_id', 'student'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'freshmen_images' => 'required',
            'freshmen_images.*' => 'image|mimes:jpg,jpeg,png|max:10240',
            'student_id' => 'required|exists:students,id',
        ]);

        if ($request->hasfile('freshmen_images')) {
            foreach ($request->file('freshmen_images') as $file) {
                $path = $file->store('public/freshmen_images');
                $name = $file->getClientOriginalName();

                // Save image metadata to the database
                Image::create([
                    'name' => $name,
                    'student_id' => $request->student_id,
                    'source' => 'freshmen',
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