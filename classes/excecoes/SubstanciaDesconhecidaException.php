<?php
class SubstanciaDesconhecidaException extends Exception {
	function SubstanciaDesconhecidaException(){
	}
	
	public function __toString() {
		return "Os únicos tipos de substâncias válidos são: Metalica, Nao Metalica e Gema!";
	}
}
?>