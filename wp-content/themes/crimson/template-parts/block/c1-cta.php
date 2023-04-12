<?php

$bg = get_field('cta_bg');
$ctaText = get_field('cta_text');
$link1  = get_field('cta_link1');
$link2  = get_field('cta_link2');

if( $link1 ): 
    $link1_url = $link1['url'];
    $link1_title = $link1['title'];
    $link1_target = $link1['target'] ? $link1['target'] : '_self';
endif; 
if( $link2 ): 
    $link2_url = $link2['url'];
    $link2_title = $link2['title'];
    $link2_target = $link2['target'] ? $link2['target'] : '_self';
endif; 

?>

<section class="block-cta" <?php if($bg): ?> style="background: url(<?php echo $bg['url']; ?>) no-repeat 100%;background-size: cover;" <?php endif; ?>>
    <div class="container cta-wrap">
        <?php if($ctaText): ?>
            <?php echo $ctaText; ?>
        <?php endif; ?>
        <div class="cta-btns">
        <?php  if( $link1 ): ?>
            <a class="btn btn-primary" role="link" 
                href="<?php echo esc_url( $link1_url ); ?>" 
                target="<?php echo esc_attr( $link1_target ); ?>">
                <span><?php echo esc_html( $link1_title ); ?></span>
            </a>    
        <?php endif; ?>
        <?php if( $link2 ): ?>
            <a class="btn btn-outline" role="link" 
                href="<?php echo esc_url( $link2_url ); ?>" 
                target="<?php echo esc_attr( $link2_target ); ?>">
                <span><?php echo esc_html( $link2_title ); ?></span>
            </a>
        <?php endif; ?>
        </div>
    </div>
</section>