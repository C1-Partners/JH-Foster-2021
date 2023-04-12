<?php
/*
 * Displays the subtitle for post or page with the WP Subtitle Plugin
 *  https://github.com/benhuson/wp-subtitle
 */

$subtitle = apply_filters( 'plugins/wp_subtitle/get_subtitle', '', array(
    'before'  => '<p class="subtitle">',
    'after'   => '</p>',
    'post_id' => get_the_ID()
) ); 

?>

<?php if ($subtitle): ?>
    <div class="subtitle-outer">
        <?php echo $subtitle; ?>
    </div>
<?php endif; ?>