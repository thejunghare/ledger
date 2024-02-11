<?php

use App\Models\GroupBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\GroupBudgetController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DefaultCategoriesController;
use App\Http\Controllers\GroupBudgetDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// index page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//resend verification mail
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes();

// Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//show fetched categories
Route::get('/categories', [DefaultCategoriesController::class, 'index'])->name('DefaultCategories.show');

Route::get('/fetchcategories', [DefaultCategoriesController::class, 'showRecords'])->name('DefaultCategories.index');

// budget
/* Route::get('/b', function () {
    return view('/budgets/set');
}); */

// add
Route::get('/b/create', function () {
    return view('/budgets/store');
});

//index
Route::get('/b', [BudgetController::class, 'index'])->name('budgets.index');

// show
Route::get('/b/{budgets}', [BudgetController::class, 'show'])->name('budgets.show');

//store
Route::post('/b', 'App\Http\Controllers\BudgetController@store');

// edit
Route::get('/b/{budgets}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');

// update
Route::put('/b/{budgets}', [BudgetController::class, 'update'])->name('budgets.update');

//destroy
Route::delete('/b/{budgets}', [BudgetController::class, 'destroy'])->name('budgets.destroy');


// add
Route::get('/t/create', function () {
    return view('/transactions/store');
});

//show
Route::get('/t', [TransactionController::class, 'index'])->name('transaction.index');

// show
Route::get('/t/{transactions}', [TransactionController::class, 'show'])->name('transactions.show');



//store
Route::post('/t', 'App\Http\Controllers\TransactionController@store');

// edit
Route::get('/t/{transactions}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

// update
Route::put('/t/{transactions}', [TransactionController::class, 'update'])->name('transactions.update');

//destroy
Route::delete('/t/{transactions}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

//about page
Route::get('/a', function () {
    return view('/about/show');
});

//payments page
Route::get('/p', function () {
    return view('/payments/show');
});

// see all details
Route::get('/d', [App\Http\Controllers\DetailsController::class, 'index']);

/* group budgets */

// index
Route::get('/group/budgets', [GroupBudgetController::class, 'index'])->name('groupBudget.index');


// create view
Route::get('/group/budget/create', function () {
    return view('groupBudgets.create');
})->name('groupBudget.create');

// store
Route::post('/group/budget', [GroupBudgetController::class, 'store'])->name('groupBudget.store');

Route::get('/group/budget/{grouptransaction}', [GroupBudgetDashboardController::class, 'show'])->name('GroupBudget.show');

// show
Route::get('group/budget/{groupBudget}', [GroupBudgetController::class, 'show'])->name('groupBudget.show');

// edit
Route::get('group/budget/{groupBudget}/edit', [GroupBudgetController::class, 'edit'])->name('GroupBudgetController.edit');

// update
Route::patch('group/budget/{groupBudget}', [GroupBudgetController::class, 'update'])->name('groupBudget.update');

// destroy
Route::delete('group/budget/{groupBudget}', [GroupBudgetController::class, 'destroy'])->name('groupBudget.destroy');


// Dashboard
Route::get('/group/budget/{budgetId}/transaction/create', function ($budgetId) {
    // Access the budget ID here using $budgetId
    return view('groupBudgets.transaction.create', ['budgetId' => $budgetId]);
});

// store budget transactions
Route::post('/group/budget/transaction', [GroupBudgetDashboardController::class, 'store'])->name('groupBudgetTransaction.store');

// destroy budget transactions
Route::delete('/group/budget/transaction/{groupBudgetTransaction}', [GroupBudgetDashboardController::class, 'destroy'])->name('groupBudgetTransaction.destroy');

// Route::resource('products', GroupBudgetController::class);

// fetch payment modes
Route::get('/paymode-options', [PaymentModeController::class, 'getOptions'])->name('paymode-options');
// fetch categories
Route::get('/categories-options', [DefaultCategoriesController::class, 'getCategoryOptions'])->name('category-options');
