<?php 

$authBio = get_the_author_meta('description');
$authLink = get_the_author_posts_link();
$author = get_the_author();

?>

<div class="author-description">
    <?php if ($authBio): ?>
        <h4>About <?php echo $author; ?></h4>
        <p><?php echo $authBio; ?></p>
    <?php else : ?>
        <h4>Article by <?php echo $author; ?></h4>
    <?php endif; ?>      
</div>