<?php
 global $post;
 $brand_ID = get_field( 'sel_br', $post->ID);
 $brand_image_url = get_field( 'br_logo', $brand_ID[0] );
 $site_logo = esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] );

?>

<header class="internal-header">
    <div class="content-page">
        <?php if ( $brand_image_url ) { ?>
            <img src="<?php echo $brand_image_url; ?>" style="height: auto;max-width: 100%;" alt="logo" height="200" width="200" />
        <?php } else { ?>
             <img src="<?php echo  $site_logo; ?>" style="height: auto;max-width: 100%;" alt="logo" height="200" width="200" />
        <?php } ?>
    </div>
</header>