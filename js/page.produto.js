(function($){
	$(document).ready(function() {
		
		/* Galeria */
		var a = function(self){
	        self.anchor.fancybox();
	    };

		$('.galeria .gal ul').PikaChoose({
			showCaption: false,
			carousel: true,
			autoPlay: false,
			showTooltips: false,
			buildFinished:a
		});

		/* Carousel */
		$('.jcarousel').jcarousel({
			wrap: 'both'
		});

		$('a.fancybox').fancybox();

	});

})(window.jQuery);