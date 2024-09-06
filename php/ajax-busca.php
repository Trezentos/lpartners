<?php
require("config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	// ESTADO => CIDADE
	if( $_POST['q']=="estado" )
	{
		$estado = $db->escape($_POST['estado']);
		$query  = $db->get_results("SELECT id, nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}' ORDER BY nome");
		//$db->debug();
		if($query) {
			echo '<option value="">SELECIONE A CIDADE</option>';
			foreach($query as $result) echo '<option value="'.$result->id.'">'.$result->nome.'</option>';
		}
	}

} else header ('HTTP/1.1 404 Not Found');
?>