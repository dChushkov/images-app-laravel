@extends('admin.admin-layout')

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-3">Users</h2>
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                    <span class="badge bg-primary rounded-pill">Created at: {{ $user->created_at->format('M d, Y') }}</span>
                </li>
            @endforeach
        </ul>
        <nav class="mt-4" aria-label="Page navigation">
            {{ $users->links() }}
        </nav>
    </div>
@endsection