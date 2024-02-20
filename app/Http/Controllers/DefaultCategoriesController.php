<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DefaultCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DefaultCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    public function index()
    {
        $user = Auth::user(); // logged in user

        $categories = DefaultCategories::where('category_name')->get();

        // dd($incomeCategories);
        return view("categories.show", compact('categories'));
    }

    // fetching categories using ajax
    public function showRecords(Request $request)
    {
        $filter = $request->input('filter', 2);
        $categories = DefaultCategories::whereHas('defaultCategoryType', function ($query) use ($filter) {
            $query->where('category_type_id', $filter);
        })->get();

        $html = view("categories.showFetched", compact('categories'))->render();


        // dd($incomeCategories);
        return response()->json([
            'html' => $html
        ]);
    }

    //
    public function getCategoryOptions()
    {
        $data = DefaultCategories::whereHas('defaultCategoryType', function ($query) {
            $query->where('category_type_id', 2);
        })->get();

        return response()->json($data);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $request->validate([
            'isDefault' => 'required',
            'category_type_id' => 'required',
            'category_name' => 'required'
        ]);

        // dd($request->all());

        DefaultCategories::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'category created successfully.');
    }
}
