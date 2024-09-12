<?php
function validElement($element) {
    return strlen($element) > 0;
}

function removeBlankElement($array) {
	return array_values(array_filter($array, "validElement"));
}

function returnFriendyURL() {
	$modrewrite = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
	$modrewrite = removeBlankElement($modrewrite);

	for ($i = 0; $i < SHIFT_NUM; $i++) {
		array_shift($modrewrite);
	}

	return $modrewrite;
}

function limpaString($string) {
	$valid_chars_regex = 'a-zA-Z0-9';
	return preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', " ", $string);
}

function CurrentPageURL() {
	$pageURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	return $pageURL;
}

function script_name() {
	$script_name = explode('/',$_SERVER['REQUEST_URI']);
	if(count($script_name)>0) return end($script_name);
	else return $script_name;
}

function javascript_enqueue($location='home',$return='echo') {
	global $javascript;
	foreach($javascript as $js) $_html[] = '<script src="'.($location=='home'?HTTP:HTTP_GESTOR).'js/'.$js.'"></script>';
	if($return=='return') return implode("\n",$_html);
	else echo "\n".implode("\n",$_html);
}

function add_javascript($array) {
	global $javascript;
	foreach($array as $file) if(!in_array($file,$javascript)) array_push($javascript, $file);
}

function style_enqueue($location='home',$return='echo') {
	global $style;
	foreach($style as $css) $_html[] = '<link rel="stylesheet" href="'.($location=='home'?HTTP:HTTP_GESTOR).$css.'" type="text/css" />';
	if($return=='return') return implode("\n",$_html);
	else echo implode("\n",$_html);
}

function add_style($array) {
	global $style;
	foreach($array as $file) if(!in_array($file,$style)) array_push($style, $file);
}

function clean_string($str, $replace=array(), $delimiter='-') {
	if(!empty($replace)) $str = str_replace((array)$replace, ' ', $str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\ \-\.]/", '', $clean);
	//$clean = preg_replace("/[^a-zA-Z0-9]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}

function get_templates($select=NULL) {
	$array_ignore_file = array();
	foreach(glob(TEMPLATE.'*.php') as $file) {
		$info = pathinfo($file);
		if(!in_array($info['filename'],$array_ignore_file)) $option_list[] = '<option value="'.$info['basename'].'" '.($info['basename']==$select?'selected':false).'>'.$info['filename']."</option>";
	}
	echo implode("\n",$option_list);
}

function get_pages($select=array()) {
	global $db,$tables;
	$query = $db->get_results("SELECT * FROM ".$tables['PAGINAS']);
	foreach($query as $page) $option_list[] = '<option value="'.$page->id.'" '.(in_array($page->id,$select)?'selected':false).'>'.$page->titulo."</option>";
	echo implode("\n",$option_list);
}


function get_option_number($selected=NULL,$number=10, $zero=0) {
		for($i=$zero;$i<=$number;$i++) echo '<option value="'.$i.'" '.($selected!=NULL&&$i==$selected?'selected':NULL).'>'.$i.'</option>';
}

function printr($string) {
	echo '<pre>';
	print_r($string);
	echo '</pre>';
}

function get_size_in_byte($size) {
	$unit = strtoupper(substr($size, -2));
	$multiplier = ($unit == 'MB' ? 1048576 : ($unit == 'KB' ? 1024 : ($unit == 'GB' ? 1073741824 : 1)));
	$only_size = str_replace($unit, '', strtoupper($size));
	return $only_size*$multiplier;
}

function upload($upload_name,$save_path,$max_file_size,$whitelist=false,$blacklist=false,$overwrite,$rename='md5') {
	// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) return array('false','POST exceeded maximum allowed size.');
	$max_file_size_in_bytes = get_size_in_byte($max_file_size);

	// Other variables
	$MAX_FILENAME_LENGTH = 260;
	$uploadErrors = array(
        0=>'There is no error, the file uploaded with success',
        1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2=>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3=>'The uploaded file was only partially uploaded',
        4=>'Upload não efetuado',
        6=>'Pasta temporaria não encontrada'
	);

	// Validate the upload
	if (!isset($_FILES[$upload_name]))
		return array('false','No upload found in \$_FILES for ' . $upload_name);
	else if (isset($_FILES[$upload_name]['error']) && $_FILES[$upload_name]['error'] != 0)
		return array('false',$uploadErrors[$_FILES[$upload_name]['error']]);
	else if (!isset($_FILES[$upload_name]['tmp_name']) || !@is_uploaded_file($_FILES[$upload_name]['tmp_name']))
		return array('false','Upload inválido');
	else if (!isset($_FILES[$upload_name]['name']))
		return array('false','Arquivo inválido (noname).');

	// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]['tmp_name']);
	if (!$file_size || $file_size > $max_file_size_in_bytes) return array('false','Tamanho ultrapassado ('.strtoupper($max_file_size).')');
	if ($file_size <= 0) return array('false','Arquivo inválido (0 byte)');

	// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = strtolower(basename($_FILES[$upload_name]['name']));

	// Rename the file to be save
	if($rename) {
		switch($rename) {
			case 'md5':
				$info =  pathinfo($file_name);
				$file_name = strtolower(md5($file_name. time()).'.'.$info['extension']);
			break;
			default:
			$info =  pathinfo($file_name);
			$file_name = strtolower($rename.'.'.$info['extension']);
		}
	}

	// Validate file name (for our purposes we'll just remove invalid characters)
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) return array('false','Nome inválido');

	// Validate that we won't over-write an existing file
	if(!$overwrite) if(file_exists($save_path . $file_name)) return array('false','Este nome já esta sendo usado');

	// Validate file extension
	if($whitelist) if(!in_array(end(explode('.', $file_name)), $whitelist)) return array('false','Extensão inválida');
	if($blacklist) if(in_array(end(explode('.', $file_name)), $backlist)) return array('false','Extensão inválida');

	// Verify! Upload the file
	if(!move_uploaded_file($_FILES[$upload_name]['tmp_name'], $save_path.$file_name)) return array('false','Não foi possível fazer o upload.');
	else return array((boolean)true,$file_name,$file_size);
	exit(0);
}

