<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Viewed roles page',
            'user_ip' => $userIpAddress,
        ]);

        $all_roles = Role::all()->where('name', '!=', 'Super Admin');;
        return view('pages.roles_permission.role.index', compact('all_roles'));
    }

    public function store(Request $request)
    {
        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Created Role with the name: '.$request->name,
            'user_ip' => $userIpAddress,
        ]);

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name',
            ]
        ]);

        Role::create([
            'name' => $request->name,
        ]);
        return response()->json(['status' => 201, 'message' => 'Role created Successfully.']);
    }


    public function edit(Request $request, Role $role)
    {
        $userIpAddress = $request->ip();
        $perms = Role::all()->where('id', $role->id)->first();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Viewed Edit Role page of: '.$perms,
            'user_ip' => $userIpAddress,
        ]);

        return view('pages.roles_permission.role.edit',[
            'role' => $role
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $userIpAddress = $request->ip();
        $perms = Role::all()->where('id', $role->id)->first();

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Updated role with details '.$perms,
            'user_ip' => $userIpAddress,
        ]);

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id,
            ]
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return response()->json(['status' => 201, 'message' => 'Role updated Successfully.']);

    }


    public function destroy(Request $request, $roleID)
    {
        $userIpAddress = $request->ip();
        $role = Role::findOrFail($roleID);

        // Log the activity before deletion
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Deleted role with the details: ' . $role->toJson(),
            'user_ip' => $userIpAddress,
        ]);

        if ($role->delete()) {
            return response()->json(['status' => 200, 'message' => 'Role deleted successfully!']);
        }

        return response()->json(['status' => 403, 'message' => 'You do not have the permission to delete!']);
    }

    public function assignPermissionToRole(Request $request, $roleID)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleID);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Viewed assign permission to role page for role: '.$role,
            'user_ip' => $userIpAddress,
        ]);

        return view('pages.roles_permission.role.add_permission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissionToRole(Request $request, $roleID)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);

        $role = Role::findOrFail($roleID);

        $permissions = implode(', ', $request->permission);
        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Assigned permissions to role: '.$role.' with permissions '.$permissions,
            'user_ip' => $userIpAddress,
        ]);

        $role->syncPermissions($request->permission);

        return response()->json(['status' => 200, 'message' => 'Permission assigned successfully!']);
    }
}
