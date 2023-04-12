<?php
$logoSets = get_field('co_logos', 'options');

?>

<div class="footer__co-logos">
    <?php if ($logoSets) : ?>
    <?php foreach ($logoSets as $logoSet) : 
        $logo = $logoSet['co_logo'];
        $link = $logoSet['co_link'];
        if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        endif; ?>
        <a href="<?php echo $link_url; ?>" title="<?php echo $link_title; ?>" target="<?php echo $link_target; ?>">
            <img class="co-img" src="<?php echo $logo['url']; ?>" height="50" width=auto" alt="<?php echo $logo['title']; ?>" />
        </a>
    <?php endforeach; ?>
    <?php endif; ?>
</div>