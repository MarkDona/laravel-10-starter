<!-- Permission Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <div class="modal-body px-sm-5 pb-5">
            <div class="text-center mb-2">
                <h1 class="mb-1">Update Role</h1>
            </div>
            <form id="editRole" class="row" action="{{url('roles/'.$role->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-8">
                    <label class="form-label" for="modalRoleName">Permission Name</label>
                    <input type="text" id="name" name="name" value="{{ $role->name }}" class="form-control" placeholder="Role Name" autofocus data-msg="Please enter role name" />
                </div>
                <div class="col-8 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1">Update Role</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                        Discard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
