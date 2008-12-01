<?php
include_once 'classes/interface/GeradorPagina.php';
include_once 'classes/sombra/SubstanciaSombra.php';

class Index extends GeradorPagina {
	private function gerarLegenda(){
		$sombra = new SubstanciaSombra();
		$substancias = $sombra->selecionarTodasAsSubstanciasComCor();
		$quantSubstancias = count($substancias);
		$texto = $this->gerarTagH3('Legenda');
		for($i = 0; $i < $quantSubstancias; $i++){
			$paginaSubstancia = sprintf("index.php?substancia&cod=%s", $substancias[$i]->getIdt());
			$nomeSubstancia = utf8_encode($substancias[$i]->getNome());
			$texto .= $this->gerarTagFontStrong('###', array('color' => '#'.$substancias[$i]->getCor()->getHex()));
			$texto .= ' ';
			$texto .= $this->gerarLink($paginaSubstancia, $nomeSubstancia);
			$texto .= '<br />';
		}
		$texto .= $this->gerarParagrafo('Clique no mapa para ampliar.', 'left', array('class' => 'infMapa'));
		return $this->gerarDiv($texto, array('class' => 'legenda'));
	}

	protected function exibirTopo(){
		$retorno .= $this->gerarOpenTagTable(0, 2, 2);
		$retorno .= $this->gerarOpenTagTableLine();
		$argumentosCelulaTopo = array('colspan' => 2);
		$retorno .= $this->gerarOpenTagTableCell($argumentosCelulaTopo);
		$argumentosDiv = array('class' => 'divTitulo');
		$retorno .= $this->gerarDiv($this->gerarTagH1('Catálogo Eletrônico de Minerais Industriais do Espírito Santo'), $argumentosDiv);
		$retorno .= $this->gerarCloseTagTableCell();
		$retorno .= $this->gerarCloseTagTableLine();
		return $retorno;
	}

	protected function exibirMenu(){
		//Apenas por herança de classe abstrata
	}

	protected function exibirLadoEsquerdo(){
		$retorno = $this->gerarOpenTagTableLine();
		$retorno .= $this->gerarOpenTagTableCell(array('width' => '20%', 'valign' => 'top'));
		$argOrientador = array('title' => 'Orientador');
		$argBolsista = array('title' => 'Bolsista');
		$argColaborador = array('title' => 'Colaboradora');
		$linkAlexandre = $this->gerarLink('http://lattes.cnpq.br/5084946315573952', 'Alexandre Alves', '_blank', $argOrientador);
		$linkFrancisco = $this->gerarLink('http://lattes.cnpq.br/8294081548063514', 'Francisco Antônio da Silva Souza', '_blank', $argBolsista);
		$linkGiovany = $this->gerarLink('http://lattes.cnpq.br/7406806998563478', 'Giovany Frossard Teixeira', '_blank', $argOrientador);
		$linkRosana = $this->gerarLink('http://lattes.cnpq.br/6548794798405907', 'Rosana Gabriela Tomazini Mariani', '_blank', $argColaborador);
		$texto = $this->gerarTagHr();
		$texto .= $this->gerarParagrafo('Página gerada em pesquisa, desenvolvida no Campus Cachoeiro de Itapemirim do Instituto Federal de Educação, Ciência e Tecnologia do Espírito Santo (IFES), nos anos de 2007 e 2008, por alunos dos cursos técnicos de Informática e Mineração.', 'left');
		$texto .= $this->gerarParagrafo("Pesquisadores: <br />- $linkAlexandre<br />- $linkFrancisco<br/>- $linkGiovany<br />- $linkRosana");
		$texto .= $this->gerarParagrafo("Página do Campus:<br />".$this->gerarLink("http://www.ci.ifes.edu.br", "www.ci.ifes.edu.br", '_blank'));
		$retorno .= $this->gerarDiv($texto, array('class' => 'divCreditos'));
		$retorno .= $this->gerarCloseTagTableCell();
		return $retorno;
	}

	protected function exibirMeioDireita(){
		$retorno = $this->gerarOpenTagTableCell(array('width' => '80%', 'valign' => 'top'));
		$retorno .= $this->conteudo;
		$retorno .= $this->gerarCloseTagTableCell();
		$retorno .= $this->gerarCloseTagTableLine();
		return $retorno;
	}

