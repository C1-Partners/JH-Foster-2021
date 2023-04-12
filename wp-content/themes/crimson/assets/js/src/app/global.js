/**
 * Global
 * ------
 */


/*
  Fixed Navigation
*/  
let stickyNav = $('.site-header').offset().top;

$(window).scroll(function() {

  let siteMain = $('.site-main'),
      siteHeader = $('.site-header');

  if ($(window).scrollTop() > stickyNav) {
    var $primaryWrap = siteHeader.addClass('is-fixed').css('top','0');
    siteMain.css('padding-top', $primaryWrap.outerHeight());
  }
  else {
    siteHeader.removeClass('is-fixed').css('top','');
    siteMain.css('padding-top','');
  }
});

/*
  Mobile Navigation
*/ 


//use the following functions on smaller screens only
if($(window).width() <= 990){

  $('#menu-primary .menu-item-has-children').each(function(){
    let label = $(this).children('a').text(),
        menu = $(this).find('> .sub-menu'),
        link = $(this).find('a:first').attr('href');

    menu.prepend('<a href="' + link +'"><p class="sub-menu-title">' + label + '</p>');
    menu.append('<div class="sub-menu-close"><button><span class="sr-only">Close sub menu</span></button></div>');
  });

  $('#menu-primary .menu-item-has-children > a').on('click', function(e){
    e.preventDefault();
    $(this).next('.sub-menu').addClass('in');
  });

  $('#menuToggle').on('click', function(e){
    if ($('#search-open').attr('disabled')) {
      $('#search-open').removeAttr('disabled');
    } else {
      $('#search-open').attr('disabled', 'disabled');
    }
  });

  $b.on('click', '.sub-menu-close button', function(e){
    e.preventDefault();
    $(this).closest('.sub-menu').removeClass('in');
  });

}

/*
  Search 
*/
const closeSearch = () => {
	$b.removeClass('search-shown');
  $('#search-overlay').remove();
}

let navToggler = $('.navbar-toggler');

$('#search-open').on('click', function(e){
  e.preventDefault();
  $b.addClass('search-shown');
  $('.search-field').focus();
  $('<div id="search-overlay"></div>').insertAfter('#header');
  navToggler.css('visibility', 'hidden');
});
$('#search-close').on('click', function(e){
  e.preventDefault();
  closeSearch();
  navToggler.css('visibility', 'visible');
});

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