function uniquid($num=10) {
	return substr(md5(uniqid().time()),0,$num);
}

function mt_uniquid() {
	return mt_rand(100000,999999);
}

function uniquid_num() {
	$string = (int) substr(substr(str_replace('.','',microtime()*rand(1,999999)),rand(0,5),10)*rand(1,10),0,5);
	if($string<5) uniquid_num();
	else return $string;
}

function br2nl($string,$ql='\n'){
	return preg_replace('/\<br(\s*)?\/?\>/i', $ql, $string);
}

function timerPicker($time=NULL) {

	list($dHora,$dMinuto) = explode(":",$time);

	for($hora=0;$hora<24;$hora++) $option_hora[] = '<option value="'.str_pad($hora, 2, "0", STR_PAD_LEFT).'" '.($dHora==$hora?'selected':'').'>'.str_pad($hora, 2, "0", STR_PAD_LEFT).'</option>';
	for($min=0;$min<60;$min++) $option_min[] = '<option value="'.str_pad($min, 2, "0", STR_PAD_LEFT).'" '.($dMinuto==$min?'selected':'').'>'.str_pad($min, 2, "0", STR_PAD_LEFT).'</option>';

	echo '<select name="hora" style="width:50px">'.implode("\n",$option_hora).'</select>:<select name="minuto" style="width:50px">'.implode("\n",$option_min).'</select>';
}

function get_youtube_code($urlx) {
	$url = $urlx.'&';
	$pattern = '/v=(.+?)&+/';
	preg_match($pattern, $url, $matches);
	if($matches[1]) return ($matches[1]);
	else return $urlx;
}

function get_info_vimeo($url_video) {
	//preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url_video, $matches);
	preg_match('/vimeo.com\/(\d+)$/', $url_video, $matches);
	if (count($matches) != 0) {
		$vimeo_id = $matches[1];
		$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$vimeo_id.php"));
		return array('id_video'=>$vimeo_id, 'thumb'=>$hash[0]['thumbnail_medium']);
	} else return false;
}

function video_image($url){
	$image_url = parse_url($url);
	if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
		$array = explode("&", $image_url['query']);
		return array('servidor'=>'youtube','codigo'=>substr($array[0], 2), 'imagem'=>"https://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg");
	} else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
		$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
		return array('servidor'=>'vimeo','codigo'=>substr($image_url['path'], 1),'imagem'=>$hash[0]["thumbnail_large"]);
	}
}

function array_keys_exists($array,$keys) {
    foreach($keys as $k) {
        if(!isset($array[$k])) {
        return false;
        }
    }
    return true;
}

function escape($string) {
	return mysql_escape_string(stripslashes($string));
}

function valid_url($url) {
	if (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) return $url;
	else return 'https://'.$url;
}

function SendMail($array_vars, $array_imagens, $array_config, $array_anexo, $debug=false) {

	require_once(PHP."phpmailer/class.phpmailer.php");
	require_once(PHP."classes/Class.template.php");

	$tpl = new template;
	if($array_vars) foreach($array_vars as $campo => $value) $tpl->addvar($campo, $value);
	$body = $tpl->display($array_config['template']);

	$mail = new PHPMailer();

	$mail->IsHTML(true);

	if($array_config['is_smtp']) {
		$mail->IsSMTP();
		$mail->Host = $array_config['smtp_host'];
		$mail->SMTPAuth = true;
		$mail->Username = $array_config['smtp_login'];
		$mail->Password = $array_config['smtp_password'];
	} else {
		$mail->IsMAIL();
	}

	$mail->CharSet = 'utf-8';

	$mail->From = $array_config["email_from"];
	$mail->Sender = $array_config["email_from"];
	$mail->FromName = $array_config["nome_from"];

	if(is_array($array_config['email_to'])) foreach($array_config['email_to'] as $emailTo) $mail->AddAddress($emailTo, $array_config['nome_to']);
	else $mail->AddAddress($array_config['email_to'], $array_config['nome_to']);

	$mail->Subject  = $array_config['assunto'];
	$mail->Body     = $body;

	// Anexo
	$mail->AddAttachment($array_anexo);

	if($debug) printr($mail);

	if($mail->Send()) {
		$mail->ClearAddresses();
		$mail->ClearAttachments();
		return true;
	} else {
		$mail->ClearAddresses();
		$mail->ClearAttachments();
		return false;
	}
}

