<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('files', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('filename');
      $table->string('path');
      $table->string('mime_type');
      $table->foreignUuid('product_id')->constrained()->onDelete('restrict');
      $table->foreignUuid('user_id')->constrained()->onDelete('restrict');
      $table->enum('status', ['1', '2'])->default(1)->comment('1-active / 2-hidden');
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
    Schema::dropIfExists('files');
  }
}
