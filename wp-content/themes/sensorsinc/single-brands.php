<?php
/**
 * The template for displaying products
 *
 */

 get_header();

 $docs = get_field('brand_documentation');
 $content = apply_filters( 'the_content', get_the_content() );
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
			if ( $post->post_parent ) { ?>
			<a class="btn btn-primary bk-btn" href="<?php echo get_permalink( $post->post_parent ); ?>" >
			Back to <?php echo get_the_title( $post->post_parent ); ?>
			</a>
		<?php } ?>
			<?php
			
            get_template_part( 
                'template-parts/internal/info-tabs', 
                null, 
                [
                    'content'  => $content,
                    'docs'     => $docs,
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