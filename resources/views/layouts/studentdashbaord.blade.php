@extends('layouts.main')

@section('title','Dashboard')

@section('content')
<style>
    .card {
        border: 1px solid #e6e6e6;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 250px; /* Increased height */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #ffffff;
    }

    .card-text {
        font-size: 24px;
        font-weight: bold;
        color: #ffffff;
        display: none;
    }

    .card-hover-text {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        color: #ffffff;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        transition: opacity 0.3s;
        opacity: 0;
    }

    .card:hover .card-hover-text {
        display: flex;
        opacity: 1;
    }

    .grid-margin {
        margin-bottom: 20px;
    }

    .bg-sessions {
        background-color: #6f42c1; /* Purple */
    }

    .bg-bookings {
        background-color: #007bff; /* Blue */
    }
    .bg-new {
        background-color: #3c98aa; /* Blue */
    }

    .bg-wallet {
        background-color: #28a745; /* Green */
    }
</style>

<div class="row">
    <h2>Summary</h2>

    <div class="col-md-4 grid-margin stretch-card">
        <a href="{{ route('student.bookings') }}" class="card bg-bookings">
            <div class="card-body">
                <h4 class="card-title">My Bookings</h4>
                <p class="card-text">{{ $bookingCount }}</p>
                <div class="card-hover-text">Bookings: {{ $bookingCount }}</div>
            </div>
        </a>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <a href="{{ route('welcome.index') }}" class="card bg-new">
            <div class="card-body">
                <h4 class="card-title">New Bookings</h4>
                <p class="card-text">+ New Booking</p>
                <div class="card-hover-text">+</div>
            </div>
        </a>
    </div>
</div>
@endsection
