<?php

function find_ability_box1($image) {

  // Bottom has a MAX of 915.
  // 1040 (card height) - 125 (loyalty height)
  $bottom = 1040 - 120;

  $static_ability_box = find_static_ability_box($image);
  return [
    128,
    $static_ability_box[3],
    685, // 745 (card width) - 60 (border width)
    $bottom
  ];
}

function find_ability_box2($image) {
  $ability_box1 = find_ability_box1($image);
  return [
    128,
    $ability_box1[3],
    595, // 745 (card width) - 150 (loyalty width)
    938
  ];
}

?>
