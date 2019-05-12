<?php

ini_set('memory_limit', '4096M');

header('Access-Control-Allow-Headers: content-type');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  exit();
}

foreach ([ 'en', 'jp', 'promo' ] as $key) {
  if (!array_key_exists($key, $_GET)) {
    exit('Missing parameter: ' . $key);
  }
}

$image_strings = [
  'en' => file_get_contents($_GET['en']),
  'jp' => file_get_contents($_GET['jp']),
  'promo' => file_get_contents($_GET['promo'])
];

$en = imagecreatefromstring($image_strings['en']);
$jp = imagecreatefromstring($image_strings['jp']);
$promo_jp = imagecreatefromstring($image_strings['promo']);
$promo_en = imagecreatefromstring($image_strings['promo']);
unset($image_strings);



// Dependencies
include './utils/average-color.php';
include './utils/copy-pixel.php';
include './utils/copy-pixels.php';
include './utils/copy-pixels-onto-average.php';
include './utils/find-ability-box.php';
include './utils/find-static-ability-box.php';
include './utils/find-text.php';
include './utils/find-type-box.php';
include './utils/is-pixel-black.php';
include './utils/magic-erase.php';



//Translate card name.
$name_box_jp = [ 60, 42, 530, 86 ];
$name_box_en = [ 60, 42, 560, 86 ];
$name_text_jp = find_text($promo_jp, $name_box_jp, 1);
magic_erase($promo_en, $name_text_jp);
$name_text_en = find_text($en, $name_box_en, 1, 128);
// copy_pixels_onto_average($en, $promo_en, $name_text_en, $name_box_en, 45);
copy_pixels($en, $promo_en, $name_text_en);

// Translate type box
$type_box = find_type_box($promo_jp);
$type_text_jp = find_text($promo_jp, $type_box, 2);
magic_erase($promo_en, $type_text_jp);
$type_text_en = find_text($en, $type_box, 1);
copy_pixels_onto_average($en, $promo_en, $type_text_en, $type_box);

// Translate the static ability.
$static_ability_box = find_static_ability_box($promo_jp);
$static_ability_text_jp = find_text($promo_jp, $static_ability_box, 2);
magic_erase($promo_en, $static_ability_text_jp);
$static_ability_text_en = find_text($en, $static_ability_box, 1);
copy_pixels($en, $promo_en, $static_ability_text_en);

// Translate the abilities.
$ability_box1 = find_ability_box1($promo_jp);
$ability_box2 = find_ability_box2($promo_jp);
$ability_text1_jp = find_text($promo_jp, $ability_box1, 2);
$ability_text2_jp = find_text($promo_jp, $ability_box2, 2);
magic_erase($promo_en, $ability_text1_jp);
magic_erase($promo_en, $ability_text2_jp);
$ability_text1_en = find_text($en, $ability_box1, 1);
$ability_text2_en = find_text($en, $ability_box2, 1);
copy_pixels($en, $promo_en, $ability_text1_en);
copy_pixels($en, $promo_en, $ability_text2_en);

header('Content-Type: image/png; charset=utf-8');
imagepng($promo_en);

?>
