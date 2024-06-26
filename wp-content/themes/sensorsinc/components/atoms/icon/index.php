<?php

$defaults = [
  "content" => [
    "category" => '',
    "subcategory" => '',
    "icon" => ''
  ],
  "style" => [
    "svg" => '', // for custom icon svg's not included in library
    "class" => '',
    "id" => '',
    "attrs" => []
  ]
];


gsc_define("icon", $defaults, function($data) {

  $category = $data["content"]["category"];
  $subcategory = $data["content"]["subcategory"];
  $icon = $data["content"]["icon"];

  $class_attr = " class='ico' ";
  if (!empty($data["style"]["class"])) {
    $class_attr = " class='ico {$data["style"]["class"]}'";
  }

  $id_attr = "";
  if (!empty($data["style"]["id"])) {
    $id_attr = "id='{$data["style"]["id"]}'";
  }

  $misc_attrs = "";
  if (!empty($data["style"]["attrs"])) {
    foreach ($data["style"]["attrs"] as $attr_name=>$attr_value) {
      $misc_attrs .= "$attr_name='$attr_value' ";
    }
  }

  $svg = '';

  if (!empty($data["style"]["svg"])) {
    $svg = $data["style"]["svg"];
  } else {
    global $gsc_all_icons;
    if (empty($gsc_all_icons)) {
      $gsc_all_icons = glob_recursive(__DIR__ ."/icon-set/**/*.svg");
    }
    //var_dump($gsc_all_icons);
    $regex = "/\/{$icon}\.svg/";
    //var_dump($regex);
    $matches = array_values(preg_grep($regex, $gsc_all_icons));
    //var_dump($matches);
    if (!empty($matches)) {
      $svg = file_get_contents($matches[0]);
      //var_dump($svg);
    }
    /*
    $folders = scandir(__DIR__ . '/icon-set/');

    // folder search loop
    foreach ($folders as $folder) {
      if (strpos($folder, $category) !== false) {
        $subfolders = scandir(__DIR__ . '/icon-set/' . $folder . '/');

        // sub folder search loop
        foreach ($subfolders as $subfolder) {
          if (strpos($subfolder, $subcategory) !== false) {
            $files = scandir(__DIR__ . '/icon-set/' . $folder . '/' . $subfolder . '/');

            // file search loop
            foreach ($files as $file) {
              if (strpos($file, $icon) !== false) {
                $svg = file_get_contents(__DIR__ . '/icon-set/' . $folder . '/' . $subfolder . '/' . $file);
              }
            }
          }
        }
      }
    } */
  }

  return "<span {$class_attr} {$id_attr} {$misc_attrs}> {$svg} </span>";
});
gsc_meta("icon", [ATOM]);
gsc_test("icon", "", function() {
  echo gsc("icon", [
    "content" => [
      "category" => 'Technology',
      "subcategory" => 'Automated-Translation',
      "icon" => 'chat-translate'
    ]
  ]);
});
gsc_test("icon", "", function() {
  echo gsc("icon", [
    "content" => [
      "category" => 'Arrows-Diagrams',
      "subcategory" => 'Arrows',
      "icon" => 'arrow-right'
    ]
  ]);
});
gsc_test("icon", "Custom Class and Attrs", function() {
  echo gsc("icon", [
    "content" => [
      "category" => "Technology",
      "subcategory" => "Automated-Translation",
      "icon" => "chat-translate"
    ],
    "style" => [
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
    ]
  ]);
});
 ?>
