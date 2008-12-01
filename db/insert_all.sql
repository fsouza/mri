USE mri;
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (1, 'Aracruz');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (2, 'Vila Velha');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (3, 'Domingos Martins');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (4, 'Baixo Guandu');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (5, 'Cachoeiro de Itapemirim');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (6, 'Castelo');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (7, 'Colatina');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (8, 'Fundão');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (9, 'Governador Lindenberg');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (10, 'Itapemirim');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (11, 'Marilândia');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (12, 'Vitória');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (13, 'Santa Tereza');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (14, 'São Roque do Canaã');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (15, 'Serra');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (16, 'Linhares');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (17, 'Barra de São Francisco');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (18, 'São Mateus');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (19, 'Mimoso do Sul');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (20, 'Muqui');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (21, 'Vargem Alta');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (22, 'Afonso Cláudio');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (23, 'Água Doce do Norte');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (24, 'Águia Branca');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (25, 'Alegre');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (26, 'Alfredo Chaves');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (27, 'Anchieta');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (28, 'Apiacá');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (29, 'Atílio Vivacqua');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (30, 'Boa Esperança');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (31, 'Bom Jesus do Norte');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (32, 'Cariacica');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (33, 'Conceição da Barra');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (34, 'Conceição do Castelo');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (35, 'Divino de São Lourenço');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (36, 'Dores do Rio Preto');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (37, 'Ecoporanga');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (38, 'Rio Novo do Sul');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (39, 'Guarapari');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (40, 'João Neiva');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (41, 'Nova Venécia');
INSERT INTO cidade(idt_cidade, nome_cidade) VALUES (42, 'Viana');

INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (1, 'FF0000', 'Vermelho');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (2, '00FF00', 'Verde');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (3, 'FF9900', 'Laranja');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (4, 'FF00FF', 'Rosa');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (5, '0000FF', 'Azul');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (6, 'AA00FF', 'Roxo');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (7, 'AA0000', 'Vermelho escuro');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (8, '441111', 'Marrom');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (9, '6D6D6D', 'Cinza');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (10, '00EBFA', 'Verde água');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (11, '004343', 'Verde escuro');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (12, '0077FF', 'Azulzinho');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (13, 'A1CDFF', 'Azulzinha cinza');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (14, 'FFFF00', 'Amarelo');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (15, 'DDDDDD', 'Cinza claro');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (16, '380262', 'Roxo Escuro');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (17, '000000', 'Preto');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (18, '99AE0D', 'Verde amarelado');
INSERT INTO cor (idt_cor, hex, nome_cor) VALUES (19, '7F310E', 'Laranja escuro');

INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (1, 'Areia Industrial', 'Material composto de partículas minerais inconsolidadas, cujos tamanhos se enquadram numa faixa de variação definida e as partículas são constituídas predominantemente de quartzo. De modo geral, areias industriais são areias beneficiadas para serem utilizadas como insumo mineral pela indústria. As areias para fins industriais são produzidas principalmente a partir de aluviões, arenitos e quartzitos. \r\n	A areia quartzosa apresenta utilização bastante variável devido a certas características básicas, como: ampla distribuição granulométrica, forma dos grãos,  porosidade e permeabilidade e composição química. É necessário que a areia seja predominantemente silicosa, e há jazidas que possibilitam a produção de sílica praticamente pura.\r\n	As principais aplicações das areias industriais são: indústrias de vidro, indústrias cerâmicas,  fundição, siderurgia, indústrias de cimento, indústrias de fertilizantes e defensivos agrícolas, abrasivos, refratários ácidos, meios filtrantes, padrão para medidas físicas, desmonte hidráulico, entre outras.', 'Nao Metalica', 14, 1);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (2, 'Argila', 'Areia é um material de origem mineral finamente dividido em grânulos, constituída por fragmentos de mineral ou de rocha e composta basicamente de dióxido de silício.\r\nForma-se à superfície da Terra pela fragmentação das rochas por erosão, por ação do vento ou da água. Através de processos de sedimentação pode ser transformada em arenito.\r\nÉ utilizada nas obras de engenharia civil em aterros, execução de argamassas e concretos e também no fabrico de vidro. O tamanho de seus grãos tem importância nas características dos materiais que a utilizam como componente.\r\nO tamanho de areia, divide-se, granulometricamente, em: areia fina (>1/16mm e <1/4mm), areia média (>1/4 mm e <1 mm) e areia grossa (> 1 mm e < 2mm). \r\nNormalmente é extraída do fundos dos rios com dragas, o que ocasiona graves danos ambientais, em seguida é lavada e posta para secar e utilizada conforme sua granulação.', 'Nao Metalica', 3, 5);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (3, 'Argila Refratária', 'É constituída essencialmente de caulinita e utilizada para fabricar materiais refratários, principalmente os sílico-aluminosos. Adquire este nome em função de sua qualidade de resistência ao calor. Suas características físicas variam, umas são muito plásticas finas, outras não. \r\n	Apresentam geralmente alguma proporção de ferro e se encontram associadas com os depósitos de carvão. São utilizadas nas massas cerâmicas dando maior plasticidade e resistência em altas temperaturas, bastante utilizadas na produção de placas refratárias que atuam como isolantes e revestimentos para fornos. \r\n	Quanto maior o teor de ferro de uma argila menos refratário é essa argila. Isso ocorre pelo fato do teor de ferro atuar como fundente. Para argilas com alto teor de ferro a cor vermelha fica mais evidente a medida que a temperatura de queima aumenta. A media de queima dessas argilas para produtos cerâmicos fica entre 800ºC e 950ºC.', 'Nao Metalica', 1, 3);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (4, 'Argila Plástica', 'A argila plástica é um material composto basicamente de argilominerais (caulinita, illita, montmorillonita e esmectita) e outros minerais não argilosos como quartzo, feldspato, micas e matéria orgânica.\r\n	Na composição da massa, fornecem plasticidade, trabalhabilidade, resistência mecânica e refratariedade. Quando maior a plasticidade melhor a trabalhabilidade para conformação de produtos cerâmicos por extrusão. Por outro lado argila muito plásticas apresentam dificuldade na secagem podendo ocorrer trincas de secagem.', 'Nao Metalica', 4, 4);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (5, 'Rochas Calcárias', 'Os calcários são rochas sedimentares que contêm minerais com quantidades acima de 30% de carbonato de cálcio (aragonita ou calcita). Formam-se por dois processos:  o orgânico, através da deposição de carapaças e esqueletos marinhos de composições calcárias, no fundo dos oceanos; e por processo inorgânico, através da precipitação direta de carbonato de cálcio em soluções aquosas.', 'Nao Metalica', 19, 7);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (6, 'Calcita', 'É um carbonato de cálcio. Principal constituinte das rochas carbonáticas, em especial o mármore. Além de branca, a cor mais comum, pode ser incolor, azul, amarela, esverdeada, vermelha, cinza.\r\n	Mineral de baixa dureza, é a referência 3 na escala de Mohs. Facilmente riscada, assim como as rochas onde ocorre em grande quantidade, como o mármore. Facilmente atacada por soluções ácidas, é dissolvida pela água levemente ácidificada pelo gás carbônico, dando origem a relevos interessantes. Em contato com soluções mais ácidas, entra em efervescência, devido ao rápido desprendimento do gás carbônico.\r\n	A variedade quimicamente pura e incolor recebe o nome de espato-de-islândia, lugar de onde era proveniente. O espato-de-islândia é usado na fabricação de Nicol para instrumentos ópticos, como microscópiose e dicroscópios.', 'Nao Metalica', 5, 8);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (7, 'Calcita ótica', 'Calcita incolor em forma de romboedros (um retângulo assimétrico). Produzem fantásticos arco-íris em seu interior e em sua superfície, a Calcita Ótica é conhecida por sua birrefringência e pelo seu uso na fabricação de prismas e lentes de alta precisão. Também tem utilização terapêutica.', 'Nao Metalica', 6, 9);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (8, 'Caulim', 'Rocha que contém o mineral caulinita ou pode ser o produto resultante do beneficiamento da mesma. A caulinita, seu principal constituinte é um silicato de alumínio hidratado, que apresenta a seguinte fórmula: AL4(Si4O10)(OH)8.\r\nOs caulins são resultantes da alteração de silicatos da alumínio, particularmente dos feldspatos e podem ocorrer em dois tipos de depósitos: Primário e secundário\r\nOs caulins primários são resultantes da alteração da rochas ''in situ” e os caulins secundários são formados pela deposição de materiais transportados por correntes de água doce.\r\nOs caulins são muito utilizados pela indústria de papel, devido suas características físico-químicas. Algumas delas são: \r\nQuimicamente inerte numa faixa considerável de pH;\r\nPraticamente branco;\r\nBaixa condutividade térmica e elétrica;\r\nÉ macio e pouco abrasivo;\r\nÉ facilmente disperso em água.', 'Nao Metalica', 7, 7);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (9, 'Conchas Calcárias', 'As conchas são formadas por nácar, que é uma mistura orgânica de camadas de conchiolina, seguido de uma camada intermediária de calcita ou aragonita e por ultimo uma camada de carbonato de cálcio cristalizado. As conchas tem grande utilização em peças artesanais, e também são usadas para obtenção de carga de carbonatos de cálcio. ', 'Nao Metalica', 8, 19);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (10, 'Dolomito', 'O dolomito é uma rocha sedimentar com mais de 50 % de seu peso constituído por dolomita (carbonato duplo de cálcio e magnésio [CaMg(CO3)2], cristalizado em romboedros, semelhante à calcita mas menos solúvel em ácidos), quase sempre associado e às vezes interestratificado com o calcário.', 'Nao Metalica', 9, 12);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (11, 'Feldspato', 'Feldspato é o nome de uma importante família de minerais, do grupo dos tectossilicatos, constituintes de rochas que formam cerca de 60% da crosta terrestre. Cristalizam nos sistemas triclínico ou monoclínico.\r\nEles cristalizam do magma tanto em rochas intrusivas quanto extrusivas; os feldspatos ocorrem como minerais compactos, como filões, em pegmatitas e se desenvolvem em muitos tipos de rochas metamórficas. Também podem ser encontrados em alguns tipos de rochas sedimentares.', 'Nao Metalica', 10, 13);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (12, 'Quartzito Industrial', 'O quartzito é uma rocha metamórfica cujo componente principal é o quartzo (mais de 75% como ordem de grandeza). Um quartzito pode ter como protólito arenitos quartzosos (origem mais comum), tufos e riolitos silicosos e chert silicoso. Bolsões (pods) ou veios de quartzo, normalmente produtos de segregação metamórfica, são muitas vezes retrabalhados por cataclase e metamorfismo dando origem a quartzitos semelhantes aos de origem sedimentar.\r\n Seu principal mineral é o Quartzo. Outros constituintes são moscovita, biotita, sericita, turmalina e dumortierita. Esta rocha pode ser britada em diferentes granulometrias para utilização na indústria de refratários, pisos industriais, indústria cerâmica, abrasivos, etc.', 'Nao Metalica', 15, 2);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (13, 'Quartzito Ornamental', 'Possui mesmas características do quartzito industrial, porém este é utilizado para ornamentação tanto interna como externa e  podendo ser aplicado  na  forma rústica, talhada ou polida. Esse material pode ser empregado em revestimentos, artesanato e peças como tampões de mesa, pisos, etc.', 'Nao Metalica', 17, 18);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (14, 'Quartzo Cristal', 'O quartzo é o mineral  mais abundante  da Terra (aproximadamente 12% vol.). Possui estrutura cristalina trigonal composta por tetraedros de sílica (dióxido de silício, SiO2), pertencendo ao grupo dos tectossilicatos. É classificado como tendo dureza 7 na Escala de Mohs e apresenta as mais diversas cores conforme as variedades. Não possui clivagem e apresenta fratura concoidal.  É muito utilizado na confecção de jóias baratas, em objetos ornamentais e enfeites, na confecção de cinzeiros, colares, pulseiras, pequenas esculturas etc.', 'Nao Metalica', 16, 10);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (15, 'Rochas Britadas e Cascalho', 'São rochas resistentes, geralmente granitos que passam por processos de britagem e alcançam tamanhos entre 6mm a 10cm. Sua utilização está voltada para o concreto, asfalto, sub-base de estradas, drenos, etc.', 'Nao Metalica', 18, 17);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (16, 'Granitos', 'Rocha cristalina formada de uma mistura heterogênea de quartzo, feldspato e biotita, podendo também ter em sua composição minerais acessórios como plagioclásio, anfibólio e outros . Resulta da consolidação de um magma rico em sílica, provindo, às vezes, de recentes metamorfoses de rochas sedimentares. \r\nO granito se apresenta em diversas cores, principalmente claras, e seus cristais  podem ser vistos a olho nu. Permite a utilização em diversos ambientes, tanto internos como externos (revestimento, pisos, tampões, balcões, rodapés, artesanato, etc).', 'Nao Metalica', 12, 14);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (17, 'Mármores', 'São rochas metamorfizadas provindas do calcário ou do dolomito. No processo de metamorfismo essas rochas sofrem transformações sob ação das novas condições de temperatura, pressão e presença de fluido. Os grãos de calcita, por exemplo, recristalizam-se, formando cristais macroscópicos. A coloração dos mármores é variada: branca, rósea, esverdeada ou preta. \r\nO mármore tem grande utilização como rocha ornamental, sendo utilizado em diversos ambientes, tendo aplicação restrita em ambientes externos e/ou ambientes que tenham grande contato com agentes intempéricos.', 'Nao Metalica', 13, 15);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (18, 'Outras rochas ornamentais', 'Nesse grupo estão incluídos diversos tipos de rochas, como variedade de rochas sedimentares e metamórficas. As Sedimentares  são compostas por sedimentos carregados pela água e pelo vento, acumulados em áreas deprimidas. Correspondem a 80% da área dos continentes, existe grande probabilidade de conterem material fóssil e formam as bacias.\r\nAs rochas sedimentares são um dos três principais grupos de rochas (os outros dois são as rochas ígneas e as metamórficas) e formam-se por três processos principais:\r\n1. pela deposição (sedimentação) das partículas originadas pela erosão de outras rochas (conhecidas como rochas sedimentares clásticas);\r\n2. pela deposição dos materiais de origem biogénica;\r\n3. pela precipitação de substâncias em solução.\r\nElas também podem ser classificadas segundo a composição em: Arenitos, argilitos,siltitos, conglomerados e brechas. As metamórficas são aquelas formadas por transformações físicas e químicas sofridas por outras rochas, quando submetidas ao calor e à pressão do interior da Terra, num processo denominado metamorfismo.\r\n	As rochas metamórficas são o produto da transformação de qualquer tipo de rocha levada a um ambiente onde as condições físicas (pressão, temperatura) são muito distintas daquelas onde a rocha se formou. Nestes ambientes, os minerais podem se tornar instáveis e reagir formando outros minerais, estáveis nas condições vigentes. \r\n	Não apenas as rochas sedimentares ou ígneas podem sofrer metamorfismo, as próprias rochas metamórficas também podem, gerando uma nova rocha metamorfizada com diferente composição química e/ou física da rocha inicial.\r\n	Devido as mudanças ocorridas na composição, estrutura e textura, essas rochas muitas vezes apresentam o chamado movimento ou rocha movimentada, que são na verdade camadas de minerais distribuídos pela rocha  que apresentam determinadas direções, e até mesmo colorações variadas.', 'Nao Metalica', 20, 16);
INSERT INTO substancia (idt_substancia, nome_substancia, descricao_substancia, tipo_substancia, fk_foto, fk_cor) VALUES (19, 'Gemas', 'Gema é um mineral, rocha ou material petrificado que quando cortado e facetado ou polido é colecionável ou pode ser usado em joalheria. Outros são orgânicos, como o âmbar (resina de árvore fossilizada) e o azeviche (uma forma de carvão). Algumas gemas geralmente consideradas preciosas e bonitas são demasiado macias ou frágeis para serem usadas em jóias (por exemplo, rodocrosita monocristalina), mas são exibidas nos museus e procuradas por colecionadores.', 'Gema', 11, 6);

