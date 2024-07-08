<!-- Basic table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="datatables-admins table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Profile Pic</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($all_users as $all_user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{asset($all_user->avatar)}}" alt="profile-pic" width="50px">
                            </td>
                            <td>{{$all_user->title}} {{$all_user->name}}</td>
                            <td>{{$all_user->phone_number}}</td>
                            <td>{{$all_user->email}}</td>
                            <td>
                                @if($all_user->role !== null)
                                    {{$all_user->role}}
                                @else
                                    No Role
                                @endif
                            </td>
                            <td>
                                @can('Update User')
                                <a href="{{ route('show_admin', $all_user->id) }}" class="btn btn-outline-success btn-sm"><i data-feather='edit'></i></a>
                                @endcan
                                @can('Delete User')
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deleteAdmin('{{ $all_user->id }}')"><i data-feather='trash-2'></i></button>
                                @endcan
                                @if($all_user->approved === 1)
                                    @can('Block Supervisor')
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="blockAdmin('{{ $all_user->id }}')"><i data-feather='eye-off'></i></button>
                                    @endcan
                                @else
                                    @can('Approve Supervisor')
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="approveAdmin('{{ $all_user->id }}')"><i data-feather='eye'></i></button>
                                    @endcan
                                @endif
                                @can('Assign Role to User')
                                <button type="button" class="btn btn-outline-success btn-sm" onclick="setUserId('{{ $all_user->id }}')" data-bs-toggle="modal" data-bs-target="#assign_modal"><i data-feather='check-circle'></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form id="create_admin" class="modal-content pt-0" action="{{route('create_admin')}}" method="POST">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h3 class="modal-title" id="exampleModalLabel">Add Administrator</h3>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="title">Title</label>
                        <select class="select2 form-select" id="title" name="title" required>
                            <option>Choose Title</option>
                            <option value="Mr." >Mr.</option>
                            <option value="Mrs." >Mrs.</option>
                            <option value="Miss" >Miss</option>
                            <option value="Dr." >Dr.</option>
                            <option value="Prof." >Prof.</option>
                            <option value="Ing." >Ing.</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" class="form-control dt-full-name" id="name" name="name" placeholder="name" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control dt-email" name="email"
                               placeholder="john.doe@example.com" aria-label="john.doe@example.com" required />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="phone_number">Phone Number</label>
                        <input type="text" class="form-control dt-full-name" id="phone_number" name="phone_number" placeholder="Phone Number" aria-label="John Doe" required />
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="role">Role</label>
                        <select class="select2 form-select" id="role" name="role" required>
                            <option>Choose Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="assign_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalCenterTitle">Assign Role</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="assign_role" class="modal-content pt-0" action="{{route('assign_role')}}" method="POST">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="modal-body flex-grow-1">
                            <div class="mb-1">
                                <select class="select2 form-select" id="role" name="role" required>
                                    <option>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary me-1">Assign Role</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Basic table -->

<script>

    function setUserId(userId) {
        document.getElementById('user_id').value = userId;
    }

    function deleteAdmin(id, url) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('destroy_admin') }}',
                    type: 'DELETE',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 200) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                res.message,
                                'success'
                            )
                            refresh()
                        }
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your record is safe :)',
                    'error'
                )
            }
        })
    }

    function approveAdmin(id, url) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mr-2',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You are trying to make this user as an admin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve!',
            adminButtonText: 'Yes, approve!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('approve_admin') }}',
                    type: 'PATCH',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 200) {
                            swalWithBootstrapButtons.fire(
                                'Approved!',
                                res.message,
                                'success'
                            )
                            location.reload();
                        }
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Approve Action Suspended',
                    'error'
                )
            }
        })
    }

    function blockAdmin(id, url) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You are trying to disable this admin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, disable!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('block_admin') }}',
                    type: 'PATCH',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status === 200) {
                            swalWithBootstrapButtons.fire(
                                'Blocked!',
                                res.message,
                                'success'
                            )
                            location.reload();
                        }
                    }
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Disable Action Suspended',
                    'error'
                )
            }
        })
    }

    function refresh() {
        setTimeout(() => location.reload(), 3000)
    }

</script>