function SendMailAdm($assunto, $mensagem, $debug=false) {
	require_once(PHP."phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host     = "mail.engepesca.com.br";
	$mail->SMTPAuth = true;
	$mail->Username = 'envio@engepesca.com.br';
	$mail->Password = 'eng102030';

	$mail->From = "envio@engepesca.com.br";
	$mail->Sender = "envio@engepesca.com.br";
	$mail->FromName = "Site - ENGEPESCA";
	//$mail->AddReplyTo($_POST["email"], $_POST['nome']);

	$destino = "atendimento@engepesca.com.br";

	$mail->AddAddress($destino);
	//$mail->AddBCC('willian@quax.com.br', 'Quax'); // Cópia Oculta

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = "<div style=\"width: 600px; border: 3px solid #DDD; padding: 8px;\">
				<div align=\"center\" style=\"color: #BBB; font-size: 11px;\">Este é um e-mail automático, não é necessário respondê-lo.</div>
				<br>
				<img src='".HTTP."img/topo_email.jpg'><br/><br/>" . $mensagem
			."</div>";

	$mail->Body = $body;

	// Envia o e-mail
	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
}

function SendMailCliente($email, $assunto, $mensagem, $debug=false) {
	require_once(PHP."phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "mail.engepesca.com.br";
	$mail->SMTPAuth = true;
	$mail->Username = 'envio@engepesca.com.br';
	$mail->Password = 'eng102030';

	$mail->From = "envio@engepesca.com.br";
	$mail->Sender = "envio@engepesca.com.br";
	$mail->FromName = "ENGEPESCA";
	//$mail->AddReplyTo($_POST["email"], $_POST['nome']);

	$mail->AddAddress($email);
	//$mail->AddBCC('willian@quax.com.br', 'Quax'); // Cópia Oculta

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = "<div style=\"width: 600px; border: 3px solid #DDD; padding: 8px;\">
				<div align=\"center\" style=\"color: #BBB; font-size: 11px;\">Este é um e-mail automático, não é necessário respondê-lo.</div>
				<br>
				<img src='".HTTP."img/topo_email.jpg'><br/><br/>" . $mensagem
			."
			<br><br>
			Att,
			<br><br>
			Engepesca<br>
			Rua Brusque, 400 - Centro - Itajaí - SC<br>
			47 3344.6929<br>
			atendimento@engepesca.com.br
			</div>";

	$mail->Body = $body;

	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	return $enviado;
}


function countdown ($pstr_day) {
	return round((strtotime( $pstr_day )-strtotime(date( "Y-m-d" )))/86400);
}

function get_categoria_data() {
	global $categoria_cadastro, $data_modifica_preco;

	$dataAgora = date('Y-m-d');
	$dataModifica = $data_modifica_preco;
	$timestamp1 = strtotime($dataAgora);
	$timestamp2 = strtotime($dataModifica);

	if($timestamp1 <= $timestamp2) $categoriaArray = 'antes';
	else $categoriaArray = 'depois';

	return $categoriaArray;
}

// VERIFICAR USER LOGADO
function verifica_logado() {
	global $lang;

	if($_SESSION['login_painel_logado']==1) return true;
	else {
		header("Location: ".HTTP.($lang=='pt'?'login/pt':'login/en'));
		exit;
	}
}

function abrevia($texto, $tam){
	if( strlen($texto) > $tam)
	{
		$texto = substr($texto, 0, $tam) . "...";
	}
	return $texto;
}

function dia_da_semana($data){

	$dd = date("w", strtotime($data) );

	switch($dd) {
		case"0": $dia_semana = "Domingo"; break;
		case"1": $dia_semana = "Segunda"; break;
		case"2": $dia_semana = "Terça"; break;
		case"3": $dia_semana = "Quarta"; break;
		case"4": $dia_semana = "Quinta"; break;
		case"5": $dia_semana = "Sexta"; break;
		case"6": $dia_semana = "Sábado"; break;
	}

	return $dia_semana;
}

// FORMATA NUM
function only_number($string) { return preg_replace("/[^0-9]/","", $string); }

function floatBrToMysql($valor) { return str_replace(",",".", str_replace(".","",$valor) ); }

// FOMATA DATA
function formatDate($date,$format='reverse',$extra=false) {
	if($date != '0000-00-00') return ($format=='reverse'?implode('-',array_reverse(explode('/',$date))):implode('/',array_reverse(explode('-',$date))));
	elseif($extra) return $extra;
}

// FORMATA CPF/CNPJ
function formata_cpf_cnpj($campo, $formatado = true){
	$codigoLimpo = ereg_replace("[' '-./ t]",'',$campo);
	$tamanho = (strlen($codigoLimpo) -2);
	if ($tamanho != 9 && $tamanho != 12){
		return false;
	}

	if ($formatado){
		$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

		$indice = -1;
		for ($i=0; $i < strlen($mascara); $i++) {
			if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
		}
		$retorno = $mascara;

	} else {
		$retorno = $codigoLimpo;
	}
	return $retorno;
}

// TODOS MESES
function get_mes($selected=NULL, $retorno='value') {
	$array = array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro'
	);

	if ($retorno == 'value') {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = ($vlr_mes==$selected?$nome_mes:false);
	} else {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = '<option value="'.$vlr_mes.'" '.($vlr_mes==$selected&&$selected!=NULL?'selected="selected"':false).'>'.$nome_mes.'</option>';
	}
	return implode("\n",$_html);
}

// SELECT NOMES ESTADOS
function get_estado($selected=NULL, $echo=true) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'ro' => 'Rondônia',
		'rs' => 'Rio Grande do Sul',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	foreach($array_state as $sigla => $estado) $_html[] = '<option value="'.$sigla.'" '.($sigla==$selected?'selected':false).'>'.$estado.'</option>';
	if($echo) echo implode("\n",$_html);
	else return implode("\n",$_html);
}

// NOMES ESTADOS
function get_estado_nome($st) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'ro' => 'Rondônia',
		'rs' => 'Rio Grande do Sul',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	return $array_state[$st];
}

