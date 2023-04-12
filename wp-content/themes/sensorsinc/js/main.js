import "core-js";
import "regenerator-runtime/runtime";
import './block-quote';

import "glob-loader!./../config/jsglob.pattern";

document.addEventListener("DOMContentLoaded", function() { 

const navOpenBtn = document.getElementById('navOpen'),
    navCloseBtn = document.getElementById('mobileNavClose'),
    body = document.getElementById('body'),
    header  = document.getElementById('header'),
    headerWrap = document.getElementById('headerOuter'),
    searchOpen = document.getElementById('searchOpen'),
    searchClose = document.getElementById('searchClose'),
    searchForm = document.getElementById('searchForm'),
    menuPrimary = document.getElementById('menuPrimary'),
    secondaryNavWrap = document.getElementById('secondaryNav'),
    searchInput = document.getElementById('searchInput'),
    filtersBtn = document.getElementById('showFilters'),
    closeFiltersBtn = document.getElementById('filtersClose');
    

/*
 * Search 
 */

const closeSearch = (e) => {
    e.preventDefault();
	searchForm.classList.remove('search-open');
    searchOpen.style.display = 'block';
    searchClose.style.display = 'none';
}
const openSearch = (e) => {
    e.preventDefault();
    searchForm.classList.add('search-open');
    searchOpen.style.display = 'none';
    searchClose.style.display = 'flex';
  
    searchInput.focus();
}
searchOpen.addEventListener('click', openSearch);
searchClose.addEventListener('click', closeSearch);

/*
 * Mobile Navigation
 */

// Open and close mobile navigation
const toggleMobileNav = () => {
    if (!body.classList.contains('show-nav')) {
        body.classList.add('show-nav');
    } else {
        body.classList.remove('show-nav');
    }
    toggleMobileNavOverlay();
}

// Toggles the overlay behind mobile nav
const toggleMobileNavOverlay = () => {
    const overlayHTML = `<div class="nav-overlay" id="navOverlay"></div>`,
          navOverlay = document.getElementById('navOverlay');
    if (!navOverlay) {
        secondaryNavWrap.insertAdjacentHTML('afterend', overlayHTML);
        body.style.overflow = 'hidden';
    } else {
        navOverlay.remove();
        body.style.overflow = 'unset';
    }
}
// Event listeners for nav buttons
[navOpenBtn, navCloseBtn].forEach(btn => {
    btn.addEventListener('click', toggleMobileNav);
})


let windowWidth = window.screen.availWidth;


if (windowWidth < 1024) {
    // Open and close mobile menu
    const toggleMobileSubMenu = () => {
        // select anchor tags in wp menu if the li element has children
        let anchors = menuPrimary.querySelectorAll('.menu-item-has-children > a');
    
        anchors.forEach(anchor => {
            const subMenu = anchor.nextElementSibling;

            anchor.addEventListener('click', (event) => {
                event.preventDefault();
                if (!subMenu.classList.contains('open')) {
                    subMenu.classList.add('open');
                    anchor.classList.add('toggle');
                } else {
                    subMenu.classList.remove('open');
                    anchor.classList.remove('toggle');
                }
            })
        });
    }
    toggleMobileSubMenu();
}




/*
 * Category Filters
 */
const toggleFilters = () => {
    const filters = document.getElementById('postFilters');
    
    if (!filters.classList.contains('show-filters')) {
            filters.classList.add('show-filters');
    } else {
        filters.classList.remove('show-filters');
    }
    toggleMobileNavOverlay();
}
if (filtersBtn) {
    filtersBtn.addEventListener('click', toggleFilters);
    closeFiltersBtn.addEventListener('click', toggleFilters);
}

/*
 * Fixed Navigation
 */  
const addClassHeader = () => {
    headerWrap.classList.add('sticky');
}
const removeClassHeader = () => {
    headerWrap.classList.remove('sticky');
}
const addStyleToElement = (element, style) => {
    for (const property in style)
        element.style[property] = style[property];
}

window.addEventListener('scroll', () => {
    const headerHeight = headerWrap.offsetHeight;
    let getScrollposition = window.scrollY;
    if (getScrollposition > 0) {
        addClassHeader();
        addStyleToElement(banner, {
            'padding-top' : headerHeight + 'px'
        });

    } else {
        removeClassHeader();
        addStyleToElement(banner, {
            'padding-top' :  ''
        });
    }
});

/*
 * Unclean Woocommerce adjustments
 */  

const productList = [...document.querySelectorAll('li.product')];
// style woo buttons
if (productList) {
    productList.forEach((product) => {
        const button = product.children[1];
        if (button.classList.contains('button')) {
            button.classList.remove('button');
            button.classList.add('btn', 'btn--primary');
        }
    })
}

/**
* Alert bar 
**/
// key is equal to title lowercase without spaces, check local storage for this title, if it exists do not display
const key = $('.alertbar__list').find('.alertbar__item').first().find('.alertbar__title').text().replace(/\s/g,'').toLowerCase();
const alertbar = document.getElementById('alertBar');

if (localStorage.getItem(key) !== 'yes') {
    $('.alertbar').addClass('active'); 
}
if (alertbar) {
    header.classList.add('header-with-bar');
}
// close alertbar when close button is clicked add key to local storage
$('.alertbar__close').on('click', function() {
    localStorage.setItem(key, 'yes');
    $('.alertbar__list').find('.alertbar__item').first().removeClass('active');
    $(this).closest('.alertbar').removeClass('active');
    header.classList.remove('header-with-bar');
});

});