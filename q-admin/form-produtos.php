<?php
require("config.php");

// NOTÍCIA
if ($_POST && isset($_POST['submit']))
{

	switch($_POST['action'])
	{

		case 'adicionar':
			require(PHP."classes/Class.validacao.php");

			$rules[] = "required,titulo_pt,Título";
			$rules[] = "required,permalink,Permalink";
			$rules[] = "required,id_grupo,Categoria";
			$rules[] = "required,status,Status";

			$errors = validateFields($_POST, $rules);

			if (empty($errors))
			{

				$array_insert = array(
					'titulo_pt'=>$_POST['titulo_pt'],
					'titulo_en'=>$_POST['titulo_en'],
					'titulo_es'=>$_POST['titulo_es'],
					'permalink'=>$_POST['permalink'],
					'id_grupo'=>$_POST['id_grupo'],
					'descricao_pt'=>addslashes($_POST['descricao_pt']),
					'descricao_en'=>addslashes($_POST['descricao_en']),
					'descricao_es'=>addslashes($_POST['descricao_es']),
					'status'=>$_POST['status'],
					'destaque'=>$_POST['destaque'],
					'data_criacao' => date("Y-m-d H:i:s")
				);

				$insert = $db->insert($tables['PRODUTOS'],$array_insert);


				if($insert)
				{
					$alertSucess 	= true;
					$alertMessage 	= 'Registro salvo com sucesso!';
					$_POST['id'] 	= $db->lastInserId();
					$ultimoId 		= $db->lastInserId();

					// INSERE OS ATRIBUTOS PARA O PRODUTO
					foreach ($_POST["atributos"] as $id_legenda => $valor)
					{
						$array_insert = array('id_legenda'=>$id_legenda, 'id_produto'=>$ultimoId, 'valor'=>"");
						$insert = $db->insert($tables['PRODUTOS_ATRIBUTOS'], $array_insert);
					}
				} else {
					$alertFail 		= true;
					$alertMessage 	= 'Não foi possível salvar o registro!';
				}
			}
			break;

		case 'alterar':
			require(PHP."classes/Class.validacao.php");

			$rules[] = "required,titulo_pt,Título";
			$rules[] = "required,permalink,Permalink";
			$rules[] = "required,id_grupo,Categoria";
			$rules[] = "required,status,Status";

			$errors = validateFields($_POST, $rules);

			if (empty($errors))
			{
				$array_update = array();

				$array_update += array(
					'titulo_pt'=>$_POST['titulo_pt'],
					'titulo_en'=>$_POST['titulo_en'],
					'titulo_es'=>$_POST['titulo_es'],
					'permalink'=>$_POST['permalink'],
					'id_grupo'=>$_POST['id_grupo'],
					'descricao_pt'=>addslashes($_POST['descricao_pt']),
					'descricao_en'=>addslashes($_POST['descricao_en']),
					'descricao_es'=>addslashes($_POST['descricao_es']),
					'status'=>$_POST['status'],
					'destaque'=> $_POST['destaque'],
				);

				$update = $db->update($tables['PRODUTOS'], $array_update,array('id'=>$_POST['id']));

				//$db->debug();

				$alertSucess  = true;
				$alertMessage = 'Registro salvo com sucesso!';
			}
			break;
	}
}

// DELETAR POST
if ($_POST && isset($_POST['deletar']))
{
	$db->query("DELETE FROM ".$tables['PRODUTOS']." WHERE id='{$_POST['id']}'");
	header("Location: ".HTTP_GESTOR."list-produtos.php?del=ok");
}

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}


if($id){
	$query = $db->get_row("SELECT * FROM ".$tables['PRODUTOS']." WHERE id='{$id}'");
}


// HEADERS
$_header['titulo'] = ($id?'Editar Produto':'Novo Produto');
$_header['icon']   = 'briefcase';

add_javascript(array("jquery.lightbox.min.js","jquery.ui.widget.js","jquery.iframe-transport.js","jquery.fileupload.js","jquery.tinymce.js","jquery.rsv.js","bootstrap.tabdrop.js","script.imagens.js","script.textarea.js"));
add_style(array("css/tabdrop.css","css/lightbox.css"));

get_header_gestor();
get_barra_header();
?>


