<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    'App\Models\Product' => 'App\Policies\ProductPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();


    // https://www.codecheef.org/article/laravel-gate-and-policy-example-from-scratch
    Gate::define('isAdmin', function ($user) {
      return $user->isAdmin();
    });

    Gate::define('isUser', function ($user) {
      return $user->isUser();
    });
  }
}
