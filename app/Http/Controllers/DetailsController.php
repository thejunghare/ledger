<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class DetailsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        // todo: get the logged in user
        $user = auth()->user();

        //todo get current
        $currentdate = now()->toDateString();

        $getbudget = $user->budgets()
            ->whereDate('date', $currentdate)
            ->first();

        $formattedBudget = number_format($getbudget->amount);
        $date = $getbudget->date;

        // get user transactions
        $transactions = $user->transactions()
            ->whereDate('date', $currentdate)
            ->get();

        // get balance
        $getTransactionAmountBasedOnDate = $user->transactions()
            ->where('type', 'Expense')
            ->whereDate('date', $currentdate)
            ->sum('amount');
            
        $getbalance = number_format($getbudget->amount - $getTransactionAmountBasedOnDate);

        return view('details.show', compact('formattedBudget', 'date', 'transactions', 'getbalance'));
    }
}

