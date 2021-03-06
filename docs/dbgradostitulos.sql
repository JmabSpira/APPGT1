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



CREATE TABLE `dbgradostitulos`.`nivel` (
  `nivel_id` INT NOT NULL AUTO_INCREMENT,
  `nivel_nombre` VARCHAR(200) NOT NULL,
  `nivel_alias` VARCHAR(100) NULL,
  `nivel_acronimo` VARCHAR(200) NULL,
  `nivel_abreviatura` VARCHAR(2) NULL,
  `nivel_estado` TINYINT(1) NOT NULL DEFAULT '1',
  `nivel_createdate` DATETIME NULL,
  `nivel_modifieddate` DATETIME NULL,
  `nivel_deletedate` DATETIME NULL,
  PRIMARY KEY (`nivel_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE `dbgradostitulos`.`entidad_tipo` (
  `entTipo_id` INT NOT NULL AUTO_INCREMENT,
  `entTipo_nombre` VARCHAR(200) NOT NULL,
  `entTipo_alias` VARCHAR(100) NULL,
  `entTipo_acronimo` VARCHAR(20) NULL,
  `entTipo_estado` TINYINT(1) NOT NULL DEFAULT '1',
  `entTipo_createdate` DATETIME NULL,
  `entTipo_modifieddate` DATETIME NULL,
  `entTipo_deletedate` DATETIME NULL,
  PRIMARY KEY (`entTipo_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE `dbgradostitulos`.`organo` (
  `org_id` INT NOT NULL AUTO_INCREMENT,
  `entTipo_id` INT NOT NULL,
  `org_nombre` VARCHAR(200) NOT NULL,
  `org_denMas` VARCHAR(200) NULL,
  `org_denFem` VARCHAR(200) NULL,
  `org_createdate` DATETIME NULL,
  `org_modifieddate` DATETIME NULL,
  `org_deletedate` DATETIME NULL,
  PRIMARY KEY (`org_id`),
  INDEX `organo_entidad_tipo_idx` (`entTipo_id` ASC) VISIBLE,
  CONSTRAINT `organo_entidad_tipo`
    FOREIGN KEY (`entTipo_id`)
    REFERENCES `dbgradostitulos`.`entidad_tipo` (`entTipo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`organo` 
ADD COLUMN `org_emite` VARCHAR(200) NULL AFTER `org_denFem`,
ADD COLUMN `org_alias` VARCHAR(100) NULL AFTER `org_emite`,
ADD COLUMN `org_acronimo` VARCHAR(20) NULL AFTER `org_alias`,
ADD COLUMN `org_estado` TINYINT(1) NOT NULL DEFAULT '1' AFTER `org_acronimo`;



CREATE TABLE `dbgradostitulos`.`sesion` (
  `ses_id` INT NOT NULL AUTO_INCREMENT,
  `sesTipo_id` INT NOT NULL,
  `org_id` INT NOT NULL,
  `ses_fecha` DATE NOT NULL,
  `ses_estado` TINYINT(1) NOT NULL DEFAULT '1',
  `ses_createdate` DATETIME NULL,
  `ses_modifieddate` DATETIME NULL,
  `ses_deletedate` DATETIME NULL,
  PRIMARY KEY (`ses_id`),
  INDEX `sesion_tipo_idx` (`sesTipo_id` ASC) VISIBLE,
  INDEX `sesion_organo_idx` (`org_id` ASC) VISIBLE,
  CONSTRAINT `sesion_tipo`
    FOREIGN KEY (`sesTipo_id`)
    REFERENCES `dbgradostitulos`.`sesion_tipo` (`sesTipo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `sesion_organo`
    FOREIGN KEY (`org_id`)
    REFERENCES `dbgradostitulos`.`organo` (`org_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


ALTER TABLE `dbgradostitulos`.`sesion` 
DROP FOREIGN KEY `sesion_tipo`;
ALTER TABLE `dbgradostitulos`.`sesion` 
CHANGE COLUMN `sesTipo_id` `sesTipo_id` INT NULL DEFAULT NULL ,
CHANGE COLUMN `ses_fecha` `ses_fecha` DATE NULL DEFAULT NULL ;
ALTER TABLE `dbgradostitulos`.`sesion` 
ADD CONSTRAINT `sesion_tipo`
  FOREIGN KEY (`sesTipo_id`)
  REFERENCES `dbgradostitulos`.`sesion_tipo` (`sesTipo_id`);



CREATE TABLE `dbgradostitulos`.`entidad` (
  `ent_id` INT NOT NULL AUTO_INCREMENT,
  `entTipo_id` INT NOT NULL,
  `ent_nombre` VARCHAR(200) NULL,
  `ent_alias` VARCHAR(100) NULL,
  `ent_sigla` VARCHAR(20) NULL,
  `ent_estado` SMALLINT(1) NOT NULL DEFAULT '1',
  `ent_createdate` DATETIME NULL,
  `ent_modifieddate` DATETIME NULL,
  `ent_deletedate` DATETIME NULL,
  PRIMARY KEY (`ent_id`),
  INDEX `entidad_entTipo_idx` (`entTipo_id` ASC) VISIBLE,
  CONSTRAINT `entidad_entTipo`
    FOREIGN KEY (`entTipo_id`)
    REFERENCES `dbgradostitulos`.`entidad_tipo` (`entTipo_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


ALTER TABLE `dbgradostitulos`.`entidad` 
CHANGE COLUMN `ent_id` `ent_id` INT NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`ent_id`, `entTipo_id`);
;

CREATE TABLE `dbgradostitulos`.`facultad` (
  `fac_id` INT NOT NULL AUTO_INCREMENT,
  `fac_nombre` VARCHAR(200) NULL,
  `fac_sigla` VARCHAR(10) NULL,
  `fac_estado` SMALLINT NOT NULL DEFAULT '1',
  `fac_createdate` DATETIME NULL DEFAULT NULL,
  `fac_modifieddate` DATETIME NULL DEFAULT NULL,
  `fac_deletedate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`fac_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`facultad` 
CHANGE COLUMN `fac_nombre` `fac_nombre` VARCHAR(200) NOT NULL ;

CREATE TABLE `dbgradostitulos`.`escuela` (
  `esc_id` INT NOT NULL AUTO_INCREMENT,
  `esc_nombre` VARCHAR(150) NOT NULL,
  `esc_sigla` VARCHAR(10) NULL,
  `esc_estado` SMALLINT NOT NULL DEFAULT '1',
  `fac_id` INT NOT NULL,
  `esc_createdate` DATETIME NULL DEFAULT NULL,
  `esc_modifieddate` DATETIME NULL DEFAULT NULL,
  `esc_deletedate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`esc_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`escuela` 
ADD COLUMN `esc_alias` VARCHAR(100) NULL DEFAULT NULL AFTER `esc_sigla`;

ALTER TABLE `dbgradostitulos`.`escuela` 
ADD INDEX `FK_escuela_facultad_idx` (`fac_id` ASC) VISIBLE;
;
ALTER TABLE `dbgradostitulos`.`escuela` 
ADD CONSTRAINT `FK_escuela_facultad`
  FOREIGN KEY (`fac_id`)
  REFERENCES `dbgradostitulos`.`facultad` (`fac_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  CREATE TABLE `dbgradostitulos`.`resolucion` (
  `resol_id` INT NOT NULL AUTO_INCREMENT,
  `ses_id` INT NOT NULL,
  `resol_fecha` DATE NOT NULL,
  `resol_numero` INT NOT NULL,
  `resol_estado` TINYINT(1) NOT NULL,
  `resol_createdate` DATETIME NULL,
  `resol_modifieddate` DATETIME NULL,
  `resol_deletedate` DATETIME NULL,
  PRIMARY KEY (`resol_id`),
  INDEX `fk_resolucion_sesion_idx` (`ses_id` ASC) VISIBLE,
  CONSTRAINT `fk_resolucion_sesion`
    FOREIGN KEY (`ses_id`)
    REFERENCES `dbgradostitulos`.`sesion` (`ses_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`resolucion` 
ADD COLUMN `resol_fechaSolicitud` DATE NOT NULL AFTER `resol_numero`,
ADD COLUMN `resol_nroSolicitud` VARCHAR(15) NOT NULL AFTER `resol_fechaSolicitud`;

ALTER TABLE `dbgradostitulos`.`resolucion` 
CHANGE COLUMN `resol_nroSolicitud` `resol_nroSolicitud` VARCHAR(15) NULL DEFAULT 'S/N' ;



CREATE TABLE `dbgradostitulos`.`subdenominacion` (
  `subDen_id` INT NOT NULL AUTO_INCREMENT,
  `den_id` INT NOT NULL,
  `subDen_Mas` VARCHAR(250) NOT NULL,
  `subDen_Fem` VARCHAR(250) NOT NULL,
  `subDen_MasFem` VARCHAR(250) NOT NULL,
  `subDen_estado` TINYINT(1) NOT NULL,
  `subDen_createdate` DATETIME NULL DEFAULT NULL,
  `subDen_modifieddate` DATETIME NULL DEFAULT NULL,
  `subDen_deletedate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`subDen_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


ALTER TABLE `dbgradostitulos`.`subdenominacion` 
DROP COLUMN `den_id`;

ALTER TABLE `dbgradostitulos`.`subdenominacion` 
DROP COLUMN `subDen_Fem`,
DROP COLUMN `subDen_Mas`,
CHANGE COLUMN `subDen_MasFem` `subDen_MasFem` VARCHAR(300) NOT NULL ;


ALTER TABLE `dbgradostitulos`.`subdenominacion` 
ADD CONSTRAINT `fk_den_subden`
  FOREIGN KEY (`den_id`)
  REFERENCES `dbgradostitulos`.`denominacion` (`den_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

  

CREATE TABLE `dbgradostitulos`.`denominacion` (
  `den_id` INT NOT NULL AUTO_INCREMENT,
  `nivel_id` INT NOT NULL,
  `esc_id` INT NOT NULL,
  `subDen_id` INT NULL,
  `den_Mas` VARCHAR(250) NOT NULL,
  `den_Fem` VARCHAR(250) NOT NULL,
  `den_MasFem` VARCHAR(250) NOT NULL,
  `den_estado` TINYINT(1) NOT NULL DEFAULT 1,
  `den_createdate` DATETIME NULL DEFAULT NULL,
  `den_modifieddate` DATETIME NULL DEFAULT NULL,
  `den_deletedate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`den_id`),
  INDEX `fk_denominacion_subden_idx` (`subDen_id` ASC) VISIBLE,
  CONSTRAINT `fk_denominacion_subden`
    FOREIGN KEY (`subDen_id`)
    REFERENCES `dbgradostitulos`.`subdenominacion` (`subDen_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`denominacion` 
DROP FOREIGN KEY `fk_denominacion_subden`;
ALTER TABLE `dbgradostitulos`.`denominacion` 
DROP COLUMN `subDen_id`,
DROP INDEX `fk_denominacion_subden_idx` ;
;


/*
SQL DENOMINACIONES Y SUBDE


*/

SELECT * FROM dbgradostitulos.denominacion;

SELECT * FROM db_diploma_v1r5.denominacion where sub_cod = 1 and den_digit = '01';


INSERT INTO denominacion(nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
SELECT sub_cod,ent_codigo,den_denMas,den_denFem,den_denMasFem,1,now()
FROM db_diploma_v1r5.denominacion where sub_cod = 1 and den_id <= 31;


/*nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate*/
INSERT INTO denominacion(nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
SELECT sub_cod,ent_codigo,den_denMas,den_denFem,den_denMasFem,1,now()
FROM db_diploma_v1r5.denominacion where sub_cod = 2 and (den_digit = '01' or den_digit= '02');


SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE denominacion;
SET FOREIGN_KEY_CHECKS=1;

/* TITULOS Y POSGRADO*/
insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,71,'Magister Scientiae en Agronegocios','Magister Scientiae en Agronegocios','Magister Scientiae en Agronegocios',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,71,'Maestro en Ciencias','Maestra en Ciencias','Maestro(a) en Ciencias',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,72,'Maestro en Ciencias Biológicas','Maestra en Ciencias Biológicas','Maestro(a) en Ciencias Biológicas',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,72,'Maestro en Ciencias','Maestra en Ciencias','Maestro(a) en Ciencias',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,73,'Maestro en Docencia Universitaria','Maestra en Docencia Universitaria','Maestro(a) en Docencia Universitaria',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,73,'Maestro en Educación','Maestra en Educación','Maestro(a) en Educación',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,74,'Maestro en Ciencias Económicas','Maestra en Ciencias Económicas','Maestro(a) en Ciencias Económicas',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,74,'Maestro en Auditoría','Maestra en Auditoría','Maestro(a) en Auditoría',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,75,'Maestro en Ciencias Sociales','Maestra en Ciencias Sociales','Maestro(a) en Ciencias Sociales',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,76,'Maestro en Derecho','Maestra en Derecho','Maestro(a) en Derecho',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,77,'Maestro en Ciencias de la Ingeniería','Maestra en Ciencias de la Ingeniería','Maestro(a) en Ciencias de la Ingeniería',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,78,'Maestro en Ingeniería Ambiental','Maestra en Ingeniería Ambiental','Maestro(a) en Ingeniería Ambiental',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,79,'Maestro en Salud Pública','Maestra en Salud Pública','Maestro(a) en Salud Pública',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,79,'Maestro en Gerencia en Servicios de Salud','Maestra en Gerencia en Servicios de Salud','Maestro(a) en Gerencia en Servicios de Salud',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,79,'Maestro en Epidemiología','Maestra en Epidemiología','Maestro(a) en Epidemiología',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (3,79,'Maestro en Atención Integral de la Salud','Maestra en Atención Integral de la Salud','Maestro(a) en Atención Integral de la Salud',1, now());

insert into denominacion (nivel_id,esc_id,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate)
VALUES (4,73,'Doctor en Educación','Doctora en Educación','Doctor(a) en Educación',1, now());


SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE subdenominacion;
SET FOREIGN_KEY_CHECKS=1;


/* SUBDEN*/
insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (33,', Especialidad: Microbiología',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (33,', Especialidad: Biotecnología',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (33,', Especialidad: Ecología y Recursos Naturales',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (36,', Especialidad: Inglés y Lengua Española',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (36,'. Especialidad: Ciencias Sociales y Filosofía con Mención en Turismo',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (36,'. Especialidad: Matemática, Física e Informática',1, now());


insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (37,'. Especialización: Entrenamiento Deportivo',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (37,'. Especialización: Gestión Deportiva',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (37,'. Especialidad: Promoción de la Salud Social',1, now());


insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (58,'. Especialidad de Matemático(a)',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (58,'. Especialidad de Fisica',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (58,'. Especialidad de Estadística',1, now());



insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (64,', Mención en Manejo de Cuencas Hidrográficas',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (64,', Mención en Salud y Producción Animal',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (64,', Mención en Producción Agrícola Sostenible',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (65,', Mención Ecología y Economía de los Recursos Naturales',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (66,', Mención Gestión Ambiental y Biodiversidad',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (66,'con Mención en Saneamiento Alimentario y Ambiental',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (66,', Mención Microbiología',1, now());


insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (68,', Mención Estrategia de Enseñanza - Aprendizaje y Evaluación',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (68,', Mención en Educación Intercultural Bilingüe',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (68,', Mención en Gestión Educacional',1, now());



insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (69,', Mención en Gestión Empresarial',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (69,', Mención Gestión Pública',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (69,', Mención Gerencia Social',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (69,', Mención en Marketing Empresarial',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (69,', Mención Contabilidad y Finanzas',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (70,', Mención en Auditoría Integral',1, now());


insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (72,', Mención Ciencias Penales',1, now());

insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (72,', Mención en Derecho Civil y Comercial',1, now());


insert into subdenominacion (den_id,subDen_MasFem,subDen_estado,subDen_createdate)
VALUES (73,', Mención Gerencia de Proyectos y Medio Ambiente',1, now());


select d.den_id,d.den_MasFem, s.subDen_MasFem from denominacion d
left join subdenominacion s on d.den_id = s.den_id;


ALTER TABLE `dbgradostitulos`.`denominacion` 
ADD INDEX `fk_den_nivel_idx` (`nivel_id` ASC) VISIBLE;
;
ALTER TABLE `dbgradostitulos`.`denominacion` 
ADD CONSTRAINT `fk_den_nivel`
  FOREIGN KEY (`nivel_id`)
  REFERENCES `dbgradostitulos`.`nivel` (`nivel_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  ALTER TABLE `dbgradostitulos`.`denominacion` 
DROP FOREIGN KEY `fk_den_escuela`;
ALTER TABLE `dbgradostitulos`.`denominacion` 
CHANGE COLUMN `esc_id` `esc_code` INT NOT NULL ,
ADD INDEX `fk_den_nivel_idx` (`nivel_id` ASC) VISIBLE,
DROP INDEX `fk_den_nivel_idx` ;
;
ALTER TABLE `dbgradostitulos`.`denominacion` 
ADD CONSTRAINT `fk_den_escuela`
  FOREIGN KEY (`esc_code`)
  REFERENCES `dbgradostitulos`.`escuela` (`esc_code`);

  CREATE TABLE `dbgradostitulos`.`expediente` (
  `exp_id` INT NOT NULL AUTO_INCREMENT,
  `ses_id` INT NOT NULL,
  `genCop_id` INT NOT NULL,
  `nivel_id` INT NOT NULL,
  `esc_id` INT NOT NULL,
  `org_id` INT NOT NULL,
  `resol_id` INT NOT NULL,
  `per_id` INT NOT NULL,
  `actAca_id` INT NOT NULL,
  `den_id` INT NOT NULL,
  `subDen_id` INT NULL DEFAULT NULL,
  `exp_denominacion` VARCHAR(300) NOT NULL,
  `exp_estado` SMALLINT NOT NULL DEFAULT 1,
  `exp_createdate` DATETIME NULL DEFAULT NULL,
  `exp_modifieddate` DATETIME NULL DEFAULT NULL,
  `exp_deletedate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`exp_id`),
  INDEX `fk_exp_ses_idx` (`ses_id` ASC) VISIBLE,
  INDEX `fk_exp_gencop_idx` (`genCop_id` ASC) VISIBLE,
  INDEX `fk_exp_nivel_idx` (`nivel_id` ASC) VISIBLE,
  INDEX `fk_exp_esc_idx` (`esc_id` ASC) VISIBLE,
  INDEX `fk_exp_org_idx` (`org_id` ASC) VISIBLE,
  INDEX `fk_exp_resol_idx` (`resol_id` ASC) VISIBLE,
  INDEX `fk_exp_per_idx` (`per_id` ASC) VISIBLE,
  INDEX `fk_exp_actAca_idx` (`actAca_id` ASC) VISIBLE,
  INDEX `fk_exp_den_idx` (`den_id` ASC) VISIBLE,
  INDEX `fk_exp_subDen_idx` (`subDen_id` ASC) VISIBLE,
  CONSTRAINT `fk_exp_ses`
    FOREIGN KEY (`ses_id`)
    REFERENCES `dbgradostitulos`.`sesion` (`ses_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_gencop`
    FOREIGN KEY (`genCop_id`)
    REFERENCES `dbgradostitulos`.`generacion_copia` (`genCop_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_nivel`
    FOREIGN KEY (`nivel_id`)
    REFERENCES `dbgradostitulos`.`nivel` (`nivel_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_esc`
    FOREIGN KEY (`esc_id`)
    REFERENCES `dbgradostitulos`.`escuela` (`esc_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_org`
    FOREIGN KEY (`org_id`)
    REFERENCES `dbgradostitulos`.`organo` (`org_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_resol`
    FOREIGN KEY (`resol_id`)
    REFERENCES `dbgradostitulos`.`resolucion` (`resol_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_per`
    FOREIGN KEY (`per_id`)
    REFERENCES `dbgradostitulos`.`persona` (`per_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_actAca`
    FOREIGN KEY (`actAca_id`)
    REFERENCES `dbgradostitulos`.`acto_academico` (`actAca_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_den`
    FOREIGN KEY (`den_id`)
    REFERENCES `dbgradostitulos`.`denominacion` (`den_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exp_subDen`
    FOREIGN KEY (`subDen_id`)
    REFERENCES `dbgradostitulos`.`subdenominacion` (`subDen_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


ALTER TABLE `dbgradostitulos`.`organo` 
DROP FOREIGN KEY `organo_entidad_tipo`;
ALTER TABLE `dbgradostitulos`.`organo` 
DROP COLUMN `entTipo_id`,
DROP INDEX `organo_entidad_tipo_idx` ;
;

ALTER TABLE `dbgradostitulos`.`escuela` 
ADD COLUMN `esc_code` INT NOT NULL AFTER `esc_id`,
ADD UNIQUE INDEX `esc_code_UNIQUE` (`esc_code` ASC) VISIBLE;
;


ALTER TABLE `dbgradostitulos`.`expediente` 
ADD COLUMN `fecha_actAca` DATETIME NOT NULL AFTER `actAca_id`;


ALTER TABLE `dbgradostitulos`.`expediente` 
DROP FOREIGN KEY `fk_exp_esc`;
ALTER TABLE `dbgradostitulos`.`expediente` 
CHANGE COLUMN `esc_id` `esc_code` INT NOT NULL ;
ALTER TABLE `dbgradostitulos`.`expediente` 
ADD CONSTRAINT `fk_exp_esc`
  FOREIGN KEY (`esc_code`)
  REFERENCES `dbgradostitulos`.`escuela` (`esc_id`);

ALTER TABLE `dbgradostitulos`.`resolucion` 
ADD COLUMN `resol_memorando` VARCHAR(150) NULL AFTER `resol_nroSolicitud`;

ALTER TABLE `dbgradostitulos`.`expediente` 
DROP FOREIGN KEY `fk_exp_org`;
ALTER TABLE `dbgradostitulos`.`expediente` 
DROP COLUMN `org_id`,
DROP INDEX `fk_exp_org_idx` ;
;


ALTER TABLE `dbgradostitulos`.`resolucion` 
CHANGE COLUMN `resol_numero` `resol_numero` VARCHAR(4) NOT NULL ;

ALTER TABLE `dbgradostitulos`.`expediente` 
CHANGE COLUMN `nivel_id` `nivel_id` INT NOT NULL AFTER `ses_id`;



USE `dbgradostitulos`;
DROP procedure IF EXISTS `insertarExpediente`;

DELIMITER $$
USE `dbgradostitulos`$$
CREATE PROCEDURE insertarExpediente (in ses_idE int,in nivel_idE int,in genCop_idE int,  in esc_codeE int,
 in org_idR int,in sesTipo_idR int, in ses_fechaR date,
 in resol_fechaR date,in resol_numeroR VARCHAR(4), 
 in resol_fechaSolicitudR date,in resol_nroSolicitudR VARCHAR(15), in resol_memorandoR VARCHAR(150),
 in per_idE int, in actAca_idE int, in fecha_actAcaE date, in den_idE int, in subDen_idE int)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
	SHOW ERRORS LIMIT 1;
	ROLLBACK;
	END; 
    
	DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
	SHOW WARNINGS LIMIT 1;
	ROLLBACK;
	END;
    
	START TRANSACTION;
     
    INSERT INTO sesion (org_id,sesTipo_id,ses_fecha,ses_estado,ses_createdate)
		VALUES (org_idR,sesTipo_idR,ses_fechaR,1,now());
            -- SELECT MAX(id) AS id FROM tabla
	INSERT INTO resolucion(ses_id,resol_fecha,resol_numero,resol_fechaSolicitud,resol_nroSolicitud,resol_memorando,resol_estado,resol_createdate)
		VALUES (LAST_INSERT_ID(),resol_fechaR,resol_numeroR,resol_fechaSolicitudR,resol_nroSolicitudR,resol_memorandoR,1,now());
	 SET @sexo := (SELECT per_sexo FROM persona WHERE per_id = per_idE);
	 SET @denF := (SELECT CONCAT(IF(@sexo = 'M', D.den_Mas, D.den_Fem),S.subDen_MasFem)
		FROM subdenominacion S
		INNER JOIN denominacion D on S.den_id = D.den_id
		WHERE D.den_id = den_idE and S.subDen_id = subDen_idE);

	 INSERT INTO expediente(ses_id,nivel_id,genCop_id,esc_code,resol_id,per_id,actAca_id,fecha_actAca,den_id,subDen_id,exp_denominacion,exp_estado,exp_createdate)
		VALUES (ses_idE,nivel_idE,genCop_idE,esc_codeE,LAST_INSERT_ID(),per_idE,actAca_idE,fecha_actAcaE,den_idE,subDen_idE,@denF,1,now());
	 
     COMMIT;

END$$

DELIMITER ;

ALTER TABLE `dbgradostitulos`.`expediente` 
ADD COLUMN `exp_procesado` SMALLINT NOT NULL DEFAULT '0' AFTER `exp_denominacion`;

ALTER TABLE `dbgradostitulos`.`expediente` 
CHARACTER SET = utf8mb4 , COLLATE = utf8mb4_spanish_ci ;

ALTER SCHEMA `dbgradostitulos`  DEFAULT CHARACTER SET utf8mb4  DEFAULT COLLATE utf8mb4_spanish_ci ;

ALTER SCHEMA `dbgradostitulos`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_spanish_ci ;

ALTER TABLE `dbgradostitulos`.`facultad` 
ADD COLUMN `fac_alias` VARCHAR(150) NULL DEFAULT NULL AFTER `fac_nombre`,
ADD COLUMN `fac_autoridad` VARCHAR(150) NULL DEFAULT NULL AFTER `fac_sigla`;


CREATE TABLE `dbgradostitulos`.`diligencia` (
  `dil_id` INT NOT NULL AUTO_INCREMENT,
  `dil_proveido` VARCHAR(150) NOT NULL DEFAULT 'NULL',
  `dil_memosg` VARCHAR(150) NOT NULL DEFAULT 'NULL',
  `dil_memogt` VARCHAR(150) NOT NULL DEFAULT 'NULL',
  `dil_estado` TINYINT(1) NOT NULL DEFAULT 1,
  `dil_createdate` DATETIME NULL,
  `dil_modifieddate` DATETIME NULL,
  `dil_deletedate` DATETIME NULL,
  PRIMARY KEY (`dil_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`diligencia` 
ADD COLUMN `dil_fechaE` DATE NOT NULL AFTER `dil_memogt`;

CREATE TABLE `dbgradostitulos`.`documento` (
  `doc_id` INT NOT NULL AUTO_INCREMENT,
  `exp_id` INT NOT NULL,
  `dil_id` INT NOT NULL,
  `doc_nombre` VARCHAR(50) NULL,
  `doc_createdate` DATETIME NULL,
  PRIMARY KEY (`doc_id`),
  INDEX `fk_doc_exp_idx` (`exp_id` ASC) VISIBLE,
  INDEX `fk_doc_dil_idx` (`dil_id` ASC) VISIBLE,
  CONSTRAINT `fk_doc_exp`
    FOREIGN KEY (`exp_id`)
    REFERENCES `dbgradostitulos`.`expediente` (`exp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_doc_dil`
    FOREIGN KEY (`dil_id`)
    REFERENCES `dbgradostitulos`.`diligencia` (`dil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`documento` 
CHANGE COLUMN `doc_tipo` `doc_tipo` CHAR(3) NOT NULL ;

ALTER TABLE `dbgradostitulos`.`documento` 
DROP COLUMN `doc_tipo`;




CREATE TABLE `dbgradostitulos`.`diploma` (
  `dip_id` INT NOT NULL AUTO_INCREMENT,
  `exp_id` INT NOT NULL,
  `dil_id` INT NOT NULL,
  `dip_nombre` VARCHAR(50) NULL DEFAULT 'NULL',
  `dip_createdate` DATETIME NULL,
  PRIMARY KEY (`dip_id`),
  INDEX `fk_dip_exp_idx` (`exp_id` ASC) VISIBLE,
  INDEX `fk_dip_dil_idx` (`dil_id` ASC) VISIBLE,
  CONSTRAINT `fk_dip_exp`
    FOREIGN KEY (`exp_id`)
    REFERENCES `dbgradostitulos`.`expediente` (`exp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dip_dil`
    FOREIGN KEY (`dil_id`)
    REFERENCES `dbgradostitulos`.`diligencia` (`dil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

ALTER TABLE `dbgradostitulos`.`documento` 
ADD UNIQUE INDEX `exp_id_UNIQUE` (`exp_id` ASC) VISIBLE,
ADD UNIQUE INDEX `dil_id_UNIQUE` (`dil_id` ASC) VISIBLE;
;

ALTER TABLE `dbgradostitulos`.`documento` 
DROP INDEX `dil_id_UNIQUE` ,
DROP INDEX `exp_id_UNIQUE` ;

;

ALTER TABLE `dbgradostitulos`.`diligencia` 
ADD COLUMN `ses_id` INT NOT NULL AFTER `dil_id`,
ADD INDEX `fk_dil_ses_idx` (`ses_id` ASC) VISIBLE;
;
ALTER TABLE `dbgradostitulos`.`diligencia` 
ADD CONSTRAINT `fk_dil_ses`
  FOREIGN KEY (`ses_id`)
  REFERENCES `dbgradostitulos`.`sesion` (`ses_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


USE `dbgradostitulos`;
DROP procedure IF EXISTS `insertarSesion`;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `dbgradostitulos`.`insertarSesion`;
;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `eliminarSesion`;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `dbgradostitulos`.`eliminarSesion`;
;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `eliminarSesion`;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `dbgradostitulos`.`eliminarSesion`;
;

DELIMITER $$
USE `dbgradostitulos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarSesion`(in ses_idE int)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
	SHOW ERRORS LIMIT 1;
	ROLLBACK;
	END; 
    
	DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
	SHOW WARNINGS LIMIT 1;
	ROLLBACK;
	END;
    
	START TRANSACTION;
    
    SET @cantidad = (SELECT COUNT(exp_id) as cantidad FROM expediente WHERE ses_id = ses_idE);
    SET @ses_actual = (SELECT ses_id from sesion where ses_estado = 1);
    SET @ses_anterior = (SELECT S.ses_id FROM sesion S
            INNER JOIN organo O ON O.org_id = S.org_id
            INNER JOIN sesion_tipo ST on ST.sesTipo_id = S.sesTipo_id
            WHERE ses_fecha = (SELECT max(ses_fecha) FROM sesion WHERE ses_estado = 0 AND (S.org_id = 1 or S.org_id = 2 or S.org_id = 3)));
    
    IF @cantidad = 0 THEN
		IF @ses_actual = ses_idE THEN
			IF isnull(@ses_anterior)=0 THEN
				UPDATE sesion SET ses_estado = 2, ses_deletedate = now() WHERE ses_id = ses_idE;
				UPDATE sesion SET ses_estado = 1, ses_modifieddate = now() WHERE ses_id = @ses_anterior;
			ELSE
				UPDATE sesion SET ses_estado = 2, ses_deletedate = now() WHERE ses_id = ses_idE;
			END IF;
		ELSE
			UPDATE sesion SET ses_estado = 2, ses_deletedate = now() WHERE ses_id = ses_idE;
		END IF;
	END IF;
	DELETE FROM diligencia WHERE ses_id = ses_idE;
    
	COMMIT;
END$$

DELIMITER ;
;

USE `dbgradostitulos`;
DROP procedure IF EXISTS `insertarDiligencia`;

DELIMITER $$
USE `dbgradostitulos`$$
CREATE PROCEDURE `insertarDiligencia` (in dil_proveidoN varchar(150),in dil_memosgN varchar(150),in dil_memogtN varchar(150),in dil_fechaEN date)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
	SHOW ERRORS LIMIT 1;
	ROLLBACK;
	END; 
    
	DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
	SHOW WARNINGS LIMIT 1;
	ROLLBACK;
	END;
    
	START TRANSACTION;
    
    SET @ses_actual = (SELECT ses_id from sesion where ses_estado = 1);
    SET @dil_actual = (SELECT dil_id from diligencia where ses_id = @ses_actual);
    IF isnull(@dil_actual) THEN
		INSERT INTO diligencia (ses_id,dil_proveido,dil_memosg,dil_memogt,dil_fechaE,dil_estado,dil_createdate)
		VALUES (@ses_actual,dil_proveidoN,dil_memosgN,dil_memogtN,dil_fechaEN,1,now());
	END IF;
	COMMIT;
            
END$$

DELIMITER ;

