<?php

namespace App\Services;

use App\Book;
use App\Http\Requests\BookRequest;

class BookService
{
    public function update(BookRequest $bookRequest, Book $book)
    {
        $book->title            = $bookRequest->title;
        $book->category_id      = $bookRequest->category_id;
        $book->writer           = $bookRequest->writer;
        $book->publication_year = $bookRequest->publication_year;
        $book->publisher        = $bookRequest->publisher;
        $book->description      = $bookRequest->description;
        $book->price            = $bookRequest->price;
        $book->weight           = $bookRequest->weight;
        $book->stock            = $bookRequest->stock;
        $book->image            = $bookRequest->image;
    }
}
