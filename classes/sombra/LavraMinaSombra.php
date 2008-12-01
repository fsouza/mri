<?php
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/LavraMina.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/dominio/NaoMetalica.php';
include_once 'classes/dominio/Metalica.php';
include_once 'classes/dominio/Gema.php';
include_once 'classes/sombra/SubstanciaSombra.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class LavraMinaSombra {
	private $idt_lavra_usina;
	private $qtd_media;
	private $qtd_grande;
	private $qtd_pequena;
	private $fk_substancia;
	private $conexao;

	private function prepararObjeto(LavraMina $lavraMina) {
		$idt = $lavraMina->getIdt();
		$q_m = $lavraMina->getQuantidadeMedia();
		$q_p = $lavraMina->getQuantidadePequena();
		$q_g = $lavraMina->getQuantidadeGrande();
		$this->idt_lavra_usina = (is_numeric($idt) ? $idt : '');
		$this->qtd_media = (is_numeric($q_m) ? $q_m : '');
		$this->qtd_grande = (is_numeric($q_g) ? $q_g : '');
		$this->qtd_pequena = (is_numeric($q_p) ? $q_p : '');
		$this->fk_substancia = $lavraMina->getSubstancia()->getIdt();
		$this->conexao = Conexao::conectar();
	}

	public function inserirLavraMina(LavraMina $lavraMina) {
		$this->prepararObjeto($lavraMina);
		$comandoSql = sprintf("INSERT INTO lavra_mina (idt_lavra_mina, qtd_media, qtd_grande, qtd_pequena, fk_substancia)");
		$comandoSql = sprintf("%s VALUES (%d, %d, %d, %d, %d)", $comandoSql, $this->idt_lavra_mina, $this->qtd_media, $this->qtd_grande, $this->qtd_pequena, $this->fk_substancia);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($insercao != false);
	}

	public function alterarLavraMina(LavraMina $lavraMina) {
		$this->prepararObjeto($lavraMina);
		$comandoSql = sprintf("UPDATE lavra_mina SET qtd_media = %d, qtd_grande = %d, qtd_pequena = %d, fk_substancia = %d WHERE idt_lavra_mina = %d", $this->qtd_media, $this->qtd_grande, $this->qtd_pequena, $this->fk_substancia, $this->idt_lavra_mina);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($update != false);
	}

	public function apagarLavraMina(LavraMina $lavraMina) {
		$this->prepararObjeto($lavraMina);
		$comandoSql = sprintf("DELETE FROM lavra_mina WHERE idt_lavra_mina = %d", $this->idt_lavra_mina);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($delete != false);
	}

	public function selecionarLavraMina(LavraMina $lavraMina) {
		$this->prepararObjeto($lavraMina);
		$comandoSql = sprintf("SELECT * FROM lavra_mina WHERE idt_lavra_mina = %d", $this->idt_lavra_mina);
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
		$objLavraMina = new LavraMina($objFetch->IDT_LAVRA_USINA, $objFetch->QUANTIDADE_GRANDE, $objFetch->QUANTIDADE_MEDIA, $objFetch->QUANTIDADE_PEQUENA, $substancia);
		return $objLavraMina;
	}

	public function selecionarTodasAsLavraMinas() {
		$lavraMinas = array();
		$substancias = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT lm.*, s.idt_substancia, s.tipo_substancia FROM lavra_mina lm, substancia s WHERE lm.fk_substancia = s.idt_substancia");
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
			$lavraMinas[$i] = new LavraMina($objFetch->IDT_LAVRA_MINA, $objFetch->QTD_GRANDE, $objFetch->QTD_MEDIA, $objFetch->QTD_PEQUENA, $substancias[$i]);
			$i++;
		}
		return $lavraMinas;
	}

	public function selecionarLavraMinasPorSubstancia(Substancia $substancia) {
		$lavraMinas = array();
		$fkSubstancia = $substancia->getIdt();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM lavra_mina WHERE fk_substancia = %d", $fkSubstancia);
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$lavraMinas[$i] = new LavraMina($objFetch->IDT_LAVRA_MINA, $objFetch->QTD_GRANDE, $objFetch->QTD_MEDIA, $objFetch->QTD_PEQUENA, $substancia);
			$i++;
		}
		return $lavraMinas;
	}

	public function completarSubstancia(LavraMina $lavraMina) {
		$substanciaSombra = new SubstanciaSombra();
		$lavraMina->setSubstancia($substanciaSombra->selecionarSubstancia($lavraMina->getSubstancia()));
	}
}
?>