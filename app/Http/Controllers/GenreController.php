<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
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
        $genres = Genre::all();
        return response()->json([
            'status' => 'success',
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $genre = Genre::create($request->all());
        return response()->json([
            'status' => 'success',
            'Message' => "Genre has been added successfully!",
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        if(!$genre){
            return response()->json([
                'Message' => "Genre with #$id not Found!!"
            ]);
        }
        return response()->json([
            'status' => 'success',
            'Genre' => $genre->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'Message' => "Genre with #$id not Found!!"
            ]);
        }
        $genre->update($request->all());

        return response()->json([
            'status' => 'success',
            'Message' => "Genre has been updated Successfully!!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                'Message' => "Genre with #$id not Found!!"
            ]);
        }
        $genre->delete();

        return response()->json([
            'status' => 'success',
            'Message' => "Genre has been Deleted Successfully!!",
        ], 200);
    }
}