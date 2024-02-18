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
        $user = Auth::user(); // logged in user
        $transactions = $user ? $user->transactions()->get() : [];

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
        $getTransaction = Transaction::query()
            ->where('id', $transaction)
            ->where('user_id', Auth::Id())
            ->first();

        // dd($getId, Auth::user());


        /*

        $transactions = GroupBudgetTransaction::select(
            'group_budget_transactions.*',
            'pay_mode.paymode_type',
            'default_categories.category_name',
            'default_category_types.category_type',
            'group_budget_transactions.amount'
        )
            ->join('default_categories', 'group_budget_transactions.category_id', '=', 'default_categories.id')
            ->join('default_category_types', 'group_budget_transactions.transaction_type_id', '=', 'default_category_types.id')
            ->join('group_budgets', 'group_budget_transactions.for_budget_id', '=', 'group_budgets.id')
            ->join('pay_mode', 'group_budget_transactions.paymode_id', '=', 'pay_mode.id')
            ->where('group_budget_transactions.for_budget_id', $id)
            ->where('group_budget_transactions.user_id', $userID)
            ->paginate(5);

        */


        if (!$getTransaction) {
            return response()->json(['ID not found'], 404);
        }

        // return response()->json($getId);
        return view('transactions.see', compact('getTransaction'));
    }


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


    public function update(Request $request, $id)
    {
        $item = Transaction::find($id);
        $item->type = $request->input('type');
        $item->date = $request->input('date');
        $item->amount = $request->input('amount');
        $item->category = $request->input('category');
        $item->paymode = $request->input('paymode');

        $item->save();
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
