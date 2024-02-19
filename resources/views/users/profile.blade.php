@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Registration Date:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                        <p><strong>Number of Uploaded Photos:</strong> {{ Auth::user()->photos()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection