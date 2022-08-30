<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
  use SoftDeletes;

  const LIMIT_FAIL_CODE = 10;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'role',
    'name',
    'password',
    'phone',
    'phone_c',
    'email',
    'email_c',
    'telegram',
    'telegram_chat_id',
    'desc',
    'status',
    'flag',
    'code',
    'code_fail',
    'code_c',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  // Для корректной работы с id - в котором используются uuid
  protected $keyType = 'char';
  public $incrementing = false;

  /**
   * Вернет все продукты созданные пользователем (связь один ко многим)
   * https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function products()
  {
    return $this->hasMany(Product::class);
  }

  /**
   * Проверка прав администратора проекта
   * @return bool
   */
  public function isAdmin()
  {
    return !empty($this->role) && $this->role === 'admin';
  }

  public function isUser()
  {
    return !empty($this->role) && $this->role === 'user';
  }

  /**
   * Формирование имени пользователя
   * @return mixed|string
   */
  public function getName()
  {
    return !empty($this->name) ? $this->name : 'Undefined';
  }

  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Проверка что с момента последней отправки кода
   * прошёл переданный интервал времени в минутах
   * @param int $minute
   * @return bool
   */
  public function minuteHasPassed($minute = 1)
  {
    return !empty($this->code_c) && (strtotime($this->code_c) + (60 * $minute)) < time();
  }

  /**
   * @param $code
   * @return bool
   */
  public function checkCode($code)
  {
    if (!empty($this->code) && $this->code == $code) {
      $code_fail = -1;
      $result = true;
    } else {
      $code_fail = $this->code_fail + 1;
      $result = false;
    }

    $this->fill(['code_fail' => $code_fail]);
    $this->save();

    return $result;
  }

  /**
   * Блокировка аккаунта за превышение количества
   * неудачных попыток ввода кода
   * @return bool
   */
  public function blockAccount()
  {
    $this->fill(['status' => 2]);
    $this->save();
    return true;
  }

  /**
   * @return bool
   */
  public function isBlockAccount()
  {
    return $this->getStatus() == 2;
  }
}
