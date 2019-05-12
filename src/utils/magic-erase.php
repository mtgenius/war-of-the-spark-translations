<?php

// Erase a text pixel as seen in source from destination by grabbing the
//   nearest non-text pixel.
function magic_erase($image, $pixels) {
  foreach ($pixels as $y => $xs) {
    foreach ($xs as $x => $erase) {
      if ($erase > 0) {
        $radians = 0;
        $radius = 1;
        do {
          $radians += M_PI / 6;
          if ($radians >= 2 * M_PI) {
            $radians = 0;
            $radius++;
          }
          $nearest_x = $x + round($radius * cos($radians));
          $nearest_y = $y + round($radius * sin($radians));
        } while ($pixels[$nearest_y][$nearest_x] > 0);
        $nearest_color = imagecolorat($image, $nearest_x, $nearest_y);

        // Replace this pixel with the nearest non-text color.
        imagesetpixel($image, $x, $y, $nearest_color);
      }
    }
  }
}

?>
