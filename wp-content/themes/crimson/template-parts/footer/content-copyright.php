<?php

$siteAddr = get_field('site_address', 'options');
$phone = get_field('phone_number', 'options');
$phoneReplaced = preg_replace('/\D+/', '', $phone);

?>

<div class="container copyright">
  <div class="row" id="copyright-inner">
    <div class="col-12 text-center">
      <p style="margin-bottom:0;"> 
        
      </p>
      <p style="margin-bottom:0;">JHFOSTER - All Rights Reserved &copy; <?php echo date('Y'); ?> | 
        <a class="site-phone" href="tel:+1<?php echo $phoneReplaced; ?>">
          <?php echo $phone ?>
        </a> | 
      <?php echo $siteAddr; ?></p>
      <?php if(get_theme_mod('crimson_sitemap_link_on') == 'yes') { ?>
        <a href="<?php echo get_theme_mod('crimson_sitemap_link') ?>" style="font-size:12px;" title="sitemap">Sitemap</a>
      <?php } ?>
      <?php if(get_theme_mod('crimson_site_credits_on') == 'yes') { ?>
      <p style="font-size:9px;">Site by: <a href="https://refractroi.com" title="refractroi">RefractROI</a>
        <a href="<?php echo get_theme_mod('crimson_site_credits_link') ?>">
          <img src="<?php echo get_theme_mod('crimson_site_credits_logo') ?>">
        </a>
      </p>
      <?php } ?>
    </div>
  </div>
</div>
