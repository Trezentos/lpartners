(function($){
	$(document).ready(function() {
		/* Valida email */
		function validateEmail(email) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}


		// Masks
		$('#form-alterar-cadastro #cnpj').mask('99.999.999/9999-99');

		$('#form-alterar-cadastro #telefone').focusout(function(){
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

		$('#form-alterar-cadastro #celular').focusout(function(){
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

		/* Altera Cadastro */
		$('#form-alterar-cadastro').submit(function()
		{
			$('#form-alterar-cadastro .load').fadeIn(200);

			if ( $('#form-alterar-cadastro #nome').val() == '' ) {
				$('#form-alterar-cadastro .load').fadeOut(100);
				$('#form-alterar-cadastro .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Razão Social!').fadeIn(350);
				});
			} else if ( $('#form-alterar-cadastro #cnpj').val() == "" ) {
				$('#form-alterar-cadastro .load').fadeOut(100);
				$('#form-alterar-cadastro .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html("*Preencha o campo CNPJ!").fadeIn(350);
				});
			} else if ( $('#form-alterar-cadastro #email').val() == '' ) {
				$('#form-alterar-cadastro .load').fadeOut(100);
				$('#form-alterar-cadastro .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo E-mail!').fadeIn(350);
				});
			} else if ( $('#form-alterar-cadastro #telefone').val() == '' ) {
				$('#form-alterar-cadastro .load').fadeOut(100);
				$('#form-alterar-cadastro .msg').fadeOut(200, function() {
					$(this).removeClass('success').addClass('error').html('*Preencha o campo Telefone!').fadeIn(350);
				});
			} else {
				var email = $('#form-alterar-cadastro #email').val();

				if (validateEmail(email)){

					$('#form-alterar-cadastro .msg').fadeOut(200);
					$('#form-alterar-cadastro .load').fadeIn(200);

					$.ajax({
						type: 'POST',
						url:  HTTP+'php/envios/Envio.alterarcadastro.php',
						data: $(this).serialize(),
						success: function(output) {

							$('#form-alterar-cadastro .load').fadeOut(100);

							if (output == 1)
							{
								$('#form-alterar-cadastro .msg').fadeOut(200, function() {
									$(this).removeClass('error').addClass('success').html('Cadastro atualizado com sucesso!').fadeIn(300);
								});

								$('#form-alterar-cadastro #senha').val('');
								$('#form-alterar-cadastro #confirmar-senha').val('');

							} else {
								$('#form-alterar-cadastro .msg').fadeOut(200, function() {
									$(this).removeClass('success').addClass('error').html(output).fadeIn(350);
								});
							}
						}
					});

				} else {
					$('#form-alterar-cadastro .msg').fadeOut(200, function() {
						$(this).removeClass('success').addClass('error').html('Digite um e-mail válido!').fadeIn(350);
					});
				}
			}
			return false;
		});
		
		
	});

})(window.jQuery);