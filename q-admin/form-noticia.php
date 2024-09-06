<?php
require("config.php");
// NOTÍCIA
if ($_POST && isset($_POST['submit']))
{

	if($_POST['url'])
	{
		$info_video  	= video_image(trim($_POST['url']));
		$video_servidor = $info_video['servidor'];
		$video_code  	= $info_video['codigo'];
		$video_thumb 	= $info_video['imagem'];
	}

	switch($_POST['action'])
	{

		case 'adicionar':
			require(PHP."classes/Class.validacao.php");

			$rules[] = "required,titulo_pt,Título";
			$rules[] = "required,permalink,Permalink";
			$rules[] = "required,status,Status";
			$rules[] = "required,data,Data";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_insert = array(
					'titulo_pt'		=> $_POST['titulo_pt'],
					'resumo_pt' 	=> addslashes($_POST['resumo_pt']),
					'conteudo_pt' 	=> addslashes($_POST['conteudo_pt']),
					'permalink' 	=> $_POST['permalink'],
					'status' 		=> $_POST['status'],
					'data' 			=> formatDate($_POST['data'],'reverse'),
					'categorias'	=> implode("-",$_POST['categorias']),
					'data_criacao' 	=> date("Y-m-d H:i:s"),
					'video_url' 	=> $video_code,
					'video_thumb'   => $video_thumb,
					'video_servidor'=> $video_servidor,
					'autor' 		=> $autor,
					'titulo_en'		=> addslashes($_POST['titulo_en']),
					'resumo_en' 	=> addslashes($_POST['resumo_en']),
					'conteudo_en' 	=> addslashes($_POST['conteudo_en']),
					'titulo_es'		=> addslashes($_POST['titulo_es']),
					'resumo_es' 	=> addslashes($_POST['resumo_es']),
					'conteudo_es' 	=> addslashes($_POST['conteudo_es']),
				);

				$insert = $db->insert($tables['NOTICIAS'],$array_insert);

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

			$rules[] = "required,titulo_pt,Título";
			$rules[] = "required,permalink,Permalink";
			$rules[] = "required,status,Status";
			$rules[] = "required,data,Data";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_update = array(
					'titulo_pt'		=> $_POST['titulo_pt'],
					'resumo_pt' 	=> addslashes($_POST['resumo_pt']),
					'conteudo_pt' 	=> addslashes($_POST['conteudo_pt']),
					'permalink' 	=> $_POST['permalink'],
					'status' 		=> $_POST['status'],
					'data' 			=> formatDate($_POST['data'],'reverse'),
					'categorias'	=> implode("-",$_POST['categorias']),
					'video_url' 	=> $video_code,
					'video_thumb' 	=> $video_thumb,
					'video_servidor'=> $video_servidor,
					'titulo_en'		=> $_POST['titulo_en'],
					'resumo_en' 	=> addslashes($_POST['resumo_en']),
					'conteudo_en' 	=> addslashes($_POST['conteudo_en']),
					'titulo_es'		=> $_POST['titulo_es'],
					'resumo_es' 	=> addslashes($_POST['resumo_es']),
					'conteudo_es' 	=> addslashes($_POST['conteudo_es']),
				);

				$update = $db->update($tables['NOTICIAS'],$array_update,array('id'=>$_POST['id']));

				$alertSucess 	= true;
				$alertMessage 	= 'Registro salvo com sucesso!';
			}
			break;
	}
}

// DELETAR POST
// if ($_POST && isset($_POST['deletar']))
// {
// 	$db->query("DELETE FROM ".$tables['NOTICIAS']." WHERE id='{$_POST['id']}'");
// 	header("Location: ".HTTP_GESTOR."list-noticias.php?del=ok");
// }

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) {
	$query = $db->get_row("SELECT * FROM ".$tables['NOTICIAS']." WHERE id='{$id}'");

	if( !empty($query->video_servidor) )
	{
		if($query->video_servidor == "vimeo")
		{
			$url  = "http://www.vimeo.com/".$query->video_url;
		}else{
			$url  = "http://www.youtube.com/watch?v=".$query->video_url;
		}
	}
}

