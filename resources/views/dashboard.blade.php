@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center"> 
            <div class="col-md-3">
                @include('layout.left-bar')
            </div>
            <div class="col-md-9">
                <h1>Latest Photos</h1>
                <div class="row">
                    @foreach ($photos as $photo)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('photos.show', $photo->id) }}">
                                <img src="/images/{{ $photo->image_path }}" 
                                class="card-img-top img-fluid" alt="{{ $photo->title }}" 
                                style="height: 200px; object-fit: cover">
                                <p class="text-center mt-2">
                                Photo by: {{ $photo->user->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                </div>
            </div>
        </div>
    </div>
@endsection

