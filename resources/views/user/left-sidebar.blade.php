<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu userbackcolor">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">USER Menu</li>
                 <li>
                    <a href="{{url('user/home')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Project</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('user/project-request')}}">Project Request</a></li>
                        <li><a href="{{url('user/my-project')}}">My Project</a></li>
                        <li><a href="{{url('user/ongoing-project')}}">Ongoing Project</a></li>
                        <li><a href="{{url('user/completed-project')}}">Completed Project</a></li>
                     </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-fill"></i>
                        <span>Wallet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('user/mywallet')}}">My Wallet</a></li>
                        <li><a href="{{url('user/wallet-history')}}">Wallet History</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="{{url('user/my-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>My Project</span>
                    </a>
                </li> --}}
                {{-- <li>
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
                </li>--}}
                {{-- <li>
                    <a href="{{url('distributor/view-project')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>View Project</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{url('user/view-profile')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>View Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/update-profile')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Update Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/bank-details')}}" class="waves-effect">
                        <i class="ri-file-user-fill"></i>
                        <span>Bank Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('user/change-password')}}" class="waves-effect">
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