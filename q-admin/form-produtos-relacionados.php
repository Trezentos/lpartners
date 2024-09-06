<?php 
require("config.php");

if($_POST && isset($_POST['submit']))
{
	require(PHP."classes/Class.validacao.php");

	if(count($_POST['produtos'])==0) $rules[] = "required,produtos,Selecione pelo menos um produto!";

	$errors = validateFields($_POST, $rules);
	if (empty($errors))
	{
		foreach ($_POST['produtos'] as $key => $value)
		{
			$count = $db->get_var("SELECT COUNT(*) FROM ".$tables['PRODUTOS_RELACIONADOS']." WHERE pai_id='{$_POST["id"]}' AND filho_id='{$value}'");
			//$db->debug();

			if($count > 0){
				//echo "assistencia ja add -> " . $value . "<br>";
			}
			else
			{
				$array_insert = array('pai_id'=>$_POST['id'], 'filho_id' => $value);
				$insert = $db->insert($tables['PRODUTOS_RELACIONADOS'],$array_insert);
			}
		}

		$alertSucess  = true;
		$alertMessage = 'Produtos Relacionados Atualizados!';
	}
}


// SETANDO ID
if ($_POST['id']){
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) $query = $db->get_row("SELECT * FROM ".$tables['PRODUTOS']." WHERE id='{$id}'");



$WHERE = "";

if($_GET["grupo"])
{
	if(is_numeric($_GET["grupo"])){
		$WHERE .= " AND id_grupo = '{$_GET["grupo"]}'";
	}
}


// PRODUTOS
$qProdutos = $db->get_results("SELECT id, titulo, id_grupo FROM ".$tables['PRODUTOS']." WHERE id <> '{$id}' {$WHERE}");

// PRODUTOS RELACIONADOS
$count = $db->get_var("SELECT COUNT(pai_id) FROM ".$tables['PRODUTOS_RELACIONADOS']." WHERE pai_id='{$id}'");

$arrayAss = $db->get_results("SELECT filho_id AS id FROM ".$tables['PRODUTOS_RELACIONADOS']." WHERE pai_id='{$id}'");

foreach ($arrayAss as $ass) {
	$array_ass[] = $ass->id;
}


// HEADERS
$_header['titulo'] = "Produtos > Produtos Relacionados";
$_header['icon']   = 'camera';


get_header_gestor();
get_barra_header();
?>

<div class="alert alert-danger">
	<button type="button" class="close" aria-hidden="true">&times;</button>
	<div id="rsvErrors"></div>
</div>

<div class="alert alert-warning"></div>
<div class="alert alert-success"></div>




<div class="row">
	<div class="form-group col-md-12">
		<label for="legenda">Produto</label>
		<h3><?=$query->titulo?></h3>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-6">
		Total de Produtos: <strong><?=count($qProdutos)?></strong>
		<span style="float: right;">Produtos Relacionados: <strong><?=$count?></strong></span>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<form id="filtro" name="form" action="" method="get">
			<fieldset>
				<div class="form-group col-xs-12 col-sm-6 col-md-3">
					<label for="grupo">Filtro</label>
					<select class="form-control input-sm" name="grupo" id="grupo">
						<option value="">Selecione a Categoria</option>
						<?php echo get_combo_grupo($_GET["grupo"]);?>
					</select>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<button type="submit" class="btn btn-sm btn-primary">Buscar</button>
					<button type="reset" class="btn btn-sm btn-danger" name="limpar" value="1">Limpar</button>
				</div>
			</fieldset>

			<input type="hidden" name="id" value="<?php echo ($id?$id:""); ?>" />
		</form>
	</div>
</div>


<br><br>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">	

	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default" title="voltar" href="form-produtos.php?id=<?=$id?>&tab=4"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th></th>
					<th>Produto</th>
					<th>Categoria</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($qProdutos as $res) {

				if( in_array($res->id, $array_ass) )
				{
					$cor = "#cfecd8";
				}else{
					$cor = "#FFFFFF";
				}
			?>
				<tr>
					<td bgcolor="<?=$cor?>"><input id="chbox_<?=$res->id?>" type="checkbox" name="produtos[]" <?=(in_array($res->id, $array_ass)?'checked':'')?> value="<?=$res->id?>"></td>
					<td bgcolor="<?=$cor?>"><?php echo $res->titulo?></td>
					<td bgcolor="<?=$cor?>"><?php echo get_name_grupo($res->id_grupo)?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />

</form>

<?php get_footer_gestor(); ?>