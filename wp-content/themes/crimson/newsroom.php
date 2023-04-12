<?php
/*
Template Name: Newsroom
*/
$fallBackImg = '/wp-content/themes/crimson/assets/images/placeholders/jhf-default-min.png';

?>

<!--Header-->

<?php get_header(); ?>

<!--End Header-->

<!--Content-->

  <article class="main-blog">
    <div class="container-fluid page-hero">
      <div class="row page-hero-overlay">
        <div class="container">
          <div class="row" id="title-bar">
            <div class="col-12">
              <h1 class="page-title"><?php single_post_title(); ?></h1>
              <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            </div>
          </div>
        </div>   
      </div>
    </div>

     <!--Breadcrumbs-->
     
      <!--End Breadcrumbs-->

    <div class="container main-wrapper">
      <div class="row" id="content-wrapper">
        <div class="col-md-8">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array( 
               'post_type'      => 'news',
               'posts_per_page' => 10,
               'orderby'        => 'DESC', 
               'paged'          => $paged
              );
            $temp = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( $args );
            if (have_posts()) :
              while (have_posts()) :
                the_post(); 
                
                $postLink = get_field('post_link');
                $pRelease = get_field('press_release');
              
                ?>
              
                  <div class="row my-5" id="post-<?php the_ID(); ?>">
                    <div class="tumbnail-container col-sm-12 col-lg-6">
                    <?php if(get_the_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('full'); ?>
                    <?php  else : ?>
                          <img src="<?php echo $fallBackImg; ?>" />
                    <?php endif; ?>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                      <?php if ($pRelease): ?>
                        <p class="as-h2 my-0">PRESS RELEASE</p>
                      <?php endif; ?>  
                      <h2 class="mt-0">
                        <a href="<?php echo ($postLink) ? $postLink : the_permalink(); ?>"><?php the_title(); ?></a>
                      </h2>
                      <?php echo excerpt(12); ?>
                      <p class="post-date mt-0"><?php the_time('F j, Y'); ?></p>
                      <a href="<?php echo ($postLink) ? $postLink : the_permalink(); ?>" class="btn btn-index">Read More</a>
                    </div> 
                  </div>
         
              <?php endwhile; ?>
                <div class="navigation d-flex justify-content-center my-5">
                  <div class="prev-posts mr-5"><?php previous_posts_link(); ?></div>
                  <div class="next-posts ml-5"><?php next_posts_link(); ?></div>
                </div>
              <?php else : ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1>Not Found</h1>
                </div>
                  <?php 
                    $wp_query = null;
                    $wp_query = $temp;
                    wp_reset_query();
                  ?>
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
