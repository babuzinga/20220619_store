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

// php artisan route:list --compact
// php artisan route:list --columns=Method,URI,Middleware
// php artisan route:cache

Route::name('store.')->group(function () {
  Route::get('/',                             [StoreController::class, 'index'])->name('index');
  Route::get('/about',                        [StoreController::class, 'about'])->name('about');
});

Route::name('auth.')->group(function () {
  Route::get('/login',                        [AuthController::class, 'index'])->name('login');
  Route::post('/code/login',                  [AuthController::class, 'login'])->name('login_code');
  Route::post('/check/login',                 [AuthController::class, 'login'])->name('login_check');
  Route::post('/signup',                      [AuthController::class, 'signUp'])->name('signup');
  Route::post('/signout',                     [AuthController::class, 'signOut'])->name('signout');
});

// https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
Route::resource('catalog', CatalogsController::class);
Route::name('catalog.')->group(function () {
  // https://www.codecheef.org/article/laravel-gate-and-policy-example-from-scratch
  Route::get('/catalog/{catalog}/delete',     [CatalogsController::class, 'delete'])->name('delete')->middleware('can:isAdmin');
});

Route::resource('product', ProductsController::class);
Route::name('product.')->group(function () {
  Route::get('/product/{product}/delete',     [ProductsController::class, 'delete'])->name('delete')->middleware('can:destroy,product');
  Route::post('/product/{product}/upload',    [ProductsController::class, 'upload_file'])->name('upload-file')->middleware('can:update,product');
});

Route::name('home.')->group(function () {
  Route::get('/home',                         [HomeController::class, 'index'])->name('index');
  Route::get('/home/update-info',             [HomeController::class, 'update_info'])->name('update-info');
});





Route::group(['as' => 'manage.', 'middleware' => ['admin']], function () {
  Route::get('/manage',                       [ManageController::class, 'stock'])->name('stoke');
});

