<?php 

$relatedPostsQuery = new WP_Query([
    'category__in' => wp_get_post_categories( $post->ID ), 
    'posts_per_page' => 3,
    'post__not_in' => array( $post->ID ) 
]);

$posts = [];
    
if($relatedPostsQuery->have_posts()) {
    while($relatedPostsQuery->have_posts()) {
        $relatedPostsQuery->the_post();

        $category_object = get_the_category($post->ID);
       
        $posts[] = [
            'id' => $post->ID,
            'url' => get_the_permalink(),
            'cat_name' => $category_object[0]->name,
            'title' => get_the_title(),
            'image' => get_the_post_thumbnail_url(),
            'author' => get_the_author(),
        ];
    }
}
?>

<section class="related-posts">
    <h2 class="text-center">Related Articles</h2>
    <div class="grid">
    <?php

    if( $posts ) : ?>
        
        <?php foreach( $posts as $post ) : ?>

            <article class="grid__item" id="post-<?php echo $post->id; ?>">
                <a class="outer" href="<?php echo $post['url']; ?>">
                    <div class="img" style="background-image: url(<?php echo $post['image']; ?>)"></div>
                    <div class="content">
                        <span class="cat-label"><?php echo $post['cat_name']; ?></span>
                        <h3 class="h4"><?php echo $post['title']; ?></h3>
                        <span class="cta">Read Story 
                            <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M26.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="#747474"/>
                            </svg>
                        </span>
                        <p class="auth">by <?php echo $post['author']; ?></p>
                    </div>
                </a>
            </article>
    
        <?php endforeach; 
            wp_reset_postdata(); ?>
        
    <?php endif; ?>

    </div>
</section>
