<?php

global $post;
$author_id = $post->post_author;
$categories = get_the_category();
$tags = wp_get_post_tags($post->ID);

?>

<div class="categories-tags">
    <div class="categories">
        <h4 class="f-label">Categories</h4>
        <ul>
        <?php if($categories): $copy = $categories; ?>
            <?php foreach($categories as $category): 
                $cat_ID = get_cat_ID($category->name);
                $cat_link = get_category_link( $cat_ID );?>
                <a href="<?php echo $cat_link; ?>" class="cat-label"><?php echo $category->name; ?></a>
                <?php 
                    if (next($copy)) :
                        echo ','; // Add comma for all elements instead of last
                    endif;
                ?>
            <?php endforeach; ?>
        <?php endif; ?>
        </ul>
    </div>
    <div class="tags">
        <h4 class="f-label">Tags</h4>
        <ul>
        <?php if($tags): $copy = $tags; ?>
            <?php foreach ($tags as $tag) : 
                $tag_link = get_tag_link( $tag->term_id );
            ?>
            <a href="<?php echo $tag_link;?>" title="<?php echo $tag->name;?>">
                <?php echo $tag->name; ?>
            </a>
            <?php 
                if (next($copy)) :
                    echo ','; // Add comma for all elements instead of last
                endif;
            ?>
            <?php endforeach; ?> 
        <?php endif; ?>
        </ul>
    </div>
</div>