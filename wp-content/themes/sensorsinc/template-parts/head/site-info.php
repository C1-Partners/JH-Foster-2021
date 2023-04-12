<?php

$phone = get_field('phone_number', 'options');
$phoneReplaced = preg_replace('/\D+/', '', $phone);
$siteAddr = get_field('site_address', 'options');
$ctaText = get_field('cta_text', 'options');
$ctaLink = get_field('cta_link', 'options');

?>

<div class="site-info">
    <div class="info-wrap">
        <div class="info">
            <a class="head-cta" href="<?php echo $ctaLink; ?>"><?php echo $ctaText; ?></a>
            <a class="site-phone" href="tel:+1<?php echo $phoneReplaced; ?>"><?php echo $phone ?></a>
        </div>
    </div>
</div>