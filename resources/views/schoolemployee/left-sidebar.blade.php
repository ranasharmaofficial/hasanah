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
                    <a href="{{url('schoolemployee/view-profile')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>View Profile</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->