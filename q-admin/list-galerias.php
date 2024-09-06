<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');

// DELETAR REGISTRO
if($_GET['id']) {
	// IMAGENS
	$query = $db->get_results("SELECT id, arquivo FROM ".$tables['GALERIAS_IMG']." WHERE id_galeria='{$_GET['id']}'");
	
	// Deletando arquivo
	foreach ($query AS $rs) {
		@unlink(HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'800x600_'.$rs->arquivo);

		@unlink(HTTP_UPLOADS_IMG.'tb_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'tb_'.$rs->arquivo);
	}
	$db->query("DELETE FROM ".$tables['GALERIAS_IMG']." WHERE id_galeria='{$_GET['id']}'");

	// Deletando registro
	$db->query("DELETE FROM ".$tables['GALERIAS']." WHERE id='{$_GET['id']}'");	
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}
if($_GET['del']=='ok') {
	$alertSucess  = true;
	$alertMessage = 'Registro excluido com sucesso!';
}

// FILTROS
if (!$_GET['del'] && !$_GET['id'] && $_GET != NULL) {
	$mes		= ($_GET["mes"] ? "AND data LIKE '%-".$_GET["mes"]."-%'" : false );
	$status 	= ($_GET["status"]!=NULL ? "AND status = '".$_GET["status"]."'" : false );

	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['GALERIAS']." WHERE id IS NOT NULL AND categoria='empresa' ".$mes." ".$status);
} else {
	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['GALERIAS']." WHERE categoria='empresa'");
}

// LIMPAR FILTROS
if ($_GET['limpar']) {
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME));
}

// COUNT
$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['GALERIAS']);

// HEADERS
$_header['titulo'] = 'Galerias';
$_header['icon']   = 'picture';

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-galeria.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<form id="filtro" name="form" action="" method="get" enctype="multipart/form-data">
			<fieldset>
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="mes">Mês</label>
					<select name="mes" id="mes" class="form-control input-sm">
						<option value="">Selecione</option>
						<?php echo get_mes(($_GET ? $_GET['mes'] : false), 'options'); ?>
					</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="status">Status</label>
					<select name="status" id="status" class="form-control input-sm">
						<option value="">Selecione</option>
						<?php echo get_status(($_GET ? $_GET['status'] : false), 'options'); ?>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<button type="submit" class="btn btn-sm btn-primary">Buscar</button>
					<button type="submit" class="btn btn-sm btn-danger" name="limpar" value="1">Limpar</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<?php
if ($count>0) {
	// PAGINACAO
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 9;
	$navbar->items_per_page = 30;
	$navbar->paginate();

	// FILTROS
	if (!$_GET['del'] && !$_GET['id'] && $_GET != NULL) {
		$query = $db->get_results("SELECT * FROM ".$tables['GALERIAS']." WHERE id IS NOT NULL AND categoria='empresa' 
																				".$mes."
																				".$status." ORDER BY data DESC $navbar->limit");
	} else {
		$query = $db->get_results("SELECT * FROM ".$tables['GALERIAS']." WHERE categoria='empresa' ORDER BY data DESC $navbar->limit");
	}
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Título</th>
				<th>Data</th>
				<th>Status</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr>
				<td></td>
				<td><?php echo $rs->titulo ?></td>
				<td><?php echo date("d/m/Y", strtotime($rs->data)) ?></td>
				<td><?php echo get_status($rs->status) ?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-galeria.php?id=<?php echo $rs->id ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-sm btn-danger deletar" href="<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME) ?>?id=<?php echo $rs->id ?>" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php
	echo ($query != '' && $navbar->num_pages>1 ) ? $navbar->display_pages() : '';
} else {
?>

	<div class="alert alert-warning show">
		<strong>Nenhum registro existente</strong>
	</div>

<?php 
	} 
get_footer_gestor();
?>