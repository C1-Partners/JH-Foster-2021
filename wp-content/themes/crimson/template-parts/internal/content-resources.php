<?php

// Get the resources field from options page
$resources = get_field('sb_resources', 'option');
$title = get_field('rs_title', 'option');

?>

<?php if($resources): ?>
<div class="sb-resources text-center">
    
    <?php if($title): ?>
    <h2><?php echo $title; ?></h2>
    <?php endif; ?>   

    <?php
        foreach ($resources as $resource): 
            $link = $resource['rs_link'];

            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            endif; 
    ?>

        <div>
            <?php if($link): ?>
            <a  href="<?php echo esc_url( $link_url ); ?>"
                class="my-5 d-block"
                target="<?php echo esc_attr( $link_target ); ?>">
               <?php echo esc_html( $link_title ); ?>
            </a>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

</div>
<?php endif; ?>