
<!--Header-->

<?php 

get_header(); 

// Grab the event title from the post
$eventTitle = $post->post_name;
$subject = $eventTitle;
$pattern = '[-]';
$replace = ' ';
$regLink = get_field('reg_link');
$regText = get_field('reg_text');

?>

<!--End Header-->

<script>
    window.eventTitle = <?php echo json_encode(ucwords(preg_replace($pattern, $replace, $subject))); ?>;
</script>

<!--Content-->

  <article class="int-page">
    <div class="container py-5" id="main-wrapper">
      <div class="row" id="content-wrapper">
      <div class="col-md-8 event-content">
            <?php get_template_part( 'template-parts/internal/content', 'title' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'breadcrumbs' ); ?>
            <?php get_template_part( 'template-parts/internal/content', 'loop' ); ?> 
            <?php if($regLink): ?>
            <div class="btn-row">
                  <a href="<?php echo $regLink; ?>" class="btn btn-primary" role="link">
                  <?php if($regText): 
                      echo $regText;
                  else:
                    echo 'Register Online Today!';
                    ?>
                    <?php endif; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php get_template_part( 'template-parts/internal/content', 'sidebar' ); ?>
        </div>
      </div>
    </div>
  </article>

<!--End Content-->

<!--Footer-->

<?php get_footer(); ?>

<!--End Footer-->



