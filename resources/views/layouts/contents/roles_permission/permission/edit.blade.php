<!-- Permission Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <div class="modal-body px-sm-5 pb-5">
            <div class="text-center mb-2">
                <h1 class="mb-1">Update Permission</h1>
            </div>
            <form id="editPermission" class="row" action="{{url('permissions/'.$permission->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-8">
                    <label class="form-label" for="modalPermissionName">Permission Name</label>
                    <input type="text" id="name" name="name" value="{{ $permission->name }}" class="form-control" placeholder="Permission Name" autofocus data-msg="Please enter permission name" />
                </div>
                <div class="col-8 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1">Update Permission</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                        Discard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
