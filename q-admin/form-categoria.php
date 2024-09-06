<?
require("config.php");

if($_POST && isset($_POST['submit'])) {
	switch($_POST['action']) {
	
		//ADICIONAR PAGINAS
		case 'adicionar':
		require(PHP."validacao.classe.php");

		$rules[] = "required,titulo,Nome";
		$rules[] = "required,permalink,URL";
		
		$errors = validateFields($_POST, $rules);
		
		if (empty($errors))
		{
			$array_insert = array(
					'titulo'=>$_POST['titulo'],
					'permalink'=>$_POST['permalink']
				);
			$insert = $db->insert($tables['GRUPO'],$array_insert);
			
			if($insert) {
				$alertSucess = true;
				$alerMessage = 'Registro salvo com sucesso!';
			} else {
				$alertFail = true;
				$alerMessage = 'Não foi possível salvar o registro!';
			}
		}
		break;

		//EDITAR PAGINAS
		case 'alterar':
		require(PHP."validacao.classe.php");

		
		$rules[] = "required,titulo,Nome";
		$rules[] = "required,permalink,URL";
		
		$errors = validateFields($_POST, $rules);
		if (empty($errors))
		{
			$array_update = array();

			$array_update += array(
					'titulo'=>$_POST['titulo'],
					'permalink'=>$_POST['permalink']
				);

			$update = $db->update($tables['GRUPO'],$array_update,array('id'=>$_POST['id']));
			
			//$db->debug();
			
			$alertSucess = true;
			$alerMessage = 'Registro salvo com sucesso!';
		}
		break;		
	}
}



$id = $_REQUEST['id'];
if($id) $query = $db->get_row("SELECT * FROM ".$tables['GRUPO']." WHERE id='{$id}'");




if($_GET['id_filtro'])
{
	$db->query("DELETE FROM ".$tables['FILTROS']." WHERE id='{$_GET['id_filtro']}'");
	header("Location: ".pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME)."?id={$id}&del=ok");
}

if($_GET['del']=='ok') {
	$alertSucess = true;
	$alerMessage = 'Registro excluido com sucesso!';
}






$count = $db->get_var("SELECT COUNT(id) FROM ".$tables['FILTROS']." WHERE id_categoria='{$id}'");


$_header['titulo'] 	= 'Categorias';
$_header['icone'] 	= 'icon_category.png';

add_javascript(array("jquery.rsv.js","form-grupo.js"));

get_header_gestor();
get_barra_header();
?>

<ul class="tabs">
	<li class="active"><a href="#tab1">Geral</a></li>
	<li <?echo ($id?'':'class="desactive" title="Cadastre a categoria primeiro!"')?>><a href="#tab2">Atributos</a></li>
</ul>


<div class="tab_container">

	<div id="tab1" class="tab_content">
		<form name="form" id="form" action="" method="post" enctype="multipart/form-data">

			<div class="campos">
			  <span class="campoTitulo"><strong>Nome</strong></span>
			  <span><input type="text" id="titulo" name="titulo" value="<?php echo ($query?$query->titulo :false); ?>"></span>                         
			</div>

			<div class="campos">
			  <span class="campoTitulo"><strong>URL</strong></span>
			  <span><input type="text" id="permalink" name="permalink" value="<?php echo ($query?$query->permalink:false); ?>"></span>                         
			</div>


			<div class="buttons">
				<input type="hidden" name="id" value="<? echo ($id?$id:false); ?>" />
				<input type="hidden" name="action" value="<? echo ($id?'alterar':'adicionar'); ?>" />
				<button type="submit" name="submit">Salvar</button>
				<button type="button" name="voltar" onclick="document.location.href='categorias.php'">Voltar</button>
			</div>
		</form>
	</div>



	<div id="tab2" class="tab_content">
	
		<button type="button" name="novo" onclick="document.location.href='form-grupo-filtros.php?id_categoria=<?=$id?>'" class="botao_novo">Adicionar</button>
		<br><br>

<?	
		if($count>0)
		{
			$query = $db->get_results("SELECT * FROM ".$tables['FILTROS']." WHERE id_categoria='{$id}' ORDER BY id ASC");

			echo '<table width="600" border="0" cellspacing="1" cellpadding="0" bgcolor="#dbdbdb">
					<tr>
						<td bgcolor="#efefef" align="left" width="35%"><strong>Atributo</strong></td>
						<td bgcolor="#efefef" align="center" width="10%"><strong>Destaque</strong></td>
						<td bgcolor="#efefef" align="center" width="10%"><strong>Ações</strong></td>
					</tr>';
					
				foreach($query as $res)
				{
					echo '
					<tr class="'.($zebra%2==0?'comzebra':'semzebra').'">
						<td bgcolor="#FFFFFF" align="left"><a href="form-grupo-filtros.php?id_categoria='.$id.'&id='.$res->id.'">'.$res->descricao.'</a></td>
						<td bgcolor="#FFFFFF" align="center">'.($res->destaque==1?'Sim':'Não').'</td>
						<td bgcolor="#FFFFFF" align="center"><a href="'.pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME).'?id='.$id.'&id_filtro='.$res->id.'" class="delete">[Excluir]</a></td>
					</tr>';
					@$zebra++;
				}
			echo '</table>';
		} else echo '<p>Nenhum registro encontrado.</p>';
?>
	</div>

</div>
<?
get_barra_footer();
get_footer_gestor();
?>