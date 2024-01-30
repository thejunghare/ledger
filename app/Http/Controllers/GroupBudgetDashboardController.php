<?php

namespace App\Http\Controllers;

use App\Models\GroupBudget;
use App\Models\GroupBudgetTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupBudgetDashboardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function show($id)
    {
        // get the logged in user
        $userID = Auth::id();

        // get selected budget id
        $groupBudgetID = GroupBudget::find($id);

        // get the group budget name
        $groupBudgetName = GroupBudget::where('user_id', $userID)
            ->where('budget_name', $groupBudgetID->budget_name)
            ->first();

        // get the group budget name
        $groupBudgetAmount = GroupBudget::where('user_id', $userID)
            ->where('budget_amount', $groupBudgetID->budget_amount)
            ->first();

        // format the group budget amount
        $formattedGroupBudgetAmount = number_format($groupBudgetAmount->budget_amount, 2);

        // get all transactions made by user for group budget id
        $transactionsCountMadeForBudget = GroupBudgetTransaction::where('for_budget_id', $id)
            ->where('user_id', $userID)
            ->count();

        // get the totalExpenseTransactionsAmount
        $totalExpenseTransactionAmount = GroupBudgetTransaction::where('for_budget_id', $id)
            ->where('user_id', $userID)
            ->where('transaction_type_id', 2)
            ->sum('amount');

        $formattedTotalExpenseTransactionAmount = number_format($totalExpenseTransactionAmount, 2);

        // get the totalIncomeTransactionsAmount
        $totalIncomeTransactionAmount = GroupBudgetTransaction::where('for_budget_id', $id)
            ->where('user_id', $userID)
            ->where('transaction_type_id', 1)
            ->sum('amount');

        $formattedTotalIncomeTransactionAmount = number_format($totalIncomeTransactionAmount, 2);

        // get the total balance amount; total balance amount = groupBudgetAmount - totalExpenseTransactionsAmount
        $totalBalanceAmount = $groupBudgetAmount->budget_amount - $totalExpenseTransactionAmount;
        $formattedTotalBalanceAmount = number_format($totalBalanceAmount, 2);

        // default categories -> other/food/etc, category type -> expense/income
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
            ->get();

        return view('groupBudgets.show', compact('groupBudgetName', 'formattedGroupBudgetAmount', 'transactionsCountMadeForBudget', 'formattedTotalExpenseTransactionAmount', 'formattedTotalIncomeTransactionAmount', 'formattedTotalBalanceAmount', 'transactions'));
    }

    // add transaction for group budget
    public function store(){
        
    }

    // delete the transactions from budget
    public function destroy($id)
    {
        // get the id for transaction
        $transaction = GroupBudgetTransaction::find($id);
        //dd($transaction);

        // get the budget ID
        $groupBudgetID = $transaction->for_budget_id;
        // dd($groupBudgetID);

        $transaction->delete();
        return redirect('/group/budget/$groupBudgetID')->with("success", "Transaction destroy!");
    }
}
