<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
  Route::get('/',                                     [ProductsController::class, 'index'])->name('index');
  Route::get('/product/{product}',                    [ProductsController::class, 'detail'])->name('detail');
});

Route::name('manage.')->group(function () {
  Route::get('/manage/catalogs',                      [ManageController::class, 'catalogs'])->name('catalogs');
  Route::get('/manage/add-catalog',                   [ManageController::class, 'add_catalog'])->name('add-catalog');
  Route::post('/manage/save-catalog',                 [ManageController::class, 'save_catalog'])->name('save-catalog');
  Route::get('/manage/edit-catalog/{catalog}',        [ManageController::class, 'edit_catalog'])->name('edit-catalog');
  Route::patch('/manage/update-catalog/{catalog}',    [ManageController::class, 'update_catalog'])->name('update-catalog');
  Route::get('/manage/delete-catalog/{catalog}',      [ManageController::class, 'delete_catalog'])->name('delete-catalog');
  Route::delete('/manage/destroy-catalog/{catalog}',  [ManageController::class, 'destroy_catalog'])->name('destroy-catalog');
});

Auth::routes();

Route::name('home.')->group(function () {
  Route::get('/home',                                 [HomeController::class, 'index'])->name('index');
  Route::get('/home/add-product',                     [HomeController::class, 'add_product'])->name('add-product');
  Route::post('/home/save-product',                   [HomeController::class, 'save_product'])->name('save-product');
  Route::get('/home/edit-product/{product}',          [HomeController::class, 'edit_product'])->name('edit-product')->middleware('can:update,product');
  Route::patch('/home/update-product/{product}',      [HomeController::class, 'update_product'])->name('update-product')->middleware('can:update,product');
  Route::get('/home/delete-product/{product}',        [HomeController::class, 'delete_product'])->name('delete-product')->middleware('can:destroy,product');
  Route::delete('/home/destroy-product/{product}',    [HomeController::class, 'destroy_product'])->name('destroy-product')->middleware('can:destroy,product');
});