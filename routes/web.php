<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupBudgetController;
use App\Http\Controllers\GroupBudgetDashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DefaultCategoriesController;
use App\Http\Controllers\GroupTransactionsController;
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

// add budget
Route::get('/b/create', function () {
    return view('/budgets/store');
});

//show all budget
Route::get('/b', [BudgetController::class, 'index'])->name('budgets.index');

// show single transaction
Route::get('/b/{budgets}', [BudgetController::class, 'show'])->name('budgets.show');

//store budget
Route::post('/b', 'App\Http\Controllers\BudgetController@store');

// edit tansaction
Route::get('/b/{budgets}/edit', [BudgetController::class, 'edit'])->name('budgets.edit');

// update transaction
Route::put('/b/{budgets}', [BudgetController::class, 'update'])->name('budgets.update');

//destory budget
Route::delete('/b/{budgets}', [BudgetController::class, 'destroy'])->name('budgets.destroy');


// add tansaction
Route::get('/t/create', function () {
    return view('/transactions/store');
});

//show all tansaction
Route::get('/t', [TransactionController::class, 'index'])->name('transaction.index');

// show single transaction
Route::get('/t/{transactions}', [TransactionController::class, 'show'])->name('transactions.show');

// route for getting the categories dynamically
Route::get('/get-options', [DefaultCategoriesController::class, 'getCategoryOptions']);

//store tansaction
Route::post('/t', 'App\Http\Controllers\TransactionController@store');

// edit tansaction
Route::get('/t/{transactions}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');

// update transaction
Route::put('/t/{transactions}', [TransactionController::class, 'update'])->name('transactions.update');

//destory budget
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

// Dashboard / see details of individual group budgets
Route::get('/group/budgets/{grouptransaction}', [GroupBudgetDashboardController::class, 'show'])->name('GroupBudgetDashboardController.show');


// creaet view
Route::get('/group/budgets/create', [GroupBudgetController::class, 'create'])->name('groupBudget.create');

// store budgets
Route::post('/group/budgets', [GroupBudgetController::class, 'store'])->name('groupBudget.store');

// show single budget
Route::get('group/budgets/{groupbudget}', [GroupBudgetController::class,'show'])->name('getBudget.show');

// edit single budget
Route::get('group/budgets/{groupbudget}/edit', [GroupBudgetController::class,'edit'])->name('getBudget.edit');

// update single budget
Route::patch('group/budgets/{groupbudget}', [GroupBudgetController::class,'update'])->name('getBudget.update');

// destroy budget
Route::delete('group/budgets/{groupbudget}', [GroupBudgetController::class,'destroy'])->name('getBudget.destroy');
