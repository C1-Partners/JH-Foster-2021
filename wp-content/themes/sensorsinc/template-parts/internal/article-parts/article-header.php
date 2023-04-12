<?php

$categories = get_the_category();
$singlePost = is_singular('post');
$author = get_the_author();
$authLink = get_the_author_posts_link();
$postDate = get_the_date( 'F j, Y' );
$postID = get_the_ID();
$image = get_the_post_thumbnail_url();

?>

<header class="internal-header">
    <div class="content-page">
        <div class="categories">
        <?php if($categories): ?>

            <?php foreach($categories as $category): 
                $cat_ID = get_cat_ID($category->name);
                $cat_link = get_category_link( $cat_ID );?>

                <a href="<?php echo $cat_link; ?>" class="cat-label"><?php echo $category->name; ?></a>

            <?php endforeach; ?>

        <?php endif; ?>
        </div>
        <div class="title">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
        <?php get_template_part( 'template-parts/internal/subtitle'); ?>
        
        <?php if($singlePost): ?>
        <div class="meta">
            <p>by <span><?php echo $authLink; ?></span> | <?php echo $postDate; ?></p>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if ($image): ?>
    <div class="post-img" style="background-image: url(<?php echo $image; ?>)"></div>
    <?php endif; ?>
</header>