// PEGAR LAT E LONG DE ENDERECO
function getLatandLong($addr,$city,$state) {
	$address = $addr.",+".$city.",+".$state;
	$address = str_replace(" ", "+", $address);

	//$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".$address."&key=AIzaSyD8BehYzzriFjYa932pTxGZxL20paixM4A&region=Brazil");
	$json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyBix5Tq0icz2irNfIxU4gh32Fw6daPnbdM&region=br");

	$json = json_decode($json);

	//var_dump($json);

	if ($json->{'status'} == 'OK') {

		$lat = str_replace(",", ".", $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'} );
		$lng = str_replace(",", ".", $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'} );

		return $lat .','. $lng;
	} else {
		return '0, 0';
	}
}

// CIDADE
function get_cidades($estado=NULL, $cidade=NULL, $echo = true) {
	global $db,$tables;

	if($estado){
		$estado = strtoupper($estado);
		$query = $db->get_results("SELECT id,nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}'");
		foreach($query as $result) $_html[] = '<option value="'.$result->id.'" '.($result->id==$cidade?'selected="selected"':false).'>'.$result->nome.'</option>';
		if($echo)echo implode("\n",$_html);
		else return implode("\n",$_html);
	}
}
function get_cidade_nome($id) {
	global $db, $tables;

	$query = $db->get_row("SELECT nome FROM ".$tables['CIDADES']." WHERE id='{$id}'");
	if($query) return $query->nome;
}


// CIDADES IBF
function get_cidades_ibf($estado=NULL, $cidade=NULL, $echo = true) {
	global $db,$tables;

	if($estado){
		$estado = strtoupper($estado);
		$query = $db->get_results("SELECT nome_cidade FROM ".$tables['CIDADES_IBF']." WHERE estado='{$estado}'");
		foreach($query as $result) $_html[] = '<option value="'.$result->nome_cidade.'" '.($result->nome_cidade==$cidade?'selected="selected"':false).'>'.$result->nome_cidade.'</option>';
		if($echo)echo implode("\n",$_html);
		else return implode("\n",$_html);
	}
}

// DESTINO LINK
function get_user_cat($valor=NULL, $retorno='value') {
	$array = array('master' => 'Master', 'corretor' => 'Corretor');

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}

// DESTINO LINK
function get_link_destino($valor=NULL, $retorno='value') {
	$array = array('_self' => 'Mesma janela', '_blank' => 'Nova janela');

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}


// STATUS
function get_status($valor=NULL, $retorno='value') {
	$array = array('1' => 'Ativado', '0' => 'Desativado');

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':false).'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}

// NOME DO PRODUTO ID
function get_produto_nome($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT * FROM ".$tables['PRODUTOS']." WHERE id = {$id}");
	return $query->titulo;
}

// // TODOS PRODUTOS
// function get_produtos($selected=NULL) {
// 	global $db, $tables;
// 	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE status = 1 ORDER BY categoria");
// 	//$db->debug();
// 	foreach($query as $rs) $_html[] = '<option value="'.$rs->id.'" '.($rs->id==$selected?'selected="selected"':"").'>'.$rs->categoria).' - '.$rs->titulo.'</option>';
// 	return implode("\n",$_html);
// }



// CATEGORIAS
function get_categorias_pro_combo($selected=NULL) {
	global $db, $tables;
	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_CATEGORIAS']." ORDER BY categoria");
	foreach($query as $rs) $_html[] = '<option value="'.$rs->id.'" '.($rs->id==$selected?'selected="selected"':"").'>'.$rs->categoria.'</option>';
	return implode("\n",$_html);
}

// PRODUTOS CATEGORIAS
function get_categorias_produtos($selected=NULL) {
	global $db, $tables;
	$id = explode("-",$selected);
	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_CATEGORIAS']);
	foreach($query AS $rs) $_html[] = '<label><input name="categorias[]" id="categorias" value="'.$rs->id.'" type="checkbox" '.(in_array($rs->id, $id)?'checked':"").'/> '.$rs->categoria.'</label>';
	return implode("\n",$_html);
}

function get_id_categoria_produtos($cat) {
	global $db, $tables;
	$id = $db->get_var("SELECT id FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE permalink='{$cat}'");
	return $id;
}

// Categorias valores
function get_nome_categoria_produtos($id=NULL, $lang="pt") {
	global $db, $tables;
	$query = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$id}'");
	return $query->{"titulo_".$lang};
}

function get_permalink_categoria_produtos($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT permalink FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$id}'");
	return $query->permalink;
}


// DESTAQUE
function get_destaque($valor=NULL) {
	$array = array('0' => 'Não', '1' => 'Sim');
	foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':false).'>'.$nome.'</option>';
	return implode("\n",$_html);
}
// STATUS DAS NOTÍCIAS
function get_not_status($valor=NULL) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':false).'>'.$nome.'</option>';
	return implode("\n",$_html);
}
function get_not_status_value($valor) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	return implode("\n",$_html);
}

// Blog Categorias
function get_categorias_blog($selected=NULL) {
	global $db, $tables;
	$id = explode("-",$selected);
	$query = $db->get_results("SELECT * FROM ".$tables['BLOG_CATEGORIAS']);
	foreach($query AS $rs) $_html[] = '<label><input name="categorias[]" id="categorias" value="'.$rs->id.'" type="checkbox" '.(in_array($rs->id, $id)?'checked':"").'/> '.$rs->categoria_pt.'</label>';
	return implode("\n",$_html);
}

function get_id_categoria_blog($cat) {
	global $db, $tables;
	$id = $db->get_var("SELECT * FROM ".$tables['BLOG_CATEGORIAS']." WHERE permalink='{$cat}'");
	return $id;
}

// Categorias valores
function get_categorias_values($selected=NULL) {
	global $db, $tables;
	$id = explode("-",$selected);
	$query = $db->get_results("SELECT * FROM ".$tables['BLOG_CATEGORIAS']);
	foreach($query AS $rs) $_html[] = (in_array($rs->id, $id)?$rs->categoria.'  ':"");
	return implode("\n",$_html);
}

function get_permalink_categoria_blog($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT permalink FROM ".$tables['BLOG_CATEGORIAS']." WHERE id='{$id}'");
	return $query->permalink;
}


// QUANTIDADE DE NOTÍCIAS NA CATEGORIA
function get_total_noticias($id=NULL) {
	global $db, $tables;

	if ($id > 0) {
		$qtd = $db->get_var("SELECT COUNT(*) FROM ".$tables['NOTICIAS']." WHERE categorias LIKE '%{$id}%'");
	} else {
		$qtd = $db->get_var("SELECT COUNT(*) FROM ".$tables['NOTICIAS']);
	}
	return $qtd;
}

// Moedas
function get_moedas($link_api, $bool = true) {
	//$link_api = https://github.com/raniellyferreira/economy-api/blob/master/README.md    - Recomendação
	$json_string = file_get_contents($link_api);
	$json_arr = json_decode($json_string, $bool);

	return($json_arr);
}


