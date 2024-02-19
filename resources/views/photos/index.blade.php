@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('layout.left-bar')
    </div>
    <div class="col-md-9">
        <h2 class="text-center">Photos</h2>
        <div class="container">
            <div class="row">
                @foreach ($photos as $photo)
                    <div class="col-md-12 mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <a href="{{ route('photos.show', $photo->id) }}">
                                        <img src="/images/{{ $photo->image_path }}" 
                                        class="card-img-top img-fluid" style="height: 200px; object-fit: cover" alt="{{ $photo->title }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Title:</strong> {{ $photo->title }}</h5>
                                        <p class="card-text"><strong>Description:</strong> {{ $photo->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{ $photos->links() }}
@endsection