<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store()
    {
        $data = request()->validate([
            'type' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'category' => 'required',
            'paymode' => 'required'
        ]);

        //dd(request()->all());

        auth()->user()->transactions()->create([
            'type' => $data['type'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'category' => $data['category'],
            'paymode' => $data['paymode'],
        ]);


        return redirect('/t');

    }

    public function show(Transaction $transaction)
    {
        //dd($budget);
        $transactions = Transaction::orderBy('date', 'desc')->get();
        return view('transactions.show', compact('transactions'));
    }
}
