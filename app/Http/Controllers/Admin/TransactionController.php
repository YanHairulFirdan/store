<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $status = [
        'warning'   => 'on process',
        'secondary' => 'pending',
        'primary'   => 'done',
        'danger'    => 'cancelled'
    ];
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'DESC')->paginate(10);
        $status       = $this->status;

        return view('admin.transaction.index', compact('transactions', 'status'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if (in_array($request->status, $this->status)) {
            $transaction->status = $request->status;

            $transaction->save();

            $message = 'Transaction status has been updated successfully';
            $class   = 'success';
        } else {
            $message = 'Failed to update Transaction status';
            $class   = 'danger';
        }

        return redirect()->back()->with(['message' => $message, 'class' => $class]);
    }
}
