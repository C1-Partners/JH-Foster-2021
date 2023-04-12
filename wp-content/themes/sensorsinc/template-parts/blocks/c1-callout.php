<?php
/**
 * Custom block for callouts and newsletter signups
 *
 * @package SW
 */

$blockType     = get_field('j-type');
$heading       = get_field('j-heading');
$link          = get_field('j-call-btn');
$bgImg         = get_field('j-bg');
$postIds       = get_field('j-posts');
$content       = get_field('j-content');

$posts = [];

 if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif; 

$postsQuery = new WP_Query([
    'post_type'      => 'post',
    'post__in'       => $postIds,
    'posts_per_page' => 3,
    'no_found_rows'  => true,
]);

if($postsQuery->have_posts()) {
    while($postsQuery->have_posts()) {
        $postsQuery->the_post();
        $post_id = get_the_ID();
        $posts[] = [
            'id'    => $post_id,
            'url'   => get_the_permalink(),
            'title' => get_the_title(),
            'image' => get_the_post_thumbnail_url(),
        ];
    }
}

wp_reset_postdata();

?>

 <section class="block-callout margin-top--lg margin-bottom--lg" style="<?php echo ($bgImg) ? 'background-image:url(' . $bgImg['url'] . ');' : ''; ?>">
    <div class="inner">
        <div class="left">
            <h2><?php echo $heading; ?></h2>
            <div class="button-row">
                <?php if($blockType === 'callout') :   
                    if($link): ?>
                        <a class="btn btn-primary" role="link"  
                            href="<?php echo esc_url( $link_url ); ?>" 
                            target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>    
                    <?php endif; 
                endif; ?>
            </div>
        </div>
        <div class="right">
        <?php if($blockType === 'newsletter') : ?> 
            <?php echo $content; ?>
            <div class="button-row">
            <?php if($link): ?>
                <a class="btn btn-primary" role="link"  
                    href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                </a>    
            <?php endif; ?>
            </div>
        <?php elseif($blockType === 'callout') : ?>
                <ul>
                <?php foreach($posts as $post): ?>
                    <a href="<?php echo $post['url']; ?>">
                        <li><?php echo $post['title']; ?>
                            <p>
                                <span class="cta">Read Story 
                                    <svg width="15" height="15" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                                        <path d="M26.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="#747474"/>
                                    </svg>
                                </span>
                            </p>
                        </li>
                    </a>
                <?php endforeach; ?>
                </ul>
        <?php endif; ?>
        </div>
    </div>
</section>