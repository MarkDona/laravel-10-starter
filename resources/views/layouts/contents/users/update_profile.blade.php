<div class="content-body">
<div class="row">
    <div class="col-12">

        <!-- profile -->
        <div class="card">
            <div class="card-header border-bottom">
                <h2>Update Profile</h2>
            </div>
            <div class="card-body py-2 my-25">
                <!-- header section -->
                <form id="update_profile" class="validate-form mt-2 pt-50" action="{{route('save_update_profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="center-layout">
                    @if($my_profile->avatar === null)
                        <a href="#" class="me-25">
                            <img src="{{asset('tms_resource/app-assets/images/portrait/small/avatar-s-11.jpg')}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                        </a>
                    @else
                        <a href="#" class="me-25">
                            <img src="{{asset($my_profile->avatar)}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                        </a>
                    @endif
                    <!-- upload and reset button -->
{{--                    <div class="d-flex align-items-end mt-75 ms-1">--}}
{{--                        <div>--}}
{{--                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>--}}
{{--                            <input type="file" id="account-upload" name="passport" hidden accept="image/*" />--}}
{{--                            <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!--/ upload and reset button -->
                </div>
                <!--/ header section -->

                <!-- form -->

                    <div class="row">
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="title">Title</label>
                            <select class="select2 form-select" id="title" name="title">
                                <option value="{{$my_profile->title}}" >{{$my_profile->title}}</option>
                                <option value="Mr." >Mr.</option>
                                <option value="Mrs." >Mrs.</option>
                                <option value="Miss" >Miss</option>
                                <option value="Dr." >Dr.</option>
                                <option value="Prof." >Prof.</option>
                                <option value="Ing." >Ing.</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="first_name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$my_profile->name}}" data-msg="Please enter full name" />
                        </div>
                        <div class="col-12 col-sm-4 mb-1">
                            <label class="form-label" for="accountEmail">Email</label>
                            <input type="email" class="form-control" id="accountEmail" name="email" value="{{$my_profile->email}}" readonly/>
                        </div>
                        <div class="col-12 col-sm-4 mb-2">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <input type="text" class="form-control account-number-mask" id="phone_number" name="phone_number"  value="{{$my_profile->phone_number}}" />
                        </div>
                        <div class="col-12 col-sm-4 mb-2">
                            <label class="form-label" for="department">Department</label>
                            <input type="text" class="form-control account-number-mask" id="department" name="department"  value="{{$my_profile->department}}" />
                        </div>
                        <div class="col-12 col-sm-4 mb-2">
                            <label class="form-label" for="field">Field</label>
                            <input type="text" class="form-control account-number-mask" id="field" name="field"  value="{{$my_profile->field}}" />
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-1 me-1">Update Profile</button>
                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
        </div>
{{--        <div class="card">--}}
{{--            <div class="card-header border-bottom">--}}
{{--                <h2>Change Password</h2>--}}
{{--            </div>--}}
{{--            <div class="card-body pt-1">--}}
{{--                <!-- form -->--}}
{{--                <form id="user_update_password" class="validate-form" action="{{route('update_user_password')}}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12 col-sm-6 mb-1">--}}
{{--                            <label class="form-label" for="account-old-password">Current password</label>--}}
{{--                            <div class="input-group form-password-toggle input-group-merge">--}}
{{--                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" data-msg="Please enter current password" />--}}
{{--                                <div class="input-group-text cursor-pointer">--}}
{{--                                    <i data-feather="eye"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12 col-sm-6 mb-1">--}}
{{--                            <label class="form-label" for="account-new-password">New Password</label>--}}
{{--                            <div class="input-group form-password-toggle input-group-merge">--}}
{{--                                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password" />--}}
{{--                                <div class="input-group-text cursor-pointer">--}}
{{--                                    <i data-feather="eye"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-sm-6 mb-1">--}}
{{--                            <label class="form-label" for="account-retype-new-password">Retype New Password</label>--}}
{{--                            <div class="input-group form-password-toggle input-group-merge">--}}
{{--                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" />--}}
{{--                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <p class="fw-bolder">Password requirements:</p>--}}
{{--                            <ul class="ps-1 ms-25">--}}
{{--                                <li class="mb-50">Minimum 8 characters long - the more, the better</li>--}}
{{--                                <li class="mb-50">At least one lowercase character</li>--}}
{{--                                <li>At least one number, symbol, or whitespace character</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <button type="submit" class="btn btn-primary me-1 mt-1">Update Password</button>--}}
{{--                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <!--/ form -->--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
 </div>

</div>
