
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('tms_resource/img/htulogo.png')}}" width="180px" alt="htu-logo">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <br><br>
    <br>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ (request()->segment(1) == "home") ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{route('home')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>

            @can('View Own Progress')
                @hasrole('Student')
                <li class="{{ (request()->segment(1) == "my-thesis-progress") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('student.view_progress')}}"><i data-feather='airplay'></i>
                        <span class="menu-item text-truncate" data-i18n="View Progress">View Progress</span></a>
                </li>
                @endhasrole
            @endcan

            @can('View Thesis')
                @hasrole('Supervisor')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book-open'></i><span class="menu-title text-truncate" data-i18n="Invoice">Thesis</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->segment(1) == "supervisor-all_thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('supervisor.all_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">All</span></a>
                        </li>
                        <li class="{{ (request()->segment(1) == "supervisor-uploaded_thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('supervisor.uploaded_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">Uploaded</span></a>
                        </li>
                        <li class="{{ (request()->segment(1) == "supervisor-assigned_thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('supervisor.assigned_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Preview">Assigned</span></a>
                        </li>
                        {{--                    <li class="{{ (request()->segment(1) == "pending-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('pending_thesis')}}"><i data-feather="circle"></i>--}}
                        {{--                            <span class="menu-item text-truncate" data-i18n="Edit">Pending</span></a>--}}
                        {{--                    </li>--}}
                        <li class="{{ (request()->segment(1) == "supervisor-marked_thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('supervisor.marked_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Add">Marked by Accessor</span></a>
                        </li>
                    </ul>
                </li>
                @else
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='book-open'></i><span class="menu-title text-truncate" data-i18n="Invoice">Thesis</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->segment(1) == "all-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('all_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">All</span></a>
                        </li>
                        <li class="{{ (request()->segment(1) == "uploaded-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('uploaded_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">Uploaded</span></a>
                        </li>
                        <li class="{{ (request()->segment(1) == "assigned-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('assigned_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Preview">Assigned</span></a>
                        </li>
                        {{--                    <li class="{{ (request()->segment(1) == "pending-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('pending_thesis')}}"><i data-feather="circle"></i>--}}
                        {{--                            <span class="menu-item text-truncate" data-i18n="Edit">Pending</span></a>--}}
                        {{--                    </li>--}}
                        <li class="{{ (request()->segment(1) == "marked-thesis") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('marked_thesis')}}"><i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Add">Marked by Accessor</span></a>
                        </li>
                    </ul>
                </li>
                @endhasrole
            @endcan
            @can('View Student')
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Students">Students</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(1) == "all-students") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{route('all_students')}}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="All Students">All Students</span></a>
                    </li>
                    <li class="{{ (request()->segment(1) == "active-students") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Active">Active</span></a>
                    </li>
                    <li class="{{ (request()->segment(1) == "completed-students") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Completed">Completed</span></a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('View Supervisor')
            <li class="{{ (request()->segment(1) == "all-supervisors") ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{route('supervisors')}}"><i data-feather='user-check'></i>
                    <span class="menu-title text-truncate" data-i18n="Supervisors">Supervisors</span></a>
            </li>
            @endcan
            @can('View Accessor')
            <li class="{{ (request()->segment(1) == "external-accessors") ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{route('external_accessors')}}"><i data-feather='user-plus'></i>
                    <span class="menu-title text-truncate" data-i18n="External Accessors">External Accessors</span></a>
            </li>
            @endcan
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Administration</span><i data-feather="more-horizontal"></i>
            </li>
            @can('View User')
            <li class="{{ (request()->segment(1) == "all-admins") ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{route('get_all_users')}}"><i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="All Users">All Users</span></a>
            </li>
            @endcan
            @can('Assign Role to User')
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='award'></i>
                    <span class="menu-title text-truncate" data-i18n="Roles & Permissions">Roles & Permissions</span></a>
                <ul class="menu-content">
                    @can('View Permission')
                    <li class="{{ (request()->segment(1) == "permissions") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{url('permissions')}}"><i data-feather='shield'></i>
                            <span class="menu-item text-truncate" data-i18n="Permissions">Permissions</span></a>
                    </li>
                    @endcan
                    @can('View Role')
                    <li class="{{ (request()->segment(1) == "roles") ? 'active' : '' }}" ><a class="d-flex align-items-center" href="{{url('roles')}}"><i data-feather='toggle-left'></i>
                            <span class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('View Activity Logs')
            <li class="{{ (request()->segment(1) == "activity-logs") ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{route('activity_logs')}}"><i data-feather='activity'></i>
                    <span class="menu-title text-truncate" data-i18n="Activity Logs">Activity Logs</span></a>
            </li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
