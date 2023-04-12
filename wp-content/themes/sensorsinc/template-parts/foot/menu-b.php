<?php 

$title = get_field('men_b_tl', 'option');
$items = get_field('men_b', 'option');

?>

<div class="footer-menu">
    <?php if ($title): ?>
        <h3 class="footer-menu__title"><?php echo $title; ?></h3>
    <?php endif; ?>

    <?php if ($items): ?>
        <ul class="footer-menu__list">
        <?php foreach ($items as $item) : 
            $link = get_permalink( $item->ID ); ?>
            <li class="footer-menu__item">
                <a href="<?php echo $link; ?>">
                <?php echo $item->post_title; ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>  
</div>