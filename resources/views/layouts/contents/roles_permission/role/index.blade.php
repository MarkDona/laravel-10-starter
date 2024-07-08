<!-- Permission Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <table class="datatables-roles table">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Role Name</th>
                <th>Guard</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($all_roles as $all_role)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$all_role->name}}</td>
                    <td>{{$all_role->guard_name}}</td>
                    <td>{{$all_role->created_at}}</td>
                    <td>
                        @can('Add Permission to Role')
                            <a href="{{ url('roles/'.$all_role->id.'/assign-permissions') }}" class="btn btn-outline-success btn-sm"><i data-feather='key'></i></a>
                        @endcan

                        @can('Update Role')
                            <a href="{{ url('roles/'.$all_role->id.'/edit') }}" class="btn btn-outline-primary btn-sm"><i data-feather='edit'></i></a>
                        @endcan
                        @can('Delete Role')
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deletePermission('{{ $all_role->id }}')"><i data-feather='trash-2'></i></button>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Permission Table -->
<!-- Add Permission Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Role</h1>
                </div>
                <form id="addRoleForm" class="row" action="{{url('roles')}}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Role Name" autofocus data-msg="Please enter role name" />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Role</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->

<script>
    function deletePermission(id, url) {
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
                    url: '{{url('roles/'.$all_role->id.'/delete')}}',
                    type: 'GET',
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
                            ).then(() => {
                                location.reload(); // Reload the page after the success message is closed
                            });
                        } else if(res.status === 403){
                            swalWithBootstrapButtons.fire(
                                'Error',
                                res.message,
                                'error'
                            ).then(() => {
                                location.reload(); // Reload the page after the error message is closed
                            });
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
</script>
