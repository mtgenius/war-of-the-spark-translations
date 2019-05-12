<?php

function copy_pixel($src, $dst, $x, $y, $weight = 1) {
  $src_index = imagecolorat($src, $x, $y);
  $new_color = imagecolorsforindex($src, $src_index);
  if ($weight < 1) {
    $dst_color = imagecolorsforindex($dst, imagecolorat($dst, $x, $y));
    $new_color = [
      'red' =>
        $dst_color['red'] +
        ($new_color['red'] - $dst_color['red']) * $weight,
      'green' => 
        $dst_color['green'] +
        ($new_color['green'] - $dst_color['green']) * $weight,
      'blue' =>
        $dst_color['blue'] +
        ($new_color['blue'] - $dst_color['blue']) * $weight
    ];
  }
  $new_index = imagecolorallocate(
    $dst,
    $new_color['red'],
    $new_color['green'],
    $new_color['blue']
  );
  imagesetpixel($dst, $x, $y, $new_index);
}

?>
