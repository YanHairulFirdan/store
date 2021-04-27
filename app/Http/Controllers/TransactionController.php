<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::get();
        return response()->json(['transactions' => $transactions]);
    }

    public function show(Transaction $transaction)
    {
        return response()->json(['transaction' => $transaction]);
    }

    public function confirm(Transaction $transaction)
    {
        $transaction->confirm = !$transaction->confirm;

        $message = 'Transaksi berhasil dikonfirmasi';
        return response()->json(['message' => $message]);
    }

    public function delete(Transaction $transaction)
    {
        $result = $transaction->delete();
        $message = ($result) ? 'Transaksi berhasil dihapus' : 'Transaksi gagal dihapus';
        return response()->json(['message' => $message]);
    }
}
