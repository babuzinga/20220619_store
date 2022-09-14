<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use App\Models\File;
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
   * Для всех методов контроллера, за исключением show, index - требуются права администратора
   * ProductsController constructor.
   */
  public function __construct()
  {
    // Подключение app/Http/Kernel.php
    $this->middleware('admin')
      ->except([
        'show',
        'index',
      ]);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    // https://themepure.net/template/mazia/single-product-3.html
    $products = ['products' => Product::latest()->get()];
    return view('products/index', $products);
  }

  public function show(Product $product)
  {
    return view('products/show', ['product' => $product]);
  }





  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function create()
  {
    $catalogs = Catalog::all();
    return view('products/create_edit', ['catalogs' => $catalogs, 'title' => 'Add product']);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
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
  public function edit(Product $product)
  {
    $catalogs = Catalog::all();
    return view('products/create_edit', ['product' => $product, 'catalogs' => $catalogs, 'title' => 'Edit product']);
  }

  /**
   * @param Request $request
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Product $product)
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
  public function delete(Product $product)
  {
    return view('products/delete', ['product' => $product]);
  }

  /**
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Product $product)
  {
    $product->delete();
    // Поскольку в модели установлено "мягкое" удаление записей,
    // восстановление записей доступно через
    // $product->restore();
    // Полное удаление записи
    // $product->forceDelete();
    return redirect()->route('manage.stoke');
  }

  /**
   * Загрузка изображений
   *
   * https://www.tutsmake.com/laravel-8-file-upload-tutorial/
   * @param Request $request
   * @param Product $product
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function upload_file(Request $request, Product $product)
  {
    $validate = $request->validate(['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

    $filename = $request->file('file')->getClientOriginalName();
    //$filename = time().'.'.$request->image->extension();
    $path = $request->file('file')->store('public/storage/images', 'local');
    $validate['id'] = Str::uuid();
    $validate['filename'] = $filename;
    $validate['path'] = $path;
    $validate['mime_type'] = $request->file->getClientMimeType();
    $validate['user_id'] = Auth::user()->getId();

    $product->files()->create($validate);

    return redirect()->route('product.edit', ['product' => $product])->with('status', 'File Has been uploaded successfully in laravel 8');
  }
}
