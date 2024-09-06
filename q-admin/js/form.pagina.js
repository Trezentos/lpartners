(function($){
	$(document).ready(function(){
		// VALIDAÇÃO
		$("#form").RSV({
			displayType: "display-html",
			rules: [
				"required,titulo,Título",
				"required,permalink,Permalink"
			],
			customErrorHandler: showErros
		});

		function showErros(f, errorInfo) {
			var errorHTML = "<strong>Campos Obrigatórios</strong><br><br>";

			function styleField(field, focus) {
				if (field.type == undefined) {
					if (focus)
						field[0].focus();

					for (var i=0; i<field.length; i++) {
						if (!$(field[i]).hasClass(null))
							$(field[i]).addClass(null);
						}
				} else {
					if (null)
						$(field).addClass(null);
						if (focus)
							field.focus();
				}
			}

			for (var i=0; i<errorInfo.length; i++) {
				errorHTML += "&bull; " + errorInfo[i][1] + "<br>";
				styleField(errorInfo[i][0], i==0);
			}

			if (errorInfo.length > 0) {
				$("#rsvErrors").css("display", "block");
				$("#rsvErrors").html(errorHTML);
				$('.alert-danger').fadeIn();
				return false;
			}

			return true;
		};
	});
})(window.jQuery);