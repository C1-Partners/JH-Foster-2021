<?php

$fbLink = get_field('fb_link', 'option');
$liLink = get_field('li_link', 'option');
$ytLink = get_field('yt_link', 'option');
$twLink = get_field('tw_link', 'option');
$igLink = get_field('ig_link', 'option');
$tkLink = get_field('tk_link', 'option');

?>

<div class="social-icons">
    <?php if($fbLink): ?>
    <a href="<?php echo $fbLink; ?>" title="Facebook" role="link">
        <?php echo crimson_inline_icon('/social/facebook.svg'); ?>
    </a> 
    <?php endif; ?>
    <?php if($liLink): ?>
    <a href="<?php echo $liLink; ?>" title="LinkedIn" role="link">
        <?php echo crimson_inline_icon('/social/linkedin.svg'); ?>
    </a>
    <?php endif; ?>
    <?php if($ytLink): ?>
    <a href="<?php echo $ytLink; ?>" title="YouTube" role="link">
        <?php echo crimson_inline_icon('/social/youtube.svg'); ?>
    </a>
    <?php endif; ?>
    <?php if($twLink): ?>
    <a href="<?php echo $twLink; ?>" title="Twitter" role="link">
        <?php echo crimson_inline_icon('/social/twitter.svg'); ?>
    </a>  
    <?php endif; ?>  
    <?php if($igLink): ?>
    <a href="<?php echo $igLink; ?>" title="Instagram" role="link">
        <?php echo crimson_inline_icon('/social/instagram.svg'); ?>
    </a>  
    <?php endif; ?>  
    <?php if($tkLink): ?>
    <a href="<?php echo $tkLink; ?>" title="Tiktok" role="link">
        <?php echo crimson_inline_icon('/social/tiktok.svg'); ?>
    </a>  
    <?php endif; ?>   
</div>