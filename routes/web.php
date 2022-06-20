<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('product.')->group(function () {
  Route::get('/',                       [ProductsController::class, 'index'])->name('index');
  Route::get('/products/user/{user}',   [ProductsController::class, 'products_user'])->name('users');
  Route::get('/product/{product}',      [ProductsController::class, 'detail'])->name('detail');
});

Route::name('manage.')->group(function () {
  Route::get('/manage/add-user',        [ManageController::class, 'add_user'])->name('add-user');
  Route::get('/manage/add-product',     [ManageController::class, 'add_product'])->name('add-product');
});