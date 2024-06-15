<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper">
            <a class="nav-link navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg')}} " alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{auth()->user()->name ??  auth()->user()->first_name . ' '.auth()->user()->last_name }}</p>
                    <p class="designation">Administrator</p>
                </div>
                <div class="icon-container">
                    <i class="icon-bubbles"></i>
                    <div class="dot-indicator bg-danger"></div>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route("index") }}">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route("categories") }}">
                    <span class="menu-title">Categories</span>
                    <i class="fa-solid fa-layer-group menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route("courses.index") }}">
                    <span class="menu-title">Courses</span>
                    <i class="fa-solid fa-book-open menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("teachers.index") }}">
                    <span class="menu-title">Teachers</span>
                    <i class="fa-solid fa-user menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
