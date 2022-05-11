<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{url('schooladmin/home')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span
                            class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Student </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/student-list')}}">Student List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-list-3-fill"></i>
                        <span>Entrance Exam </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/form-pending')}}">Form Pending</a></li>
                        <li><a href="{{url('schooladmin/setSchedule')}}">Set Schedule</a></li>
                        <li><a href="{{url('schooladmin/schedulelist')}}">Schedule List</a></li>
                        <li><a href="{{url('schooladmin/entrance-result')}}">Publish Result</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Class </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/addclass')}}">Add Class</a></li>
                        <li><a href="{{url('schooladmin/class-list')}}">Class List</a></li>
                    </ul>
                </li>
                <li>
                   <a href="javascript: void(0);" class="has-arrow waves-effect">
                       <i class="ri-file-list-line"></i>
                       <span>Academic Year</span>
                   </a>
                   <ul class="sub-menu" aria-expanded="true">
                       <li><a href="{{url('schooladmin/add-academic-year')}}">Add Academic Year</a></li>
                       {{-- <li><a href="{{url('admin/academic-list')}}">Academic List</a></li> --}}
                   </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i>FP</i>
                        <span>Fix Payment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{url('schooladmin/fix-admission-fee')}}">Fix Admission Fee</a></li>
                        <li><a href="{{url('schooladmin/admission-fee-list')}}">Admission Fee List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-building-fill"></i>
                        <span>School </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/addschool')}}">Add School</a></li>
                        <li><a href="{{url('schooladmin/school-list')}}">School List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-building-fill"></i>
                        <span>Employee </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/add-employee')}}">Add Employee</a></li>
                        <li><a href="#">Employee List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-building-fill"></i>
                        <span>Teacher </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/teacher-category')}}">Add Teacher Category</a></li>
                        <li><a href="{{url('schooladmin/add-teacher')}}">Add Teacher</a></li>
                        <li><a href="#">Teacher List</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->