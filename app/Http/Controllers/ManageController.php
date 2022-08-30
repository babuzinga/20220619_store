<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class ManageController
 * @package App\Http\Controllers
 */
class ManageController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function stock()
  {
    $catalogs = Catalog::all();
    $products = Auth::user()->products;

    return view('manage/stock', ['catalogs' => $catalogs, 'products' => $products]);
  }
}
