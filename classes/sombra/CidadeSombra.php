<?php
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/Cidade.php';
include_once 'classes/sombra/SubstanciasCidadeSombra.php';
include_once 'classes/dominio/Substancia.php';

class CidadeSombra {
	private $idt_cidade;
	private $nome_cidade;
	private $conexao; 
	
	private function prepararObjeto(Cidade $cidade) {
		$idt = $cidade->getIdt();
		$nome = $cidade->getNome();
		$this->idt_cidade = (is_numeric($idt) ? $idt : '');
		$this->nome_cidade = (get_magic_quotes_gpc() ? $nome : addslashes($nome));
		$this->conexao = Conexao::conectar();
	}
	
	public function inserirCidade(Cidade $cidade) {
		$this->prepararObjeto($cidade);
		$comandoSql = sprintf("INSERT INTO cidade (idt_cidade, nome_cidade) VALUES (%d, '%s')", $this->idt_cidade, $this->nome_cidade);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insercao != false);
	}
	
	public function alterarCidade(Cidade $cidade) {
		$this->prepararObjeto($cidade);
		$comandoSql = sprintf("UPDATE cidade SET nome_cidade = '%s' WHERE idt_cidade = %d", $this->nome_cidade, $this->idt_cidade);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}
	
	public function removerCidade(Cidade $cidade) {
		$this->prepararObjeto($cidade);
		$comandoSql = sprintf("DELETE FROM cidade WHERE idt_cidade = %d", $this->idt_cidade);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($delete != false);
	}
	
	public function selecionarCidade(Cidade $cidade) {
		$this->prepararObjeto($cidade);
		$comandoSql = sprintf("SELECT * FROM cidade WHERE idt_cidade = %d", $this->idt_cidade);
		$resultado = $this->conexao->Execute($resultado);
		$this->conexao->Close();
		$objFetch = $resultado->FetchNextObject();
		$objCidade = new Cidade($objFetch->IDT_CIDADE, $objFetch->NOME_CIDADE);
		return $objCidade;
	}
	
	public function selecionarTodasAsCidades() {
		$cidades = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM cidade");
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$cidades[$i] = new Cidade($objFetch->IDT_CIDADE, $objFetch->NOME_CIDADE);
			$i++;
		}
		return $cidades;
	}
	
	public function selecionarCidadePorSubstancia(Substancia $substancia) {
		$sombra = new SubstanciasCidadeSombra();
		return $sombra->selecionarCidadesPorSubstancia($substancia);
	}
}
?>