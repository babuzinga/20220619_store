<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['id', 'title', 'parent_id'];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
