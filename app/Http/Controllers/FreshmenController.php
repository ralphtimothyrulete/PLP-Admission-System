<?php
// app/Http/Controllers/FreshmenController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;

class FreshmenController extends Controller
{
    public function index()
    {
        $uploadedFiles = Image::all();
        return view('freshmen-reqs', compact('uploadedFiles'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'freshmen_images' => 'required',
            'freshmen_images.*' => 'image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $student_id = $request->input('student_id');
        
        if ($request->hasfile('freshmen_images')) {
            foreach ($request->file('freshmen_images') as $file) {
                $path = $file->store('public/freshmen_images');
                $name = $file->getClientOriginalName();

                // Save image metadata to the database
                Image::create([
                    'name' => $name,
                    'path' => $path,
                    'student_id' => $student_id,
                ]);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Images have been uploaded successfully! Please wait for your Email if you pass']);
    }
}