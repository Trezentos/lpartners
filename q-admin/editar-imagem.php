<?php 
require("config.php");
require(PHP.'classes/Class.imagem.php');

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) $query = $db->get_row("SELECT * FROM ".$tables[strtoupper($_GET['tabela'])]." WHERE id='{$id}'");

$imagem = new Image(ROOT_UPLOADS_IMG.'real_'.$query->arquivo);

if($_POST && isset($_POST['submit'])) {

	$x1 = $_POST['x1'];
	$y1 = $_POST['y1'];
	$x2 = $_POST['x2'];
	$y2 = $_POST['y2'];
	$w 	= $_POST['w'];
	$h 	= $_POST['h'];

	var_dump($_POST);

	$imagem->resize($w, $h, "crop", array( $x1, $x2 ), array( $y1, $y2 ));

	$name = explode('.', $query->arquivo);
	
	$imagem->save(ROOT_UPLOADS_IMG.'test/resize_'.$name[0]);

}

// DELETAR POST
if ($_POST && isset($_POST['deletar'])) {
	$db->query("DELETE FROM ".$tables['VAGAS']." WHERE id='{$_POST['id']}'");	
	header("Location: ".HTTP_GESTOR."list-vagas.php?del=ok");
}

// HEADERS
$_header['titulo'] = ($id?'Editar Imagem':'Editar Imagem');
$_header['icon'] = 'picture';

add_javascript(array("jquery.Jcrop.min.js","form.imagem.js"));
add_style(array("css/jquery.Jcrop.min.css"));

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
			<a class="btn btn-sm btn-default" title="voltar" href="form-empreendimento.php?id=<?php echo $_GET["idgal"] ?>"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<fieldset>
		<div class="row">
			<div class="col-md-8">
				<div id="img-editable">
					<img src="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$query->arquivo ?>" />
				</div>
				<div class="form-group">
					<label for="legenda">Legenda</label>
					<input type="text" class="form-control input-sm" id="legenda" name="legenda" value="<?php echo ($query ? $query->legenda : $_POST['legenda']) ?>" />
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="link">Link</label>
						<input type="text" class="form-control input-sm" id="link" name="link" value="<?php echo HTTP_UPLOADS_IMG.'800x600_'.$query->arquivo ?>" readonly onClick="this.select();" />
					</div>
					<div class="form-group col-md-6">
						<label for="ativo">Status</label>
						<select class="form-control input-sm" name="ativo" id="ativo">
							<option value="">Selecione</option>
							<?php echo get_status(($query ? $query->ativo : $_POST['ativo']), 'option'); ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="thumbnail">
						<h5>Redimensionar a imagem</h5>
						<div class="row">
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm" id="width" name="width" value="<?php echo ($imagem ? $imagem->getWidth() : false) ?>" />
							</div>
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm" id="height" name="height" value="<?php echo ($imagem ? $imagem->getHeight() : false) ?>" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="thumbnail">
					<h5>Recorte da imagem</h5>
					<div class="form-group">
						<label>Seleção</label>
						<div class="row">
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm" id="select-width" name="select-width" value="" />
							</div>
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm" id="select-height" name="select-height" value="" />
							</div>
						</div>
					</div>
				</div>
				<div class="thumbnail">
					<h5>Thumbnail</h5>
					<div class="form-group">
						<img src="<?php echo HTTP_UPLOADS_IMG.'tb_'.$query->arquivo ?>" />
						<div class="checkboxes">
							<div class="radio">
								<label>
									<input type="radio" name="aplicacao" checked> Aplicar a todas imagens
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aplicacao"> Somente a thumbnail
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="aplicacao"> Todas imagens exceto a thumbnail
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="x1" id="x1" />
		<input type="hidden" name="y1" id="y1" />
		<input type="hidden" name="x2" id="x2" />
		<input type="hidden" name="y2" id="y2" />
		<input type="hidden" name="w" id="w" />
		<input type="hidden" name="h" id="h" />
		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>