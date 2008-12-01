<?php
include_once 'classes/dominio/Substancia.php';
include_once 'classes/dominio/Cidade.php';

class SubstanciasCidade {
	private $idt;
	private $substancia;
	private $cidade;
	
	function __construct($idt = '', Cidade $cidade = NULL, Substancia $substancia = NULL) {
		$this->idt = $idt;
		$this->cidade = $cidade;
		$this->substancia = $substancia;
	}
	
	public function setIdt($val) {
		$this->idt = $val;
	}
	
	public function getIdt() {
		return $this->idt;
	}
	
	public function setSubstancia(Substancia $substancia) {
		$this->substancia = $substancia;
	}
	
	public function getSubstancia() {
		return $this->substancia;
	}
	
	public function setCidade(Cidade $cidade) {
		$this->cidade = $cidade;
	}
	
	public function getCidade() {
		return $this->cidade;
	}
}
?>