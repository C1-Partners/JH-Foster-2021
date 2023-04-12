jQuery(document).ready(function($) {

    if(!$('#vendorLogos').length) return;

    $('.js-logos').slick({
        dots: true,
        arrows:false,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 1600,
        cssEase: 'linear',
        slidesToShow: 8,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1224,
                settings: {
                    arrows: false,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    dots: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true,
                }
            }
        ]
    });
})