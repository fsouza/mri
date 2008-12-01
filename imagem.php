<?php
include_once 'classes/dominio/Foto.php';
include_once 'classes/sombra/FotoSombra.php';

$idt = $_GET['idt'];

$fotoSombra = new FotoSombra();
$foto = new Foto($idt);
$objFoto = $fotoSombra->selecionarFoto($foto);
header('Content-type: ' . $objFoto->getMimeType());
print $objFoto->getFoto();
?>