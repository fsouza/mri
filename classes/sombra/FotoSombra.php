<?php
include_once 'classes/dominio/Foto.php';
include_once 'classes/bd/Conexao.php';

class FotoSombra {
	private $idt_foto;
	private $mimetype;
	private $foto;
	private $conexao;

	private function prepararObjeto(Foto $foto) {
		$idt = $foto->getIdt();
		$arquivo = $foto->getFoto();
		$mime = $foto->getMimeType();
		$this->idt_foto = (is_numeric($idt) ? $idt : '');
		$this->mimetype = (get_magic_quotes_gpc() ? $mime : addslashes($mime));
		$this->foto = (get_magic_quotes_gpc() ? $arquivo : addslashes($arquivo));
		$this->conexao = Conexao::conectar();
	}

	public function inserirFoto(Foto $foto) {
		$this->prepararObjeto($foto);
		$comandoSql = sprintf("INSERT INTO foto (idt_foto, mimetype, foto) VALUES (%d, '%s', '%s')", $this->idt_foto, $this->mimetype, $this->foto);
		$insercao = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($insercao != false);
	}

	public function alterarFoto(Foto $foto) {
		$this->prepararObjeto($foto);
		$comandoSql = sprintf("UPDATE foto SET mimetype = '%s', foto = '%s' WHERE idt_foto = %d", $this->mimetype, $this->foto, $this->idt_foto);
		$update = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($update != false);
	}

	public function apagarFoto(Foto $foto) {
		$this->prepararObjeto($foto);
		$comandoSql = sprintf("DELETE FROM foto WHERE idt_foto = %d", $this->idt_foto);
		$delete = $this->conexao->Execute($comandoSql);
		$this->conexao->Close();
		return ($delete != false);
	}

	public function selecionarTodasAsFotos() {
		$fotos = array();
		$conn = Conexao::conectar();
		$comandoSql = "SELECT * FROM foto";
		$resultado = $conn->Execute($comandoSql);
		$i = 0;
		while($obj = $resultado->FetchNextObject()) {
			$fotos[$i] = new Foto('', $obj->MIMETYPE, $obj->FOTO);
			$i++;
		}
		$resultado->Close();
		$conn->Close(); 
		return $fotos;
	}

	public function selecionarFoto(Foto $foto) {
		$this->prepararObjeto($foto);
		$comandoSql = sprintf("SELECT * FROM foto WHERE idt_foto = %d", $this->idt_foto);
		$resultado = $this->conexao->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		$objFoto = new Foto($objFetch->IDT_FOTO, $objFetch->MIMETYPE, $objFetch->FOTO);
		$resultado->Close();
		$this->conexao->Close();
		return $objFoto;
	}

	public function selecionarFotoPorSubstancia(Substancia $substancia) {
		$conn = Conexao::conectar();
		$comandoSql = sprintf("SELECT * FROM fotos WHERE idt_foto = %d", $substancia->getFoto()->getIdt());
		$resultado = $conn->Execute($comandoSql);
		$objFetch = $resultado->FetchNextObject();
		$foto = new Foto($objFetch->IDT_FOTO, $objFetch->MIMETYPE, $objFetch->FOTO);
		$resultado->Close();
		$conn->Close();
		return $foto;
	}
}
?>