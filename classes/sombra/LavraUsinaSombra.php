<?php
include_once 'classes/dominio/LavraUsina.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/bd/Conexao.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class LavraUsinaSombra {
	private $idt_lavra_usina;
	private $qtd_media;
	private $qtd_grande;
	private $qtd_pequena;
	private $fk_substancia;
	private $conexao;

	private function prepararObjeto(LavraUsina $lavraUsina) {
		$idt = $lavraUsina->getIdt();
		$q_m = $lavraUsina->getQuantidadeMedia();
		$q_p = $lavraUsina->getQuantidadePequena();
		$q_g = $lavraUsina->getQuantidadeGrande();
		$this->idt_lavra_usina = (is_numeric($idt) ? $idt : '');
		$this->qtd_media = (is_numeric($q_m) ? $q_m : '');
		$this->qtd_grande = (is_numeric($q_g) ? $q_g : '');
		$this->qtd_pequena = (is_numeric($q_p) ? $q_p : '');
		$this->fk_substancia = $lavraUsina->getSubstancia()->getIdt();
		$this->conexao = Conexao::conectar();
	}

	public function inserirLavraUsina(LavraUsina $lavraUsina) {
		$this->prepararObjeto($lavraUsina);
		$comandoSql = sprintf("INSERT INTO lavra_usina (idt_lavra_usina, qtd_media, qtd_grande, qtd_pequena, fk_substancia)");
		$comandoSql = sprintf("%s VALUES (%d, %d, %d, %d, %d)", $comandoSql, $this->idt_lavra_usina, $this->qtd_media, $this->qtd_grande, $this->qtd_pequena, $this->fk_substancia);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($insercao != false);
	}

	public function alterarLavraUsina(LavraUsina $lavraUsina) {
		$this->prepararObjeto($lavraUsina);
		$comandoSql = sprintf("UPDATE lavra_usina SET qtd_media = %d, qtd_grande = %d, qtd_pequena = %d, fk_substancia = %d WHERE idt_lavra_usina = %d", $this->qtd_media, $this->qtd_grande, $this->qtd_pequena, $this->fk_substancia, $this->idt_lavra_usina);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($update != false);
	}

	public function apagarLavraUsina(LavraUsina $lavraUsina) {
		$this->prepararObjeto($lavraUsina);
		$comandoSql = sprintf("DELETE FROM lavra_usina WHERE idt_lavra_usina = %d", $this->idt_lavra_usina);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($delete != false);
	}

	public function selecionarLavraUsina(LavraUsina $lavraUsina) {
		$this->prepararObjeto($lavraUsina);
		$comandoSql = sprintf("SELECT	lu.*,
										s.idt_substancia,
										s.tipo_substancia
										FROM	lavra_usina lu,
												substancia s
										WHERE	lu.fk_substancia = s.idt_substancia,
												lu.idt_lavra_usina = %d", $this->idt_lavra_usina);
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
		$objLavraUsina = new LavraUsina($objFetch->IDT_LAVRA_USINA, $objFetch->QUANTIDADE_GRANDE, $objFetch->QUANTIDADE_MEDIA, $objFetch->QUANTIDADE_PEQUENA, $substancia);
		return $objLavraUsina;
	}

	public function selecionarTodasAsLavraUsinas() {
		$lavraUsinas = array();
		$substancias = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT lu.*, s.idt_substancia, s.tipo_substancia FROM lavra_usina lu, substancia s WHERE lu.fk_substancia = s.idt_substancia");
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
			$lavraUsinas[$i] = new LavraUsina($objFetch->IDT_LAVRA_USINA, $objFetch->QTD_GRANDE, $objFetch->QTD_MEDIA, $objFetch->QTD_PEQUENA, $substancias[$i]);
			$i++;
		}
		return $lavraUsinas;
	}

	public function selecionarLavraUsinasPorSubstancia(Substancia $substancia) {
		$lavraUsinas = array();
		$fkSubstancia = $substancia->getIdt();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM lavra_usina WHERE fk_substancia = %d", $fkSubstancia);
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$lavraUsinas[$i] = new LavraUsina($objFetch->IDT_LAVRA_USINA, $objFetch->QTD_GRANDE, $objFetch->QTD_MEDIA, $objFetch->QTD_PEQUENA, $substancia);
			$i++;
		}
		return $lavraUsinas;
	}

	public function completarSubstancia(LavraUsina $lavraUsina) {
		$substanciaSombra = new SubstanciaSombra();
		$lavraUsina->setSubstancia($substanciaSombra->selecionarSubstancia($lavraUsina->getSubstancia()));
	}
}
?>