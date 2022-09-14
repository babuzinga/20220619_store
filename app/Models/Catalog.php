<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
