
<?php

class QueryCustomPosts {
    // Constructor function to add get_custom_posts to init hook
    function __construct() {
        add_action('init', array($this, 'get_custom_posts'));
    }
    /**
     * @param string $post_type
     * @param string $taxonomy
     * @param array  $TermIDs
     * @return array
     *
     * Return posts in an array $posts 
     * -----------
     * 
     */
    public function get_custom_posts($post_type, $taxonomy = null, $termIDs = null) {
        $posts = [];
        if (isset($termIDs)) {
            $tax_query = array(
                array(
                    'taxonomy' => $taxonomy,
                    'terms' => $termIDs,
                    'field' => 'term_id',
                )
            );
        }
        $args = array(
              'post_type' => $post_type,
              'posts_per_page' => -1,
              'suppress_filters' => false,
              'order'     => 'ASC',
              //Filter taxonomies by id's passed from $taxonomy
              'tax_query' => $tax_query,
        );
        $query = new WP_Query( $args ); 
        
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $posts[] = $query->post;
            }
        }
    
        wp_reset_postdata();
    
        return $posts;
    }
}