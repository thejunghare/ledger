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
        // $data = Paymode::with(['id', 'paymode_type'])->get();
        $data = Paymode::select('id', 'paymode_type')->get();
        return response()->json($data);
    }
}
