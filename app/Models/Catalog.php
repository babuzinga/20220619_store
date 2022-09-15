<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Catalog extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'id',
    'title',
    'catalog_id',
    'products_amount',
  ];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;

  /**
   * Выборка "корневых" каталогов
   * @return mixed
   */
  static function getRootCatalogs()
  {
    return self::where('catalog_id', Null)->get();
  }

  /**
   * Обновление количества продуктов
   * @return mixed
   */
  static function updateAmountProducts()
  {
    DB::update('
      UPDATE catalogs 
      SET products_amount = (
        SELECT COUNT(id) 
        FROM products 
        WHERE 
          deleted_at IS NULL AND 
          amount > 0 AND 
          status = 1 AND 
          products.catalog_id = catalogs.id
      )
    ');
  }

  /**
   * Выборка всех продуктов относящихся к каталогу
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function products()
  {
    return $this->hasMany(Product::class);
  }

  /**
   * Выборка всех дочерних каталогов
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function catalogs()
  {
    return $this->hasMany(Catalog::class);
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getAmountProducts()
  {
    return $this->products_amount;
  }

  public function getBreadcrumb($data = [])
  {
    if (!empty($this->catalog_id)) {
      $catalog = self::where('id', $this->catalog_id)->first();
      $data[] = ['link' => route('catalog.show', ['catalog' => $catalog->id]), 'title' => $catalog->getTitle()];
      $data = $catalog->getBreadcrumb($data);
    }

    return $data;
  }
}
