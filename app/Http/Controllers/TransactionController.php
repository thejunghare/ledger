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

    // todo: see single transaction
    public function show($transaction)
    {
        $getTransaction = Transaction::query()
            ->where('id', $transaction)
            ->where('user_id', Auth::Id())
            ->first();

        // dd($getId, Auth::user());


        if (!$getTransaction) {
            return response()->json(['ID not found'], 404);
        }

        // return response()->json($getId);
        return view('transactions.see', compact('getTransaction'));
    }

    // todo: edit single transaction
    public function edit($transaction)
    {
        $getTransaction = Transaction::query()
            ->where('id', $transaction)
            ->where('user_id', Auth::Id())
            ->first();

        // dd($getId, Auth::user());


        if (!$getTransaction) {
            return response()->json(['ID not found'], 404);
        }

        //  return response()->json($getTransaction);
        return view('transactions.edit', compact('getTransaction'));
    }

    // todo: update single tarnasction
    public function update(Request $request, $id)
    {
        $item = Transaction::find($id);
        $item->type = $request->input('type');
        $item->date = $request->input('date');
        $item->amount = $request->input('amount');
        $item->category = $request->input('category');
        $item->paymode = $request->input('paymode');

        $item->save();
        return redirect('/t')->with('success', 'Item updated successfully');
    }

    //todo: delete budget from db
    public function destroy($transactions)
    {
        $getTransaction = Transaction::query()
            ->where('id', $transactions)
            ->where('user_id', Auth::Id())
            ->first();

        if (!$getTransaction) {
            return response()->json(['ID not found'], 404);
        }

        $getTransaction->delete();
        return redirect('/t');
    }
}
