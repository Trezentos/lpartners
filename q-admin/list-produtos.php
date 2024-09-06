<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');

// DELETAR REGISTRO
if($_GET['id']) {
	// IMAGENS
	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS_IMG']." WHERE id_galeria='{$_GET['id']}'");
	
	// Deletando arquivo
	foreach ($query AS $rs) {
		@unlink(HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'800x600_'.$rs->arquivo);

		@unlink(HTTP_UPLOADS_IMG.'tb_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'tb_'.$rs->arquivo);
	}

	$db->query("DELETE FROM ".$tables['PRODUTOS_IMG']." WHERE id_galeria='{$_GET['id']}'");

	$db->query("DELETE FROM ".$tables['PRODUTOS']." WHERE id='{$_GET['id']}'");	
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}
if($_GET['del']=='ok') {
	$alertSucess  = true;
	$alertMessage = 'Registro excluido com sucesso!';
}

$WHERE = "";

// FILTROS
if (!$_GET['del'] && !$_GET['id'] && $_GET != NULL) {
	$WHERE .= ($_GET["titulo"] ? "AND titulo_pt LIKE '%".$_GET["titulo"]."%'":"");
	$WHERE .= ($_GET["id_grupo"]!=NULL ? "AND id_grupo = '".$_GET["id_grupo"]."'":"");
	$WHERE .= ($_GET["status"]!=NULL ? "AND status = '".$_GET["status"]."'":"");

	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['PRODUTOS']." WHERE id IS NOT NULL ".$WHERE);
} else {
	$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['PRODUTOS']);
}


// HEADERS
$_header['titulo'] = 'Produtos';
$_header['icon']   = 'briefcase';

add_javascript(array("script.order.js"));
get_header_gestor();
get_barra_header();
?>

<div class="alert alert-warning"></div>
<div class="alert alert-success"></div>

<div id="buttons">
	<div class="text-left" style="float: left; margin-top: 8px; margin-left: 10px; ">
		Total de Registro(s): <?=$count;?>
	</div>
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-produtos.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
		<a class="btn btn-sm btn-default" href="list-produtos-categorias.php" title="Gerenciar Categorias"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Gerenciar Categorias</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<form id="filtro" name="form" action="" method="get" enctype="multipart/form-data">
			<fieldset>
				<div class="form-group col-xs-12 col-sm-6 col-md-3">
					<label for="titulo">Produto</label>
					<input type="text" class="form-control input-sm" id="titulo" name="titulo" value="<?php echo $_GET['titulo'];?>" />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-2">
					<label for="id_grupo">Categoria</label>
					<select name="id_grupo" id="id_grupo" class="form-control input-sm">
						<option value="">Selecione</option>
						<?php echo get_combo_grupo(($_GET ? $_GET['id_grupo'] : false), 'options'); ?>
					</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-2">
					<label for="status">Status</label>
					<select name="status" id="status" class="form-control input-sm">
						<option value="">Selecione</option>
						<?php echo get_status(($_GET ? $_GET['status'] : false), 'options'); ?>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-2">
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

	$query = $db->get_results("SELECT * FROM ".$tables['PRODUTOS']." WHERE id IS NOT NULL $WHERE ORDER BY ordem ASC $navbar->limit");

	// $db->debug();
?>

<input type="hidden" name="tabela" id="tabela" value="produtos" />

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Título PT</th>
				<th>Título EN</th>
				<th>Título ES</th>
				<th>Categoria</th>
				<th>Destaque</th>
				<th>Status</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr id="<?php echo $rs->id; ?>" class="ui-state-default">
				<td><?php echo $rs->titulo_pt; ?></td>
				<td><?php echo $rs->titulo_en; ?></td>
				<td><?php echo $rs->titulo_es; ?></td>
				<td><?php echo get_name_grupo_simples($rs->id_grupo); ?></td>
				<td><?php echo get_status($rs->destaque); ?></td>
				<td><?php echo get_status($rs->status); ?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-produtos.php?id=<?php echo $rs->id; ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-sm btn-danger deletar" href="<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME) ?>?id=<?php echo $rs->id;?>" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>
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