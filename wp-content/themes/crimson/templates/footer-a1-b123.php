<?php
// Enable mobile contact button
$mobileContact = get_field('m_enable', 'options');

?>
      
<footer class="site-footer">
  <div class="container-fluid" id="footer-a">
    <?php dynamic_sidebar('footer-a1') ?>
  </div>
  <div class="container" id="footer-b">
    <div class="row">
      <div class="col col-12 col-md-6 col-lg-4 col-xl-4 left text-center">
        <?php dynamic_sidebar('footer-b1') ?>
        <?php get_template_part( 'template-parts/footer/content', 'social' ); ?>
        <div class="d-flex justify-content-between logos">
          <a href="https://www.ahtd.org/">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ahtd.png" style="border: 0;width:100%" alt="AHTD" height="50" width="auto" />
          </a>
          <a href="https://ter.li/7ameyd" class="d-block text-center" target="_blank" rel="nofollow">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pmmi-logo.png" style="border: 0;width:100%" alt="PMMI" height="50" width="auto" />
          </a>
          <a href="https://www.bbb.org/us/mn/eagan/profile/air-compressors/john-henry-foster-minnesota-inc-0704-96076003/#sealclick" class="d-block text-center" target="_blank" rel="nofollow">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bbb.webp" style="border: 0;" alt="John Henry Foster Minnesota, Inc. BBB Business Review" height="50" width="auto" />
          </a>
        </div>
      </div>
      <div class="col col-12 col-md-6 col-lg-4 col-xl-4 center">
        <?php dynamic_sidebar('footer-b2') ?>
      </div>
      <div class="col col-12 col-md-12 col-lg-4 col-xl-4 text-xs-center right">
        <?php dynamic_sidebar('footer-b3') ?>
      </div>
    </div>
  </div>
  <?php get_template_part( 'template-parts/footer/content', 'copyright' ); ?>
  <?php if($mobileContact) : ?>
    <?php get_template_part( 'template-parts/footer/action', 'contact' ); ?>
  <?php endif; ?>
  <?php wp_footer(); ?>
</footer>
