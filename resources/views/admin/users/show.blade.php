@extends('admin.admin-layout')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary rounded mb-3">Back</a>
        <h2 class="mt-4 mb-3">User Profile</h2>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Photos</h3>
        <div class="row">
            @foreach ($user->photos as $photo)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/' . $photo->image_path) }}" class="card-img-top img-thumbnail" style="height: 200px; object-fit: cover" alt="{{ $photo->title }}">
                        <div class="card-body">
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mb-2 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection