<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SW
 */


$contentLeft = get_field('l_col', 'options');
$contentRight = get_field('r_col', 'options');
$fb_link = get_field('fb_link', 'option');
$li_link = get_field('li_link', 'option');
$yt_link = get_field('yt_link', 'option');
$tw_link = get_field('tw_link', 'option');
$ig_link = get_field('ig_link', 'option');
$logo_url = get_theme_mod( 'footer_logo' );
$site_url = get_site_url();

?>
    <footer class="footer">
        <div class="footer__main container">
            <div class="footer__left">
                <?php  
                    if ($logo_url ) {
                       echo 
                       '<a href="' .$site_url.'">
                            <img src="'.$logo_url.'" alt="Sensors Logo" class="brand-logo">
                        </a>';
                    }   
                ?>
                <div class="socials">
                    <?php
                        echo gsc("socials", [
                            "content" => [
                                "facebook"  => $fb_link,
                                "twitter"   => $tw_link,
                                "youtube"   => $yt_link,
                                "linkedin"  => $li_link,
                                "instagram" => $ig_link,
                            ]
                        ]);
                    ?>
                </div>
                <?php get_template_part('template-parts/foot/co-logos'); ?>
            </div>
            <div class="footer__center">
                <?php get_template_part('template-parts/foot/menu-a'); ?>
            </div>
            <div class="footer__right">
                <?php get_template_part('template-parts/foot/menu-b'); ?>
            </div>
        </div>
        <div class="footer__copyright container">
            <?php get_template_part('template-parts/foot/copyright'); ?>
        </div>
    </footer>

    </div><!-- #page -->

    <?php wp_footer(); ?>

    </body>
</html>
