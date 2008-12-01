<?php
include_once 'classes/interface/Index.php';
include_once 'classes/interface/GeradorFormulario.php';

class AdmLogin extends Index {
	public function exibirMenu(){
		return '&nbsp;';
	}
	
	protected function exibirConteudoPagina(){
		$geradorFormulario = new GeradorFormulario();
		$texto = $this->gerarTagH2('Efetue Login');
		$texto .= $this->gerarParagrafo('Você tentou acessar uma página restrita, efetue login no formulário abaixo:');
		$texto .= $geradorFormulario->gerarOpenTagForm('?logar');
		$texto .= $this->gerarOpenTagTable(0, 3, 0, '60%');
		$texto .= $this->gerarOpenTagTableLine();
		$texto .= $this->gerarOpenTagTableCell(array('width' => '50%', 'align' => 'right'));
		$texto .= 'Usuário:';
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarOpenTagTableCell();
		$texto .= $geradorFormulario->gerarInputField('usuario', 20);
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarCloseTagTableLine();
		$texto .= $this->gerarOpenTagTableLine();
		$texto .= $this->gerarOpenTagTableCell(array('width' => '50%', 'align' => 'right'));
		$texto .= 'Senha:';
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarOpenTagTableCell(array('width' => '50%'));
		$texto .= $geradorFormulario->gerarPasswordField('senha', 20);
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarCloseTagTableLine();
		$texto .= $this->gerarOpenTagTableLine();
		$texto .= $this->gerarOpenTagTableCell();
		$texto .= '&nbsp;';
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarOpenTagTableCell();
		$texto .= $geradorFormulario->gerarBotaoSubmit('Logar-se', 'botaoLogin');
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarOpenTagTableLine();
		$texto .= $this->gerarCloseTagTable();
		$texto .= $geradorFormulario->gerarCloseTagForm();
		$retorno = $this->gerarDiv($texto, array('class' => 'divConteudo'));
		return $retorno;
	}
}
?>
