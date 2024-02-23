<?php

use App\Models\GroupBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\GroupBudgetController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DefaultCategoriesTypes;
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
    return view('auth.verify');
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

// Auth::routes();
Auth::routes(['verify' => true]);

// Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['verified'])->name('home');

//show fetched categories
Route::get('/categories', [DefaultCategoriesController::class, 'index'])    ->name('DefaultCategories.show');

Route::get('/fetchcategories', [DefaultCategoriesController::class, 'showRecords'])->name('DefaultCategories.index');

// budget
/* Route::get('/b', function () {
    return view('/budgets/set');
}); */

/*
|--------------------------------------------------------------------------
| Budgets
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| Budget transactions
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| About app
|--------------------------------------------------------------------------
*/

Route::get('/a', function () {
    return view('/about/show');
});

/*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/

//payments page
Route::get('/p', function () {
    return view('/payments/show');
});

/*
|--------------------------------------------------------------------------
| details
|--------------------------------------------------------------------------
*/

// see all details
Route::get('/d', [App\Http\Controllers\DetailsController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Group budget
|--------------------------------------------------------------------------
*/

Route::prefix('g/b')->group(function () {
    Route::get('/', [GroupBudgetController::class, 'index'])->name('groupBudget.index');
    Route::get('/create', [GroupBudgetController::class, 'create'])->name('groupBudget.create');
    Route::post('/', [GroupBudgetController::class, 'store'])->name('groupBudget.store');
    Route::get('/{groupTransaction}', [GroupBudgetDashboardController::class, 'show'])->name('GroupBudget.show');
    Route::get('/{groupBudget}', [GroupBudgetController::class, 'show'])->name('groupBudget.show');
    Route::get('/{groupBudget}/edit', [GroupBudgetController::class, 'edit'])->name('groupBudget.edit');
    Route::patch('/{groupBudget}', [GroupBudgetController::class, 'update'])->name('groupBudget.update');
    Route::delete('/{groupBudget}', [GroupBudgetController::class, 'destroy'])->name('groupBudget.destroy');
});

Route::get('g/b/{groupTransaction}', [GroupBudgetDashboardController::class, 'show'])->name('GroupBudget.show');

/*
|--------------------------------------------------------------------------
| Group budget transactions
|--------------------------------------------------------------------------
*/

Route::get('/g/b/{budgetId}/t/create', [GroupBudgetDashboardController::class, 'create'])->name('groupBudgetTransaction.create');
Route::get('/g/b/{budgetId}/t/{transactionId}/edit', [GroupBudgetDashboardController::class, 'edit'])->name('groupBudgetTransaction.edit');
Route::patch('/g/b/{budgetId}/t/{transactionId}', [GroupBudgetDashboardController::class, 'update'])->name('groupBudgetTransaction.update');
Route::resource('/g/b/t', GroupBudgetDashboardController::class)->names([
    'store' => 'groupBudgetTransaction.store',
    'destroy' => 'groupBudgetTransaction.destroy',
]);

/*
|--------------------------------------------------------------------------
| Fetch options using ajax
|--------------------------------------------------------------------------
*/

// fetch payment modes
Route::get('/paymode-options', [PaymentModeController::class, 'getOptions'])->name('paymode-options');
// fetch categories
Route::get('/categories-options', [DefaultCategoriesController::class, 'getCategoryOptions'])->name('category-options');
// fetch categories type
Route::get('/categories-type-options', [DefaultCategoriesTypes::class, 'getCategoryTypeOptions'])->name('category-type-options');

/*
|--------------------------------------------------------------------------
| for category
|--------------------------------------------------------------------------
*/

Route::resource('/categories', DefaultCategoriesController::class);


/*
|--------------------------------------------------------------------------
| Buy premium
|--------------------------------------------------------------------------
*/

Route::get('/premium', function () {
    return view('/premium/index');
});
