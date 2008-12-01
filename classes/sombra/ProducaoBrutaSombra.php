<?php
include_once 'classes/dominio/ProducaoBruta.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/NaoMetalica.php';
include_once 'classes/dominio/Metalica.php';
include_once 'classes/dominio/Gema.php';
include_once 'classes/sombra/SubstanciaSombra.php';
include_once 'classes/dominio/ReservaMineral.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class ProducaoBrutaSombra {
	private $idt_producao_bruta;
	private $quantidade_produzida;
	private $quantidade_comercializada;
	private $valor_comercializado;
	private $contido;
	private $teor_medio;
	private $fk_substancia;
	private $conexao;

	private function prepararObjeto(ProducaoBruta $producaoBruta) {
		$idt = $producaoBruta->getIdt();
		$qt_p = $producaoBruta->getQuantidadeProduzida();
		$qt_c = $producaoBruta->getQuantidadeComercializada();
		$vl_c = $producaoBruta->getValorComercializado();
		$cont = $producaoBruta->getContido();
		$tr_m = $producaoBruta->getTeorMedio();
		$this->idt_producao_bruta = (is_numeric($idt) ? $idt : '');
		$this->quantidade_produzida = (is_numeric($qt_p) ? $qt_p : '');
		$this->quantidade_comercializada = (is_numeric($qt_c) ? $qt_c : '');
		$this->valor_comercializado = (is_numeric($vl_c) ? $vl_c : '');
		$this->contido = (is_numeric($cont) ? $cont : '');
		$this->teor_medio = (is_numeric($tr_m) ? $tr_m : '');
		$this->fk_substancia = $producaoBruta->getSubstancia()->getIdt();
		$conexao = Conexao::conectar();
	}

	public function inserirProducaoBruta(ProducaoBruta $producaoBruta) {
		$this->prepararObjeto($producaoBruta);
		$comandoSql = sprintf("INSERT INTO producao_bruta (idt_producao_bruta, quantidade_produzida, quantidade_comercializada, valor_comercializado, contido, teor_medio, fk_substancia");
		$comandoSql = sprintf("%s VALUES (%d, %d, %d, %.2f, %d, %d, %d", $comandoSql, $this->idt_producao_bruta, $this->quantidade_produzida, $this->quantidade_comercializada, $this->valor_comercializado, $this->contido, $this->teor_medio, $this->fk_substancia);
		$insert = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insert != false);
	}

	public function alterarProducaoBruta(ProducaoBruta $producaoBruta) {
		$this->prepararObjeto($producaoBruta);
		$comandoSql = sprintf("UPDATE producao_bruta SET quantidade_produzida = %d, quantidade_comercializada = %d, valor_comercializado = %.2f", $this->quantidade_produzida, $this->quantidade_comercializada, $this->valor_comercializado);
		$comandoSql = sprintf("%s, contido = %d, teor_medio = %d, fk_substancia = %d", $this->contido, $this->teor_medio, $this->fk_substancia);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	public function selecionarProducaoBruta(ProducaoBruta $producaoBruta) {
		$this->prepararObjeto($producaoBruta);
		$comandoSql = sprintf("SELECT * FROM producao_bruta WHERE idt_producao_bruta = %d", $this->idt_producao_bruta);
		$resultado = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
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
		$objProducaoBruta = new ProducaoBruta($objFetch->IDT_PRODUCAO_BRUTA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancia);
		return $objProducaoBruta;
	}

	public function selecionarProducaoBrutaPorSubstancia(Substancia $substancia) {
		$producoesBrutas = array();
		$fkSubstancia = $substancia->getIdt();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM producao_bruta WHERE fk_substancia = %d", $fkSubstancia);
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$producoesBrutas[$i] = new ProducaoBruta($objFetch->IDT_PRODUCAO_BRUTA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancia);
			$i++;
		}
		return $producoesBrutas;
	}

	public function selecionarTodasAsProducoesBrutas() {
		$producoesBrutas = array();
		$substancias = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT pb.*, s.tipo_substancia, s.idt_substancia FROM producao_bruta pb, substancia s WHERE pb.fk_substancia = s.idt_substancia");
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			switch($objFetch->TIPO_SUBSTANCIA) {
				case 'Metalica':
					$substancias[$i] = new Metalica($objFetch->FK_SUBSTANCIA);
					break;
				case 'Nao Metalica':
					$substancias[$i] = new NaoMetalica($objFetch->FK_SUBSTANCIA);
					break;
				case 'Gema':
					$substancias[$i] = new Gema($objFetch->FK_SUBSTANCIA);
					break;
				default:
					throw new SubstanciaDesconhecidaException();
			}
			$producoesBrutas[$i] = new ProducaoBruta($objFetch->IDT_PRODUCAO_BRUTA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancias[$i]);
			$i++;
		}
		return $producoesBrutas;
	}

	public function completarSubstancia(ProducaoBruta $producaoBruta) {
		$substanciaSombra = new SubstanciaSombra();
		$producaoBruta->setSubstancia($substanciaSombra->selecionarSubstancia($producaoBruta->getSubstancia()));
	}
}

?>