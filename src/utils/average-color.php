<?php

function average_color($image, $box) {
  $red = 0;
  $green = 0;
  $blue = 0;
  $count = 0;
  for ($y = $box[1]; $y < $box[3]; $y++) {
    for ($x = $box[0]; $x < $box[2]; $x++) {
      $count++;
      $color = imagecolorsforindex(
        $image,
        imagecolorat($image, $x, $y)
      );
      $red += $color['red'];
      $green += $color['green'];
      $blue += $color['blue'];
    }
  }
  $red = round($red / $count);
  $green = round($green / $count);
  $blue = round($blue / $count);
  return [
    'red' => $red,
    'green' => $green,
    'blue' => $blue
  ];
}

?>
