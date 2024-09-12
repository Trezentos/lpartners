<?php
session_start();
require("../php/config.php");
require("../php/classes/Class.login.php");
require("php/functions.php");

$userClass = new Usuario();
$arMenu = array(
	'Home' => array(
		'show' => true,
		'icon' => 'home',
		'acesso'  => 'FULL',
		'arquivo' => 'index.php',
		'submenu' => NULL
	),

	'Páginas'  => array(
		'show' => true,
		'icon' => 'file',
		'acesso'  => 1,
		'arquivo' => 'list-paginas.php',
		'submenu' => NULL
	),

	'Publicidades' => array(
		'show' => true,
		'icon' => 'picture',
		'acesso'  => 3,
		'arquivo' => 'list-publicidades.php',
		'submenu' => NULL
	),

	'Produtos' => array(
		'show' => true,
		'icon' => 'briefcase',
		'acesso'  => 5,
		'arquivo' => 'list-produtos.php',
		'submenu' => NULL
	),

	'Blog' => array(
		'show' => true,
		'icon' => 'bullhorn',
		'acesso'  => 15,
		'arquivo' => 'list-noticias.php',
		'submenu' => NULL
	),

	'Parceiros' => array(
		'show' => true,
		'icon' => 'user',
		'acesso'  => 6,
		'arquivo' => 'list-parceiros.php',
		'submenu' => NULL
	),

	'Mercados' => array(
		'show' => true,
		'icon' => 'globe',
		'acesso'  => 7,
		'arquivo' => 'list-mercados.php',
		'submenu' => NULL
	),

	'Banners' => array(
		'show' => true,
		'icon' => 'picture',
		'acesso'  => 2,
		'arquivo' => 'list-slides.php',
		'submenu' => NULL
	),

	'Usuários' => array(
		'show' => true,
		'icon' => 'user',
		'acesso'  => 4,
		'arquivo' => 'list-usuarios.php',
		'submenu' => NULL
	)
	
);

$list_acess_file = array(
	'FULL' => array('index.php', 'ajax-limpa-string.php', 'ajax-endereco.php', 'ajax-cidades.php', 'ajax-fotos-funcoes.php', 'ajax-fotos-upload.php', 'sair.php'),
	1  => array('list-paginas.php' ,'form-paginas.php'),
	2  => array('list-slides.php', 'form-slide.php'),
	3  => array('list-publicidades.php', 'form-publicidades.php'),
	4  => array('list-usuarios.php' ,'form-usuarios.php'),
	5  => array('list-produtos.php', 'form-produtos.php', 'list-produtos-categorias.php', 'form-produtos-categorias.php'),
	6  => array('list-parceiros.php', 'form-parceiros.php'),
	7  => array('list-mercados.php', 'form-mercados.php'),
	15 => array('list-noticias.php', 'form-noticia.php', 'list-blog-categorias.php', 'form-blog-categorias.php'),
);

$javascript = array();
$style = array();

$javascript = array('bootstrap.js', 'jquery.tablesorter-pager.js', 'script.admin.js');
$style = array('css/bootstrap.min.css', 'css/style.css');

// if ( $userClass->usuarioLogado() === false ) {
// 	header("Location: login.php");
// 	exit;
// } else {
// 	$RequestedPermission = $userClass->acessoPagina();
// 	if ($RequestedPermission === true ) {
// 		// NADA
// 	} else {
// 		header("Location: index.php?erro=".base64_encode($RequestedPermission));
// 		exit;
// 	}
// }

$autor = $userClass->getId();
$acessoAutor = $userClass->getAcesso();
?>