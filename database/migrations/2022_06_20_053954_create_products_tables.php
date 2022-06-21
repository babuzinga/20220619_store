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
      $table->float('price');
      $table->foreignId('catalog_id')->nullable()->constrained()->onDelete('restrict');
      $table->foreignId('user_id')->constrained()->onDelete('restrict');
      $table->timestamps();
    });

    DB::statement("ALTER TABLE products AUTO_INCREMENT = 100000;");

    /*DB::table('products')->insert([
      ['title' => 'product 1', 'price' => 1111, 'cat_id' => '100000', 'user_id' => '',],
      ['title' => 'product 2', 'price' => 1111, 'cat_id' => '100000', 'user_id' => '',],
      ['title' => 'product 3', 'price' => 1111, 'cat_id' => '100000', 'user_id' => '',],
      ['title' => 'product 4', 'price' => 1111, 'cat_id' => '100000', 'user_id' => '',],
    ]);*/
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
