<?php
require_once ('ProducaoBruta.php');
require_once ('Substancia.php');


/**
 * class ReservaMineral
 */
class ReservaMineral
{
	/**
	 * @access private
	 */
	private $medida;

	/**
	 * @access private
	 */
	private $indicada;

	/**
	 * @access private
	 */
	private $inferida;

	/**
	 * @access private
	 */
	private $lavravel;
	private $substancia;
	private $idt;
	
	public function __construct($idt = '', $medida = '', $indicada = '', $inferida = '', $lavravel = '', Substancia $substancia = null) {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->medida = $medida;
		$this->indicada = $indicada;
		$this->inferida = $inferida;
		$this->lavravel = $lavravel;
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
	
	public function getMedida () {
		return $this->medida;
	}
	
	public function setMedida ($val) {
		$this->medida = $val;
	}
	
	public function getIndicada () {
		return $this->indicada;
	}
	
	public function setIndicada ($val) {
		$this->indicada = $val;
	}
	
	public function getInferida () {
		return $this->inferida;
	}
	
	public function setInferida ($val) {
		$this->inferida = $val;
	}
	
	public function getLavravel () {
		return $this->lavravel;
	}
	
	public function setLavravel ($val) {
		$this->lavravel = $val;
	}
} // end of ReservaMineral
?>
