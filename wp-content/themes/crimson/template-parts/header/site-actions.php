<?php 

$cart_icon = get_field('sh_icon', 'option');
$cart_link = get_field('sh_lnk', 'option');


?>

<div class="site-actions">
    <ul id="search-actions" class="search-btns">
        <li class="list">
            <button id="search-open"><?php echo crimson_inline_icon('search.svg') ?><span class="sr-only">Open search</span></button>
            <button id="search-close"><?php echo crimson_inline_icon('close.svg') ?><span class="sr-only">Close search</span></button>
        </li>
    </ul>
    <?php if ($cart_icon && $cart_link) : ?>
        <a class="shop-lnk" href="<?php echo $cart_link['url']; ?>" target="<?php echo $cart_link['target']; ?>" role="link">
            <img src="<?php echo $cart_icon['url']; ?>" alt="<?php echo $cart_icon['title']; ?>" height="27" width="27" />
        </a>
    <?php endif; ?>
    <button 
        class="menu navbar-toggler collapsed" 
        onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" 
        data-target="#PrimaryNav"
        data-toggle="collapse"
        aria-controls="PrimaryNav" 
        aria-expanded="false" 
        aria-label="Toggle navigation"
    >
        <svg width="40" height="40" viewBox="0 0 100 100">
            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
            <path class="line line2" d="M 20,50 H 80" />
            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
        </svg>
    </button>
    
</div>