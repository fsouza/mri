<?php
include_once 'classes/interface/Index.php';
include_once 'classes/sombra/SubstanciaSombra.php';
include_once 'classes/sombra/ReservaMineralSombra.php';
include_once 'classes/sombra/ProducaoBrutaSombra.php';
include_once 'classes/sombra/ProducaoBeneficiadaSombra.php';
include_once 'classes/sombra/LavraUsinaSombra.php';
include_once 'classes/sombra/LavraMinaSombra.php';

class DetalheSubstancia extends Index {
	private $substancia;
	private $reservaMineral;
	private $producaoBruta;
	private $producaoBeneficiada;
	private $lavraMina;
	private $lavraUsina;

	function __construct($idtSubstancia){
		$sombraSubstancia = new SubstanciaSombra();
		$sombraReserva = new ReservaMineralSombra();
		$sombraProducaoBruta = new ProducaoBrutaSombra();
		$sombraProducaoBeneficiada = new ProducaoBeneficiadaSombra();
		$sombraLavraMina = new LavraMinaSombra();
		$sombraLavraUsina = new LavraUsinaSombra();
		try {
			$this->substancia = $sombraSubstancia->selecionarSubstanciaPeloIdt($idtSubstancia);
			$this->titulo = 'MRI | Detalhes para '.utf8_encode($this->substancia->getNome());
			$this->reservaMineral = $sombraReserva->selecionarReservaMineralPorSubstancia($this->substancia);
			$this->producaoBruta = $sombraProducaoBruta->selecionarProducaoBrutaPorSubstancia($this->substancia);
			$this->producaoBeneficiada = $sombraProducaoBeneficiada->selecionarProducaoBeneficiadaPorSubstancia($this->substancia);
			$this->lavraMina = $sombraLavraMina->selecionarLavraMinasPorSubstancia($this->substancia);
			$this->lavraUsina = $sombraLavraUsina->selecionarLavraUsinasPorSubstancia($this->substancia);
		} catch (SubstanciaDesconhecidaException $e) {
			header('Location: mri.php?home');
			exit(0);
		}
	}

	protected function exibirConteudoPagina(){
		$fotoSubstancia = $this->gerarImagem('imagem.php?idt='.$this->substancia->getFoto()->getIdt(), 0, array('align' => 'right', 'class' => 'fotoSubstancia'));
		$texto = $this->gerarTagH2(utf8_encode($this->substancia->getNome()));
		$texto .= $this->gerarParagrafo($fotoSubstancia, 'right');
		$texto .= $this->gerarParagrafo(nl2br(utf8_encode($this->substancia->getDescricao())), 'justify');
		if($this->reservaMineral){
			$textoRM = $this->gerarTagH4('Reserva Mineral');
			$quantReservaMineral = count($this->reservaMineral);
			for($i = 0; $i < $quantReservaMineral; $i++){
				$textoRM .= sprintf("Medida: %d.<br />",$this->reservaMineral[$i]->getMedida());
				$textoRM .= sprintf("Indicada: %d.<br />", $this->reservaMineral[$i]->getIndicada());
				$textoRM .= sprintf("Inferida: %d.<br />", $this->reservaMineral[$i]->getInferida());
				$textoRM .= sprintf("Lavrável: %d.<br />", $this->reservaMineral[$i]->getLavravel());
				$texto .= $this->gerarDiv($textoRM, array('class' => 'divRM'));
			}
		}
		if($this->producaoBruta){
			$textoPBr = $this->gerarTagH4('Producao Bruta');
			$quantProducaoBruta = count($this->producaoBruta);
			for($i = 0; $i < $quantProducaoBruta; $i++){
				$textoPBr .= sprintf("Quantidade Produzida: %s.<br />", $this->producaoBruta[$i]->getQuantidadeProduzida());
				$textoPBr .= sprintf("Quantidade Comercializada: %s.<br />", $this->producaoBruta[$i]->getQuantidadeComercializada());
				$textoPBr .= sprintf("Valor Comercializado: %s.<br />", $this->producaoBruta[$i]->getValorComercializado());
				$textoPBr .= sprintf("Contido: %s.<br />", $this->producaoBruta[$i]->getContido());
				$textoPbr .= sprintf("Teor médio: %s.<br />", $this->producaoBruta[$i]->getTeorMedio());
				$texto .= $this->gerarDiv($textoPBr, array('class' => 'divRM'));
			}
		}
		if($this->producaoBeneficiada){
			$textoPBe = $this->gerarTagH4('Producao Beneficiada');
			$quantProducaoBeneficiada = count($this->producaoBeneficiada);
			for($i = 0; $i < $quantProducaoBeneficiada; $i++){
				$textoPBe .= sprintf("Quantidade Produzida: %s.<br />", $this->producaoBeneficiada[$i]->getQuantidadeProduzida());
				$textoPBe .= sprintf("Quantidade Comercializada: %s.<br />", $this->producaoBeneficiada[$i]->getQuantidadeComercializada());
				$textoPBe .= sprintf("Valor Comercializado: %s.<br />", $this->producaoBeneficiada[$i]->getValorComercializado());
				$textoPBe .= sprintf("Contido: %s.<br />", $this->producaoBeneficiada[$i]->getContido());
				$textoPbe .= sprintf("Teor médio: %s.<br />", $this->producaoBeneficiada[$i]->getTeorMedio());
				$texto .= $this->gerarDiv($textoPBe, array('class' => 'divRM'));
			}
		}
		if($this->lavraMina){
			$textoLM = $this->gerarTagH4('Minas');
			$quantLavraMina = count($this->lavraMina);
			for($i = 0; $i < $quantLavraMina; $i++){
				$textoLM .= sprintf("Pequenas: %s.<br />", $this->lavraMina[$i]->getQuantidadePequena());
				$textoLM .= sprintf("Médias: %s.<br />", $this->lavraMina[$i]->getQuantidadeMedia());
				$textoLM .= sprintf("Grandes: %s.<br />", $this->lavraMina[$i]->getQuantidadeGrande());
				$texto .= $this->gerarDiv($textoLM, array('class' => 'divRM'));
			}
		}
		if($this->lavraUsina){
			$textoLU = $this->gerarTagH4('Usinas');
			$quantLavraUsina = count($this->lavraUsina);
			for($i = 0; $i < $quantLavraUsina; $i++){
				$textoLU .= sprintf("Pequenas: %s.<br />", $this->lavraUsina[$i]->getQuantidadePequena());
				$textoLU .= sprintf("Médias: %s.<br />", $this->lavraUsina[$i]->getQuantidadeMedia());
				$textoLU .= sprintf("Grandes: %s.<br />", $this->lavraUsina[$i]->getQuantidadeGrande());
				$texto .= $this->gerarDiv($textoLU, array('class' => 'divRM'));
			}
		}
		$texto .= $this->gerarParagrafo($this->gerarLink('index.php?home', 'Voltar'), 'center', array('class' => 'btnVoltar'));
		return $this->gerarDiv($texto, array('class' => 'divSubstancia'));
	}
}
?>