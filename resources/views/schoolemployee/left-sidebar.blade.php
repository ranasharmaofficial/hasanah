<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{url('schoolemployee/home')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span
                            class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-building-fill"></i>
                        <span>School </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/addschool')}}">Add School</a></li>
                        <li><a href="{{url('schoolemployee/school-list')}}">School List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Class </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/addclass')}}">Add Class</a></li>
                        <li><a href="{{url('schoolemployee/class-list')}}">Class List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i>FP</i>
                        <span>Fix Payment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schoolemployee/fix-admission-fee')}}">Fix Admission Fee</a></li>
                        <li><a href="{{url('schoolemployee/admission-fee-list')}}">Admission Fee List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Student </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/student-view')}}">Student View</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Teacher </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/add-teacher')}}">Add Teacher</a></li>
                        <li><a href="{{url('schoolemployee/teacher-list')}}">Teacher List</a></li>
                        <li><a href="{{url('schoolemployee/teacher-update')}}">Teacher Update</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Hostel Management </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/manage-room')}}">Manage Room</a></li>
                        <li><a href="{{url('schoolemployee/admit-student')}}">Admit Student</a></li>
                        <li><a href="{{url('schoolemployee/receive-hostel-fee')}}">Receive Hostel Fee</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Mess Management </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/mess/admit-student')}}">Admit Student</a></li>
                        <li><a href="{{url('schoolemployee/mess/mess-student-list')}}">Mess Student List</a></li>
                        <li><a href="{{url('schoolemployee/mess/create-manage-mess-menu')}}">Manage Mess Menu</a></li>
                        <li><a href="{{url('schoolemployee/mess/assign-mess-menu')}}">Assign Mess Menu To Calendar</a></li>
                        {{-- <li><a href="{{url('schoolemployee/mess/assign-mess-menu')}}">Menu List</a></li> --}}
                        <li><a href="{{url('schoolemployee/mess/add-stock')}}">Add Stock</a></li>
                        <li><a href="{{url('schoolemployee/mess/stock-list')}}">Stock List</a></li>
                        <li><a href="{{url('schoolemployee/receive-hostel-fee')}}">Expense Stock</a></li>
                        {{-- <li><a href="{{url('schoolemployee/receive-hostel-fee')}}">Meal Report</a></li>
                        <li><a href="{{url('schoolemployee/receive-hostel-fee')}}">Mess Bills And Balance Payment</a></li> --}}
                        <li><a href="{{url('schoolemployee/mess/mess-fee')}}">Mess Fee Management</a></li>
                        <li><a href="{{url('schoolemployee/mess/mess-fee-details')}}">Mess Fee Details</a></li>
                        <li><a href="{{url('schoolemployee/mess/mess-attendance')}}">Mess Attendance</a></li>
                    </ul>
                </li>    
                <li>
                    <a href="{{url('schoolemployee/view-profile')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Course </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schoolemployee/add-course')}}">Add Course</a></li>
                        <li><a href="{{url('schoolemployee/course-list')}}">Course List</a></li>
                     </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-calendar-event-fill"></i>
                        <span>Event</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schoolemployee/add-event')}}">Add Event</a></li>
                        <li><a href="{{url('schoolemployee/event-list')}}">Event List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Gallery</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schoolemployee/add-gallery')}}">Add Gallery</a></li>
                        <li><a href="{{url('schoolemployee/gallery-list')}}">Gallery List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-notification-2-fill"></i>
                        <span>Notice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schoolemployee/add-notice')}}">Add Notice</a></li>
                        <li><a href="{{url('schoolemployee/notice-list')}}">Notice List</a>
                        </li>
                    </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-notification-2-fill"></i>
                        <span>Enquiry</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schoolemployee/enquiry-list')}}">Enquiry List</a></li>
                       
                    </ul>
                 </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->