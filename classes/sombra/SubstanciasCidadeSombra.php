<?php
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/SubstanciasCidade.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/dominio/Cidade.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class SubstanciasCidadeSombra {
	private $idt_substancias_cidade;
	private $fk_cidade;
	private $fk_substancia;
	private $conexao;

	private function prepararObjeto(SubstanciasCidade $obj) {
		$idt = $obj->getIdt();
		$this->idt_substancias_cidade = (is_numeric($idt) ? $idt : '');
		$this->fk_cidade = $obj->getCidade()->getIdt();
		$this->fk_substancia = $obj->getSubstancia()->getIdt();
		$this->conexao = Conexao::conectar();
	}

	public function inserirSubstanciasCidade(SubstanciasCidade $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("INSERT INTO substancias_cidade (idt_substancias_cidade, fk_cidade, fk_substancia) VALUES (%d, %d, %d)", $this->idt_substancias_cidade, $this->fk_cidade, $this->fk_substancia);
		$insert = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insert != false);
	}

	public function alterarSubstanciasCidade(SubstanciasCidade $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("UPDATE substancias_cidade SET fk_cidade = %d, fk_substancia = %d WHERE idt_substancias_cidade = %d", $this->fk_cidade, $this->fk_substancia, $this->idt_substancias_cidade);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	public function removerSubstanciasCidade(SubstanciasCidade $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("DELETE FROM substancias_cidade WHERE idt_substancias_cidade = %d", $this->idt_substancias_cidade);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($delete != false);
	}

	public function selecionarSubstanciasCidade(SubstanciasCidade $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("SELECT	sc.*,
										s.idt_substancia,
										s.tipo_substancia
										FROM	substancias_cidade sc
												substancia s
										WHERE	sc.fk_substancia = s.idt_substancia AND
												sc.idt_substancias_cidade = %d", $this->idt_substancias_cidade);
		$resultado = $this->conexao->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		switch($objFetch->TIPO_SUBSTANCIA) {
			case 'Metalica':
				$substancia = new Metalica($objFetch->FK_SUBSTANCIA);
				break;
			case 'Nao Metalica':
				$substancia = new NaoMetalica($objFetch->FK_SUBSTANCIA);
				break;
			case 'Gema':
				$substancia = new Gema($objFetch->FK_SUBSTANCIA);
				break;
			default:
				throw new SubstanciaDesconhecidaException();
		}
		$objSubstanciasCidade = new SubstanciasCidade($objFetch->IDT_SUBSTANCIAS_CIDADE, new Cidade($objFetch->FK_CIDADE), $substancia);
		$resultado->Close();
		$this->conexao->Close();
		return $objSubstanciasCidade;
	}

	public function selecionarSubstanciasPorCidade(Cidade $cidade) {
		$substancias = array();
		$fotos = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT	s.*,
										sc.*
										FROM	substancia s,
												substancias_cidade sc
										WHERE	sc.fk_substancia = s.idt_substancia AND
												sc.fk_cidade = %d", $cidade->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$fotos[$i] = new Foto($objFetch->FK_FOTO);
			switch($objFetch->TIPO_SUBSTANCIA) {
				case 'Metalica':
					$substancias[$i] = new Metalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i]);
					break;
				case 'Nao Metalica':
					$substancias[$i] = new NaoMetalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i]);
					break;
				case 'Gema':
					$substancias[$i] = new Gema($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i]);
					break;
				default:
					throw new SubstanciaDesconhecidaException();
			}
		}
		$resultado->Close();
		$conn->Close();
		return $substancias;
	}

	public function selecionarCidadesPorSubstancia(Substancia $substancia) {
		$cidades = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT	c.*,
										sc.*
										FROM	cidade c,
												substancias_cidade sc
										WHERE	sc.fk_cidade = c.idt_cidade AND
												sc.fk_substancia = %d", $substancia->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$cidades[$i] = new Cidade($objFetch->IDT_CIDADE, $objFetch->NOME_CIDADE);
			$i++;
		}
		$resultado->Close();
		$conn->Close();
		return $cidades;
	}
}
?>