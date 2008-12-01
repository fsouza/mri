<?php
/**
 * class Foto
 */
class Foto
{
	private $mimetype;
	private $foto;
	private $idt;
	
	function __construct($idt = '', $mimetype = '', $foto = '') {
		$this->idt = (is_numeric($idt) ? $idt : '');
		$this->mimetype = $mimetype;
		$this->foto = $foto;
	}

	public function getIdt() {
		return $this->idt;	
	}
	
	public function setIdt($val) {
		$this->idt = $val;
	}
	
	public function getMimeType() {
		return $this->mimetype;
	}
	
	public function setMimeType($val) {
		$this->mimetype = $val; 
	}
	
	public function getFoto() {
		return $this->foto;
	}
	
	public function setFoto($val) {
		$this->foto = $val;
	}
}
?>
