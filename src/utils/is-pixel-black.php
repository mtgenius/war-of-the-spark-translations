<?php

function is_pixel_black($image, $x, $y, $threshold) {
  $color = imagecolorsforindex($image, imagecolorat($image, $x, $y));
  return (
    $color['red'] <= $threshold &&
    $color['green'] <= $threshold &&
    $color['blue'] <= $threshold
  );
}

?>
