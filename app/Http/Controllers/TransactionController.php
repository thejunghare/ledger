<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = Auth::user(); // logged in user
        $transactions = $user ? $user->transactions()->get() : [];
        return view("transactions.show", compact("transactions"));
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

    public function show($transactions)
    {
        $getTransactionsId = Transaction::find($transactions);

        if (!$getTransactionsId) {
            return response()->json(['ID not found'], 404);
        }

        //return response()->json($getTransactionsId);

        return view('transactions.see', compact('getTransactionsId'));
    }
}
