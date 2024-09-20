jQuery(document).ready(function($)
{


	$('.escritorios-carrousel').owlCarousel({
		loop: false,
		responsive: false,
		dots: false,
		nav: true,
		smartSpeed: 400,
		items: 3,
		responsive: {
			0: {
				items: 1,
				margin: 0,
			},
			768: {
				items: 2,
				margin: 30,
			},
			1025: {
				items: 4,
				// margin: 30,
			}
		}
	});


    $('.escritorios-carrousel .owl-next span').html('<svg xmlns="http://www.w3.org/2000/svg" width="25px" height="40px" viewBox="0 0 50 100" fill="none" stroke="#007d35"><polyline points="0 0 50 50 0 100" stroke-width="2"/></svg>');
	$('.escritorios-carrousel .owl-prev span').html('<svg xmlns="http://www.w3.org/2007d35/svg" width="25px" height="40px" viewBox="0 0 50 100" fill="none" stroke="#007d35"><polyline points="50 0 0 50 50 100" stroke-width="2"/></svg>');
});