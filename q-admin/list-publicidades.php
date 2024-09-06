<?php
require("config.php");
require(PHP.'classes/Class.paginacao.php');

// DELETAR REGISTRO
if($_GET['id']) {
	$db->query("DELETE FROM ".$tables['PUBLICIDADES']." WHERE id='{$_GET['id']}'");
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}
if($_GET['del']=='ok'){
	$alertSucess  = true;
	$alertMessage = 'Registro excluído com sucesso!';
}

$count = $db->get_var("SELECT COUNT(id) FROM ".$tables['PUBLICIDADES']);

// HEADERS
$_header['titulo'] = 'Publicidades';
$_header['icon']   = 'picture';

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-publicidades.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
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

	$query = $db->get_results("SELECT * FROM ".$tables['PUBLICIDADES']." ORDER BY id DESC $navbar->limit");
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Título</th>
				<th>Link</th>
				<th>Status</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr>
				<td></td>
				<td><?php echo $rs->titulo; ?></a></td>
				<td><?php echo ($rs->link ? $rs->link:false); ?></a></td>
				<td><?php echo get_status($rs->status); ?></a></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-publicidades.php?id=<?php echo $rs->id; ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-sm btn-danger" href="<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME); ?>?id=<?php echo $rs->id; ?>" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>
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