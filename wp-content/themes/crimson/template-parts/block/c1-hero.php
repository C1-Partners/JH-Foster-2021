<?php 

$imgDesktop = get_field('desktop_image');
$imgMobile = get_field('mobile_image');
$heroLogo = get_field('hero_logo');
$link = get_field('hero_cta');
if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

?>

<section class="block-hero">
    <?php if($imgDesktop): ?>
    <picture>
        <source srcset="<?php echo $imgDesktop['url'] ?>" media="(min-width: 600px)">
        <?php if($imgDesktop): ?>
        <img src="<?php echo $imgMobile['url']; ?>" alt="<?php echo $imgDesktop['alt'] ?>" height="700" width="2000">
        <?php endif; ?>
    </picture>
    <?php endif; ?>
    <div class="hero-content container">
        <div class="row content-inner">
            <?php if($heroLogo): ?>
            <img class="hero-logo" src="<?php echo $heroLogo['url']; ?>" alt="<?php echo $heroLogo['alt'] ?>" height="400" width="200" />
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-cta">
    <?php if($link): ?>
        <a class="cta-link" role="link"  
            href="<?php echo esc_url( $link_url ); ?>" 
            target="<?php echo esc_attr( $link_target ); ?>">
            <?php echo esc_html( $link_title ); ?>
        </a>    
    <?php endif; ?>
    </div>
</section>