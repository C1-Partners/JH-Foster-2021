<?php

// ROI Logic
require get_stylesheet_directory() . '/tmpl/roi/algorithm.php';

function roi_scripts_and_styles() 
{
    if( is_page_template('tmpl/tmpl-roi.php') ) {
    	wp_enqueue_style( 'roi-styles', get_stylesheet_directory_uri() . '/tmpl/roi/css/roi.css', array(), null );
    	wp_enqueue_style( 'roi-tooltipster', get_stylesheet_directory_uri() . '/tmpl/roi/css/tooltipster.css', array(), null );
    	wp_enqueue_script('roi-canvasjs', get_stylesheet_directory_uri() . '/tmpl/roi/js/canvasjs.min.js', array(), null, true );
    	wp_enqueue_script('roi-tooltipster', get_stylesheet_directory_uri() . '/tmpl/roi/js/jquery.tooltipster.min.js', array(), null, true );
    	wp_enqueue_script('roi-scripts', get_stylesheet_directory_uri() . '/tmpl/roi/js/roi.js', array(), null, true );
	}
}
add_action('wp_enqueue_scripts', 'roi_scripts_and_styles');

