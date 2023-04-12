<?php

$cards = get_field('sel_cd');
$heading = get_field('cd_hd');
$content = get_field('cd_cont');

?>

<?php if ($cards): 
    
   
    ?>
    
<section class="block-cards">
    <div class="cd-content">
    <?php if($heading): ?>
        <h2 class="hero-title"><?php echo $heading; ?></h2>
    <?php endif; ?>
    <?php if($content): ?>
        <?php echo $content; ?>
    <?php endif; ?>
    </div>
    <div class="grid">

    <?php foreach ($cards as $card) :   
            $card_title = $card['cd_title'];
            $card_image = $card['cd_img']['url'];
            $card_image_alt = $card['cd_img']['title'];
            $card_link = $card['cd_link']; 
    ?>
        <article class="card" style="background-image:url(<?php echo $card_image; ?>);">
            <div class="card__content">
                <div class="card__inner">
                <h3 class="card__text"><?php echo $card_title; ?></h3>
                <?php if($card_link): ?>
                    <div class="btn-row">
                        <a class="btn btn--secondary" role="link"  
                            href="<?php echo esc_url( $card_link['url'] ); ?>" 
                            target="<?php echo esc_attr( $card_link['target'] ); ?>">
                            <?php echo esc_html( $card_link['title'] ); ?>
                        </a>    
                    </div>
                <?php endif; ?>
                </div>
            </div>
            
        </article>
               
    <?php endforeach; ?>
        
    </div>
</section>
<?php endif; ?>