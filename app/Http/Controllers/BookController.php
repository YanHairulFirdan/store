<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{

    protected $rules = [
        'title' => 'required|min:5',
        'writer' => 'required|min:5',
        'publication_year' => 'required',
        'publisher' => 'required|min:5',
        'description' => 'required|min:10',
        'price' => 'required',
        'weight' => 'required',
        'stock' => 'required',
    ];
    protected $messages = [
        'title.min' => 'Jumlah Karakter tidak boleh kurang dari 5',
        'writer.min' => 'Jumlah Karakter tidak boleh kurang dari 5',
        'publisher.min' => 'Jumlah Karakter tidak boleh kurang dari 5',
        'dascription.min' => 'Jumlah Karakter tidak boleh kurang dari 5',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatioresult = $this->validationData($request->all());
        if ($validatioresult) {
            return response()->json(['error_messages', $validatioresult]);
        }

        $book = new Book();

        $saveResult = $this->saveBook($book, $request);
        $message = ($saveResult) ? 'data berhasil ditambahkan' : 'data gagal ditambahkan';
        return response()->json(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $validatioresult = $this->validationData($request->all());
        if ($validatioresult) {
            return response()->json(['error_messages', $validatioresult]);
        }

        $saveResult = $this->saveBook($book, $request);
        $message = ($saveResult) ? 'data berhasil diperbaharui' : 'data gagal diperbaharui';
        return response()->json(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $deleted = $book->delete();
        $message = ($deleted) ? 'data berhasil dihapus' : 'data gagal dihapus';
        return response()->json(['message' => $message]);
    }

    protected function validationData($data)
    {
        $validator = validator(
            $data,
            $this->rules,
            $this->messages
        );

        return ($validator->fails()) ? $validator->errors() : null;
    }

    protected function saveBook(Book $book, Request $request)
    {
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->publication_year = $request->publication_year;
        $book->publisher = $request->publisher;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->weight = $request->weight;
        $book->stock = $request->stock;

        return $book->save();
    }
}
