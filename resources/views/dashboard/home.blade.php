@extends('dashboard.layout.master')
@section('title')Home @endsection
@section('header-title')Dashboard @endsection
@section('content')
    <main role="main" class="ion-content">
        <div class="homepage-slider">
            <div class="owl-carousel">
                <div class="item">
                    <img alt="img" class="img-responsive single-img"
                        src="{{ asset('uploads/banners/banner 375X212 - 1.png') }}">
                </div>
                <div class="item">
                    <img alt="img" class="img-responsive single-img"
                        src="{{ asset('uploads/banners/banner 375X212 - 2.png') }}">
                </div>
            </div>
        </div>
        <div class="pt-4">
            <div class="ion-grid app-products pb-3">
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-indigo">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Events</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">                    
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-orange">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Timetable</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-teal">
                            <i class="fa fa-inr" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Fees</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-red">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Attendence</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-danger">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">My Subject</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-purple">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Exam Report</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-info">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Gallery</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 shop-homepage bg-white mb-2">
                        <div class="dash-left-icon text-info">
                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                        </div>
                        <b class="dash-main-name">Announcements</b>
                        <div class="dash-right-arrow">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
