<?php
/**
 *  Education Zone Pro Child Functions
*/

function education_zone_pro_child_enqueue() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
    wp_enqueue_script( 'education-zone-pro-init', get_stylesheet_directory_uri().'/js/init.js' );
}
add_action( 'wp_enqueue_scripts', 'education_zone_pro_child_enqueue');

/* ROI */
include get_stylesheet_directory_uri() . '/tmpl/roi/plug.php';

/************
Child Meta box 
**************/
require get_stylesheet_directory() . '/inc/childmetabox.php';

/**
 * Use parent theme setting in child theme without loosing already set options.
 * @link https://core.trac.wordpress.org/ticket/27177#comment:3
*/

if ( get_stylesheet() !== get_template() ) {
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
         update_option( 'theme_mods_' . get_template(), $value );
         return $old_value; // prevent update to child theme mods
    }, 10, 2 );

    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
}

function education_zone_pro_customize_register_cpt_child( $wp_customize ) {
    /** Archive Slug */
    $wp_customize->add_setting(
        'rename_course_slug',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
        
    $wp_customize->add_control(
        'rename_course_slug',
        array(
            'label'   => __( 'Rename Course Slug', 'education-zone-pro' ),
            'description' => sprintf( __( 'You can rename course slug from here, after changing slug you have to save changes on permalinks. Go to %1$sPermalinks%2$s.', 'education-zone-pro' ), '<a href="' . admin_url( 'options-permalink.php' ) . '" target="_blank">','</a>' ),
            'section' => 'education_zone_pro_course_page_setting',
            'type'    => 'text',
        )
    );
}
add_action( 'customize_register', 'education_zone_pro_customize_register_cpt_child' );

add_action( 'registered_post_type', 'custom_post_type_rename_labels', 10, 2 );
/**
 * Modify registered post type menu label
 * 
 * @param string $post_type Registered post type name. 
 * @param array $args Array of post type parameters.
 */
function custom_post_type_rename_labels( $post_type, $args ) {

        global $wp_post_types;
        if ( 'course' === $post_type ) {
            $args->labels->name                  = __( 'What We Do', 'education-zone-pro' );
            $args->labels->singular_name         = __( 'What We Do', 'education-zone-pro' );
            $args->labels->add_new_item          = __( 'Add New What We Do', 'education-zone-pro' );
            $args->labels->edit_item             = __( 'Edit What We Do', 'education-zone-pro' );
            $args->labels->new_item              = __( 'New What We Do', 'education-zone-pro' );
            $args->labels->view_item             = __( 'View What We Do', 'education-zone-pro' );
            $args->labels->view_items            = __( 'View What We Do', 'education-zone-pro' );
            $args->labels->search_items          = __( 'Search What We Do', 'education-zone-pro' );
            $args->labels->all_items             = __( 'All What We Do', 'education-zone-pro' );
            $args->labels->archives              = __( 'What We Do Archives', 'education-zone-pro' );
            $args->labels->attributes            = __( 'What We Do Attributes', 'education-zone-pro' );
            $args->labels->insert_into_item      = __( 'Insert into What We Do', 'education-zone-pro' );
            $args->labels->uploaded_to_this_item = __( 'Uploaded to this What We Do', 'education-zone-pro' );
            $args->labels->items_list            = __( 'What We Do List', 'education-zone-pro' );
            $args->labels->menu_name             = __( 'What We Do', 'education-zone-pro' );
            $args->labels->name_admin_bar        = __( 'What We Do', 'education-zone-pro' );
            $args->labels->update_item           = __( 'Update What We Do', 'education-zone-pro' );
            $wp_post_types[ $post_type ] = $args;
        }
} 

//rename custom post type using the child theme
function rename_custom_post_type_slug( $args, $post_type ) {
    $course_slug     = get_theme_mod( 'rename_course_slug' );
    if ( 'course' === $post_type ) {
        if( $course_slug ){
            $args['rewrite']['slug'] = $course_slug;
        }
    }
    return $args;
}
add_filter( 'register_post_type_args', 'rename_custom_post_type_slug', 10, 2 );

function education_zone_pro_what_we_do_shortcode_child( $atts ){
 extract(shortcode_atts(array(
     'id'=>$id,
    ), $atts ));
$excerpt_char = get_theme_mod( 'education_zone_pro_post_no_of_char', 200 ); //From Customizer
$course_order = get_theme_mod( 'education_zone_pro_course_order', 'date' );
ob_start();

    ?>
    <div class="template-courses wwd-shortcode">
     <div class="cat-posts">
         <?php 
                $args = array(
                    'taxonomy'      => 'course-category',
                    'orderby'       => 'name', 
                    'order'         => 'ASC',
                    'include'       => $id,
                );                
                $terms = get_terms( $args );
                if( $terms ){
                ?>
                <ul class="cat-nav filter-button-group">        
                    <li data-filter="*" class="is-active"><a href="#"><?php echo esc_html_e( 'All', 'education-zone-pro' ); ?></a></li>
                    <?php
                        foreach( $terms as $t ){
                            echo '<li data-filter=".' . esc_attr( $t->slug ) .  '"><a href="#">' . esc_html( $t->name ) . '</a></li>';
                        } 
                    ?>
                </ul>            
                <?php
                }
            ?>

            <?php $course_args = array( 
                'post_type' => 'course', 
                'post_status' => 'publish', 
                'posts_per_page' => -1,
            );
                if( $course_order == 'menu_order' ){
                    $course_args['orderby'] = 'menu_order title';            
                    $course_args['order']   = 'ASC';
                }
                $course_qry = new WP_Query( $course_args );
                if( $course_qry->have_posts() ){
            ?>
            <ul class="post-lists">
            <?php
                    while( $course_qry->have_posts() ){
                        $course_qry->the_post();
                        $terms = get_the_terms( get_the_ID(), 'course-category' );
                        $s = '';
                        $i = 0;
                        if( $terms ){
                            foreach( $terms as $t ){
                                $i++;
                                $s .= $t->slug;
                                if( count( $terms ) > $i ){
                                    $s .= ' ';
                                }
                            }
                        }  ?>
            
                <li class="<?php echo esc_attr( $s );?>">
                    <article class="post">
                       <?php if( has_post_thumbnail() ){ ?>

                        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                        <?php the_post_thumbnail( 'education-zone-pro-course' ); ?>
                        </a>
                        <?php } ?>
                        <div class="text">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </header>
                            <div class="entry-content">
                                <?php 
                                if( has_excerpt() ){
                                    the_excerpt();
                                }else{
                                    echo wpautop( wp_kses_post( force_balance_tags( education_zone_pro_excerpt( get_the_content(), $excerpt_char, '...', false, false ) ) ) ); 
                                }   
                                ?> 

                            </div>
                        </div>
                    </article>
                </li>
                <?php } wp_reset_postdata(); ?>
            </ul>
        <?php } ?>
        </div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'what_we_do_template', 'education_zone_pro_what_we_do_shortcode_child' );



function education_zone_pro_what_we_do_shortcode_posts_child( $atts ){
 extract(shortcode_atts(array(
     'id'=>$id,
    ), $atts ));
    $excerpt_char = get_theme_mod( 'education_zone_pro_post_no_of_char', 200 ); //From Customizer
    $course_order = get_theme_mod( 'education_zone_pro_course_order', 'date' );
    ob_start();
    ?>
    <div class="template-courses wwd-shortcode">
     <div class="cat-posts">
        <?php $course_args = array( 
                'post_type'      => 'course', 
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'course-category',
                        'field'    => 'term_id',
                        'terms'    => $id,
                    ),
                ), 
                'posts_per_page' => -1,
            );
                if( $course_order == 'menu_order' ){
                    $course_args['orderby'] = 'menu_order title';            
                    $course_args['order']   = 'ASC';
                }
            $course_qry = new WP_Query( $course_args );

            if( $course_qry->have_posts() ){ ?>
            <ul class="post-lists">
            <?php
                    while( $course_qry->have_posts() ){
                        $course_qry->the_post();  ?>
            
                        <li class="cat-lists-posts">
                            <article class="post">
                               <?php if( has_post_thumbnail() ){ ?>

                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php the_post_thumbnail( 'education-zone-pro-course' ); ?>
                                </a>
                                <?php } ?>
                                <div class="text">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </header>
                                    <div class="entry-content">
                                        <?php 
                                        if( has_excerpt() ){
                                            the_excerpt();
                                        }else{
                                            echo wpautop( wp_kses_post( force_balance_tags( education_zone_pro_excerpt( get_the_content(), $excerpt_char, '...', false, false ) ) ) ); 
                                        }   
                                        ?> 

                                    </div>
                                </div>
                            </article>
                        </li>
                <?php } wp_reset_postdata(); ?>
            </ul>
        <?php } ?>
        </div>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'what_we_do_posts', 'education_zone_pro_what_we_do_shortcode_posts_child' );




