<?php 

$desktop_img = get_field('hero_img');
$mobile_img = get_field('mobile_img');
$heroTitle = get_field('hero_tl');
$heroCont = get_field('hero_cont');
$link = get_field('hero_cta');
$linkAlt = get_field('hero_cta_alt');
if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 
if( $linkAlt ): 
    $linkAlt_url = $linkAlt['url'];
    $linkAlt_title = $linkAlt['title'];
    $linkAlt_target = $linkAlt['target'] ? $linkAlt['target'] : '_self';
endif; 

?>

<div class="block-hero">
    <picture>
        <source srcset="<?php echo $mobile_img['url']; ?>" media="(max-width: 950px)">
        <img class="hero-img" src="<?php echo $desktop_img['url']; ?>" alt="<?php echo $desktop_img['title']; ?>" />
    </picture>
    <div class="hero-content">
        <div class="row content-inner">
            <?php if($heroTitle): ?>
                <h2 class="hero-title h1"><?php echo $heroTitle; ?></h2>
            <?php endif; ?>
            <?php if($heroCont): ?>
                <?php echo $heroCont; ?>
            <?php endif; ?>
            <?php if($link): ?>
            <div class="hero-cta">
                <a class="btn" role="link"  
                    href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                </a>    
            </div>
            <?php endif; ?>
        </div>
        
        <?php if ($linkAlt): ?>
        <div class="hero-overlay">
            <div class="btn-row">
            <?php if($linkAlt): ?>
                <a class="btn btn--secondary" role="link"  
                    href="<?php echo esc_url( $linkAlt_url ); ?>" 
                    target="<?php echo esc_attr( $linkAlt_target ); ?>">
                    <?php echo esc_html( $linkAlt_title ); ?>
                </a>    
            <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div> 
</div>
