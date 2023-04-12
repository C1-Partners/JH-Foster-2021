<?php

/**
 * Add WooCommerce Support
 */
function crimson_woocommerce_setup() {
    //Declare WooCommerce Support
    add_theme_support( 'woocommerce' );
  
    //Add support for image gallery options
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
  }
  
  add_action( 'after_setup_theme', 'crimson_woocommerce_setup' );
  
  function crimson_woocommerce_edit_actions() {
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
  }
  
  add_action( 'after_setup_theme', 'crimson_woocommerce_edit_actions' );