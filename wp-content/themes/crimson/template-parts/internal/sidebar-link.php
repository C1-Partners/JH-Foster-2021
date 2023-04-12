<?php

global $post;
// Set vars for custom post type pages
$vendorPage = is_singular( 'vendors' );
$industPage = is_singular( 'industry' );
$prodctPage = is_singular( 'products' );
// Get slug of current post
$postSlug = $post->post_name;
$disclaimer = get_field('sp_disc', 'options');
// Set vars for post query
if ($vendorPage) {
    $postType = 'vendors';
    $taxonomy = 'sub-products';
    $title = 'Products';
} elseif ($industPage) {
    $postType = 'vendors';
    $taxonomy = 'product-category';
    $title = 'Find a Supplier';
} elseif ($prodctPage) { 
    $postType = 'vendors';
    $taxonomy = 'product-category';
    $title = 'Find a Supplier';
}
// Query posts 
$postsQuery = new WP_Query([
    'post_type' => $postType,
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order'   => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $postSlug,
        ),
   )
]);

$postLinks = [];

if($postsQuery->have_posts()) {
    while($postsQuery->have_posts()) {
        $postsQuery->the_post();

        $postLinks[] = [
            'id'            => get_the_ID(),
            'url'           => get_the_permalink(),
            'title'         => get_the_title(),
        ];
    }
}

?>

<script>
    window.products = <?php echo json_encode($postLinks); ?>;
</script>

<div class="sidebar-link">     
    
    <ul>
    <?php 
        if ( $industPage || $prodctPage ) { ?>

        <h2 class="sb-title"><?php echo $title; ?></h2>
        <?php foreach ($postLinks as $postLink ) { ?>

        <a href="<?php echo $postLink['url']; ?>">
            <li class="post-link"><?php echo $postLink['title']; ?></li>
        </a>   
         
    <?php } ?> 
        <a href="/suppliers/other-suppliers/">
            <li class="post-link">View Other Suppliers</li>
        </a>

        <?php if($disclaimer): ?>
        <p class="text-center w-100" style="font-size:13px;"><?php echo $disclaimer; ?></p>
        <?php endif; ?>
        
    <?php } elseif ( $vendorPage ) { ?>
    <?php  

        $terms = get_the_terms($post->ID, $taxonomy);
        if($terms) {
            foreach ($terms as $term) {
                $term_link = get_term_link($term, $taxonomy);
                if (is_wp_error($term_link))
                    continue;
                echo '<li>' . $term->name . '</li>';
            }
        } 
     } ?>
        
    </ul>
    
</div>
