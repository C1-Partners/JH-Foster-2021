<?php

/*
 * Creates the Documentation tab for products
 */
if (class_exists('acf') && class_exists('WooCommerce')) {
    add_filter('woocommerce_product_tabs', function($tabs) {
		global $post, $product;  // Access to the current product
		$documentation_tab = get_field('product_documentation', $post->ID); // ACF Group Tab
        $documentation_files = $documentation_tab['doc_files']; // Documentation Repeater
 
		if (!empty($documentation_files)) {
			$start_at_priority = 10;
            
            $tabs['documentation_tab'] = [
                'title'     => 'Documentation',
                'callback'  => 'output_documentation_files',
                'priority'  => $start_at_priority
            ];
		}
		return $tabs;
	});

    function output_documentation_files($tabs) {
		global $post;
        $product_documentation = get_field('product_documentation', $post->ID);
        $files = $product_documentation['doc_files'];
        $fileSVG = inline_icon('file.svg');

        echo '<ul>';
        if ($files) {
            foreach ($files as $file) {
                $file = $file['doc_file'];
                $fileLink = $file['url'];
                echo  '<li><a href="'.$fileLink.'" role="link" target="_blank">'.$fileSVG.$file['filename'].'</a></li>';
            }
        }
       echo '</ul>';
	}
}

/*
 * Allows for creation of custom tabs for product
 */
if (class_exists('acf') && class_exists('WooCommerce')) {
	add_filter('woocommerce_product_tabs', function($tabs) {
		global $post, $product;  // Access to the current product 
		
		$custom_tabs_repeater = get_field('custom_tabs', $post->ID);
 
		if (!empty($custom_tabs_repeater)) {
			$counter = 0;
			$start_at_priority = 10;
			foreach ($custom_tabs_repeater as $custom_tab) {
				$tab_id = $counter . '_' . sanitize_title($custom_tab['tab_title']);
				
				$tabs[$tab_id] = [
					'title'     => $custom_tab['tab_title'],
					'callback'  => 'awp_custom_woocommerce_tabs',
					'priority'  => $start_at_priority++
				];
				$counter++;
			}
		}
		return $tabs;
	});
 
	function awp_custom_woocommerce_tabs($key, $tab) {
		global $post; 
		$custom_tabs_repeater = get_field('custom_tabs', $post->ID);
		$tab_id = explode('_', $key);
		$tab_id = $tab_id[0];
 
		echo $custom_tabs_repeater[$tab_id]['tab_contents'];
	}
}

/*
 * Move product tabs beside the product image - WooCommerce
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/*
 * Make products not purchasable, subquently removing add to cart buttons on products.
 * Remove this filter to enable add to cart functionality 
 */
add_filter( 'woocommerce_is_purchasable', '__return_false');

/**
 * Hide Product price from products 
 * Remove this filter to add prices back to products
 */
add_filter( 'woocommerce_get_price_html', 'hide_product_price' );
function hide_product_price( $price ) {
    return '';
}

/**
 * Change button text of Related Products section
 * 
 * @return $translated_text
 */
add_filter( 'gettext', 'change_readmore_text', 20, 3 );
function change_readmore_text( $translated_text, $text, $domain ) {
	if ( ! is_admin() && $domain === 'woocommerce' && $translated_text === 'Read more') {
	$translated_text = 'View';
	}
return $translated_text;
}

/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 6;
	  return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 5; // 4 related products
	  $args['columns'] = 2; // arranged in 2 columns
	  return $args;
  }