<?php 
require("config.php");

if($_POST && isset($_POST['submit'])) {
	switch($_POST['action']) {
	
		case 'adicionar':
		require(PHP."classes/Class.validacao.php");
		
		$rules[] = "required,nome_completo,Nome completo";
		$rules[] = "required,usuario,Usuário";
		$rules[] = "required,senha,Senha";
		$rules[] = "required,repetir-senha,Repetir Senha";
		$rules[] = "required,email,E-mail";
		$rules[] = "valid_email,email,E-mail corretamente";
		if(count($_POST['acesso'])==0) $rules[] = "required,acesso,Nível de acesso";
		
		$errors = validateFields($_POST, $rules);

		if (empty($errors)) {
			if ($_POST['senha'] == $_POST['repetir-senha']) {
				$array_insert = array(
					'nome_completo'	=> $_POST['nome_completo'],
					'usuario'		=> $_POST['usuario'],
					'senha'			=> md5($_POST['senha']),
					'email'			=> $_POST['email'],
					'categoria'		=> $_POST['categoria'],
					'acesso'		=> implode("-",$_POST['acesso']),
					'data_criacao'	=> date("Y-m-d H:i:s"),
					'autor'			=> $autor
				);
				
				$insert = $db->insert($tables['USUARIOS'],$array_insert);
				
				if($insert) {
					$alertSucess = true;
					$alertMessage = 'Registro salvo com sucesso!';
				} else {
					$alertFail = true;
					$alertMessage = 'Não foi possível salvar o registro!';
				}
			} else {
				$alertFail = true;
				$alertMessage = 'Senhas incompatíveis, confira e tente novamente!';
			}
		}
		break;

		case 'alterar':
		require(PHP."classes/Class.validacao.php");
		
		$rules[] = "required,nome_completo,Nome completo";
		$rules[] = "required,usuario,Usuário";
		if($_POST['senha']) $rules[] = "required,senha,Senha";
		if($_POST['confirmar-senha']) $rules[] = "required,confirmar-senha,Confirmar senha";
		$rules[] = "required,email,E-mail";
		$rules[] = "valid_email,email,E-mail corretamente";
		if(count($_POST['acesso'])==0) $rules[] = "required,acesso,Nível de acesso";
		
		$errors = validateFields($_POST, $rules);
		
		if (empty($errors)) {
			if ($_POST['senha'] == $_POST['confirmar-senha']) {
				$array_update = array(
					'nome_completo'	=> $_POST['nome_completo'],
					'usuario'		=> $_POST['usuario'],
					'email'			=> $_POST['email'],
					'categoria'		=> $_POST['categoria'],
					'acesso'		=> implode("-",$_POST['acesso'])
				);
				if($_POST['senha']) $array_update['senha'] = md5($_POST['senha']);
				
				$update = $db->update($tables['USUARIOS'],$array_update,array('id'=>$_POST['id']));
				$alertSucess = true;
				$alertMessage = 'Registro salvo com sucesso!';
			} else {
				$alertFail = true;
				$alertMessage = 'Senhas incompatíveis, confira e tente novamente!';
			}
		}
		break;		
	}

	// INSERINDO FOTO
	$tempFile 		= $_FILES['foto']['tmp_name'];
	$id 			= $db->lastInserId();
	$upload_temp	= upload('foto',TEMP,'10mb',false,false,false,'md5');
	
	if($upload_temp[0] == 'true') {
		require(PHP.'classes/Class.imagem.php');

		$fileName 	= $upload_temp[1];
		$extFile 	= substr($upload_temp[1], -4);

		if( $extFile == "jpeg" ) {
			$extFile = ".jpg";
		}
		
		$fileNewName = $id.'_'.md5(date('dmyHis'));

		$imageThumb = new Image(TEMP.$fileName);
		$imageThumb->setPathToTempFiles(TEMP);
		$imageThumb->resize(200, 200, "crop", "c", "c");
		$imageThumb->save(ROOT_UPLOADS_IMG.'foto_'.$fileNewName);
		
		$fileNewName = $fileNewName.$extFile;
		
		$array_update = array( 'foto' => $fileNewName );
		
		$update = $db->update($tables['USUARIOS'],$array_update,array('id'=>$_POST['id']));

		@unlink(TEMP.$fileName);

		// DELETAR IMAGEM E INSERIR EM SEGUIDA
		$_GET["del_foto"] = 0;
	}
}

// DELETAR POST
if ($_POST && isset($_POST['deletar'])) {
	$db->query("DELETE FROM ".$tables['USUARIOS']." WHERE id='{$_POST['id']}'");	
	header("Location: ".HTTP_GESTOR."list-usuarios.php?del=ok");
}

