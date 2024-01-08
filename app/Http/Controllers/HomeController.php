<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get the logged in user
        $user = auth()->user();

        // get the transaction count
        $transactioncount = $user->transactions->count();

        // get the budget count
        $budgetcount = $user->transactions->count();
        return view('home', compact('transactioncount', 'budgetcount'));
    }
}



