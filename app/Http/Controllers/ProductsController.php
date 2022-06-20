<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
      $products = ['products' => Product::latest()->get()];
      return view('products/index', $products);
  }

  public function detail(Product $product)
  {
    return view('products/detail', $product);
  }
}
