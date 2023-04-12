<?php



/*
 * Modify comments template
 * 
 * Note the lack of a trailing </li>. In order to accommodate nested replies,
 * WordPress will add the appropriate closing tag after listing any child elements.
 * 
 * This function is to move the commentmetadata and comments text under div.comment-meta for styling
 */
function sw_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>

        <div class="comment-author vcard"><?php 
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
        </div><?php 
        if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <div class="comment-meta">
            <div class="commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                    /* translators: 1: date, 2: time */
                    printf( 
                        __('%1$s at %2$s'), 
                        get_comment_date(),  
                        get_comment_time() 
                    ); ?>
                </a><?php 
                edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
            </div>
            <?php comment_text(); ?>

            <div class="reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); 
                ?>
            </div>
        </div>
 
        <?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}

/*
 * Modify field order for comments form
 */
add_filter( 'comment_form_fields', 'comment_fields_custom_order' );
function comment_fields_custom_order( $fields ) {
    // $comment_field = $fields['comment_field'];
    $comment = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $url_field = $fields['url'];
    $cookies_field = $fields['cookies'];
    // unset( $fields['comment_field'] );
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['url'] = $url_field;
    $fields['comment'] = $comment;
    $fields['cookies'] = $cookies_field;
    // done ordering, now return the fields:
    return $fields;
}

// add_filter('comment_form_default_fields', 'my_comment_form_args');
// function my_comment_form_args($args) {

// 	$args['author'] = '<div class="before"><p class="comment-form-author"><input class="form__input" id="author" name="author" type="text" size="40" tabindex="1" aria-required="true" title="'. __( 'Your Name (required)','my-text-domain' ) .'" required /></p>';
// 	$args['email'] = '<p class="comment-form-email"><input class="form__input" id="email" name="email" type="email" size="40" tabindex="2" aria-required="true" title="'. __( 'Email Address (required)','my-text-domain' ) .'" required /></p>';
// 	$args['url'] = '<p class="comment-form-url"><input class="form__input" id="url" name="url" type="url" size="40" tabindex="3" aria-required="false" title="'. __( 'Website (url)','my-text-domain' ) .'" required /></p></div>';

// 	return $args;
// }

