<?php
/*
 * Secondary Navigation
 */
?>

<div id="secondaryNav" class="header__nav-secondary">
    <nav class="header__secondary-nav" id="secondaryNav" aria-label="secondary">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'secondary-menu',
                'container'		 =>  false,
                'menu_id'        => 'menuSecondary',
                'menu_class'	 => 'header__nav-secondary',
            ));
        ?>
    </nav>
    <button class="btn open-search-btn" id="searchOpen" aria-label="Toggle search">
        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.5625 19.8125L15.0633 13.3121C16.0629 11.9996 16.6254 10.3121 16.6254 8.4992C16.6254 3.9992 13.0008 0.374603 8.5008 0.374603C4.0008 0.374603 0.375 4.0004 0.375 8.5004C0.375 13.0004 3.9996 16.625 8.4996 16.625C10.3125 16.625 11.9367 16.0625 13.3125 15.0629L19.8129 21.5633C20.0625 21.8129 20.3754 21.9383 20.6883 21.9383C21.0012 21.9383 21.3129 21.8129 21.5637 21.5633C22.0629 21.0629 22.0629 20.3129 21.5625 19.8125L21.5625 19.8125ZM8.5008 14.1254C5.3754 14.1254 2.8758 11.6258 2.8758 8.5004C2.8758 5.375 5.3754 2.8754 8.5008 2.8754C11.6262 2.8754 14.1258 5.375 14.1258 8.5004C14.1258 11.6246 11.625 14.1254 8.5008 14.1254Z" fill="#000"></path>
        </svg>
    </button>
    <?php 
        echo gsc("btn-close", [
            "content" => [
                "class" => "search-close",
                "attrs" => [
                    "id" => "searchClose"
                ]
            ]
        ]);
    ?>
</div>