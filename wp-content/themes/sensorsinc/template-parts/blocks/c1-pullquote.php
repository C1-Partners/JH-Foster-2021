<?php
/**
 * Custom quote and callout block
 *
 * @package SW
 */

$heading = get_field('h-heading');
$quote   = get_field('h-quote');
$auth    = get_field('h-cite');
$align   = get_field('h-align');
$style   = get_field('h-style');

?>

<figure class="block-quote <?php echo $align; ?> <?php echo $style; ?>" id="blockQuote">
    <blockquote id="qBlockquote">
        <?php if ($heading): ?>
            <div class="h-quote">
                <h3 id="qHeading"><?php echo $heading; ?></h3>
            </div>
        <?php endif; ?>

        <?php if ($quote): ?>
            <div class="quote"><?php echo $quote; ?></div>
        <?php endif; ?>

        <?php if ($auth): ?>
        <p class="auth"><?php echo $auth; ?></p>
        <?php endif; ?>
    </blockquote>
</figure>