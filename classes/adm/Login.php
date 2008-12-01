<?php
include_once 'classes/adm/Sessao.php';

class Login {
	private $sessao;
	
	function __construct(){
		$this->sessao = new Sessao();
	}
	
	public function efetuarLogin($usuario, $senha){
		if($usuario == 'admin' && $senha == 'admin'){
			$this->sessao->iniciarSessao();
			$this->sessao->setarValorSessao('usuario', 'admin');
			return 1;
		}
		return 0;
	}
	
	public function efetuarLogout(){
		$this->sessao->setarValorSessao('usuario', '');
		$this->sessao->destruirSessao();
	}
}
?>