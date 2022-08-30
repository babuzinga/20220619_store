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
      $table->string('name')->default('UserName');
      $table->string('password');
      $table->string('phone', 20)->unique();
      $table->timestamp('phone_c')->nullable();
      $table->string('email')->nullable();
      $table->timestamp('email_c')->nullable();
      $table->string('telegram', 50)->nullable();
      $table->string('telegram_chat_id', 50)->default(0);
      $table->string('desc')->default('');
      $table->enum('status', ['1', '2'])->default(1)->comment('1-active / 2-ban');
      $table->char('flag', 1)->default(0);
      $table->char('code', 6)->default(0);
      $table->tinyInteger('code_fail')->default(-1);
      $table->timestamp('code_c')->nullable();
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
