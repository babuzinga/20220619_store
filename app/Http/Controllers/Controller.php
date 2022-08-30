<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  /**
   * @param $array
   * @param bool $stop
   */
  public function print_array($array, $stop = true)
  {
    echo '<pre>', print_r($array, 1), '</pre>';
    if ($stop) exit;
  }

  /**
   * @param $number
   * @return string
   */
  public function generateCode($number)
  {
    $symbols = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

    $code = "";
    for ($i = 0; $i < $number; $i++) {
      $index = rand(0, count($symbols) - 1);
      $code .= $symbols[$index];
    }
    return $code;
  }
}