// DELETAR FOTO
if( is_numeric( $_GET["del_foto"] ) && $_GET["del_foto"] == "1" && $_GET["foto"] == "1" ) {
	$query = $db->get_row("SELECT foto FROM ".$tables['USUARIOS']." WHERE id = '{$_GET["id"]}'");
	
	if($query->foto) {
		@unlink(HTTP_UPLOADS_IMG.'foto_'.$query->foto);
		@unlink(ROOT_UPLOADS_IMG.'foto_'.$query->foto);
	}
	
	$array_update = array( 'foto' => NULL );
		
	$update = $db->update($tables['USUARIOS'],$array_update,array('id'=>$_GET['id']));
	
	$alertSucess = true;
	$alertMessage = 'Foto excluída com sucesso!';
}

// SETANDO ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

if($id) {
	$query = $db->get_row("SELECT * FROM ".$tables['USUARIOS']." WHERE id='{$id}'");
	$acesso = explode("-",$query->acesso);
} else $acesso = array();

// HEADERS
$_header['titulo'] = ($id?'Editar Usuário':'Novo Usuário');
$_header['icon'] = 'user';

add_javascript(array("jquery.rsv.js","form.usuario.js"));

get_header_gestor();
get_barra_header();
?>

<div class="alert alert-danger">
	<button type="button" class="close" aria-hidden="true">&times;</button>
	<div id="rsvErrors"></div>
</div>

<div class="alert alert-warning"></div>
<div class="alert alert-success"></div>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
			<button class="btn btn-sm btn-default" type="submit" name="deletar"><span class="glyphicon glyphicon-trash"></span> Deletar</button>
		</div>
		<div class="pull-right">
			<a class="btn btn-sm btn-default hidden-xs" href="form-usuarios.php" title="Novo"><span class="glyphicon glyphicon-file"></span> Adicionar novo</a>
			<a class="btn btn-sm btn-default" title="voltar" href="list-usuarios.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
		</div>
	</div>

	<fieldset>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="nome_completo">Nome completo</label>
				<input type="text" class="form-control input-sm" id="nome_completo" name="nome_completo" value="<?php echo ($query ? $query->nome_completo : $_POST['nome_completo']); ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="categoria">Categoria</label>
				<select class="form-control input-sm" name="categoria" id="categoria">
					<option value="">Selecione</option>
					<?php echo get_user_cat(($query ? $query->categoria : $_POST['categoria']), 'options'); ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="email">Email</label>
				<input type="email" class="form-control input-sm" id="email" name="email" value="<?php echo ($query ? $query->email : $_POST['email']); ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="usuario">Usuário</label>
				<input type="text" class="form-control input-sm" id="usuario" name="usuario" value="<?php echo ($query ? $query->usuario : $_POST['usuario']); ?>" />
			</div>
		</div>
		<div class="row">
			<?php if (!$query) { ?>
			<div class="form-group col-md-6">
				<label for="senha">Senha</label>
				<input type="password" class="form-control input-sm" id="senha" name="senha" value="<?php echo ($query ? false : $_POST['senha']); ?>" />
			</div>
			<div class="form-group col-md-6">
				<label for="repetir-senha">Repetir senha</label>
				<input type="password" class="form-control input-sm" id="repetir-senha" name="repetir-senha" value="<?php echo ($query ? false : $_POST['senha']); ?>" />
			</div>
			<?php } else if ($query) { ?>
			<div class="form-group col-md-6">
				<label for="senha">Nova senha</label>
				<input type="password" class="form-control input-sm" id="senha" name="senha" value="" />
				<p class="help-block"><small>Para alterar sua senha, digite a nova senha; caso contrário, deixe este espaço em branco.</small></p>
			</div>
			<div class="form-group col-md-6">
				<label for="confirmar-senha">Repetir nova senha</label>
				<input type="password" class="form-control input-sm" id="confirmar-senha" name="confirmar-senha" value="" />
				<p class="help-block"><small>Digite sua nova senha novamente.</small></p>
			</div>
			<?php } ?>
		</div>
		<div class="form-group">
			<label>Permissões</label>
			<div class="panel panel-default">
				<div class="checkboxes panel-body">
					<?php 
					foreach($arMenu as $title => $var) {
						if ($var['acesso']!='FULL')
							if ($var['show']) { ?>
						<div class="checkbox">
							<label>
								<input id="chbox_<?php echo $var['acesso'] ?>" type="checkbox" name="acesso[]" value="<?php echo $var['acesso'] ?>" <?php echo (in_array($var['acesso'],$acesso)?'checked':false) ?> /> <?php echo $title ?>
							</label>
						</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
		<div class="well">
			<?php if ($query->foto || $fileNewName) { ?>
			<p><img class="img-thumbnail" src="<?php echo HTTP_UPLOADS_IMG.'foto_'.($query->foto ? $query->foto : $fileNewName)?>" /></p>
			<a class="btn btn-sm btn-danger deletar" href="form-usuarios.php?id=<?php echo $id?>&foto=1&del_foto=1" title="Excluir"><span class="glyphicon glyphicon-trash"></span> Deletar foto</a>
			<?php } else { ?>
			<label for="foto">Foto</label>
			<input type="file" id="foto" name="foto">
			<p class="help-block">A foto deve ter 200x200px</p>
			<?php } ?>
		</div>

		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
		<input type="hidden" name="tabela" id="tabela" value="usuarios" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>