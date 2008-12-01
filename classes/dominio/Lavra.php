<?php
require_once('Substancia.php');

abstract class Lavra {
	private $quantidadeGrande;
	private $substancia;
	private $quantidadeMedia;

	/**
	 * @access private
	 */
	private $quantidadePequena;
	private $idt;
	
	function __construct($idt = '', $quantidadeGrande = '', $quantidadeMedia = '', $quantidadePequena = '', Substancia $substancia) {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->quantidadeGrande = (is_numeric($quantidadeGrande) ? $quantidadeGrande : '');
		$this->quantidadeMedia = (is_numeric($quantidadeMedia) ? $quantidadeMedia : '');
		$this->quantidadePequena = (is_numeric($quantidadePequena) ? $quantidadePequena : '');
		$this->substancia = $substancia;
	}

	public function getIdt() {
		return $this->idt;
	}

	public function setIdt($val) {
		$this->idt = $val;
	}

	public function getSubstancia () {
		return $this->substancia;
	}

	public function setSubstancia (Substancia $val) {
		$this->substancia = $val;
	}

	public function getQuantidadeGrande () {
		return $this->quantidadeGrande;
	}

	public function setQuantidadeGrande ($val) {
		$this->quantidadeGrande = $val;
	}

	public function getQuantidadeMedia () {
		return $this->quantidadeMedia;
	}

	public function setQuantidadeMedia ($val) {
		$this->quantidadeMedia = $val;
	}

	public function getQuantidadePequena () {
		return $this->quantidadePequena;
	}

	public function setQuantidadePequena ($val) {
		$this->quantidadePequena = $val;
	}
} // end of Lavra
?>
