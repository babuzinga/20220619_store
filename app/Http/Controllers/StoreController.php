<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
  public function index()
  {
    return view('store/index');
  }

  public function about()
  {
    return view('store/about');
  }
}