<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
			<button class="btn btn-sm btn-default" type="submit" name="deletar"><span class="glyphicon glyphicon-trash"></span> Deletar</button>
			<?php if ($query) { ?>
			<a class="btn btn-sm btn-default hidden-xs" href="<?php echo HTTP.'produto/'.$query->permalink; ?>" title="Ver no site"><span class="glyphicon glyphicon-file"></span> Ver no site</a>
			<?php } ?>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default hidden-xs" href="list-produtos-categorias.php" title="Gerenciar Categorias"><span class="glyphicon glyphicon-folder-open"></span>&nbsp; Gerenciar Categorias</a>
			<a class="btn btn-sm btn-default hidden-xs" href="form-produtos.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
			<a class="btn btn-sm btn-default" title="Voltar" href="list-produtos.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li <?php echo ($_REQUEST['tab']==""?'class="active"':'') ?>><a href="#tab1" data-toggle="tab">Geral</a></li>
		<li><a <?php echo ($query ? 'href="#tab3" data-toggle="tab"' : 'class="disable"' ) ?>>Inglês</a></li>
		<li><a <?php echo ($query ? 'href="#tab4" data-toggle="tab"' : 'class="disable"' ) ?>>Espanhol</a></li>
		<li <?php echo ($_REQUEST['tab']=="2"?'class="active"':'') ?>><a <?php echo ($query ? 'href="#tab2" data-toggle="tab"' : 'class="disable"' ) ?>>Galeria de Imagens</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" <?php echo ($_REQUEST['tab']==''?'class="tab-pane active"':'class="tab-pane"') ?>>
			<fieldset>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="titulo_pt">Nome *</label>
						<input type="text" class="form-control input-sm" id="titulo" name="titulo_pt" value="<?php echo ($query?$query->titulo_pt:$_POST['titulo_pt']);?>" />
					</div>
					<div class="form-group col-md-6">
						<label for="permalink">Permalink *</label>
						<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query?$query->permalink:$_POST['permalink']); ?>" />
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="id_grupo">Categoria *</label>
						<select class="form-control input-sm" name="id_grupo" id="id_grupo">
							<option value="">Selecione</option>
							<?php echo get_combo_grupo(($query?$query->id_grupo:false)); ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="status">Status *</label>
						<select class="form-control input-sm" name="status" id="status">
							<option value="">Selecione</option>
							<?php echo get_status(($query?$query->status:$_POST['status']),'option'); ?>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="status">Destaque *</label>
						<select class="form-control input-sm" name="destaque" id="destaque">
							<option value="">Selecione</option>
							<?php echo get_destaque(($query?$query->destaque:$_POST['destaque'])); ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="descricao_pt">Descrição</label>
					<textarea id="descricao_pt" name="descricao_pt" class="tinymce"><?php echo stripslashes(($query?$query->descricao_pt:$_POST['descricao_pt']));?></textarea>
				</div>

			</fieldset>
		</div>


		<div id="tab2" class="tab-pane">
			<div class="row">
				<div class="col-xs-12">
					<div id="buttons">
						<div class="row">
							<div class="col-xs-6">
								<button type="button" class="modal-btn btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-upload" data-categoria="produtos"><span class="glyphicon glyphicon-picture"></span> Inserir imagens</button>
								<a href="javascript:void(0)" class="del-imagem btn btn-sm btn-danger" data-categoria="produtos"><span class="glyphicon glyphicon-trash"></span> Apagar imagens</a>
							</div>
							<div class="col-xs-6">
								<div class="pull-right checkbox">
									<label>
										<input id="selecionar-todas" name="selecionar-todas" type="checkbox" value="produtos" /> Selecionar todas
									</label>
								</div>
							</div>
						</div>
					</div>
					<div id="lista-imagens" class="produtos row"><?php echo get_thumbs($query->id, 'produtos_img', HTTP_UPLOADS_IMG, 'produtos') ?></div>
				</div>
			</div>
		</div>


		<div id="tab3" class="tab-pane">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="titulo_en">Nome *</label>
						<input type="text" class="form-control input-sm" id="titulo_en" name="titulo_en" value="<?php echo ($query?$query->titulo_en:$_POST['titulo_en']);?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="descricao_en">Descrição</label>
					<textarea id="descricao_en" name="descricao_en" class="tinymce"><?php echo stripslashes(($query?$query->descricao_en:$_POST['descricao_en']));?></textarea>
				</div>
			</fieldset>
		</div>


		<div id="tab4" class="tab-pane">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="titulo_es">Nome *</label>
						<input type="text" class="form-control input-sm" id="titulo_es" name="titulo_es" value="<?php echo ($query?$query->titulo_es:$_POST['titulo_es']);?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="descricao_es">Descrição</label>
					<textarea id="descricao_es" name="descricao_es" class="tinymce"><?php echo stripslashes(($query?$query->descricao_es:$_POST['descricao_es']));?></textarea>
				</div>
			</fieldset>
		</div>


	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	<input type="hidden" name="cat_imagens" id="cat_imagens" value="produtos" />
	<input type="hidden" name="tabela" id="tabela" value="produtos" />
	<input type="hidden" name="tabela_img" id="tabela_img" value="produtos_img" />
</form>

<!--/MODAL UPLOAD/-->
<div id="modal-upload" class="modal fade bs-example-modal-lg">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Inserir imagens</h4>
			</div>
			<div class="modal-body">
				<form id="upload" method="post" action="" enctype="multipart/form-data">
					<div id="drop">
						<div class="center">
							<p>Solte as imagens em qualquer lugar para fazer o upload</p>
							<a class="btn btn-lg btn-default">Selecionar arquivos</a>
							<input type="file" name="file" multiple />
						</div>
					</div>
					<ul class="list-group">

					</ul>
				</form>
			</div>
		</div>
	</div>
</div>

<!--/MODAL LEGENDA/-->
<div id="modal-legenda" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Legenda</h4>
			</div>
			<div class="modal-body">
				<form id="form-legenda" method="post" action="" >
					<div class="form-group">
						<label class="sr-only" for="legenda">Legenda</label>
						<input class="form-control" type="text" name="legenda" id="legenda" />
						<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
						<input type="hidden" name="id_img" value="" />
						<input type="hidden" name="tabela_img" id="tabela_img" value="produtos_img" />
						<input type="hidden" name="action" id="action" value="set_legenda" />
					</div>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer_gestor(); ?>