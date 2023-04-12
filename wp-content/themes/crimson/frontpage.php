<?php
/*
* Template Name: Front Page
*/
  get_header();
  while ( have_posts() ) :
  the_post();

  ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="page-content">
      <?php the_content(); ?>
    </div>
  </article>

  <?php

  endwhile;
  
get_footer();