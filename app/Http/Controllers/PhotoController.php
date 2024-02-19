<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{

    public function index()
    {
        $photos = Photo::latest()->paginate(10);
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->photos()->count() >= 10) {
            return redirect()->route('photos.index')->with('error', 'You have reached the maximum number of photos allowed.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imageName);

        $photo = new Photo;
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->user_id = Auth::id();
        $photo->image_path = $imageName;
        $photo->save();

        return redirect()->route('photos.index')->with('success', 'Photo uploaded successfully.');
    }

    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }


    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $photo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('photos.show', $photo->id)->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        if (Auth::id() === $photo->user_id) {
            $imagePath = public_path("images/{$photo->image_path}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $photo->delete();
            return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
        } elseif (Auth::user()->isAdmin()) {
            $imagePath = public_path("images/{$photo->image_path}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $photo->delete();
        
            return back()->with('success', 'Photo deleted successfully.');
        } else {
            return back()->with('error', 'You are not authorized to delete this photo.');
        }
    }
}
