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

  protected $fillable = [
    'id',
    'title',
    'desc',
    'image_preview',
    'image_cnt',
    'views',
    'sales',
    'price',
    'discount',
    'catalog_id',
    'user_id',
    'products_cnt',
    'status',
    'flag'
  ];

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

  public function files()
  {
    return $this->hasMany(File::class);
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getDesc()
  {
    return $this->desc;
  }

  public function getPreview()
  {
    return !empty($this->image_preview) ? '/public/images/' . $this->image_preview : '/public/images/no-photo.png';
  }

  public function getPrice()
  {
    return $this->price;
  }
}
