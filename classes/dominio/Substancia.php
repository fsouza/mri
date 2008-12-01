<?php
include_once 'classes/dominio/Foto.php';
include_once 'classes/dominio/Cor.php';

/**
 * class Substancia
 */
abstract class Substancia
{

	/** Aggregations: */

	/** Compositions: */

	/*** Attributes: ***/

	/**
	 * @access private
	 */
	private $nome;
	private $foto;
	private $descricao;
	private $cor;
	private $idt;

	public function __construct($idt = '', $nome = '', $descricao = '', Foto $foto = NULL, Cor $cor = NULL) {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->foto = $foto;
		$this->cor = $cor;
	}
	
	public function getCor(){
		return $this->cor;
	}
	
	public function setCor(Cor $cor){
		$this->cor = $cor;
	}
	
	public function getIdt() {
		return $this->idt;	
	}
	
	public function setIdt($val) {
		$this->idt = $val;
	}
	
	public function getFoto() { 
		return $this->foto;
	}
	
	public function setFoto(Foto $val) {
		$this->foto = $val;
	}
	
	public function getDescricao() {
		return $this->descricao;
	}
	
	public function setDescricao($val) {
		$this->descricao = $val;
	}

	public function getNome () {
		return $this->nome;
	}

	public function setNome ($val) {
		$this->nome = $val;
	}

} // end of Substancia
?>
