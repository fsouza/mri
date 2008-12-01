<?php
include_once 'classes/dominio/ReservaMineral.php';
include_once 'classes/bd/Conexao.php';
include_once 'classes/sombra/SubstanciaSombra.php';
include_once 'classes/dominio/Substancia.php';
include_once 'classes/dominio/ProducaoBruta.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class ReservaMineralSombra {
	private $idt_reserva_mineral;
	private $medida;
	private $indicada;
	private $inferida;
	private $lavravel;
	private $fk_substancia;
	private $conexao;

	private function prepararObjeto(ReservaMineral $reservaMineral) {
		$idt = $reservaMineral->getIdt();
		$med = $reservaMineral->getMedida();
		$ind = $reservaMineral->getIndicada();
		$inf = $reservaMineral->getInferida();
		$lav = $reservaMineral->getLavravel();
		$this->idt_reserva_mineral = (is_numeric($idt) ? $idt : '');
		$this->medida = (is_numeric($med) ? $med : '');
		$this->inferida = (is_numeric($inf) ? $inf : '');
		$this->indicada = (is_numeric($ind) ? $ind : '');
		$this->lavravel = (is_numeric($lav) ? $lav : '');
		$this->fk_substancia = $reservaMineral->getSubstancia()->getIdt();
		$this->conexao = Conexao::conectar();
	}

	public function inserirReservaMineral(ReservaMineral $reservaMineral) {
		$this->prepararObjeto($reservaMineral);
		$comandoSql = sprintf("INSERT INTO reserva_mineral (idt_reserva_mineral, medida, indicada, inferida, lavravel, fk_substancia)");
		$comandoSql = sprintf("%s VALUES (%d, %d, %d, %d, %d, %d)", $comandoSql, $this->idt_reserva_mineral, $this->medida, $this->indicada, $this->inferida, $this->lavravel, $this->fk_substancia);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($insercao != false);
	}

	public function alterarReservaMineral(ReservaMineral $reservaMineral) {
		$this->prepararObjeto($reservaMineral);
		$comandoSql = sprintf("UPDATE reserva_mineral SET medida = %d", $this->medida);
		$comandoSql = sprintf("%s, indicada = %d, inferida = %d, lavravel = %d, fk_substancia = %d", $comandoSql, $this->indicada, $this->inferida, $this->lavravel, $this->fk_substancia);
		$comandoSql = sprintf("%s WHERE idt_reserva_mineral = %d", $comandoSql, $this->idt_reserva_mineral);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($update != false);
	}

	public function apagarReservaMineral(ReservaMineral $reservaMineral) {
		$this->prepararObjeto($reservaMineral);
		$comandoSql = sprintf("DELETE FROM reserva_mineral WHERE idt_reserva_mineral = %d", $this->idt_reserva_mineral);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return($delete != false);
	}

	public function selecionarReservaMineral(ReservaMineral $reservaMineral) {
		$this->prepararObjeto($reservaMineral);
		$comandoSql = sprintf("SELECT	rm.*,
										s.idt_substancia,
										s.tipo_substancia
										FROM	reserva_mineral rm
												substancia s
										WHERE	rm.fk_substancia = s.idt_substancia AND
												rm.idt_reserva_mineral = %d", $this->idt_reserva_mineral);
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
		$objReservaMineral = new ReservaMineral($objFetch->IDT_RESERVA_MINERAL, $objFetch->MEDIDA, $objFetch->INDICADA, $objFetch->INFERIDA, $objFetch->LAVRAVEL, $substancia);
		return $objReservaMineral;
	}

	public function selecionarReservaMineralPorSubstancia(Substancia $substancia) {
		$reservasMinerais = array();
		$fkSubstancia = $substancia->getIdt();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM reserva_mineral WHERE fk_substancia = %d", $fkSubstancia);
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			$reservasMinerais[$i] = new ReservaMineral($objFetch->IDT_RESERVA_MINERAL, $objFetch->MEDIDA, $objFetch->INDICADA, $objFetch->INFERIDA, $objFetch->LAVRAVEL, $substancia);
			$i++;
		}
		$conn->Close();
		return $reservasMinerais;
	}

	public function selecionarTodasAsReservasMinerais() {
		$reservasMinerais = array();
		$substancias = array();
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT rm.*, s.idt_substancia, s.tipo_substancia FROM reserva_mineral rm, substancia s WHERE rm.fk_sbustancia = s.idt_substancia");
		$resultado = $conn->Execute($comandoSql);
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
			$reservasMinerais[$i] = new ReservaMineral($objFetch->IDT_RESERVA_MINERAL, $objFetch->MEDIDA, $objFetch->INDICADA, $objFetch->INFERIDA, $objFetch->LAVRAVEL, $substancias[$i]);
			$i++;
		}
		return $reservasMinerais;
	}

	public function completarSubstancia(ReservaMineral $reservaMineral) {
		$substanciaSombra = new SubstanciaSombra();
		$reservaMineral->setSubstancia($substanciaSombra->selecionarSubstancia($reservaMineral->getSubstancia()));
	}

}
?>