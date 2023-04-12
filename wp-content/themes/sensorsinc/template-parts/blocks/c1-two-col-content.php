<?php 

$text = get_field('wyg');
$heading = get_field('h_right');
$formID = get_field('g_form');
$mScript = get_field('m_script');

?>


<section class="block-two-col-content">
    <div class="container">
        <div class="grid">

            <div class="col-1">
                <div class="l-cont">
                <?php if($text): ?>
                    <?php echo $text; ?>
                <?php endif; ?>
                </div>
            </div>
    
            <div class="col-2">
                <div class="<?php echo ($formID) ? 'gform' : 'r-cont' ?>">
                <?php
                if( $heading ): ?>
                    <h3 class="as-h3 title"><?php echo $heading; ?></h3>
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