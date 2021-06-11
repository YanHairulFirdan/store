<?php

namespace App\Services;

use App\Book;
use App\cart;
use App\DetailsTransaction;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function create(Book $book, int $amount)
    {
        $cartItem          = new cart();
        $cartItem->book_id = $book->id;
        $cartItem->user_id = auth()->id();
        $cartItem->price   = $book->price;
        $cartItem->amount  = $amount;
        $result            = $cartItem->save();
    }

    public function checkout(array $ids, int $transaction_id)
    {
        $total = 0;

        foreach ($ids as $key => $id) {
            $item               = Auth::user()->carts->find($id);
            $total             += $item->price * $item->amount;
            $item->book->stock -= $item->amount;
            DetailsTransaction::create([
                'transaction_id' => $transaction_id,
                'book_id'        => $item->book->id,
                'quantity'       => $item->amount,
                'price'          => $item->price,
                'weight'         => $item->book->weight
            ]);

            $item->delete();
        }

        return $total;
    }

    public function update(Cart $cart, int $amount)
    {
        if ($amount === 0) {
            return $cart->delete();
        }
        $cart->amount = $amount;

        return $cart->save();
    }
}
