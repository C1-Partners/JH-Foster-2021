<?php 
global $post;
$disable_cta = get_field('en_cta_ft', $post->ID);

?>

<?php if (!$disable_cta): ?>
<footer class="page-footer">
    <?php get_template_part( 'template-parts/internal/cta'); ?>
</footer>
<?php endif; ?>