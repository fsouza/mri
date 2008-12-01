<?php
include_once 'classes/dominio/Substancia.php';
include_once 'classes/dominio/NaoMetalica.php';
include_once 'classes/dominio/Metalica.php';
include_once 'classes/dominio/Gema.php';
require_once 'classes/bd/Conexao.php';
include_once 'classes/dominio/Foto.php';
include_once 'classes/sombra/SubstanciasCidadeSombra.php';
include_once 'classes/dominio/Cidade.php';
include_once 'classes/sombra/CorSombra.php';
include_once 'classes/sombra/FotoSombra.php';
include_once 'classes/excecoes/SubstanciaDesconhecidaException.php';

class SubstanciaSombra {
	private $idt_substancia;
	private $nome_substancia;
	private $descricao_substancia;
	private $tipo_substancia;
	private $fk_foto;
	private $fk_cor;
	private $conexao;

	private function prepararObjeto(Substancia $substancia) {
		$nome = $substancia->getNome();
		$idt = $substancia->getIdt();
		$descricao = $substancia->getDescricao();
		$this->idt_substancia = (is_numeric($idt) ? $idt : '');
		$this->fk_foto = $substancia->getFoto()->getIdt();
		$this->fk_cor = $substancia->getCor()->getIdt();
		$this->nome_substancia = (get_magic_quotes_gpc() ? $nome : addslashes($nome));
		$this->descricao_substancia = (get_magic_quotes_gpc() ? $descricao : addslashes($descricao));
		if(get_magic_quotes_gpc()) {
			if($substancia instanceof NaoMetalica) {
				$this->tipo_substancia = "Nao Metalica";
			} elseif ($substancia instanceof Metalica) {
				$this->tipo_substancia = "Metalica";
			} elseif ($substancia instanceof Gema) {
				$this->tipo_substancia = "Gema";
			} else {
				$this->tipo_substancia = '';
			}
		} else {
			if($substancia instanceof NaoMetalica) {
				$this->tipo_substancia = addslashes("Nao Metalica");
			} elseif ($substancia instanceof Metalica) {
				$this->tipo_substancia = addslashes("Metalica");
			} elseif ($substancia instanceof Gema) {
				$this->tipo_substancia = addslashes("Gema");
			} else {
				$this->tipo_substancia = '';
			}
		}
		$this->conexao = Conexao::conectar();
	}

