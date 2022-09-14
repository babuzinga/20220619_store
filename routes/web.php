<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StoreController;

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

// php artisan route:list
// php artisan route:cache

Route::get('/about',                          [StoreController::class, 'about'])->name('about');

Route::name('auth.')->group(function () {
  Route::get('/login',                        [AuthController::class, 'index'])->name('login');
  Route::post('/code/login',                  [AuthController::class, 'login'])->name('login_code');
  Route::post('/check/login',                 [AuthController::class, 'login'])->name('login_check');
  Route::post('/signup',                      [AuthController::class, 'signUp'])->name('signup');
  Route::post('/signout',                     [AuthController::class, 'signOut'])->name('signout');
});

Route::name('catalog.')->group(function () {
  // https://www.codecheef.org/article/laravel-gate-and-policy-example-from-scratch
  Route::get('/catalog/add',                  [CatalogsController::class, 'add_catalog'])->name('add-catalog')->middleware('can:isAdmin');
  Route::post('/catalog/save',                [CatalogsController::class, 'save_catalog'])->name('save-catalog')->middleware('can:isAdmin');
  Route::get('/catalog/edit/{catalog}',       [CatalogsController::class, 'edit_catalog'])->name('edit-catalog')->middleware('can:isAdmin');
  Route::patch('/catalog/update/{catalog}',   [CatalogsController::class, 'update_catalog'])->name('update-catalog')->middleware('can:isAdmin');
  Route::get('/catalog/delete/{catalog}',     [CatalogsController::class, 'delete_catalog'])->name('delete-catalog')->middleware('can:isAdmin');
  Route::delete('/catalog/destroy/{catalog}', [CatalogsController::class, 'destroy_catalog'])->name('destroy-catalog')->middleware('can:isAdmin');

  Route::get('/catalog/{catalog}',            [CatalogsController::class, 'catalog'])->name('index');
});

Route::name('product.')->group(function () {
  Route::get('/product/add',                  [ProductsController::class, 'add_product'])->name('add')->middleware('can:create,App\Product');
  Route::post('/product/save',                [ProductsController::class, 'save_product'])->name('save')->middleware('can:create,App\Product');
  Route::get('/product/edit/{product}',       [ProductsController::class, 'edit_product'])->name('edit')->middleware('can:update,product');
  Route::patch('/product/update/{product}',   [ProductsController::class, 'update_product'])->name('update')->middleware('can:update,product');
  Route::get('/product/delete/{product}',     [ProductsController::class, 'delete_product'])->name('delete')->middleware('can:destroy,product');
  Route::delete('/product/destroy/{product}', [ProductsController::class, 'destroy_product'])->name('destroy')->middleware('can:destroy,product');

  Route::post('/product/upload/{product}',    [ProductsController::class, 'upload_file_product'])->name('upload-file')->middleware('can:update,product');

  Route::get('/',                             [ProductsController::class, 'index'])->name('index');
  Route::get('/product/{product}',            [ProductsController::class, 'detail'])->name('detail');
});

Route::name('home.')->group(function () {
  Route::get('/home',                         [HomeController::class, 'index'])->name('index');
  Route::get('/home/update-info',             [HomeController::class, 'update_info'])->name('update-info');
});





Route::group(['as' => 'manage.', 'middleware' => ['admin']], function () {
  Route::get('/manage',                       [ManageController::class, 'stock'])->name('stoke');
});

