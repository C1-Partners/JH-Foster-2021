<?php // helper functions to call in template files


/**
 * Get nav menu items by location
 *
 * @param $location The menu location id
 */
function get_nav_menu_items_by_location( $location, $args = [] ) {

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    // Return menu post objects
    return $menu_items;
}

function has_content($content) {
	return !empty($content) && !ctype_space($content);
}

function get_related_posts( $post_id, $related_count, $args = array() ) {
    $args = wp_parse_args( (array) $args, array(
        'orderby' => 'rand',
        'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
    ) );

    $related_args = array(
        'post_type'      => get_post_type( $post_id ),
        'posts_per_page' => $related_count,
        'post_status'    => 'publish',
        'post__not_in'   => array( $post_id ),
        'orderby'        => $args['orderby'],
        'tax_query'      => array()
    );

    $post       = get_post( $post_id );
    $taxonomies = get_object_taxonomies( $post, 'names' );

    foreach ( $taxonomies as $taxonomy ) {
        $terms = get_the_terms( $post_id, $taxonomy );
        if ( empty( $terms ) ) {
            continue;
        }
        $term_list                   = wp_list_pluck( $terms, 'slug' );
        $related_args['tax_query'][] = array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $term_list
        );
    }

    if ( count( $related_args['tax_query'] ) > 1 ) {
        $related_args['tax_query']['relation'] = 'OR';
    }

    if ( $args['return'] == 'query' ) {
        return new WP_Query( $related_args );
    } else {
        return $related_args;
    }
}