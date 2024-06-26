<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Detail</title>
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        <style>body {
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
            max-width: 560px;
            /* Increased width */
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1f3b64;
            /* Updated header color */
        }

        .day-names,
        .days {
            display: flex;
            flex-wrap: wrap;
        }

        .day-name,
        .day {
            width: 14.28%;
            text-align: center;
            padding: 10px 0;
            position: relative;
            /* Needed for the overlay */
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
            background-color: rgba(0, 0, 0, 0.2);
            /* Black transparent overlay */
            pointer-events: none;
            /* Ensure the overlay doesn't affect pointer events */
        }

        .day.active {
            background-color: #1f3b64;
            /* Header color for the current date */
            color: #fff;
            border-radius: 50%;
        }

        .card-custom {
            display: inline-block;
            width: auto;
            min-width: 200px;


        }

        .main-container {
            margin: 3rem;
        }
    </style>

</head>


<header class="header-wrap">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Education Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="#instructors">Instructors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
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
                            <h3>{{ $teacher->first_name . ' ' . $teacher->last_name }}</h3>
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



    <div class="container mt-5 mb-5 col-md-12">
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
        <div id="session-details" class="mt-4" style="margin: 0 auto; align-items: center; justify-content: center; text-align: center;">
            <!-- Session details will be displayed here -->
        </div>

    </div>


    <div class="container">
        <div class="mt-3" id="cart-details">
            <!-- Cart items will be displayed here -->
        </div>
        <button id="checkout-button" class="btn btn-primary mbt-3 mb-3 ml-2">Proceed to Checkout</button>
    </div>


<!-- Modal for User Registration -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register to Proceed</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerForm">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit and Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>


    {{-- <div class="container mt-5 mb-5">

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
        <div id="session-details" class="mt-4"
            style="    margin: 0 auto;
    align-items: center;
    justify-content: center;
    text-align: center;">
            <!-- Session details will be displayed here -->
        </div>
    </div>

    <div class="container" id="cart-details">

            <!-- Cart items will be displayed here -->
    </div> --}}










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
<script src="{{ asset('assets/js/landingjs/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



