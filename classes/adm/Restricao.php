<?php
include_once 'classes/adm/Sessao.php';

class Restricao {
	private $sessao;
	
	function __construct(){
		$this->sessao = new Sessao();
	}
	
	public function liberarAcesso(){
		return $this->sessao->verificarValorSessao('usuario');
	}
}
?>