	protected function exibirRodape(){
		$retorno = $this->gerarOpenTagTableLine();
		$argumentosCelulaRodape = array('colspan' => 2);
		$retorno .= $this->gerarOpenTagTableCell($argumentosCelulaRodape);
		$argumentosDiv = array('class' => 'divRodape');
		$retorno .= $this->gerarDiv('&copy; 2009 - Instituto Federal de Educação, Ciência e Tecnologia do Espírito Santo', $argumentosDiv);
		$retorno .= $this->gerarCloseTagTableCell();
		$retorno .= $this->gerarCloseTagTableLine();
		$retorno .= $this->gerarCloseTagTable();
		return $retorno;
	}

	protected function exibirConteudoPagina(){
		$texto = $this->gerarTagH2('Minerais e Rochas Industriais do Espírito Santo');
		$argImgMapaBrasil = array('class' => 'mapaBrasil', 'align' => 'right');
		$imgmapaBrasil = $this->gerarImagem('img/mapa_brasil.png', 0, $argImgMapaBrasil);
		$texto .= $this->gerarParagrafo($imgmapaBrasil.'O Espírito Santo é reconhecido internacionalmente pela ampla e diversificada disponibilidade de recursos minerais, sendo que no segmento de recursos minerais industriais destaca-se como um importante produtor de mármore, granito e rochas calcárias. O setor de mármore e granito é um dos mais representativos do Estado, uma vez que o mesmo se apresenta como o principal produtor e o maior processador e exportador de rochas ornamentais do Brasil e o segundo maior pólo no mundo. É responsável por 50% da produção brasileira, 66,4% das exportações de blocos e 70% das exportações de chapas de rochas ornamentais.', 'justify');
		$texto .= $this->gerarParagrafo('A estimativa é que o setor possui 1250 empresas, empregando cerca de 150 mil pessoas, através de empregos diretos e indiretos, distribuídos em atividades de extração e beneficiamento, além disso, está concentrado, no Estado, mais da metade do parque industrial brasileiro, tanto em número de teares e empresas, quanto em termos de crescimento.', 'justify');
		$texto .= $this->gerarParagrafo('O Estado também se destaca, possuindo grandes reservas de calcita, conchas calcárias e calcita ótica que representam aproximadamente toda a reserva contida no Brasil e também na extração de outros bens minerais que acabam sendo adquiridos pelos próprios capixabas, como é o caso da areia para construção civil, o cal como fertilizante agrícola e as argilas para fabricação de lajotas, telhas e outros produtos.', 'justify');
		$texto .= $this->gerarParagrafo('O estado do Espírito Santo possui uma área territorial de 46.184,1 km2, clima tropical úmido, com temperaturas médias anuais de 23º e volume de precipitação superior a 1.400 mm por ano, especialmente concentrada no verão.', 'justify');
		$texto .= $this->gerarOpenTagTable(0, 5, 5);
		$texto .= $this->gerarOpenTagTableLine();
		$texto .= $this->gerarOpenTagTableCell(array('width' => '400'));
		$argLinkMapa = array('title' => 'Clique para ver o mapa em tamanho maior');
		$texto .= $this->gerarImagemComLink('img/mapa_min.jpg', 'mapaGrande.html', 0, '_blank', NULL, $argLinkMapa);
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarOpenTagTableCell(array('valign' => 'top'));
		$texto .= $this->gerarLegenda();
		$texto .= $this->gerarCloseTagTableCell();
		$texto .= $this->gerarCloseTagTableLine();
		$texto .= $this->gerarCloseTagTable();
		$texto .= $this->gerarParagrafo('O território do Estado compreende duas regiões naturais distintas: o litoral, que se estende por 400 km e o planalto que dá origem a uma região serrana, com altitudes superiores a 1.000 metros, onde se eleva a Serra do Caparaó ou da Chibato e o Pico da Bandeira, com 2.890 metros de altura, o terceiro mais alto do País. Ambas as regiões naturais do Estado dão amparo a redes hoteleiras de ponta e prática de esportes que se revelam no segmento turístico.', 'justify');
		$texto .= $this->gerarParagrafo('Em relação ao crescimento industrial, o Espírito Santo tem sido líder no cenário brasileiro nos últimos dois anos, e apresenta-se como um dos mais promissores da região Sudeste. Possui posição geográfica privilegiada, limitando-se com os estados da Bahia, Minas Gerais e Rio de Janeiro e também abrigando o maior portuário da América Latina, que opera com sete terminais: Vitória, Ubu, Capuaba, Tubarão, Praia Mole, Portocel e Regência, e movimenta cerca de 25% das mercadorias que entram e saem do país, deste modo o Estado coloca-se como uma excelente alternativa para diversas atividades econômicas devido à integração ao mercado nacional e internacional.', 'justify');
		$texto .= $this->gerarParagrafo('A malha ferroviária estadual é constituída por trechos pertencentes à Estrada de Ferro Vitória-Minas e as rodovias mais importantes que cortam o Estado são a BR 101, que o liga às regiões Nordeste e Sul, e a BR 262, que liga Vitória a Corumbá, no Mato Grosso do Sul.', 'justify');
		$texto .= $this->gerarParagrafo('A base econômica do Estado é primordialmente a agricultura e a indústria, embora seja significativa a extração mineral, no ano de 2007, por exemplo, o Estado exportou 726,1 milhões de dólares, referentes a blocos e chapas de mármores e granitos.', 'justify');
		$texto .= $this->gerarParagrafo('O mais importante rio do Estado é o rio Doce, que nasce no Estado de Minas Gerais e tem 944 km de extensão, e possui alto potencial econômico, porém mais usufruído pelas indústrias mineiras. No entanto, também se destacam os rios São Mateus, Benevente com potencial turístico e o Itapemirim que abastece aproximadamente 950 empresas de mármore e granito, além de outros segmentos industriais e a própria população.', 'justify');
		$texto .= $this->gerarTagH2('Principais Litotipos do Espírito Santo');
		$texto .= $this->gerarParagrafo('Nos municípios de Cachoeiro do Itapemirim, Castelo e Vargem Alta, localizados no sul do estado se encontram as principais ocorrências de mármores, conhecidos comercialmente por mármore branco, mármore pinta verde, mármore chocolate, entre outros. O local também é alvo da ocorrência de pegmatito oxidado de alto valor comercial.', 'justify');
		$texto .= $this->gerarParagrafo('As rochas granitóides estão presentes em toda a extensão territorial, sendo explotados gnaisses, charnockitos, granodioritos, migmatitos, kinzigitos e pegmatitos, além de gabros, dioritos e noritos.', 'justify');
		$texto .= $this->gerarParagrafo('No norte capixaba, especificamente nos municípios de Nova Venécia, Barra de São Francisco, Vila Pavão, Ecoporanga, Água Doce do Norte, São Domingos do Norte, São Gabriel da Palha, Baixo Guandu, Pancas e Colatina concentra-se uma gama bastante expressiva de litotipos, destacando-se os granitos e gnaisses de coloração amarelada, tendo como nomes comerciais o Giallo Veneciano, Giallo São Francisco, Santa Cecília Gold, Santa Cecília Light, Santa Rita, Gold Brazil, Pavão Green, Peackock Green e São Francisco Green, entre outros. Os exemplares de tons azulados se restringem aos municípios de Ibiraçu, Nova Venécia e Pinheiros.', 'justify');
		$texto .= $this->gerarParagrafo('No vale do Médio Rio Doce, que abrange diversos municípios e localidades, incluindo Pancas, Aracruz, Baixo Guandu, Goiabal, Baunilha e Alto Mutum Preto, ocorrem exposições de rochas granulíticas e ígneas de composição intermediária, conhecidas pelos nomes de Verde Labrador, Aracruz Black e São Gabriel Black.', 'justify');
		$texto .= $this->gerarParagrafo('A região serrana, localizada às margens da Rodovia BR-262 é composta por uma variedade considerável de litologias, conhecidas como Preto Florido e Ocre Itabira.', 'justify');
		$texto .= $this->gerarParagrafo('Com o crescimento contínuo do setor, em taxas superiores a 10 % a.a., uma imensa variedade de nomes comerciais é apresentada atualmente, embora as características texturais e mineralógicas se mantenham relativamente idênticas àquelas reportadas no passado recente. Com esta proliferação de nomes, tornou-se mais difícil o completo domínio dos materiais disponíveis no mercado, uma vez que inúmeras rochas texturalmente idênticas recebem nomes comerciais distintos.', 'justify');
		$conteudo = $this->gerarDiv($texto, array('class' => 'divConteudo'));
		return $conteudo;
	}

	public function exibirPagina(){
		$this->setConteudo($this->exibirConteudoPagina());
		echo $this->gerarTagHtmlStrict();
		echo $this->gerarTagHead($this->titulo, NULL, 'estilo.css', 'script.js');
		echo $this->gerarOpenTagBody();
		echo $this->exibirTopo();
		echo $this->exibirLadoEsquerdo();
		echo $this->exibirMeioDireita();
		echo $this->exibirRodape();
		echo $this->gerarCloseTagsBodyHtml();
	}
}
?>
