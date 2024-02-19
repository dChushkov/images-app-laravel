@extends('admin.admin-layout')

@section('content')
    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Last Users</h2>
            <ul class="list-group">
                @foreach ($latestUsers as $user)
                    <li class="list-group-item">{{ $user->name }} ({{ $user->email }})</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Last Photos</h2>
            <ul class="list-group">
                @foreach ($latestPhotos as $photo)
                    <li class="list-group-item">
                        <strong>{{ $photo->title }}</strong> (Uploaded by: {{ $photo->user->name }})
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection