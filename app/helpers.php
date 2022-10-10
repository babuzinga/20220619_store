<?php

// https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n

define('BASE_DIR', dirname(__FILE__));

if (!function_exists('getUrlWithHash')) {
  /**
   * @param $link
   * @return string
   */
  function get_url_with_hash($link)
  {
    $file = BASE_DIR . '/../public' . $link;
    return file_exists($file) ? $link . '?' . md5_file($file) : '';
  }
}

if (!function_exists('print_array')) {
  /**
   * @param $array
   * @param bool $stop
   */
  function print_array($array, $stop = true)
  {
    echo '<pre>', print_r($array, 1), '</pre>';
    if ($stop) exit;
  }
}