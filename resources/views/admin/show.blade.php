@extends('admin.admin-layout')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-primary rounded mb-3">Back</a>
    <h2 class="mt-4 mb-3">Photo Details</h2>
    <div>
        <h3>{{ $photo->title }}</h3>
        <img src="{{ asset('images/' . $photo->image_path) }}" alt="{{ $photo->title }}" style="max-width: 400px;">
        <p>Uploaded by: {{ $photo->user->name }}</p>
    </div>

    <h3>Comments</h3>
    @foreach ($photo->comments as $comment)
        <div>
            <p>User: {{ $comment->user->name }}</p>
            <p>Content: {{ $comment->content }}</p>
            <form action="{{ route('admin.comments.delete', $comment->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Comment</button>
            </form>
        </div>
    @endforeach
@endsection