<?php

$link = get_field('m_contact', 'options');

if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

?>

<div class="mobile-contact">
<?php  if( $link ): ?>
    <a class="btn btn-primary c2c" role="link" 
        href="<?php echo esc_url( $link_url ); ?>" 
        target="<?php echo esc_attr( $link_target ); ?>">
        <span><?php echo esc_html( $link_title ); ?></span>
    </a>    
<?php endif; ?>
</div>