function get_name_produto($id) {
	global $db, $tables;
	
	$query = $db->get_row("SELECT titulo, id_grupo FROM ".$tables['PRODUTOS']." WHERE id='{$id}'");
	if($query) return $query->titulo . ' / ' . get_name_grupo($query->id_grupo);
}

function get_combo_grupo($selected) {
	global $db, $tables;
	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_CATEGORIAS']);
	if($query){
		foreach($query as $secao) $option[] = '<option value="'.$secao->id.'" '.($secao->id==$selected?'selected="selected"':false).'>'.$secao->titulo_pt.'</option>';		
		return implode("\n", $option);		
	}
}

function get_name_grupo($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT titulo_pt FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$id}'");
	return $query->titulo_pt;
}

function get_name_grupo_simples($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT titulo_pt FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$id}'");
	return $query->titulo_pt;
}



// Segmentos Mercados
function get_segmentos_mercados($selected=NULL) {
	global $db, $tables;
	$id = explode("-",$selected);
	$query = $db->get_results("SELECT * FROM ".$tables['MERCADOS_SEGMENTOS']);
	foreach($query AS $rs) $_html[] = '<label><input name="segmentos[]" id="segmentos" value="'.$rs->id.'" type="checkbox" '.(in_array($rs->id, $id)?'checked':"").'/> '.$rs->titulo_pt.'</label>';
	return implode("\n",$_html);
}
// Segmentos valores
function get_segmentos_values($selected=NULL) {
	global $db, $tables;
	$id = explode("-",$selected);
	$query = $db->get_results("SELECT * FROM ".$tables['MERCADOS_SEGMENTOS']);
	foreach($query AS $rs) $_html[] = (in_array($rs->id, $id)?$rs->titulo_pt.' - ':"");
	return implode("\n",$_html);
}



// PEGAR AUTOR
function get_nome_autor($id=NULL) {
	global $db, $tables;

	$query = $db->get_row("SELECT * FROM ".$tables['USUARIOS']." WHERE id = {$id}");
	return $query->nome_completo;
}

function antiSQL($campo, $adicionaBarras = false) {
	// remove palavras que contenham sintaxe sql
	$campo = preg_replace("/(from|table_name|alter table|column_name|select|database|insert|delete|update|were|drop table|show tables|char|chr|ASCII|xtype|script|cookie|%|<>|\"|\'|&|#|\*|--|\\\\)/i","",$campo);
	$campo = trim($campo);//limpa espaços vazio
	$campo = strip_tags($campo);//tira tags html e php
	if($adicionaBarras || !get_magic_quotes_gpc())
	$campo = addslashes($campo);
	return $campo;
}


function get_busca() {

	$_html[] = '<div class="search">
					<div class="wrap">
						<form method="GET" action="'.HTTP.'busca" method="GET">
							<input type="text" name="q" value="'.$_GET["q"].'" placeholder="DIGITE AQUI SUA BUSCA...">
							<button><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>';

	echo implode("\n", $_html);
}


