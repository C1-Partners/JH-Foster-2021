
<!--Header-->

<?php get_header(); ?>

<!--End Header-->

<!--Content-->

  <article class="int-page">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
        <div class="col-12">
          <h1 class="page-title"><?php the_archive_title(); ?></h1>
          <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
        </div>
        <div class="container">
          <div class="row">
           
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <div class="col-sm-12 col-md-6 col-lg-4" id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      
                <?php if(get_the_post_thumbnail()) : ?>
                  <div class="tumbnail-container">
                    <?php the_post_thumbnail('full'); ?>
                  </div>
                <?php endif; ?>
                <?php the_excerpt(); ?>
              </div>
              <?php endwhile; ?>
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



