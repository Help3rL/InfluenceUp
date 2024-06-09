jQuery(document).ready(function ($) {
	var $carousel = $(".services-carousel-cards");
	$(".services-carousel-cards").slick({
		autoplay: false,
		dots: false,
		slidesToShow: 5,
		slidesToScroll: 5,
		prevArrow: $(".service-carousel-prev"),
		nextArrow: $(".service-carousel-next"),
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				},
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
		],
	});
	// $carousel.on("setPosition", function () {
	// 	$(".slick-slide").css("margin-left", "15px");
	// 	$(".slick-slide.slick-active::first-child").css("margin-left", "0");
	// });


    // $carousel.on("setPosition", function () {
    //     // Išvalome visiems slaidams margin-left
    //     $(".slick-slide").css("margin-left", "15px");
    //     // Nustatome margin-left: 0 tik pirmajam aktyviam slaidui
    //     $(".slick-slide.slick-active").css("margin-left", "0");
    // });
});
