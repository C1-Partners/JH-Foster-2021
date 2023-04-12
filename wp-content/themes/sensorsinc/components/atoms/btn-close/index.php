<?php /*
<!-- Link styled as button -->
<a href="#" class="btn">Contact Us</a>

<!-- Button element with base .btn styling -->
<button type="button" class="btn">Contact Us</button>
 */
 $defaults = [
  "content" => [
    "id" => "",
    "class" => "",
    "text"  => "",
    "attrs" => []
  ]
 ];
gsc_define("btn-close", $defaults, function ($data) {

  $misc_attrs = "";
  if (!empty($data["content"]["attrs"])) {
    foreach ($data["content"]["attrs"] as $attr_name=>$attr_value) {
      $misc_attrs .= "$attr_name='$attr_value'";
    }
  }

  return "
    <button type='button' class='btn btn--close {$data['content']['class']}' {$data['content']['id']} {$misc_attrs}>
      
        <svg xmlns='http://www.w3.org/2000/svg' width='19' height='19' viewbox='0 0 19 19' aria-hidden='true'>
          <title>Close view</title>
          <g transform='translate(-206.694 -4382.689)'>
            <g transform='translate(207.755 4383.75)'>
              <path class='ico__path' d='M207.755,4401.75l18-18' transform='translate(-207.755 -4383.75)' />
              <path class='ico__path' d='M225.755,4401.75l-18-18' transform='translate(-207.755 -4383.75)' />
            </g>
          </g>
        </svg>
        <span>{$data['content']['text']}</span>
      
      
    </button>";
});
gsc_meta("btn-close", [ATOM]);
gsc_test("btn-close", "basic close button", function() {
  echo gsc("btn-close", []);
});
gsc_test("btn-close", "basic close button (custom class and attrs)", function() {
  echo gsc("btn-close", [
    "content" => [
      "class" => "custom-class",
      "attrs" => [
        "custom-attr" => "attr"
      ]
    ]
  ]);
});
