<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Budget;
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
        //todo: get the logged in user
        $user = auth()->user();

        $username = $user->name;
        $words = explode(' ', $username);


        $firstLetters = '';
        foreach ($words as $word) {
            $firstLetters .= strtoupper($word[0]); // Convert to uppercase if needed
        }

        //todo: get the transaction count
        $transactioncount = $user->transactions->count();
        $transactions = $user->transactions;

        //todo: get total
        $userId = Auth::id();
        $currentdate = now()->toDateString();

        $totalIncomeAmount = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereDate('date', $currentdate)
            ->sum('amount');

        $totalExpenseAmount = Transaction::where('user_id', $userId)
            ->where('type', 'Expense')
            ->whereDate('date', $currentdate)
            ->sum('amount');


        //todo: get budget amount based on date & find balance

        $budget = $user->budgets()
            ->whereDate('date', $currentdate)
            ->first();

        $getTransactionAmountBasedOnDate = $user->transactions()
            ->where('type', 'Expense')
            ->whereDate('date', $currentdate)
            ->sum('amount');



        $balance = 0;
        $formattedBalance = 0;

        if ($budget) {
            $amountBasedOnCurrentDate = $budget->amount;
            $balance = $amountBasedOnCurrentDate - $getTransactionAmountBasedOnDate;

            $formattedBalance = number_format($balance);
        }




        //todo: format amount in thousands and hundred
        $amount = $totalExpenseAmount;
        $formattedExpenseAmount = number_format($amount);

        //todo: format amount in thousands and hundred
        $amount = $totalIncomeAmount;
        $formattedIncomeAmount = number_format($amount);


        //todo: get the budget count
        $budgetcount = $user->budgets->count();

        return view('home', compact('firstLetters', 'transactioncount', 'budgetcount', 'transactions', 'formattedIncomeAmount', 'formattedExpenseAmount', 'formattedBalance'));
    }
}



