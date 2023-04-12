<?php
function crimson_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress handle displaying the <title> tag
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    add_filter( 'auto_update_plugin', '__return_false' );
    add_filter( 'auto_update_theme', '__return_false' );

    add_filter( 'xmlrpc_enabled', '__return_false' );

}
add_action( 'after_setup_theme', 'crimson_setup' );

/**
 * SEO Configurations
 */
require get_template_directory() . '/inc/seo.php';

/**
 * Modify Search
 */
require get_template_directory() . '/inc/search.php';

/**
 * Helper Functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Remove things from output
 */
require get_template_directory() . '/inc/remove.php';

/**
 * Setup theme components and assets
 */
require get_template_directory() . '/inc/register.php';

/**
 * Tags used by the templates
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Editor mods and custom login
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Custom ACF Blocks
 */
require get_template_directory() . '/inc/acf-blocks.php';

/**
 * Custom ACF Fields
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Theme Customizer
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Woocommerce Support
 */
require get_template_directory() . '/inc/woocommerce.php';


/**
 * Custom Post Types
 * Use a separate file for each post type, named as the plural for the type (members.php, books.php, etc)
 */
require get_template_directory() . '/inc/custom-post-types/vendors.php';
require get_template_directory() . '/inc/custom-post-types/industries.php';
require get_template_directory() . '/inc/custom-post-types/events.php';
require get_template_directory() . '/inc/custom-post-types/products.php';
require get_template_directory() . '/inc/custom-post-types/news.php';

/* Include ROI Calculator template and code from previous developers */
require get_template_directory() . '/tmpl/roi/plug.php';