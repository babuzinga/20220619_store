<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Корзина
   * @param Request $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index(Request $request)
  {
    $cart = $request->session()->get('cart');
    $products = [];
    $total_amount = $total_quantity = 0;
    if (!empty($cart))
      foreach ($cart as $pid => $cnt) {
        $product = Product::find($pid);
        $products[] = [
          'product' => $product,
          'cnt'     => $cnt,
          'end'     => $cnt * $product->price,
        ];

        // Итоговая сумма и количество товара
        $total_quantity += $cnt;
        $total_amount   += $cnt * $product->price;
      }

    $data = [
      'products'        => $products,
      'total_quantity'  => $total_quantity,
      'total_amount'    => $total_amount,
    ];

    return view('cart/index', $data);
  }

  /**
   * AJAX - метод добавления товара в корзину
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function add(Request $request)
  {
    $product_id = $request->pid;
    if (!empty($product_id) && $product_id !== 'cart') {
      $alias = 'cart.' . $product_id;
      if ($request->session()->exists($alias))
        $request->session()->increment($alias);
      else
        $request->session()->put($alias, 1);
    }

    $cart = $request->session()->get('cart');
    $cnt = 0;
    if (!empty($cart)) foreach ($cart as $item) $cnt += $item;

    return response()->json(['r' => $cnt]);
  }

  public function clear(Request $request)
  {
    $data = $request->session()->all();
    $this->print_array($data);
  }
}
