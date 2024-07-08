<!-- Permission Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <table class="datatables-perms table">
            <thead class="table-light">
            <tr>
                <th>Id</th>
                <th>Permission Name</th>
                <th>Guard</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($all_permissions as $all_permission)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$all_permission->name}}</td>
                    <td>{{$all_permission->guard_name}}</td>
                    <td>{{$all_permission->created_at}}</td>
                    <td>
                        @can('Update Permission')
                            <a href="{{ url('permissions/'.$all_permission->id.'/edit') }}" class="btn btn-outline-success btn-sm"><i data-feather='edit'></i></a>
                        @endcan
                        @can('Delete Permission')
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="deletePermission('{{ $all_permission->id }}')"><i data-feather='trash-2'></i></button>
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
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add New Permission</h1>
                </div>
                <form id="addPermissionForm" class="row" action="{{url('permissions')}}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Permission Name" autofocus data-msg="Please enter permission name" />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Create Permission</button>
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
                    url: '{{url('permissions/'.$all_permission->id.'/delete')}}',
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
                    'Your record is safe :)',
                    'error'
                )
            }
        })
    }
</script>
