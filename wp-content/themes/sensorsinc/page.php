<?php

global $post;

/**
 * The template for displaying default page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SW
 */

 get_header(); ?>
<div class="page">
	<?php get_template_part( 'template-parts/internal/banner', 'int'); ?>
 	<main id="primary" class="site-main container">
	 	
		<div class="content-page">
		<?php 
		if ( $post->post_parent ) { ?>
			<a class="btn btn-primary bk-btn" href="<?php echo get_permalink( $post->post_parent ); ?>" >
			Back to <?php echo get_the_title( $post->post_parent ); ?>
			</a>
		<?php } ?>
		<?php
			the_content();
			get_template_part( 'template-parts/internal/page-parts/page', 'footer');
		?>
		</div>
 	</main><!-- #main -->
</div>
 <?php get_footer();
