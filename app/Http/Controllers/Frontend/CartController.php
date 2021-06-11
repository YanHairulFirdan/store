<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\cart;
use App\DetailsTransaction;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
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

        $book        = Book::findOrFail($request->id);
        $existedBook = cart::where('book_id', $book->id)->where('user_id', auth()->id())->first();

        if ($existedBook) {
            $existedBook->amount += $request->amount;

            $existedBook->save();
        } else {
            $this->cartService->create($book, $request->amount);
        }

        return redirect()->route('cart.index');
    }

    public function updateCart(Request $request, Cart $cart)
    {
        $message        = '';
        $status         = false;
        $additionalInfo = '';
        $amount         = $request->amount;
        Log::info("amount of item = $request->amount");
        try {
            $message = $this->cartService->update($cart, $amount) ? 'Item\'s amount has been updated' : 'cannot updated item\' amount';
            $status  = true;
        } catch (\Exception $e) {
            $additionalInfo = $e->getMessage();
            $message = 'cannot update the amount of this item';
        }

        return response()->json([$message, $additionalInfo, $status]);
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

    public function delete(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
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

    public function saveProfileCheckout(Request $request, CartService $cartService)
    {

        $request->validate([
            'name'    => 'required|min:3',
            'phone'   => 'required|min:12',
            'address' => 'required|min:15'
        ]);

        try {
            $transaction                   = new Transaction();
            $transaction->user_id          = Auth::id();
            $transaction->invoice          = Str::random();
            $transaction->customer_name    = $request->name;
            $transaction->customer_phone   = $request->phone;
            $transaction->customer_address = $request->address;
            $transaction->status           = 'on process';

            $transaction->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $selectedItemId         = json_decode(request()->cookie('selectedCart'), true);
        $total                  = $cartService->checkout($selectedItemId, $transaction->id);
        $transaction->sub_total = $total;

        $transaction->save();

        return redirect()->route('transaction.index');
    }
}
