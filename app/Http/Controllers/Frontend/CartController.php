<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'id'     => 'required',
            'amount' => 'required|min:1'
        ]);

        $book = Book::findOrFail($request->id);

        if (cart::where('book_id', $book->id)->exists()) {
            $existedBook          = cart::where('book_id', $book->id)->where('user_id', auth()->id())->first();
            $existedBook->amount += $request->amount;

            $existedBook->save();
        } else {
            $cartItem          = new cart();
            $cartItem->book_id = $book->id;
            $cartItem->user_id = auth()->id();
            $cartItem->price   = $book->price;
            $cartItem->amount  = $request->amount;
            $result            = $cartItem->save();
        }

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
        
        
        $cookie = cookie('selectedCart', json_encode($arrayOfCart), 1440);

        return redirect()->route('profile.checkout')->cookie($cookie);
    }

    public function profileCheckout()
    {
        $orderSubtotal       = Auth::user()->carts->sum(function ($cart) {

            return $cart['price'] * $cart['amount'];
        });

        $shippingAndHandling = 100;
        $total               = $orderSubtotal + $shippingAndHandling;
        return view('frontend.checkout2', compact('orderSubtotal', 'shippingAndHandling', 'total'));
    }

    public function saveProfileCheckout(Request $request)
    {
        
        $request->validate([
            'name'    => 'required|min:3',
            'phone'   => 'required|min:12',
            'address' => 'required|min:15'
        ]);

        $cookie = cookie('profileCheckout', json_encode($request->except('_token')), 1440);

        return redirect()->route('checkout.delivery')->cookie($cookie);
    }

    public function showDeliveryType()
    {
        return view('frontend.delivery');
    }
    public function saveDeliveryType(Request $request)
    {
        $request->validate([
            'delivery' => 'required'
        ]);

        $cookie = cookie('deliveryMethod', json_encode($request->except('_token')), 1440);

        return redirect()->route('checkout.payment')->cookie($cookie);
    }

    public function showPaymentType()
    {
        return view('frontend.payment');
    }
    public function savePaymentType(Request $request)
    {
        $request->validate([
            'payment' => 'required'
        ]);
        $cookie = cookie('paymentMethod', json_encode($request->except('_token')), 1440);

        return redirect()->route('checkout.review')->cookie($cookie);
    }
    public function showReview()
    {
        $selectedItems  = [];
        $selectedItemId = json_decode(request()->cookie('selectedCart'), true);
        $total          = 0;

        foreach ($selectedItemId as $key => $id) {
            $item   = Auth::user()->carts->find($id);
            $total += $item->price * $item->amount;
            array_push($selectedItems, $item);
        }

        return view('frontend.reviewcheckout', compact('selectedItems', 'total'));
    }
    public function saveReview()
    {

        return redirect()->route('checkout.reviewcheckout');
    }
}
