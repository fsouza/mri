<?php
include_once 'classes/dominio/Cor.php';
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/Substancia.php';

class CorSombra {
	private $idt_cor;
	private $hex;
	private $nome_cor;
	private $conexao;
	
	private function prepararObjeto(Cor $cor){
		$IDT = $cor->getIdt();
		$HEX = $cor->getHex();
		$NOME = $cor->getNomeCor();
		$this->idt_cor = (is_numeric($IDT) ? $IDT : '');
		$this->hex = (get_magic_quotes_gpc() ? $HEX : addslashes($HEX));
		$this->nome_cor = (get_magic_quotes_gpc() ? $NOME : addslashes($NOME));
		$this->conexao = Conexao::conectar();
	}
	
	public function inserirCor(Cor $cor){
		$this->prepararObjeto($cor);
		$comandoSql = sprintf("INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (%d, '%s', '%s')", $this->idt_cor, $this->hex, $this->nome_cor);
		$insert = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insert != false);
	}
	
	public function alterarCor(Cor $cor){
		$this->prepararObjeto($cor);
		$comandoSql = sprintf("UPDATE cor SET hex = '%s', nome_cor = '%s' WHERE idt_cor = %d", $this->hex, $this->nome_cor, $this->idt_cor);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}
	
	public function apagarCor(Cor $cor){
		$this->prepararObjeto($cor);
		$comandoSql = sprintf("DELETE FROM cor WHERE idt_cor = %d", $this->idt_cor);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		unset($comandoSql);
		return ($delete != false);
	}
	
	public function selecionarCor(Cor $cor){
		$this->prepararObjeto($cor);
		$comandoSql = sprintf("SELECT * FROM cor WHERE idt_cor = %d", $this->idt_cor);
		$resultado = $this->conexao->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		$objCor = new Cor($objFetch->IDT_COR, $objFetch->HEX, $objFetch->NOME_COR);
		$resultado->Close();
		$this->conexao->Close();
		return $objCor;
	}
	
	public function selecionarCorDaSubstancia(Substancia $substancia){
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT	s.idt_substancia,
										s.fk_cor,
										c.*
										FROM	substancia s,
												cor c
										WHERE	s.fk_cor = c.idt_cor AND
												s.idt_substancia = %d", $substancia->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		$objCor = new Cor($objFetch->IDT_COR, $objFetch->HEX, $objFetch->NOME_COR);
		$resultado->Close();
		$conn->Close();
		return $objCor;
	}
}
?>