<?php
include_once 'classes/interface/Index.php';

class AdmIndex extends Index {
	function __construct($titulo, $conteudo = ''){
		$this->titulo = $titulo;
		$this->conteudo = $conteudo;
		$this->menu = array("Reservas Minerais" => "?administracao&reservaMineral",
							"Produções Brutas" => "?administracao&producaoBruta",
							"Produções Beneficiadas" => "?administracao&producaoBeneficiada",
							"Produções das Reservas" => "?administracao&producoesReservas",
							"Substâncias de Cidades" => "?administracao&substanciasCidades",
							"Lavras em Minas" => "?administracao&minas",
							"Lavras em Usinas" => "?administracao&usinas",
							"Efetuar Logout" => "?sair",
							"Página Inicial do MRI" => "?home");
	}
	
	protected function exibirConteudoPagina(){
		$texto = $this->gerarTagH2('Administração do MRI');
		$texto .= $this->gerarParagrafo('Navegue nas categorias do menu ao lado para administrar o MRI.');
		return $this->gerarDiv($texto, array('class' => 'divConteudo'));
	}

	protected function exibirLadoEsquerdo(){
		$retorno = $this->gerarOpenTagTableLine();
		$retorno .= $this->gerarOpenTagTableCell(array('width' => '20%', 'valign' => 'top'));
		$retorno .= $this->exibirMenu();
		$retorno .= $this->gerarCloseTagTableCell();
		return $retorno;
	}	

	protected function exibirMenu(){
		if(!(is_array($this->menu))){
			return '';
		}
		$div = $this->gerarOpenTagTable(0, 1, 1, '100%', array('class' => 'tabMenu'));
		$div .= $this->gerarOpenTagTableLine();
		$div .= $this->gerarOpenTagTableCell(array('bgcolor' => '#EEEEEE'));
		$div .= $this->gerarTitulo('Administrar');
		foreach($this->menu as $texto => $link){
			$div .= $this->gerarOpenTagTableLine();
			$div .= $this->gerarOpenTagTableCell(array('bgcolor' => '#EEEEEE', 'height' => '20px'));
			$div .= $this->gerarLink($link, $texto);
			$div .= $this->gerarCloseTagTableCell();
			$div .= $this->gerarCloseTagTableLine();
		}
		$div .= $this->gerarCloseTagTable();
		$retorno = $this->gerarDiv($div, array('class' => 'divMenu'));
		return $retorno;
	}
}
?>