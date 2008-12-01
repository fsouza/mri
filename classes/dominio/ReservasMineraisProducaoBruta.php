<?php
include_once 'classes/dominio/ProducaoBruta.php';
include_once 'classes/dominio/ReservaMineral.php';

class ReservasMineraisProducaoBruta {
	private $idt;
	private $producaoBruta;
	private $reservaMineral;
	
	function __construct($idt = '', ProducaoBruta $producaoBruta = NULL, ReservaMineral $reservaMineral = NULL) {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->producaoBruta = $producaoBruta;
		$this->reservaMineral = $reservaMineral;
	}

	public function getIdt () {
		return $this->idt ;
	}

	public function setIdt ($val) {
		$this->idt = $val;
	}

	public function getProducaoBruta () {
		return $this->producaoBruta;
	}

	public function setProducaoBruta ($val) {
		$this->producaoBruta = $val;
	}

	public function getReservaMineral () {
		return $this->reservaMineral;
	}

	public function setReservaMineral ($val) {
		$this->reservaMineral = $val;
	}
}
?>