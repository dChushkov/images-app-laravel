<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
    data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/"><span class="fas fa-image me-1"> </span>{{ config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @if(!auth()->check())
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile')}}">{{ auth()->user()->email }}</a>
                </li>
                @if (Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin-index') }}">Admin Dashboard</a>
                </li>
                @endif
                <div class="mx-2">
                    <a href="{{ route('photos.create') }}" class="btn btn-light rounded">Upload Photo</a>
                </div>
                <div class="mx-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded">Logout</button>
                    </form>
                </div>
                @endif
            </ul>
        </div>
    </div>
</nav>