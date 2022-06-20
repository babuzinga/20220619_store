<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    // https://laravel.com/docs/8.x/migrations#foreign-key-constraints
    Schema::create('products', function (Blueprint $table) {
      $table->id('id');
      $table->string('title');
      $table->bigInteger('cat_id')->unsigned()->nullable();
      $table->foreign('cat_id')->references('id')->on('catalogs')->onUpdate('cascade')->onDelete('cascade');
      $table->timestamps();
    });

    DB::statement("ALTER TABLE products AUTO_INCREMENT = 100000;");

    DB::table('products')->insert([
      ['title' => 'product 1', 'cat_id' => '100000'],
      ['title' => 'product 2', 'cat_id' => '100000'],
      ['title' => 'product 3', 'cat_id' => '100000'],
      ['title' => 'product 4', 'cat_id' => '100000'],
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}