// HEADERS
$_header['titulo'] = ($id?'Editar Post':'Novo Post');
$_header['icon']   = 'bullhorn';

add_javascript(array("jquery.lightbox.min.js","jquery.ui.widget.js","jquery.iframe-transport.js","jquery.fileupload.js","jquery.tinymce.js","jquery.rsv.js","bootstrap.tabdrop.js","script.imagens.js","script.textarea.js"));
add_style(array("css/tabdrop.css","css/lightbox.css"));

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
			<!-- <button class="btn btn-sm btn-default" type="submit" name="deletar"><span class="glyphicon glyphicon-trash"></span> Deletar</button> -->
			<?php if ($query) { ?>
			<a class="btn btn-sm btn-default hidden-xs" href="<?php echo HTTP.'noticia/'.$query->permalink; ?>/pt" title="Ver no site"><span class="glyphicon glyphicon-file"></span> Ver no site</a>
			<?php } ?>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default hidden-xs" href="form-noticia.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-noticias.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li <?php echo (isset($_POST) && $_POST['tab']==2 ? false : 'class="active"' ) ?>><a href="#tab1" data-toggle="tab">Geral</a></li>
		<li><a <?php echo ($query ? 'href="#tab3" data-toggle="tab"' : 'class="disable"' ) ?>>Inglês</a></li>
		<li><a <?php echo ($query ? 'href="#tab4" data-toggle="tab"' : 'class="disable"' ) ?>>Espanhol</a></li>
		<li><a <?php echo ($query ? 'href="#tab2" data-toggle="tab"' : 'class="disable"' ) ?>>Galeria de Imagens</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" <?php echo (isset($_POST['tab']) && $_POST['tab']=='2' ? 'class="tab-pane"' : 'class="tab-pane active"' ) ?>>
			<fieldset>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="titulo_pt">Título *</label>
						<input type="text" class="form-control input-sm" id="titulo" name="titulo_pt" value="<?php echo ($query ? $query->titulo_pt : $_POST['titulo_pt']); ?>" />
					</div>
					<div class="form-group col-md-6">
						<label for="permalink">Permalink *</label>
						<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query ? $query->permalink : $_POST['permalink']); ?>" />
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<label for="data">Data da Publicação *</label>
						<input type="text" class="form-control input-sm datepicker" id="data" name="data" value="<?php echo ($query ? ($query->data ? date("d/m/Y", strtotime($query->data) ) : false) : ($query->data ? date("d/m/Y", strtotime($_POST['data']) ) : false) ); ?>" />
					</div>
					<div class="form-group col-md-4">
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
						<label for="categorias">Categorias *</label>
						<br><br>
						<div class="categorias">
							<?php echo get_categorias_blog(($query?$query->categorias:$_POST['categorias'])); ?>
						</div>
						<br>
						<button class="btn btn-sm btn-default" type="button" onclick="document.location.href='list-blog-categorias.php'"><i class="fa fa-bars fa-fw"></i> Gerenciar Categorias</button>
					</div>
				</div>

				<div class="form-group">
					<label for="conteudo_pt">Conteúdo *</label>
					<textarea id="conteudo_pt" name="conteudo_pt" class="tinymce"><?php echo stripslashes( ($query ? $query->conteudo_pt : $_POST['conteudo_pt']) ); ?></textarea>
				</div>

				<div class="form-group">
					<label for="resumo_pt">Resumo *</label>
					<textarea id="resumo_pt" name="resumo_pt" class="form-control input-sm" rows="2"><?php echo stripslashes( ($query ? $query->resumo_pt : $_POST['resumo_pt']) ); ?></textarea>
				</div>

				<div class="row">
					<div class="form-group col-md-5">
						<label for="url">URL do Vídeo *</label>
						<input type="text" class="form-control input-sm" id="url" name="url" value="<?php echo ($url?$url:$_POST['url']);?>" />
						<span style="color: #888; font-size: 10px;">Apenas vídeos do YOUTUBE ou VIMEO</span>
					</div>
				</div>

				<?php
					if($query->video_url)
					{
						if($query->video_servidor == "vimeo")
						{
				?>
							<br><iframe src="http://player.vimeo.com/video/<?=$query->video_url?>" width="500" height="275" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><br><br>
				<?php
						}else{
				?>
							<br><iframe width="560" height="315" src="http://www.youtube.com/embed/<?=$query->video_url?>" frameborder="0" allowfullscreen></iframe><br><br>
				<?php
						}
					}
				?>


			</fieldset>
		</div>


		<div id="tab2" class="tab-pane">
			<div class="row">
				<div class="col-xs-12">
					<div id="buttons">
						<div class="row">
							<div class="col-xs-6">
								<button type="button" class="modal-btn btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-upload" data-categoria="noticia"><span class="glyphicon glyphicon-picture"></span> Inserir imagens</button>
								<a href="javascript:void(0)" class="del-imagem btn btn-sm btn-danger" data-categoria="noticia"><span class="glyphicon glyphicon-trash"></span> Apagar imagens</a>
							</div>
							<div class="col-xs-6">
								<div class="pull-right checkbox">
									<label>
										<input id="selecionar-todas" name="selecionar-todas" type="checkbox" value="noticia" /> Selecionar todas
									</label>
								</div>
							</div>
						</div>
					</div>
					<div id="lista-imagens" class="noticia row"><?php echo get_thumbs($query->id, 'noticias_img', HTTP_UPLOADS_IMG, 'noticia') ?></div>
				</div>
			</div>
		</div>


		<div id="tab3" class="tab-pane">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="titulo_en">Título *</label>
						<input type="text" class="form-control input-sm" id="titulo_en" name="titulo_en" value="<?php echo ($query?$query->titulo_en:$_POST['titulo_en']);?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="resumo_en">Resumo *</label>
					<textarea id="resumo_en" name="resumo_en" class="form-control input-sm" rows="2"><?php echo stripslashes( ($query ? $query->resumo_en : $_POST['resumo_en']) ); ?></textarea>
				</div>
				<div class="form-group">
					<label for="conteudo_en">Conteúdo *</label>
					<textarea id="conteudo_en" name="conteudo_en" class="tinymce"><?php echo stripslashes( ($query ? $query->conteudo_en : $_POST['conteudo_en']) ); ?></textarea>
				</div>
			</fieldset>
		</div>


		<div id="tab4" class="tab-pane">
			<fieldset>
				<div class="row">
					<div class="form-group col-md-12">
						<label for="titulo_es">Título *</label>
						<input type="text" class="form-control input-sm" id="titulo_es" name="titulo_es" value="<?php echo ($query?$query->titulo_es:$_POST['titulo_es']);?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="resumo_es">Resumo *</label>
					<textarea id="resumo_es" name="resumo_es" class="form-control input-sm" rows="2"><?php echo stripslashes( ($query ? $query->resumo_es : $_POST['resumo_es']) ); ?></textarea>
				</div>
				<div class="form-group">
					<label for="conteudo_es">Conteúdo *</label>
					<textarea id="conteudo_es" name="conteudo_es" class="tinymce"><?php echo stripslashes( ($query ? $query->conteudo_es : $_POST['conteudo_es']) ); ?></textarea>
				</div>
			</fieldset>
		</div>


	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	<input type="hidden" name="cat_imagens" id="cat_imagens" value="noticia" />
	<input type="hidden" name="tabela" id="tabela" value="noticias" />
	<input type="hidden" name="tabela_img" id="tabela_img" value="noticias_img" />
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
						<input type="hidden" name="tabela_img" id="tabela_img" value="noticias_img" />
						<input type="hidden" name="action" id="action" value="set_legenda" />
					</div>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer_gestor(); ?>