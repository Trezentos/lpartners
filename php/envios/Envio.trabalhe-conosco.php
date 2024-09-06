<?php
include('../config.php');
// session_start();

if ( $_POST )
{

	// if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != '')
	// {
	// 	// Inclui o Autoloader do ReCaptcha
	// 	require_once(PHP."autoloadRecaptcha.php");
	// 	$recaptcha = new \ReCaptcha\ReCaptcha('6LcZLzoUAAAAAJURxLgbVfl-qWDjXytqaZPY0viX');

	// 	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	// } else {
	// 	$resp = null;
	// }



	//if ( $_POST["nome"] != "" && $_POST["email"] != "" && $_POST["mensagem"] != "" && (!is_null($resp) && $resp->isSuccess()) )
	if ( $_POST["nome"] != "" && $_POST["email"] != "" && $_POST["mensagem"] != "" )
	{

		// UPLOAD CURRICULO
		if($_FILES["curriculo"]["name"])
		{
			$newname   = "curriculo_" . clean_string($dados['nome'])."-".rand(0,999);
		    $extension = pathinfo($_FILES["curriculo"]["name"], PATHINFO_EXTENSION);
		    $fileName  = ROOT_CURRICULOS.$newname.'.'.$extension;
		    $uploaded  = move_uploaded_file($_FILES["curriculo"]["tmp_name"], $fileName);
		}


		require(PHP."phpmailer/class.smtp.php");
		require(PHP."phpmailer/class.phpmailer.php");

		$mail = new PHPMailer();
		
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		
		$mail->Port = 587;
		$mail->Host = "mail.quax.com.br";
		$mail->Username = "envio@quax.com.br";
		$mail->Password = 'U)E07oU)YfkS';
		
		$mail->From 	= $_POST["email"];
		$mail->Sender 	= $_POST["email"];
		$mail->FromName = $_POST["nome"];

		$mail->AddAddress('luciano@lpexport.net', 'Lp Export');
		$mail->AddBCC('contato@quax.com.br');
	
		$mail->IsHTML(true);
		$mail->CharSet = 'utf-8';


		if($uploaded) $array_file = $fileName;
        else $array_file = false;

  		// Anexo
  		$mail->AddAttachment($array_file);


		$mail->Subject = $empresa." - Formulário De Trabalhe Conosco";

		$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
								<title>'.$empresa.' - Formulário De Contato</title>
								<style type="text/css">
									* { margin: 0; padding: 0; }
									/* Force Outlook to provide a "view in browser" button. */
									#outlook a { padding:0; } 
									/* Force Hotmail to display emails at full width */
									body { width:100% !important; } .ReadMsgBody{ width:100%; } .ExternalClass{ width:100%; } 
									/* Prevent Webkit and Windows Mobile platforms from changing default font sizes. */
									body { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; } 
									html { min-height: 100%; }
									body {
										margin:0;
										padding:0;
										height: 100%;
										min-height: 100%;
										background: #f5f5f5;
										font-family: "Helvetica", sans-serif;
										font-size: 15px;
										color: #333;
									}
									img {
										border:0 none;
										height:auto;
										line-height:100%;
										outline:none;
										text-decoration:none;
									}
									a img { border:0 none; }
									.imageFix { display:block; }
									table, td { border-collapse:collapse; }
									#headerTable {
										margin:0;
										padding:0;
										width:100%;
										background: #f5f5f5;
										border-bottom: 5px solid #333;
									}
									#headerContainer {}
									#headerContainer tr.header { background: #f5f5f5; }
									#headerContainer tr.header h2 {
										margin: 20px 0;
										font-size: 30px;
										text-transform:;uppercase
										text-align: left;
										color: #333;
									}
									#headerContainer tr.header h2 small {
										display: block;
										font-size: 65%;
									}
									#bodyTable {
										padding: 0;
										width: 100%;
										margin: 0;
										background: #f5f5f5;
									}
									#emailContainer {
										background: #fff;
										line-height: 20px;
										border-bottom: 30px solid #fff;
									}
									#emailContainer td { padding: 25px 25px 0; }
									#emailContainer td strong {
										margin: -5px -5px 0;
										margin-bottom: 5px;
										display: block;
										font-weight: bolder;
										font-size: 18px;
									}
								</style>
							</head>
							<body bgcolor="#f5f5f5" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" id="headerTable">
									<tr>
										<td align="center" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="700" id="headerContainer">
												<tr class="header">
													<td colspan="2">
														<h2>'.$empresa.'</h2>
														<h4>Formulário De Trabalhe Conosco</h4>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
									<tr>
										<td align="center" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="700" id="emailContainer">
												<tr>
													<td>
														<strong>Nome</strong>
														'.$_POST["nome"].'
													</td>
													<td>
														<strong>E-mail</strong>
														'.$_POST["email"].'
													</td>
												</tr>
												<tr>
													<td>
														<strong>Telefone</strong>
														'.$_POST["telefone"].'
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<strong>Mensagem</strong>
														'.nl2br($_POST["mensagem"]).'
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</body>
						</html>';
	
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