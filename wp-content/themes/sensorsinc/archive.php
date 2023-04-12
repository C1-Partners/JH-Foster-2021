<?php

/**
 * Template Name: Archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SW
 */

 get_header();

 ?>

    <?php get_template_part( 'template-parts/internal/banner', 'int'); ?>

 	<main id="primary" class="main container test">
		<div class="grid">

		<?php if ( have_posts() ) : 
			// Start the Loop.
			while ( have_posts() ) :
				the_post(); 

				/*
				* Include the post format-specific template for the content. If you want
				* to use this in a child theme, then include a file called content-___.php
				* (where ___ is the post format) and that will be used instead.
				*/
				var_dump();
				?>

			<article class="grid__item" id="post-<?php the_ID(); ?>">
				<a class="outer" href="<?php echo get_the_permalink(); ?>">
					<div class="img" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"></div>
					<div class="content">
					<?php foreach( ( get_the_category() ) as $category ) :
						if( $category): ?>
							<span class="cat-label"><?php echo $category->cat_name;?></span>
						<?php endif;
					 ?>
					
					<?php endforeach; ?>
						<h3 class="h4"><?php the_title(); ?></h3>
						<span class="btn">View</span>
					</div>
				</a>
			</article>			

			<?php endwhile;

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif; ?>

		

		</div>
		<div class="pagination">
			<?php the_posts_pagination(); ?>
		</div>
 	</main><!-- #main -->

 <?php
 get_footer();
