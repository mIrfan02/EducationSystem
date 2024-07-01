<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education System</title>
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <style>
        .navbar-brand {
            display: inline-block; /* Ensures the link behaves like a block element */
            height: auto; /* Ensures the image retains its aspect ratio */
        }

        .logo-img {
            height: 40px; /* Adjust height as needed */
            width: auto; /* Automatically adjusts width based on height */
            max-width: 100%; /* Ensures the image does not exceed its parent's width */
        }
    </style>


</head>

<body>
    <header class="header-wrap">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                {{-- <a class="navbar-brand" href="#">Education Portal</a> --}}
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/elogo.png') }}" alt="ESOL Logo" class="logo-img">
                </a>

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
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('teacher.register') }}">Become Instructor</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li> --}}

                        <li class="nav-item dropdown" onmouseover="showDropdown()">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Login
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="loginDropdown">
                                <a class="dropdown-item" href="{{ route('login') }}" style="color: black">Admin</a>
                                <a class="dropdown-item" href="{{ route('login') }}" style="color: black">Teacher</a>
                                <a class="dropdown-item" href="{{ route('login') }}" style="color: black">Student</a>
                            </div>
                        </li>

                        <script>
                            function showDropdown() {
                                document.getElementById("loginDropdown").classList.add("show");
                            }
                        </script>

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
        <div class="about-wrap" id="aboutus">
            <h2 class="heading">ABOUT US</h2>
            <div class="container">
                <div class="about-inner">
                    <div class="about-text">
                        <h2>ABOUT US</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Voluptatibus nam, facere nobis exercitationem
                            eaque fugit, necessitatibus earum expedita omnis
                            officiis iusto numquam! Exercitationem minima ipsa
                            eos aut molestias, natus animi?</p>
                        <div class="rating-flex">
                            <div class="rating">
                                <h3>50M +</h3>
                                <h5>STUDENTS LEARNING
                            </div>
                            </h4>
                            <div class="rating rating2">
                                <h3>40k +</h3>
                                <h5>COUNTRY SEARCHD
                                </h5>
                            </div>
                        </div>
                        <div class="rating-flex">
                            <div class="rating">
                                <h3>340M +
                                </h3>
                                <h5>INSTRUCTORS ONLINE
                            </div>
                            </h4>
                            <div class="rating rating2">
                                <h3>20k +</h3>
                                <h5>COUNTRY REACHED
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="about-img">
                        <img src="{{ asset('assets/images/11.webp') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- <div class="slider" id="instructors">
        <h2 class="heading">OUR INSTRUCTORS</h2>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile1.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile2.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile3.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile4.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile5.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile6.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile7.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{asset('assets/images/profile8.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{ asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image">
                                <img src="{{ asset('assets/images/profile9.jpg')}}" alt=""
                                    class="card-img">
                            </div>
                        </div>
                        <div class="card-content">
                            <h2 class="name">David Dell</h2>
                            <p class="description">IT Technision at IBM.</p>
                            <img src="{{ asset('assets/images/rating.png')}}" alt="">
                            <button class="button">Reserve a meeting</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div> --}}

    <div class="slider" id="instructors">
        <h2 class="heading">OUR INSTRUCTORS</h2>
        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    @foreach ($teachers as $teacher)
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    @php
                                        $profilePicture = $teacher->profile_picture
                                            ? asset('profile_pictures/' . $teacher->profile_picture)
                                            : 'https://via.placeholder.com/150'; // Placeholder image URL
                                    @endphp
                                    <img src="{{ $profilePicture }}" alt="Profile Picture" class="card-img">
                                </div>
                            </div>
                            <div class="card-content">
                                <h2 class="name">{{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
                                <p class="description">Professional Teacher</p>
                                <img src="{{ asset('assets/images/rating.png') }}" alt="Rating">
                                {{-- <button class="button">Reserve a meeting</button> --}}
                                <a class="button" href="{{ route('details', $teacher->id) }}"
                                    style=" text-decoration:none;">Reserve a meeting</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


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
</body>
<!-- Swiper JS -->
<script src="{{ asset('assets/js/landingjs/swiper-bundle.min.js') }}"></script>
<!-- JavaScript -->
<script src="{{ asset('assets/js/landingjs/script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const teacherCount = {{ count($teachers) }};
    let slidesPerView = 4;

    if (teacherCount < 4) {
        slidesPerView = teacherCount;
    }

    new Swiper(".slide-content", {
        slidesPerView: slidesPerView,
        spaceBetween: 25,
        loop: teacherCount > 1,
        centerSlide: true,
        fade: true,
        grabCursor: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            520: {
                slidesPerView: Math.min(2, teacherCount),
            },
            950: {
                slidesPerView: Math.min(3, teacherCount),
            },
            1200: {
                slidesPerView: Math.min(4, teacherCount),
            },
        },
    });
});

</script>
</html>
