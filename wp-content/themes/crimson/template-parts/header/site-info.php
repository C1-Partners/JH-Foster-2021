<?php

$phone = get_field('phone_number', 'options');
$phoneReplaced = preg_replace('/\D+/', '', $phone);
$siteAddr = get_field('site_address', 'options');
$ctaText = get_field('cta_text', 'options');
$ctaLink = get_field('cta_link', 'options');
$logoSets = get_field('co_logos', 'options');

?>

<div class="site-info">
    <div class="container info-wrap">
        <div class="family-icons">
        <?php if (is_array($logoSets)) : ?>
            <?php foreach ($logoSets as $logoSet) : 
                $favicon = $logoSet['co_favicon'];
                $logo = $logoSet['co_logo'];
                $link = $logoSet['co_link'];
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                endif; ?>
            <div class="company">
                <img class="co-favicon" src="<?php echo $favicon['url']; ?>" height="20" width="20" alt="<?php echo $favicon['title']; ?>" />
                    <?php if($link): ?>
                    <a class="co-link" role="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" title="View our sister company">
                    <?php echo esc_html( $link_title ); ?> 
                    <?php endif; ?>
                    <div class="co-logo">
                        <span>View our sister company</span>
                        <img class="co-img" src="<?php echo $logo['url']; ?>" height="75" width="200" alt="<?php echo $logo['title']; ?>" />
                    </div>
                <?php if($link): ?>
                </a> 
                <?php endif; ?>
            </div> 
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="info">
            <a class="head-cta" href="<?php echo $ctaLink; ?>"><?php echo $ctaText; ?></a>
            <a class="site-phone" href="tel:+1<?php echo $phoneReplaced; ?>"><?php echo $phone ?></a>
        </div>
    </div>
</div>