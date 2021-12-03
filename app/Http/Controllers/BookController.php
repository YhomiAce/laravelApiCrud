<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
        "status" => "success",
        "status_code"=> 200,
        "data" => $books
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'isbn' => 'required',
        'authors' => 'required',
        'country' => 'required',
        'number_of_pages' => 'required',
        'publisher' => 'required',
        'release_date' => 'required|date_format:Y-m-d',
        ]);
        if($validator->fails()){
        return response()->json($validator->errors());
        }
        $product = Book::create($input);
        return response()->json([
        "status" => "success",
        "status_code"=> 201,
        "data" => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        if (is_null($book)) {
            return $this->response()->json([
                "status" => "failure",
                "status_code"=> 404,
                "message" =>"Book not found."
            ], 404);
        }
        return response()->json([
        "status" => "success",
        "status_code"=> 200,
        "data" => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $input = $request->all();

        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'isbn' => 'required',
        'authors' => 'required',
        'country' => 'required',
        'number_of_pages' => 'required',
        'publisher' => 'required',
        'release_date' => 'required|date_format:Y-m-d',
        ]);
        if($validator->fails()){
        return response()->json($validator->errors());
        }

        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->authors = $request->authors;
        $book->country = $request->country;
        $book->number_of_pages = $request->number_of_pages;
        $book->publisher = $request->publisher;
        $book->release_date = $request->number_of_pages;

        $book->save();
        $name = $book->name;
        return response()->json([
        "status" => "success",
        "status_code"=> 200,
        "message" => "The book, $name was updated successfully.",
        "data" => $book
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id)->delete();
        return response()->json([
        "status_code"=> 204,
        "status" => "success",
        "message" => "The book was deleted successfully.",
        "data" => []
        ]);
    }
}
