<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GroupBudget;
use Illuminate\Support\Facades\Auth;

class GroupBudgetController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $budgets = $user ? $user->groupBudgets()->get() : [];
        return view("groupbudget.index", compact("budgets"));
    }


    public function create()
    {
        $user = Auth::user();
        return view("groupbudget.create", compact("user"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'budget_name' => 'required',
            'budget_amount ' => 'required',
        ]);


        $user = $request->user();

        if ($user->groupBudgets()->where('budget_name', $data['budget_name'])->exists()) {
            return redirect('/g')->with('warning', 'Budget name exists!');
        }

        $dontexist = $request->user()->groupBudgets()->create([
            'budget_name' => $data['budget_name'],
            'budget_amount' => $data['budget_amount'],
        ]);


        return redirect('/g')->with([
            'success' => 'Budget created!',
            'groupBudget' => $dontexist,
        ]);
    }

    public function show($id)
    {
        $groupBudgetID = groupBudget::find($id);
        // get -> total amount, total transcation, total spending, total income
        $totalbudgetamount = $groupBudgetID->budget_amount;

        


        return view('groupbudget.show', compact('groupBudgetID', 'totalbudgetamount'));
    }

    public function edit($id)
    {
        $groupBudgetID = groupBudget::find($id);
        return view('groupbudget.edit', compact('groupBudgetID'));
    }

    public function update(Request $request, $id)
    {
    }

    public function destory($id)
    {
        $groupBudgetID = groupBudget::find($id);
        $groupBudgetID->delete();
    }
}
