<?php

get_header();
get_template_part( 'template-parts/internal/banner', 'int');
if( have_posts() ): ?>

  
  <main id="primary" class="main container search-page">
  
    <header class="search-page__header">
      <h1 class="search-page__title">
        <?php printf( esc_html__( 'Search Results for: %s', 'sw' ), '<span>' . get_search_query() . '</span>' ); ?>
      </h1>
    </header>
		<div class="grid">
      <?php while(have_posts()): the_post(); ?>
   
          <article class="grid__item" id="post-<?php the_ID(); ?>">
            <a class="outer" href="<?php echo get_the_permalink(); ?>">
            <div class="img" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
            <div class="content">
              <h3 class="h4"><?php the_title(); ?></h3>
              <div class="entry-summary">
                <?php the_excerpt(); ?>
              </div>
              <span class="cta">View 
                <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                  <path d="M26.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="#747474"/>
                </svg>
						  </span>
            </div>
            </a>
          </article>
      
      <?php endwhile; ?>
    </div>

    <div class="container text-center">
    <?php
  
    the_posts_navigation();
    else:
      get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>

  </main>
<?php get_footer();