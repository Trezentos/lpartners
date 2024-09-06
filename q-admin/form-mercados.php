<?php
require("config.php");

// NOTÍCIA
if ($_POST && isset($_POST['submit']))
{

	switch($_POST['action'])
	{

		case 'adicionar':
			require(PHP."classes/Class.validacao.php");

			$rules[] = "required,titulo,Nome";
			$rules[] = "required,status,Status";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_insert = array(
					'titulo'	=> $_POST['titulo'],
					'email' 	=> $_POST['email'],
					'telefone' 	=> $_POST['telefone'],
					'celular' 	=> $_POST['celular'],
					'skype' 	=> $_POST['skype'],
					'status' 	=> $_POST['status'],
					'segmentos'	=> implode("-",$_POST['segmentos']),
				);

				$insert = $db->insert($tables['MERCADOS'],$array_insert);

				if($insert) {
					$alertSucess 	= true;
					$alertMessage 	= 'Registro salvo com sucesso!';
					$_POST['id'] 	= $db->lastInserId();
				} else {
					$alertFail 		= true;
					$alertMessage 	= 'Não foi possível salvar o registro!';
				}
			}
			break;

		case 'alterar':
			require(PHP."classes/Class.validacao.php");

			$rules[] = "required,titulo,Nome";
			$rules[] = "required,status,Status";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_update = array(
					'titulo'	=> $_POST['titulo'],
					'email' 	=> $_POST['email'],
					'telefone' 	=> $_POST['telefone'],
					'celular' 	=> $_POST['celular'],
					'skype' 	=> $_POST['skype'],
					'status' 	=> $_POST['status'],
					'segmentos'	=> implode("-",$_POST['segmentos']),
				);

				$update = $db->update($tables['MERCADOS'],$array_update,array('id'=>$_POST['id']));

				$alertSucess 	= true;
				$alertMessage 	= 'Registro salvo com sucesso!';
			}
			break;
	}
}

// DELETAR POST
if ($_POST && isset($_POST['deletar']))
{
	$db->query("DELETE FROM ".$tables['MERCADOS']." WHERE id='{$_POST['id']}'");
	header("Location: ".HTTP_GESTOR."list-mercados.php?del=ok");
}

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) {
	$query = $db->get_row("SELECT * FROM ".$tables['MERCADOS']." WHERE id='{$id}'");
}

// HEADERS
$_header['titulo'] = ($id?'Editar Mercado':'Novo Mercado');
$_header['icon']   = 'globe';

add_javascript(array("jquery.ui.widget.js","jquery.iframe-transport.js","jquery.rsv.js"));
get_header_gestor();
get_barra_header();
?>

<div class="alert alert-danger">
	<button type="button" class="close" aria-hidden="true">&times;</button>
	<div id="rsvErrors"></div>
</div>

<div class="alert alert-warning"></div>
<div class="alert alert-success"></div>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
			<button class="btn btn-sm btn-default" type="submit" name="deletar"><span class="glyphicon glyphicon-trash"></span> Deletar</button>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default hidden-xs" href="form-mercados.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-mercados.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li <?php echo (isset($_POST) && $_POST['tab']==2 ? false : 'class="active"' ) ?>><a href="#tab1" data-toggle="tab">Geral</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" <?php echo (isset($_POST['tab']) && $_POST['tab']=='2' ? 'class="tab-pane"' : 'class="tab-pane active"' ) ?>>
			<fieldset>
				<div class="row">
					<div class="form-group col-md-3">
						<label for="titulo">Nome *</label>
						<input type="text" class="form-control input-sm" id="titulo" name="titulo" value="<?php echo ($query ? $query->titulo : $_POST['titulo']); ?>" />
					</div>
					<div class="form-group col-md-3">
						<label for="email">E-mail *</label>
						<input type="text" class="form-control input-sm" id="email" name="email" value="<?php echo ($query ? $query->email : $_POST['email']); ?>" />
					</div>
					<div class="form-group col-md-2">
						<label for="telefone">Telefone</label>
						<input type="text" class="form-control input-sm" id="telefone" name="telefone" value="<?php echo ($query ? $query->telefone : $_POST['telefone']); ?>" />
					</div>
					<div class="form-group col-md-2">
						<label for="celular">Celular</label>
						<input type="text" class="form-control input-sm" id="celular" name="celular" value="<?php echo ($query ? $query->celular : $_POST['celular']); ?>" />
					</div>
					<div class="form-group col-md-2">
						<label for="skype">Skype</label>
						<input type="text" class="form-control input-sm" id="skype" name="skype" value="<?php echo ($query ? $query->skype : $_POST['skype']); ?>" />
					</div>
				</div>
				<div class="row">
					
					<div class="form-group col-md-3">
						<label for="status">Status *</label>
						<select class="form-control input-sm" name="status" id="status">
							<option value="">Selecione</option>
							<?php echo get_not_status(($query?$query->status:$_POST['status']));?>
						</select>
					</div>
				</div>

				<div id="buttons">
					<div class="form-group col-md-12">
						<br>
						<label for="segmentos">Segmentos *</label>
						<br><br>
						<div class="segmentos">
							<?php echo get_segmentos_mercados(($query?$query->segmentos:$_POST['segmentos'])); ?>
						</div>
						<br>
					</div>
				</div>

			</fieldset>
		</div>
		
	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
</form>

<?php get_footer_gestor(); ?>