<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class ManageController
 * @package App\Http\Controllers
 */
class ManageController extends Controller
{
  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function catalogs()
  {
    $catalogs = Catalog::all();
    return view('manage/catalogs', ['catalogs' => $catalogs]);
  }

  /**
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function add_catalog()
  {
    $catalogs = Catalog::all();
    return view('manage/add_catalog', ['catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function save_catalog(Request $request)
  {
    $data = [
      'title_eng'       => !empty($_POST['title_eng']) ? $request->title_eng : '-',
      'title_rus'       => !empty($_POST['title_rus']) ? $request->title_rus : '-',
    ];

    if (!empty($_POST['parent_id']))
      $data['parent_id'] = (int)$request->parent_id;

    Catalog::create($data);
    return redirect()->route('manage.catalogs');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function edit_catalog(Catalog $catalog)
  {
    $catalogs = Catalog::all();
    return view('manage/edit_catalog', ['catalog' => $catalog, 'catalogs' => $catalogs]);
  }

  /**
   * @param Request $request
   * @param Catalog $catalog
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update_catalog(Request $request, Catalog $catalog)
  {
    $data = [
      'title_eng'       => !empty($_POST['title_eng']) ? $request->title_eng : '-',
      'title_rus'       => !empty($_POST['title_rus']) ? $request->title_rus : '-',
    ];

    if (!empty($_POST['parent_id']))
      $data['parent_id'] = (int)$request->parent_id;

    $catalog->fill($data);
    $catalog->save();
    return redirect()->route('manage.catalogs');
  }

  /**
   * @param Catalog $catalog
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function delete_catalog(Catalog $catalog)
  {
    return view('manage/delete_catalog', ['catalog' => $catalog]);
  }

  public function destroy_catalog(Catalog $catalog)
  {
    $catalog->delete();
    return redirect()->route('manage.catalogs');
  }
}
