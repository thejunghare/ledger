<?php

namespace App\Http\Controllers;

use App\Models\GroupBudget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\GroupBudgetTransaction;

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
        // dd($groupBudgetID);

        $budgetId = $groupBudgetID->id;

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
            ->paginate(5);

        return view('groupBudgets.show', compact('budgetId', 'groupBudgetName', 'formattedGroupBudgetAmount', 'transactionsCountMadeForBudget', 'formattedTotalExpenseTransactionAmount', 'formattedTotalIncomeTransactionAmount', 'formattedTotalBalanceAmount', 'transactions'));
    }

    public function create($budgetId)
    {
        return view('groupBudgets.transaction.create', ['budgetId' => $budgetId]);
    }

    // add transaction for group budget
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $validated = $request->validate([
            'transaction_type_id' => 'required',
            'for_budget_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required',
            'category_id' => 'required',
            'paymode_id' => 'required',
        ]);

        // dd($request->all());

        $data = $request->all();
        $groupBudgetId = $data['for_budget_id'];
        // dd($groupBudgetId);

        $newTransaction = $request->user()->GroupBudgetTransactions()->create($data);

        return redirect()->route('GroupBudget.show', $groupBudgetId)->with('success', 'Transaction added');
    }

    public function edit($budgetId, $transactionId)
    {
        $userID = Auth::id();

        // get the transaction details
        $transactionDetails = GroupBudgetTransaction::
            where('id', $transactionId)
            ->where('user_id', $userID)
            ->first();

        if (!$transactionDetails) {
            return response()->json(['ID not found'], 404);
        }

        // Pass both variables to the view using compact
        return view('groupBudgets.transaction.edit', compact('transactionDetails', 'budgetId', 'transactionId'));
    }

    // FIXME:
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'transaction_type_id' => 'required',
            'for_budget_id' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required',
            'category_id' => 'required',
            'paymode_id' => 'required',
        ]);

        $transaction = GroupBudgetTransaction::find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found!');
        }

        $groupBudgetId = $validatedData['for_budget_id'];

        $updated = $transaction->update($request->only([
            'transaction_type_id',
            'amount',
            'date',
            'category_id',
            'paymode_id'
        ]));

        $message = $updated ? 'Transaction updated!' : 'Failed to update transaction!';

        return redirect()->route('groupBudget.show', $groupBudgetId)->with($updated ? 'success' : 'error', $message);
    }

    // delete the transactions from budget
    public function destroy($id)
    {

        $transaction = GroupBudgetTransaction::find($id);
        $groupBudgetID = $transaction->for_budget_id;

        $transaction->delete();

        return redirect()->route('groupBudget.show', $groupBudgetID)
            ->with('success', 'Transaction deleted successfully!');
    }

}
