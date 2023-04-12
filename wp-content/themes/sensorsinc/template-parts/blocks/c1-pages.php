<?php

$pages = get_field('sel_pg');
$heading = get_field('pg_hd');
$content = get_field('pg_cont');
// if sinlge post, prevent column from taking full width
// $solo_post = '';
// if (count($pages) <= 1 ) {
//     $solo_post = 'max-width';
// } else {
//     $solo_post = '';
// }
?>

<?php if ($pages): ?>
<section class="block-pages">
<?php if ($heading || $content) : ?>
    <div class="pg-content">
    <?php if($heading): ?>
        <h2 class="hero-title h1"><?php echo $heading; ?></h2>
    <?php endif; ?>
    <?php if($content): ?>
        <?php echo $content; ?>
    <?php endif; ?>
    </div>
<?php endif; ?>
    <div class="grid">

    <?php 
        foreach ($pages as $page) :   
            $page_title = $page['pg_title'];
            $page_image = $page['pg_img'];
            $page_image_alt = $page['pg_img']['title'];
            if($page['pg_link']) {
                $page_link = $page['pg_link'];
            }
            
            echo gsc("ui-card", [
                "content" => [
                    "heading" => $page_title,
                    "cta" => "View",
                    "acf_obj" => $page_link,
                    "img_src" => wp_get_attachment_image_src( $page_image['ID'], 'single-post-thumbnail' ),
                    "img_alt" =>  $page_image_alt,
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
<?php endif; ?>