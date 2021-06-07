<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();

        return view('frontend.transaction.index', compact('transactions'));
    }
}
