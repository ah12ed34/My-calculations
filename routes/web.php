<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers as pathC;
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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('home'));
    } else {
        return redirect(route('login'));
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('customers')->group(function () {
    Route::get('/', [pathC\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [pathC\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/store', [pathC\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/show/{customer}', [pathC\CustomerController::class, 'show'])->name('customers.show');
    Route::get('/edit/{customer}', [pathC\CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/update/{customer}', [pathC\CustomerController::class, 'update'])->name('customers.update');
    Route::DELETE('/destroy/{customer}', [pathC\CustomerController::class, 'destroy'])->name('customers.destroy');
});

Route::prefix('/customers/{id}/transactionLogs')->group(function () {
    Route::get('/', [pathC\TransactionLogController::class, 'index'])->name('transactionLogs.index');
    Route::get('/add', [pathC\TransactionLogController::class, 'create'])->name('transactionLogs.create');
    Route::post('/store', [pathC\TransactionLogController::class, 'store'])->name('transactionLogs.store');
    Route::get('/edit/{transactionLog}', [pathC\TransactionLogController::class, 'edit'])->name('transactionLogs.edit');
    Route::put('/update/{transactionLog}', [pathC\TransactionLogController::class, 'update'])->name('transactionLogs.update');
    Route::delete('/destroy/{transactionLog}', [pathC\TransactionLogController::class, 'destroy'])->name('transactionLogs.destroy');
    Route::post('/changeCurrencyDefault', [pathC\TransactionLogController::class, 'chanegeCurrencyDefault'])->name('transactionLogs.changeCurrencyDefault');
    Route::post(
    '/recalculate',
    [pathC\TransactionLogController::class, 'recalculate']
)->name('transactionLogs.recalculate');
});

Route::get('/showaccount', [pathC\ShowAccont::class, 'index'])->name('showaccount.index');
Route::post('/showaccount', [pathC\ShowAccont::class, 'showTransactionLogs'])->name('showaccount.show');
Route::get('/show/{transactionLog}', [pathC\ShowAccont::class, 'show'])->name('transactionLogs.show');
