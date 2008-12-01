<?php
include_once 'imagem.php';
include_once 'classes/adm/Login.php';
include_once 'classes/adm/Restricao.php';

$t = new Login();
$s = new Restricao();
for($i = 1; $i <= 20; $i++){
	echo "<img src=imagem.php?idt=$i><br>";
}
?>