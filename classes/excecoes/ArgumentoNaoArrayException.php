<?php
class ArgumentoNaoArrayException extends Exception {
	function __construct(){
		
	}
	
	function __toString(){
		return "Um dos argumentos não era um array!";
	}
}
?>