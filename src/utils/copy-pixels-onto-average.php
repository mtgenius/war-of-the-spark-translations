<?php

function copy_pixels_onto_average($src, $dst, $pixels, $box, $dof = 50) {
  $avg = average_color($dst, $box);
  foreach ($pixels as $y => $xs) {
    foreach ($xs as $x => $copy) {
      if ($copy > 0) {
        $dst_index = imagecolorat($dst, $x, $y);
        $dst_color = imagecolorsforindex($dst, $dst_index);
        if (
          $dst_color['red'] > $avg['red'] - $dof &&
          $dst_color['red'] < $avg['red'] + $dof &&
          $dst_color['blue'] > $avg['blue'] - $dof &&
          $dst_color['blue'] < $avg['blue'] + $dof &&
          $dst_color['green'] > $avg['green'] - $dof &&
          $dst_color['green'] < $avg['green'] + $dof
        ) {
          copy_pixel($src, $dst, $x, $y, $copy);
        }
      }
    }
  }
}

?>
