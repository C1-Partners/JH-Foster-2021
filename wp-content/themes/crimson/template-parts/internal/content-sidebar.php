<?php
global $post;
$vendorPage = is_singular( 'vendors' );
$industPage = is_singular( 'industry' );
$prodctPage = is_singular( 'products' );

$mktServForm = get_field('mkt_rs_tf');
$hideResources = get_field('hd_rss', $post->ID);
$hideSupplierLinks = get_field('hd_spl', $post->ID);

?>

<div class="sidebar">
<?php if ( $prodctPage || $industPage || $vendorPage ): ?>

    <div class="page-sidebar mb-4">
        <?php get_template_part( 'template-parts/internal/content', 'marketo-products' ); ?>
    </div>
    <?php if (!$hideSupplierLinks): ?>
    <?php get_template_part( 'template-parts/internal/sidebar', 'link' ); ?>
    <?php endif; ?>

<?php endif; ?>

    <?php if ($mktServForm): ?>
    <div class="page-sidebar mb-4">
        <?php get_template_part( 'template-parts/internal/content', 'marketo-req-service' ); ?>
    </div>    
    <?php endif; ?>  

    <?php if (!$hideResources): ?>
    <?php get_template_part( 'template-parts/internal/content', 'resources' ); ?>
    <?php endif; ?>
<div>