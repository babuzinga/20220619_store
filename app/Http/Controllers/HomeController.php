<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $products = ['products' => Auth::user()->products];
    return view('home/index', $products);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function add_product()
  {
    $catalogs = Catalog::all();
    return view('home/add_product', ['catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function save_product(Request $request)
  {
    $data = [
      'title'       => !empty($_POST['title']) ? $request->title : '-',
      'price'       => !empty($_POST['price']) ? $request->price : '-',
    ];

    if (!empty($_POST['catalog_id']))
      $data['catalog_id'] = $request->catalog_id;

    Auth::user()->products()->create($data);
    return redirect()->route('home.index');
  }

  /**
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit_product(Product $product)
  {
    $catalogs = Catalog::all();
    return view('home/edit_product', ['product' => $product, 'catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update_product(Request $request, Product $product)
  {
    $data = [
      'title'       => !empty($_POST['title']) ? $request->title : '-',
      'price'       => !empty($_POST['price']) ? $request->price : '-',
    ];

    if (!empty($_POST['catalog_id']))
      $data['catalog_id'] = (int)$request->catalog_id;

    $product->fill($data);
    $product->save();
    return redirect()->route('home.index');
  }

  /**
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function delete_product(Product $product)
  {
    return view('home/delete_product', ['product' => $product]);
  }

  /**
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy_product(Product $product)
  {
    $product->delete();
    return redirect()->route('home.index');
  }
}
