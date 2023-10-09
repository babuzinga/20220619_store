<?php

namespace App\Models;

use App\Models\User;
use App\Models\Catalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
    'amount',
    'status',
    'flag'
  ];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;

  static function getNewProducts($limit = 3)
  {
    return self::latest('created_at')->limit($limit)->get();
  }

  static function getTopProducts($limit = 6)
  {
    return self::orderBy('sales')->limit($limit)->get();
  }

  static function getDiscountProducts($limit = 6)
  {
    return self::orderBy('discount')->limit($limit)->get();
  }

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
    // https://www.itsolutionstuff.com/post/how-to-display-image-from-storage-folder-in-laravelexample.html
    // https://stackoverflow.com/questions/50997652/laravel-retrieve-images-from-storage-to-view



    //$files = $this->files;


    /*if (!empty($this->image_preview)) {
      $link = '/public/images/' . $this->image_preview;
      $link = Storage::disk('public')->get($link);
    } else {
      $link = '/public/images/no-photo.png';
    }
    echo $link; exit;*/


    return '/public/images/no-photo.png';
  }

  /**
   * @return string
   */
  public function getPrice()
  {
    return $this->price . ' руб.';
  }

  public function getAmount()
  {
    return $this->amount;
  }

  public function getCatalog()
  {
    return !empty($this->catalog_id) ? Catalog::where('id', $this->catalog_id)->first() : false;
  }
}
