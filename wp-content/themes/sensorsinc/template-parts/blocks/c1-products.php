<?php
global $post;
$termIDs = get_field('sel_pc');
$queryPosts = new QueryCustomPosts();
$taxonomy = 'product_cat';
$products = $queryPosts->get_custom_posts('product', $taxonomy, $termIDs);
$backup_img = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );

?>

<section class="block-products">
    <div class="grid">
        
    <?php 

        foreach ($products as $product) :   
            $product_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' ); 
            $product_image_alt = get_the_title( $product->ID );
            $product_link = get_permalink( $product->ID );
            $brand_ID = get_field( 'sel_br', $product->ID );
            
            if(!empty($brand_ID)) {
                $brand_image_alt = esc_html( get_the_title($brand_ID) );
                $brand_image_url = get_field( 'br_logo', $brand_ID[0] );
            } else { //fallback to site logo if a brand logo isn't available
                $brand_image_url = $backup_img;
                $brand_image_alt = 'Sensors Inc.';
            }
            
            echo gsc("ui-card", [
                "content" => [
                    "title" => $product->post_title,
                    "cta" => "View",
                    "cta_url" => $product_link,
                    "img_src" => $product_image_url,
                    "img_alt" => $product_image_alt,
                    "logo_src"	=> $brand_image_url,
                    "logo_alt"  => $brand_image_alt,
                ],
                "style" => [
                    "type" => "standard",
                    "cta_type" => "button", 
                    "class" => 'grid__item',
                ],
            ]);
            
        endforeach; ?>

    </div>
</section>