(function($){
	$(document).ready(function() {

		// Mascaras
		$('#telefone').focusout(function(){
				var phone, element;
				element = $(this);
				element.unmask();
				phone = element.val().replace(/\D/g, '');
				if(phone.length > 10) {
					element.mask('(99) 99999.999?9');
				} else {
					element.mask('(99) 9999.9999?9');
				}
		}).trigger('focusout');


		// Validar email
		function validateEmail(email) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}

		/* ENVIA CONTATO */
		$('#form-trabalhe-conosco').submit(function() {

			$('#form-trabalhe-conosco .load').fadeIn(200);

			if ( $('#form-trabalhe-conosco #nome').val() == '' ) {
				$('#form-trabalhe-conosco .load').fadeOut(100);
				$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo nome!').fadeIn(350);
				});
			} else if ( $('#form-trabalhe-conosco #email').val() == '' ) {
				$('#form-trabalhe-conosco .load').fadeOut(100);
				$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo E-mail!').fadeIn(350);
				});
			} else if ( $('#form-trabalhe-conosco #telefone').val() == '' ) {
				$('#form-trabalhe-conosco .load').fadeOut(100);
				$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Telefone!').fadeIn(350);
				});
			} else if ( $('#form-trabalhe-conosco #mensagem').val() == '' ) {
				$('#form-trabalhe-conosco .load').fadeOut(100);
				$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Mensagem!').fadeIn(350);
				});
			} else {

				var email = $('#form-trabalhe-conosco #email').val();

				if (validateEmail(email))
				{

					$('#form-trabalhe-conosco .msg').fadeOut(200);
					$('#form-trabalhe-conosco .load').fadeIn(200);

					var data = new FormData($('#form-trabalhe-conosco').get(0));
    				var contentType = false;
    				var processData = false;


					$.ajax({
						type: 'POST',
						url: HTTP+'php/envios/Envio.trabalhe-conosco.php',
						dataType: 'json',
						data: data,
						contentType: contentType,
      					processData: processData,
						success: function(output) {

							$('#form-trabalhe-conosco .load').fadeOut(100);

							if(output == 1)
							{
								$('#form-trabalhe-conosco #nome').val('');
								$('#form-trabalhe-conosco #email').val('');
								$('#form-trabalhe-conosco #telefone').val('');
								$('#form-trabalhe-conosco #mensagem').val('');

								$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
									$(this).removeClass('error').addClass('success').html('Mensagem enviada com sucesso!').fadeIn(300);
								});
							} 

							if(output == 0){
								$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
									$(this).removeClass('success').addClass('error').html(output).fadeIn(350);
								});
							}

							if(output == "codigo_invalido") {
								$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
									$(this).removeClass('success').addClass('error').html("Código Inválido!").fadeIn(350);
								});
							}

						}
					});
				} else {
					$('#form-trabalhe-conosco .msg').fadeOut(200, function() {
						$(this).removeClass('success').addClass('error').html('Digite um e-mail válido!').fadeIn(350);
					});
				}
			}
			return false;
		});


	});

})(window.jQuery);