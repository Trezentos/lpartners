<?php 
require("config.php");

if($_POST && isset($_POST['submit'])) {
	switch($_POST['action']) {
		
		case 'adicionar':
		require(PHP."classes/Class.validacao.php");
		
		$rules[] = "required,titulo,Título";
		$rules[] = "required,permalink,Permalink";
		
		$errors = validateFields($_POST, $rules);
		if (empty($errors)) {
			$array_insert = array(
				'titulo' => $_POST['titulo'],
				'permalink' => $_POST['permalink'],
				'arquivo' => $_POST['arquivo'],
				'conteudo' => addslashes($_POST['conteudo']),
				'keywords' => $_POST['keywords'],
				'description' => $_POST['description'],
				'data_criacao' => date("Y-m-d H:i:s"),
				'autor' => $autor
			);

			$insert = $db->insert($tables['PAGINAS'],$array_insert);
			
			if($insert) {
				$alertSucess = true;
				$alertMessage = 'Registro salvo com sucesso!';
				$_POST['id'] = $db->lastInserId();
			} else {
				$alertFail = true;
				$alertMessage = 'Não foi possível salvar o registro!';
			}
		}
		break;

		case 'alterar':
		require(PHP."classes/Class.validacao.php");
		
		$rules[] = "required,titulo,Título";
		$rules[] = "required,permalink,Permalink";
		
		$errors = validateFields($_POST, $rules);
		if (empty($errors)) {
			$array_update = array(
				'titulo' => $_POST['titulo'],
				'permalink' => $_POST['permalink'],
				'arquivo' => $_POST['arquivo'],
				'conteudo' => addslashes($_POST['conteudo']),
				'keywords' => $_POST['keywords'],
				'description' => $_POST['description']
			);

			$update = $db->update($tables['PAGINAS'],$array_update,array('id'=>$_POST['id']));
			
			$alertSucess = true;
			$alertMessage = 'Registro salvo com sucesso!';
		}
		break;		
	}
}

// DELETAR POST
if ($_POST && isset($_POST['deletar'])) {
	$db->query("DELETE FROM ".$tables['PAGINAS']." WHERE id='{$_POST['id']}'");	
	header("Location: ".HTTP_GESTOR."list-paginas.php?del=ok");
}

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) $query = $db->get_row("SELECT * FROM ".$tables['PAGINAS']." WHERE id='{$id}'");

// HEADERS
$_header['titulo'] = ($id?'Editar Página':'Nova Página');
$_header['icon'] = 'file';

add_javascript(array("jquery.tinymce.js","jquery.rsv.js","script.textarea.js","form.pagina.js"));

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
			<a class="btn btn-sm btn-default hidden-xs" href="form-paginas.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-paginas.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<fieldset>
		<div class="form-group">
			<label for="titulo">Título</label>
			<input type="text" class="form-control input-sm" id="titulo" name="titulo" value="<?php echo ($query ? $query->titulo : $_POST['titulo']); ?>" />
		</div>
		<div class="form-group">
			<label for="permalink">Permalink</label>
			<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query ? $query->permalink : $_POST['permalink']); ?>" />
		</div>
		<div class="form-group">
			<label for="arquivo">Arquivo</label>
			<select class="form-control input-sm" name="arquivo" id="arquivo">
				<option value="">Selecione</option>
				<?php get_templates(($query ? $query->arquivo : $_POST['arquivo'])); ?>
			</select>
		</div>

		<div class="form-group">
			<label for="conteudo">Conteúdo</label>
			<textarea id="conteudo" name="conteudo" class="tinymce"><?php echo stripslashes( ($query ? $query->conteudo : $_POST['conteudo']) ); ?></textarea>
		</div>
		
		<h3>Configurações SEO</h3>

		<div class="form-group">
			<label for="keywords">Keywords</label>
			<input type="text" class="form-control input-sm" id="keywords" name="keywords" value="<?php echo ($query ? $query->keywords : $_POST['keywords']); ?>" />
			<div id="count"></div>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea class="form-control input-sm" id="description" name="description"><?php echo ($query ? $query->description : $_POST['description']); ?></textarea>
		</div>
		
		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
		<input type="hidden" name="cat_imagens" id="cat_imagens" value="" />
		<input type="hidden" name="tabela" id="tabela" value="paginas" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>