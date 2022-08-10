<?php

namespace App\Models;

use App\Models\User;
use App\Models\Catalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['id', 'title', 'price', 'catalog_id', 'user_id'];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;

  /**
   * Извлечение владельца задачи (связь инверсия один ко многим)
   * https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-inverse
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function catalog()
  {
    return $this->belongsTo(Catalog::class);
  }
}
