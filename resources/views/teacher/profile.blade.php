@extends('layouts.main')

@section('title', 'Teacher Profile')
<style>


#profile-container {
    background: #ffffff;
    border-radius: 8px;
    padding: 20px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    margin:0 auto;
}

.profile-form .form-group {
    margin-bottom: 15px;
    text-align: left;
}
.form-error{
    color: red;
    font-size: 14px;
}

.profile-form .form-control,
.profile-form .form-control-file {
    width: 100%;
    padding: 10px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: #ffffff;
    color: #000000;
    box-sizing: border-box;
}

.profile-form .btn-primary {
    background: #1a73e8;
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
}

.profile-form .btn-primary:hover {
    background: #0c5db9;
}

#profile-container h1 {
    margin-bottom: 20px;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    #profile-container {
        width: 100%;
        padding: 15px;
    }

    .profile-form .form-control,
    .profile-form .form-control-file {
        padding: 8px;
    }

    .profile-form .btn-primary {
        padding: 8px 16px;
    }
}

@media (max-width: 480px) {
    #profile-container {
        padding: 10px;
    }

    .profile-form .form-control,
    .profile-form .form-control-file {
        padding: 6px;
    }

    .profile-form .btn-primary {
        padding: 6px 12px;
    }
}


</style>
@section('content')
<div id="profile-container" class="profile-container">
    <h1>Edit Profile</h1>
    <form id="profile-form" class="profile-form" action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required>
            @error('first_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required>
            @error('last_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Profile Picture -->
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
            @error('profile_picture')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="bio">Add Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="4" required>{{ old('bio', auth()->user()->bio??'N/A') }}</textarea>
            @error('bio')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
