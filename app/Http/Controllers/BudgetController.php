<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

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

    public function show(Budget $budget)
    {
        //dd($budget);
        $budgets = Budget::orderBy('date', 'desc')->get();
        return view('budgets.show', compact('budgets'));
    }
}
