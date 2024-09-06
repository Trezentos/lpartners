(function($){
	$(document).ready(function() {

		// SELECIONAR TODAS IMAGENS
		$('input#selecionar-todas').change(function() {
			var categoria	= $(this).val();
			var checkboxes	= $('#lista-imagens.'+categoria).find(':checkbox');

			if ( $(this).prop('checked') ) {
				$('#lista-imagens.'+categoria).find('div#thumb').addClass('checked');
				checkboxes.prop('checked', true);
			} else {
				$('#lista-imagens.'+categoria).find('div#thumb').removeClass('checked');
				checkboxes.prop('checked', false);
			}
		});

		// ADD CLASS AO CHECAR
		function check_img() {
			$('input.checkbox').change(function() {
				if ( $(this).prop('checked') ) {
					$(this).parents('div#thumb').addClass('checked');
				} else {
					$(this).parents('div#thumb').removeClass('checked');
				}
			});
		}

		// CHAMANDO FUNÇÃO
		check_img();
		
		// ATIVANDO IMAGEM
		function ativa_img() {
			$('.caption .ativar').on('click', function() {
				var thisElement = $(this);
				var thisID		= $(this).parents('.thumbnail').attr('data-thumb-id');
				var tabela		= $('input[name=tabela_img]').val();
				
				$.getJSON('ajax-fotos-funcoes.php', { id: thisID, action: 'ativa_desativa', tabela_img: tabela }, function(json) {
					switch(json.status) {
						case 'desativado':
							thisElement.removeClass('ativo').addClass('desativo');
							$('.alert-success').html('').append('Imagem desativada com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
						break;
						
						case 'ativado':
							thisElement.removeClass('desativo').addClass('ativo');
							$('.alert-success').html('').append('Imagem ativada com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
						break;			
					}
				});
			});
		}

		// CHAMANDO FUNÇÃO
		ativa_img();
		
		function legenda() {
			// GET LEGENDA IMAGEM
			$('.caption .legenda').on('click', function() {
				var thisID = $(this).parents('.thumbnail').attr('data-thumb-id');
				var tabela = $('input[name=tabela_img]').val();

				$('#form-legenda input[name=id_img]').val(thisID);
				$('#form-legenda .alert').html('').hide();
				
				$.getJSON("ajax-fotos-funcoes.php", { id: thisID, action: 'get_legenda', tabela_img: tabela }, function(json) {
					$('#form-legenda input[id="legenda"]').val(json.legenda);
					$('#form-legenda input[id="id"]').val(thisID);
				});
			});

			// SET LEGENDA IMAGEM
			$('#form-legenda').submit(function(event) {
				var thisID	= $('#form-legenda input[id="id"]').val();
				var imgID	= $('#form-legenda input[id="id_img"]').val();
				var legenda = $('#form-legenda input[id="legenda"]').val();
				var tabela  = $('input[name=tabela_img]').val();
					
				$.ajax({
					type: "GET",
					url: HTTP_GESTOR+'ajax-fotos-funcoes.php',
					data: $(this).serialize(),
					success: function(result) {
						var json 	= JSON.parse(result);
						if (json.error == 'false' && (json.legenda != null || json.legenda != '')) {
							$('.thumbnail[data-thumb-id="'+json.id_img+'"] a.legenda').removeClass('desativo').addClass('ativo');
							$('#form-legenda .alert').html('').append('Legenda atualizada com sucesso!').addClass('alert-success').fadeIn();
						}
						if (json.error == 'false' && (json.legenda == null || json.legenda == '')) {
							$('.thumbnail[data-thumb-id="'+json.id_img+'"] a.legenda').removeClass('ativo').addClass('desativo');
							$('#form-legenda .alert').html('').append('Legenda atualizada com sucesso!').addClass('alert-success').fadeIn();
						}
					}
				});

				return false;
			});
		}

		// CHAMANDO FUNÇÃO
		legenda();

		// SETAR CAPA
		function seta_capa() {
			$('.caption .capa').on('click', function() {
				var thisElement = $(this);
				var thisID		= $(this).parents('.thumbnail').attr('data-thumb-id');
				var categoria	= $(this).parents('.thumbnail').attr('data-thumb-categoria');
				var tabela		= $('input[name=tabela_img]').val();
				
				$.getJSON('ajax-fotos-funcoes.php', { id: thisID, action: 'set_capa', categoria: categoria, tabela_img: tabela }, function(json) {
					if (json.status == 'setada') {
						$('#lista-imagens.'+categoria+' .capa').each(function() {
							$(this).removeClass('ativo').addClass('desativo');
						});
						thisElement.removeClass('desativo').addClass('ativo');
						$('.alert-success').html('').append('Capa setada com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
					}
				});
			});
		}

		// CHAMANDO FUNÇÃO
		seta_capa();

		// DELETAR IMAGEM
		function del_img() {
			$('.caption .del').on('click', function() {
				var thisElement = $(this);
				var thisID 		= $(this).parents('.thumbnail').attr('data-thumb-id');
				var galID 		= $(this).parents('.thumbnail').attr('data-thumb-id-galeria');
				var categoria 	= $(this).parents('.thumbnail').attr('data-thumb-categoria');
				var tabela 		= $('input[name=tabela_img]').val();

				if (confirm('Você realmente deseja apagar?')) {
					$.getJSON('ajax-fotos-funcoes.php', { id: thisID, id_galeria: galID, action: 'deletar', tabela_img: tabela });
					thisElement.parents('#thumb').remove();
					$('.alert-success').html('').append('Imagen(s) deletada(s) com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
				}
			});
		}

		// CHAMANDO FUNÇÃO
		del_img();

		// DELETAR IMAGENS SELECIONADAS
		$('a.del-imagem').on('click', function(event) {
			var categoria	= $(this).attr('data-categoria');
			var checkeds	= $('#lista-imagens.'+categoria+' input[type=checkbox]:checked').length;
			var tabela		= $('input[name=tabela_img]').val();

			if (checkeds > 0) {
				if (confirm('Você realmente deseja apagar?')) {
					$('#lista-imagens.'+categoria+' input[type=checkbox]:checked').each(function() {
						var thisElement = $(this);
						var thisID 		= thisElement.val();
						thisElement.parents('#thumb').animate({opacity: 0}, 'fast', function() {
							$.getJSON("ajax-fotos-funcoes.php", { id: thisID, action: 'deletar', tabela_img: tabela });
							thisElement.parents('#thumb').remove();
							$('.alert-success').html('').append('Imagen(s) deletada(s) com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
							$('input#selecionar-todas').attr('checked', false);
						});
					});
				}
			}
		});

		// EDITAR
		$('.caption .editar').on('click', function() {
			//alert('asddsa');
		});

		// MODAL UPLOAD CATEGORIA
		$('button.modal-btn').on('click', function(event) {
			var categoria = $(this).attr('data-categoria');
			$('input[name=cat_imagens]').val(categoria);
		});

		// CLOSE MODAL UPLOAD
		$('#modal-upload .close, .modal-backdrop, .modal').click(function(event) {
			$('#modal-upload').find('.center').fadeIn();
			$('#modal-upload').find('.list-group').html('');
		});

		// UPLOAD DE IMAGENS
		var ul = $('#upload ul');

		// BOTAO SIMULANDO INPUT
		$('#drop a').on('click', function(){
			$(this).parent().find('input').click();
		});

		// INICIALIZANDO UPLOAD
		$('#upload').fileupload({
			//formData: { 'id': $('input[name=id]').val() },
			url: HTTP_GESTOR + 'ajax-fotos-upload.php',
			sequentialUploads: true,
			// Zona dropdown
			dropZone: $('#drop'),
			// Função chamada ao adicionar arquivo
			add: function (e, data) {
				var tpl = $('<li class="list-group-item working"><p></p><span class="glyphicon glyphicon-remove"></span><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div></li>');
				// Inserindo nome e tamanho do arquivo
				tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
				// FadeOut no texto e botão
				data.context = $('.center').fadeOut();
				// Inserindo itens na lista
				data.context = tpl.appendTo(ul);
				// Clique no icone
				tpl.find('span').click(function() {
					if(tpl.hasClass('working')){
						tpl.fadeOut(function() {
							tpl.remove();
							$('.center').fadeIn();
						});
						jqXHR.abort();
					} else {
						tpl.fadeOut(function(){
							tpl.remove();
							$('.center').fadeIn();
						});
					}
				});
				// Categoria do Empreendimento e ID da galeria
				data.formData = { 'id': $('input[name=id]').val(), 'categoria': $('input[name=cat_imagens]').val(), 'tabela': $('input[name=tabela]').val() , 'tabela_img': $('input[name=tabela_img]').val() };
				// Upload
				var jqXHR = data.submit()
					.success(function (result, textStatus, jqXHR){
						var json 	= JSON.parse(result);
						var status 	= json['status'];

						if (status == 'error') {
							data.context.find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
							data.context.find('.progress-bar').addClass('progress-bar-danger');
						}
					})
					.complete(function (result, textStatus, jqXHR){
						var json 			= JSON.parse(result);
						var status 			= json['status'];
						var id 				= json['id'];
						var nome 			= json['nome'];
						var id_galeria 		= json['id_galeria'];
						var categoria 		= json['categoria'];
						var tabela_img 		= json['tabela_img'];

						if (status == 'success') {
							listThumbnails(id, tabela_img, id_galeria, nome, categoria);

							seta_capa();
							check_img();
							ativa_img();
							del_img();
							legenda();
						}
					});
			},
			progress: function(e, data){
				// Calculando progresso
				var progress = parseInt(data.loaded / data.total * 100, 10);
				// Barra de progresso
				data.context.find('.progress-bar').css({ width: progress + '%' }).change();
				if(progress == 100){
					data.context.find('span').removeClass('glyphicon-remove').addClass('glyphicon-ok');
					data.context.find('.progress-bar').addClass('progress-bar-success');
					data.context.removeClass('working');
				}
			},
			fail: function(e, data){
				// Erro no upload
				data.context.find('span').removeClass('glyphicon-ok').addClass('glyphicon-remove');
				data.context.find('.progress-bar').addClass('progress-bar-danger');
				data.context.addClass('error');
			}
		});

		// DROP ARQUIVOS
		$(document).on('drop dragover', function(e) {
			e.preventDefault();
		});

		// FORMATANDO TAMAHO DAS IMAGENS
		function formatFileSize(bytes) {
			if (typeof bytes !== 'number') {
				return '';
			}
			if (bytes >= 1000000000) {
				return (bytes / 1000000000).toFixed(2) + ' GB';
			}
			if (bytes >= 1000000) {
				return (bytes / 1000000).toFixed(2) + ' MB';
			}
			return (bytes / 1000).toFixed(2) + ' KB';
		}

		// ORDER IMAGES
		$('#lista-imagens').each(function() {
			$(this).sortable({
				stop: function(event, ui) {
					var tabela		= $('input[name=tabela_img]').val();
					var classes		= $(this).attr('class');
					var categoria	= classes.split(' ').slice(0)[0];
					var scripts		= new Array();
					
					order = $('#lista-imagens.'+categoria).find('div#thumb').map(function(index, obj) {
						var item = $(obj);
						item.val(index + 1);
						scripts.push(item.children().attr('data-thumb-id') + '=' + (index + 1));
					});

					var message = '';
					for (i=0; i < order.length; i++) {
						message = message + order[i];
						message = message + ' ';
					}

					$.post('ajax-fotos-funcoes.php', { data: scripts, action: 'ordenar', tabela: tabela }, function(json) {
						if (json.status == 'sucesso') {
							$('.alert-success').html('').append('Imagens ordenadas com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
						} else {
							$('.alert-warning').html('').append('Desculpe, houve um erro interno! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
						}
					},'json');
				}
			}).disableSelection();
		});

		// LISTANDO THUMBS
		function listThumbnails(id, tabela, id_galeria, nome, categoria) {
			$('#lista-imagens.'+categoria).append('<div id="thumb" class="col-xs-6 col-sm-4 col-md-3 col-lg-2">'+
													'<div class="thumbnail" data-thumb-id="'+id+'" data-thumb-categoria="'+categoria+'">'+
														'<a href="'+HTTP+'uploads/imagens/800x600_'+nome+'" data-lightbox="'+categoria+'">'+
															'<img src="'+HTTP+'uploads/imagens/tb_'+nome+'" />'+
														'</a>'+
														'<div class="caption">'+
															'<div class="pull-left">'+
																// '<a href="editar-imagem.php?id='+id+'&idgal='+id_galeria+'&tabela='+tabela+'"><span class="glyphicon glyphicon-edit"></span></a>'+
																'<a class="ativar ativo"><span class="glyphicon glyphicon-ok"></span></a>'+
																'<a class="legenda desativo" data-toggle="modal" data-target="#modal-legenda"><span class="glyphicon glyphicon-comment"></span></a>'+
																'<a class="capa desativo"><span class="glyphicon glyphicon-star"></span></a>'+
																'<a class="del"><span class="glyphicon glyphicon-trash"></span></a>'+
															'</div>'+
															'<div class="pull-right">'+
																'<label><input class="checkbox" type="checkbox" name="imagens[]" value="'+id+'" ></label>'+
															'</div>'+
														'</div>'+
													'</div>'+
												'</div>');
		}

	});

	$(window).load(function(){});
})(window.jQuery);