<?php
require_once ('Substancia.php');


/**
 * class Producao
 */
abstract class Producao {
	/**
	 * @access private
	 */
	private $quantidadeProduzida;

	/**
	 * @access private
	 */
	private $quantidadeComercializada;

	/**
	 * @access private
	 */
	private $valorComercializado;

	/**
	 * @access private
	 */
	private $contido;

	/**
	 * @access private
	 */
	private $teorMedio;
	private $substancia;
	private $idt;

	function __construct($idt = '', $quantidadeProduzida = '', $quantidadeComercializada = '', $valorComercializado = '', $contido = '', $teorMedio = '', Substancia $substancia = NULL) {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->quantidadeProduzida = (is_numeric($quantidadeProduzida) ? $quantidadeProduzida : '');
		$this->quantidadeComercializada = (is_numeric($quantidadeComercializada) ? $quantidadeComercializada : '');
		$this->valorComercializado = (is_numeric($valorComercializado) ? $valorComercializado : '');
		$this->contido = (is_numeric($contido) ? $contido : '');
		$this->teorMedio = (is_numeric($teorMedio) ? $teorMedio : '');
		$this->substancia = (($substancia instanceof Substancia) ? $substancia : NULL);
	}

	public function getIdt() {
		return $this->idt;
	}

	public function setIdt($val) {
		$this->idt = $val;
	}

	public function getQuantidadeProduzida () {
		return $this->quantidadeProduzida;
	}

	public function setQuantidadeProduzida ($val) {
		$this->quantidadeProduzida = $val;
	}

	public function getQuantidadeComercializada () {
		return $this->quantidadeComercializada;
	}

	public function setQuantidadeComercializada ($val) {
		$this->quantidadeComercializada = $val;
	}

	public function getValorComercializado () {
		return $this->valorComercializado;
	}

	public function setValorComercializado ($val) {
		$this->valorComercializado = $val;
	}

	public function getContido () {
		return $this->contido;
	}

	public function setContido ($val) {
		$this->contido = $val;
	}

	public function getTeorMedio () {
		return $this->teorMedio;
	}

	public function setTeorMedio ($val) {
		$this->teorMedio = $val;
	}

	public function getSubstancia () {
		return $this->substancia;
	}

	public function setSubstancia (Substancia $val) {
		$this->substancia = $val;
	}
} // end of Producao
?>
