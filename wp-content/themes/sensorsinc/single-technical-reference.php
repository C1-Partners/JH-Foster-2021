<?php
/**
 * The template for displaying technical reference
 */

 get_header();

 $refDoc = get_field('reference_documentation');
 $content = apply_filters( 'the_content', get_the_content() );
 ?>
 
	<div class="page">
		<?php get_template_part( 'template-parts/internal/banner', 'int'); ?>
		
		<main id="primary" class="site-main container">
			
		<?php
		while ( have_posts() ) :
			the_post();
			 ?>
			<div class="content-page">
			<?php
			
            get_template_part( 
                'template-parts/internal/info-tabs', 
                null, 
                [
                    'content'  => $content,
                    'docs'     => $refDoc,
                ]
            );
				
				get_template_part( 'template-parts/internal/article-parts/article', 'footer');
			?>
			</div>

		<?php endwhile; // End of the loop.?>
		
		</main><!-- #main -->
	</div>
 <?php
 get_footer();
