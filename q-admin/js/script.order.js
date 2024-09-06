$(document).ready(function(){	
	$('table tbody').sortable({
		axis: 'y',
		stop: function(event, ui) {
			
			var tabela = $('input[name=tabela]').val();

			var scripts = new Array();
			order = $(this).find('.ui-state-default').map(function(index, obj) {
				var input = $(obj);
				input.val(index + 1);
				scripts.push(input.attr('id') + '=' + (index + 1));
			});
			var message = '';
			for(i=0; i < order.length; i++){
				message = message + order[i];
				message = message + ' ';
			}
			
			$.post('ajax/ajax_save_order.php', {data:scripts, tabela: tabela}, function(rtn){
				$('.alert-success').html('').append('Ordenação realizada com sucesso! <button type="button" class="close" aria-hidden="true">&times;</button>').fadeIn();
			},'json');
		}
	});

	$('table tbody').disableSelection();
});