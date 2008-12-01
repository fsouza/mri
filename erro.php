<?php
include_once 'classes/interface/Erro.php';

if(isset($_GET['loginFalhou'])){
	$pagina = new Erro('Falha no login, verifique os dados inseridos!');
} elseif(isset($_GET['loginVazio'])){
	$pagina = new Erro('Para logar-se ambos os valores devem ser completados!');
} else {
	header('Location: index.php?home');
	exit(0);
}
$pagina->exibirPagina();
?>
