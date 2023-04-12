
<!--Header-->

<?php get_header(); ?>

<!--End Header-->

<!--Content-->

  <article class="int-page">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
      <div class="col-md-8">
            <?php get_template_part( 'template-parts/internal/content', 'title' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'loop' ); ?> 
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



