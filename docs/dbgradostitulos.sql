CREATE SCHEMA `dbgradostitulos` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `dbgradostitulos`.`persona` (
  `per_id` INT NOT NULL AUTO_INCREMENT,
  `per_nroDoc` VARCHAR(45) NOT NULL,
  `per_paterno` VARCHAR(50) NOT NULL,
  `per_materno` VARCHAR(50) NOT NULL,
  `per_nombres` VARCHAR(50) NOT NULL,
  `per_sexo` INT NOT NULL,
  `per_createdate` DATETIME NULL,
  `per_modifieddate` DATETIME NULL,
  `per_deletedate` DATETIME NULL,
  `per_estado` INT NULL,
  `docTipo_id` INT NULL,
  PRIMARY KEY (`per_id`));


CREATE TABLE `dbgradostitulos`.`documento_tipo` (
  `docTipo_id` INT NOT NULL AUTO_INCREMENT,
  `docTipo_nombre` VARCHAR(45) NOT NULL,
  `docTipo_sigla` VARCHAR(45) NOT NULL,
  `docTipo_digitos` INT NULL,
  `docTipo_createdate` DATETIME NULL,
  `docTipo_modifieddate` DATETIME NULL,
  `docTipo_deletedate` DATETIME NULL,
  `docTipo_estado` INT NULL,
  PRIMARY KEY (`docTipo_id`));



ALTER TABLE `dbgradostitulos`.`persona` 
ADD INDEX `persona_documento_tipo_idx` (`docTipo_id` ASC) VISIBLE;
;
ALTER TABLE `dbgradostitulos`.`persona` 
ADD CONSTRAINT `persona_documento_tipo`
  FOREIGN KEY (`docTipo_id`)
  REFERENCES `dbgradostitulos`.`documento_tipo` (`docTipo_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Otros","O",15,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Documento Nacional de Identidad","DNI",8,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Registro Unico del Contribuyente","RUC",11,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Libreta Militar","LM",99,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Carnet De Extranjería","C.E.",10,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Pasaporte","PASAPORTE",8,NOW(),1);
INSERT INTO documento_tipo(docTipo_nombre,docTipo_sigla,docTipo_digitos,docTipo_createdate,docTipo_estado) values ("Partida de Nacimiento","P.NAC.",15,NOW(),1);



