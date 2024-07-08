
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('app_assets/img/htulogo.png')}}" width="180px" alt="htu-logo">
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


            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Administration</span><i data-feather="more-horizontal"></i>
            </li>
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
