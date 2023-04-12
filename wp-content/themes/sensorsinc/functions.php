<?php
/**
 * SW standard functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SW
*/

if ( ! function_exists( 'sw_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sw_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on GS Delta, use a find and replace
		 * to change 'pb' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sw', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Register menues
		 * 
		 */
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'sw' ),
			'secondary-menu' => esc_html__( 'Secondary', 'sw' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pb_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'sw_setup' );


// set global variable for google maps api key
global $GMAPS_API_KEY;
$GMAPS_API_KEY = '';

 if ( ! defined( '_S_VERSION' ) ) {
 	// Replace the version number of the theme on each release.
 	define( '_S_VERSION', '1.0.0' );
 }

 if ( ! function_exists('glob_recursive'))
 {
     // Does not support flag GLOB_BRACE
    function glob_recursive($pattern, $flags = 0)
    {
      $files = glob($pattern, $flags);
      foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
      {
        $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
      }
      return $files;
    }
 }

 // load initial libs
 foreach (glob_recursive(get_template_directory()."/lib/*.php") as $filename)
 {
     include_once $filename;
 }

 // include files for components
 include_once get_template_directory()."/components/gsc.php";
 foreach (glob_recursive(get_template_directory()."/components/atoms/*/index.php") as $filename)
 {
     include_once $filename;
 }
 foreach (glob_recursive(get_template_directory()."/components/molecules/*/index.php") as $filename)
 {
     include_once $filename;
 }
 // gsc integrations
 foreach (glob(get_template_directory()."/components/integrations/*.php") as $filename)
 {
     include_once $filename;
 }


 /**
  * Enqueue/dequeue appropriate scripts and styles.
  */
 function gsc_scripts() {
  
  $random_version = rand(0,9999);
  	wp_enqueue_style( 'sw-fonts', "https://use.typekit.net/icp0jla.css", [], _S_VERSION );
	wp_enqueue_style( 'sw-fonts', "https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,300&display=swap", [], _S_VERSION );
 	wp_enqueue_style( 'gsc-style', get_stylesheet_uri(), [], $random_version );
 	wp_enqueue_script( 'gsc-bundle', get_template_directory_uri() . '/bundle.js', ["jquery"], $random_version, true );
 }
 add_action( 'wp_enqueue_scripts', 'gsc_scripts' );

 function editor_styles() {
	wp_enqueue_style( 'editor-style', get_template_directory_uri() . '/editor-style.css' );
}
add_action( 'enqueue_block_editor_assets', 'editor_styles' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

 if( function_exists('acf_add_local_field_group') ):

   if( function_exists('acf_add_local_field_group') ):

   acf_add_local_field_group(array(
   	'key' => 'group_5fcbd0749e7f4',
   	'title' => 'Button Group',
   	'fields' => array(
   		array(
   			'key' => 'field_5fcbd08e01e10',
   			'label' => 'Button',
   			'name' => 'button',
   			'type' => 'true_false',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'message' => '',
   			'default_value' => 1,
   			'ui' => 0,
   			'ui_on_text' => '',
   			'ui_off_text' => '',
   		),
   		array(
   			'key' => 'field_5fcbd0b201e11',
   			'label' => 'Active',
   			'name' => 'active',
   			'type' => 'true_false',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'message' => '',
   			'default_value' => 0,
   			'ui' => 0,
   			'ui_on_text' => '',
   			'ui_off_text' => '',
   		),
   		array(
   			'key' => 'field_5fcbd0c201e12',
   			'label' => 'Type',
   			'name' => 'type',
   			'type' => 'select',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'choices' => array(
   				'default' => 'default',
   				'secondary' => 'secondary',
   				'toggle' => 'toggle',
   				'modal' => 'modal',
   				'icon' => 'icon',
   			),
   			'default_value' => array(
   			),
   			'allow_null' => 0,
   			'multiple' => 0,
   			'ui' => 0,
   			'return_format' => 'value',
   			'ajax' => 0,
   			'placeholder' => '',
   		),
   		array(
   			'key' => 'field_5fcbd0fb01e13',
   			'label' => 'Main',
   			'name' => 'main',
   			'type' => 'text',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'default_value' => '',
   			'placeholder' => '',
   			'prepend' => '',
   			'append' => '',
   			'maxlength' => '',
   		),
   		array(
   			'key' => 'field_5fcbd10401e14',
   			'label' => 'Text',
   			'name' => 'text',
   			'type' => 'text',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'default_value' => '',
   			'placeholder' => '',
   			'prepend' => '',
   			'append' => '',
   			'maxlength' => '',
   		),
   		array(
   			'key' => 'field_5fcbd10c01e15',
   			'label' => 'Url',
   			'name' => 'url',
   			'type' => 'url',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'default_value' => '',
   			'placeholder' => '',
   		),
   		array(
   			'key' => 'field_5fcbd11701e16',
   			'label' => 'target',
   			'name' => 'target',
   			'type' => 'select',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'choices' => array(
   				'__blank' => '__blank',
   				'__self' => '__self',
   				'__parent' => '__parent',
   				'__top' => '__top',
   			),
   			'default_value' => array(
   			),
   			'allow_null' => 0,
   			'multiple' => 0,
   			'ui' => 0,
   			'return_format' => 'value',
   			'ajax' => 0,
   			'placeholder' => '',
   		),
   		array(
   			'key' => 'field_5fcbd15601e17',
   			'label' => 'SVG',
   			'name' => 'svg',
   			'type' => 'icon-picker',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'initial_value' => '',
   		),
   		array(
   			'key' => 'field_5fcbd17101e18',
   			'label' => 'Class',
   			'name' => 'class',
   			'type' => 'text',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'default_value' => '',
   			'placeholder' => '',
   			'prepend' => '',
   			'append' => '',
   			'maxlength' => '',
   		),
   		array(
   			'key' => 'field_5fcbd17701e19',
   			'label' => 'ID',
   			'name' => 'id',
   			'type' => 'text',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'default_value' => '',
   			'placeholder' => '',
   			'prepend' => '',
   			'append' => '',
   			'maxlength' => '',
   		),
   		array(
   			'key' => 'field_5fcbd17d01e1a',
   			'label' => 'Attrs',
   			'name' => 'attrs',
   			'type' => 'repeater',
   			'instructions' => '',
   			'required' => 0,
   			'conditional_logic' => 0,
   			'wrapper' => array(
   				'width' => '',
   				'class' => '',
   				'id' => '',
   			),
   			'collapsed' => '',
   			'min' => 0,
   			'max' => 0,
   			'layout' => 'table',
   			'button_label' => '',
   			'sub_fields' => array(
   				array(
   					'key' => 'field_5fcbd18c01e1b',
   					'label' => 'Attr Label',
   					'name' => 'attr_label',
   					'type' => 'text',
   					'instructions' => '',
   					'required' => 0,
   					'conditional_logic' => 0,
   					'wrapper' => array(
   						'width' => '',
   						'class' => '',
   						'id' => '',
   					),
   					'default_value' => '',
   					'placeholder' => '',
   					'prepend' => '',
   					'append' => '',
   					'maxlength' => '',
   				),
   				array(
   					'key' => 'field_5fcbd19401e1c',
   					'label' => 'Attr Value',
   					'name' => 'attr_value',
   					'type' => 'text',
   					'instructions' => '',
   					'required' => 0,
   					'conditional_logic' => 0,
   					'wrapper' => array(
   						'width' => '',
   						'class' => '',
   						'id' => '',
   					),
   					'default_value' => '',
   					'placeholder' => '',
   					'prepend' => '',
   					'append' => '',
   					'maxlength' => '',
   				),
   			),
   		),
   	),
   	'location' => array(
   		array(
   			array(
   				'param' => 'block',
   				'operator' => '==',
   				'value' => 'acf/button-block',
   			),
   		),
   	),
   	'menu_order' => 0,
   	'position' => 'normal',
   	'style' => 'default',
   	'label_placement' => 'top',
   	'instruction_placement' => 'label',
   	'hide_on_screen' => '',
   	'active' => true,
   	'description' => '',
   ));

   endif;
endif;

//diable ACF editing on live site
if ( wp_get_environment_type() === 'production' ) {
    // Only allow fields to be edited on development
    add_filter( 'acf/settings/show_admin', '__return_false' );

}

/*
 * Register api key for acf/google map integration
 */
function my_acf_google_map_api( $api ){
    $api['key'] = '';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/*
 * Modify WP Query on Category pages
 */
function cat_posts_per_page( $query ) {
	if ( $query->is_main_query() && !is_admin() && is_category() ) {
		$query->set( 'posts_per_page', 18 );
	}
  }
add_filter( 'pre_get_posts', 'cat_posts_per_page' );

/**
 * Add footer logo option to customizer
 */
function add_custom_footer_logo($wp_customize) {
	$wp_customize->add_setting('footer_logo');
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
		'label' => 'Footer Logo',
		'section' => 'title_tagline',
		'settings' => 'footer_logo',
		'priority' => 10
	)));
}

add_action('customize_register', 'add_custom_footer_logo');

// Move Yoast to bottom of admin page
function yoasttobottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/**
 * Include custom functions to modify comments
 */
require get_template_directory() . '/inc/comment-mods.php';

/**
 * Custom ACF Blocks
 */
require get_template_directory() . '/inc/acf-blocks.php';

/**
 * Include open graph function 
 */
require get_template_directory() . '/inc/open-graph.php';

/**
 * Include any functions or modifications to Woocommerce
 */
require get_template_directory() . '/inc/woocommerce-mods.php';

/**
 * Include helper functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Include WP Mods
 */
require get_template_directory() . '/inc/wp-mods.php';

/**
 * Include each custom post type file in /custom-post-types
 */
foreach(glob(get_template_directory() . "/inc/custom-post-types/*.php") as $file){
    require $file;
}

/**
 * Require classes
 */
foreach(glob(get_template_directory() . "/inc/classes/*.php") as $file){
    require $file;
}

