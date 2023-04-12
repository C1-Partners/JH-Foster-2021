<?php
/**
 * The template for displaying products
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
			get_template_part( 'template-parts/internal/product-parts/product', 'header'); ?>
			<div class="content-page">
			<?php
				the_content();
				get_template_part( 'template-parts/internal/article-parts/article', 'footer');
			?>
			</div>

		<?php endwhile; // End of the loop.?>
		
		</main><!-- #main -->
	</div>
 <?php
 get_footer();
