<?php

/**
 * Enqueue parent and child theme styles
 */
add_action( 'wp_enqueue_scripts', 'enqueue_child_styles' );
function enqueue_child_styles() {
    $parenthandle = 'sensorsinc'; // Sensorsinc parent handle
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(), 
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') 
    );
}

/**
 * Include each custom post type file in /custom-post-types
 */
foreach (glob(get_stylesheet_directory() . "/inc/custom-post-types/*.php") as $file){
    require $file;
}

/**
 * Load ACF fields from parent theme
 */
add_filter('acf/settings/load_json', 'load_sensorsinc_field_groups');
function load_sensorsinc_field_groups($paths) {
  $path = get_template_directory().'/acf-json';
  $paths[] = $path;
  return $paths;
}
