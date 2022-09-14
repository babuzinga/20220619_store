<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'id',
    'filename',
    'path',
    'mime_type',
    'product_id',
    'user_id',
    'status'
  ];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;
}
