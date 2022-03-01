<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{url('admin/home')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span
                            class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/user-list')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>User List</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-building-4-fill"></i>
                        <span>Company</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/create-company')}}">Create Company</a></li>
                        <li><a href="{{url('admin/company-list')}}">Company List</a></li>
                        <li><a href="{{url('admin/view-company')}}">View Company</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-2-fill"></i>
                        <span>Employee</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-employee')}}">Add Employee</a></li>
                        <li><a href="{{url('admin/employee-list')}}">Employee List</a></li>
                        <li><a href="{{url('admin/view-employee')}}">View Employee</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-map-pin-user-fill"></i>
                        <span>Distributor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-distributor')}}">Add Distributor</a></li>
                        <li><a href="{{url('admin/distributor-list')}}">Distributor List</a></li>
                        <li><a href="{{url('admin/view-distributor')}}">View Distributor</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Project</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/create-project-category')}}">Create Project Category</a></li>
                        <li><a href="{{url('admin/create-project')}}">Create Project</a></li>
                    </ul>
                </li>
               <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-list-line"></i>
                        <span>Course</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('admin/add-course')}}">Add Course</a></li>
                        <li><a href="{{url('admin/course-list')}}">Course List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-calendar-event-fill"></i>
                        <span>Event</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('admin/add-event')}}">Add Event</a></li>
                        <li><a href="{{url('admin/event-list')}}">Event List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Gallery</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('admin/add-gallery')}}">Add Gallery</a></li>
                        <li><a href="{{url('admin/gallery-list')}}">Gallery List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-notification-2-fill"></i>
                        <span>Notice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('admin/add-notice')}}">Add Notice</a></li>
                        <li><a href="{{url('admin/notice-list')}}">Notice List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-notification-2-fill"></i>
                        <span>Enquiry</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('admin/enquiry-list')}}">Enquiry List</a></li>
                        <li><a href="{{url('admin/emailsubscription-list')}}">Email Subscription</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript:void(0)">Recover Password</a></li>
                    </ul>
                </li>
                <!---Distributor Menu Start--->
                <li class="menu-title">Distributor</li>
                <li>
                    <a href="{{url('distributor/project-request')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Project Request List</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('distributor/create-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Create Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('distributor/view-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>View Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('distributor/user-list')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>User List</span>
                    </a>
                </li>
                <!--Distributor Menu End-->
                <!---User Menu Start--->
                <li class="menu-title">User</li>
                <li>
                    <a href="{{url('user/my-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>My Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/work-list')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Work List</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/work-details')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Work Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/applied-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Applied Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('distributor/view-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>View Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('distributor/user-list')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>User List</span>
                    </a>
                </li>
                <!--User Menu End-->

                <li class="menu-title">Front Website</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/update-logo')}}">Update Logo</a></li>
                        <li><a href="{{url('admin/contact-details')}}">Contact Details</a></li>
                        <li><a href="{{url('admin/social-media')}}">Social Media Links</a></li>
                        <li><a href="{{url('admin/add-slider')}}">Add Slider</a></li>
                        <li><a href="{{url('admin/slider-list')}}">Slider List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->