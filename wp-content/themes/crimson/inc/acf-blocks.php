<?php
add_action('acf/init', 'crimson_acf_init');
function crimson_acf_init()
{
  if (function_exists('acf_register_block')) {

    $namespace = 'c1-';
    $themeKeywords = array('c1', 'en');
    $customBlocks = array(
      array( 'hero', 'Hero Block ', 'Front-page hero block', 'shield', array('hero', 'front-page') ),
      array( 'product-card', 'Product Line Configurator', 'Allow users to sort prodcuts on front-end', 'shield', array('product') ),
      array( 'img-repeater', 'Image Repeater Block ', 'Repeater block for Images', 'shield', array('image') ),
      array( 'img-accordion', 'Image Accordion Block ', '2 Column Image and Accordion Block', 'shield', array('image', 'accordion', 'two column') ),
      array( 'accordion', 'Accordion Block ', 'Solo Accordion Block', 'shield', array('accordion') ),
      array( 'showcase', 'Product Showcase Block ', 'Display Vendor Products', 'shield', array('product', 'showcase') ),
      array( 'two-col-content', 'Two Column Content Block ', 'Two Column', 'shield', array('col', 'two column') ),
      array( 'logo-slider', 'Vendor Logo Slider', 'Vendor Logos', 'shield', array('slider', 'vendor logos') ),
      array( 'cta', 'CTA Block', 'Call to action', 'shield', array('cta', 'call to action') ),
      array( 'cta-alt', 'Alternate CTA Block', 'Call to action', 'shield', array('cta', 'call to action') ),
      array( 'robot-fte-calc', 'Robot VS FTE Block', 'Calculator Block', 'shield', array('robot', 'full time employee', 'robot vs fte') ),
    );

    foreach ($customBlocks as $block ) {
      acf_register_block(
        [
          'name' => $namespace . $block[0],
          'title' => __($block[1]),
          'description' => __($block[2]),
          'render_callback' => 'crimson_acf_block_render_callback',
          'category' => 'layout',
          'icon' => $block[3],
          'mode' => 'preview',
          'supports' => [
              'align' => false,
              'mode' => false,
          ],
          'keywords' => array_merge($themeKeywords, $block[4]),
        ]
      );
    }
  }
}


//load in the appropriate blocks
function crimson_acf_block_render_callback($block)
{
  // convert name ("acf/ep-floating-block") into path friendly slug ("ep-floating-block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "template-parts/block" folder
  if (file_exists(get_theme_file_path("/template-parts/block/{$slug}.php"))) {
    include(get_theme_file_path("/template-parts/block/{$slug}.php"));
  }
}