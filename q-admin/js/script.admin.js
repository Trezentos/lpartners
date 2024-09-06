(function($){
	$(document).ready(function() {

		// DELETAR
		$('button[name="deletar"], a.deletar').click(function(event) {
			if(confirm('Você realmente deseja excluir?')) return true;
			else return false;
		});

		// MENU CURRENT CONTROL
		$('#sidebar nav ul li').hover(
			function() {
				$(this).addClass('current');
			}, function() {
				$(this).removeClass('current');
			}
		);

		var url			= $(location).attr('href');
		var pageID		= url.split('/').slice(-1)[0];
		var fullPage	= pageID.split('?').slice(0)[0];
		var page		= fullPage.split('-').slice(0)[1];
		if (page) var father = page.split('.').slice(0)[0];

		$('#sidebar nav ul li a').each(function() {
			var href = $(this).attr('href');
			if ( ('list-'+father+'.php') == href) {
				$(this).parent().addClass('active');
				$(this).parent().parent().parent().addClass('active');
			} else if ( ('list-'+father+'s.php') == href) {
				$(this).parent().parent().parent().addClass('active');
				if (father == 'categoria') {
					$(this).parent().addClass('active');
				}
			} else if ( href == fullPage ) {
				$(this).parent().addClass('active');
			}
		});

		// SUB MENU CONTROL
		$('#sidebar nav ul li a').each(function() {
			if ( $(this).hasClass('dropdown') ) {
				$(this).click(function(event) {
					$(this).next().slideToggle('fast');
				});

				$(this).next().children().each(function(index, el) {
					if ( $(this).hasClass('active') ) {
						$(this).parent().css('display', 'block');
					}
				});
			}
		});

		// ALERT OUTS
		$('.alert').hide();

		// TABLE SORT
		$('table').tablesorter({
			sortReset: true,
			sortRestart: true
		}); 

		// DISABLE TABS ALERTS
		$( ".nav-tabs .disable" ).click(function() {
			$('.alert-warning').html('').append('Salve primeiro para depois editar esta aba. <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();

			$('.alert-warning button.close').click(function(e) {
				e.preventDefault();
				$(this).parent().fadeOut('300', function() {
					$(this).html('');
				});
			});
		});

		// CLOSE BUTTON
		$('.alert button.close').click(function(e) {
			e.preventDefault();
			$(this).parent().fadeOut();
		});

		// DELETAR
		$("a.delete").click(function(){
			if(confirm('Você realmente deseja excluir?')) return true;
			else return false;	
		});

		// DATEPICKER
		$(".datepicker").datepicker({
			defaultDate: +7,
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});

		// Datepicker
		//if($(".datepicker").val() && $("input[name=action]").val()=='alterar') {
			//var data 	= $(".datepicker").val();
			//var nData 	= data.split('/');
			//$('.datepicker').datepicker({defaultDate: new Date (nData[2], (parseFloat(nData[1])-1), nData[0])});
		//} else $('.datepicker').datepicker({ defaultDate: '' });
		
		// GERAR PERMALINK
		$("#titulo").change(function(){
			thisValue 		= $(this).val();
			valuePermalink 	= $("#permalink").val();

			if (thisValue) {
				$.getJSON('ajax-limpa-string.php',{string: thisValue, tabela: $('input[id="tabela"]').val()} ,function(value) {
					if(value.error == 'false') $("#permalink").val(value.string);
				});
			}
		});

		// SELECT ESTADO/CIDADE
		$('form #estado').change(function(){
			var valueState = $(this).val();
			$.ajax({
				type: "POST",
				url: "ajax-cidades.php",
				data: "estado="+valueState,
				beforeSend: function() {
					$("#carregando").show();
					$("form #cidade").empty();
					$("form #cidade").html('<option>Carregando, aguarde...</option>');
				},
				success: function(txt) {
					$("#carregando").hide();
					$("form #cidade").empty();
					$("form #cidade").html(txt);
				},
				error: function(txt) {
					$("#carregando").hide();
					$("form #cidade").html('<option value="">Selecione</option>');
					alert('Desculpe, houve um erro interno.');
				}
			});
		});



	});

	$(window).load(function(){});
})(window.jQuery);