// HEADER
function get_header() {
	global $titulo, $empresa, $permalink, $keywords, $description, $db, $tables, $MOBILE, $IPAD, $ativarTag, $imgDestaque, $title_share, $desc_share, $_lang, $lang;

	$arrayPaginas = returnFriendyURL();
	
	if($permalink == 'produtos') 
	{
		$pagina = $arrayPaginas[0].'/'.$arrayPaginas[1].'/';
	}
	elseif($permalink == 'home') 
	{
		$pagina = '';
	}
	else
	{
		$pagina = $permalink.'/';
	}

	require_once PHP.'classes/Class.mobiledetect.php';
	$detect = new Mobile_Detect;

	if ( $detect->isMobile() && !$detect->isTablet() ) {
		$MOBILE = true;
	}else{
		$MOBILE = false;
	}


	if ( $detect->isMobile() && $detect->isTablet() ) {
		$IPAD = true;
	}else{
		$IPAD = false;
	}


	$pg = $permalink;
	ob_start("ob_gzhandler");
	$_html[] = '<!doctype html>';
	$_html[] = '<html class="no-js" lang="pt-BR">';
	$_html[] = "<head>";
	$_html[] = "<link href='https://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet'>";
	$_html[] = "<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>";
 	$_html[] = '	<title>'.$titulo.'</title>';
					// METATAGS
	$_html[] = '	<meta charset="utf-8" />';
	$_html[] = '	<meta name="title" content="'.$titulo.'">';
	$_html[] = '	<meta name="description" content="'.$description.'" /> ';
					// MOBILE
	$_html[] = '	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
	$_html[] = '	<meta name="mobile-web-app-capable" content="yes" />';
	$_html[] = '	<meta name="format-detection" content="telephone=no">';
	$_html[] = '	<meta name="Author" content="Quax - Sites & Sistemas (www.quax.com.br)" />';
					// ICONS
	$_html[] = '	<link rel="shortcut icon" href="'.HTTP.'img/favicon.ico" />';
	$_html[] = '	<link rel="apple-touch-icon" href="'.HTTP.'img/apple-icon.ico">';

    $_html[] = '	<meta property="og:site_name" content="'.$empresa.'">';

    if($ativarTag)
	{
		$_html[] = '	<meta property="og:title" content="'.$title_share.'">';
		$_html[] = '	<meta property="og:image" content="'.$imgDestaque.'">';
    	$_html[] = '	<meta property="og:image:type" content="image/jpeg">';
    	$_html[] = '	<meta property="og:image:width" content="150">';
    	$_html[] = '	<meta property="og:image:height" content="150">';
		$_html[] = '	<meta property="og:description" content="'.$desc_share.'">';
    	$_html[] = '	<meta property="og:type" content="website">';
	}else{
		$_html[] = '	<meta property="og:image" content="'.HTTP.'img/img-para-facebook.jpg">';	
    	$_html[] = '	<meta property="og:image:type" content="image/jpeg">';
	}
	$_html[] = '	<script>HTTP = \''.HTTP.'\'</script>';
	$_html[] = '	<script>IS_MOBILE = "'.$MOBILE.'"</script>';
	$_html[] = '	<script>IS_TABLET = "'.$IPAD.'"</script>';
	$_html[] = '	<script>PAGE = "'.$pg.'"</script>';
	$_html[] =      style_enqueue('home','return');
	$_html[] = '</head>';
	$_html[] = '<body>
	<div class="lp_container_lateral '.(!$MOBILE  ? "is-enabled":"hidden").'">
		<div class="lp_top">
			L TRACKING
			<div class="lp_globe"><i class="fa fa-search" aria-hidden="true"></i></div>
			<div class="lp_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		</div>
		<div class="lp_body">'.$_lang[$lang]['acesse_o_rastramento'].'
			
			<br><br>
			<form action="#" method="POST" name="tracking" onsubmit="return trackmeLateral()">
				<input type="hidden" name="token" value="0675a16509edc42c9172cd4b48721e0e5559a546" />
				<select name="company" id="company">
					<option value="">'.$_lang[$lang]['select'].'</option>
					<option value="https://www.fedex.com/fedextrack/?tracknumbers=[trackcode]">FedEx</option>
					<option value="https://www.dhl.com.br/content/br/en/express/tracking.shtml?brand=DHL&AWB=[trackcode]">DHL</option>
					<option value="https://www.tnt.com/webtracker/tracking.do?respCountry=us&respLang=en&navigation=1&page=1&sourceID=1&sourceCountry=ww&plazaKey=&refs=&requesttype=GEN&searchType=CON&cons=[trackcode]">TNT</option>
					<option value="https://www.aramex.com/express/track-results-multiple.aspx?ShipmentNumber=[trackcode]">ARAMEX</option>
					<option value="https://wwwapps.ups.com/WebTracking/track?track=yes&trackNums=[trackcode]">UPS</option>
					<option value="https://www.shippingline.org/track/?container=[trackcode]">Containers</option>
				</select>
				<input type="text" name="trackid" id="trackid" placeholder="'.$_lang[$lang]['numero_awb'].'" />
				<div class="has-text-centered">
					<button class="botao">'.$_lang[$lang]['acessar'].'</button>
				</div>
			</form>
		</div>
	</div> 

	<!-- MENU FIXO -->
	<div class="menu_fixo">
		<div class="wrap">
			<nav class="nav_fixe">
				<div class="nav-left">
					<a class="nav-item logo-fixa" href="'.HTTP.$lang.'" title="'.$empresa.'"><img src="'.HTTP.'img/lp-export-logo-atual.png'.'"></a>
				</div>

				<div class="nav-right-mobile is-hidden-desktop">
					<a class="flag pt" href="'.HTTP.$pagina.'pt"></a>
					<a class="flag en" href="'.HTTP.$pagina.'en"></a>
					<a class="flag es" href="'.HTTP.$pagina.'es"></a>
				</div>


				<span class="nav-toggle">
					<span></span>
					<span></span>
					<span></span>
				</span>

				<ul class="nav-center nav-menu menu-desktop-ipad-land">
					<li><a class="nav-item '.($pg=="home"?"current":"").'" href="'.HTTP.$lang.'">'.$_lang[$lang]['inicial'].'</a></li>
					<li>
						<a class="subMenu empresa nav-item '.($pg=="empresa"?"current":"").'" style="cursor: default;">'.$_lang[$lang]['menu_empresa'].' <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						
						<ul class="sub-empresa">
							<li><a href="'.HTTP.'institucional/'.$lang.'">'.$_lang[$lang]['menu_institucional'].'</a></li>
						</ul>
					</li>
					<li>
						<a style="cursor: default;" class="subMenu produtos nav-item '.($pg=="produtos" || $pg=="produto"?"current":"").'">'.$_lang[$lang]['menu_produtos'].' <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
						<ul class="sub-produtos">
							<li><a href="'.HTTP.'produtos/beef/'.$lang.'">'.$_lang[$lang]['boi'].'</a></li>
							<li><a href="'.HTTP.'produtos/poultry/'.$lang.'">'.$_lang[$lang]['frango'].'</a></li>
							<li><a href="'.HTTP.'produtos/pork/'.$lang.'">'.$_lang[$lang]['porco'].'</a></li>
							<li><a href="'.HTTP.'produtos/fish/'.$lang.'">'.$_lang[$lang]['peixe'].'</a></li>
						</ul>
					</li>
					<!-- <li>
						<a class="nav-item '.($pg=="alegra"?"current":"").'" href="'.HTTP.'alegra/'.$lang.'">Alegra</a>
					</li> -->
					<li>
						<a style="cursor: default;" class="subMenu servicos nav-item">'.$_lang[$lang]['menu_servicos'].' <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
						<ul class="sub-servicos">
							<li><a href="'.HTTP.'representacao-exclusiva/'.$lang.'">'.$_lang[$lang]['menu_assessoria'].'</a></li>
							<li><a href="'.HTTP.'suporte-logistico-e-documental/'.$lang.'">'.$_lang[$lang]['menu_asssitencia_logistica'].'</a></li>
							<li><a href="'.HTTP.'desenvolvimento-de-marcas/'.$lang.'">'.$_lang[$lang]['menu_estruturacao_frigorificos'].'</a></li>
							<li><a href="'.HTTP.'inteligencia-de-mercado/'.$lang.'">'.$_lang[$lang]['menu_pesquisa_mercadologica'].'</a></li>
							<li><a href="'.HTTP.'mercado-internacional/'.$lang.'">'.$_lang[$lang]['menu_mercado_internacional'].'</a></li>
							<li><a href="'.HTTP.'trading/'.$lang.'">'.$_lang[$lang]['menu_diagnostico_comercializacao'].'</a></li>
						</ul>
					</li>
					<li><a class="nav-item '.($pg=="mercados"?"current":"").'" href="'.HTTP.'mercados/'.$lang.'">'.$_lang[$lang]['menu_mercados'].'</a></li>
					<li><a class="nav-item '.($pg=="blog"?"current":"").'" href="'.HTTP.'blog/'.$lang.'">Blog</a></li>
					<li><a class="nav-item '.($pg=="contato"?"current":"").'" href="'.HTTP.'contato/'.$lang.'">'.$_lang[$lang]['menu_contato'].'</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- END MENU FIXO -->

	<header class="waypoint animation_top">
		<div class="header-top">
			<div class="wrap">
				<nav class="nav">
					<div class="nav-left">
						<i class="fa fa-phone" aria-hidden="true"></i>'.($lang == 'en' ? 'Brazil' : 'Brasil').' <a href="skype:+554730460506?call">+55 (47) <strong>3046.0506</strong></a>
						&nbsp; | &nbsp;
						Dubai<a href="skype:+97144327366?call">+971 4 <strong>432.7366</strong></a>
						&nbsp; | &nbsp;
						Hong Kong<a href="skype:+852421561515?call">+852 4 <strong>2156.1515</strong></a>
					</div>
					<div class="nav-right">
						<a style="margin-right: 35px;" href="https://www.linkedin.com/company/lp-export-dmcc" target="_blank" title="Linkedin">
							<i class="fa fa-linkedin-square" style="font-size: 18px"></i>
						</a>

						<a class="flag pt" href="'.HTTP.$pagina.'pt"></a>
						<a class="flag en" href="'.HTTP.$pagina.'en"></a>
						<a class="flag es" href="'.HTTP.$pagina.'es"></a>
						<form method="GET" id="form-top" action="'.HTTP.'busca/'.$lang.'/">
							<input type="text" name="q" value="'.$_GET["q"].'" placeholder="'.$_lang[$lang]['digite_busca'].'"/>
							<button type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
				</nav>
			</div>
		</div>

		<div class="wrap">
			<nav class="nav">
				<div class="nav-left">
					<a class="nav-item logo" href="'.HTTP.$lang.'" title="'.$empresa.'">'.$empresa.'</a>
				</div>

				<div class="nav-right-mobile is-hidden-desktop">
					<a class="flag pt" href="'.HTTP.$pagina.'pt"></a>
					<a class="flag en" href="'.HTTP.$pagina.'en"></a>
					<a class="flag es" href="'.HTTP.$pagina.'es"></a>
				</div>

				<span class="nav-toggle">
					<span></span>
					<span></span>
					<span></span>
				</span>

				<ul class="nav-center nav-menu menu-desktop-ipad-land">
					<li><a class="nav-item '.($pg=="home"?"current":"").'" href="'.HTTP.$lang.'">'.$_lang[$lang]['inicial'].'</a></li>
					<li>
						<a class="subMenu empresa nav-item '.($pg=="empresa"?"current":"").'" style="cursor: default;">'.$_lang[$lang]['menu_empresa'].' <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						
						<ul class="sub-empresa">
							<li><a href="'.HTTP.'institucional/'.$lang.'">'.$_lang[$lang]['menu_institucional'].'</a></li>
							
						</ul>
					</li>
					<li>
						<a style="cursor: default;" class="subMenu produtos nav-item '.($pg=="produtos" || $pg=="produto"?"current":"").'">'.$_lang[$lang]['menu_produtos'].' <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
						<ul class="sub-produtos">
							<li><a href="'.HTTP.'produtos/beef/'.$lang.'">'.$_lang[$lang]['boi'].'</a></li>
							<li><a href="'.HTTP.'produtos/poultry/'.$lang.'">'.$_lang[$lang]['frango'].'</a></li>
							<li><a href="'.HTTP.'produtos/pork/'.$lang.'">'.$_lang[$lang]['porco'].'</a></li>
							<li><a href="'.HTTP.'produtos/fish/'.$lang.'">'.$_lang[$lang]['peixe'].'</a></li>
						</ul>
					</li>
					<!-- <li>
						<a class="nav-item '.($pg=="alegra"?"current":"").'" href="'.HTTP.'alegra/'.$lang.'">Alegra</a>
					</li> -->
					<li>
						<a style="cursor: default;" class="subMenu servicos nav-item">'.$_lang[$lang]['menu_servicos'].' <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
						<ul class="sub-servicos">
							<li><a href="'.HTTP.'representacao-exclusiva/'.$lang.'">'.$_lang[$lang]['menu_assessoria'].'</a></li>
							<li><a href="'.HTTP.'suporte-logistico-e-documental/'.$lang.'">'.$_lang[$lang]['menu_asssitencia_logistica'].'</a></li>
							<li><a href="'.HTTP.'desenvolvimento-de-marcas/'.$lang.'">'.$_lang[$lang]['menu_estruturacao_frigorificos'].'</a></li>
							<li><a href="'.HTTP.'inteligencia-de-mercado/'.$lang.'">'.$_lang[$lang]['menu_pesquisa_mercadologica'].'</a></li>
							<li><a href="'.HTTP.'mercado-internacional/'.$lang.'">'.$_lang[$lang]['menu_mercado_internacional'].'</a></li>
							<li><a href="'.HTTP.'trading/'.$lang.'">'.$_lang[$lang]['menu_diagnostico_comercializacao'].'</a></li>
						</ul>
					</li>
					<li><a class="nav-item '.($pg=="mercados"?"current":"").'" href="'.HTTP.'mercados/'.$lang.'">'.$_lang[$lang]['menu_mercados'].'</a></li>
					<li><a class="nav-item '.($pg=="blog"?"current":"").'" href="'.HTTP.'blog/'.$lang.'">Blog</a></li>
					<li><a class="nav-item '.($pg=="contato"?"current":"").'" href="'.HTTP.'contato/'.$lang.'">'.$_lang[$lang]['menu_contato'].'</a></li>
				</ul>
			</nav>
		</div>
	</header>';



	echo implode("\n", $_html);
}

