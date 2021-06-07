<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $transactionCount = Transaction::count();
        $userCount = User::count();
        return view('admin.dashboard.index', compact('bookCount', 'userCount', 'transactionCount'));
    }
}
