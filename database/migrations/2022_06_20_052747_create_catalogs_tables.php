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
      $table->bigInteger('parent_id')->unsigned()->nullable();
      $table->foreign('parent_id')->references('id')->on('catalogs')->onUpdate('cascade')->onDelete('cascade');
      $table->timestamps();
    });

    /*DB::table('catalogs')->insert([
      ['title_eng' => 'Not set',     'title_rus' => 'Не задан',  'created_at' => '2022-06-20 16:12:36'],
    ]);*/

    DB::statement("ALTER TABLE catalogs AUTO_INCREMENT = 100000;");
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
