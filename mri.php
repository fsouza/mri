<?php
include_once 'classes/interface/Index.php';
include_once 'classes/interface/AdmIndex.php';
include_once 'classes/interface/AdmLogin.php';
include_once 'classes/adm/Restricao.php';
include_once 'classes/adm/Login.php';
include_once 'classes/interface/DetalheSubstancia.php';

$login = new Login();
$restrito = new Restricao();
if(isset($_GET['substancia'])) {
	if(is_numeric($_GET['cod'])){
		$idtSubstancia = $_GET['cod'];
		$pagina = new DetalheSubstancia($idtSubstancia);
	} else {
		header('mri.php?home');
		exit(0);
	}
} elseif(isset($_GET['administracao'])){
	if($restrito->liberarAcesso()){
		$pagina = new AdmIndex('Administração do MRI');
	} else {
		$pagina = new AdmLogin('MRI | Página restrita!');
	}
} elseif(isset($_GET['logar'])) {
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	if((empty($usuario)) || (empty($senha))){
		header('Location:erro.php?loginVazio');
		exit(1);
	} else {
		if($login->efetuarLogin($usuario, $senha)){
			$url = "mri.php?administracao";
			header('Location:'.$url);
			exit(1);
		} else {
			header('Location:erro.php?loginFalhou');
			exit(1);
		}
	}
} elseif(isset($_GET['sair'])){
	if($restrito->liberarAcesso()){
		$login->efetuarLogout();
	}
	header('Location: mri.php?home');
	exit(0);
} else {
	$pagina = new Index('MRI - Catálogo Eletrônico de Minerais Industriais do Espírito Santo');
}
$pagina->exibirPagina();
?>