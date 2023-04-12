<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Advance_VT
 */

 get_header();
 ?>
	<div class="page">
		<?php get_template_part( 'template-parts/internal/banner', 'int'); ?>
		
		<main id="primary" class="site-main container">
			
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/internal/article-parts/article', 'header'); ?>
			<div class="content-page">
			<?php
				the_content();
				get_template_part( 'template-parts/internal/article-parts/article', 'footer');
			?>
			</div>
			<?php get_template_part( 'template-parts/internal/article-parts/related', 'posts'); ?>
			<?php
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
	
		endwhile; // End of the loop.
		?>
		
		</main><!-- #main -->
	</div>
 <?php
 get_footer();