INSERT INTO reserva_mineral (idt_reserva_mineral, medida, indicada, inferida, lavravel, fk_substancia)
VALUES	(1, '4301712', '1145850', '0', '5337288', 1),
		(2, '79455091', '337974208', '11052716', '404618404', 2),
		(3, '14957188', '0', '0', '13494024', 4),
		(4, '6895018', '302600', '537338', '6517163', 3),
		(5, '748580476', '105098893', '19948214', '530800261', 5),
		(6, '33795757', '100806790', 0, '34685773', 6),
		(7, '4561003', '0', '0', '4561003', 7),
		(8, '25000', '6818013', '0', '6833013', 8),
		(9, '186124998', '192000000', '0', '186124998', 9),
		(10, '27752714', '0', '0', '27752714', 10),
		(11, '50000', '0', '0', '45000', 11),
		(12, '6969205', '0', '0', '6969205', 12),
		(13, '107170555', '0', '0', '107170555', 13),
		(14, '70000', '0', '0', '50000', 14),
		(15, '119378328', '22372320', '7468500', '116993989', 15),
		(16, '5071848', '128000', '51502', '5001254', 18),
		(17, '6644100769', '834787621', '594145382', '5934301659', 16),
		(18, '102561355', '26561936', '22342211', '91815559', 17);

