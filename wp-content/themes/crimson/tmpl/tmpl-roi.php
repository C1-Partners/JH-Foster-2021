<?php 
/*
 * Template Name: ROI
 */
get_header(); ?>

<!--Content-->

  <article class="int-page">
    <div class="container-fluid page-hero">
      <div class="row page-hero-overlay">
        <div class="col-12">
          <div class="row" id="title-bar">
            <div class="col-12">
              <?php get_template_part( 'template-parts/internal/content', 'title' ); ?>
              <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            </div>
          </div>
        </div>   
      </div>
    </div>

    <div class="container" id="main-wrapper">
      <div class="row" id="content-wrapper">
        <div class="col-12">
        <?php while( have_posts() ) : the_post(); ?> 

            <?php if( ! isset($_POST['system_costs']) ) : 
                
                get_template_part('tmpl/roi/calculator'); 

                the_content();
                
            else :

                get_template_part('tmpl/roi/results');
                
            endif; ?>

        <?php endwhile; ?> 
        </div>
      </div>
    </div>
  </article>


<!--End Content-->

<!--Footer-->

<?php get_footer(); ?>

<!--End Footer-->