<?php

namespace App\Services;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\URL;

class BookService
{
    public function store(BookRequest $bookRequest, Book $book)
    {
        $path                   = public_path('storage/image/');
        $book->title            = $bookRequest->title;
        $book->category_id      = $bookRequest->category_id;
        $book->writer           = $bookRequest->writer;
        $book->publication_year = $bookRequest->publication_year;
        $book->publisher        = $bookRequest->publisher;
        $book->description      = $bookRequest->description;
        $book->price            = $bookRequest->price;
        $book->weight           = $bookRequest->weight;
        $newImage               = $bookRequest->file('image');
        $book->stock            = $bookRequest->stock;
        $book->image            = $newImage->getClientOriginalName();

        $newImage->move($path, $book->image);

        $saved = $book->save();

        return $saved;
    }
}
