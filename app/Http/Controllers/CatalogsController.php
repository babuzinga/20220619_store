<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CatalogsController extends Controller
{

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function catalog(Catalog $catalog)
  {
    return view('catalogs/catalog', ['products' => $catalog->products, 'title' => $catalog->title]);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function add_catalog()
  {
    $catalogs = Catalog::all();
    return view('catalogs/add_edit_catalog', ['catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function save_catalog(Request $request)
  {
    $data = [
      'id'        => Str::uuid(),
      'title'     => !empty($_POST['title']) ? $request->title : '-',
      'parent_id' => empty($_POST['parent_id']) ? NULL : $request->parent_id,
    ];

    Catalog::create($data);
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit_catalog(Catalog $catalog)
  {
    $catalogs = Catalog::all();
    return view('catalogs/add_edit_catalog', ['catalog' => $catalog, 'catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @param Catalog $catalog
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update_catalog(Request $request, Catalog $catalog)
  {
    $data = [
      'title'     => !empty($_POST['title']) ? $request->title : '-',
      'parent_id' => empty($_POST['parent_id']) ? NULL : $request->parent_id,
    ];

    $catalog->fill($data);
    $catalog->save();
    return redirect()->route('manage.stoke');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function delete_catalog(Catalog $catalog)
  {
    return view('catalogs/delete_catalog', ['catalog' => $catalog]);
  }

  public function destroy_catalog(Catalog $catalog)
  {
    $catalog->delete();
    return redirect()->route('manage.stoke');
  }
}