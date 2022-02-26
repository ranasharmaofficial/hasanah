@extends('master')

@section('title')Home - Hasanah Girls College @endsection

@section('description')Hasanah Girls College @endsection


@section('content')

<section class="slider-section">
    <div class="slider-wrapper">
        <div id="main-slider" class="nivoSlider">
            <img src="{{asset('front_assets/img/slider1.jpg')}}" alt="" title="#slider-caption-1"/>
        </div><!-- /#main-slider -->

        <div id="slider-caption-1" class="nivo-html-caption slider-caption">
            <div class="display-table">
                <div class="table-cell">
                    <div class="container">
                       <div class="slider-text">
                           <!---
                            <h5 class="wow cssanimation fadeInBottom">Join Us Today</h5>
                            <h1 class="wow cssanimation fadeInTop" data-wow-delay="1s" data-wow-duration="800ms">Better Education for World.</h1>
                            <p class="wow cssanimation fadeInBottom" data-wow-delay="1s">Help today because tomorrow you may be the one who needs helping! <br>Forget what you can get and see what you can give.</p>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Join With Us</a>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Our Classes</a>
                           -->
                        </div>
                   </div>
                </div>
            </div>
        </div> <!-- /#slider-caption-1 -->
        <div id="slider-caption-2" class="nivo-html-caption slider-caption">
            <div class="display-table">
                <div class="table-cell">
                    <div class="container">
                       <div class="slider-text">
                            <h5 class="wow cssanimation fadeInBottom">Join Us Today</h5>
                            <h1 class="wow cssanimation fadeInTop" data-wow-delay="1s" data-wow-duration="800ms">Better Education for World.</h1>
                            <p class="wow cssanimation fadeInBottom" data-wow-delay="1s">Help today because tomorrow you may be the one who needs helping! <br>Forget what you can get and see what you can give.</p>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Join With Us</a>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Our Classes</a>
                        </div>
                   </div>
                </div>
            </div>
        </div> <!-- /#slider-caption-2 -->
        <div id="slider-caption-3" class="nivo-html-caption slider-caption">
            <div class="display-table">
                <div class="table-cell">
                    <div class="container">
                       <div class="slider-text">
                            <h5 class="wow cssanimation fadeInBottom">Join Us Today</h5>
                            <h1 class="wow cssanimation fadeInTop" data-wow-delay="1s" data-wow-duration="800ms">Better Education for World.</h1>
                            <p class="wow cssanimation fadeInBottom" data-wow-delay="1s">Help today because tomorrow you may be the one who needs helping! <br>Forget what you can get and see what you can give.</p>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Join With Us</a>
                            <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">Our Classes</a>
                        </div>
                   </div>
                </div>
            </div>
        </div> <!-- /#slider-caption-3 -->
    </div>
</section><!-- /#slider-Section -->

<section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 xs-padding">
                <div class="about-content">
                    <h2>A brief introduction to the Trust</h2>
                    <p><strong>Place of Al-Hasanah Educational Trust is in Araria, Bihar (India)</strong></p>
<p style="text-align: justify;">I extend many thanks and abundant praise to Allah Almighty for giving us a great opportunity to carry forward to Islam, the path of guidance.</p>
<p style="text-align: justify;">Then I extend our deepest thanks and gratitude to Your Excellency for your sponsorship for dawah mission and for making your greatest efforts in its path. For which Allah may award you in the life of hereafter.</p>
<p style="text-align: justify;">It is necessary to mention that the Al-Hasanah Educational Trust in India is located in an area of Simanchal in the district of Araria, Bihar(India) which is 60 km far from Nepal Border.</p>
<p style="text-align: justify;"><strong>Religions</strong>: There are multiple prominent of them are Islam, Hinduism, and Christianity.</p>
<p style="text-align: justify;">The seeds of the Qadiani sect also started to spread their influence in the region. On the other hand, there are a number of people who are affiliated with Islam and Muslims but they do not follow the teaching of Islam: The teaching of the Quran and Hadith and the right path.</p>
<p style="text-align: justify;">This area has been made a special target by the enemies of Islam in view of the Muslim population as the number of the Muslim population is higher than the number of Muslim population available in the other part of the country.</p>
<p style="text-align: justify;">However most of the Muslims are involved in heresies and superstitions such as they believe in false Sufism and seek support from the tombs and from those who are buried in, and this area is very backward in every spear of life including religious culture and living standards as well, and the education rate in the area is very poor.</p>
<p style="text-align: justify;">Though few Primary, secondary, and intermediate Islamic schools are working in the region in order to spread education and eradicate literacy however number of these schools is very little and not sufficient to cater education of this area.</p>
                    <ul class="about-list">
                        <li>We are creative.</li>
                        <li>Provide best education services.</li>
                        <li>We are always improving.</li>
                    </ul>
                    <a href="{{url('/about')}}" class="default-btn">Read More...</a>
                </div>
            </div>
            <!---<div class="col-md-6">
                <div class="about-bg"></div>
            </div>--->
        </div>
    </div>
