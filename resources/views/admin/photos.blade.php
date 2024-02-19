@extends('admin.admin-layout')

@section('content')
<h2>Photos</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>User</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($photos as $photo)
            <tr>
                <td>{{ $photo->id }}</td>
                <td>{{ $photo->title }}</td>
                <td>{{ $photo->user->name }}</td>
                <td>{{ $photo->created_at }}</td>
                <td>
                    <a href="{{ route('admin.show', $photo->id) }}" class="btn btn-primary rounded">View</a>
                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $photos->links() }}
@endsection