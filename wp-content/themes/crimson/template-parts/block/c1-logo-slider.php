<?php

// Get the images repeater field 
$images = get_field('v_logos');
$title = get_field('v_title');

?>

<section class="block-logo-slide" id="vendorLogos">
    <div class="logo-inner"> 
        <h2 class="vendors-title container"><?php echo $title; ?></h2>
        <div class="js-logos">
        <?php

        foreach ($images as $image): 
            $imageURL = $image['v_logo']['url'];
            $imageAlt = $image['v_logo']['title'];
            $link = $image['v_link'];

            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            endif; 
        ?>

            <div class="img-wrap">
                <?php if($link): ?>
                <a href="<?php echo esc_url( $link_url ); ?>" 
                   target="<?php echo esc_attr( $link_target ); ?>"
                   role="link"
                >  
                <?php endif; ?>
                <?php if($imageURL): ?>
                    <img class="vendor-logo" src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>" width="200" height="280" />
                <?php endif; ?>    
                <?php if($link): ?>
                </a>
                <?php endif; ?>
            </div>
      
        <?php endforeach; ?>

        </div>
    </div>
</section>
