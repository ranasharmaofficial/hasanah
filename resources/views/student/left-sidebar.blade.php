<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu userbackcolor">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Student Menu</li>
                <li>
                    <a href="{{url('student/home')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('student/applyforexam')}}" class="waves-effect">
                        <i class="ri-edit-2-fill"></i>
                        <span>Apply for Entrance Exam</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('student/admit-card')}}" class="waves-effect">
                        <i class=" ri-profile-line"></i>
                        <span>Download Admit Card</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Admission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{url('student/admission-form')}}" class="waves-effect"><span>Apply Admission Form</span></a></li>
                        <li><a href="{{url('student/admission-fee')}}" class="waves-effect"><span>Pay Admission Fee</span></a></li> --}}
                        <li><a href="{{url('student/admission')}}" class="waves-effect"><span>Take Admission</span></a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{url('student/view-profile')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('student/update-profile')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Update Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('student/change-password')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <!--User Menu End-->

                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->