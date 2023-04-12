<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preload" as="font" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/lato-regular-webfont.woff2" crossorigin="anonymous">

	<?php crimson_favicons() ?>
	

	<?php wp_head(); ?>

	<script>var $ = jQuery.noConflict();</script>

</head>

<body <?php body_class(); ?>>

	<a class="skip-link sr-only" href="#site-main"><?php esc_html_e( 'Skip to content', 'crimson' ); ?></a>

	<header class="site-header" id="header" role="banner">
		<!--Alertbar-->
		<?php get_template_part('template-parts/header/alertbar'); ?>
		<!--END Alertbar-->
		<?php get_template_part( 'template-parts/header/site', 'info' ); ?>
		<div class="container">
			<nav class="primary-nav navbar-expand-lg" id="site-navigation">
				<div class="site-logo" id="site-branding">
					<?php echo the_custom_logo(); ?>
				</div>
				<div class="collapse navbar-collapse nav-wrap" id="PrimaryNav">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary-menu',
						'container'		 =>  false,
						'menu_id'        => 'menu-primary',
						'menu_class'	 => 'navbar-nav ml-auto',
					) );
					?>
				</div>
				<?php get_template_part( 'template-parts/header/site', 'search' ); ?>
				<?php get_template_part( 'template-parts/header/site', 'actions' ); ?>
			</nav>
		</div>
	</header>

	<main class="site-main" id="site-main" role="main">
