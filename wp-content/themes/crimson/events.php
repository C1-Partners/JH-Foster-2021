<?php 

/*
 *  Template Name: Events
 */

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = [
    'post_type'      => 'event',
    'posts_per_page' =>  12,
    'post_status'    => 'publish',
    'paged'          => $paged
];
$eventsQuery = new WP_Query($args);


get_header(); ?>

<!--End Header-->

<!--Content-->
   <article class="int-page events">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
        <div class="col-12">
            <?php get_template_part( 'template-parts/internal/content', 'title' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            <?php the_content(); ?>
          <div class="row ">
        
          <?php if($eventsQuery->have_posts()) : ?>
            <?php while($eventsQuery->have_posts()) : $eventsQuery->the_post();

              $regLink = get_field('reg_link');
              $regText = get_field('reg_text');
            ?>

              <div class="col-xs-12 col-md-6 col-lg-4 event-outer">
                <a href="<?php the_permalink(); ?>">
                <div class="event-inner">
                    <h3 class="event-title"><?php the_title(); ?></h3>
                    <p class="event-date"><?php echo $eventDate; ?></p>
                      <?php the_post_thumbnail('post-thumbnail', ['class' => 'event-img', 'title' => 'Feature image']); ?>
                    <div class="event-content">
                    <?php echo excerpt(32); ?>
                    </div>
                </div>  
                </a>
                <div class="register-btn">

                <?php if( $regLink ): ?>
                  <a href="<?php echo $regLink; ?>" class="btn btn-primary register" role="link">
                    <?php if($regText): 
                        echo $regText;
                    else:
                      echo 'Register';
                      ?>
                      <?php endif; ?>
                  </a>
                <?php else: ?>
                  <a href="<?php echo the_permalink(); ?>" class="btn btn-primary register" role="link">
                    <?php echo 'Register'; ?>
                  </a>
                <?php endif; ?>
                  
                </div>  
              </div> 
            <?php endwhile; ?>
            <div class="navigation">
              <div class="next-posts alignright"><?php next_posts_link(); ?></div>
              <div class="prev-posts alignleft"><?php previous_posts_link(); ?></div>
            </div>
          <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </article>



<!--End Content-->

<!--Footer-->

<?php get_footer(); ?>

<!--End Footer-->