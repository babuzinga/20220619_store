<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('catalogs', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('title');
      $table->char('parent_id', 36)->nullable();
      $table->float('discount')->default(0);
      //$table->foreign('parent_id')->references('id')->on('catalogs')->onDelete('restrict');
      $table->enum('status', ['1', '2'])->default(1)->comment('1-active / 2-hidden');
      $table->timestamps();
      $table->softDeletes();
    });

    DB::statement("
      ALTER TABLE `catalogs` 
      ADD CONSTRAINT `catalogs_parent_id_foreign` 
      FOREIGN KEY (`parent_id`) 
      REFERENCES `catalogs` (`id`) 
      ON UPDATE RESTRICT ON DELETE RESTRICT;
    ");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('catalogs');
  }
}
