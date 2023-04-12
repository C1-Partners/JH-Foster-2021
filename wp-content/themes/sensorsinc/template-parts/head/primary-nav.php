<?php
/*
 * Primary Navigation
 */
?>


<nav class="header__nav" id="mainNav" aria-label="primary">
    <div class="mobile-nav-header">
        <span class="menu-label">MENU</span>
        <?php 
            echo gsc("btn-close", [
                "content" => [
                    "class" => "mobile-nav-close",
                    "text"  => "close",
                    "attrs" => [
                        "id" => "mobileNavClose"
                    ]
                ]
            ]);
        ?>
        <div class="mobile-nav-header__bottom"></div>
    </div>
    <form role="search" method="get" id="searchForm" class="header__search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
        <input type="search" class="search-field" id="searchInput" placeholder="Search <?php bloginfo( 'name' ) ?>&hellip;" value="<?php echo get_search_query() ?>" name="s" />
        <button type="submit" class="search-submit search-btn" aria-label="Open Search">
            <svg class="hide-desktop" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.5625 19.8125L15.0633 13.3121C16.0629 11.9996 16.6254 10.3121 16.6254 8.4992C16.6254 3.9992 13.0008 0.374603 8.5008 0.374603C4.0008 0.374603 0.375 4.0004 0.375 8.5004C0.375 13.0004 3.9996 16.625 8.4996 16.625C10.3125 16.625 11.9367 16.0625 13.3125 15.0629L19.8129 21.5633C20.0625 21.8129 20.3754 21.9383 20.6883 21.9383C21.0012 21.9383 21.3129 21.8129 21.5637 21.5633C22.0629 21.0629 22.0629 20.3129 21.5625 19.8125L21.5625 19.8125ZM8.5008 14.1254C5.3754 14.1254 2.8758 11.6258 2.8758 8.5004C2.8758 5.375 5.3754 2.8754 8.5008 2.8754C11.6262 2.8754 14.1258 5.375 14.1258 8.5004C14.1258 11.6246 11.625 14.1254 8.5008 14.1254Z" fill="#f8f7f7"></path>
            </svg>
            <svg class="hide-mobile" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="#f8f7f7"/>
            </svg>
        </button>
    </form>
    <div class="header__nav-mobile-scroll">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'primary-menu',
                'container'		 =>  false,
                'menu_id'        => 'menuPrimary',
                'menu_class'	 => 'header__nav-menu',
            ));
        ?>
    </div>
</nav>