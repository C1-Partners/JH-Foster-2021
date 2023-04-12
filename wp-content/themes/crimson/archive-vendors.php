
<!--Header-->

<?php 

/*
 * Template Name: Suppliers Index
 */

get_header(); 

$link = get_field('suppliers_cta', 'options');
$link2 = get_field('static_card', 'options');
$disclaimer = get_field('sp_disc', 'options');

if( $link ): 
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
endif; 
if( $link2 ): 
  $link2_url = $link2['url'];
  $link2_title = $link2['title'];
  $link2_target = $link2['target'] ? $link2['target'] : '_self';
endif;

?>

<!--End Header-->

<!--Content-->

  <article class="int-page">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
        <div class="col-12">
          <h1 class="page-title">Suppliers</h1>
          <div class="d-flex">
          <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
          <?php if( $link2 ): ?>
              <div class="text-right w-100 pt-3">
                  <a class="underline" 
                      role="link" 
                      href="<?php echo esc_url( $link2_url ); ?>" 
                      target="<?php echo esc_attr( $link2_target ); ?>">
                      <span><?php echo esc_html( $link2_title ); ?></span>
                  </a>
              </div>
          <?php endif; ?>
          </div>
        </div>
        <div class="container">
          <div class="row pt-5">
              <?php
               $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
               $args = array( 
                'post_type' => 'vendors',
                'paged' => $paged,
                'posts_per_page' => 12,
                'orderby' => 'title',
                'order'   => 'ASC',
                );
               $wp_query = new WP_Query( $args );
              if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <div class="col-sm-12 col-md-6 col-lg-4 mb-5" id="post-<?php the_ID(); ?>">      
                <?php if(get_the_post_thumbnail()) : ?>
                  <div class="thumbnail-container">
                    <?php the_post_thumbnail('full'); ?>
                  </div>
                   <?php else : ?>
                   <div style="height:40px;">
                   </div>
                <?php endif; ?>
                <h2 class="as-h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="supplier-description">
                  <?php echo excerpt(12); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-index">View More</a>
              </div>
              <?php endwhile; ?>

              <?php if($disclaimer): ?>
              <p class="text-center w-100" style="font-size:13px;"><?php echo $disclaimer; ?></p>
              <?php endif; ?>

              <?php if( $link ): ?>
              <div class="text-center w-100">
                  <a class="underline" 
                      role="link" 
                      href="<?php echo esc_url( $link_url ); ?>" 
                      target="<?php echo esc_attr( $link_target ); ?>">
                      <span><?php echo esc_html( $link_title ); ?></span>
                  </a>
              </div>
              <?php endif; ?>

              <?php else : ?>
                <p>We're sorry. There are no results for your query.</p>
              <?php endif; ?>
           
          </div>
          <div class="posts-navigation">
            <div class="prev-posts"><?php previous_posts_link(); ?></div>
            <div class="next-posts"><?php next_posts_link(); ?></div>
          </div>
        </div>
      
      </div>
    </div>
  </article>

<!--End Content-->

<!--Footer-->

<?php get_footer(); ?>

<!--End Footer-->



