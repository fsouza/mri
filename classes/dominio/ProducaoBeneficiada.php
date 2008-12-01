<?php
require_once ('Producao.php');
require_once ('ProducaoBruta.php');


/**
 * class ProducaoBeneficiada
 */
class ProducaoBeneficiada extends Producao
{
	private $producaoBruta;
	
	function __construct($idt = '', $quantidadeProduzida = '', $quantidadeComercializada = '', $valorComercializado = '', $contido = '', $teorMedio = '', Substancia $substancia = NULL, ProducaoBruta $producaoBruta = NULL) {
		$this->setIdt((is_numeric($idt) ? $idt : ''));
		$this->setQuantidadeProduzida((is_numeric($quantidadeProduzida) ? $quantidadeProduzida : '0'));
		$this->setQuantidadeComercializada((is_numeric($quantidadeComercializada) ? $quantidadeComercializada : '0'));
		$this->setValorComercializado((is_numeric($valorComercializado) ? $valorComercializado : '0'));
		$this->setContido((is_numeric($contido) ? $contido : '0'));
		$this->setTeorMedio((is_numeric($teorMedio) ? $teorMedio : '0'));
		$this->setSubstancia((($substancia instanceof Substancia) ? $substancia : NULL));
		$this->setProducaoBruta($producaoBruta);
	}
	
	public function __toString(){
		return sprintf("%s %s %s", $this->getTeorMedio(), $this->getQuantidadeComercializada(), $this->getValorComercializado());
	}

	public function getProducaoBruta () {
		return $this->producaoBruta;
	}
	
	public function setProducaoBruta ($val) {
		$this->producaoBruta = $val;
	}
} // end of ProducaoBeneficiada
?>
