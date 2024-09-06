<?php 
error_reporting (0);
require("../php/config.php");
//echo PHP;

if ($_POST) {
	$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
	$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
	
	if($usuario && $senha) {
		require(PHP.'classes/Class.login.php');
		$userClass = new Usuario();
		if($userClass->logaUsuario( $usuario, $senha, false)) {
			header("Location: index.php");
			exit;
		} else $msg = $userClass->erro;
	} else $msg = "Digite seus dados de acesso!";
}
?>
<!DOCTYPE>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="robots" content="noindex,nofollow" />
		<title>Q-Admin | Administrador</title>
		<link rel="icon" href="<?php echo HTTP_GESTOR ?>imagens/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?php echo HTTP_GESTOR ?>imagens/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css" />
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="home-login" style="background: url(img/bg-<?php echo rand(0,3) ?>.jpg);">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-2 col-md-4 lateral vcenter"></div>
				<div class="col-xs-8 col-md-4 vcenter">
					<div class="box">
						<h1>Quax</h1>
						<p class="text-center">Por favor, digite seus dados de login.</p>
						<form action="<?=HTTP_GESTOR?>login.php" method="POST" id="form_login" >
							<div class="form-group">
								<label class="sr-only" for="usuario">Usuário</label>
								<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" autofocus>
							</div>
							<div class="form-group">
								<label class="sr-only" for="senha">Senha</label>
								<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
							</div>
							<button type="submit" name="login" value="" class="btn btn-success">Logar</button>
						</form>
						<?php echo '<div id="erro" '.($msg?'style="display:block"':false).'>'.$msg.'</div>' ?>
						<span id="carregando"></span>
					</div>
				</div>
				<div class="col-xs-1 col-md-1 lateral vcenter"></div>
			</div>
		</div>

		<footer>
			<a title="QUAX"  target="_blank" href="http://www.quax.com.br"><b>QUAX</b></a> &copy; <?php echo date("Y")?> Todos os Direitos Reservados.<br />
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#form_login').submit(function() {
					if(!$("#usuario").val() || !$("#senha").val()){
						$("#erro").show().html("Digite seus dados de acesso!");
						return false;
					} else return true;
				});
			});
		</script>
	</body>
</html>