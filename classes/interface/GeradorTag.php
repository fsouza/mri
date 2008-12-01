<?php
abstract class GeradorTag {
	protected function transcreverArgumentos(array $argumentos = NULL){
		$retorno = "";
		if($argumentos) {
			foreach($argumentos as $argumento => $valor) {
				$retorno .= "$argumento=\"$valor\"";
			}
		}
		return $retorno;
	}

	private function gerarTagHtml(array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		$retorno = "<html $args />\n";
		return $retorno;
	}

	public function gerarTagHtmlStrict(array $argumentos = NULL){
		$argumentos["xmlns"] = "http://www.w3.org/1999/xhtml";
		$retorno = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?> ";
		$retorno .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
		$retorno .= $this->gerarTagHtml($argumentos);
		return $retorno;
	}

	public function gerarTagHtmlTransacional(array $argumentos = NULL){
		$argumentos["xmlns"] = "http://www.w3.org/1999/xhtml";
		$retorno = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?> \n";
		$retorno .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
		$retorno .= $this->gerarTagHtml($argumentos);
		return $retorno;
	}

	public function gerarTagHead($titulo, array $metaTags = NULL, $arquivoEstilo = '', $arquivoJavaScript = ''){
		$retorno = "<head>\n";
		$retorno .= "<title>$titulo</title>\n";
		$retorno .= "<meta content=\"text/html; charset=UTF-8\" http-equiv=\"content-type\" />\n";
		if($metaTags)
		foreach($metaTags as $nome => $conteudo)
		$retorno .= "<meta name=\"$nome\" content=\"$conteudo\" />\n";
		if($arquivoEstilo){
			$retorno .= "<link href=\"css/$arquivoEstilo\" rel=\"stylesheet\" type=\"text/css\" />\n";
		}
		if($arquivoJavaScript){
			$retorno .= "<script type=\"javascript\" src=\"js/$arquivoJavaScript\"></script>\n";
		}
		$retorno .= "</head>\n";
		return $retorno;
	}

	public function gerarOpenTagBody(array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<body $args>\n";
	}

	public function gerarCloseTagsBodyHtml(){
		return "\n</body>\n</html>";
	}

	public function gerarLink($destino, $texto, $janelaDestino = '_self', array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<a href=\"$destino\" target=\"$janelaDestino\" $args>$texto</a>";
	}

	public function gerarImagem($caminho, $border = 0, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<img src=\"$caminho\" border=\"$border\" $args />";
	}

	public function gerarImagemComLink($caminho, $destino, $border, $janelaDestino = '_self', array $argumentosImagem = NULL, array $argumentosLink = NULL){
		return $this->gerarLink($destino, $this->gerarImagem($caminho, $border, $argumentosImagem), $janelaDestino, $argumentosLink);
	}

	public function gerarParagrafo($conteudo, $align = 'left', array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<p align=\"$align\" $args>$conteudo</p>\n";
	}

	public function gerarOpenTagTable($border, $cellspacing, $cellpadding, $width = '100%', array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<table border=\"$border\" cellspacing=\"$cellspacing\" cellpadding=\"$cellpadding\" width=\"$width\" $args>\n";
	}

	public function gerarCloseTagTable(){
		return "</table>\n";
	}

	public function gerarOpenTagTableLine(array $argumentos = NULL){
		$args = $this->transcreverArgumentos($arguementos);
		return "  <tr $args>\n";
	}

	public function gerarCloseTagTableLine(){
		return "  </tr>\n";
	}

	public function gerarOpenTagTableCell(array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "    <td $args>\n";
	}

	public function gerarCloseTagTableCell(){
		return "    </td>\n";
	}

	public function gerarDiv($conteudo, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<div $args>$conteudo</div>\n";
	}

	public function gerarTagH1($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<h1 $args>$texto</h1>\n";
	}

	public function gerarTagH2($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<h2 $args>$texto</h2>\n";
	}

	public function gerarTagH3($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<h3 $args>$texto</h3>\n";
	}

	public function gerarTagH4($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<h4 $args>$texto</h4>\n";
	}

	public function gerarTitulo($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<div class=\"titulo\">$texto</div>\n";
	}

	public function gerarTagStrong($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<strong $args>$texto</strong>";
	}

	public function gerarTagHr(array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<hr $args />";
	}

	public function gerarTagFontStrong($texto, array $argumentos = NULL){
		$args = $this->transcreverArgumentos($argumentos);
		return "<strong><font $args>$texto</font></strong>";
	}
}
?>