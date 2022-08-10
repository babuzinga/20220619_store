<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->enum('role', ['user', 'admin'])->default('user');
      $table->string('name');
      $table->string('email')->unique();
      $table->string('number', 20)->default('+7xxxxxxxxxx'); // ->unique()
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('desc')->default('');
      $table->tinyInteger('status')->default(1)->comment('0-delete / 1-active / 2-block');
      $table->char('flag', 1)->default(0);
      $table->timestamp('last_session')->nullable();
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
