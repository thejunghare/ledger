<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get the logged in user
        $user = auth()->user();

        // get the transaction count
        $transactioncount = $user->transactions->count();
        $transactions = $user->transactions;

        // get total
        $userId = Auth::id();

        $totalIncomeAmount = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpenseAmount = Transaction::where('user_id', $userId)
            ->where('type', 'Expense')
            ->sum('amount');


        // format amount in thousands and hundred
        $amount = $totalExpenseAmount;
        $formattedExpenseAmount = number_format($amount, 2);

        // format amount in thousands and hundred
        $amount = $totalIncomeAmount;
        $formattedIncomeAmount = number_format($amount, 2);


        // get the budget count
        $budgetcount = $user->budgets->count();
        return view('home', compact('transactioncount', 'budgetcount', 'transactions', 'formattedIncomeAmount', 'formattedExpenseAmount'));
    }
}



