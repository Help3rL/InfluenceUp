jQuery(document).ready(function($){
    $('.carousel-cards').slick({
        autoplay: false,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: $('.carousel-prev'),
        nextArrow: $('.carousel-next'),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});