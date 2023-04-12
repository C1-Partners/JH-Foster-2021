<?php
global $post;
$cpt_slug = get_field('cpt_slg');
$termIDs = get_field('sel_cps');
$queryPosts = new QueryCustomPosts();
$custom_posts = $queryPosts->get_custom_posts($cpt_slug, $termIDs);
$backup_img = esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) );

// if less than 4 items (posts) show grid in 4frame layout for template columns
$grid_formatting = '';
if (count($custom_posts) <= 3 ) {
    $grid_formatting = 'gtc-4';
} else {
    $grid_formatting = '';
}
?>

<section class="block-cptg">
    <div class="grid <?php echo $grid_formatting; ?>">
        
    <?php 
   
        
    
        foreach ($custom_posts as $custom_post) :   
            $custom_post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($custom_post->ID), 'single-post-thumbnail' ); 
            $custom_post_image_alt = get_the_title( $custom_post->ID );
            $custom_post_link = get_permalink( $custom_post->ID );
            $brand_ID = $custom_post->ID;
     
            if(!empty($brand_ID)) {
                $brand_image_alt = esc_html( get_the_title($brand_ID) );
                $brand_image_url = get_field( 'br_logo', $brand_ID );
            } else { //fallback to site logo if a brand logo isn't available
                $brand_image_url = null;
                $brand_image_alt = null;
            }
            
            echo gsc("ui-card", [
                "content" => [
                    "title" => $custom_post->post_title,
                    "cta" => "View",
                    "cta_url" => $custom_post_link,
                    "img_src" => $custom_post_image_url,
                    "img_alt" => $custom_post_image_alt,
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