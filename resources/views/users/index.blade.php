@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('layout.left-bar')
        </div>
        <div class="col-md-9">
            <h2>Users</h2>
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">Uploaded photos: {{ $user->photos_count }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $users->links() }} 
        </div>
    </div>
@endsection