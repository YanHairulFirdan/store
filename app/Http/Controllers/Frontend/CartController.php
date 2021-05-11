<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\cart;
use App\Http\Controllers\Controller;
use App\Models\Regency;
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
        // check if book exist inside cart
        if (cart::where('book_id', $book->id)->exists()) {
            // if exist 
            // get the item
            $existedBook = cart::where('book_id', $book->id)->where('user_id', auth()->id())->first();
            // add quantity of the item insie chart by amount value
            $existedBook->amount += $request->amount;
            // save chart
            $existedBook->save();
        } else {
            // else
            // create new cart
            $cartItem            = new cart();
            $cartItem->book_id   = $book->id;
            $cartItem->user_id   = auth()->id();
            $cartItem->price     = $book->price;
            $cartItem->amount     = $request->amount;
            // save the cart
            $result = $cartItem->save();
        }

        // redirect to cart

        return redirect()->route('cart.index');
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

        return redirect()->route('profile.checkout');
    }

    public function profileCheckout()
    {
        $cities = Regency::get();
        return view('frontend.checkout2', compact('cities'));
    }
}
