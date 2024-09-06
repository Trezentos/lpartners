<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');

$_header['titulo'] = 'Páginas';
$_header['icon'] = 'file';

if($_GET['id']) {
	$db->query("DELETE FROM ".$tables['PAGINAS']." WHERE id='{$_GET['id']}'");	
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}

if($_GET['del']=='ok') {
	$alertSucess = true;
	$alertMessage = 'Registro excluido com sucesso!';
}

$count = $db->get_var("SELECT COUNT(id) FROM ".$tables['PAGINAS']);

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-paginas.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar novo</a>
	</div>
</div>

<?php
if($count>0) { 
	//Paginator
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 9;
	$navbar->items_per_page = 30;
	$navbar->paginate();

	$query = $db->get_results("SELECT * FROM ".$tables['PAGINAS']." ORDER BY titulo ASC $navbar->limit");
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Título</th>
				<th>Permalink</th>
				<th>Template</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr>
				<td></td>
				<td><?php echo $rs->titulo ?></td>
				<td><?php echo $rs->permalink ?></td>
				<td><?php echo ($rs->arquivo?$rs->arquivo:'Padrão') ?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-paginas.php?id=<?php echo $rs->id ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-sm btn-danger" href="<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME) ?>?id=<?php echo $rs->id ?>" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>
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
		<strong>Nenhuma página existente</strong>
	</div>

<?php 
	} 
get_footer_gestor();
?>