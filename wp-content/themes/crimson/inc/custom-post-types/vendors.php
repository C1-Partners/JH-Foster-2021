<?php
/*
 * Vendors CPT
 */
function crimson_vendor_init() {

    $singleLabel = 'Supplier';
    $pluralLabel = 'Suppliers';

	// register the type
	register_post_type(
		'vendors',
		array(
			'labels'              => array(
				'name'                => _x($pluralLabel, 'Post Type General Name'),
				'singular_name'       => _x($singleLabel, 'Post Type Singular Name'),
				'menu_name'           => __($pluralLabel),
				'parent_item_colon'   => __('Parent ' . $singleLabel),
				'all_items'           => __('All ' . $pluralLabel),
				'view_item'           => __('View ' . $singleLabel),
				'add_new_item'        => __('Add New ' . $singleLabel),
				'add_new'             => __('Add New ' . $singleLabel),
				'edit_item'           => __('Edit ' . $singleLabel),
				'update_item'         => __('Update ' . $singleLabel),
				'search_items'        => __('Search ' . $pluralLabel),
				'not_found'           => __('Not Found'),
				'not_found_in_trash'  => __('Not found in Trash'),
			),
			'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-hammer', // https://developer.wordpress.org/resource/dashicons/
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array(
										'with_front' => false,
										'slug' => '/suppliers'
									),
			'taxonomies'          => array(
										'product-category', 
										'sub-products',
										'vendor-products',
										 'manufacturer-category'
									),
			'show_in_rest'        => true // Set to false to disable Gutenberg-style editor
		)
	);

	register_taxonomy(
		'product-category',
		array('vendors'),
		array(
			'hierarchical' => true,
			'label' => 'Product Categories'
		)
	);

	// register_taxonomy(
	// 	'sub-products',
	// 	array('vendors'),
	// 	array(
	// 		'hierarchical' => true,
	// 		'label' => 'Sub Products'
	// 	)
	// );

	// register_taxonomy(
	// 	'vendor-products',
	// 	array('vendors'),
	// 	array(
	// 		'hierarchical' => true,
	// 		'label' => 'Vendor Products'
	// 	)
	// );

	register_taxonomy(
		'manufacturer-category',
		array('vendors'),
		array(
			'hierarchical' => true,
			'label' => 'Manufacturer Categories'
		)
	);

}

add_action('init', 'crimson_vendor_init');



