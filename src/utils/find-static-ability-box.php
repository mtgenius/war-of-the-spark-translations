<?php

function find_static_ability_box($image) {
  $type_box = find_type_box($image);
  $static_ability_box = [
    95,
    $type_box[3] + 28,
    680,
    $type_box[3] + 29
  ];
  while ($static_ability_box[3] < 1040) {
    $static_ability_box[3] = $static_ability_box[3] + 1;
    $color = imagecolorsforindex(
      $image,
      imagecolorat($image, 95, $static_ability_box[3])
    );
    if (
      $color['red'] < 64 &&
      $color['green'] < 64 &&
      $color['blue'] < 64
    ) {
      break;
    }
  }
  $static_ability_box[3] = $static_ability_box[3] - 12;
  return $static_ability_box;
}
