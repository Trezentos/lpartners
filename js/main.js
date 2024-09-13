jQuery(document).ready(function($)
{
	var hash  = window.location.hash;

	//rolagem ao abrir a página de história da empresa - provisório
	

	$(window).scrollTop(1); //Scrolla 1px automáticamente para mostrar as divs

	if( $(window).width() > $(window).height() )
	{
		var orientacao = "LANDSCAPE";
	}else{
		var orientacao = "PORTRAIT";
	}


	function delay(functionCallBack, ms) {
	  if (ms === null || ms === undefined) {
	    ms = 500;
	  }
	  return setTimeout(functionCallBack, ms);
	}


	// RODA PELA PRIMEIRA VEZ PARA MOSTRAR O QUE JÃ ESTA VISIVEL
	$('.waypoint').each( function(i)
	{
	    var bottom_of_object = $(this).offset().top + ( $(this).outerHeight() * 0.60 );
	    var bottom_of_window = $(window).scrollTop() + $(window).height();
	    if( bottom_of_window > bottom_of_object )
	    {
	        $(this).addClass('animated');
	    }
	});



	if(PAGE=="home" && !IS_TABLET)
	{
		$(window).scroll(function() {
			if ( $(window).scrollTop() > 600 )
			{
				$('.lp_container_lateral').addClass('is-enabled');
			}
			else
			{
				$('.lp_container_lateral').removeClass('is-enabled');
			}
		});
	}
	



	/////////////////////////////////////////
	// MOSTRA/OCULTA O MENU FIXO NA ROLAGEM
	/////////////////////////////////////////

	// $(window).bind('scroll', function ()
	// {
	// 	if(!IS_MOBILE)
	// 	{
	// 		// FIXE MENU
	// 		if ( $(window).scrollTop() > 0 )
	// 		{
	// 			$('body').addClass("marginTop");
	// 			$('header').addClass("fixed");
	// 		}else{
	// 			$('body').removeClass("marginTop");
	// 			$('header').removeClass("fixed");
	// 		}

	// 		// SHOW TRACKING
	// 		if(PAGE=="home" && !IS_TABLET)
	// 		{
	// 			if ( $(window).scrollTop() > 600 )
	// 			{
	// 				$('.lp_container_lateral').addClass('is-enabled');
	// 			}else{
	// 				$('.lp_container_lateral').removeClass('is-enabled');
	// 			}
	// 		}
	// 	}

	// 	// if(!IS_MOBILE && !(IS_TABLET && orientacao=="PORTRAIT"))
	// 	// {
	// 	// 	if ( $(window).scrollTop() > 0 )
	// 	// 	{
	// 	// 		$('body').addClass("marginTop");
	// 	// 		$('header').addClass("fixed");
	// 	// 	}else{
	// 	// 		$('body').removeClass("marginTop");
	// 	// 		$('header').removeClass("fixed");
	// 	// 	}
	// 	// }


	// });

	$('.card-home-produtos').on('mouseover', function() {
		$(this).addClass('pork');
		if($('.card-home-produtos').eq(1).hasClass('pork')) {
			$('.card-home-produtos').eq(1).removeClass('pork');
		}
	});

	$('.card-home-produtos').on('mouseout', function() {
		$(this).removeClass('pork');
		$('.card-home-produtos').eq(1).addClass('pork');
	})



	$(window).scroll(function()
	{
		if(!IS_MOBILE)
		{
	        $('.waypoint').each( function(i)
			{
				var bottom_of_object = $(this).offset().top + ( $(this).outerHeight() * 0.70 );
			    var bottom_of_window = $(window).scrollTop() + $(window).height();
			    if( bottom_of_window > bottom_of_object )
			    {
			        $(this).addClass('animated');
			    }
			});
		}
	});

	$(window).scroll(function() {
		if($(window).scrollTop() > 120) {

			$('.menu_fixo').fadeIn(600);
			$('.menu_fixo').addClass('is-active');
		}
		else
		{
			$('.menu_fixo').fadeOut(100);
			$('.menu_fixo').removeClass('is-active');
		}

	});


	// MENU MOBILE
	$('.nav-toggle').click(function(e)
	{
		e.preventDefault();
		if($(this).hasClass("is-active"))
		{
			$('.nav-menu').animate({'opacity':'0'},500, function() {
			    $('.nav-toggle').removeClass('is-active');
				$('.nav-menu').removeClass('is-active');
			});
		}else{
			$(this).addClass('is-active');
			$('.nav-menu').addClass('is-active');
			$('.nav-menu').animate({'opacity':'1'},500);
		}
	});


	if(IS_MOBILE || (IS_TABLET && orientacao=="PORTRAIT"))
	{
		// MOBILE - SUBMENU
		$('header .nav-menu li a.produtos').click(function(event) {
			event.preventDefault();

			if($(this).hasClass("is-active-sub"))
			{
				$('header .nav-menu li .sub-produtos').css({'height':'0'});
				$(this).removeClass('is-active-sub');
			}else{
				$('header .nav-menu li .sub-produtos').css({'height':'272'});
				$(this).addClass('is-active-sub');
			}
		});

		$('header .nav-menu li a.servicos').click(function(event) {
			event.preventDefault();

			if($(this).hasClass("is-active-sub"))
			{
				$('header .nav-menu li .sub-servicos').css({'height':'0'});
				$(this).removeClass('is-active-sub');
			}else{
				$('header .nav-menu li .sub-servicos').css({'height':'230'});
				$(this).addClass('is-active-sub');
			}
		});

		$('header .nav-menu li a.empresa').click(function(event) {
			event.preventDefault();
			if($(this).hasClass("is-active-sub"))
			{
				$('header .nav-menu li .sub-empresa').css({'height':'0'});
				$(this).removeClass('is-active-sub');
			}else{
				$('header .nav-menu li .sub-empresa').css({'height':'90'});
				$(this).addClass('is-active-sub');
			}
		});
	}



	if(IS_TABLET && orientacao=="PORTRAIT")
	{
		//FAZ O SCROLL DE 1PX PARA INICIAR AS ANIMACOES QUANDO A PAGINA FOR ABERTA NO MEIO DA PAG
		$('html, body').animate({scrollTop: $(window).scrollTop() + 1}, 1, function() {
			$('html, body').animate({scrollTop: $(window).scrollTop() - 1}, 1);
		});
	}



	// OPEN E CLOSE L TRACKING
	$('.lp_container .lp_top').click(function(e)
	{
		if( !$('.lp_container').hasClass("is-active") )
		{
			$('.lp_container').addClass('is-active');
		}else{
			$('.lp_container').removeClass('is-active');
		}
	});


	// OPEN E CLOSE L TRACKING
	$('.lp_container_lateral .lp_top').click(function(e)
	{
		if( !$('.lp_container_lateral').hasClass("is-active") )
		{
			$('.lp_container_lateral').addClass('is-active');
		}else{
			$('.lp_container_lateral').removeClass('is-active');
		}
	});




	// Contato - Skype
	$('.pg-layer-head').click(function() {
		if(!$('.pg-layer-contact').hasClass('is-active')) {
			$('.pg-layer-contact').addClass('is-active');
		}
		else
		{
			$('.pg-layer-contact').removeClass('is-active');
			$('.pg-list-info').addClass('pg-hidden');
			$('.arrow-down').addClass('pg-hidden');
			$('.arrow-right').removeClass('pg-hidden');
		}
	});

	$('.pg-list-item').click(function() {
		
		var id = $(this).attr('id');
		if($(this).children('.arrow-down').hasClass('pg-hidden')) {
			$(this).children('.arrow-down').removeClass('pg-hidden');
			$(this).children('.arrow-right').addClass('pg-hidden');
			
			// $('.pg-list-info').eq(id).siblings('.pg-list-info').addClass('pg-hidden');
			$('.pg-list-info').eq(id).removeClass('pg-hidden');

		}
		else 
		{
			$(this).children('.arrow-down').addClass('pg-hidden');
			$(this).children('.arrow-right').removeClass('pg-hidden');
			$('.pg-list-info').eq(id).addClass('pg-hidden');	
		}

		
	});



	


	/* Valida email */
	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}


	// SELECT ESTADO => CIDADE
	$('#estado').change(function(){
		var valueState = $(this).val();
		$.ajax({
			type: "POST",
			url: HTTP+"php/ajax-busca.php",
			data: "q=estado&estado="+valueState,
			beforeSend: function() {
				$("#carregando").show();
				$("#cidade").empty();
				$("#cidade").html('<option>Carregando, aguarde...</option>');
			},
			success: function(txt) {
				$("#carregando").hide();
				$("#cidade").empty();
				$("#cidade").html(txt);
			},
			error: function(txt) {
				$("#carregando").hide();
				$("#cidade").html('<option value="">SELECIONE</option>');
				alert('Desculpe, houve um erro interno.');
			}
		});
	});



	// SELECT BRASIL SETOR / CONTATO
	$('#select-brasil').change(function(){
		
		switch( $(this).val() ) {
		    case "1":
		    	// Diretor Comercial
		        $(".brasil #nome-setor").html('Luciano Colonetti');
				$(".brasil #email-setor").html('<a href="mailto:luciano@lpartners.net">luciano@lpartners.net</a>');
		        $(".brasil #mobile-setor").html('');
				// $(".brasil #skype-setor").html('');
				$(".brasil .skype-button").attr('href', 'skype:');
		        break;

		    case "2":
		    	// Gerente de compras
				$(".brasil #nome-setor").html('Rafael Andreas Guenther');
				$(".brasil #email-setor").html('<a href="mailto:rafael@lpartners.net">rafael@lpartners.net</a>');
				$(".brasil #mobile-setor").html('+55 (47) 99963 0675');
				// $(".brasil #skype-setor").html('rafael.lpartners');
				$(".brasil .skype-button").attr('href', 'skype:rafael.lpartners');
				break;

		    case "3":
		        // Vendas - Africa e Caribe
		        $(".brasil #nome-setor").html('Natalia Colonetti Lima');
				$(".brasil #email-setor").html('<a href="mailto:natalia@lpartners.net">natalia@lpartners.net</a>');
		        $(".brasil #mobile-setor").html('+55 (48) 99673 9838');
		        // $(".brasil #skype-setor").html('natalia@lpartners.net');
				$(".brasil .skype-button").attr('href', 'skype:natalia.lpartners');
				break;
				
			case "4":
				// Coordenadora Administrativa
				$(".brasil #nome-setor").html('Carolina Leticia Michelon');
				$(".brasil #email-setor").html('<a href="mailto:carolina@lpartners.net">carolina@lpartners.net</a>');
				// $(".brasil #mobile-setor").html('+55 (47) 99907 6943');
				// $(".brasil #skype-setor").html('araceli.lpartners');
				$(".brasil .skype-button").attr('href', 'skype:');
				break;
		        
		    case "5":
		        // Logistics and Documents Coordinator
		        $(".brasil #nome-setor").html('Ocemar Bernardes Junior');
				$(".brasil #email-setor").html('<a href="mailto:ocemar@lpartners.net">ocemar@lpartners.net</a>');
		        $(".brasil #mobile-setor").html('');
		        // $(".brasil #skype-setor").html('ocemar.lpartners');
				$(".brasil .skype-button").attr('href', 'skype:ocemar.lpartners');
		        break;

		    case "6":
		        // Financial Controller + Logistics - Asia
		        $(".brasil #nome-setor").html('Samuel Fillipe Goncalves');
				$(".brasil #email-setor").html('<a href="mailto:samuel@lpartners.net">samuel@lpartners.net</a>');
		        $(".brasil #mobile-setor").html('+55 (47) 99992 4245');
		        // $(".brasil #skype-setor").html('samuel.lpartners');
				$(".brasil .skype-button").attr('href', 'skype:samuel.lpartners');
		        break;

		    case "7":
		        // Vendas - América do Sul
		        $(".brasil #nome-setor").html('Márcia Daltoé');
				$(".brasil #email-setor").html('<a href="mailto:marcia@lpartners.net">marcia@lpartners.net</a>');
		        $(".brasil #mobile-setor").html('+55 (47) 3046 0506');
				$(".brasil .skype-button").attr('href', 'skype:mdaltoe');
		        break;

		    // case "7":
		    //     // International Logistics - Booking/Sea Freight
		    //     $(".brasil #nome-setor").html('Samuel Fillipe Goncalves');
			// 	$(".brasil #email-setor").html('samuel@lpartners.net');
		    //     $(".brasil #mobile-setor").html('+55 (47) 99992 4245');
		    //     $(".brasil #skype-setor").html('samuel.lpartners');
			// 	$(".brasil .skype-button").attr('data-contact-id', 'samuel.lpartners');
		    //     break;

		    // case "8":
		    //     // Logistics - Africa, Russia, CIS and East European
		    //     $(".brasil #nome-setor").html('Fabricio Sasse');
			// 	$(".brasil #email-setor").html('fabricio@lpartners.net');
		    //     $(".brasil #mobile-setor").html('');
		    //     $(".brasil #skype-setor").html('fabricio.lpartners');
			// 	$(".brasil .skype-button").attr('data-contact-id', 'fabricio.lpartners');
		    //     break;

		    // case "9":
		    //     // Logistics and Documents - Middle East, America and Caribbean
		    //     $(".brasil #nome-setor").html('Mariana Maestri Becker');
			// 	$(".brasil #email-setor").html('mariana@lpartners.net');
		    //     $(".brasil #mobile-setor").html('');
		    //     $(".brasil #skype-setor").html('mariana@lpartners.net');
			// 	$(".brasil .skype-button").attr('data-contact-id', 'mariana.lpartners');
		    //     break;

		    // case "10":
		    //     // Documents - Africa, Russia, CIS, East European and Asia
		    //     $(".brasil #nome-setor").html('Daiane Dornelles');
			// 	$(".brasil #email-setor").html('daiane@lpartners.net');
		    //     $(".brasil #mobile-setor").html('');
			// 	$(".brasil #skype-setor").html('daiane@lpartners.net');
			// 	$(".brasil .skype-button").attr('data-contact-id', 'daiane.lpartners');
		    //     break;

		    default:
		        //$("#nome-setor").html('');
		}

	});




	// SELECT DUBAI SETOR / CONTATO
	$('#select-dubai').change(function(){
		
		$(".dubai #setores-complemento").html("");

		switch( $(this).val() ) {
		    case "21":
		    	// Diretor Geral
		        $(".dubai #nome-setor").html('Luiz Pedro Bertuol');
		        $(".dubai #mobile-setor").html('');
				// $(".dubai #skype-setor").html(' ');
				$(".dubai #email-setor").html('<a href="mailto:lpartners@lpartners.net">lpartners@lpartners.net</a>');
				// $(".hongkong .skype-button").attr('href', 'skype:luizbertuol@lpartners.net');
		        break;

		    case "22":
				// Vendas - África e Oriente Médio  // DESABILITADO
				// $(".dubai #nome-setor").html('Fernando F. Estillac Gomez');
		  		// $(".dubai #email-setor").html('<a href="mailto:fernando@lpartners.net">fernando@lpartners.net</a>');
		  		// $(".dubai #mobile-setor").html('+971 50 644 3190');
				// $(".dubai #skype-setor").html('fernando@lpartners.net');
				// $(".dubai .skype-button").attr('href', 'skype:live:fernando_11327');
		        break;

		    case "23":
		        // Vendas - América do Sul e Cingapura
				$(".dubai #nome-setor").html('Cristiane Gonçalves');
		        $(".dubai #email-setor").html('<a href="mailto:cristiane@lpartners.net">cristiane@lpartners.net</a>');
		        $(".dubai #mobile-setor").html('');
				// $(".dubai #skype-setor").html('cristiane.lpartners');
				$(".dubai .skype-button").attr('href', 'skype:cristiane.lpartners');
		        break;

		    case "24":
		        // Commercial - Russia and Singapore
		        $(".dubai #nome-setor").html('Gustavo Ribeiro Brandao');
		        $(".dubai #email-setor").html('<a href="mailto:gustavo@lpartners.net">gustavo@lpartners.net</a>');
		        $(".dubai #mobile-setor").html('+971 56 422 1838');
				// $(".dubai #skype-setor").html('gustavo.lpartners');
				$(".dubai .skype-button").attr('href', 'skype:gustavo.lpartners');
		        break;
		        
		    case "25":
		        // Commercial - Middle East and Africa
		        $(".dubai #nome-setor").html('Fernando F. Estillac Gomez');
		        $(".dubai #email-setor").html('fernando@lpartners.net');
		        $(".dubai #mobile-setor").html('+971 50 644 3190');
				// $(".dubai #skype-setor").html('<div class="pg-skype><a class="btn-skype" href="skype:fernando11"><i class="fa fa-skype" aria-hidden="true"></i> Skype directly</a></div>"');
				$(".dubai .skype-button").attr('href', 'skype:fernando_11327');
		        break;

		    case "26":
		        // Financial Dept.
		        $(".dubai #nome-setor").html('Cristiane Piaseski');
		        $(".dubai #email-setor").html('<a href="mailto:cristianepiaseski@lpartners.net">cristianepiaseski@lpartners.net</a>');
		        $(".dubai #mobile-setor").html('');
				// $(".dubai #skype-setor").html('cris.lpartners');
				$(".dubai .skype-button").attr('href', 'cris.lpartners');

		        $(".dubai #setores-complemento").append('<br><strong id="nome-setor">Zenaide Gamba</strong><br>');
				$(".dubai #setores-complemento").append('<i class="fa fa-phone" aria-hidden="true"></i> <span id="email-setor">E-mail: zenaide@lpartners.net</span><br>');
				$(".dubai #setores-complemento").append('<i class="fa fa-skype" aria-hidden="true"></i> <span id="skype-setor">Skype: zenaide@lpartners.net</span>');

		        break;

		    default:
		        //$("#nome-setor").html('');
		}


		

	});




	// SELECT HONG KONG SETOR / CONTATO
	$('#select-hongkong').change(function(){

		$(".hongkong #setores-complemento").html("");

		switch( $(this).val() ) {
		    case "31":
		    	// General Director
		        $(".hongkong #nome-setor").html('Queenie Kwong');
		        $(".hongkong #email-setor").html('<a href="mailto:queenie@lpartners.net">queenie@lpartners.net</a>');
		        $(".hongkong #mobile-setor").html('+852 6141 9461');
				$(".hongkong #skype-setor").html('queenie.lpartners');
				$(".hongkong .skype-button").attr('href', 'skype:queenie.lpartners');
		        break;

				// $(".hongkong #setores-complemento").append('<br><strong id="nome-setor">Garfield Lee</strong><br>');
				// $(".hongkong #setores-complemento").append('<i class="fa fa-mail" aria-hidden="true"></i> <span id="email-setor">E-mail: garfield@lpartners.net</span><br>');
				// $(".hongkong #setores-complemento").append('<a href="skype:garfield.lpartners" class="skype-button rectangle textonly"><i class="fa fa-skype" aria-hidden="true"></i> <span id="skype-setor">Skype: garfield@lpartners.net</span></a>');
		
		    case "32":
		    	// Commercial Director
		        $(".hongkong #nome-setor").html('Garfield Lee');
		        $(".hongkong #email-setor").html('<a href="mailto:garfield@lpartners.net">garfield@lpartners.net</a>');
		        $(".hongkong #mobile-setor").html('+852 9456 1203');
				$(".hongkong #skype-setor").html('garfield@lpartners.net');
				$(".hongkong .skype-button").attr('href', 'skype:c5a1525e887c8d03');
				break;
		        //$("#nome-setor").html('');
		}


		//luciano colonetti
		// $(".dubai #nome-setor").html('Luciano Colonetti');
		// $(".dubai #email-setor").html('luciano@lpartners.net');
		
		// $(".dubai #mobile-setor").html('');
		// $(".dubai #skype-setor").html('luciano@lpartners.net');
		// $(".dubai .skype-button").attr('data-contact-id', 'luciano.lpartners');
		// break;

		//Rafaek Andreas Guenther
		// $(".brasil #nome-setor").html('Rafael Andreas Guenther');
		// $(".brasil #email-setor").html('rafael@lpartners.net');
		// $(".brasil #mobile-setor").html('+55 (47) 99963 0675');
		// $(".brasil #skype-setor").html('rafael.lpartners');
		// break;
		


		// $(".brasil #nome-setor").html('Ana Ligia Hoemke Winkelhaus');
		// $(".brasil #email-setor").html('analigia@lpartners.net');
		// $(".brasil #mobile-setor").html('+55 (47) 99110 1838');
		// $(".brasil #skype-setor").html('analigia.lpartners');
		// $(".brasil .skype-button").attr('data-contact-id', 'analigia.lpartners');


		// $(".brasil #nome-setor").html('Carolina Leticia Michelon');
		// $(".brasil #email-setor").html('carolina@lpartners.net');
		// $(".brasil #mobile-setor").html('');
		// $(".brasil #skype-setor").html('carolina.lpartners');
		// $(".brasil .skype-button").attr('data-contact-id', 'carolina.lpartners');
		// break;



	});
	
	// if(window.location.pathname == '/clientes/lpartners/historia/pt' || window.location.pathname == '/clientes/lpartners/historia/en' || window.location.pathname == '/clientes/lpartners/historia/es'){
	// 	var target = $('#primeiro-passo').offset().top;
	// 	console.log('entrou aqui rapax');
	// 	$('html, body').animate({
	// 		scrollTop: target - 100
	// 	}, 500);

	// });

	if(PAGE == 'historia') {
		let target = $('#primeiro_passo').offset().top;
		
		if(IS_TABLET && orientacao=="PORTRAIT") {
			setTimeout(function() {
				$('html, body').animate({
					scrollTop: target - 542,
				
				}, 2000);
			}, 1000);		
		}
		else {

			$('html, body').animate({
				scrollTop: target - 600,
			
			}, 2000);
		}
	}

	

});








function trackme() {
	if ( $(".lp_container #company").val()==""){

		alert("Selecione uma Empresa");
		$(".lp_container #company").focus();
		return false;
	}
	if ( $(".lp_container #trackid").val()=="" ){

		alert("Digite o número do AWB ou Container");
		$(".lp_container #trackid").focus();
		return false;
	}

    var url = $(".lp_container #company").val();
    url = url.replace('[trackcode]', $(".lp_container #trackid").val() );
    window.open(url);
    return false;
}


function trackmeLateral() {
	if ( $(".lp_container_lateral #company").val()==""){

		alert("Selecione uma Empresa");
		$(".lp_container_lateral #company").focus();
		return false;
	}
	if ( $(".lp_container_lateral #trackid").val()=="" ){

		alert("Digite o número do AWB ou Container");
		$(".lp_container_lateral #trackid").focus();
		return false;
	}

    var url = $(".lp_container_lateral #company").val();
    url = url.replace('[trackcode]', $(".lp_container_lateral #trackid").val() );
    window.open(url);
    return false;
}

