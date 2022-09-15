<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CatalogsController extends Controller
{
  /**
   * Для всех методов контроллера, за исключением show, index - требуются права администратора
   * ProductsController constructor.
   */
  public function __construct()
  {
    // Подключение app/Http/Kernel.php
    $this->middleware('admin')
      ->except([
        'index',
        'show',
      ]);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    $breadcrumb = [['link' => null, 'title' => 'Каталоги']];
    $catalogs = Catalog::getRootCatalogs();
    return view('catalogs/show', ['products' => [], 'catalogs' => $catalogs, 'title' => 'Каталоги', 'breadcrumb' => $breadcrumb]);
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function show(Catalog $catalog)
  {
    // Формирование "Хлебных крошек"
    $breadcrumb = array_merge(
      [['link' => route('catalog.index'), 'title' => 'Каталоги']],
      array_reverse($catalog->getBreadcrumb())
    );
    $breadcrumb[] = ['id' => null, 'title' => $catalog->getTitle()];
    $catalogs = $catalog->catalogs;
    $products = $catalog->products;

    $data = [
      'catalog'     => $catalog,
      'products'    => $products,
      'catalogs'    => $catalogs,
      'title'       => $catalog->getTitle(),
      'breadcrumb'  => $breadcrumb
    ];

    return view('catalogs/show', $data);
  }





  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function create()
  {
    $catalogs = Catalog::all();
    return view('catalogs/create_edit', ['catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $data = [
      'id'          => Str::uuid(),
      'title'       => !empty($_POST['title']) ? $request->title : '-',
      'catalog_id'  => empty($_POST['catalog_id']) ? NULL : $request->catalog_id,
    ];

    Catalog::create($data);
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit(Catalog $catalog)
  {
    $catalogs = Catalog::all();
    return view('catalogs/create_edit', ['catalog' => $catalog, 'catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @param Catalog $catalog
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Catalog $catalog)
  {
    $data = [
      'title'       => !empty($_POST['title']) ? $request->title : '-',
      'catalog_id'  => empty($_POST['catalog_id']) ? NULL : $request->catalog_id,
    ];

    $catalog->fill($data);
    $catalog->save();
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function delete(Catalog $catalog)
  {
    return view('catalogs/delete', ['catalog' => $catalog]);
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Catalog $catalog)
  {
    $catalog->delete();
    return redirect()->route('manage.stoke');
  }
}
