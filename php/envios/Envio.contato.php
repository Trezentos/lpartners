<?php
include('../config.php');
// session_start();


$nome 	  	= antiSQL($_POST["nome"]);
$email 	  	= antiSQL($_POST["email"]);
$telefone 	= antiSQL($_POST["telefone"]);
$mensagem 	= antiSQL($_POST["mensagem"]);
$escritorio = antiSQL($_POST["escritorio"]);

if($escritorio == 'DUBAI') { 
	$address = 'cristiane@lpexport.net';
}

if($escritorio == 'ITAJAÍ') {
	$address = 'rafael@lpexport.net';
}

if($escritorio == 'HONG KONG') {
	$address = 'gustavo@lpexport.net';
}

if ( $_POST )
{

	// if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != '')
	// {
	// 	// Inclui o Autoloader do ReCaptcha
	// 	require_once(PHP."autoloadRecaptcha.php");
	// 	$recaptcha = new \ReCaptcha\ReCaptcha('6LeBnRQUAAAAAFTmkxSs5JCahNIJV1rgrFDaSIvx');

	// 	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	// } else {
	// 	$resp = null;
	// }

	//&& (!is_null($resp) && $resp->isSuccess())

	if ( $nome != "" && $email != "" && $mensagem != "" )
	{
		require(PHP."phpmailer/class.phpmailer.php");
		require(PHP."phpmailer/class.smtp.php");

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "mail.quax.com.br";
		//$mail->SMTPDebug  = 2;
		$mail->Port     = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'envio@quax.com.br';
		$mail->Password = 'U)E07oU)YfkS';
		$mail->SetFrom("envio@quax.com.br","Site - LP Export");
		$mail->AddReplyTo($email, $nome);

		// $mail->AddAddress("willian@quax.com.br");
		$mail->AddAddress($address, "LP Export");
		$mail->AddBCC('contato@quax.com.br', 'Quax');
		$mail->IsHTML(true);
		$mail->CharSet = 'utf-8';
		$mail->Subject = "LP Export - Formulário De Contato";
		$mail->Body = "<img src='".HTTP."img/topo_email.jpg'>
						<br/><br/>
						<h3>Site - Formulário De Contato</h3><br/>
						● Nome: ".$nome."<br/><br>
						● E-mail: ".$email."<br/><br>
						● Telefone: ".$telefone."<br/><br>
						● Mensagem: ".nl2br($mensagem)."<br><br>
						<br><br>

						Data - Hora do envio: " . date("d/m/Y - H:i");

		$enviado = $mail->Send();
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();

		if ($enviado) {
			echo "1";
		} else {
			echo "0";
		}
	} else {
		echo "0";
	}
}