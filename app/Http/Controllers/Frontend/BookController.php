<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        $openingTag = '<div class="row my-4">';
        $closingTag = '</div>';

        return view('frontend.books', compact('books', 'openingTag', 'closingTag'));
    }

    public function details(Book $book)
    {
        $categories = Category::get();
        return view('frontend.details', compact('book', 'categories'));
    }

    public function getByCategory($categoryName)
    {
        $openingTag = '<div class="row mt-2">';
        $closingTag = '</div>';
        $categoryName = str_replace("&", ' ', $categoryName);

        $category = Category::where('name', 'like', '%' . $categoryName)->first();
        $books = $category->books()->get();

        return view('frontend.category', compact('category', 'openingTag', 'closingTag', 'books'));
    }
}
