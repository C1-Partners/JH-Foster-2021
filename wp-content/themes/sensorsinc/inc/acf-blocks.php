<?php
add_action('acf/init', 'sw_acf_init');
function sw_acf_init() {

  if (function_exists('acf_register_block')) {

    $namespace = 'c1-';
    $themeKeywords = array('c1', 'ln');
    $customBlocks = array(
      array( 'hero', 'Hero Block ', 'Front-page hero block', 'shield', array('hero', 'front-page') ),
      array( 'products', 'Products Block', 'Display products', 'shield', array('products', 'product') ),
      array( 'cpt-grid', 'Custom Post Content Grid', 'Displays CPT content', 'shield', array('content', 'cpt') ),
      array( 'people', 'Our People Block', 'Display staff', 'shield', array('people', 'staff') ),
      array( 'callout', 'Callout Block', 'Showcase posts or use as a Subscribe block', 'shield', array('callout', 'content', 'articles', 'subscribe', 'donate') ),
      array( 'pullquote', 'Pull Quote Block ', 'Highlight quotes in articles and pages', 'shield', array('quote', 'pullquote', 'content') ),
      array( 'pages', 'Pages Block ', 'Display pages', 'shield', array('page', 'pages', 'content') ),
      array( 'img-cards', 'Cards Block', 'Image Cards', 'shield', array('card', 'cards', 'content') ),
      array( 'two-col-content', 'Two Column Content Block', 'Two Column', 'shield', array('col', 'two column') ),
    );
    
    foreach ($customBlocks as $block ) {
      acf_register_block(
        [
          'name' => $namespace . $block[0],
          'title' => __($block[1]),
          'description' => __($block[2]),
          'render_callback' => 'sw_acf_block_render_callback',
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
function sw_acf_block_render_callback($block) {
  // convert name ("acf/sw-floating-block") into path friendly slug ("sw-floating-block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "template-parts/block" folder
  if (file_exists(get_theme_file_path("/template-parts/blocks/{$slug}.php"))) {
    include(get_theme_file_path("/template-parts/blocks/{$slug}.php"));
  }
}