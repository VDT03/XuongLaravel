<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('hometransaction');
    }

    public function create()
    {
        return view('createtransaction');
    }

    public function store()
    {
        $depositer_account  = $_REQUEST['depositer_account'];
        $amount             = $_REQUEST['amount'];
        $receiver_account   = $_REQUEST['receiver_account'];

        session()->put('transaction', [
            'depositer_account' => $depositer_account,
            'amount' => $amount, 
            'receiver_account' => $receiver_account,
            'status' => 'pending'
        ]);

        return redirect()->route('transinfor');
    }

    public function infor()
    {
        return view('infortransaction');
    }

    public function confirm()
    {
        Transaction::query()->create([
            'depositer_account' => session('transaction.depositer_account'),
            'amount' => session('transaction.amount'), 
            'receiver_account' => session('transaction.receiver_account'),
            'status' => 'success'
        ]);

        session()->forget('transaction');

        return redirect()->route('index');
    }

    public function forget()
    {
        session()->forget('transaction');

        return redirect()->route('index');
    }
}
