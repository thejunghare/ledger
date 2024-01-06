<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
//todo: make sure only auth user does budget stuff
    public function __construct()
    {
        $this->middleware("auth");
    }


//todo: store budget in db
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
            'amount' => 'required|numeric|min:1'
        ]);

        //dd(request()->all());

        auth()->user()->budgets()->create([
            'date' => $data['date'],
            'amount' => $data['amount'],
        ]);


        return redirect('/b');

    }

//todo: fetch budgets from db
    public function show(Budget $budget)
    {
        //dd($budget);
        $budgets = Budget::orderBy('date', 'desc')->get();
        return view('budgets.show', compact('budgets'));
    }

//todo: delete budget from db
    public function destroy($id)
    {
        $budget = Budget::find($id);
        //$budget->delete();
    }
}
