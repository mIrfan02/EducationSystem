<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="#">
        <img  src="{{ asset('assets/images/esollogo.jpg') }}" alt="logo" class="logo-dark" />

        <img src="{{  asset('assets/images/logo-light.svg')}}" alt="logo-light" class="logo-light">
      </a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{  asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
      <ul class="navbar-nav navbar-nav-right">

        @php
    $profilePicture = auth()->user()->profile_picture
        ? asset('profile_pictures/' . auth()->user()->profile_picture)
        : 'https://via.placeholder.com/150'; // Placeholder image URL
@endphp

        <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle ms-2" src="{{ $profilePicture }}" alt="Profile image"> <span class="font-weight-normal"> {{auth()->user()->name ??  auth()->user()->first_name . ' '.auth()->user()->last_name }} </span></a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            @if(auth()->user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="dropdown-item-icon icon-user text-primary"></i> My Profile
                    </a>
                @elseif(auth()->user()->hasRole('teacher'))
                    <a class="dropdown-item" href="{{ route('teacher.profile.edit') }}">
                        <i class="dropdown-item-icon icon-user text-primary"></i> My Profile
                    </a>
                    @elseif(auth()->user()->hasRole('student'))
                    <a class="dropdown-item" href="{{ route('student.profile.edit') }}">
                        <i class="dropdown-item-icon icon-user text-primary"></i> My Profile
                    </a>



                @endif

            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="dropdown-item-icon icon-power text-primary"></i>Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
