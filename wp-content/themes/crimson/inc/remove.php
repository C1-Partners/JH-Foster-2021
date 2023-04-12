<?php
/**
 * Remove unwanted default settings, scripts, etc. from core WP and WP Plugins
 * ---------------------------------------------------------------------------
 */



/**
 * Remove Generator Tag that displays the WordPress version
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove Emoji Script from loading on the front
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Removes the comment that Yoast drops in at the end of the page
 */
add_action('wp_head',function() { ob_start(function($o) {
    return preg_replace('/^\n?<!--.*?[Y]oast.*?-->\n?$/mi','',$o);
}); },~PHP_INT_MAX);

/**
 * Removes Additional CSS from customizer
 */
function crimson_customize_register( $wp_customize )
{
   $wp_customize->remove_section('custom_css');
}
add_action( 'customize_register', 'crimson_customize_register' );

/**
 * remove dashicons in frontend for sitespeed
 */
function wpdocs_dequeue_dashicon() {
    if (current_user_can( 'update_core' )) {
        return;
    }
    wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

/**
 * Removes the admin bar from the front of the site
 */
// function removeAdminBarHeading() {
//     remove_action('wp_head', '_admin_bar_bump_cb');
// }
//add_action('get_header', 'removeAdminBarHeading');
//show_admin_bar( false );

/**
 * Customizer (Enabled when commented out below)
 */
// function crimson_remove_customize_capability( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {
// 	if ($cap == 'customize') {
// 		return array('nope'); // return an unknown capability
// 	}
// 	return $caps;
// }
// add_filter( 'map_meta_cap', 'crimson_remove_customize_capability', 10, 4 );

function na_remove_slug( $post_link, $post, $leavename ) {

    if ( 'events' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

function na_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'products', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );


function disable_theme_action() {
    define('DISALLOW_FILE_EDIT', TRUE);
  }
  add_action('init','disable_theme_action');