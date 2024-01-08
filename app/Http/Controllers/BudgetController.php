<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\User;

class BudgetController extends Controller
{

    //todo: make sure only auth user does budget stuff
    public function __construct()
    {
        $this->middleware("auth");
    }

    // todo: display budgets
    public function index()
    {
        $user = Auth::user(); // logged in user
        $budgets = $user ? $user->budgets()->get() : [];
        return view("budgets.show", compact("budgets"));
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

    //todo: get single budgets
    public function show($budget)
    {
        $getId = Budget::find($budget);

        if (!$getId) {
            return response()->json(['ID not found'], 404);
        }

        // return response()->json($getId);
        return view('budgets.see', compact('getId'));
    }

    //todo: delete budget from db
    public function destroy($id)
    {
        $budget = Budget::find($id);
        //$budget->delete();
    }
}
