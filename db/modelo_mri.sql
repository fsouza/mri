DROP DATABASE IF EXISTS mri;
CREATE DATABASE mri;
USE mri;
CREATE TABLE cidade (
       idt_cidade INTEGER NOT NULL AUTO_INCREMENT
     , nome_cidade VARCHAR(100) NOT NULL
     , PRIMARY KEY (idt_cidade)
);

CREATE TABLE cor (
       idt_cor INTEGER NOT NULL AUTO_INCREMENT
     , hex CHAR(6) NOT NULL
     , nome_cor VARCHAR(50) NOT NULL
     , PRIMARY KEY (idt_cor)
);

CREATE TABLE foto (
       idt_foto INTEGER NOT NULL AUTO_INCREMENT
     , mimetype VARCHAR(30) NOT NULL
     , foto MEDIUMBLOB NOT NULL
     , PRIMARY KEY (idt_foto)
);

CREATE TABLE substancia (
       idt_substancia INTEGER NOT NULL AUTO_INCREMENT
     , nome_substancia VARCHAR(100) NOT NULL
     , descricao_substancia TEXT NOT NULL
     , tipo_substancia VARCHAR(15) NOT NULL
     , fk_foto INTEGER
     , fk_cor INTEGER NOT NULL
     , PRIMARY KEY (idt_substancia)
     , INDEX (fk_foto)
     , CONSTRAINT FK_substancia_foto FOREIGN KEY (fk_foto)
                  REFERENCES foto (idt_foto)
     , INDEX (fk_cor)
     , CONSTRAINT FK_substancia_cor FOREIGN KEY (fk_cor)
                  REFERENCES cor (idt_cor)
);

CREATE TABLE producao_bruta (
       idt_producao_bruta INTEGER NOT NULL AUTO_INCREMENT
     , quantidade_produzida INTEGER NOT NULL
     , quantidade_comercializada INTEGER NOT NULL
     , valor_comercializado DOUBLE(14, 2) NOT NULL
     , contido INTEGER NOT NULL
     , teor_medio INTEGER NOT NULL
     , fk_substancia INTEGER NOT NULL
     , PRIMARY KEY (idt_producao_bruta)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_ProducaoBruta_Substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
);

CREATE TABLE producao_beneficiada (
       idt_producao_beneficiada INTEGER NOT NULL AUTO_INCREMENT
     , quantidade_produzida INTEGER NOT NULL
     , quantidade_comercializada INTEGER NOT NULL
     , valor_comercializado DOUBLE(14, 2) NOT NULL
     , contido INTEGER NOT NULL
     , teor_medio INTEGER NOT NULL
     , fk_producao_bruta INTEGER
     , fk_substancia INTEGER NOT NULL
     , PRIMARY KEY (idt_producao_beneficiada)
     , INDEX (fk_producao_bruta)
     , CONSTRAINT FK_ProducaoBeneficiada_ProducaoBruta FOREIGN KEY (fk_producao_bruta)
                  REFERENCES producao_bruta (idt_producao_bruta)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_ProducaoBeneficiada_Substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
);

CREATE TABLE lavra_usina (
       idt_lavra_usina INTEGER NOT NULL AUTO_INCREMENT
     , qtd_media INTEGER NOT NULL
     , qtd_pequena INTEGER NOT NULL
     , qtd_grande INTEGER NOT NULL
     , fk_substancia INTEGER NOT NULL
     , PRIMARY KEY (idt_lavra_usina)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_LavraUsina_Substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
);

CREATE TABLE lavra_mina (
       idt_lavra_mina INTEGER NOT NULL AUTO_INCREMENT
     , qtd_media INTEGER NOT NULL
     , qtd_pequena INTEGER NOT NULL
     , qtd_grande INTEGER NOT NULL
     , fk_substancia INTEGER NOT NULL
     , PRIMARY KEY (idt_lavra_mina)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_LavraMina_Substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
);

CREATE TABLE substancias_cidade (
       idt_substancias_cidade INTEGER NOT NULL AUTO_INCREMENT
     , fk_substancia INTEGER NOT NULL
     , fk_cidade INTEGER NOT NULL
     , PRIMARY KEY (idt_substancias_cidade)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_substancia_cidade_substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
     , INDEX (fk_cidade)
     , CONSTRAINT FK_substancia_cidade_cidade FOREIGN KEY (fk_cidade)
                  REFERENCES cidade (idt_cidade)
);

CREATE TABLE reserva_mineral (
       idt_reserva_mineral INTEGER NOT NULL AUTO_INCREMENT
     , medida INTEGER NOT NULL
     , indicada INTEGER NOT NULL
     , inferida INTEGER NOT NULL
     , lavravel INTEGER NOT NULL
     , fk_substancia INTEGER NOT NULL
     , PRIMARY KEY (idt_reserva_mineral)
     , INDEX (fk_substancia)
     , CONSTRAINT FK_ReservaMineral_Substancia FOREIGN KEY (fk_substancia)
                  REFERENCES substancia (idt_substancia)
);

