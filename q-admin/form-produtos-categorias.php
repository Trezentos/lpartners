<?php 
require("config.php");

// NOTÍCIA
if ($_POST && isset($_POST['submit']))
{
	switch($_POST['action'])
	{

		case 'adicionar':
			require(PHP."classes/Class.validacao.php");
		
			$rules[] = "required,titulo_pt,Título PT";
			$rules[] = "required,titulo_en,Título EN";
			$rules[] = "required,titulo_es,Título ES";
			
			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_insert = array(
					'titulo_pt'=>$_POST['titulo_pt'],
					'titulo_en'=>$_POST['titulo_en'],
					'titulo_es'=>$_POST['titulo_es'],
					'permalink'=>$_POST['permalink'],
				);

				$insert = $db->insert($tables['PRODUTOS_CATEGORIAS'],$array_insert);
				
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
			
			$rules[] = "required,titulo_pt,Título PT";
			$rules[] = "required,titulo_en,Título EN";
			$rules[] = "required,titulo_es,Título ES";
			
			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_update = array(
					'titulo_pt'=>$_POST['titulo_pt'],
					'titulo_en'=>$_POST['titulo_en'],
					'titulo_es'=>$_POST['titulo_es'],
					'permalink'=>$_POST['permalink'],
				);

				$update = $db->update($tables['PRODUTOS_CATEGORIAS'],$array_update,array('id'=>$_POST['id']));

				$alertSucess 	= true;
				$alertMessage 	= 'Registro salvo com sucesso!';
			}
		break;
	}

}

// DELETAR POST
if ($_POST && isset($_POST['deletar']))
{
	$db->query("DELETE FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$_POST['id']}'");	
	header("Location: ".HTTP_GESTOR."list-produtos_categorias.php?del=ok");
}


// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) {
	$query = $db->get_row("SELECT * FROM ".$tables['PRODUTOS_CATEGORIAS']." WHERE id='{$id}'");
}

// HEADERS
$_header['titulo'] = ($id?'Editar Categoria':'Nova Categoria');
$_header['icon']   = 'folder-open';

add_javascript(array("jquery.ui.widget.js","jquery.tinymce.js","jquery.rsv.js"));

get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
			<button class="btn btn-sm btn-default" type="submit" name="deletar"><span class="glyphicon glyphicon-trash"></span> Deletar</button>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default hidden-xs" href="form-produtos-categorias.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-produtos-categorias.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li <?php echo (isset($_POST) && $_POST['tab']==2 ? false : 'class="active"' ) ?>><a href="#tab1" data-toggle="tab">Geral</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" class="tab-pane active">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="titulo_pt">Título PT *</label>
						<input type="text" class="form-control input-sm" id="titulo" name="titulo_pt" value="<?php echo ($query ? $query->titulo_pt : $_POST['titulo_pt']); ?>" />
					</div>
					<div class="form-group col-md-4">
						<label for="titulo_en">Título EN *</label>
						<input type="text" class="form-control input-sm" id="titulo_en" name="titulo_en" value="<?php echo ($query ? $query->titulo_en : $_POST['titulo_en']); ?>" />
					</div>
					<div class="form-group col-md-4">
						<label for="titulo_es">Título ES *</label>
						<input type="text" class="form-control input-sm" id="titulo_es" name="titulo_es" value="<?php echo ($query ? $query->titulo_es : $_POST['titulo_es']); ?>" />
					</div>
					<div class="form-group col-md-4">
						<label>Permanlink *</label>
						<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query ? $query->permalink : $_POST['permalink']); ?>" />
					</div>
				</div>
			</fieldset>
		</div>

	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
</form>

<?php get_footer_gestor(); ?>