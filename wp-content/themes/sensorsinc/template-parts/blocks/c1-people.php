<?php

$queryPosts = new QueryCustomPosts();
$people = $queryPosts->get_custom_posts('people');

?>

<section class="block-people">
    <div class="grid">
    <?php 

    foreach ($people as $person) :   
        $person_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($person->ID), 'single-post-thumbnail' ); 
        $person_image_alt = get_the_title( $person->ID);
        $person_position = get_field('op_ps', $person->ID);
        $person_link = get_permalink( $person->ID);
        
        echo gsc("ui-card", [
            "content" => [
                "title" => $person->post_title,
                "heading" => "",
                "subtitle" => "$person_position",
                "text" => "",
                "cta" => "View",
                "cta_url" => $person_link,
                "list_title" => "",
                "list_items" => [],
                "img_src" => $person_image_url,
                "img_alt" => $person_image_alt,
            ],
            "style" => [
                "type" => "standard",
                "cta_type" => "button", 
            "class" => 'grid_item',
            "id" => '',
            "attrs" => [],
            ],
        ]);
        
    endforeach; ?>

    </div>
</section>