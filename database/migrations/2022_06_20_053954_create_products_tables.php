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
      $table->uuid('id')->primary();
      $table->string('title');
      $table->string('desc', 500)->default('');
      $table->string('image_preview')->nullable();
      $table->integer('image_cnt')->default(0);
      $table->integer('views')->default(0);
      $table->integer('sales')->default(0);
      $table->float('price');
      $table->float('discount')->default(0);
      $table->foreignUuid('catalog_id')->nullable()->constrained()->onDelete('restrict');
      $table->foreignUuid('user_id')->constrained()->onDelete('restrict');
      $table->integer('amount')->default(1);
      $table->enum('status', ['1', '2'])->default(1)->comment('1-active / 2-hidden');
      $table->char('flag', 1)->default(0);
      $table->timestamps();
      $table->softDeletes();
    });

    //DB::statement("ALTER TABLE products AUTO_INCREMENT = 100000;");

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
