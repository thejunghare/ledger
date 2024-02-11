<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paymode;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
    //

    public function getOptions(Request $request)
    {
        $data = Paymode::select('id', 'paymode_type')->get();
        // $data = Paymode::all();

        return response()->json($data);
    }
}
