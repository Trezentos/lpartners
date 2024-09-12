<?php
setlocale(LC_ALL, 'pt_BR.UTF8');

error_reporting (1);
//error_reporting (E_ALL);

if(stristr($_SERVER['DOCUMENT_ROOT'], 'public_html') === FALSE)
{
	$localhost = TRUE;
}
else
{
	$localhost = FALSE;
} 

	

//$localhost = FALSE;

define('LOCALHOST',$localhost);

define('HASH','7bnjth,./;p123%$%@fdxs');
define('SECURITY_HASH', md5(HASH.'esqueci minha senha'));

if(LOCALHOST) {

	/* DATABASE */
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_HOST','localhost');
	define('DB_NAME','lppartners');
	define('PREFIX','adm_');

	/* PATH */
	define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/lpartners/');
	define('HTTP','http://'.$_SERVER['HTTP_HOST'].'/lpartners/');
	define('SHIFT_NUM', 1);
} else {

	/* DATABASE */
	define('DB_USER','lpartners_site');
	define('DB_PASS','dwODgx(PU+$q');
	define('DB_HOST','localhost');
	define('DB_NAME','lpartners_site');
	define('PREFIX','adm_');

	/* PATH */
	define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/');
	define('HTTP','https://'.$_SERVER['HTTP_HOST'].'/');
	define('SHIFT_NUM', 0);

	/* ANALYTICS */
	define('ANALYTICS', '');
}



// ADMIN
define('ROOT_GESTOR',ROOT.'q-admin/');
define('HTTP_GESTOR',HTTP.'q-admin/');

// UPLOADS
define('HTTP_UPLOADS_IMG',HTTP.'uploads/imagens/');
define('ROOT_UPLOADS_IMG',ROOT.'uploads/imagens/');

// CURRICULOS
define('HTTP_CURRICULOS',HTTP.'uploads/curriculos/');
define('ROOT_CURRICULOS',ROOT.'uploads/curriculos/');



// CAMINHOS PADRÕES
define('TEMP',ROOT.'temp_file/');
define('PHP',ROOT.'php/');
define('TEMPLATE',ROOT.'template/');
define('EMAIL_TEMPLATES',ROOT.'php/envios/templates/');

define('ZERO_PAD','6');



// INFOS
$empresa    = 'LPartners';
$telefone_site = '47 3344.0000';
$dominio    = 'lpartners.net';
$homePages  = array('',' ','index','index.php','index.html','home','home.php','home.html');
$meses	    = array("JANEIRO","FEVEREIRO","MARÇO","ABRIL","MAIO","JUNHO","JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO");
$meses_abr  = array("JAN","FEV","MAR","ABR","MAI","JUN","JUL","AGO","SET","OUT","NOV","DEZ");
$meses_cap  = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

$language   = true;
$array_lang = array('pt','en','es');

$tables = array();

$tables['ACESSOS'] 		 		 = PREFIX.'acessos';
$tables['CIDADES']		 		 = PREFIX.'cidades';
$tables['PAGINAS'] 				 = PREFIX.'paginas';
$tables['USUARIOS'] 			 = PREFIX.'usuarios';
$tables['NOTICIAS'] 			 = PREFIX.'noticias';
$tables['NOTICIAS_IMG']			 = PREFIX.'noticias_imagens';
$tables['BLOG_CATEGORIAS']		 = PREFIX.'blog_categorias';
$tables['BANNERS']			 	 = PREFIX.'banners';

$tables['PRODUTOS'] 			 = PREFIX.'produtos';
$tables['PRODUTOS_IMG']			 = PREFIX.'produtos_imagens';
$tables['PRODUTOS_CATEGORIAS']	 = PREFIX.'produtos_categorias';

$tables['PUBLICIDADES']	 		 = PREFIX.'publicidades';
$tables['PARCEIROS']	 		 = PREFIX.'parceiros';

$tables['MERCADOS']	 		 	= PREFIX.'mercados';
$tables['MERCADOS_SEGMENTOS']	= PREFIX.'mercados_segmentos';


$javascript = array('modernizr.js', 'jquery-2.1.1.js', 'jquery-ui.min.js', 'main.js', 'jquery.cycle2.min.js', 'jquery.cycle2.carousel.min.js');
$style = array('css/normalize.css', 'css/bulma.css', 'css/font-awesome.min.css', 'css/style.css', 'css/jquery.fancybox.css');

$MOBILE = "";
$IPAD   = "";

require(PHP."functions.php");
require PHP."ezsql/ez_sql_core.php";
require PHP."ezsql/ez_sql_mysqli.php";


$db = new ezSQL_mysqli(DB_USER,DB_PASS,DB_NAME,DB_HOST);

$db->query("SET NAMES 'utf8'");
$db->query('SET character_set_connection=utf8');
$db->query('SET character_set_client=utf8');
$db->query('SET character_set_results=utf8');
?>