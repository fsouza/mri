<?php
include_once 'classes/interface/GeradorTag.php';

class GeradorFormulario extends GeradorTag {
	public function gerarOpenTagForm($action, $method = 'POST', array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<form action=\"$action\" method=\"$method\" $args>\n";
	}

	public function gerarCloseTagForm(){
		return "</form>\n";
	}

	public function gerarOpenTagFormUpload($action, array $argumentos = NULL){
		$argumentos['enctype'] = 'multipart/form-data';
		return $this->gerarOpenTagForm($action, 'POST', $argumentos);
	}

	public function gerarInputFieldWithLabel($label, $nome, $size, $type = 'text', $valor = '', array $argumentos = NULL){
		$retorno = "$label: ";
		$retorno .= $this->gerarInputField($nome, $size, $type, $valor, $argumentos);		
		return $retorno;
	}
	
	public function gerarInputField($nome, $size, $type = 'text', $valor = '', array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<input name=\"$nome\" value=\"$valor\" size=\"$size\" type=\"$type\" $args />\n";
	}
	
	public function gerarPasswordField($nome, $size, array $argumentos = NULL){
		return $this->gerarInputField($nome, $size, 'password', '', $argumentos);
	}
	 
	public function gerarPasswordFieldWithLabel($label, $size, array $argumentos = NULL){
		return $this->gerarInputFieldWithLabel($label, $nome, $size, 'password', '', $argumentos);
	}
	
	public function gerarSelect($nome, array $itens, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		$retorno = "<select name=\"$nome\" $args>\n";
		foreach($itens as $valor => $titulo){
			$retorno .= "  <option value=\"$valor\">$titulo</option>\n";
		}
		$retorno = "</select>\n";
		return $retorno;
	}
	
	public function gerarSelectWithLabel($label, $nome, array $itens, array $argumentos = NULL){
		$retorno = "$label: ";
		$retorno .= $this->gerarSelect($nome, $itens, $argumentos);
		return $retorno;
	}
	
	public function gerarFileField($nome, $size, array $argumentos = NULL){
		return $this->gerarInputField($nome, $size, 'file', '', $argumentos);
	}
	
	public function gerarFileFieldWithLabel($label, $nome, $size, array $argumentos = NULL){
		return $this->gerarInputFieldWithLabel($label, $nome, $size, 'file', '', $argumentos);
	}
	
	private function gerarBotao($texto, $nome, $type, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<input type=\"$type\" value=\"$texto\" name=\"$nome\" id=\"$nome\" $args />";
	}
	
	public function gerarBotaoSubmit($texto, $nome, array $argumentos = NULL){
		return $this->gerarBotao($texto, $nome, 'submit', $argumentos);
	}
	
	public function gerarBotaoReset($texto, $nome, array $argumentos = NULL){
		return $this->gerarBotao($texto, $nome, 'reset', $argumentos);
	}
}
?>