<?php

function find_ability_box1($image) {
  $static_ability_box = find_static_ability_box($image);
  return [
    128,
    $static_ability_box[3],
    685, // 745 (card width) - 60 (border width)
    915 // 1040 (card height) - 125 (loyalty height)
  ];
}

function find_ability_box2($image) {
  return [
    128, 915,
    595, // 745 (card width) - 150 (loyalty width)
    938
  ];
}

?>
