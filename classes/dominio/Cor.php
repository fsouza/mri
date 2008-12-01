<?php
class Cor {
	private $idt;
	private $hex;
	private $nomeCor;
	
	function __construct($idt = '', $hex = '', $nomeCor = '') {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->hex = $hex;
		$this->nomeCor = $nomeCor;
	}
	
	public function setIdt($val){
		$this->idt = $val;
	}
	
	public function getIdt() {
		return $this->idt;
	}
	
	public function setHex($val) {
		$this->hex = $val;
	}
	
	public function getHex(){
		return $this->hex;
	}
	
	public function setNomeCor($val){
		$this->nomeCor = $val;
	}
	
	public function getNomeCor(){
		return $this->nomeCor;
	}
}
?>