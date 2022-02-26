@extends('master')

@section('title')Our Teachers - Hasanah Girls College @endsection

@section('description')Hasanah Girls College Description @endsection


@section('content')
<div class="pager-header">
    <div class="container">
        <div class="page-content">
            <h2>Our Instructors</h2>
            <p>Lorem Ipsum is simply text of the industry. </p>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </div>
    </div>
</div><!-- /Page Header -->

<div class="about-inner bg-grey padding">
    <div class="container">
        <div class="row about-inner-wrap">
            <div class="col-md-6 xs-padding">
                <div class="about-inner-content">
                    <h2>Who We Are?</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry’sstandard dummy text ever since the 1500, printer took a galley of type and
                        scramble.</p>
                    <p>Lorem Ipsum has been the industry’sstandard dummy text ever since the 1500, printer took a galley
                        of type more business wordpress themes and scramble.</p>
                    <a href="#" class="default-btn">Join With Us</a>
                </div>
            </div>
            <div class="col-md-6 xs-padding">
                <div class="about-inner-bg">
                    <img src="img/team-bg.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>
</div><!-- /About Section -->

<section class="team-section padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
            <h2>Meet Our Instructors</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and industry.</p>
        </div>
        <div class="row team-wrap">
            <div class="col-lg-3 col-md-6 sm-padding">
                <div class="team-box">
                    <div class="team-thumb">
                        <img src="img/team-1.jpg" alt="team">
                    </div>
                    <div class="team-details">
                        <h4>Michel Brown</h4>
                        <span>Wordpress Development</span>
                    </div>
                </div>
            </div><!-- /#Team-1 -->
            <div class="col-lg-3 col-md-6 sm-padding">
                <div class="team-box">
                    <div class="team-thumb">
                        <img src="img/team-2.jpg" alt="team">
                    </div>
                    <div class="team-details">
                        <h4>Donal Trump</h4>
                        <span>Javascript Specialist</span>
                    </div>
                </div>
            </div><!-- /#Team-2 -->
            <div class="col-lg-3 col-md-6 sm-padding">
                <div class="team-box">
                    <div class="team-thumb">
                        <img src="img/team-3.jpg" alt="team">
                    </div>
                    <div class="team-details">
                        <h4>Jhon Smith</h4>
                        <span>Frontent Developer</span>
                    </div>
                </div>
            </div><!-- /#Team-3 -->
            <div class="col-lg-3 col-md-6 sm-padding">
                <div class="team-box">
                    <div class="team-thumb">
                        <img src="img/team-4.jpg" alt="team">
                    </div>
                    <div class="team-details">
                        <h4>Angelina Rose</h4>
                        <span>Psd Designer</span>
                    </div>
                </div>
            </div><!-- /#Team-4 -->
        </div>
    </div>
</section><!-- /#Team-Section -->

<section id="counter" class="counter-section">
    <div class="container">
        <ul class="row counters">
            <li class="col-md-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-user"></i>
                    <h3><span class="counter">95</span>Instructors</h3>
                </div>
            </li>
            <li class="col-md-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-book"></i>
                    <h3><span class="counter">549</span>Online Courses</h3>
                </div>
            </li>
            <li class="col-md-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-tag"></i>
                    <h3><span class="counter">205</span>Year of History</h3>
                </div>
            </li>
            <li class="col-md-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-crown"></i>
                    <h3><span class="counter">4950</span>Active Students</h3>
                </div>
            </li>
        </ul>
    </div>
</section><!-- Counter Section -->

<div class="sponsor-section bd-bottom">
    <div class="container">
        <ul id="sponsor-carousel" class="sponsor-items owl-carousel">
            <li class="sponsor-item">
                <img src="img/sponsor-1.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-2.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-3.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-4.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-5.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-6.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-7.png" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="img/sponsor-8.png" alt="sponsor-image">
            </li>
        </ul>
    </div>
</div><!-- ./Sponsor Section -->

@endsection