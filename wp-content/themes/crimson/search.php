<?php

get_header();

if( have_posts() ): ?>

  <header class="page-header">
    <h1 class="page-title text-center mb-5 pt-5">
      <?php printf( esc_html__( 'Search Results for: %s', 'crimson' ), '<span>' . get_search_query() . '</span>' ); ?>
    </h1>
  </header>
    <div class="container py-5">
      <div class="row">
  
      <?php while(have_posts()): the_post(); ?>

        <div class="col-sm-6 col-md-4">
          <article class="search-tile" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
              <?php if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php crimson_posted_on(); ?>
                    <?php crimson_posted_by(); ?>
                </div>
              <?php endif; ?>
            </header>
            <?php crimson_post_thumbnail(); ?>
            <div class="entry-summary">
              <?php the_excerpt(); ?>
            </div>
            <footer class="entry-footer">
              <?php crimson_entry_footer(); ?>
            </footer>
          </article>
        </div> 
      
      <?php endwhile; ?>

      </div>
    </div>

    <div class="container text-center">
    <?php
  
    the_posts_navigation();
    else:
      get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>

    </div>
    <?php 
get_footer();