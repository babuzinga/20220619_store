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
class HomeController extends Controller
{
  const BB_VALIDATOR = [
    'title'       => 'required|max:50',
    'price'       => 'required|numeric',
  ];

  const BB_ERROR_MESSAGES = [
    'price.required' => 'Enter the price of the item',
  ];

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
    return view('home/add_edit_product', ['catalogs' => $catalogs, 'title' => 'Add product']);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function save_product(Request $request)
  {
    $validate = $request->validate(self::BB_VALIDATOR, self::BB_ERROR_MESSAGES);
    $validate['id'] = Str::uuid();
    $validate['catalog_id'] =
      ( !empty($_POST['catalog_id']) && Str::isUuid($request->catalog_id) )
        ? $request->catalog_id
        : NULL
    ;

    Auth::user()->products()->create($validate);
    return redirect()->route('home.index');
  }

  /**
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit_product(Product $product)
  {
    $catalogs = Catalog::all();
    return view('home/add_edit_product', ['product' => $product, 'catalogs' => $catalogs, 'title' => 'Edit product']);
  }

  /**
   * @param Request $request
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update_product(Request $request, Product $product)
  {
    $validate = $request->validate(self::BB_VALIDATOR, self::BB_ERROR_MESSAGES);
    $validate['catalog_id'] =
      ( !empty($_POST['catalog_id']) && Str::isUuid($request->catalog_id) )
        ? $request->catalog_id
        : NULL
    ;
    $product->fill($validate);
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
