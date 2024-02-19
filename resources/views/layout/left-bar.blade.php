<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'text-white bg-primary rounded' : 'text-dark' }}" href="{{ route('dashboard') }}">
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('photos.index') ? 'text-white bg-primary rounded' : 'text-dark' }}" href="{{ route('photos.index') }}">
                    <span>Photos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.index') ? 'text-white bg-primary rounded' : 'text-dark' }}" href="{{ route('users.index') }}">
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact.show') ? 'text-white bg-primary rounded' : 'text-dark' }}" href="{{ route('contact.show') }}">
                    <span>Contacts</span>
                </a>
            </li>
        </ul>
    </div>
</div>