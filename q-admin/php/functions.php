<?php
// MENU
function geraMenu() {
	global $arMenu, $acessoAutor;
		
	$_html = array();
	foreach($arMenu as $title => $var) {
		if($var['show'] && in_array($var['acesso'],$acessoAutor) || $var['acesso']=='FULL') {
			$_html[] = '<li>';
			$_html[] = '<a href="'.($var['arquivo']?$var['arquivo']:'javascript:void(0)').'" '.($var['arquivo']?'':'class="dropdown"').'>';
			$_html[] =		'<span class="glyphicon glyphicon-'.$var['icon'].'"></span>'.$title.($var['arquivo']?'':' <b class="caret pull-right"></b>');
			$_html[] = '</a>';

			if($var['submenu']) {
				$_html[] = '<ul class="">';
				foreach($var['submenu'] as $submenu => $arquivo_submenu) $_html[] = '<li><a href="'.$arquivo_submenu.'">'.$submenu.'</a></li>';
				$_html[] = '</ul>';
			}
			
			$_html[] = '</li>';
		}
	}
	
	return implode("\n", $_html);
}

// HEADER
function get_header_gestor() {
	global $userClass;

	$_html[] = '<!DOCTYPE>';
	$_html[] = '<html>';
	$_html[] = '	<head>';
	$_html[] = '		<meta charset="utf-8" />';
	$_html[] = '		<meta http-equiv="X-UA-Compatible" content="IE=edge">';
	$_html[] = '		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
	$_html[] = '		<meta name="robots" content="noindex,nofollow" />';
	$_html[] = '		<title>Q-Admin | Administrador</title>';
	$_html[] = '		<link rel="icon" href="'.HTTP_GESTOR.'imagens/favicon.ico" type="image/x-icon">';
	$_html[] = '		<link rel="shortcut icon" type="image/x-icon" href="'.HTTP_GESTOR.'imagens/favicon.ico">';
	$_html[] = '		<script type="text/javascript"> var HTTP_GESTOR = \''.HTTP_GESTOR.'\'</script>';
	$_html[] = '		<script type="text/javascript"> var HTTP = \''.HTTP.'\'</script>';
	$_html[] = '		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">';
	$_html[] = 			style_enqueue('gestor','return');
	$_html[] = '		<!--[if lt IE 9]>';
	$_html[] = '		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>';
	$_html[] = '		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>';
	$_html[] = '		<![endif]-->';
	$_html[] = '		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>';
	$_html[] = '		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>';
	$_html[] = '	</head>';
	$_html[] = '	<body>';
	$_html[] = '		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">';
	$_html[] = '			<div class="container-fluid">';
	$_html[] = '				<div class="navbar-header">';
	$_html[] = '					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
	$_html[] = '						<span class="sr-only">Toggle navigation</span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '					</button>';
	$_html[] = '					<a class="navbar-brand" href="'.HTTP_GESTOR.'">Q-Admin | Administração</a>';
	$_html[] = '				</div>';
	$_html[] = '				<div class="navbar-collapse collapse">';
	//$_html[] = '					'.$userClass->getAutor();
	$_html[] = '					<ul class="nav navbar-nav navbar-right">';
	$_html[] = '						<li><a href="'.HTTP.'" target="_blank">Visualizar Site</a></li>';
	$_html[] = '						<li><a href="sair.php">Sair</a></li>';
	$_html[] = '					</ul>';
	$_html[] = '				</div>';
	$_html[] = '			</div>';
	$_html[] = '		</nav>';
	$_html[] = '		<div class="container-fluid">';
	$_html[] = '			<div class="row">';
	$_html[] = '				<aside id="sidebar" class="col-sm-3 col-md-2" role="sidebar">';
	$_html[] = '					<nav>';
	$_html[] = '						<ul class="nav nav-sidebar">';
	$_html[] = 								geraMenu();
	$_html[] = '						</ul>';
	$_html[] = '					</nav>';
	$_html[] = '					<footer>';
	$_html[] = '						<a title="QUAX"  target="_blank" href="http://www.quax.com.br"><b>QUAX</b></a> &copy; '.date("Y").'<br>Todos os Direitos Reservados.';
	$_html[] = '					</footer>';
	$_html[] = '				</aside>';
	$_html[] = '				<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">';
	
	
	echo implode("\n",$_html);
}

