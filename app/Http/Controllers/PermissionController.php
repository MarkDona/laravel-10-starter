<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Viewed permissions page',
            'user_ip' => $userIpAddress,
        ]);

        $all_permissions = Permission::get();
        return view('pages.roles_permission.permission.index', compact('all_permissions'));
    }


    public function store(Request $request)
    {
        $userIpAddress = $request->ip();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Created Permission with the name: '.$request->name,
            'user_ip' => $userIpAddress,
        ]);

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name',
            ]
        ]);

        Permission::create([
            'name' => $request->name,
        ]);
        return response()->json(['status' => 201, 'message' => 'Permission created Successfully.']);
    }


    public function edit(Request $request, Permission $permission)
    {
        $userIpAddress = $request->ip();
        $perms = Permission::all()->where('id', $permission->id)->first();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Viewed Edit Permission page of: '.$perms,
            'user_ip' => $userIpAddress,
        ]);

        return view('pages.roles_permission.permission.edit',[
            'permission' => $permission
        ]);
    }


    public function update(Request $request, Permission $permission)
    {
        $userIpAddress = $request->ip();
        $perms = Permission::all()->where('id', $permission->id)->first();

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Updated permission with details '.$perms,
            'user_ip' => $userIpAddress,
        ]);

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id,
            ]
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return response()->json(['status' => 201, 'message' => 'Permission updated Successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $permissionID)
    {
        $userIpAddress = $request->ip();
        $perms = Permission::all()->where('id', $permissionID)->first();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity_performed' => 'Deleted permission with the details: '.$perms,
            'user_ip' => $userIpAddress,
        ]);


        if (Permission::find($permissionID)->delete()) {

            return response()->json(['status' => 200, 'message' => 'Permission deleted successfully!']);
        }
        return false;
    }
}
