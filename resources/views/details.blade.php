<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Detail</title>
    <!-- Swiper CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset ('assets/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>

<style>


body {
font-family: Arial, sans-serif;
background-color: #f8f9fa;
}

.profile-card {
border: none;
border-radius: 20px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-image img {
width: 100px;
height: 100px;
border: 5px solid white;
}

.profile-info {
margin-left: 20px;
}

.rating .fa {
color: #fbc02d;
}

.rating-value {
background-color: #4caf50;
color: white;
border-radius: 5px;
padding: 0 5px;
margin-left: 10px;
}

.follower-info {
color: #777;
}

.badges .badge {
margin: 2px;
}

.stat {
text-align: center;
}

.stat-number {
font-size: 24px;
font-weight: bold;
}

.stat-label {
display: block;
color: #777;
}

.btn-success {
background-color: #4caf50;
border: none;
}

.btn-success:hover {
background-color: #45a049;
}

.checked {
color: #ffc107;
}

/* calendar below */

.calendar {
    max-width: 560px; /* Increased width */
    margin: 0 auto;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
}
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #1f3b64; /* Updated header color */
}
.day-names, .days {
    display: flex;
    flex-wrap: wrap;
}
.day-name, .day {
    width: 14.28%;
    text-align: center;
    padding: 10px 0;
    position: relative; /* Needed for the overlay */
}
.day {
    cursor: pointer;
}
.day.disabled {
    color: #ccc;
    cursor: not-allowed;
}
.day.disabled:not(.active)::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Black transparent overlay */
    pointer-events: none; /* Ensure the overlay doesn't affect pointer events */
}
.day.active {
    background-color: #1f3b64; /* Header color for the current date */
    color: #fff;
    border-radius: 50%;
}

</style>

</head>


    <header class="header-wrap">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Education Portal</a>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#homesection">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#aboutus">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="#instructors">Instructors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="main_baneer-wrap" id="homesection">
            <div class="container">
                <div class="main-banner-inner">
                    <div class="text">
                        <span>Get Started with online cources</span>
                        <h2>BEST ONLINE LEARNING SYSTEM</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing
                            <br>
                            elit. Tempore, debitis? Recusandae ullam <br>
                            corrupti
                            eveniet accusamus illo, est earum minima id!
                        </p>
                        <button class="btn btn-primary" type="button">Contact
                            Us</button>
                        <button class="btn btn-primary" type="button">Read
                            More</button>
                    </div>
                </div>
            </div>
        </div>

        @php
                                    $profilePicture = $teacher->profile_picture
                                        ? asset('profile_pictures/' . $teacher->profile_picture)
                                        : 'https://via.placeholder.com/150'; // Placeholder image URL
                                @endphp


        <div class="container mt-5 mb-5">
            <div class="card profile-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="profile-image">
                                <img src="{{ $profilePicture }}" alt="User Image" class="rounded-circle">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="profile-info">
                                <h3>{{$teacher->first_name.' '.$teacher->last_name}}</h3>
                                <div class="rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="rating-value">4.75</span>
                                </div>
                                <div class="follower-info mt-2">
                                    <span>0 Followers</span> | <span>0 Following</span>
                                </div>
                                <div class="badges mt-2">
                                    <span class="badge badge-primary">Badge 1</span>
                                    <span class="badge badge-secondary">Badge 2</span>
                                    <span class="badge badge-success">Badge 3</span>
                                    <span class="badge badge-danger">Badge 4</span>
                                    <span class="badge badge-warning">Badge 5</span>
                                    <span class="badge badge-info">Badge 6</span>
                                </div>
                                <button class="btn btn-success mt-3">Follow</button>
                            </div>
                        </div>
                    </div>
                    <div class="statistics mt-3">
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="stat">
                                    <span class="stat-number">7</span>
                                    <span class="stat-label">Students</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat">
                                    <span class="stat-number">4</span>
                                    <span class="stat-label">Courses</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat">
                                    <span class="stat-number">5</span>
                                    <span class="stat-label">Reviews</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat">
                                    <span class="stat-number">1</span>
                                    <span class="stat-label">Meetings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        <div class="container mt-5 mb-5">
            <div class="calendar">
                <h4>Choose a date for session</h4>
                <div class="calendar-header text-white text-center py-2">
                    <button id="prev" class="btn btn-light">&lt;</button>
                    <span id="month-year"></span>
                    <button id="next" class="btn btn-light">&gt;</button>
                </div>
                <div class="calendar-body">
                    <div class="day-names d-flex">
                        <div class="day-name">Su</div>
                        <div class="day-name">Mo</div>
                        <div class="day-name">Tu</div>
                        <div class="day-name">We</div>
                        <div class="day-name">Th</div>
                        <div class="day-name">Fr</div>
                        <div class="day-name">Sa</div>
                    </div>
                    <div id="days" class="days d-flex flex-wrap">
                        <!-- Days will be generated here by JavaScript -->
                    </div>
                </div>
            </div>
            <div id="session-details" class="mt-4">
                <!-- Session details will be displayed here -->
            </div>
        </div>










    </main>



    <footer id="contact" class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@educationportal.com</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#">Facebook</a><br>
                    <a href="#">Twitter</a><br>
                    <a href="#">Instagram</a>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <a href="#homesection">Home</a><br>
                    <a href="#instructors">Instructor</a><br>
                    <a href="#aboutus">About Us</a><br>

                </div>
            </div>
            <p class="mt-4">&copy; 2024 Education Portal. All Rights Reserved.
            </p>
        </div>
    </footer>

    @php
    // Example: Format today's date as 'Y-m-d' (e.g., '2024-06-24')
    $formattedDate = now()->format('Y-m-d');
