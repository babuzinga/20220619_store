<?php

/**
 *
 * https://www.tutorialspoint.com/how-to-resize-image-in-php
 * @param $file_name
 * @param $width
 * @param $height
 * @param bool $crop
 * @return false|resource
 */
function image_resize($file_name, $width, $height, $crop = FALSE)
{
  list($wid, $ht) = getimagesize($file_name);
  $r = $wid / $ht;
  if ($crop) {
    if ($wid > $ht) {
      $wid = ceil($wid - ($width * abs($r - $width / $height)));
    } else {
      $ht = ceil($ht - ($ht * abs($r - $width / $height)));
    }
    $new_width = $width;
    $new_height = $height;
  } else {
    if ($width / $height > $r) {
      $new_width = $height * $r;
      $new_height = $height;
    } else {
      $new_height = $width / $r;
      $new_width = $width;
    }
  }
  $source = imagecreatefromjpeg($file_name);
  $dst = imagecreatetruecolor($new_width, $new_height);
  image_copy_resampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
  return $dst;
}

$img_to_resize = image_resize('/path/to/some/image.jpg', 250, 250);
