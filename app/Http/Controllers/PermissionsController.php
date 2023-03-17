<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function assignPermission(Request $request, $roleName)
    {
        $permission = $request->permission;

        $role = Role::where('name', $roleName)->firstOrFail();

        $role->syncPermissions($permission);

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions assigned successfully!',
        ]);

    }

    public function removePermission(Request $request, $roleName)
    {
        $permissions = $request->permissions;

        $role = Role::where('name', $roleName)->firstOrFail();

        foreach ($permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions removed successfully!',
        ]);
    }
}
