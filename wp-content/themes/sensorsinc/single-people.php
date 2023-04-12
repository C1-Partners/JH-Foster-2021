<?php
/**
 * The template for displaying products
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Advance_VT
 */

$position = get_field('op_ps');
$linkedin_url = get_field('op_li');
$email_url  = get_field('op_em');

 get_header();
 ?>
	<div class="page">
		<?php  ?>
		
		<main id="primary" class="site-main container">
			
		<?php
		while ( have_posts() ) :
			the_post();
			 ?>
			<div class="content-page" id="banner">
				<div class="info">
					<?php 
					get_template_part( 'template-parts/internal/page-parts/people', 'header'); ?>
					<div class="bio">
						<h1 class="h2 title"><?php echo get_the_title(); ?></h1>
						<h4><?php echo $position; ?></h4>
						<?php
						echo gsc("socials", [
							"content" => [
								"email"		=> $email_url,
								"linkedin"	=> $linkedin_url,
							]
						  ]);
						?>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		
		<?php endwhile; // End of the loop.?>
		
		</main><!-- #main -->
	</div>
 <?php
 get_footer();