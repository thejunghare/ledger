<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;


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
//store tansaction
Route::post('/t', 'App\Http\Controllers\TransactionController@store');

//about page
Route::get('/a', function () {
    return view('/about/show');
});

//payments page
Route::get('/p', function () {
    return view('/payments/show');
});

