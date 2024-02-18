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
        // get the logged in user
        $user = auth()->user();

        $username = $user->name;
        $words = explode(' ', $username);

        $firstLetters = '';
        foreach ($words as $word) {
            $firstLetters .= strtoupper($word[0]); // Convert to uppercase if needed
        }

        $currentDate = now()->toDateString();

        // get the transaction count
        $transactionCount = $user->transactions->count();

        // $transactions = $user->transactions->where('date', $currentDate);

        $user_id = Auth::id();

        $transactions = Transaction::select(
            'transactions.*',
            'pay_mode.paymode_type',
            'default_categories.category_name',
            'default_category_types.category_type',
        )
            ->join('default_categories', 'transactions.category_id', '=', 'default_categories.id')
            ->join('default_category_types', 'transactions.transaction_type_id', '=', 'default_category_types.id')
            ->join('pay_mode', 'transactions.paymode_id', '=', 'pay_mode.id')
            ->where('transactions.date', $currentDate)
            ->get();


        $userId = Auth::id();


        $totalBudgetAmount = $user->budgets()
            ->whereDate('date', $currentDate)
            ->first();

        $formattedTotalBudgetAmount = number_format($totalBudgetAmount->amount, 2);

        $totalIncomeAmount = Transaction::where('user_id', $userId)
            ->where('transaction_type_id', 1)
            ->whereDate('date', $currentDate)
            ->sum('amount');

        $totalExpenseAmount = Transaction::where('user_id', $userId)
            ->where('transaction_type_id', 2)
            ->whereDate('date', $currentDate)
            ->sum('amount');

        // get budget amount based on date & find balance
        $budget = $user->budgets()
            ->whereDate('date', $currentDate)
            ->first();

        $getTransactionAmountBasedOnDate = $user->transactions()
            ->where('transaction_type_id', 2)
            ->whereDate('date', $currentDate)
            ->sum('amount');

        $balance = 0;
        $formattedBalance = 0;

        if ($budget) {
            $amountBasedOnCurrentDate = $budget->amount;
            $balance = $amountBasedOnCurrentDate - $getTransactionAmountBasedOnDate;

            $formattedBalance = number_format($balance, 2);
        }

        // format amount in thousands and hundred
        $amount = $totalExpenseAmount;
        $formattedExpenseAmount = number_format($amount, 2);

        //format amount in thousands and hundred
        $amount = $totalIncomeAmount;
        $formattedIncomeAmount = number_format($amount, 2);

        return view('home', compact('formattedTotalBudgetAmount', 'firstLetters', 'transactionCount', 'transactions', 'formattedIncomeAmount', 'formattedExpenseAmount', 'formattedBalance'));
    }
}



