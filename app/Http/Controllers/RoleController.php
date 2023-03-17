<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'status' => 'success',
            'roles' => $roles
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Role added successfully!',
            'role' => $role
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show($id)
    {
        $role = Role::find($id);
        if(!$role){
            return response()->json([
                'message' => 'Role Not Found!!'
            ]);
        }
        return response()->json([
            'status' => 'success',
            'role' => $role->name
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if(!$role){
            return response()->json([
                'message' => 'Role Not Found!!'
            ]);
        }
        $role->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully!',
            'role' => $role,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if(!$role){
            return response()->json([
                'message' => 'Role Not Found!!'
            ]);
        }

        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'Role deleted successfully!',
        ], 200);
    }

    public function assignRole(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user)
        {
            return response()->json([
                'Message' => 'This user doesn\'t exist!'
            ]);
        }

        $user->syncRoles([$request->name]);

        return response()->json([
            'Message' => 'Role assigned Successfully!!',
        ]);
    }

    public function removeRole(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'Message' => "This user doesn't exist!"
            ]);
        }

        $roleName = $request->name;

        if(!$user->hasRole($roleName)){
            return response()->json([
                'Message' => "This user doesn't have #$roleName role!"
            ]);
        }

        $user->removeRole($roleName);

        return response()->json([
            'Message' => 'Role Removed Successfully!!',
        ]);
    }
}