// FOOTER
function get_footer() {
	global $titulo, $permalink, $keywords, $description, $db, $tables, $_lang, $lang;

	$_html[] = '
	<footer>
		<div class="wrap inf relative is-hidden-mobile">
			<div class="columns is-multiline waypoint animation_bottom">
				<div class="column is-2" style="position:relative;">
					<h3>'.$_lang[$lang]['menu_empresa'].'</h3>
					<a href="'.HTTP.'institucional/'.$lang.'" class="link">'.$_lang[$lang]['menu_empresa'].'</a>
					<a href="'.HTTP.'contato/'.$lang.'" class="link">'.$_lang[$lang]['nossos_escritorios'].'</a>
					<a href="'.HTTP.'indices-financeiros/'.$lang.'" class="link '.($lang == "pt"?"":"is-hidden").'">Índices Financeiros</a>
				</div>
				<div class="column is-2">
					<h3>'.$_lang[$lang]['menu_produtos'].'</h3>
					<a href="'.HTTP.'produtos/pork/'.$lang.'" class="link">'.$_lang[$lang]['porco'].'</a>
					<a href="'.HTTP.'produtos/poltry/'.$lang.'" class="link">'.$_lang[$lang]['frango'].'</a>
					<a href="'.HTTP.'produtos/beef/'.$lang.'" class="link">'.$_lang[$lang]['boi'].'</a>
				</div>
				<div class="column is-2">
					<h3>'.$_lang[$lang]['menu_servicos'].'</h3>
					<a href="'.HTTP.'representacao-exclusiva/'.$lang.'" class="link">'.$_lang[$lang]['menu_assessoria'].'</a>
					<a href="'.HTTP.'suporte-logistico-e-documental/'.$lang.'" class="link">'.$_lang[$lang]['menu_asssitencia_logistica'].'</a>
					<a href="'.HTTP.'desenvolvimento-de-marcas/'.$lang.'" class="link">'.$_lang[$lang]['menu_estruturacao_frigorificos'].'</a>
					<a href="'.HTTP.'inteligencia-de-mercado/'.$lang.'" class="link">'.$_lang[$lang]['menu_pesquisa_mercadologica'].'</a>
					<a href="'.HTTP.'mercado-internacional/'.$lang.'" class="link">'.$_lang[$lang]['menu_mercado_internacional'].'</a>
					<a href="'.HTTP.'trading/'.$lang.'" class="link">'.$_lang[$lang]['menu_diagnostico_comercializacao'].'</a>
				</div>
				<div class="column is-2">
					<h3>'.$_lang[$lang]['menu_mercados'].'</h3>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['africa_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" style="text-transform: capitalize!important;" class="link">'.$_lang[$lang]['orientem_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['asia_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['cis_eu_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['russia_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['mercosul_footer'].'</a>
					<a href="'.HTTP.'mercados/'.$lang.'" class="link">'.$_lang[$lang]['caribe_footer'].'</a>
				</div>
				<div class="column is-2">
					<h3>Blog</h3>
					<a href="'.HTTP.'blog/'.$lang.'" class="link">'.$_lang[$lang]['saiba_mais'].'</a>
					<br>
					<h3>'.$_lang[$lang]['idiomas'].'</h3>
					<a href="'.HTTP.'pt" class="link">'.$_lang[$lang]['portugues'].'</a>
					<a href="'.HTTP.'en" class="link">'.$_lang[$lang]['ingles'].'</a>
					<a href="'.HTTP.'es" class="link">'.$_lang[$lang]['espanhol'].'</a>
				</div>
				<div class="column is-2">
					<h3>'.$_lang[$lang]['menu_contato'].'</h3>
					<a href="'.HTTP.'contato/'.$lang.'" class="link">'.$_lang[$lang]['fale_conosco'].'</a>
					<a href="'.HTTP.'trabalhe-conosco/'.$lang.'" class="link">'.$_lang[$lang]['trabalhe_conosco'].'</a>

					<br>
					<h3>Redes Sociais</h3>
					<a href="https://www.linkedin.com/company/lp-export-dmcc" target="_blank" class="link">Linkedin</a>
				</div>
			</div>
			
			<!-- <a class="cotacao waypoint animation_bottom '.($lang!='pt'?'is-hidden':'').'" href="https://www.debit.com.br" target="_blank" alt="Correção monetária e cálculos trabalhistas">
				<img src="https://www.debit.com.br/indicadores.php" title="Correção monetária e cálculos trabalhistas">
			</a> -->

			<a href="'.HTTP.$lang.'">
				<img class="logo-footer waypoint animation_bottom" src="'.HTTP.'img/lp-export-logo-atual.png" alt="LP Export"/>
			</a>
			<!-- <div class="social waypoint animation_bottom">
				<a href="https://www.facebook.com/LPartners/" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
				<a href="https://www.youtube.com/user/" target="_blank" class="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
			</div> -->

		</div>

		<div class="quax-assinatura waypoint animation_bottom">
			<a class="logo-quax" href="https://www.quax.com.br" target="_blank" title="QUAX - Sites & Sistemas">
				<div class="arrow-up"></div>
				<img src="'.HTTP.'img/quax.png" alt="QUAX - Sites & Sistemas"/>
			</a>
		</div>
	</footer>';

	$_html[] =  "    ".javascript_enqueue('home','return');
	$_html[] = '	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.min.js"></script>';
	// ANALYTICS
	if(!LOCALHOST) {
	$_html[] = "	<script>
					  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

					  ga('create', 'UA-41818026-1', 'auto');
					  ga('send', 'pageview');
					</script>";
	}

	$_html[] = '	</body>';
	$_html[] = '</html>';

	echo implode("\n", $_html);
}

?>