<?php 
require("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['action'] == 'add_local') {

		$id_empreendimento = $_POST['id'];
		$titulo  = $_POST['titulo'];
		$endereco  = $_POST['endereco'];

		$insert = $db->insert($tables['LOCAIS'], array('id_empreendimento'=>$id_empreendimento, 'titulo'=>$titulo, 'endereco'=>$endereco));

		if ($insert) {
			echo json_encode(array('error'=>'false', 'action'=>'add', 'titulo'=>$titulo, 'endereco'=>$endereco));
		}

	} else if ($_POST['action'] == 'edit_local') {
		
		$titulo = $_POST['titulo'];
		$endereco  = $_POST['endereco'];

		$update = $db->update($tables['LOCAIS'], array('titulo'=>$titulo, 'endereco'=>$endereco), array('id'=>$_POST['id-local']));

		if (isset($update)) {
			echo json_encode(array('error'=>'false', 'action'=>'edit', 'titulo'=>$titulo, 'endereco'=>$endereco, 'id'=>$_POST['id-local']));
		}

	} else echo json_encode(array('error'=>'true'));
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if(!empty($_GET['idImovel'])) {

		$qEmpreendimento = $db->get_row("SELECT * FROM ".$tables['IMOVEIS']." WHERE id = '{$_GET['idImovel']}'");

		if ($qEmpreendimento) {
			echo json_encode(array('error'=>'false', 'rua'=>$qEmpreendimento->endereco, 'bairro'=>$qEmpreendimento->bairro, 'cidade'=>get_cidade_nome($qEmpreendimento->cidade)));
		}
		
	} else if ($_GET['action'] == 'get_local') {

		$qLocal = $db->get_row("SELECT * FROM ".$tables['LOCAIS']." WHERE id = '{$_GET['id']}'");

		if ($qLocal) {
			echo json_encode(array('error'=>'false', 'titulo'=>$qLocal->titulo, 'endereco'=>$qLocal->endereco));
		}

	} else echo json_encode(array('error'=>'true'));
} else echo json_encode(array('error'=>'true'));
?>