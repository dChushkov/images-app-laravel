<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.photos');
    }

    public function index()
    {
        $latestUsers = User::latest()->take(5)->get();
        $latestPhotos = Photo::with('user')->latest()->take(5)->get();

        return view('admin.admin-index', compact('latestUsers', 'latestPhotos'));
    }

    public function indexPhotos()
    {
        $photos = Photo::latest()->paginate(10);
        return view('admin.photos', compact('photos'));
    }

    public function show(Photo $photo)
    {
        return view('admin.show', compact('photo'));
    }

    public function editPhoto(Photo $photo)
    {
        return redirect()->route('admin.photos.show', $photo->id);
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function indexUsers()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
