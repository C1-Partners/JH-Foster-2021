<?php
global $post;
$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
$img_title = get_post(get_post_thumbnail_id())->post_title;

$utils = new Utils();
//parse args passed from get_template_part
$utils->parse_args($args);

$categories = get_the_category();

if ( !empty( $categories )) {
    $cat_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
}

?>


<section class="item">
    <div class="item__img">
        <?php 
        if ($img_url): 
        echo gsc("img", [
            "content" => [
                    "src" => $img_url,
                    "alt" => $img_title
                ],
                "style" => [
                    "type" => "thumbnail"
                ]
            ]);
  
        endif; ?>
    </div>
    <div class="item__tabs">
        <?php 
        $tabs = [];
        $docs = $args['docs']['doc_files'];
        if ($docs) {
            $tabs = [
                        [
                            "link" => "Description",
                            "content" => $args['content'],
                            "category" => $cat_link
                        ],
                        [
                            "link" => "Documentation",
                            "content" => $utils->acf_file_repeater($docs),
                            "category" => $cat_link
                        ]
                    ];
        } else {
            $tabs = [
                        [
                            "link" => "Description",
                            "content" => $args['content'],
                            "category" => $cat_link
                        ]
                    ];
        }
        echo gsc("tabs", [
        "content" => [
            "tabs" => $tabs,
            "aria_title" => "title for tab content",
            "group_name" => 'group'
            ]
        ]);
        ?>
    </div>
</section>