INSERT INTO producao_bruta (idt_producao_bruta, quantidade_produzida, quantidade_comercializada, valor_comercializado, contido, teor_medio, fk_substancia)
VALUES	(1, 23442, 23442, 174746, 0, 0, 1),
		(2, 147835, 127241, 467987, 0, 0, 2),
		(3, 89120, 89120, 179859, 0, 0, 3),
		(4, 1390665, 1388594, 18261498, 0, 0, 5),
		(5, 101275, 50755, 958412, 0, 0, 6),
		(6, 2084757, 196278, 3075423, 0, 0, 15),
		(7, 279954, 218148, 72113690, 0, 0, 16),
		(8, 42747, 28988, 6582249, 0, 0, 17);

INSERT INTO producao_beneficiada (idt_producao_beneficiada, quantidade_produzida, quantidade_comercializada, valor_comercializado, contido, teor_medio, fk_substancia, fk_producao_bruta)
VALUES	(1, 38680, 38646, 642511, 0, 0, 2, 2),
		(2, 117, 127, 26764, 0, 0, 5, 4),
		(3, 169072, 165367, 9256018, 0, 0, 6, 5),
		(4, 2153940, 2010154, 38427220, 0, 0, 15, 6),
		(5, 378261, 426062, 57080082, 0, 0, 16, 7),
		(6, 184563, 140379, 4114154, 0, 0, 17, 8);

