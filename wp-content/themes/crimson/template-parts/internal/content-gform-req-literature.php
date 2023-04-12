<?php

global $post, $postsAll, $sbPostSlug, $sbPostType, $sbTaxonomy;

$formID = 3;
$sbPostSlug = $post->post_name;
$sbPostType = 'vendors';
$sbTaxonomy = 'product-category';
$postsAll = get_custom_posts($postType, $taxonomy, $postSlug);

$heading = get_field('lr_heading');
$fallBackImg = get_stylesheet_directory_uri() . '/assets/images/placeholders/jhf-default-min.png';
$img = get_field('lr_img');
$text = get_field('lr_cta_txt');

?>

<section class="literature-cta">
  <?php if ($heading): ?>
    <h2 class="text-center"><?php echo $heading; ?></h2>
  <?php endif; ?>
  <div class="row">
    <div class="col-12 col-lg-7 pb-3">
      <img src="<?php echo ($img) ? $img['url'] : $fallBackImg; ?>" height="400" width="500" alt="" />
    </div>
    <div class="col-12 col-lg-5">
      <?php if($text): ?>
        <?php echo $text; ?>
      <?php endif; ?>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#launchLiteratureFormModal">
        Request Literature
      </button>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="launchLiteratureFormModal" tabindex="-1" role="dialog" aria-labelledby="launchLiteratureFormModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 

        if( $formID ): 
            echo gravity_form( 
                $formID,
                $display_title = true,
                $display_description = true,
                $display_inactive = false,
                $field_values = null,
                $ajax = false,
                $echo = true
            ); 
        endif; 
    
        ?>

      </div>
    </div>
  </div>
</div>


