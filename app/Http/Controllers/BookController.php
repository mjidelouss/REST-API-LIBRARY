<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
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
        $books = Book::all();

        return response()->json([
            'status' => 'success',
            'Books' => $books,
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
        $user = Auth::user();
        $book = Book::create($request->all() + ['user_id' => $user->id]);

        return response()->json([
            'status' => 'success',
            'Message' => 'Book added successfully!',
            'Book' => $book,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            $response = response()->json($book, 200);
        } else {
            $response = response()->json([
                'message' => "Book with #$id not Found!!"
            ]);
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $book = Book::find($id);

        if(!$book){
            return response()->json(['message' => "Book with #$id not Found!!"]);
        }
        $book->update($request->all());

        return response()->json([
            'status' => 'success',
            'Message' => 'Book updated Successfully!!',
            'book' => $book,
        ], 200);
    }
    
    public function filter($gen)
    {
        $genre = Genre::where('name', $gen)->firstOrFail();
        $books = Book::where('genre_id', $genre->id)->get();
        return response()->json($books);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if(!$book){
            return response()->json(['message' => "Book with #$id not Found!!"]);
        }
        $book->delete();

        return response()->json([
            'status' => 'success',
            'Message' => 'Book deleted Successfully!!'
        ], 200);
    }
}