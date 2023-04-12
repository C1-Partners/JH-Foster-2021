<?php

/**
 * Enqueue scripts and styles.
 */
function crimson_scripts() {
    global $c1Helpers;

	wp_enqueue_style( 'site-styles', $c1Helpers->compiledAsset('/css/app.css'), false, null );
	wp_enqueue_script( 'site-scripts', $c1Helpers->compiledAsset('/js/app.js'), array('jquery'), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'crimson_scripts' );

/**
 * Set up theme menus
 */
function crimson_menus() {
	register_nav_menus( array(
    'primary-menu' => esc_html__( 'Primary Menu', 'crimson' ),
    'footer-menu' => __('Footer Menu', 'crimson'),
	) );
}
add_action( 'after_setup_theme', 'crimson_menus' );

/**
 * ACF Options page
 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Site Options');
}

/**
 * Image Sizes
 * add_image_size( identifier, width, height, hard crop )
 */
add_image_size( 'hero', 1200, 400, true );

/**
 * Image Type Support
 * http://www.iana.org/assignments/media-types/media-types.xhtml
 */
function crimson_mime_types($mimes) {
    $mimes['webp'] = 'image/webp';
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'crimson_mime_types');

/**
 * Fixes SVG uploads not properly having their height and width set
 */
function crimson_svg_meta_data($data, $id) {
    $attachment = get_post($id);
    $mime_type = $attachment->post_mime_type;

    if($mime_type == 'image/svg+xml'){
      if(empty($data) || empty($data['width']) || empty($data['height'])){
        $url = wp_make_link_relative(wp_get_attachment_url($id));
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].$url);
        $attr = $xml->attributes();
        $viewbox = explode(' ', $attr->viewBox);
        $data['width'] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
        $data['height'] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
      }
    }

    return $data;
}
add_filter('wp_update_attachment_metadata', 'crimson_svg_meta_data', 10, 2);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function crimson_content_width() {
	// This variable is intended to be overruled from themes.w
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'crimson_content_width', 640 );
}
add_action( 'after_setup_theme', 'crimson_content_width', 0 );

/**
 * Scroll to Gravity Form upon submission and reloading of page
 */
add_filter( 'gform_confirmation_anchor', '__return_true' );

/**
 * A custom logo to Customizer
 */
add_theme_support( 'custom-logo' );

function crimson_register_widgets_init() {
  // register_sidebar( array(
  //     'name'          => __( 'Footer A1', 'textdomain' ),
  //     'id'            => 'footer-a1',
  //     'description'   => __( 'Footer A1.', 'textdomain' ),
  //     'before_widget' => '<div id="%1$s" class="widget %2$s">',
  //     'after_widget'  => '</div>',
  //     'before_title'  => '<h2 class="widgettitle">',
  //     'after_title'   => '</h2>',
  // ) );
  register_sidebar( array(
    'name'          => __( 'Footer 1', 'textdomain' ),
    'id'            => 'footer-b1',
    'description'   => __( 'Footer 1', 'textdomain' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Footer 2', 'textdomain' ),
    'id'            => 'footer-b2',
    'description'   => __( 'Footer 2', 'textdomain' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<a href="/resources/"><h2 class="widgettitle">',
    'after_title'   => '</h2></a>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Footer 3', 'textdomain' ),
    'id'            => 'footer-b3',
    'description'   => __( 'Footer 3', 'textdomain' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<a href="/about/"><h2 class="widgettitle">',
    'after_title'   => '</h2></a>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'textdomain' ),
    'id'            => 'sidebar',
    'description'   => __( 'Sidebar', 'textdomain' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'crimson_register_widgets_init' );

/**
 * Add custom scripts for header & footer
 */
function crimson_header_scripts() {
  echo get_theme_mod( 'crimson_header_scripts' );
}

add_action('wp_head', 'crimson_header_scripts');


function crimson_footer_scripts() {
  echo get_theme_mod( 'crimson_footer_scripts' );
}

add_action('wp_footer', 'crimson_footer_scripts');

/**
 * Add class to top level nav links only
 */
add_filter( 'nav_menu_link_attributes', 'add_class_anchor_nav_primary', 10, 3 );
function add_class_anchor_nav_primary( $atts, $item, $args ) {
    if ( (int) $item->menu_item_parent === 0 ) {
        $class         = 'top-link';
        $atts['class'] = $class;
    }

    return $atts;
}

/*
CHANGE SLUGS OF CUSTOM POST TYPES
*/
function change_post_types_slug( $args, $post_type ) {

  /*item post type slug*/   
  if ( 'vendors' === $post_type ) {
     $args['rewrite']['slug'] = 'suppliers';
  }

  return $args;
}
add_filter( 'register_post_type_args', 'change_post_types_slug', 10, 2 );


/*
 * Set custom Excerpt function used on vendors archive pages
 */
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt) >= $limit) {
      array_pop($excerpt);
      $excerpt = implode(" ", $excerpt) . '...';
  } else {
      $excerpt = implode(" ", $excerpt);
  }

  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);

  if (count($content) >= $limit) {
      array_pop($content);
      $content = implode(" ", $content) . '...';
  } else {
      $content = implode(" ", $content);
}

$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content); 
$content = str_replace(']]>', ']]&gt;', $content);

return $content;
}

/*
 * Set custom Excerpt length 
 */
// function custom_excerpt_length( $length ) {
//   return 20;
// }
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*
 * Query custom posts
 */
function get_custom_posts($sbPostType, $sbTaxonomy, $sbPostSlug) {

    $posts = [];

    $args = ([
        'post_type' => $sbPostType,
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order'   => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => $sbTaxonomy,
                'field'    => 'slug',
                'terms'    => $sbPostSlug,
            ),
        )
    ]);
    
    $postsQuery = new WP_Query( $args );

    if($postsQuery->have_posts()) {
        while($postsQuery->have_posts()) {
            $postsQuery->the_post();
          
           $posts[] = $postsQuery->post;
        }
    }

    wp_reset_postdata();

    return $posts;
}

/*
 * Create custom checkboxes on GF 3
 */
add_filter( 'gform_pre_render_3', 'populate_checkbox' );
add_filter( 'gform_pre_validation_3', 'populate_checkbox' );
add_filter( 'gform_pre_submission_filter_3', 'populate_checkbox' );
add_filter( 'gform_admin_pre_render_3', 'populate_checkbox' );
function populate_checkbox( $form ) {

  global $postsAll, $sbPostType, $sbTaxonomy, $sbPostSlug;
  
    foreach( $form['fields'] as &$field )  {
  
        //NOTE: replace 3 with your checkbox field id
        $field_id = 7;
        if ( $field->id != $field_id ) {
            continue;
        }
        
        $posts = get_custom_posts($sbPostType, $sbTaxonomy, $sbPostSlug);

        $input_id = 1;
        foreach( $posts as $post ) {
  
            //skipping index that are multiples of 10 (multiples of 10 create problems as the input IDs)
            if ( $input_id % 10 == 0 ) {
                $input_id++;
            }
  
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
            $inputs[] = array( 'label' => $post->post_title, 'id' => "{$field_id}.{$input_id}" );
            
            $input_id++;
        }
  
        $field->choices = $choices;
        $field->inputs = $inputs;
  
    }
  
    return $form;
}


