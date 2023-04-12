

<div id="site-search" class="search-form-wrap">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
        <label class="sr-only" for="site-search-field">Search for</label>
        <input type="search" id="site-search-field" class="search-field" placeholder="Search <?php bloginfo( 'name' ) ?>&hellip;" value="<?php echo get_search_query() ?>" name="s" />
        <input type="submit" class="search-submit search-btn" value="Go" />
    </form>
</div>