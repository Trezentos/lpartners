<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');


if($_GET['id']) {
	$db->query("DELETE FROM ".$tables['BLOG_CATEGORIAS']." WHERE id='{$_GET['id']}'");	
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}

if($_GET['del']=='ok') {
	$alertSucess = true;
	$alerMessage = 'Registro excluido com sucesso!';
}

$count = $db->get_var("SELECT COUNT(id) FROM ".$tables['BLOG_CATEGORIAS']);

// HEADERS
$_header['titulo'] = 'Blog / Categorias';
$_header['icon']   = 'folder-open';

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-left" style="float:left;">
		<a class="btn btn-sm btn-default" title="voltar" href="list-noticias.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar para Blog</a>
	</div>
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-blog-categorias.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar</a>
	</div>
</div>


<?php  if($count>0) {
	//Paginator
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 9;
	$navbar->items_per_page = 30;
	$navbar->paginate();

	$query = $db->get_results("SELECT * FROM ".$tables['BLOG_CATEGORIAS']." ORDER BY id DESC $navbar->limit");
?>

	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th data-sorter="false"></th>
					<th>Título Português</th>
					<th>Título Inglês</th>
					<th>Título Espanhol</th>
					<th>Permalink</th>
					<th class="text-center" data-sorter="false">Ações</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($query as $rs) { ?>
				<tr>
					<td></td>
					<td><?php echo $rs->categoria_pt?></td>
					<td><?php echo $rs->categoria_en?></td>
					<td><?php echo $rs->categoria_es?></td>
					<td><?php echo $rs->permalink?></td>
					<td class="text-center">
						<a class="btn btn-sm btn-primary" href="form-blog-categorias.php?id=<?php echo $rs->id?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
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