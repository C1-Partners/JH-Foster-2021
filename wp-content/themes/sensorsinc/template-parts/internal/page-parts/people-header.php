<?php

$image = get_the_post_thumbnail_url();

?>

<header class="internal-header">
    <div class="person">
        <?php if ($image): ?>
        <div class="post-img" style="background-image: url(<?php echo $image; ?>)"></div>
        <?php endif; ?>
    </div>
</header>