<?php

function copy_pixels($src, $dst, $pixels) {
  foreach ($pixels as $y => $xs) {
    foreach ($xs as $x => $copy) {
      if ($copy > 0) {
        copy_pixel($src, $dst, $x, $y, $copy);
      }
    }
  }
}

?>
