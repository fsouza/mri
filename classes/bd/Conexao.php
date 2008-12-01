<?php
include_once 'classes/adodb/adodb.inc.php';

class Conexao {
	public static function conectar() {
		$conexao = ADONewConnection('mysql');
		$conexao->Connect('localhost', 'root', '', 'mri');
		return $conexao;
	}
}
?>
