<?php
/** 
 * Interior CTA for pages/articles
 * 
 * @package SW
 */

 $txt = get_field('cta_txt', 'option');
 $link = get_field('cta_btn', 'option');
 $bg = get_field('cta_bg', 'option');

 if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 
?>

<section class="int-cta" <?php echo ($bg) ? 'style="background-image:url(' . $bg . ')" ' : ''; ?>>
    <div class="int-cta__inner">
        <?php if ($txt): ?>
            <?php echo $txt; ?>
        <?php endif; ?>
        <?php if( $link ): ?>
            <div class="btn-row">
                <a class="btn btn--secondary" role="link" 
                    href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <span><?php echo esc_html( $link_title ); ?></span>
                </a>
            </div> 
        <?php endif; ?>
    </div>
</section>