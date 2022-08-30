<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


//
class AuthController extends Controller
{
  public function index()
  {
    if(Auth::check()) {
      return redirect()->route('product.index');
    }
    return view('auth.login', ['title' => 'Вход или регистрация']);
  }

  /**
   * https://www.mvideo.ru/
   * https://supunkavinda.blog/php/validate-google-recaptcha-with-ajax-and-php
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    // Ответ по умолчанию
    $response = ['r' => 'error'];
    // Получение принятых json-данных
    $data = $request->json()->all();
    // Если данные не пустые, в них указан номер телефона и код требуемого дейтсвия ...
    if (!empty($data) && !empty($data['phone']) && in_array($data['action'], ['SENT_CODE', 'VERIFIED_CODE'])) {
      // Извличение пользователя по переданному номеру телефона
      $phone = $data['phone'];
      $user = User::where('phone', $phone)->first();

      // Действия
      switch ($data['action']) {
        // Отправка кора
        case 'SENT_CODE':
          // Формирование 6-ти значного значения
          $code = $this->generateCode(6);
          // Если по номеру пользователь не найден - он создается
          if (empty($user)) {
            User::create([
              'id'        => Str::uuid(),
              'phone'     => $phone,
              'password'  => Hash::make($code),
              'code'      => $code,
              'code_c'    => date("Y-m-d H:i:s"),
            ]);

            $response = ['r' => 'send', 't' => 'Код отправлен на номер ' . $phone];
          } else {
            // Если пользователь по номеру найден
            // Проверка что с момента обновления кода прошла одна минута
            if ($user->minuteHasPassed()) {
              $user->fill([
                'password'  => Hash::make($code),
                'code_fail' => $user->code_fail + 1,
                'code'      => $code,
                'code_c'    => date("Y-m-d H:i:s"),
              ]);
              $user->save();
              $response = ['r' => 'send', 't' => 'Мы отправили код на ' . $phone];
            } else {
              $response = ['r' => 'error', 't' => $user->code_c];
            }
          }
          break;

        // Проверка кода
        case 'VERIFIED_CODE':
          $code = !empty($data['code']) ? $data['code'] : false;
          if (!empty($user)) {
            if ($user->checkCode($code)) {
              $response = ['r' => 'success'];

              DB::table('users_sessions')->insert([
                'user_id' => $user->id,
                'action' => 'logon',
                'ip' => $request->ip(),
                'ua' => $request->userAgent(),
              ]);
            } else {
              $response = ['r' => 'error', 't' => 'Неверный код'];
            }
          }

          break;
      }
    }

    return response()->json($response);
  }

  public function signUp(Request $request)
  {
    $request->validate([
      'phone' => 'required',
      'code' => 'required|min:6',
    ]);

    $credentials = $request->only('phone', 'code');
    if (Auth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['code']])) {
      return redirect()->route('product.index')->withSuccess('Signed in');
    }

    return redirect("login")->withSuccess('Phone or code details are not valid');
  }

  public function signOut()
  {
    Session::flush();
    Auth::logout();

    return redirect()->route('product.index');
  }
}