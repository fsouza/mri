<?php
include_once 'classes/interface/Index.php';

class Erro extends Index {
	private $mensagem;

	function __construct($mensagem){
		$this->titulo = 'MRI | Erro';
		$this->mensagem = $mensagem;
	}

	protected function exibirLadoEsquerdo(){

	}

	private function exibirMensagemDeErro(){
		return $this->mensagem;
	}

	protected function exibirMeioDireita(){
		$retorno = $this->gerarOpenTagTable(0, 150, 0);
		$retorno .= $this->gerarOpenTagTableLine();
		$retorno .= $this->gerarOpenTagTableCell(array('width' => '100%', 'valign' => 'middle', 'align' => 'center', 'height' => '200'));
		$texto = $this->exibirMensagemDeErro();
		$texto .= '<br />';
		$texto .= $this->gerarLink('index.php?home', '[[Página Inicial]]'); 
		$retorno .= $this->gerarDiv($texto, array('class' => 'divErro'));
		$retorno .= $this->gerarCloseTagTableCell();
		$retorno .= $this->gerarCloseTagTableLine();
		$retorno .= $this->gerarCloseTagTable();
		return $retorno;
	}

	public function exibirPagina(){
		echo $this->gerarTagHtmlStrict();
		echo $this->gerarTagHead($this->titulo, NULL, 'estilo.css', 'script.js');
		echo $this->gerarOpenTagBody();
		echo $this->exibirMeioDireita();
		echo $this->gerarCloseTagsBodyHtml();
	}
}
?>
