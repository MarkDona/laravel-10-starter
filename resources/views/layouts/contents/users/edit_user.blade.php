<!-- Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Update <i class="text-success">{{$admin->title}} {{$admin->name}}</i>'s Details</h2>
                </div>
                <div class="card-body">
                    <form id="update_admin_users" class="form" method="POST" action="{{route('update_admin_users')}}">
                        @csrf
                        <input type="hidden" id="id" class="form-control"
                               value="{{$admin->id}}" name="id" />
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="title">Title</label>
                                    <select class="select2 form-select" id="title" name="title" required>
                                        <option value="{{$admin->title}}" >{{$admin->title}}</option>
                                        <option value="Mr." >Mr.</option>
                                        <option value="Mrs." >Mrs.</option>
                                        <option value="Miss" >Miss</option>
                                        <option value="Dr." >Dr.</option>
                                        <option value="Prof." >Prof.</option>
                                        <option value="Ing." >Ing.</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="phone_number">Phone</label>
                                    <input type="text" id="phone_number" class="form-control" name="phone_number"
                                           value="{{$admin->phone_number}}" required/>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="name">Full Name</label>
                                    <input type="text" id="name" class="form-control"
                                           value="{{$admin->name}}" name="name" required/>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="department">Department</label>
                                    <input type="text" id="department" class="form-control"
                                           value="{{$admin->department}}" name="department" required/>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" class="form-control"
                                           value="{{$admin->email}}" name="email" required/>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="field">Field</label>
                                    <input type="text" id="field" class="form-control"
                                           value="{{$admin->field}}" name="field" required/>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-4">
                                    <label class="form-label" for="title">Role</label>
                                    <select class="select2 form-select" id="role" name="role" required>
                                    <option>{{$admin->role ?? 'Select Role'}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" >{{$role->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1">Update Details</button>
                                <button type="reset" class="btn btn-outline-secondary me-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->
