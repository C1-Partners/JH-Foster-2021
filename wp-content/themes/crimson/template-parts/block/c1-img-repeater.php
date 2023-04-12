<?php

// Get the images repeater field 
$images = get_field('image_repeater');
$colSizeLG = get_field('col_size_lg');

?>

<section class="block-ir">
    <div class="container">
        <div class="row">

        <?php

        foreach ($images as $image): 
            $imageURL = $image['ir_img']['url'];
            $imageAlt = $image['ir_img']['title'];
            $link = $image['ir_link'];
            $title = $image['ir_title']; 
            $sbTitle = $image['ir_sbtitle'];

            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            endif; 
        ?>

            <div class="img-wrap col-6 col-lg-<?php echo $colSizeLG; ?>">
                <?php if($link): ?>
                <a 
                    href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>"
                    class="img-link"
                    >
                <?php endif; ?>
                <?php if($imageURL): ?>
                    <img class="ir-img" src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>" width="200" height="280" />
                <?php endif; ?>    
                <?php if($title): ?>  
                    <p class="ir-title"><?php echo $title; ?></p>
                <?php endif; ?>
                <?php if($sbTitle): ?>  
                    <p class="ir-sbtitle"><?php echo $sbTitle; ?></p>
                <?php endif; ?>
                <?php if($link): ?>
                </a>
                <?php endif; ?>
            </div>
      
        <?php endforeach; ?>

        </div>
    </div>
</section>
