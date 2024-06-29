@extends('layouts.app')

@section('content')
<style>


.card-header {
    font-size: 1.2rem;
}

.form-label {
    font-weight: bold;
}

.btn-primary {
    background-color: #3490dc; /* Custom primary color */
    border-color: #3490dc; /* Matching border color */
}

.btn-primary:hover {
    background-color: #2779bd; /* Darker shade on hover */
    border-color: #2779bd;
}

.card {
    border: 1px solid #3490dc; /* Brighter border color */
    box-shadow: 0 0 10px rgba(52, 144, 220, 0.5); /* Shining effect */
    transition: box-shadow 0.3s ease; /* Smooth transition on hover */
}

.card:hover {
    box-shadow: 0 0 15px rgba(52, 144, 220, 0.8); /* Stronger shining effect on hover */
}

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ __('Login') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
