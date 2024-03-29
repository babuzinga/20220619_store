<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  public function create(User $user)
  {
    return $user->isAdmin();
  }

  public function view(User $user)
  {
    return true;
  }

  public function update(User $user, Product $product)
  {
    return $user->id === $product->user->id;
  }

  public function destroy(User $user, Product $product)
  {
    return $this->update($user, $product);
  }
}
