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
		$('#form-contato').submit(function() {

			$('#form-contato .load').fadeIn(200);

			if ( $('#form-contato #nome').val() == '' ) {
				$('#form-contato .load').fadeOut(100);
				$('#form-contato .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo nome!').fadeIn(350);
				});
			} else if ( $('#form-contato #email').val() == '' ) {
				$('#form-contato .load').fadeOut(100);
				$('#form-contato .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo E-mail!').fadeIn(350);
				});
			} else if ( $('#form-contato #telefone').val() == '' ) {
				$('#form-contato .load').fadeOut(100);
				$('#form-contato .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Telefone!').fadeIn(350);
				});
			} else if ( $('#form-contato #mensagem').val() == '' ) {
				$('#form-contato .load').fadeOut(100);
				$('#form-contato .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Mensagem!').fadeIn(350);
				});
			} else {

				var email = $('#form-contato #email').val();

				if (validateEmail(email)) {

					$('#form-contato .msg').fadeOut(200);
					$('#form-contato .load').fadeIn(200);

					$.ajax({
						type: 'POST',
						url: HTTP+'php/envios/Envio.contato.php',
						data: $(this).serialize(),
						success: function(output) {

							$('#form-contato .load').fadeOut(100);

							if(output == 1)
							{
								$('#form-contato #nome').val('');
								$('#form-contato #email').val('');
								$('#form-contato #telefone').val('');
								$('#form-contato #mensagem').val('');

								$('#form-contato .msg').fadeOut(200, function() {
									$(this).removeClass('error').addClass('success').html('Mensagem enviada com sucesso!').fadeIn(300);
								});
							} 

							if(output == 0){
								$('#form-contato .msg').fadeOut(200, function() {
									$(this).removeClass('success').addClass('error').html("Desculpe, ocorreu durante o envio. Tente novamente!").fadeIn(350);
								});
							}

							if(output == "codigo_invalido") {
								$('#form-contato .msg').fadeOut(200, function() {
									$(this).removeClass('success').addClass('error').html("Código Inválido!").fadeIn(350);
								});
							}

						}
					});
				} else {
					$('#form-contato .msg').fadeOut(200, function() {
						$(this).removeClass('success').addClass('error').html('Digite um e-mail válido!').fadeIn(350);
					});
				}
			}
			return false;
		});


	});

})(window.jQuery);
