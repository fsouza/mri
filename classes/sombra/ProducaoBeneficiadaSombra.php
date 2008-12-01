<?php
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/ProducaoBeneficiada.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/sombra/SubstanciaSombra.php';
include_once 'classes/dominio/NaoMetalica.php';
include_once 'classes/dominio/Metalica.php';
include_once 'classes/dominio/Gema.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class ProducaoBeneficiadaSombra {
	private $idt_producao_beneficiada;
	private $quantidade_produzida;
	private $quantidade_comercializada;
	private $valor_comercializado;
	private $contido;
	private $teor_medio;
	private $fk_substancia;
	private $fk_producao_bruta;
	private $conexao;

	private function prepararObjeto(ProducaoBeneficiada $producaoBeneficiada) {
		$idt = $producaoBeneficiada->getIdt();
		$qt_p = $producaoBeneficiada->getQuantidadeProduzida();
		$qt_c = $producaoBeneficiada->getQuantidadeComercializada();
		$vl_c = $producaoBeneficiada->getValorComercializado();
		$cont = $producaoBeneficiada->getContido();
		$tr_m = $producaoBeneficiada->getTeorMedio();
		$this->idt_producao_bruta = (is_numeric($idt) ? $idt : '');
		$this->quantidade_produzida = (is_numeric($qt_p) ? $qt_p : '');
		$this->quantidade_comercializada = (is_numeric($qt_c) ? $qt_c : '');
		$this->valor_comercializado = (is_numeric($vl_c) ? $vl_c : '');
		$this->contido = (is_numeric($cont) ? $cont : '');
		$this->teor_medio = (is_numeric($tr_m) ? $tr_m : '');
		$this->fk_producao_bruta = $producaoBeneficiada->getProducaoBruta()->getIdt();
		$this->fk_substancia = $producaoBeneficiada->getSubstancia()->getIdt();
		$conexao = Conexao::conectar();
	}

	public function inserirProducaoBeneficiada(ProducaoBeneficiada $producaoBeneficiada) {
		$this->prepararObjeto($producaoBeneficiada);
		$comandoSql = sprintf("INSERT INTO producao_beneficiada (idt_producao_beneficiada, quantidade_produzida, quantidade_comercializada, valor_comercializado, contido, teor_medio, fk_substancia, fk_producao_bruta)");
		$comandoSql = sprintf("%s VALUES (%d, %d, %d, %.2f, %d, %d, %d, %d)", $comandoSql, $this->idt_producao_beneficiada, $this->quantidade_produzida, $this->quantidade_comercializada, $this->valor_comercializado, $this->contido, $this->teor_medio, $this->fk_substancia, $this->fk_producao_bruta);
		$insert = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insert != false);
	}

	public function alterarProducaoBeneficiada(ProducaoBeneficiada $producaoBeneficiada) {
		$this->prepararObjeto($producaoBeneficiada);
		$comandoSql = sprintf("UPDATE producao_beneficiada SET quantidade_produzida = %d, quantidade_comercializada = %d, valor_comercializado = %.2f, contido = %d, teor_medio = %d, fk_substancia = %d, fk_producao_bruta = %d WHERE idt_producao_beneficiada = %d", $this->quantidade_produzida, $this->quantidade_comercializada, $this->valor_comercializado, $this->contido, $this->teor_medio, $this->fk_substancia, $this->fk_producao_bruta);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	public function apagarProducaoBeneficiada(ProducaoBeneficiada $producaoBenenficiada) {
		$this->prepararObjeto($producaoBenenficiada);
		$comandoSql = sprintf("DELETE FROM producao_beneficiada WHERE idt_producao_beneficiada = %d", $this->idt_producao_beneficiada);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($delete != false);
	}

	public function selecionarProducaoBeneficiada(ProducaoBeneficiada $producaoBeneficiada) {
		$this->prepararObjeto($producaoBeneficiada);
		$comandoSql = sprintf("SELECT * FROM producao_beneficiada WHERE idt_producao_beneficiada = %d", $this->idt_producao_beneficiada);
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
		$producaoBruta = new ProducaoBruta($objFetch->FK_PRODUCAO_BRUTA);
		$objProducaoBeneficiada = new ProducaoBeneficiada($objFetch->IDT_PRODUCAO_BENEFICIADA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch>VALOR_COMERCIALIZADO, $objFetch>CONTIDO, $objFetch->TEOR_MEDIO, $substancia, $producaoBruta);
		return $objProducaoBeneficiada;
	}

	public function selecionarTodasAsProducoesBeneficiadas() {
		$producoesBeneficiadas = array();
		$substancias = array();
		$producoesBrutas = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT pb.*, s.idt_substancia, s.tipo_substancia FROM producao_beneficiada");
		$resultado = $this->conexao->Execute($comandoSql);
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
			$producoesBrutas[$i] = new ProducaoBruta($objFetch->FK_PRODUCAO_BRUTA);
			$producoesBeneficiadas[$i] = new ProducaoBeneficiada($objFetch->IDT_PRODUCAO_BENEFICIADA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancias[$i], $producoesBrutas[$i]);
			$i++;
		}
		return $producoesBeneficiadas;
	}

	public function selecionarProducaoBeneficiadaPorSubstancia(Substancia $substancia) {
		$producoesBeneficiadas = array();
		$producoesBrutas = array();
		$conn = Conexao::conectar();
		$fkSubstancia = $substancia->getIdt();
		$comandoSql = sprintf("SELECT * FROM producao_beneficiada WHERE fk_substancia = %d", $fkSubstancia);
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$producoesBrutas[$i] = new ProducaoBruta($objFetch->FK_PRODUCAO_BRUTA);
			$producoesBeneficiadas[$i] = new ProducaoBeneficiada($objFetch->IDT_PRODUCAO_BENEFICIADA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancia, $producoesBrutas[$i]);
			$i++;
		}
		return $producoesBeneficiadas;
	}

	public function selecionarProducaBeneficiadaPorProducaoBruta(ProducaoBruta $producaoBruta) {
		$conn = Conexao::conectar();
		$fkProducaoBruta = $producaoBruta->getIdt();
		$comandoSql = sprintf("SELECT pb.*, s.idt_substancia, s.tipo_substancia FROM producao_beneficiada pb, substancia s WHERE pb.fk_substancia = s.idt_fubstancia AND pb.fk_producao_bruta = %d", $fkProducaoBruta);
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
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
		$producaoBeneficiada = new ProducaoBeneficiada($objFetch->IDT_PRODUCAO_BENEFICIADA, $objFetch->QUANTIDADE_PRODUZIDA, $objFetch->QUANTIDADE_COMERCIALIZADA, $objFetch->VALOR_COMERCIALIZADO, $objFetch->CONTIDO, $objFetch->TEOR_MEDIO, $substancia, $producaoBruta);
		return $producaoBeneficiada;
	}

	public function completarSubstancia(ProducaoBeneficiada $producaoBeneficiada) {
		$substanciaSombra = new SubstanciaSombra();
		$producaoBeneficiada->setSubstancia($substanciaSombra->selecionarSubstancia($producaoBeneficiada->getSubstancia()));
	}
}
?>