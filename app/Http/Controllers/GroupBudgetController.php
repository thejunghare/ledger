<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupBudget;
use App\Models\GroupBudgetTransaction;
use Illuminate\Support\Facades\Auth;

class GroupBudgetController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = Auth::user();
        $budgets = $user ? $user->groupBudgets()->orderBy('created_at')->paginate(1) : [];
        return view("groupBudgets.index", compact("budgets"));
    }


    public function store(Request $request)
    {

        /* $data = $request->validate([
            'budget_name' => 'required|string|unique:group_budgets,budget_name,NULL,id,user_id,' . auth()->id(),
            'budget_amount ' => 'required|numeric|min:1',
        ]); */

        /* dd($request->validate([
            'budget_name' => 'required|unique:group_budgets',
            'budget_amount' => 'required|min:1',
        ])); */

        $validated = $request->validate([
            'budget_name' => 'required|unique:group_budgets,budget_name,NULL,id,user_id,' . auth()->id(),
            'budget_amount' => 'required|numeric|min:1',
        ]);

        $user = $request->user();

        $data = $request->all();

        if ($user->groupBudgets()->where('budget_name', $data['budget_name'])->exists()) {
            return redirect('/g')->with('warning', 'Budget name exists!');
        }

        $newBudget = $request->user()->groupBudgets()->create($data);

        return redirect()->route('groupBudget.index')
            ->with('success', 'Budget created successfully.');
    }

    public function show($id)
    {
        $groupBudgetID = groupBudget::find($id);

        return view('groupBudgets.show', compact('groupBudgetID', 'budgetAmount'));
    }

    public function edit($id)
    {
        // get the user ID
        $userID = Auth::id();

        // get the budget details
        $budgetDetails = groupBudget::
            where('id', $id)
            ->where('user_id', $userID)
            ->first();

        // check for ID
        if (!$budgetDetails) {
            return response()->json(['ID not found'], 404);
        }

        return view('groupBudgets.edit', compact('budgetDetails'));
    }

    public function update(Request $request, $id)
    {
        // get request details
        $request->validate([
            'budget_name' => 'required',
            'budget_amount' => 'required|numeric|min:1'
        ]);

        //update the details
        $updated = groupBudget::where('id', $id)->update($request->only(['budget_name', 'budget_amount']));

        if ($updated) {
            return redirect('group/budgets/')->with([
                'success' => 'Budget was updated',
            ]);
        } else {
            return redirect('group/budgets/')->with([
                'error' => `Can't update budget, try again!`
            ]);
        }
    }

    public function destroy($id)
    {
        // get the id for budget
        $groupBudget = groupBudget::find($id);

        if (!$groupBudget) {
            return redirect('/group/budgets')->with([
                'error' => 'Budget not found!'
            ]);
        }

        // delete the related transactions first
        $groupBudget->groupTransactions()->delete();

        // delete the budget itself
        $groupBudget->delete();

        // redirect on delete with flash message
        return redirect('/group/budgets')->with([
            'success' => 'Budget destroyed!'
        ]);
    }
}
