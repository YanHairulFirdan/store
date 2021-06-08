<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Exists;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->paginate(15);

        return view('admin.book.index', compact('books'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book       = Book::findOrFail($id);
        $categories = Category::get();

        return view('admin.book.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $bookRequest, Book $book)
    {
        $oldImage  = str_replace('\\', '/', public_path('\storage\image\\' .  $book->image));
        $validated = $bookRequest->validated();

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        // dd('ok');
        $updated   = $this->bookService->update($bookRequest, $book);

        if ($updated) {
            $message = 'book has been updated successfully';
            $class   = 'success';
        } else {
            $message = 'failed to update the book';
            $class   = 'danger';
        }

        return redirect()->route('book.index')->with(['message' => $message, 'class' => $class]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
