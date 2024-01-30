<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupBudgetTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupTransactionsController extends Controller
{
    //

    public function show()
    {
        $user = Auth::user();
        $groupTransactions = $user ? $user->groupBudgetTransactions()->get() : [];

        return view("groupbudget.show", compact("groupTransactions"));
    }
}
