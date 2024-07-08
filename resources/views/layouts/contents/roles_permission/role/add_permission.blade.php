<!-- Permission Table -->
<div class="card">
    <div class="card-datatable table-responsive">
        <div class="modal-body px-sm-5 pb-5">
            <div class="text-center mb-4">
                <h1 class="role-title">Assign Permission</h1>
                <h3 class="text-success">Role : {{$role->name}}</h3>
            </div>
            <form id="assignPermission" class="row" action="{{url('roles/'.$role->id.'/assign-permissions')}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <h4 class="mt-2 pt-50">Add Permissions Role</h4>
                    <br>
                </div>
                @foreach($permissions as $permission)
                <div class="col-3">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{$permission->name}}"
                    {{ in_array( $permission->id, $rolePermissions) ? 'checked' : ''}}/>
                    <label class="form-check-label" for="userManagementCreate"> {{$permission->name}} </label>
                </div><br><br>
                @endforeach
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                        Discard
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
