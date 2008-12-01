<?php

require_once ('Producao.php');
require_once ('ProducaoBeneficiada.php');
require_once ('ReservaMineral.php');


/**
 * class ProducaoBruta
 */
class ProducaoBruta extends Producao
{
	private $reservasMinerais;
	private $producaoBeneficiada;

	public function getReservasMinerais() {
		return $this->reservasMinerais;
	}

	public function setReservasMinerais($val) {
		if(is_array($val)) {
			$this->reservasMinerais = $val;
		}
	}

	public function getProducaoBeneficiada () {
		return $this->producaoBeneficiada;
	}

	public function setProducaoBeneficiada ($val) {
		$this->producaoBeneficiada = $val;
	}
} // end of ProducaoBruta
?>