@endphp

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Swiper JS -->
<script src="{{ asset('assets/js/landingjs/swiper-bundle.min.js') }}"></script>
<!-- JavaScript -->
<script src="{{ asset('assets/js/landingjs/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- <script>
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const daysElement = document.getElementById('days');
    const monthYearElement = document.getElementById('month-year');
    let currentDate = new Date();

    function generateCalendar(date) {
        daysElement.innerHTML = '';
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDayOfPreviousMonth = new Date(year, month, 0).getDate();

        monthYearElement.innerText = `${monthNames[month]} ${year}`;

        // Generate previous month days
        let startDay = lastDayOfPreviousMonth - firstDayOfMonth + 1;
        for (let i = startDay; i <= lastDayOfPreviousMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('day', 'disabled');
            day.innerText = i;
            daysElement.appendChild(day);
        }

        // Generate current month days
        for (let i = 1; i <= lastDateOfMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('day');
            day.innerText = i;

            const dayDate = new Date(year, month, i);
            if (dayDate < today || (dayDate.getDate() === today.getDate() && dayDate.getMonth() === today.getMonth() && dayDate.getFullYear() === today.getFullYear())) {
                day.classList.add('disabled');
                day.style.pointerEvents = 'none';
            }

            if (dayDate.getDate() === today.getDate() && dayDate.getMonth() === today.getMonth() && dayDate.getFullYear() === today.getFullYear()) {
                day.classList.add('active');
            }

            daysElement.appendChild(day);
        }
    }

    document.getElementById('prev').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        generateCalendar(currentDate);
    });

    document.getElementById('next').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        generateCalendar(currentDate);
    });

    generateCalendar(currentDate);
</script> --}}


<script>
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const daysElement = document.getElementById('days');
    const monthYearElement = document.getElementById('month-year');
    const sessionDetailsElement = document.getElementById('session-details');
    let currentDate = new Date();

    function generateCalendar(date) {
        daysElement.innerHTML = '';
        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
        const lastDayOfPreviousMonth = new Date(year, month, 0).getDate();

        monthYearElement.innerText = `${monthNames[month]} ${year}`;

        // Generate previous month days
        let startDay = lastDayOfPreviousMonth - firstDayOfMonth + 1;
        for (let i = startDay; i <= lastDayOfPreviousMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('day', 'disabled');
            day.innerText = i;
            daysElement.appendChild(day);
        }

        // Generate current month days
        for (let i = 1; i <= lastDateOfMonth; i++) {
            const day = document.createElement('div');
            day.classList.add('day');
            day.innerText = i;

            const dayDate = new Date(year, month, i);
            if (dayDate < today || (dayDate.getDate() === today.getDate() && dayDate.getMonth() === today.getMonth() && dayDate.getFullYear() === today.getFullYear())) {
                day.classList.add('disabled');
                day.style.pointerEvents = 'none';
            }

            if (dayDate.getDate() === today.getDate() && dayDate.getMonth() === today.getMonth() && dayDate.getFullYear() === today.getFullYear()) {
                day.classList.add('active');
            }

            day.addEventListener('click', () => {
                fetchSessionDetails(dayDate, {{$teacher->id}}); // Fetch and display session details for clicked date
            });

            daysElement.appendChild(day);
        }
    }

    function fetchSessionDetails(date, teacherId) {
        // Format date for comparison with MySQL date format (YYYY-MM-DD)
        // const formattedDate = date.toISOString().slice(0, 10);

        // Filter meetings by teacher_id and date
        const formattedDate = "{{ $formattedDate }}";
    console.log("Formatted Date:", formattedDate);

    const sessions = {!! json_encode($teacher->meetings()->where('date', $formattedDate)->toSql()) !!};
    console.log("SQL Query:", sessions);

        displaySessionDetails(sessions);
    }

    function displaySessionDetails(sessionData) {
        sessionDetailsElement.innerHTML = ''; // Clear previous session details

        if (sessionData.length === 0) {
            sessionDetailsElement.innerHTML = '<p>No sessions found for selected date.</p>';
            return;
        }

        sessionData.forEach(session => {
            const sessionElement = document.createElement('div');
            sessionElement.classList.add('session-card', 'bg-success', 'text-white', 'p-2', 'mb-2');
            sessionElement.innerHTML = `
                <p><strong>Title:</strong> ${session.title}</p>
                <p><strong>Start Time:</strong> ${session.start_time}</p>
                <p><strong>End Time:</strong> ${session.end_time}</p>
                <p><strong>Meeting Link:</strong> <a href="${session.meeting_link}" target="_blank">${session.meeting_link}</a></p>
                <p><strong>Fee per Hour:</strong> $${session.fee_per_hour}</p>
            `;
            sessionDetailsElement.appendChild(sessionElement);
        });
    }

    document.getElementById('prev').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        generateCalendar(currentDate);
    });

    document.getElementById('next').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        generateCalendar(currentDate);
    });

    generateCalendar(currentDate);
</script>


</html>
