<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
      $products = ['products' => Product::latest()->get()];
      //echo '<pre>', print_r($products, 1), '</pre>'; exit();
      return view('products/index', $products);
  }

  public function detail(Product $product)
  {
    return view('products/detail', $product);
  }

  public function products_user(User $user)
  {
    $products = ['products' => $user->products];
    return view('products/index', $products);
  }
}