	private function inserirSubstancia(Substancia $substancia) {
		$this->prepararObjeto($substancia);
		$comandoSql = sprintf("INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (%d, '%s', '%s', '%s', %d, %d)", $this->idt_substancia, $this->nome_substancia, $this->descricao_substancia, $this->tipo_substancia, $this->fk_foto, $this->fk_cor);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insercao != false);
	}

	private function alterarSubstancia(Substancia $substancia) {
		$this->prepararObjeto($substancia);
		$comandoSql = sprintf("UPDATE substancia SET nome_substancia = '%s', descricao_substancia = '%s', tipo_substancia = '%s', fk_foto = %d, fk_cor = %d WHERE idt_substancia = %d", $this->nome_substancia, $this->descricao_substancia, $this->tipo_substancia, $this->fk_foto, $this->fk_cor, $this->idt_substancia);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	private function apagarSubstancia(Substancia $substancia) {
		$this->prepararObjeto($substancia);
		$comandoSql = sprintf("DELETE FROM substancia WHERE idt_substancia = %d", $this->idt_substancia);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		unset($comandoSql);
		return ($delete != false);
	}

	public function selecionarSubstancia(Substancia $substancia) {
		$this->prepararObjeto($substancia);
		$comandoSql = sprintf("SELECT * FROM substancia WHERE idt_substancia = %d", $this->idt_substancia);
		$resultado = $this->conexao->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		switch($objFetch->TIPO_SUBSTANCIA) {
			case 'Metalica':
				$objSubstancia = new Metalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Nao Metalica':
				$objSubstancia = new NaoMetalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Gema':
				$objSubstancia = new Gema($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
			default:
				throw new SubstanciaDesconhecidaException();
		}
		$resultado->Close();
		$this->conexao->Close();
		return $objSubstancia;
	}

	public function selecionarTodasAsSubstancias($tipo = '') {
		$substancias = array();
		$fotos = array();
		$cores = array();
		if(empty($tipo)) {
			$comandoSql = sprintf("SELECT * FROM substancia ORDER BY nome_substancia");
			$tipoVazio = 1;
		} else {
			$tipo = (get_magic_quotes_gpc() ? $tipo : addslashes($tipo));
			$comandoSql = sprintf("SELECT * FROM substancia WHERE tipo_substancia = '%s' ORDER BY nome_substancia", $tipo);
			$tipoVazio = 0;
		}
		$conn = Conexao::conectar();
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($objFetch = $resultado->FetchNextObject()) {
			if($tipoVazio) {
				$tipo = (get_magic_quotes_gpc() ? $objFetch->TIPO_SUBSTANCIA : stripslashes($objFetch->TIPO_SUBSTANCIA));
			}
			$fotos[$i] = new Foto($objFetch->FK_FOTO);
			$cores[$i] = new cor($objFetch->FK_COR);
			if($tipo == "Metalica") {
				$substancias[$i] = new Metalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i], $cores[$i]);
			} elseif ($tipo == "Nao Metalica") {
				$substancias[$i] = new NaoMetalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i], $cores[$i]);
			} elseif ($tipo == "Gema") {
				$substancias[$i] = new Gema($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, $fotos[$i], $cores[$i]);
			}
			$i++;
		}
		$resultado->Close();
		$conn->Close();
		return $substancias;
	}

	public function selecionarSubstanciaPorCidade(Cidade $cidade) {
		$sombra = new SubstanciasCidadeSombra();
		return $sombra->selecionarSubstanciasPorCidade($cidade);
	}

	public function selecionarTodasAsSubstanciasComCor(){
		$substancias = $this->selecionarTodasAsSubstancias();
		$quantSubstancias = count($substancias);
		for($i = 0; $i < $quantSubstancias; $i++){
			$this->completarCorDeSubstancia($substancias[$i]);
		}
		return $substancias;
	}

	public function selecionarSubstanciaPorCor(Cor $cor){
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM substancia WHERE fk_cor = %d", $cor->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		switch($objFetch->TIPO_SUBSTANCIA){
			case 'Metalica':
				$substancia = new Metalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Nao Metalica':
				$substancia = new NaoMetalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Gema':
				$substancia = new Gema($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			default:
				throw new SubstanciaDesconhecidaException();
		}
		$resultado->Close();
		$conn->Close();
		return $substancia;
	}

	public function selecionarSubstanciaPeloIdt($idt){
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM substancia WHERE idt_substancia = %d", $idt);
		$resultado = $conn->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		switch($objFetch->TIPO_SUBSTANCIA){
			case 'Metalica':
				$substancia = new Metalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Nao Metalica':
				$substancia = new NaoMetalica($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			case 'Gema':
				$substancia = new Gema($objFetch->IDT_SUBSTANCIA, $objFetch->NOME_SUBSTANCIA, $objFetch->DESCRICAO_SUBSTANCIA, new Foto($objFetch->FK_FOTO), new Cor($objFetch->FK_COR));
				break;
			default:
				throw new SubstanciaDesconhecidaException();
		}
		$resultado->Close();
		$conn->Close();
		return $substancia;
	}

	private function completarCorDeSubstancia(Substancia $substancia){
		$sombraCor = new CorSombra();
		$substancia->setCor($sombraCor->selecionarCorDaSubstancia($substancia));
	}

	private function completarFotoDaSubstancia(Substancia $substancia){
		$sombraFoto = new FotoSombra();
		$substancia->setFoto($sombraFoto->selecionarFotoPorSubstancia($substancia));
	}

	public function selecionarSubstanciaCompleta(Substancia $substancia){
		$objSubstancia = $this->selecionarSubstancia($substancia);
		$this->completarCorDeSubstancia($objSubstancia);
		$this->completarFotoDaSubstancia($objSubstancia);
		return $objSubstancia;
	}

	/* Métodos "apelidos" */
	public function inserirSubstanciaMetalica(Metalica $substancia) {
		return $this->inserirSubstancia($substancia);
	}

	public function inserirSubstanciaNaoMetalica(NaoMetalica $substancia) {
		return $this->inserirSubstancia($substancia);
	}

	public function inserirSubstanciaGema(Gema $substancia) {
		return $this->inserirSubstancia($substancia);
	}

	public function alterarSubstanciaMetalica(Metalica $substancia) {
		return $this->alterarSubstancia($substancia);
	}

	public function alterarSubstanciaNaoMetalica(NaoMetalica $substancia) {
		return $this->alterarSubstancia($substancia);
	}

	public function alterarSubstanciaGema(Gema $substancia) {
		return $this->alterarSubstancia($substancia);
	}

	public function apagarSubstanciaMetalica(Metalica $substancia) {
		return $this->apagarSubstancia($substancia);
	}

	public function apagarSubstanciaNaoMetalica(NaoMetalica $substancia) {
		return $this->apagarSubstancia($substancia);
	}

	public function apagarSubstanciaGema(Gema $substancia) {
		return $this->apagarSubstancia($substancia);
	}

	public function selecionarSubstanciaMetalica(Metalica $substancia) {
		return $this->selecionarSubstancia($substancia);
	}

	public function selecionarSubstanciaNaoMetalica(NaoMetalica $substancia) {
		return $this->selecionarSubstancia($substancia);
	}

	public function selecionarSubstanciaGema(Gema $substancia) {
		return $this->selecionarSubstancia($substancia);
	}

	public function selecionarTodosOsTipos() {
		return $this->selecionarTodasAsSubstancias();
	}

	public function selecionarSubstanciaMetalicaCompleta(Metalica $substancia){
		return $this->selecionarSubstanciaCompleta($substancia);
	}

	public function selecionarSubstanciaNaoMetalicaCompleta(NaoMetalica $substancia){
		return $this->selecionarSubstanciaCompleta($substancia);
	}

	public function selecionarSubstanciaGemaCompleta(Gema $substancia){
		return $this->selecionarSubstanciaCompleta($substancia);
	}

	public function selecionarTodasAsSubstanciasMetalicas() {
		return $this->selecionarTodasAsSubstancias('Metalica');
	}

	public function selecionarTodasAsSubstanciasNaoMetalicas() {
		return $this->selecionarTodasAsSubstancias('Nao Metalica');
	}

	public function selecionarTodasAsSubstanciasGemas() {
		return $this->selecionarTodasAsSubstancias('Gema');
	}
}
?>