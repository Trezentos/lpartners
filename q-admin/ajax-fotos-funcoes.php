<?php
require("config.php");
// GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (!empty($_GET['id']) && !empty($_GET['action']) && !empty($_GET['tabela_img']) ) {

		$tabela = strtoupper($_GET['tabela_img']);

		switch($_GET['action']) {
			case 'ativa_desativa':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");

				if($query->ativo == 1) {
					$db->update($tables[$tabela],array('ativo'=>'0','capa'=>'0'),array('id'=>$_GET['id']));
					$status = 'desativado';
				} else  {
					$db->update($tables[$tabela],array('ativo'=>'1'),array('id'=>$_GET['id']));
					$status = 'ativado';
				}
				echo json_encode(array('error'=>'false','status'=>$status,'id'=>$_GET['id']));
			break;

			case 'set_capa':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				$db->update($tables[$tabela],array('capa'=>'0'),array('categoria'=>$query->categoria, 'id_galeria'=>$query->id_galeria));
				$db->update($tables[$tabela],array('capa'=>'1','ativo'=>'1'),array('id'=>$_GET['id']));
				echo json_encode(array('error'=>'false','status'=>'setada','id'=>$_GET['id']));
			break;

			case 'set_home':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				$db->update($tables[$tabela],array('home'=>'0'),array('categoria'=>$query->categoria, 'id_galeria'=>$query->id_galeria));
				$db->update($tables[$tabela],array('home'=>'1','ativo'=>'1'),array('id'=>$_GET['id']));
				echo json_encode(array('error'=>'false','status'=>'setada','id'=>$_GET['id']));
			break;

			case 'get_legenda':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				echo json_encode(array('error'=>'false','legenda'=>''.$query->legenda.''));
			break;

			case 'set_legenda':
				$db->update($tables[$tabela],array('legenda'=>$_GET['legenda']),array('id'=>$_GET['id_img'], 'id_galeria'=>$_GET['id']));
				if($_GET['legenda']) $status = 'setada';
				echo json_encode(array('error'=>'false','status'=>$status,'legenda'=>$_GET['legenda'],'id_img'=>$_GET['id_img'],'id'=>$_GET['id']));
			break;

			case 'deletar':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");

				@unlink(HTTP_UPLOADS_IMG.'800x600_'.$query->arquivo);
				@unlink(ROOT_UPLOADS_IMG.'800x600_'.$query->arquivo);

				@unlink(HTTP_UPLOADS_IMG.'tb_'.$query->arquivo);
				@unlink(ROOT_UPLOADS_IMG.'tb_'.$query->arquivo);

				$db->query("DELETE FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}'");
				break;
			break;
		}


	} else echo json_encode(array('error'=>'true'));
// POST
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['action']) && !empty($_POST['tabela']) ) {

		$tabela = strtoupper($_POST['tabela']);

		switch($_POST['action']) {
			case 'ordenar':
				$newOrder = $_POST['data'];
				foreach($newOrder as $order) {
					list($id_imagem, $ordem) = explode("=", $order);
					$update = $db->query("UPDATE ".$tables[$tabela]." SET ordem = '".str_pad($ordem, 3, "0", STR_PAD_LEFT)."' WHERE id={$id_imagem}");
				}
				echo json_encode(array('error'=>'false', 'status'=>'sucesso'));
				break;
			break;
		}

	} else echo json_encode(array('error'=>'true'));
} else echo json_encode(array('error'=>'true'));
?>