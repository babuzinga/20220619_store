<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
  public function index()
  {
    $data = [
      'products_new'      => Product::getNewProducts(),
      'products_top'      => Product::getTopProducts(),
      'products_discount' => Product::getDiscountProducts(),
    ];

    return view('store/index', $data);
  }

  public function about()
  {
    return view('store/about');
  }
}
