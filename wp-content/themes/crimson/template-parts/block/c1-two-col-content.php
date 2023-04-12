<?php 

$text = get_field('wyg');
$heading = get_field('h_right');
$formID = get_field('g_form');
$mScript = get_field('m_script');
$addBg = get_field('enable_bg');

?>


<section class="block-two-col-content">
    <div class="container">
        <div class="row">

            <div class="col-md-6 left">
            <?php if($text): ?>
                <?php echo $text; ?>
            <?php endif; ?>
            </div>
    
            <div class="col-md-6 right <?= ($addBg) ? 'bg-gray' : '' ?>">
                <div class="<?= ($formID) ? 'gform' : '' ?>">
                <?php
                if( $heading ): ?>
                    <h3 class="as-h2 title"><?php echo $heading; ?></h3>
                <?php endif; ?>
               
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
                    elseif ( $mScript ):
                        echo $mScript;
                ?>
 
                <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>