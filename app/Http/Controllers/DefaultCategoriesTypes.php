<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DefaultCategoryType;
use Illuminate\Http\Request;

class DefaultCategoriesTypes extends Controller
{
    //
    public function getCategoryTypeOptions()
    {
        $data = DefaultCategoryType::get();
        return response()->json($data);
    }
}
