<?php
$defaults = [
  "content" => [
		"title" => "",
		"heading" => "",
		"subtitle" => "",
		"text" => "",
		"cta" => "",
		"cta_url" => "",
		"acf_obj" => "",
		"list_title" => "",
		"list_items" => [],
		"img_src" => "",
		"img_alt" => "",
		"logo_src"	=> "",
		"logo_alt" => "",
	],
  "style" => [
		"type" => "standard", // can be "standard", "orange", "teal", "img_overlap", "callout", "resources_primary", or "resources_secondary"
		"cta_type" => "button", // can be "button" or "link_text", though really if you give it anything besides "button" it'll behave like "link_text" was entered
    "class" => '',
    "id" => '',
    "attrs" => [],
	],
];
gsc_define("ui-card", $defaults, function($data) {

	// Setting up useful variables including shorthand variables and SVG images
	$type = str_replace('_', '-', $data["style"]["type"]);
	$card_title = $data["content"]["title"];
	$heading = $data["content"]["heading"];
	$subtitle = $data["content"]["subtitle"];
	$text = $data["content"]["text"];
	$cta = $data["content"]["cta"];
	$cta_url = $data["content"]["cta_url"];
	$acf_obj = $data["content"]["acf_obj"];
	$list_title = $data["content"]["list_title"];
	$list_items = $data["content"]["list_items"];
	$img_src = $data["content"]["img_src"];
	$img_alt = $data["content"]["img_alt"];
	$logo_src = $data["content"]["logo_src"];
	$logo_alt = $data["content"]["logo_alt"];
	$svg_diploma = file_get_contents(__DIR__ . "/diploma.svg");
	$svg_book = file_get_contents(__DIR__ . "/book.svg");
	$cta_link_class = $data["style"]["cta_type"] == "button" ? "btn" : "link__content";
	if ($type == "img-overlap") {
		$cta_link_class = "link__content";
	}

	$acf_link = "";
	if (!empty($acf_obj)) {
		$url = $acf_obj["url"];
		$title = $acf_obj["title"];
		$target = $acf_obj["target"];
	} elseif (empty($acf_obj)) {
		$url = $cta_url;
		$target = '_self';
	}

	// Deal with the classes that need to be on the card
	$class = 'card ' . $data["style"]["class"];

	$alt_cards = ["orange", "teal", "callout", "resources-primary", "resources-secondary"];
	if (in_array($type, $alt_cards)) {
		$class .= " card--alt card--" . $type;
	}
	if ($type == "img-overlap") {
		$class .= " card--" . $type;
	}
	if ($type == "resources-primary" || $type == "resources-secondary") {
		$class .= " card--resources";
	}

	// START ASSEMBLING HTML
	// Build <aside />
	$aside_html = "";
	$logo_html = "";
	if ($img_src) {
		$aside_html = gsc("img", [
						"content" => [
							"src" => $img_src[0],
							"alt" => $img_alt,
						],
						"style" => [
							"class" => "card__img",
						],
					]);
		if ($logo_src) {
			$logo_html = gsc("img", [
				"content" => [
					"src" => $logo_src,
					"alt" => $logo_alt,
				],
				"style" => [
					"class" => "card__logo",
				],
			]);
		}
		if ($heading) {
			$aside_html = "
			<a class='tlnk' href='$url' title='$title' target='$target'>
			<h4 class='card__heading'>$heading</h4>
			</a>
			<aside class='card__aside'>
				<figure class='card__figure figure--graphic-ovrly'>
					<a class='tlnk' href='$url' title='$title' target='$target'>
						$aside_html
						$logo_html
					</a>
				</figure>
			</aside>";
		} else {
			$aside_html = "
			<aside class='card__aside'>
				<figure class='card__figure figure--graphic-ovrly'>
					<a class='tlnk' href='$url' title='$title' target='$target'>
						$aside_html
						$logo_html
					</a>
				</figure>
			</aside>";
		}
		
	}

	// Build <div class="card__main" />
	$main_html = "";
		// Build <header class="card__header" />
		$header_html = "";
		if ($card_title || $subtitle) {
			if ($type == "resources-primary") {
				$header_html .= "<div class='ico--circle'>$svg_diploma</div>";
			}
			if ($type == "resources-secondary") {
				$header_html .= "<div class='ico--circle'>$svg_book</div>";
			}
			// If we have to move the titles over because there's a glyph on the left (resources cards),
			// then wrap them in <div class="card__heading" />
			if ($type == "resources-primary" || $type == "resources-secondary") {
				$header_html .= "<div class='card__heading'>";
			}
			
			if ($card_title) {
				$header_class = "card__title";
				if ($type == 'callout') {
					$header_class .= " title--border-left";
				}
				$header_html .= "<h2 class='$header_class'>$card_title</h2>";
			}
			if ($subtitle) {
				$header_html .= "<span class='card__subtitle title--sub-md'>$subtitle</span>";
			}
			// End of wrapping resources card in <div class="card__heading" />
			if ($type == "resources-primary" || $type == "resources-secondary") {
				$header_html .= "</div>";
			}
			$header_html = "
				<header class='card__header'>
					$header_html
				</header>";
		}

		// Build <div class="card__body" />
		$body_html = "";
		if ($text || $list_title || !empty($list_items)) {

			if ($list_title) {
				$body_html .= "<h3 class='card__body-heading'>$text</h3>";
			}

			if ($text) {
				$body_html .= "<p class='card__copy'>$text</p>";
			}

			if (!empty($list_items)) {
				$list_html = "";
				foreach ($list_items as $item) {
					$item_html = $item["content"];
					if ($item["url"]) {
						$item_url = $item["url"];
						$item_title = $item["title"] ? $item["title"] : "";
						$item_html = "<a class='card__link' href='$item_url' title='$item_title'>$item_html</a>";
					}

					$list_html .= "<li class='card__item'>$item_html</li>";
				}
				$body_html .= "
					<ul class='card__list'>
						$list_html
					</ul>";
			}

			$body_html = "
				<div class='card__body'>
					$body_html
				</div>";
		}

		// Build <footer class="card__footer" /> with CTA link
		$footer_html = "";
		if ($acf_obj) {
			$footer_html .= "<a class='$cta_link_class' href='$url' title='$title' target='$target'>$cta</a>";
		} 
		if ($cta_url) {
			$footer_html .= "<a class='$cta_link_class' href='$cta_url'>$cta</a>";
		}
		if ($cta_link_class == "link__content") {
			$footer_html = "<div class='link'>$footer_html</div>";
		}
		$footer_html = "
			<footer class='card__footer'>
				<div class='card__actions'>
					$footer_html
				</div>
			</footer>";
		

	// Build the <div class="card__main">, which will include a <div class="card__wrap"> if it's an overlap card
	$main_html = "$header_html
								$body_html
								$footer_html";

	if ($type == "img-overlap") {
		$main_html = "
			<div class='card__wrap'>
				$main_html
			</div>";
	}

	$main_html = "
		<div class='card__main'>
			<a class='tlnk' href='$cta_url'>
				$main_html
			</a>
		</div>";

	// Standard style attribute stuff
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

	$content = "<article $misc_attrs $id_attr class='$class'>
								$aside_html
								$main_html
							</article>";

	return $content;
});
gsc_meta("ui-card", [MOLECULE]);
gsc_test("ui-card", "", function() {

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
			"img_src" => get_template_directory_uri()."/images/temp/placeholder.png",
			"img_alt" => "this is example img alt text!",
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
			"img_src" => get_template_directory_uri()."/images/temp/placeholder.png",
			"img_alt" => "this is example img alt text!",
		],
		"style" => [
			"cta_type" => "link_text",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => 'attr'
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
		],
		"style" => [
			"type" => "orange",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
		],
		"style" => [
			"type" => "teal",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
			"img_src" => get_template_directory_uri()."/images/temp/img-grphc-ovrly.jpg",
			"img_alt" => "this is example img alt text!",
		],
		"style" => [
			"type" => "img_overlap",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "The 62 Fastest Growing Careers in VT Right Now",
			"text" => "The Hope Center for College, Community, and Justice released a great resource for today’s students navigating the COVID-19 emergency. It provides national resources for securing food and housing, supporting mental health",
			"cta_url" => "https://example.com",
		],
		"style" => [
			"type" => "callout",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "High School + Training",
			"subtitle" => "Highest Level of Education Require",
			"list_title" => "Type of Credentials",
			"list_items" => [
				[
					"content" => "Apprenticeship Certificate",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Associate’s Degree",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Apprenticeship Certificate",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Associate’s Degree",
					"url" => "#",
					"title" => "Link title goes here!"
				],
			],
		],
		"style" => [
			"type" => "resources_primary",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

	echo "<br />";

	echo gsc("ui-card", [
		"content" => [
			"title" => "Programs in Vermont",
			"subtitle" => "Education &amp; Training",
			"list_title" => "Type of Credentials",
			"list_items" => [
				[
					"content" => "Elementary Education",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Transition to Teaching Licensure Program",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Mortuary Science Resident Trainee License",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Secondary Education Transition to Teaching Licensure Program",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Elementary Education",
					"url" => "#",
					"title" => "Link title goes here!"
				],
				[
					"content" => "Transition to Teaching Licensure Program",
					"url" => "#",
					"title" => "Link title goes here!"
				],
			],
		],
		"style" => [
			"type" => "resources_secondary",
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
		],
	]);

});
