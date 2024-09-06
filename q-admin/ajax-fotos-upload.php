<?php
$formatos = array('png', 'jpg', 'JPG', 'jpeg', 'gif');

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0)
{
	require("../php/config.php");

	$tempFile   = $_FILES['file']['tmp_name'];
	$id 		= $db->escape($_POST['id']);
	$categoria  = $_POST['categoria'];
	$tabela 	= strtoupper($_POST['tabela']);
	$tabela_img = strtoupper($_POST['tabela_img']);
	$TAM 		= 800;

	$permalink = $db->get_var("SELECT permalink FROM ".$tables[$tabela]." WHERE id='{$id}'");

	if($permalink==""){ $permalink = "produto"; }
	

	$upload_temp = upload('file',TEMP,'10mb',false,false,false,'md5');

	if($upload_temp[0] == 'true')
	{
		require(PHP.'classes/Class.imagem.php');

		$extencao = pathinfo($upload_temp[1], PATHINFO_EXTENSION);

		if (!in_array(strtolower($extencao), $formatos))
		{
			@unlink(TEMP.$upload_temp[1]);
			echo '{"status":"error"}';
			exit;
		}

		$fileName = $upload_temp[1];
		$extFile  = substr($upload_temp[1], -4);

		if($extFile=="jpeg"){ $extFile = ".jpg"; }


		$fileNewName = $permalink.'-'.$id.'-'.rand(0,9999);

		list($width, $height) = getimagesize(TEMP.$fileName);

		$image = new Image(TEMP.$fileName);
		$image->setPathToTempFiles(TEMP);

		
		if($height > $width) {
			$new_width  = $TAM;
			$new_height = ($TAM * $height)/$width;
		} else {
			$new_height = ($height / $width) * $TAM;
			$new_width  = $TAM;
		}


		$image->resize($new_width, $new_height, "fit", "c", "c");
		$image->save(ROOT_UPLOADS_IMG.'800x600_'.$fileNewName);

		$imageThumb = new Image(TEMP.$fileName);
		$imageThumb->setPathToTempFiles(TEMP);
		$imageThumb->resize(360, 360, "crop", "c", "c");
		$imageThumb->save(ROOT_UPLOADS_IMG.'tb_'.$fileNewName);

		$fileNewName = $fileNewName.$extFile;

		$db->insert($tables[$tabela_img], array('id_galeria'=>$id, 'arquivo'=>$fileNewName, 'categoria'=>$categoria));
		$query = $db->get_row("SELECT id FROM ".$tables[$tabela_img]." WHERE arquivo='{$fileNewName}' LIMIT 1");
		@unlink(TEMP.$fileName);

		echo '{"status":"success", "id":"'.$query->id.'", "id_galeria":"'.$id.'", "nome":"'.$fileNewName.'", "categoria":"'.$categoria.'", "tabela":"'.strtolower($tabela).'", "tabela_img":"'.$tabela_img.'"}';
		exit;
	} else {
		@unlink(TEMP.$upload_temp[1]);
		echo '{"status":"error"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;
?>