INSERT INTO lavra_mina(idt_lavra_mina, qtd_media, qtd_pequena, qtd_grande, fk_substancia)
VALUES	(1, 0, 2, 0, 1),
		(2, 0, 6, 0, 2),
		(3, 0, 10, 1, 5),
		(4, 9, 1, 1, 15),
		(5, 0, 19, 0, 18);

INSERT INTO lavra_usina(idt_lavra_usina, qtd_media, qtd_pequena, qtd_grande, fk_substancia)
VALUES	(1, 0, 5, 0, 2),
		(2, 0, 1, 3, 5);

INSERT INTO substancias_cidade (idt_substancias_cidade, fk_substancia, fk_cidade)
VALUES	(1, 1, 1),
		(2, 1, 2),
		(3, 12, 3),
		(4, 2, 1),
		(5, 2, 4),
		(6, 2, 5),
		(7, 2, 6),
		(8, 2, 7),
		(9, 2, 8),
		(10, 2, 9),
		(11, 2, 10),
		(12, 2, 11),
		(13, 2, 13),
		(14, 2, 14),
		(15, 2, 15),
		(16, 2, 2),
		(17, 2, 12),
		(18, 4, 4),
		(19, 4, 7),
		(20, 4, 16),
		(21, 3, 17),
		(22, 3, 18),
		(23, 3, 14),
		(24, 3, 15),
		(25, 3, 2),
		(26, 19, 19),
		(27, 19, 20),
		(28, 19, 13),
		(29, 5, 1),
		(30, 5, 5),
		(31, 5, 6),
		(32, 5, 10),
		(33, 6, 5),
		(34, 6, 6),
		(35, 6, 19),
		(36, 6, 21),
		(37, 7, 5),
		(38, 14, 20),
		(39, 8, 20),
		(40, 8, 15),
		(41, 10, 5),
		(42, 11, 20),
		(43, 16, 22),
		(44, 16, 23),
		(45, 16, 24),
		(46, 16, 25),
		(47, 16, 26),
		(48, 16, 27),
		(49, 16, 28),
		(50, 16, 29),
		(51, 16, 4),
		(52, 16, 17),
		(53, 16, 30),
		(54, 16, 31),
		(55, 16, 5),
		(56, 16, 32),
		(57, 16, 6),
		(58, 16, 7),
		(59, 16, 33),
		(60, 16, 34),
		(61, 16, 35),
		(62, 16, 3),
		(63, 16, 36),
		(64, 16, 37),
		(65, 16, 8);

