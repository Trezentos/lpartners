<?php 
require("config.php");
require(PHP.'classes/Class.paginacao.php');

$_header['titulo'] = 'Usuários';
$_header['icon']   = 'user';

if($_GET['id']) {
	$db->query("DELETE FROM ".$tables['USUARIOS']." WHERE id='{$_GET['id']}'");	
	$db->query("DELETE FROM ".$tables['ACESSOS']." WHERE id_usuario='{$_GET['id']}'");
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?del=ok");
}

if($_GET['del']=='ok') {
	$alertSucess = true;
	$alertMessage = 'Registro excluido com sucesso!';
}

$count = $db->get_var("SELECT COUNT(id) FROM ".$tables['USUARIOS']);

get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<a class="btn btn-sm btn-default" href="form-usuarios.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar novo</a>
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

	$query = $db->get_results("SELECT * FROM ".$tables['USUARIOS']." ORDER BY id ASC $navbar->limit");
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Nome Completo</th>
				<th>Usuário</th>
				<th>E-mail</th>
				<th>Categoria</th>
				<th>Último Acesso</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr>
				<td></td>
				<td><?php echo $rs->nome_completo ?></td>
				<td><?php echo $rs->usuario ?></td>
				<td><?php echo $rs->email ?></td>
				<td><?php echo get_user_cat($rs->categoria, 'value'); ?></td>
				<td><?php echo get_last_acess($rs->id) ?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-primary" href="form-usuarios.php?id=<?php echo $rs->id ?>" title="Editar" rel="tipsy"><span class="glyphicon glyphicon-edit"></span></a>
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
		<strong>Nenhum usuário existente</strong>
	</div>

<?php 
	} 
get_footer_gestor();
?>