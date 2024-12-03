<?php
// app/Http/Controllers/TransfereeController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;

class TransfereeController extends Controller
{
    public function index()
    {
        $uploadedFiles = Image::all();
        return view('transferee-reqs', compact('uploadedFiles'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'transferee_files' => 'required',
            'transferee_files.*' => 'image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $student_id = $request->input('student_id');
        
        if ($request->hasfile('transferee_files')) {
            foreach ($request->file('transferee_files') as $file) {
                $path = $file->store('public/transferee_images');
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