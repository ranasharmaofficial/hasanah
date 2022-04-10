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
                        <i class="ri-file-user-fill"></i>
                        <span>Entrance Exam </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('schooladmin/form-pending')}}">Form Pending</a></li>
                        <li><a href="{{url('schooladmin/setSchedule')}}">Set Schedule</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('schooladmin/addclass')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span>Add Class</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('schooladmin/class-list')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span>Class List</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->