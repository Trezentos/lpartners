<?php
// if ( $_SERVER['HTTPS'] != 'on') {
//     $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     header('HTTP/1.1 301 Moved Permanently');
//     header("Location: $redirect_url");
//     exit();
// }
function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}


require('php/config.php');
require(PHP.'language.php');

$modrewrite = returnFriendyURL();

//Lang {
if($language) {
	$lang_nav = limpaString(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
	$lang_cliente = limpaString(end($modrewrite));
	$lang_cookie = (!empty($_COOKIE['lang_website'])?limpaString($_COOKIE['lang_website']):false);

	if(in_array($lang_cliente,$array_lang)) $lang = $lang_cliente;
	elseif(strlen($lang_cookie)>0 && in_array($lang_cookie,$array_lang)) $lang = $lang_cookie;
	elseif(in_array($lang_nav,$array_lang)) $lang = $lang_nav;
	else $lang = reset($array_lang);

	if($lang_cookie||$lang_cookie!=$lang) setcookie ('lang_website', $lang, time() + (60*60*24));
	if(in_array(end($modrewrite),$array_lang)) array_pop($modrewrite);
} else $lang = 'pt';
//}

$page_first = clean_string(urldecode(reset($modrewrite)));
$page = end($modrewrite);
$pageSearch = (empty($page)?'home':(in_array($page,$homePages)?'home':clean_string(urldecode($page))));
$page = $db->get_row("SELECT * FROM ".$tables['PAGINAS']." WHERE permalink='{$page_first}'");
if($page && $db->num_rows) $returnURL = array('codigo'=>200,'pagina'=>$page);
else {
	$page = $db->get_row("SELECT * FROM ".$tables['PAGINAS']." WHERE permalink='{$pageSearch}'");
	if($page && $db->num_rows) $returnURL = array('codigo'=>200,'pagina'=>$page);
	else $returnURL = array('codigo'=>404,'pagina'=>$pageSearch);
}

if($pageSearch=='home' && $returnURL['codigo']!=404) define('ISHOME',true);
else define('ISHOME',false);

if(is_array($returnURL)&&count($returnURL>0))
{
	switch($returnURL['codigo']) {
		case '200':
			$pagina = $returnURL['pagina'];
			$titulo = (!ISHOME?$pagina->titulo.' - '.$empresa:$empresa);
			$permalink = $pagina->permalink;
			$conteudo  = $pagina->conteudo;
			//$keywords = $pagina->keywords;
			$keywords  = "LPartners Importação Exportação Logística";
			//$description = $pagina->description;
			$description = "A LPartners atua na exportação de carnes congeladas (bovina, suina e aves) para mais de 50 países.";

			if(strlen($pagina->arquivo)>0) require(TEMPLATE.$pagina->arquivo);
			else {
				get_header();
				echo $conteudo;
				get_footer();
			}
		break;

		case '302':
			//Header
			//[endereco_url] => http://www.google.com.br/pt-br
		break;

		case '404':
			header("HTTP/1.1 404 Not Found");
			header("Status: 404 Not Found");
			$pagina = $returnURL['pagina'];
			require(TEMPLATE.'404.php');
		break;
	}
} else trigger_error("Check your system settings", E_USER_ERROR);
?>