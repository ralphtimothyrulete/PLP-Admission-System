<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;

class RequirementController extends Controller
{
    public function index(Request $request)
    {
        $year = session('year', date('Y'));
        $search = $request->input('search');

        $images = Image::whereYear('created_at', $year)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('source', 'like', "%{$search}%");
            })
            ->paginate(15);

        return view('admin.requirements.index', compact('images', 'search'));
    }

    public function show($id)
    {
        $image = Image::findOrFail($id);
        $studentImages = Image::where('student_id', $image->student_id)->get();
        return view('admin.requirements.show', compact('image', 'studentImages'));
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.requirements.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'source' => 'required|string',
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $image = Image::findOrFail($id);
        $data = $request->only(['name', 'source']);

        if ($request->hasFile('new_image')) {
            Storage::delete($image->path);
            $path = $request->file('new_image')->store('public/' . $image->source . '_images');
            $data['path'] = $path;
        }

        $image->update($data);

        return redirect()->route('requirements.index')->with('status', 'Image updated successfully!');
    }

    public function updateNote(Request $request, $id)
    {
        $request->validate([
            'note' => 'nullable|string|max:1000',
        ]);
        $image = Image::findOrFail($id);
        $image->note = $request->note;
        $image->save();

        return response()->json(['success' => true, 'note' => $image->note]);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::delete($image->path);
        $image->delete();

        return redirect()->route('requirements.index')->with('status', 'Image deleted successfully!');
    }
}