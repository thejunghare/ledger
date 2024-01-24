<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DefaultCategories;
use Illuminate\Http\Request;

class DefaultCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    public function index()
    {
        $user = Auth::user(); // logged in user
         $categories = DefaultCategories::pluck('category_name'); // get all records
        $incomeCategories = DefaultCategories::whereHas('defaultCategoryType', function ($query) {
            $query->where('category_type_id', '1');
        })->get();

        // dd($incomeCategories);
        return view("categories.show", compact("incomeCategories", 'categories'));
    }
}
