<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\cart;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts;
        $total = $carts->sum('amount');
        return view('frontend.cart', compact('carts', 'total'));
    }
    public function addBook(Request $request)
    {
        $request->validate([
            'id'        => 'required',
            'amount'    => 'required|min:1'
        ]);

        $book            = Book::findOrFail($request->id);
        $cart            = new cart();
        $cart->book_id   = $book->id;
        $cart->user_id   = auth()->id();
        $cart->price     = $book->price;
        $cart->amount     = $request->amount;
        $result = $cart->save();

        return redirect()->back();
    }

    public function inputOrder(Request $request)
    {
        $arrayOfCart = [];
        $request->validate([
            'selected.*' => 'required'
        ]);
        foreach ($request->selected as $key => $selectedItem) {
            if (Book::where('id', $selectedItem)->exists()) {
                array_push($arrayOfCart, $selectedItem);
            }
        }
        cookie('selectedCart', json_encode($arrayOfCart), 1440);
    }
}
