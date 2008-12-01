<?php
include_once 'classes/dominio/ProducaoBruta.php';
include_once 'classes/dominio/ReservaMineral.php';
include_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/ReservasMineraisProducaoBruta.php';

class ReservasMineraisProducaoBrutaSombra {
	private $idt_reservas_minerais_producao_bruta;
	private $fk_reserva_mineral;
	private $fk_producao_bruta;
	private $conexao;

	private function prepararObjeto(ReservasMineraisProducaoBruta $obj) {
		$producaoBruta = $obj->getProducaoBruta();
		$reservaMineral = $obj->getReservaMineral();
		$this->idt_reservas_minerais_producao_bruta = $obj->getIdt();
		$this->fk_producao_bruta = (is_numeric($producaoBruta->getIdt()) ? $producaoBruta->getIdt() : '');
		$this->fk_reserva_mineral = (is_numeric($reservaMineral->getIdt()) ? $reservaMineral->getIdt() : '');
		$this->conexao = Conexao::conectar();
	}

	public function inserirReservasMineraisProducaoBruta(ReservasMineraisProducaoBruta $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("INSERT INTO reservas_minerais_producao_bruta (idt_reservas_minerais_producao_bruta, fk_reserva_mineral, fk_producao_bruta) VALUES (%d, %d, %d)", $this->idt_reservas_minerais_producao_bruta, $this->fk_reserva_mineral, $this->fk_producao_bruta);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insercao != false);
	}

	public function alterarReservasMineraisProducaoBruta(ReservasMineraisProducaoBruta $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("UPDATE reservas_minerais_producao_bruta SET fk_reserva_mineral = %d, fk_producao_bruta = %d WHERE idt_reservas_minerais_producao_bruta = %d", $this->fk_reserva_mineral, $this->fk_producao_bruta, $this->idt_reservas_minerais_producao_bruta);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	public function apagarReservasMineraisProducaoBruta(ReservasMineraisProducaoBruta $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("DELETE FROM reservas_minerais_producao_bruta WHERE idt_reservas_minerais_producao_bruta = %d", $this->idt_reservas_minerais_producao_bruta);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($delete != false);
	}

	public function selecionarReservasMineraisProducaoBruta(ReservasMineraisProducaoBruta $obj) {
		$this->prepararObjeto($obj);
		$comandoSql = sprintf("SELECT * FROM reservas_minerais_producao_bruta WHERE idt_reservas_minerais_producao_bruta = %d", $this->idt_reservas_minerais_producao_bruta);
		$resultado = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		$objFetch = $resultado->FetchNextObject();
		$obj->getProducaoBruta()->setIdt($objFetch->FK_PRODUCAO_BRUTA);
		$obj->getReservaMineral()->setIdt($objFetch->FK_RESERVA_MINERAL);
	}

	public function selecionarReservaMineralPorProducaoBruta(ProducaoBruta $producaoBruta) {
		$reservasMinerais = array();
		$substancias = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT	rm.*,
										rmpb.*
										FROM	reservas_minerais rm,
												reservas_minerais_producao_bruta rmpb
										WHERE	rmpb.fk_reserva_mineral = rm.idt_reserva_mineral AND
												rmpb.fk_producao_bruta = %d", $producaoBruta->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$conn->Close();
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$substancias[$i] = new Substancia($objFetch->FK_SUBSTANCIA);
			$reservasMinerais[$i] = new ReservaMineral($objFetch->IDT_PRODUCAO_BRUTA, $objFetch->MEDIDA, $objFetch->INDICADA, $objFetch->INFERIDA, $objFetch->LAVRAVEL, $substancias[$i]);
			$i++;
		}
		return $reservasMinerais;
	}
}
?>