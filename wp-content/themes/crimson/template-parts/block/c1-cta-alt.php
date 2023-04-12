<?php 

$bg = get_field('cta_alt_bg');
$ctaText = get_field('cta_alt_text');
$link = get_field('cta_alt_link');

if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

?>

<section class="block-cta-alt" <?php if($bg): ?> style="background: url(<?php echo $bg['url']; ?>) no-repeat 100%;background-size: cover;" <?php endif; ?>>
    <div class="container cta-wrap">
         <?php if($ctaText): ?>
            <?php echo $ctaText; ?>
        <?php endif; ?>
    </div>
    <div class="cta-btn">
    <?php if($link): ?>
        <a class="cta-link" role="link"  
            href="<?php echo esc_url( $link_url ); ?>" 
            target="<?php echo esc_attr( $link_target ); ?>">
            <?php echo esc_html( $link_title ); ?>
        </a>    
    <?php endif; ?>
    </div>
</section>