<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required',
        'photo_id' => 'required|exists:photos,id',
    ]);

    $photo = Photo::findOrFail($request->input('photo_id'));

    if ($photo->comments()->count() >= 20) {
        return redirect()->back()->with('error', 'You have reached the maximum number of comments for this photo.');
    }

    $comment = new Comment();
    $comment->content = $request->input('content');
    $comment->photo_id = $photo->id;
    $comment->user_id = auth()->id();
    $comment->save();

    return redirect()->back()->with('success', 'Comment added successfully.');
}

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('comments.show', $comment->id)->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
