<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageController extends Controller
{
  public function add_user()
  {
    $user = User::create([
      'name'      => 'admin2',
      'email'     => 'admin2@domain.com',
      'password'  => Hash::make('admin'),
    ]);
    exit;
  }

  public function add_product()
  {
    $user = User::where('name', 'admin2')->first();
    $product = new Product();
    $product->title = 'product';
    $product->price = 1111;
    $product->catalog_id = 100000;

    $user->products()->save($product);

    echo 'product created';
    exit;
  }
}
