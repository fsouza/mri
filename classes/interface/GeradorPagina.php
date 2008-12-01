<?php
include_once 'classes/interface/GeradorTag.php';

abstract class GeradorPagina extends GeradorTag {
	protected $titulo;
	protected $menu;
	protected $conteudo;

	function __construct($titulo, $conteudo= ''){
		$this->titulo = $titulo;
		$this->conteudo = $conteudo;
	}

	public function setTitulo($val){
		$this->titulo = $val;
	}

	public function setMenu(array $itensMenu){
		$this->menu = $itensMenu;
	}

	public function setConteudo($conteudo){
		$this->conteudo = $conteudo;
	}

	protected function adicionarItensNoMenu(array $itensMenu){
		foreach($itensMenu as $texto => $link){
			$this->menu[$texto] = $link;
		}
	}

	public function adicionarItemNoMenu($texto, $destino){
		$this->adicionarItensNoMenu(array($texto => $destino));
	}

	protected abstract function exibirTopo();
	protected abstract function exibirRodape();
	protected abstract function exibirMenu();
	public abstract function exibirPagina();
}
?>
