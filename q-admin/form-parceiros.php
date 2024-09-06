<?php
require("config.php");

if($_POST && isset($_POST['submit'])) {
	switch($_POST['action']) {

		case 'adicionar':
		require(PHP."classes/Class.validacao.php");

		$rules[] = "required,titulo,Título";
		$rules[] = "required,status,Status";

		$errors = validateFields($_POST, $rules);
		if (empty($errors))
		{
			$link = str_replace(["http://","https://"],"",$_POST['link']);

			$array_insert = array(
				'titulo' 	=> $_POST['titulo'],
				'link' 		=> $link,
				'status' 	=> $_POST['status'],
				'data_criacao' 	=> date("Y-m-d H:i:s")
			);

			$insert = $db->insert($tables['PARCEIROS'],$array_insert);

			if($insert) {
				$alertSucess  = true;
				$alertMessage = 'Registro salvo com sucesso!';
				$_POST['id']  = $db->lastInserId();
			} else {
				$alertFail    = true;
				$alertMessage = 'Não foi possível salvar o registro!';
			}
		}
		break;

		case 'alterar':
		require(PHP."classes/Class.validacao.php");

		$rules[] = "required,titulo,Título";
		$rules[] = "required,status,Status";

		$errors = validateFields($_POST, $rules);
		if (empty($errors))
		{
			$link = str_replace(["http://","https://"],"",$_POST['link']);

			$array_update = array(
				'titulo'  => $_POST['titulo'],
				'link' 	  => $link,
				'status'  => $_POST['status']
			);

			$update = $db->update($tables['PARCEIROS'],$array_update,array('id'=>$_POST['id']));

			$alertSucess  = true;
			$alertMessage = 'Registro salvo com sucesso!';
		}
		break;
	}

	$id = $_POST['id'];

	require(PHP.'classes/Class.imagem.php');

	// INSERINDO IMAGEM
	$tempFile 		= $_FILES['imagem']['tmp_name'];
	$upload_temp	= upload('imagem',TEMP,'10mb',false,false,false,'md5');

	if($upload_temp[0] == 'true') {

		$fileName 	= $upload_temp[1];
		$extFile 	= substr($upload_temp[1], -4);

		if( $extFile == "jpeg" ) {
			$extFile = ".jpg";
		}

		$fileNewName = $id.'-parceiros-'.rand(0,99);
		$image = new Image(TEMP.$fileName);
		$image->setPathToTempFiles(TEMP);
		$image->resize(150, 150, "crop", "c", "c");
		$image->save(ROOT_UPLOADS_IMG.$fileNewName);
		$fileNewName = $fileNewName.$extFile;
		$array_update = array( 'imagem' => $fileNewName );
		$update = $db->update($tables['PARCEIROS'],$array_update,array('id'=>$_POST['id']));

		@unlink(TEMP.$fileName);

		// DELETAR IMAGEM E INSERIR EM SEGUIDA
		$_GET["del_img"] = 0;
	}

}

// DELETAR POST
if ($_POST && isset($_POST['deletar'])) {
	$query = $db->get_row("SELECT * FROM ".$tables['PARCEIROS']." WHERE id = '{$_POST["id"]}'");

	if($query->imagem) {
		@unlink(HTTP_UPLOADS_IMG.$query->imagem);
		@unlink(ROOT_UPLOADS_IMG.$query->imagem);
	}

	$db->query("DELETE FROM ".$tables['PARCEIROS']." WHERE id='{$_POST['id']}'");

	header("Location: ".HTTP_GESTOR."list-parceiros.php?del=ok");
}

// DELETAR IMAGEM
if( is_numeric( $_GET["del_img"] ) && $_GET["del_img"] == "1" && $_GET["imagem"] == "1" )
{
	$query = $db->get_row("SELECT imagem FROM ".$tables['PARCEIROS']." WHERE id = '{$_GET["id"]}'");

	if($query->imagem) {
		@unlink(HTTP_UPLOADS_IMG.$query->imagem);
		@unlink(ROOT_UPLOADS_IMG.$query->imagem);
	}

	$array_update = array( 'imagem' => NULL );
	$update = $db->update($tables['PARCEIROS'],$array_update,array('id'=>$_GET['id']));

	$alertSucess  = true;
	$alertMessage = 'Imagem excluída com sucesso!';
}


// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) $query = $db->get_row("SELECT * FROM ".$tables['PARCEIROS']." WHERE id='{$id}'");

// HEADERS
$_header['titulo'] = ($id?'Editar Parceiros':'Novo Parceiro');
$_header['icon']   = 'picture';

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
			<a class="btn btn-sm btn-default hidden-xs" href="form-parceiros.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-parceiros.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<fieldset>
		<div class="row">
			<div class="form-group col-md-8">
				<label for="titulo">Título *</label>
				<input type="text" class="form-control input-sm" id="titulo" name="titulo" value="<?php echo ($query ? $query->titulo : $_POST['titulo']); ?>" />
			</div>
			<div class="form-group col-md-4">
				<label for="status">Status *</label>
				<select class="form-control input-sm" name="status" id="status">
					<option value="">Selecione</option>
					<?php echo get_status(($query?$query->status:$_POST['status']),'option'); ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<label for="link">Link</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
					<input type="text" class="form-control input-sm" id="link" name="link" value="<?php echo ($query?$query->link:$_POST['link']);?>" placeholder="http://" />
				</div>
			</div>
		</div>
		<div class="well">
			<?php if ($query->imagem || $fileNewName) { ?>
			<p><img class="img-thumbnail" src="<?php echo HTTP_UPLOADS_IMG.($query->imagem ? $query->imagem : $fileNewName)?>" /></p>
			<a class="btn btn-sm btn-danger" href="form-parceiros.php?id=<?php echo $id?>&imagem=1&del_img=1" title="Excluir"><span class="glyphicon glyphicon-trash"></span> Deletar Imagem</a>
			<?php } else { ?>
			<label for="imagem">Imagem</label>
			<input type="file" id="imagem" name="imagem">
			<p class="help-block">A imagem deve ter 150x150px</p>
			<?php } ?>
		</div>

		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>