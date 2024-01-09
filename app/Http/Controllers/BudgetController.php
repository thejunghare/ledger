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

        $userId = $request->user()->id;

        $existingEntry = Budget::where('user_id', $userId)
            ->where('date', $data['date'])
            ->exists();

        if ($existingEntry) {
            return redirect('/b')->with([
                'error' => 'Budget exists for this date!'
            ]);
        }

        $newBudget = $request->user()->budgets()->create([
            'date' => $data['date'],
            'amount' => $data['amount'],
        ]);

        return redirect('/b')->with([
            'success' => 'Budget created successfully!',
            'budget' => $newBudget,
        ]);
    }



    // todo: edit single transaction
    public function edit($budget)
    {
        $getBudget = Budget::query()
            ->where('id', $budget)
            ->where('user_id', Auth::Id())
            ->first();

        //dd($getBudget, Auth::user());


        if (!$getBudget) {
            return response()->json(['ID not found'], 404);
        }

        //  return response()->json($getTransaction);
        return view('budgets.edit', compact('getBudget'));
    }

    // todo: update single tarnasction
    public function update(Request $request, $id)
    {
        $item = Budget::find($id);
        $item->date = $request->input('date');
        $item->amount = $request->input('amount');

        $item->save();
        return redirect('/b')->with([
            'success' => 'Budget updated successfully!'
        ]);
    }

    //todo: get single budget
    public function show($budget)
    {
        $getBudget = Budget::query()
            ->where('id', $budget)
            ->where('user_id', Auth::Id())
            ->first();

        // dd($getId, Auth::user());


        if (!$getBudget) {
            return response()->json(['ID not found'], 404);
        }

        // return response()->json($getId);
        return view('budgets.see', compact('getBudget'));
    }

    //todo: delete budget from db
    public function destroy($budget)
    {
        $getBudget = Budget::query()
            ->where('id', $budget)
            ->where('user_id', Auth::Id())
            ->first();

        if (!$getBudget) {
            return response()->json(['ID not found'], 404);
        }

        $getBudget->delete();
        return redirect('/b')->with([
            'success' => 'Budget deleted successfully!'
        ]);
    }
}
