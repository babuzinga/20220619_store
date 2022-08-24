<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSessions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users_sessions', function (Blueprint $table) {
      $table->foreignUuid('user_id')->constrained()->onDelete('restrict');
      $table->enum('action', ['logon', 'logout'])->default('logon');
      $table->string('ip', 40);
      $table->string('ua');
      $table->timestamp('dt')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users_sessions');
  }
}
