
<!--Header-->

<?php get_header(); 
global $post;
// hide supplier links in sidebar, which means we also shutoff req-literature block
$hideSupplierLinks = get_field('hd_spl', $post->ID);

?>

<!--End Header-->

<!--Content-->

  <article class="int-page">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
      <div class="col-md-8">
            <?php get_template_part( 'template-parts/internal/content', 'title' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'loop' ); ?> 
            <?php if (!$hideSupplierLinks): ?>
              <?php get_template_part( 'template-parts/internal/content', 'gform-req-literature' ); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php get_template_part( 'template-parts/internal/content', 'sidebar' ); ?>
        </div>
      </div>
    </div>
  </article>

<!--End Content-->

<!--Footer-->

<?php get_footer(); ?>

<!--End Footer-->



