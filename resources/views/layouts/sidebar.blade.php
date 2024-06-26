
@php
$profilePicture = auth()->user()->profile_picture
    ? asset('profile_pictures/' . auth()->user()->profile_picture)
    : 'https://via.placeholder.com/150'; // Placeholder image URL
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper">

        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ $profilePicture }}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{auth()->user()->name ??  auth()->user()->first_name . ' '.auth()->user()->last_name }}</p>
                    <p class="designation">{{ auth()->user()->getRoleNames()->first() }}</p>

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
            <a class="nav-link" href="
                @if (Auth::user()->hasRole('admin'))
                    {{ route('index') }}
                @elseif (Auth::user()->hasRole('teacher'))
                    {{ route('teacher.index') }}
                @elseif (Auth::user()->hasRole('student'))
                    {{ route('student.index') }}
                @endif
            ">
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


            <li class="nav-item">
                <a class="nav-link" href="{{ route('commissions.index') }}">
                    <span class="menu-title">Add Commission</span>
                    <i class="fa-solid fa-percent menu-icon"></i>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.withdrawal_requests') }}">
                    <span class="menu-title">Withdraw Requests</span>
                    <i class="fa-solid fa-book menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.approve.teacher') }}">
                    <span class="menu-title">Approve Teachers</span>
                    <i class="fa-solid fa-user menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.bookings_with_commission') }}">
                    <span class="menu-title">Finance</span>
                    <i class="fa-solid fa-coins menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.overview_bookings') }}">
                    <span class="menu-title">All Bookings</span>
                    <i class="fa-solid fa-person-walking menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('student.requests') }}">
                    <span class="menu-title">Student Withdrawl</span>
                    <i class="fa-solid fa-wallet menu-icon"></i>
                </a>
            </li>

            @endif

        @if (auth()->check() && auth()->user()->hasRole('teacher'))

     <li class="nav-item">
                <a class="nav-link" href="{{ route('sessions.index') }}">
                    <span class="menu-title">Add Session</span>
                    <i class="fa-solid fa-handshake menu-icon"></i>
                </a>
            </li>
            {{-- email done --}}

            <li class="nav-item">
                <a class="nav-link" href="{{ route('teacher.bookings') }}">
                    <span class="menu-title">Booking</span>
                    <i class="fa-solid fa-person-walking menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('wallet.show') }}">
                    <span class="menu-title">Wallet</span>
                    <i class="fa-solid fa-book menu-icon"></i>
                </a>
            </li>



    @endif


    @if (auth()->check() && auth()->user()->hasRole('student'))


    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.bookings') }}">
            <span class="menu-title">My Booking</span>
            <i class="fa-solid fa-book menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.withdrawal_requests') }}">
            <span class="menu-title">My Wallet</span>
            <i class="fa-solid fa-book menu-icon"></i>
        </a>
    </li>

    @endif


    </ul>
</nav>
