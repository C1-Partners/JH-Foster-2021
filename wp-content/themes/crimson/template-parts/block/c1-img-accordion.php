<?php

$image1 = get_field('first_image');
$link = get_field('image_cta');
$topics = get_field('accordion');
$image1 = wp_get_attachment_image_src($image1, 'full');
$title = get_field('accordion_title');

if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

?>

<section class="block-image-accordion">
    <div class="container-fluid no-gutters">
        <div class="row">
            <figure class="figure-block col-lg-6 px-0">
                <?php if ($image1 ): ?>
                <img src="<?php echo $image1[0] ?>" alt="Gallery" class="img-responsive" height="<?php echo $image1[2] ?>" width="<?php echo $image1[1] ?>">
                <?php endif; ?>
                <div class="image-cta">
                    <?php
                        if( $link ): ?>
                            <a class="btn-primary" role="link" 
                                href="<?php echo esc_url( $link_url ); ?>" 
                                target="<?php echo esc_attr( $link_target ); ?>">
                                <span><?php echo esc_html( $link_title ); ?></span>
                            </a>
                    <?php endif; ?>
                </div>    
            </figure>
            <div class="accordion-block col-lg-6">
                <h2 class="accordion-title"><?php echo $title; ?></h2>
                <div class="accordion">
                <?php
                    $x=1; //setup our incrementing variable
                    $rand = rand(1,500); // generate random numbers for accordion functionality

                    foreach ( $topics as $topic ) : ?>

                        <div class="accordion-item">
                            <div class="accordion-header" id="heading<?php echo $x . "-" . $rand; ?>">
                                <a href="#" 
                                    class="toggle <?php echo ($x !== 1) ? 'collapsed' : ''; ?>" 
                                    data-toggle="collapse" 
                                    data-target="#collapse<?php echo $x . "-" . $rand; ?>" 
                                    aria-expanded="true" 
                                    aria-controls="collapse<?php echo $x . "-" . $rand; ?>">
                                    <div class="title-outer">
                                        <div class="plus">
                                            <div class="horizontal"></div>
                                            <div class="vertical"></div>
                                        </div>
                                        <h3 class="title"><?php echo $topic['title']; ?></h3>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse<?php echo $x . "-" . $rand; ?>" class="<?php echo ($x == 1) ? 'show' : 'collapse'; ?>" aria-labelledby="heading<?php echo $x . "-" . $rand; ?>" >
                                <div class="accordion-body">
                                    <?php echo $topic['answer']; ?>
                                </div>
                            </div>
                        </div>

                <?php $x++; endforeach ?>   
                
                </div>                    
            </div>
        </div>
    </div>
</section> 