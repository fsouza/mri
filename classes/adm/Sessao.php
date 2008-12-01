<?php
class Sessao {
	function __construct() {
		$this->iniciarSessao();
	}

	public function iniciarSessao() {
		if(!$this->verificarSessao()) {
			session_start();
		}
	}

	public function destruirSessao(){
		if($this->verificarSessao()){
			session_destroy();
		}
	}

	public function verificarSessao(){
		$val = isset($_SESSION);
		return $val;
	}

	public function setarValorSessao($indice, $valor){
		$_SESSION[$indice] = $valor;
	}
	
	public function verificarValorSessao($indice){
		return (isset($_SESSION[$indice]) && $_SESSION[$indice] != '');
	}
}
?>