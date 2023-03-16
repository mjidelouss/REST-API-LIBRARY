<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $currentUser = Auth::user();

        if (!$currentUser->can('delete every profile') && $currentUser->id != $user->id){
            return response()->json([
                'Message' => "You don't have the permissions to update this profile"
            ], 403);
        }
        $request['password'] = Hash::make($request->password);
        $user->update($request->all());

        return response([
            'Message' => 'Profile updated successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if (!$currentUser->can('delete every profile') && $currentUser->id != $user->id){
            return response()->json([
                'Message' => "You don't have the permissions to delete this profile"
            ], 403);
        }

        $user->delete();
        return response()->json([
            'Message' => 'Profile deleted successfully!',
        ], 200);
    }
}
