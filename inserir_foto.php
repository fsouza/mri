<?php
	include_once 'classes/dominio/Foto.php';
	include_once 'classes/sombra/FotoSombra.php';
	
	$ext = substr($_FILES['foto']['name'], -4);
	$ext = strtolower($ext);
	if($ext == ".png") {
		$mime = "image/png";
	} elseif($ext == ".jpg") {
		$mime = "image/jpeg";
	} elseif($ext == ".gif") {
		$mime = "image/gif";
	} else {
		echo "Erro!";
		exit(0);
	}
	
	$foto = file_get_contents($_FILES['foto']['tmp_name']);
	$foto = addslashes($foto);
	
	$foto = new Foto('', $mime, $foto);
	$fotoSombra = new FotoSombra();
	if($fotoSombra->inserirFoto($foto)){
		echo "Foto inserida com sucesso!";
	} else {
		echo "Erro ao inserir a foto:<br />";
		echo "<em>".mysql_error()."</em>";
	}
?>