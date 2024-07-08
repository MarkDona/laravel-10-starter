<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>Welcome, {{Auth::user()->name}}</h5>
                    <p class="card-text font-small-3"></p>
                    <h3 class="mb-75 mt-2 pt-50">

                    </h3>
                    <img src="{{asset('tms_resource/app-assets/images/illustration/badge.svg')}}" class="congratulation-medal" alt="Medal Pic" />
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('Supervisor'))

        <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder">Thesis Statistics</h3>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 5 seconds ago</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i data-feather="file" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$uploaded_supervisor}}</h4>
                                        <p class="card-text font-small-3 mb-0">Uploaded</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i data-feather="file-text" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$assigned_supervisor}}</h4>
                                        <p class="card-text font-small-3 mb-0">Assigned</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i data-feather="book" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$marked_supervisor}}</h4>
                                        <p class="card-text font-small-3 mb-0">Marked</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        @elseif(Auth::user()->hasRole('Student'))
            <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder">My Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 5 seconds ago</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
{{--                                    <div class="avatar bg-light-primary me-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="file" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="my-auto">
{{--                                        <h4 class="fw-bolder mb-0">{{$uploaded}}</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">Uploaded</p>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
{{--                                    <div class="avatar bg-light-info me-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="file-text" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="my-auto">
{{--                                        <h4 class="fw-bolder mb-0">{{$assigned}}</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">Assigned</p>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="d-flex flex-row">
{{--                                    <div class="avatar bg-light-success me-2">--}}
{{--                                        <div class="avatar-content">--}}
{{--                                            <i data-feather="book" class="avatar-icon"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="my-auto">
{{--                                        <h4 class="fw-bolder mb-0">{{$marked}}</h4>--}}
{{--                                        <p class="card-text font-small-3 mb-0">Marked</p>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        @else
            <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder">Thesis Statistics</h3>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">Updated 5 seconds ago</p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i data-feather="file" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$uploaded}}</h4>
                                        <p class="card-text font-small-3 mb-0">Uploaded</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-info me-2">
                                        <div class="avatar-content">
                                            <i data-feather="file-text" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$assigned}}</h4>
                                        <p class="card-text font-small-3 mb-0">Assigned</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2">
                                        <div class="avatar-content">
                                            <i data-feather="book" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0">{{$marked}}</h4>
                                        <p class="card-text font-small-3 mb-0">Marked</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
        @endif
    </div>

</section>
<!-- Dashboard Ecommerce ends -->
