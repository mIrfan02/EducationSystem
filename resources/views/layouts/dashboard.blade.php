@extends('layouts.main')

@section('title','Dashboard')

@section('content')
<style>
    .card {
        border: 1px solid #e6e6e6;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        height: 180px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-top: 60px;
    }

    .card-text {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    .grid-margin {
        margin-bottom: 20px;
    }

    .card .overlay {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: top 0.3s ease;
        font-size: 20px;
    }

    .card:hover .overlay {
        top: 0;
    }

    .card a {
        color: inherit;
        text-decoration: none;
    }
</style>
<div class="row">
    <h2>Overview</h2>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <a href="{{ route('categories') }}">
                    <h4 class="card-title">Categories</h4>
                    <div class="overlay">{{ $categoryCount }}</div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-success text-white">
            <div class="card-body">
                <a href="{{ route('courses.index') }}">
                    <h4 class="card-title">Courses</h4>
                    <div class="overlay">{{ $courseCount }}</div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <a href="{{ route('teachers.index') }}">
                    <h4 class="card-title">Teachers</h4>
                    <div class="overlay">{{ $teacherCount }}</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