{{-- yesterday script --}}

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
                            document.addEventListener('DOMContentLoaded', function () {
                            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                                "October", "November", "December"
                            ];
                            const daysElement = document.getElementById('days');
                            const monthYearElement = document.getElementById('month-year');
                            let currentDate = new Date();

                            // Prepare sessions data (replace with your dynamic data)
                            const sessions = {!! json_encode($teacher->meetings) !!};
                            const sessionsByDate = {};

                            // Custom date formatter to ensure consistent formatting
                            function formatDate(date) {
                                const year = date.getFullYear();
                                const month = ('0' + (date.getMonth() + 1)).slice(-2);
                                const day = ('0' + date.getDate()).slice(-2);
                                return `${year}-${month}-${day}`;
                            }

                            // Organize sessions by date
                            sessions.forEach(session => {
                                const sessionDate = new Date(session.date);
                                const formattedDate = formatDate(sessionDate);
                                if (!sessionsByDate[formattedDate]) {
                                    sessionsByDate[formattedDate] = [];
                                }
                                sessionsByDate[formattedDate].push(session);
                            });

                            function generateCalendar(date) {
                                daysElement.innerHTML = '';
                                const year = date.getFullYear();
                                const month = date.getMonth();
                                const today = new Date();
                                today.setHours(0, 0, 0, 0);
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
                                    dayDate.setHours(0, 0, 0, 0);
                                    const formattedDate = formatDate(dayDate);

                                    if (dayDate < today) {
                                        day.classList.add('disabled');
                                        day.style.pointerEvents = 'none';
                                    } else if (sessionsByDate[formattedDate]) {
                                        day.classList.add('clickable');
                                        day.addEventListener('click', () => fetchSessionDetails(formattedDate));
                                    } else {
                                        day.addEventListener('click', () => showNoMeetingsMessage(formattedDate));
                                    }

                                    if (dayDate.getTime() === today.getTime()) {
                                        day.classList.add('active');
                                    }

                                    daysElement.appendChild(day);
                                }
                            }

                            function fetchSessionDetails(date) {
                                const sessionData = sessionsByDate[date];
                                displaySessionDetails(sessionData, date);
                            }

                            function fetchCartCount(meetingId) {
                                return fetch(`/cart/count?meeting_id=${meetingId}`)
                                    .then(response => response.json())
                                    .then(data => data.cart_count)
                                    .catch(error => {
                                        console.error('Error fetching cart count:', error);
                                        return 0;
                                    });
                            }

                            function displaySessionDetails(sessionData, date) {
                        const sessionContainer = document.getElementById('session-details');
                        sessionContainer.innerHTML = '';

                        if (!sessionData || sessionData.length === 0) {
                            sessionContainer.innerHTML = `<div class="alert alert-info">No sessions found for selected date.</div>`;
                            return;
                        }

                        sessionData.forEach(session => {
                            const sessionElement = document.createElement('div');
                            sessionElement.classList.add('card', 'mb-2', 'bg-success', 'text-white', 'card-custom');

                            sessionElement.innerHTML = `
                                <div class="card-body">
                                    <h5 class="card-title">${session.title}</h5>
                                    <p class="card-text">Time: ${session.start_time} - ${session.end_time}</p>
                                    <p class="card-text">Type: ${session.session_type}</p>
                                    <button class="btn btn-primary add-to-cart" data-session-id="${session.id}">Add to Cart</button>
                                </div>
                            `;
                            sessionContainer.appendChild(sessionElement);

                            // Add event listener for "Add to Cart" button
                            sessionElement.querySelector('.add-to-cart').addEventListener('click', () => {
                                addToCart(session.id);
                            });
                        });
                    }


                            function showNoMeetingsMessage(date) {
                                const sessionContainer = document.getElementById('session-details');
                                sessionContainer.innerHTML = `<div class="alert alert-info">No meetings available for ${date}.</div>`;
                            }

                            // Function to add to cart using AJAX
                        // Function to add to cart using AJAX
                    function addToCart(sessionId) {
                        fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                meeting_id: sessionId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.message,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Reload the page to update cart details
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message,
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to add session to cart.',
                                confirmButtonText: 'OK'
                            });
                        });
                    }


                            // Event listeners for calendar navigation
                            document.getElementById('prev').addEventListener('click', () => {
                                currentDate.setMonth(currentDate.getMonth() - 1);
                                generateCalendar(currentDate);
                            });

                            document.getElementById('next').addEventListener('click', () => {
                                currentDate.setMonth(currentDate.getMonth() + 1);
                                generateCalendar(currentDate);
                            });

                            // Initialize calendar on page load
                            generateCalendar(currentDate);
                        });
                    </script>


 <script>
                        // Function to fetch cart items
                        function fetchCartItems() {
                        return fetch('/cart/items')
                            .then(response => response.json())
                            .catch(error => {
                                console.error('Error fetching cart items:', error);
                                return [];
                            });
                    }

                    // Function to display cart details including total price
                    function displayCartDetails(cartItems) {
                        const cartDetailsContainer = document.getElementById('cart-details');
                        cartDetailsContainer.innerHTML = '';

                        if (!cartItems || cartItems.length === 0) {
                            cartDetailsContainer.innerHTML = `<div class="alert alert-info">Your cart is empty.</div>`;
                            return;
                        }

                        const cartList = document.createElement('div');
                        cartList.classList.add('card', 'p-3', 'bg-light');

                        let totalPrice = 0;

                        cartItems.forEach(item => {
                            const cartItemElement = document.createElement('div');
                            cartItemElement.classList.add('mb-2', 'border', 'p-2', 'bg-white', 'd-flex', 'justify-content-between', 'align-items-center');
                            cartItemElement.innerHTML = `
                                <div>
                                    <h6>${item.meeting.title || 'Unknown Title'}</h6>
                                    <p>Time: ${item.meeting.start_time || 'Unknown Time'} - ${item.meeting.end_time || 'Unknown End Time'}</p>
                                    <p>Type: ${item.meeting.session_type || 'Unknown Type'}</p>
                                    <p>Fee: ${item.meeting.fee_per_hour || 'No Fee'}</p>
                                </div>
                                <button class="btn btn-danger btn-sm delete-from-cart" data-cart-id="${item.id}">Remove</button>
                            `;
                            cartList.appendChild(cartItemElement);

                            // Calculate total price
                            if (item.meeting.fee_per_hour) {
                                totalPrice += parseFloat(item.meeting.fee_per_hour);
                            }
                        });

                        // Display total price at the end
                        const totalElement = document.createElement('div');
                        totalElement.classList.add('mt-3', 'font-weight-bold');
                        totalElement.innerHTML = `Total Price: $${totalPrice.toFixed(2)}`;
                        cartList.appendChild(totalElement);
                        sessionStorage.setItem('total_price', totalPrice.toFixed(2));

                        cartDetailsContainer.appendChild(cartList);

                        // Add event listeners to "Delete from Cart" buttons
                        document.querySelectorAll('.delete-from-cart').forEach(button => {
                            button.addEventListener('click', (event) => {
                                const cartItemId = event.target.getAttribute('data-cart-id');
                                deleteFromCart(cartItemId);
                            });
                        });
                    }

                    // Function to delete item from cart
                    function deleteFromCart(cartItemId) {
                        fetch(`/cart/delete/${cartItemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Refresh cart details after deletion
                                fetchCartItems().then(cartItems => {
                                    displayCartDetails(cartItems);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item removed from cart successfully!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                });
                            } else {
                                throw new Error('Failed to remove item from cart.');
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting item from cart:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to remove item from cart.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    }

                    // Initial fetch and display of cart items
                    fetchCartItems().then(cartItems => {
                        displayCartDetails(cartItems);
                    });


                    // Initial fetch and display of cart items
                    fetchCartItems().then(cartItems => {
                        displayCartDetails(cartItems);
                    });

</script>



<script>
   document.getElementById('checkout-button').addEventListener('click', function () {
        fetch('/auth/check')
            .then(response => response.json())
            .then(data => {
                if (data.authenticated) {
                    // User is authenticated, redirect to checkout
                    window.location.href = '/checkout';
                } else {
                    // User is not authenticated, open the registration modal
                    $('#registerModal').modal('show');
                }
            })
            .catch(error => {
                console.error('Error checking authentication status:', error);
            });
    });

    // Event listener for registration form submission
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const first_name = document.getElementById('first_name').value;
        const last_name = document.getElementById('last_name').value;
        const email = document.getElementById('email').value;

        if (!first_name || !last_name || !email) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please fill out all fields.',
            });
            return;
        }

        fetch('/register-temp-user', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ first_name, last_name, email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.user_id) {
                window.location.href = `/checkout/${data.user_id}`;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to register user.',
                });
            }
        })
        .catch(error => {
            console.error('Error registering user:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to register user.',
            });
        });
    });
</script>


</html>
