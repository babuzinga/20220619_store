<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
  const BB_VALIDATOR = [
    'title'         => 'required|max:50',
    'desc'          => 'max:500',
    'price'         => 'required|numeric',
    'discount'      => 'required|numeric',
    'products_cnt'  => 'required|numeric',
  ];

  const BB_ERROR_MESSAGES = [
    'price.required' => 'Enter the price of the item',
  ];

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    // https://themepure.net/template/mazia/single-product-3.html
    $products = ['products' => Product::latest()->get()];
    return view('products/index', $products);
  }

  public function detail(Product $product)
  {
    return view('products/detail', ['product' => $product]);
  }





  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function add_product()
  {
    $catalogs = Catalog::all();
    return view('products/add_edit_product', ['catalogs' => $catalogs, 'title' => 'Add product']);
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
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit_product(Product $product)
  {
    $catalogs = Catalog::all();
    return view('products/add_edit_product', ['product' => $product, 'catalogs' => $catalogs, 'title' => 'Edit product']);
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
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function delete_product(Product $product)
  {
    return view('products/delete_product', ['product' => $product]);
  }

  /**
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy_product(Product $product)
  {
    $product->delete();
    // Поскольку в модели установлено "мягкое" удаление записей,
    // восстановление записей доступно через
    // $product->restore();
    // Полное удаление записи
    // $product->forceDelete();
    return redirect()->route('manage.stoke');
  }
}
