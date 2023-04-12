<?php
global $post;
$tagline = get_field('int_txt', 'options');
$global_bg = get_field('b_bg', 'options');
$pg_bg =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
$bg_url = '';

if ($pg_bg && is_page() ) {
    $bg_url = $pg_bg[0];
} else {
    $bg_url = $global_bg['url'];
   
}

?>

<?php
    echo gsc("banner", [
        "content" => [
            "tagline" => "",
            "title" =>  get_the_title(),
            "image" => $bg_url 
            ],
        "style" => [
            "class" => "int-header",
            "id" => 'banner',
            "attrs" => []
        ]
    ]);
?>