// FOOTER
function get_footer_gestor() {
	$_html[] = '				</div>'; // MAIN
	$_html[] = '			</div>'; // ROW
	$_html[] = '		</div>'; // CONTAINER
	//$_html[] = '		<div class="carregando" style="display:none"><span><img src="imagens/ajax-loader2.gif" alt="" /></span></div>';
	$_html[] = 			javascript_enqueue('gestor','return');
	$_html[] = '	</body>';
	$_html[] = '</html>';
	
	echo implode("\n",$_html);
}

// TITULO
function get_barra_header() {
	global $count, $_header, $_controles;

	$_html[] = '<h1 class="page-header"><span class="glyphicon glyphicon-'.$_header['icon'].'"></span>'.$_header['titulo'].'</h1>';

	$_html[] = NotifyMessage();
	$_html[] = NotiyMessageForm();
	
	echo implode("\n",$_html);
}

// MENSAGENS DE NOTIFICAÇÃO
function NotifyMessage() {
	global $alertSucess, $alertFail, $alertMessage;
	if($alertSucess==true) return '<div class="alert alert-success show"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-ok"></span> '.$alertMessage.'</div>';
	elseif($alertFail==true) return '<div class="alert alert-danger show"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-remove"></span> '.$alertMessage.'</div>';
}

function NotiyMessageForm() {
	global $errors;
	
	if(!empty($errors)) {
		$_html[] = '<div class="alert alert-danger show"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Campos Obrigatórios</strong><ul>';
		foreach ($errors as $error) $_html[] = "<li>$error</li>\n";
		$_html[] = '</ul></div>';
		
		return implode("\n",$_html);	
	}
}

// ÚLTIMO ACESSO
function get_last_acess($id, $data=true, $contador=true) {
	global $db, $tables;
	

	if($data && $id) {
		$query = $db->get_row("SELECT data_acesso FROM ".$tables['ACESSOS']." WHERE id_usuario='{$id}' LIMIT 1");
		if($query) {
			$data = explode(" ", $query->data_acesso);
		
			$_html[] = implode("/",array_reverse(explode("-",$data[0]))).' '.substr($data[1], 0, -3);
		}
	}
	
	if($contador && $id) {
		$query = $db->get_var("SELECT COUNT(id) FROM ".$tables['ACESSOS']." WHERE id_usuario='{$id}'");
		if($query>0) {
			if($data) $_html[] = '('.$query.')';
			else $_html[] = $query;
		}
	}
	
	if(count($_html)>0) return implode(" ", $_html);
	else return '-';
}

// THUMBS PADRÕES
function get_thumbs($id_galeria, $tabela, $local, $categoria=null) {
	global $db, $tables;

	$query = $db->get_results("SELECT * FROM ".$tables[strtoupper($tabela)]." WHERE id_galeria='{$id_galeria}'".($categoria != null ? " AND categoria='{$categoria}'" : false)." ORDER BY ordem ASC");
	
	if($query) {
		foreach($query as $rs) $_html[] = '<div id="thumb" class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
												<div class="thumbnail" data-thumb-id="'.$rs->id.'"'.($categoria != null ? ' data-thumb-categoria="'.$categoria.'"' : false).' data-thumb-id-galeria="'.$rs->id_galeria.'">
													<a href="'.$local.'800x600_'.$rs->arquivo.'" '.($rs->legenda ? 'data-title="'.$rs->legenda.'"' : false).' data-lightbox="'.($categoria != null ? $categoria : 'galeria').'">
														<img src="'.$local.'tb_'.$rs->arquivo.'" />
													</a>
													<div class="caption">
														<div class="pull-left">
															<a class="ativar'.($rs->ativo ? ' ativo' : ' desativo').'"><span class="glyphicon glyphicon-ok"></span></a>
															<a class="legenda'.($rs->legenda ? ' ativo' : ' desativo').'" data-toggle="modal" data-target="#modal-legenda"><span class="glyphicon glyphicon-comment"></span></a>
															<a class="capa'.($rs->capa ? ' ativo' : ' desativo').'"><span class="glyphicon glyphicon-star"></span></a>
															<a class="del"><span class="glyphicon glyphicon-trash"></span></a>
														</div>
														<div class="pull-right">
															<label><input class="checkbox" type="checkbox" name="imagens[]" value="'.$rs->id.'" ></label>
														</div>
													</div>
												</div>
											</div>';

		return implode("\n",$_html);
	}
}
?>