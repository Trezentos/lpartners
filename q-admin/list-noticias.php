<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');

// DELETAR REGISTRO
if($_GET['id']) {
	// IMAGENS
	$query = $db->get_results("SELECT id, arquivo FROM ".$tables['NOTICIAS_IMG']." WHERE id_galeria='{$_GET['id']}'");
	
	// Deletando arquivo
	foreach ($query AS $rs) {
		@unlink(HTTP_UPLOADS_IMG.'800x600_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'800x600_'.$rs->arquivo);

		@unlink(HTTP_UPLOADS_IMG.'tb_'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'tb_'.$rs->arquivo);
	}
	$db->query("DELETE FROM ".$tables['NOTICIAS_IMG']." WHERE id_galeria='{$_GET['id']}'");
	
	$db->query("DELETE FROM ".$tables['NOTICIAS']." WHERE id='{$_GET['id']}'");	
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}
if($_GET['del']=='ok') {
	$alertSucess  = true;
	$alertMessage = 'Registro excluído com sucesso!';
}

// COUNT
$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['NOTICIAS']);

// HEADERS
$_header['titulo'] = 'Blog';
$_header['icon']   = 'bullhorn';

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="list-blog-categorias.php" title="Adicionar Categorias"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Gerenciar Categorias</a>
		<a class="btn btn-sm btn-default" href="form-noticia.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar Novo</a>
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

	$query = $db->get_results("SELECT * FROM ".$tables['NOTICIAS']." ORDER BY data_criacao DESC $navbar->limit");

	// $db->debug();
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Título</th>
				<th>Categoria</th>
				<th>Data da Publicação</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<?php $cat = $db->get_var("SELECT categoria_pt FROM ".$tables['BLOG_CATEGORIAS']." WHERE id = '{$rs->categorias}'"); ?>
			<tr>
				<td></td>
				<td><?php echo $rs->titulo_pt; ?></td>
				<td><?php echo $cat != '' ? $cat : ''; ?></td>
				<td><?php echo date("d/m/Y",strtotime($rs->data)).'<br>'.get_status($rs->status); ?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-noticia.php?id=<?php echo $rs->id; ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-sm btn-danger deletar" href="<?php echo pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME); ?>?id=<?php echo $rs->id; ?>" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>
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