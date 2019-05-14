<?php

// Find a card's type box.
function find_type_box($image) {

  // Vivien Reid has a threshold of 30 non-conforming pixels in her type box.
  $error_threshold = 30;
  $find_type_box_dof = 15;

  // Starting at the bottom left, where the rules text has a black border.
  for ($y = 900; $y > 1; $y--) {

    // Check if all pixels from 75 to 645 are the same color.
    // A change in color denotes a rules text box.
    // A similarity in color represents the type box.
    $leftmost_color = imagecolorsforindex(
      $image,
      imagecolorat($image, 75, $y)
    );
    $errors = 0;
    for ($x = 76; $x < 645; $x++) {
      $color = imagecolorsforindex($image, imagecolorat($image, $x, $y));
      if (
        $color['red'] < $leftmost_color['red'] - $find_type_box_dof ||
        $color['red'] > $leftmost_color['red'] + $find_type_box_dof ||
        $color['green'] < $leftmost_color['green'] - $find_type_box_dof ||
        $color['green'] > $leftmost_color['green'] + $find_type_box_dof ||
        $color['blue'] < $leftmost_color['blue'] - $find_type_box_dof ||
        $color['blue'] > $leftmost_color['blue'] + $find_type_box_dof
      ) {
        $errors++;
        if ($errors >= $error_threshold) {
          break;
        }
      }
    }

    if ($errors < $error_threshold) {
      return [ 57, $y - 55, 560, $y - 12 ];
    }
  }
}

?>
