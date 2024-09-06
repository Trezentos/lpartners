(function($){
	$(document).ready(function() {
		
		var tmpImg = new Image();

		function delay(functionCallBack, ms) {
		  if (ms === null || ms === undefined) {
		    ms = 500;
		  }
		  return setTimeout(functionCallBack, ms);
		}


		$('.list-cortes li').click(function(event) {
			event.preventDefault();
			var img;

			if( !$(this).hasClass("active"))
			{
				$('.titulo_produto').html( $(this).attr('data-name') );
				$('.link_destaque').attr( 'href', $(this).attr('data-link') );
				$('.link_destaque').attr( 'title', $(this).attr('data-name') );
				
				$('#card-img').fadeOut(0);
				img = $(this).attr('data-img');
				$('#card-img').attr('src',img);
				tmpImg.src = $('#card-img').attr('src');

				tmpImg.onload = function() {
			        $('#card-img').fadeIn(300);
			    };

				$('.list-cortes li').removeClass('active');
				$(this).addClass('active');
			}

		});

	});

})(window.jQuery);