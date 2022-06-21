<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManageController extends Controller
{
  public function add_catalog()
  {
    $catalogs = Catalog::all();
    return view('manage/add_catalog', ['catalogs' => $catalogs]);
  }

  public function save_catalog(Request $request)
  {
    //echo '<pre>', print_r($_POST, 1), '</pre>'; exit;
    $data = [
      'title_eng'       => !empty($_POST['title_eng']) ? $request->title_eng : '-',
      'title_rus'       => !empty($_POST['title_rus']) ? $request->title_rus : '-',
    ];

    if (!empty($_POST['parent_id']))
      $data['parent_id'] = (int)$request->parent_id;

    Catalog::create($data);
    return redirect()->route('manage.add-catalog');
  }
}