</section><!-- /#About Section -->

<section class="course-section bg-grey padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
           <h2>Popular Courses</h2>
         </div>
        <div id="course-carousel" class="course-carousel owl-carousel">
            @foreach ($courses as $course)
            <div style="cursor: pointer;" onclick="window.location.href='{{url('course-details').'/'.$course->slug}}'" class="course-item">
                <div class="course-thumb">
                    <img  src="{{asset('uploads/courses').'/'.$course->courseImage}}" alt="course">
                </div>
                <div class="course-details text-center">
                    <h3><a href="{{url('course-details').'/'.$course->slug}}">{{$course->courseName}}</a></h3>
                    
                </div>
            </div><!-- /#item-1 -->
            @endforeach      
            
            
        </div>
    </div>
</section><!-- /#Course-Section -->


<section id="team" class="team-area course-section bg-grey padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
            <h2>Members of the Al-Hasana Educational Trust in India</h2>
          </div>
            <div class="row team-items">
                <div class="col-md-3 single-item">
                    <div class="item">
                        <div class="thumb bg-primary">
                            <img class="img-fluid" src="{{asset('front_assets/img/team.png')}}" alt="Thumb">
                            <div class="overlay">
                                <h4>Mufizuddin Al-Riyadhi</h4>
                               <div class="social">
                                    <ul>
                                        <li class="twitter">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="vimeo">
                                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <span class="message">
                                <a href="#"><i class="fa fa-envelope-open"></i></a>
                            </span>
                            <h4>Mufizuddin Al-Riyadhi</h4>
                            <span>Chairman of the Trust</span>
                        </div>
                    </div>
                </div><!---Team End--->

                <div class="col-md-3 single-item">
                    <div class="item">
                        <div class="thumb bg-primary">
                            <img class="img-fluid" src="{{asset('front_assets/img/team.png')}}" alt="Thumb">
                            <div class="overlay">
                                <h4>Eminence Sheikh Abdul Mueed Al-Faydhi </h4>
                               <div class="social">
                                    <ul>
                                        <li class="twitter">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="vimeo">
                                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <span class="message">
                                <a href="#"><i class="fa fa-envelope-open"></i></a>
                            </span>
                            <h4>Eminence Sheikh Abdul Mueed Al-Faydhi </h4>
                            <span>General Secretary of the Trust </span>
                        </div>
                    </div>
                </div><!---Team End--->
                <div class="col-md-3 single-item">
                    <div class="item">
                        <div class="thumb bg-primary">
                            <img class="img-fluid" src="{{asset('front_assets/img/team.png')}}" alt="Thumb">
                            <div class="overlay">
                                <h4>Eminence Sheikh Mazhar Al-Haq Al-Salihi  </h4>
                               <div class="social">
                                    <ul>
                                        <li class="twitter">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="vimeo">
                                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <span class="message">
                                <a href="#"><i class="fa fa-envelope-open"></i></a>
                            </span>
                            <h4>Eminence Sheikh Mazhar Al-Haq Al-Salihi </h4>
                            <span>Treasurer of the Trust</span>
                        </div>
                    </div>
                </div><!---Team End--->
                <div class="col-md-3 single-item">
                    <div class="item">
                        <div class="thumb bg-primary">
                            <img class="img-fluid" src="{{asset('front_assets/img/team.png')}}" alt="Thumb">
                            <div class="overlay">
                                <h4>Muhammad Hamza </h4>
                               <div class="social">
                                    <ul>
                                        <li class="twitter">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="vimeo">
                                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <span class="message">
                                <a href="#"><i class="fa fa-envelope-open"></i></a>
                            </span>
                            <h4>Muhammad Hamza  </h4>
                            <span>Advisor of the Trust </span>
                        </div>
                    </div>
                </div><!---Team End--->
                <div class="col-md-3 single-item">
                    <div class="item">
                        <div class="thumb bg-primary">
                            <img class="img-fluid" src="{{asset('front_assets/img/team.png')}}" alt="Thumb">
                            <div class="overlay">
                                <h4>Ali Hussain</h4>
                               <div class="social">
                                    <ul>
                                        <li class="twitter">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="pinterest">
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        <li class="vimeo">
                                            <a href="#"><i class="fa fa-whatsapp"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <span class="message">
                                <a href="#"><i class="fa fa-envelope-open"></i></a>
                            </span>
                            <h4>Ali Hussain</h4>
                            <span>A board member of the Trust</span>
                        </div>
                    </div>
                </div><!---Team End--->
                
            </div>
    </div>
</section>

