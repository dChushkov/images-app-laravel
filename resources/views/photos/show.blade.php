@extends('layout.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img src="/images/{{ $photo->image_path }}" class="card-img-top" alt="{{ $photo->title }}">
                    <div class="card-body">
                        <div class="mb-3">
                            <h5 class="card-title">Title: {{ $photo->title }}</h5>
                        </div>
                        <div class="mb-3">
                            <p class="card-text">Description: {{ $photo->description }}</p>
                        </div>
                        <div>
                            <h3>Comments</h3>
                            @foreach ($photo->comments as $comment)
                                <div>
                                    <p>{{ $comment->user->name }} : {{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                        @auth
                        <div>
                            <h3>Add Comment</h3>
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <div>
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                    <textarea name="content" rows="3"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary rounded mb-2">Submit</button>
                                </div>
                            </form>
                        </div>
                            @if (auth()->user()->id == $photo->user_id)
                                 <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-primary rounded mb-2">Edit</a>
                                 <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection