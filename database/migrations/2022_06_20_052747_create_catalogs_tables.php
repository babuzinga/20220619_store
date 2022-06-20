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
      $table->id('id');
      $table->string('title_eng');
      $table->string('title_rus');
      $table->bigInteger('cat_id')->unsigned()->nullable();
      $table->foreign('cat_id')->references('id')->on('catalogs')->onUpdate('cascade')->onDelete('cascade');
      $table->timestamps();
    });

    DB::statement("ALTER TABLE catalogs AUTO_INCREMENT = 100000;");

    DB::table('catalogs')->insert([
      ['title_eng' => 'badges',     'title_rus' => 'значки',  'created_at' => '2022-06-20 16:12:36'],
      ['title_eng' => 'bags',       'title_rus' => 'сумки',   'created_at' => '2022-06-20 16:12:36'],
      ['title_eng' => 'key-chains', 'title_rus' => 'брелки',  'created_at' => '2022-06-20 16:12:36'],
    ]);
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