<section class="reg-section padding">
    <div class="container">
        <div class="row reg-wrap">
            <div class="col-lg-8 text-center">
                <div class="reg-content">
                    <h3 class="counter">4950</h3>
                    <h2>Total Registered</h2>
                    <h3>It’s limited seating! Hurry up Register now <br>and get your free online course.</h3>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="reg-form">
                    <div class="form-heading">
                        <h2>Register Now <span>Get free access to our courses</span></h2>
                    </div>
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" placeholder="Phone">
                        </div>
                      <button type="submit" class="btn btn-primary">Register Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- Register Section -->

<section class="event-section bg-grey padding">
    <div class="container">
       <div class="section-heading mb-40 text-center">
           <h2>Upcoming Events</h2>
        </div>
        <div class="event-items">
            @foreach ($events as $item)
            
            <div class="row event-wrap d-flex align-items-center">
                <div class="col-lg-7">
                    <div class="event-details">
                        <h2><a href="#">{{$item->eventTitle}}</a></h2>
                        <ul class="event-time">
                            <li><i class="fa fa-clock-o"></i>{{$item->created_at}}</li>
                        </ul>
                        <p>{!! html_entity_decode($item->eventDetails) !!}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="event-thumb">
                        <img src="{{asset('uploads/events').'/'.$item->eventImage}}" alt="event">
                    </div>
                </div>
            </div><!-- Event-1 -->
            @endforeach
        </div>
    </div>
</section><!-- Event Section -->

<section id="counter" class="counter-section">
    <div class="container">
        <ul class="row counters">
            <li class="col-lg-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-user"></i>
                    <h3><span class="counter">95</span>Instructors</h3>
                </div>
            </li>
            <li class="col-lg-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-book"></i>
                    <h3><span class="counter">549</span>Online Courses</h3>
                </div>
            </li>
            <li class="col-lg-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-tag"></i>
                    <h3><span class="counter">205</span>Year of History</h3>
                </div>
            </li>
            <li class="col-lg-3 col-sm-6 sm-padding">
                <div class="counter-content">
                    <i class="ti-crown"></i>
                    <h3><span class="counter">4950</span>Active Students</h3>
                </div>
            </li>
        </ul>
    </div>
</section><!-- Counter Section -->

<section class="testimonial-section padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
           <h2>What People Say</h2>
        </div>
        <div id="testimonial-carousel" class="testimonial-carousel owl-carousel">
            
            <div class="testimonial-item text-center">
                <img src="{{asset('front_assets/img/team-1.jpg')}}" alt="profile">
                <h4>Unknown</h4>
                <p>Its really innovative and new experience for the parents as well as for scholars as it gives a platform to a child to climb the graduation of success. Looking forward for similar type of competitions at such a youthful age.</p>
                <ul class="rattings">
                   <li><i class="fa fa-star"></i></li>
                   <li><i class="fa fa-star"></i></li>
                   <li><i class="fa fa-star"></i></li>
                   <li><i class="fa fa-star"></i></li>
                   <li><i class="fa fa-star"></i></li>
                </ul>
            </div><!-- Review-1-->
            
        </div>
    </div>
</section><!-- Testimonial Section -->

<section class="video-cta">
   <div class="video-bg"></div>
    <div class="video-content-wrapper">
        <div class="container">
            <div class="video-content text-center">
                <h3>Join thousand of instructors!</h3>
                <h2>Become an Instructor?</h2>
                <a href="#" class="default-btn">Get Started Now</a>
            </div>
        </div>
    </div>
</section><!-- Video Section -->
@if (false)
<section class="blog-section bg-grey padding">
    <div class="container">
        <div class="section-heading mb-40 text-center">
           <h2>Recent Stories</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 xs-padding">
                <div class="blog-items grid-list row">
                    <div class="col-md-4 padding-15">
                        <div class="blog-post">
                            <img src="{{asset('front_assets/img/post-1.jpg')}}" alt="blog post">
                            <div class="blog-content">
                                <span class="date"><i class="fa fa-clock-o"></i> January 01.2018</span>
                                <h3><a href="#">Standard gallery post</a></h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a href="#" class="post-meta">Read More</a>
                            </div>
                        </div>
                    </div><!-- Post 1 -->
                     
                </div>
            </div><!-- Blog Posts -->
        </div>
    </div>
</section><!-- Blog Section -->

<div class="sponsor-section bd-bottom">
    <div class="container">
        <ul id="sponsor-carousel" class="sponsor-items owl-carousel">
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-1.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-2.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-3.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-4.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-5.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-6.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-7.png')}}" alt="sponsor-image">
            </li>
            <li class="sponsor-item">
                <img src="{{asset('front_assets/img/sponsor-8.png')}}" alt="sponsor-image">
            </li>
        </ul>
    </div>
</div><!-- ./Sponsor Section -->
@endif
@endsection