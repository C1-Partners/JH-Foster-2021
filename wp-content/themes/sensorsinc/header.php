<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SW
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

	<!--Head-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<!--END Head-->

<body <?php body_class(); ?> id="body">
<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary">Skip to content</a>

		<!--Header-->
		<div id="headerOuter">
			<!--Alertbar-->
			<?php get_template_part('template-parts/head/alertbar'); ?>
			<!--END Alertbar-->
			<header class="header header--site" id="header">
				<?php get_template_part( 'template-parts/head/logo' ); ?>
				<?php get_template_part('template-parts/head/primary', 'nav'); ?>
				<?php get_template_part('template-parts/head/secondary', 'nav'); ?>
				<?php get_template_part( 'template-parts/head/mobile', 'toggle' ); ?>
			</header>
		</div>
		<!--END Header-->