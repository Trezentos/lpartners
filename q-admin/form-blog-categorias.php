<?php 
require("config.php");

// NOTÍCIA
if ($_POST && isset($_POST['submit']))
{
	switch($_POST['action'])
	{

		case 'adicionar':
			require(PHP."classes/Class.validacao.php");
		
			$rules[] = "required,categoria_pt,Categoria_Pt";
			$rules[] = "required,permalink,Permalink";
			
			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_insert = array(
					'categoria_pt'	=> $_POST['categoria_pt'],
					'categoria_en'	=> $_POST['categoria_en'],
					'categoria_es'	=> $_POST['categoria_es'],
					'permalink' 	=> $_POST['permalink'],
				);

				$insert = $db->insert($tables['BLOG_CATEGORIAS'],$array_insert);
				
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
			
			$rules[] = "required,categoria_pt,Categoria_Pt";
			$rules[] = "required,permalink,Permalink";
			
			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_update = array(
					'categoria_pt'	=> $_POST['categoria_pt'],
					'categoria_en'	=> $_POST['categoria_en'],
					'categoria_es'	=> $_POST['categoria_es'],
					'permalink' 	=> $_POST['permalink'],
				);

				$update = $db->update($tables['BLOG_CATEGORIAS'],$array_update,array('id'=>$_POST['id']));

				$alertSucess 	= true;
				$alertMessage 	= 'Registro salvo com sucesso!';
			}
			break;
	}
}

// DELETAR POST
if ($_POST && isset($_POST['deletar']))
{
	$db->query("DELETE FROM ".$tables['BLOG_CATEGORIAS']." WHERE id='{$_POST['id']}'");	
	header("Location: ".HTTP_GESTOR."list-blog_categorias.php?del=ok");
}

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) {
	$query = $db->get_row("SELECT * FROM ".$tables['BLOG_CATEGORIAS']." WHERE id='{$id}'");
}

// HEADERS
$_header['titulo'] = ($id?'Editar Categoria':'Nova Categoria');
$_header['icon']   = 'folder-open';

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
			<a class="btn btn-sm btn-default hidden-xs" href="form-blog-categorias.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-blog-categorias.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">Geral</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-3">
						<label for="categoria">Categoria *</label>
						<input type="text" class="form-control input-sm" id="titulo" name="categoria_pt" value="<?php echo ($query ? $query->categoria_pt : $_POST['categoria_pt']); ?>" />
					</div>
					<div class="form-group col-md-3">
						<label for="categoria">Categoria Inglês</label>
						<input type="text" class="form-control input-sm" id="titulo" name="categoria_en" value="<?php echo ($query ? $query->categoria_en : $_POST['categoria_en']); ?>" />
					</div>
					<div class="form-group col-md-3">
						<label for="categoria">Categoria Espanhol</label>
						<input type="text" class="form-control input-sm" id="titulo" name="categoria_es" value="<?php echo ($query ? $query->categoria_es : $_POST['categoria_es']); ?>" />
					</div>
					<div class="form-group col-md-3">
						<label for="permalink">Permalink *</label>
						<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query ? $query->permalink : $_POST['permalink']); ?>" />
					</div>
				</div>
			</fieldset>
		</div>
	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	<input type="hidden" name="tabela" id="tabela" value="noticias" />
</form>

<?php get_footer_gestor(); ?>