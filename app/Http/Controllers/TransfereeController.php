<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransfereeController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $uploadedFiles = $request->file('files');
        $filePaths = [];

        if ($uploadedFiles) {
            foreach ($uploadedFiles as $file) {
                // Store each file in storage/app/public/uploads
                $filePath = $file->store('uploads', 'public');
                $filePaths[] = $filePath;
            }
        }

        return response()->json(['message' => 'Files uploaded successfully!', 'filePaths' => $filePaths]);
    }
}
