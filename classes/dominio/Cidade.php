<?php

class Cidade {
	private $idt;
	private $nome;
	
	function __construct($idt = '', $nome = '') {
		$this->idt = $idt;
		$this->nome = $nome;
	}
	
	public function setIdt($val) {
		$this->idt = $val;
	}
	
	public function getIdt() {
		return $this->idt;
	}
	
	public function setNome($val) {
		$this->nome = $val;
	}
	
	public function getNome() {
		return $this->nome;
	}
}
?>