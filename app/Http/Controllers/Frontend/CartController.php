<?php

namespace App\Http\Controllers\Frontend;

use App\Book;
use App\cart;
use App\DetailsTransaction;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $book        = Book::findOrFail($request->id);
        $existedBook = cart::where('book_id', $book->id)->where('user_id', auth()->id())->first();
        if ($existedBook) {
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

        $selectedItemId = json_decode(request()->cookie('selectedCart'), true);
        $total          = 0;

        foreach ($selectedItemId as $key => $id) {
            $item   = Auth::user()->carts->find($id);
            $total += $item->price * $item->amount;

            DetailsTransaction::create([
                'transaction_id' => $transaction->id,
                'book_id'        => $item->book->id,
                'quantity'       => $item->amount,
                'price'          => $item->price,
                'weight'         => $item->book->weight
            ]);

            $item->delete();
        }
        $transaction->sub_total = $total;

        $transaction->save();

        return redirect()->route('transaction.index');
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

    public function checkout()
    {
        $selectedItemId  = json_decode(request()->cookie('selectedCart'), true);
        $customerProfile = json_decode(request()->cookie('profileCheckout'), true);
        $total           = 0;
        $invoice         = random_bytes(64);

        foreach ($selectedItemId as $key => $id) {
            $item                        = Auth::user()->carts->find($id);
            $total                      .= $item->price * $item->amount;
            $detailTransaction           = new DetailsTransaction();
            $detailTransaction->book_id  = $item->book->id;
            $detailTransaction->quantity = $item->amount;
            $detailTransaction->price    = $item->price * $item->amount;
            $detailTransaction->weight   = $item->quantity * $item->amount;

            $detailTransaction->save();
        }

        $transaction                   = new Transaction();
        $transaction->user_id          = Auth::id();
        $transaction->invoice          = $invoice;
        $transaction->customer_name    = $customerProfile['name'];
        $transaction->customer_phone   = $customerProfile['phone'];
        $transaction->customer_address = $customerProfile['address'];
        $transaction->sub_total        = $total;

        $transaction->save();

        request()->session()->forget('profileCheckout');
        request()->session()->forget('deliveryMethod');
        request()->session()->forget('paymentMethod');

        return redirect()->route('home');
    }
}
