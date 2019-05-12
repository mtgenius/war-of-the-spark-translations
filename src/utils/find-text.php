<?php

// Find a card's type.
function find_text($image, $box, $antialias = 0, $threshold = 128) {
  $text = [];
  $aa = [];
  for ($y = $box[1]; $y < $box[3]; $y++) {
    $text[$y] = [];
    for ($x = $box[0]; $x < $box[2]; $x++) {
      $color = imagecolorsforindex($image, imagecolorat($image, $x, $y));
      $is_text = is_pixel_black($image, $x, $y, $threshold);
      $text[$y][$x] = $is_text ? 1 : 0;
      if (
        $antialias > 0 &&
        $is_text
      ) {
        for ($a = -$antialias; $a <= $antialias; $a++) {
          // $sin = ceil(cos($a / $antialias * M_PI_2));
          for ($b = -$antialias; $b <= $antialias; $b++) {
            array_push($aa, [ $x + $a, $y + $b ]);
          }
        }
      }
    }
  }
  foreach ($aa as $coord) {
    if ($text[$coord[1]][$coord[0]] === 0) {
      $text[$coord[1]][$coord[0]] = 0.5;
    }
  }
  return $text;
}

?>
