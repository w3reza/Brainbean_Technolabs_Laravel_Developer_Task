<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TransactionController;


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
    return view('welcome');
});


//Routing Group without Middleware

/*
|--------------------------------------------------------------------------
| Admin Web Routes with admin prefix
|--------------------------------------------------------------------------
*/



Route::get('/', [backendController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/{id}', [TransactionController::class, 'show'])->name('transaction.show');











