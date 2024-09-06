<?php
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if(!empty($_GET['string'])) {
		$newString = clean_string($_GET['string']);

		$query = $db->get_var("SELECT COUNT(*) FROM ".$tables[strtoupper($_GET['tabela'])]." WHERE titulo = '{$_GET['string']}'");

		if ($query > 0) {
			$newString = clean_string($_GET['string']).'-'.$query;
		}

		echo json_encode(array('error'=>'false', 'string' =>$newString));
	} else echo json_encode(array('error'=>'true'));
} else echo json_encode(array('error'=>'true'));

?>