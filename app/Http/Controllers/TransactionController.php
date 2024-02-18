<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $currentDate = now()->toDateString();

            $transactions = Transaction::select(
                'transactions.*',
                'default_category_types.category_type',
            )
                ->join('default_category_types', 'transactions.transaction_type_id', '=', 'default_category_types.id')
                ->where('transactions.user_id', $user->id)
                ->where('date', $currentDate)
                ->latest()
                ->get();
        } else {
            $transactions = [];
        }

        return view("transactions.show", compact("transactions"));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'transaction_type_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'category_id' => 'required',
            'paymode_id' => 'required'
        ]);

        $data['user_id'] = Auth::id();

        Transaction::create($data);

        return redirect('/t')->with([
            'success' => 'Transaction added successfully!'
        ]);
    }

    public function show($transaction)
    {
        $transaction = auth()->user()->transactions()->find($transaction);

        if (!$transaction) {
            return response()->json(['ID not found'], 404);
        }

        $transactionDetails = Transaction::select(
            'transactions.*',
            'pay_mode.paymode_type',
            'default_categories.category_name',
            'default_category_types.category_type',
        )
            ->join('default_categories', 'transactions.category_id', '=', 'default_categories.id')
            ->join('default_category_types', 'transactions.transaction_type_id', '=', 'default_category_types.id')
            ->join('pay_mode', 'transactions.paymode_id', '=', 'pay_mode.id')
            ->where('transactions.id', $transaction->id)
            ->first();

        return view('transactions.see', compact('transaction', 'transactionDetails'));
    }

    public function edit($transaction)
    {
        $getTransactionDetails = Transaction::query()
            ->where([
                'id' => $transaction,
                'user_id' => Auth::Id(),
            ])
            ->first();

        if (!$getTransactionDetails) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return view('transactions.edit', compact('getTransactionDetails'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'transaction_type_id' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'category_id' => 'required|integer',
            'paymode_id' => 'required|integer',
        ]);

        $item = Transaction::find($id);

        $item->update($validatedData);

        return redirect('/t')->with([
            'success' => 'Transaction updated successfully!'
        ]);
    }

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

        return redirect('/t')->with([
            'success' => 'Transaction deleted successfully!'
        ]);
    }
}
