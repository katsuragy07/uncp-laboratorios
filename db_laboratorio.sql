/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.33-log : Database - db_laboratorio
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_laboratorio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `db_laboratorio`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `tb_actividad_infoacademica` */

DROP TABLE IF EXISTS `tb_actividad_infoacademica`;

CREATE TABLE `tb_actividad_infoacademica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_academica_id` int(11) DEFAULT NULL,
  `tipo_equipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `tb_actividad_infoacademica` */

/*Table structure for table `tb_actividad_infoservicio` */

DROP TABLE IF EXISTS `tb_actividad_infoservicio`;

CREATE TABLE `tb_actividad_infoservicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_investigacion_id` int(11) DEFAULT NULL,
  `tipo_equipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `info_servicio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `tb_actividad_infoservicio` */

insert  into `tb_actividad_infoservicio`(`id`,`info_investigacion_id`,`tipo_equipo_id`,`descripcion`,`cantidad`,`info_servicio_id`) values (22,NULL,2,'asdsad dsfdsfsdf','34',3),(23,NULL,2,'sa sdasdas d','3424',3);

/*Table structure for table `tb_actividad_investigacion` */

DROP TABLE IF EXISTS `tb_actividad_investigacion`;

CREATE TABLE `tb_actividad_investigacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_investigacion_id` int(11) DEFAULT NULL,
  `tipo_equipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `tb_actividad_investigacion` */

insert  into `tb_actividad_investigacion`(`id`,`info_investigacion_id`,`tipo_equipo_id`,`descripcion`,`cantidad`) values (20,2,1,'sadasd','342');

/*Table structure for table `tb_asignatura` */

DROP TABLE IF EXISTS `tb_asignatura`;

CREATE TABLE `tb_asignatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_asignatura` varchar(45) DEFAULT NULL,
  `nom_asignatura` varchar(45) DEFAULT NULL,
  `facultad_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_asignatura_tb_facultad1_idx` (`facultad_id`),
  CONSTRAINT `fk_tb_asignatura_tb_facultad1` FOREIGN KEY (`facultad_id`) REFERENCES `tb_facultad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_asignatura` */

insert  into `tb_asignatura`(`id`,`cod_asignatura`,`nom_asignatura`,`facultad_id`) values (1,'052C','INGENIERIA DE BIOPROCESOS',23);

/*Table structure for table `tb_atencion` */

DROP TABLE IF EXISTS `tb_atencion`;

CREATE TABLE `tb_atencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requerimiento_id` int(11) DEFAULT NULL COMMENT 'Solo si proviene de solicitud',
  `fch_pedido` date DEFAULT NULL,
  `hora_pedido` time DEFAULT NULL,
  `fch_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `laboratorio_origen_id` int(11) NOT NULL,
  `laboratorio_dest_id` int(11) NOT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `academico_id` int(11) DEFAULT NULL,
  `investigacion_id` int(11) DEFAULT NULL,
  `encargado_lab_id` int(11) NOT NULL,
  `solicitado_id` int(11) DEFAULT NULL,
  `cargo_solicitado` int(11) DEFAULT NULL,
  `numdoc_solicitado` varchar(45) DEFAULT NULL,
  `autorizado_id` int(11) DEFAULT NULL,
  `cargo_autorizado` int(11) DEFAULT NULL,
  `numdoc_autorizado` varchar(45) DEFAULT NULL,
  `recibido_id` int(11) NOT NULL COMMENT 'Es la persona que recibe los materiales, equipos o insumos',
  `resp_atencion_id` int(11) DEFAULT NULL COMMENT 'Quien despacha',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `status_atencion` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`),
  KEY `fk_tb_atencion_tb_laboratorio1_idx` (`laboratorio_origen_id`),
  KEY `fk_tb_atencion_tb_laboratorio2_idx` (`laboratorio_dest_id`),
  KEY `fk_tb_atencion_tb_persona1_idx` (`encargado_lab_id`),
  KEY `fk_tb_atencion_tb_persona2_idx` (`recibido_id`),
  KEY `fk_tb_atencion_tb_solicitud1_idx` (`requerimiento_id`),
  CONSTRAINT `fk_etb_atencion` FOREIGN KEY (`recibido_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ldtb_atencion` FOREIGN KEY (`laboratorio_dest_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lotb_atencion` FOREIGN KEY (`laboratorio_origen_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rtb_atencion` FOREIGN KEY (`encargado_lab_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stb_atencion` FOREIGN KEY (`requerimiento_id`) REFERENCES `tb_requerimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_atencion` */

insert  into `tb_atencion`(`id`,`requerimiento_id`,`fch_pedido`,`hora_pedido`,`fch_entrega`,`hora_entrega`,`laboratorio_origen_id`,`laboratorio_dest_id`,`servicio_id`,`academico_id`,`investigacion_id`,`encargado_lab_id`,`solicitado_id`,`cargo_solicitado`,`numdoc_solicitado`,`autorizado_id`,`cargo_autorizado`,`numdoc_autorizado`,`recibido_id`,`resp_atencion_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status_atencion`) values (1,NULL,'2021-11-29','12:29:00','2021-12-21','11:28:00',1,258,NULL,NULL,NULL,15,15,1,NULL,15,1,NULL,15,15,'2021-12-21 11:30:20',264,'2021-12-21 11:30:20',NULL,NULL,NULL,NULL,'AC'),(2,5,'2021-12-21','11:38:27','2021-12-21','11:44:43',258,258,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,19,19,'2021-12-21 11:44:43',263,'2021-12-21 11:44:43',NULL,NULL,NULL,NULL,'AC'),(3,6,'2021-12-21','11:46:43','2021-12-21','11:47:05',258,51,NULL,NULL,NULL,15,NULL,NULL,NULL,NULL,NULL,NULL,15,16,'2021-12-21 11:47:05',263,'2021-12-21 11:47:05',NULL,NULL,NULL,NULL,'AC'),(4,NULL,'2021-12-16','17:33:00','2021-12-21','14:33:00',1,20,NULL,NULL,NULL,4,4,2,'11111111',4,2,'11111111',4,4,'2021-12-21 14:34:43',264,'2021-12-21 14:34:43',NULL,NULL,NULL,NULL,'AC');

/*Table structure for table `tb_cargo` */

DROP TABLE IF EXISTS `tb_cargo`;

CREATE TABLE `tb_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='1 Responsable de laboratorio\n2. Corresponsable de laboratorio\n3. Tecnico laboratorista\nOtros';

/*Data for the table `tb_cargo` */

insert  into `tb_cargo`(`id`,`cargo`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'RESPONSABLE/JEFE DE LABORATORIO','2021-12-16 21:23:45',55,'2021-12-16 21:23:45',NULL,NULL,NULL,NULL),(2,'CORRESPONSABLE DE LABORATORIO','2021-12-16 21:24:29',55,'2021-12-16 21:24:29',NULL,NULL,NULL,NULL),(3,'TECNICO LABORATORISTA','2021-12-16 21:26:00',55,'2021-12-16 21:26:00',NULL,NULL,NULL,NULL),(4,'PRACTICANTE','2021-12-17 12:46:05',1,'2021-12-17 12:46:05',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_componentes_computo` */

DROP TABLE IF EXISTS `tb_componentes_computo`;

CREATE TABLE `tb_componentes_computo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) DEFAULT NULL,
  `nom_componente` varchar(255) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `capacidad` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `flg_original` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(45) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `tb_componentes_computo` */

insert  into `tb_componentes_computo`(`id`,`equipo_id`,`nom_componente`,`marca`,`capacidad`,`descripcion`,`flg_original`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status`) values (17,1,'RAM',NULL,NULL,NULL,NULL,'2021-12-17 10:26:03',1,'2021-12-17 10:42:58',1,NULL,NULL,NULL,'AC'),(18,1,'DISCO SOLIDO','INTEL','520 GB',NULL,NULL,'2021-12-17 10:45:14',1,'2021-12-17 10:45:14',NULL,NULL,NULL,NULL,'AC'),(19,1,'SISTEMA OPERATIVO','W7',NULL,NULL,'LICENCIA POR UN AÑO','2021-12-17 10:45:53',1,'2021-12-17 10:45:53',NULL,NULL,NULL,NULL,'AC'),(20,1,'MEMORIA RAM',NULL,'1 TB',NULL,NULL,'2021-12-17 12:45:28',1,'2021-12-17 12:45:28',NULL,NULL,NULL,NULL,'AC'),(21,4,'DISCO SOLIDO','INTEL','520 GB',NULL,NULL,'2021-12-17 15:50:55',1,'2021-12-17 15:50:55',NULL,NULL,NULL,NULL,'AC');

/*Table structure for table `tb_detalle_atencion` */

DROP TABLE IF EXISTS `tb_detalle_atencion`;

CREATE TABLE `tb_detalle_atencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atencion_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `lote_equipo_id` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `fch_vencimiento` date DEFAULT NULL,
  `cantidad_equivalencia` int(11) DEFAULT NULL COMMENT 'Cantidad de min por insumo',
  `cantidad_atencion` decimal(10,3) DEFAULT NULL,
  `cantidad_atencion_min` int(11) DEFAULT NULL COMMENT 'Es con la que normalmente se atiende',
  `flg_devolucion_at` int(11) DEFAULT '0' COMMENT '0 No devuelve\n 1 Devuelve',
  `detalle_requerimiento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_detalle_atencion_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_detalle_atencion_tb_lote_equipo1_idx` (`lote_equipo_id`),
  KEY `fk_tb_detalle_atencion_tb_atencion1_idx` (`atencion_id`),
  CONSTRAINT `fk_atb_detalle_atencion` FOREIGN KEY (`atencion_id`) REFERENCES `tb_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_etb_detalle_atencion` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ltb_detalle_atencion` FOREIGN KEY (`lote_equipo_id`) REFERENCES `tb_lote_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_detalle_atencion` */

insert  into `tb_detalle_atencion`(`id`,`atencion_id`,`equipo_id`,`lote_equipo_id`,`lote`,`fch_vencimiento`,`cantidad_equivalencia`,`cantidad_atencion`,`cantidad_atencion_min`,`flg_devolucion_at`,`detalle_requerimiento_id`) values (1,1,16,11,NULL,NULL,500,1.000,500,0,NULL),(2,2,16,14,NULL,NULL,500,0.200,100,0,2),(3,3,13,15,NULL,NULL,1,5.000,5,0,3),(4,4,9,6,NULL,NULL,100,0.150,15,0,NULL);

/*Table structure for table `tb_detalle_devolucion` */

DROP TABLE IF EXISTS `tb_detalle_devolucion`;

CREATE TABLE `tb_detalle_devolucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detalle_atencion_id` int(11) NOT NULL,
  `cantidad_devolucion` decimal(10,2) DEFAULT NULL,
  `devolucion_id` int(11) NOT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `lote_equipo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_det_devolucion_tb_detalle_atencion1_idx` (`detalle_atencion_id`),
  KEY `fk_tb_det_devolucion_tb_devolucion1_idx` (`devolucion_id`),
  CONSTRAINT `fk_dv` FOREIGN KEY (`devolucion_id`) REFERENCES `tb_devolucion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_detalle_devolucion` FOREIGN KEY (`detalle_atencion_id`) REFERENCES `tb_detalle_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_detalle_devolucion` */

insert  into `tb_detalle_devolucion`(`id`,`detalle_atencion_id`,`cantidad_devolucion`,`devolucion_id`,`equipo_id`,`lote_equipo_id`) values (1,3,4.00,1,13,16),(2,3,1.00,2,13,17);

/*Table structure for table `tb_detalle_recepcion` */

DROP TABLE IF EXISTS `tb_detalle_recepcion`;

CREATE TABLE `tb_detalle_recepcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recepcion_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `lote_equipo_id` int(11) NOT NULL,
  `detalle_atencion_id` int(11) DEFAULT NULL,
  `lote` varchar(45) DEFAULT NULL,
  `fch_vencimiento` date DEFAULT NULL,
  `cantidad_equivalencia` int(11) DEFAULT NULL COMMENT 'Cantidad de min por insumo',
  `cantidad_recepcion` decimal(10,3) DEFAULT NULL,
  `cantidad_recepcion_min` int(11) DEFAULT NULL COMMENT 'Es con la que normalmente se atiende',
  PRIMARY KEY (`id`),
  KEY `fk_tb_detalle_atencion_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_detalle_atencion_tb_lote_equipo1_idx` (`lote_equipo_id`),
  KEY `fk_tb_detalle_recepcion_tb_recepcion1_idx` (`recepcion_id`),
  KEY `fk_tb_detalle_recepcion_tb_detalle_atencion1_idx` (`detalle_atencion_id`),
  CONSTRAINT `fk_etb_detalle_atencion0` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ltb_detalle_atencion0` FOREIGN KEY (`lote_equipo_id`) REFERENCES `tb_lote_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_detalle_recepcion_tb_detalle_atencion1` FOREIGN KEY (`detalle_atencion_id`) REFERENCES `tb_detalle_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_detalle_recepcion_tb_recepcion1` FOREIGN KEY (`recepcion_id`) REFERENCES `tb_recepcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_detalle_recepcion` */

insert  into `tb_detalle_recepcion`(`id`,`recepcion_id`,`equipo_id`,`lote_equipo_id`,`detalle_atencion_id`,`lote`,`fch_vencimiento`,`cantidad_equivalencia`,`cantidad_recepcion`,`cantidad_recepcion_min`) values (1,1,16,13,1,NULL,NULL,500,1.000,500),(2,2,9,18,NULL,NULL,NULL,100,4.100,410);

/*Table structure for table `tb_detalle_requerimiento` */

DROP TABLE IF EXISTS `tb_detalle_requerimiento`;

CREATE TABLE `tb_detalle_requerimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requerimiento_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `cantidad_equivalencia` int(11) DEFAULT NULL,
  `cantidad_requerimiento` decimal(10,3) DEFAULT NULL,
  `cantidad_requerimiento_min` int(11) DEFAULT NULL,
  `lote_equipo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_detalle_atencion_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_detalle_solicitud_tb_solicitud1_idx` (`requerimiento_id`),
  CONSTRAINT `fk_etb_detalle_requerimiento` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rtb_detalle_requerimiento` FOREIGN KEY (`requerimiento_id`) REFERENCES `tb_requerimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_detalle_requerimiento` */

insert  into `tb_detalle_requerimiento`(`id`,`requerimiento_id`,`equipo_id`,`cantidad_equivalencia`,`cantidad_requerimiento`,`cantidad_requerimiento_min`,`lote_equipo_id`) values (1,3,3,1,1.000,1,NULL),(2,5,16,500,0.200,100,13),(3,6,13,1,5.000,5,9),(4,7,5,1,5.000,5,2);

/*Table structure for table `tb_devolucion` */

DROP TABLE IF EXISTS `tb_devolucion`;

CREATE TABLE `tb_devolucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atencion_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_devolucion_tb_atencion1_idx` (`atencion_id`),
  CONSTRAINT `fk_atb_devolucion` FOREIGN KEY (`atencion_id`) REFERENCES `tb_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_devolucion` */

insert  into `tb_devolucion`(`id`,`atencion_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,3,'2021-12-21 11:47:30',263,'2021-12-21 11:47:30',NULL,NULL,NULL,NULL),(2,3,'2021-12-21 11:48:21',263,'2021-12-21 11:48:21',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_doc_especifico` */

DROP TABLE IF EXISTS `tb_doc_especifico`;

CREATE TABLE `tb_doc_especifico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `archivo` varchar(45) DEFAULT NULL,
  `laboratoriodet_id` int(11) NOT NULL COMMENT '0 Todos\nLos demas de acuerdo al laboratorio',
  `tipo_documento_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`laboratoriodet_id`),
  KEY `fk_doc_especifico_tb_tipo_documento1_idx` (`tipo_documento_id`),
  CONSTRAINT `fk_ltb_doc_especifico` FOREIGN KEY (`laboratoriodet_id`) REFERENCES `tb_laboratorio_det` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tdtb_doc_especifico` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tb_tipo_doc_especifico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_doc_especifico` */

insert  into `tb_doc_especifico`(`id`,`nombre`,`archivo`,`laboratoriodet_id`,`tipo_documento_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status`) values (1,'MANUAL DE BUENAS PRACTICAS DE LABORATORIO',NULL,1,1,'2021-12-16 21:18:15',NULL,'2021-12-16 21:18:15',55,NULL,NULL,NULL,'AC'),(2,'REGLAMENTO DE USO DE LABORATORIO',NULL,1,1,'2021-12-16 21:19:09',NULL,'2021-12-16 21:19:09',55,NULL,NULL,NULL,'AC'),(3,'MATRIZ IPERC',NULL,1,2,'2021-12-16 21:19:29',NULL,'2021-12-16 21:19:29',55,NULL,NULL,NULL,'AC'),(4,'MAPAS DE RIESGOS',NULL,1,2,'2021-12-16 21:20:07',NULL,'2021-12-16 21:20:07',55,NULL,NULL,NULL,'AC'),(5,'PLAN DE MANTENIMIENTO PREVENTIVO Y CORRECTIVO DEL LOS EQUIPOS DEL LABORATORIO','DOCESPECIFICO_ejhYCxHscZ163976146420hzN.pdf',27,1,'2021-12-17 12:17:44',NULL,'2021-12-17 12:17:44',1,NULL,NULL,NULL,'AC');

/*Table structure for table `tb_doc_general` */

DROP TABLE IF EXISTS `tb_doc_general`;

CREATE TABLE `tb_doc_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `archivo` varchar(100) DEFAULT NULL,
  `motivo_elim` char(45) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_doc_general` */

insert  into `tb_doc_general`(`id`,`nombre`,`archivo`,`motivo_elim`,`status`) values (1,'PLAN DE SEGURIDAD Y SALUD EN EL TRABAJO RESOLUCION Nº 0691-CU-2021','DOCGENERAL_LA8rhu8ZFz1639753608Qu3ym.pdf',NULL,'AC'),(2,'REGLAMENTO DE SEGURIDAD Y SALUD EN EL TRABAJO CON RESOLUCION Nº 0691-CU-2021','DOCGENERAL_NlJlIhmeWj1639753741pIInQ.pdf',NULL,'AC');

/*Table structure for table `tb_documento_equipo` */

DROP TABLE IF EXISTS `tb_documento_equipo`;

CREATE TABLE `tb_documento_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `nombre_doc` varchar(100) DEFAULT NULL,
  `archivo_doc` varchar(45) DEFAULT NULL,
  `tipo_doc_equipo_id` int(11) NOT NULL COMMENT '1 Instructivo de Uso\n2 Certificado de calidad',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_documento_equipo_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_documento_equipo_tb_tipo_doc_equipo1_idx` (`tipo_doc_equipo_id`),
  CONSTRAINT `fk_eqtb_documento_equipo` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_documento_equipo_tb_tipo_doc_equipo1` FOREIGN KEY (`tipo_doc_equipo_id`) REFERENCES `tb_tipo_doc_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_documento_equipo` */

/*Table structure for table `tb_equipo` */

DROP TABLE IF EXISTS `tb_equipo`;

CREATE TABLE `tb_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_equipo_id` int(11) NOT NULL COMMENT 'equipo de especialidad, materiales, insumos',
  `cod_patrimonio` varchar(45) DEFAULT NULL,
  `nom_equipo` varchar(150) NOT NULL,
  `ficha_equipo` varchar(45) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `serie` varchar(45) DEFAULT NULL,
  `concentracion` varchar(50) DEFAULT NULL,
  `especificacion` varchar(50) DEFAULT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `unidad_med_min_id` int(11) DEFAULT NULL,
  `cantidad_min` int(11) DEFAULT NULL COMMENT 'Solo insumos',
  `laboratorio_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `ubicacion` varchar(60) DEFAULT NULL COMMENT 'area u oficina',
  `estado_equipo` varchar(45) DEFAULT 'OP',
  `foto_equipo` varchar(45) DEFAULT NULL,
  `so` varchar(45) DEFAULT NULL,
  `antivirus` varchar(45) DEFAULT NULL,
  `flg_devolucion` tinyint(4) DEFAULT '0' COMMENT '0 No devuelve\n1 Si devuelve',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `tipo_fiscalizado_id` int(11) NOT NULL COMMENT '1',
  `plan_mantenimiento` varchar(100) DEFAULT NULL,
  `fecha_ult_mantenimiento` date DEFAULT NULL,
  `fecha_prox_mantenimiento` date DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `fch_ini_garantia` date DEFAULT NULL,
  `fch_fin_garantia` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx1` (`tipo_equipo_id`),
  KEY `fk_tb_equipamiento_tb_laboratorio1_idx` (`laboratorio_id`),
  KEY `fk_tb_equipo_tb_proveedor1_idx` (`proveedor_id`),
  KEY `fk_tb_equipo_tb_unidad_medida1_idx` (`unidad_medida_id`),
  KEY `fk_tb_equipo_tb_persona1_idx` (`responsable_id`),
  KEY `fk_tb_equipo_tb_tipo_fiscalizado1_idx` (`tipo_fiscalizado_id`),
  CONSTRAINT `fk_ltb_equipo` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ptb_equipo` FOREIGN KEY (`proveedor_id`) REFERENCES `tb_proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipo_tb_persona1` FOREIGN KEY (`responsable_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_equipo_tb_tipo_fiscalizado1` FOREIGN KEY (`tipo_fiscalizado_id`) REFERENCES `tb_tipo_fiscalizado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tetb_equipo` FOREIGN KEY (`tipo_equipo_id`) REFERENCES `tb_tipo_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_umtb_equipo` FOREIGN KEY (`unidad_medida_id`) REFERENCES `tb_unidad_medida` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `tb_equipo` */

insert  into `tb_equipo`(`id`,`tipo_equipo_id`,`cod_patrimonio`,`nom_equipo`,`ficha_equipo`,`proveedor_id`,`marca`,`modelo`,`serie`,`concentracion`,`especificacion`,`unidad_medida_id`,`unidad_med_min_id`,`cantidad_min`,`laboratorio_id`,`responsable_id`,`ubicacion`,`estado_equipo`,`foto_equipo`,`so`,`antivirus`,`flg_devolucion`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`tipo_fiscalizado_id`,`plan_mantenimiento`,`fecha_ult_mantenimiento`,`fecha_prox_mantenimiento`,`stock_minimo`,`fch_ini_garantia`,`fch_fin_garantia`) values (1,1,'740899501560','UNIDAD CENTRAL DE PROCESO - CPU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,53,1,'CIUDAD UNIVERSITARIA','BU',NULL,NULL,NULL,0,'2021-12-16 22:04:42',55,'2021-12-20 10:08:03',1,NULL,NULL,NULL,1,'Plan_Mantenimiento_9fTVrM0oCV1639710282.pdf','2021-12-09','2021-12-23',NULL,'2021-12-06',NULL),(2,1,'740899504453','UNIDAD CENTRAL DE PROCESO - CPU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,1,2,'ESCUELA DE POST GRADO','BJ',NULL,NULL,NULL,0,'2021-12-17 10:18:00',1,'2021-12-17 10:18:27',NULL,'2021-12-17 10:18:27',1,'Malogrado',1,'Plan_Mantenimiento_BZfD1MPtmr1639754280.pdf','2021-11-29','2021-12-17',NULL,NULL,NULL),(3,3,NULL,'Insumo A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 10:20:46',1,'2021-12-17 10:20:46',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'740899501560','UNIDAD CENTRAL DE PROCESO - CPU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,1,2,'CIUDAD UNIVERSITARIA','BJ',NULL,NULL,NULL,0,'2021-12-17 10:34:35',1,'2021-12-17 10:35:26',NULL,'2021-12-17 10:35:26',1,'POR TIEMPO',1,'Plan_Mantenimiento_XNLB3y91l91639755275.pdf','2021-12-01','2022-01-01',NULL,NULL,NULL),(5,2,NULL,'VASO DE PRECIPITACION',NULL,NULL,'ISOLAP',NULL,NULL,NULL,NULL,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 10:36:50',1,'2021-12-17 10:36:50',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(6,3,NULL,'ROJO DE METILO',NULL,NULL,'MEC',NULL,NULL,'68 %','FRASCO DE 100 GRAMOS',1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 10:39:50',1,'2021-12-17 10:39:50',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,'740899501560','UNIDAD CENTRAL DE PROCESO - CPU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,1,7,'CIUDAD UNIVERSITARIA','BU',NULL,NULL,NULL,0,'2021-12-17 12:33:24',1,'2021-12-17 12:33:24',NULL,NULL,NULL,NULL,1,NULL,'2021-12-01','2022-01-08',NULL,NULL,NULL),(8,2,NULL,'VASO DE PRECIPITACION',NULL,NULL,'MEC',NULL,NULL,NULL,NULL,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 12:36:04',1,'2021-12-17 12:36:04',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(9,3,NULL,'CLORURO DE POTASIO',NULL,NULL,'MEC',NULL,NULL,'68 %','FRASCO DE 100 GRAMOS',4,1,100,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 12:42:58',1,'2021-12-17 12:42:58',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(10,2,NULL,'VASO DE PRECIPITACION',NULL,NULL,'MEC',NULL,NULL,NULL,NULL,4,4,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-17 15:47:14',1,'2021-12-17 15:47:14',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(11,2,NULL,'VASO DE PRECIPITACION',NULL,NULL,'MEC',NULL,NULL,NULL,NULL,6,6,1,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-20 12:01:41',1,'2021-12-20 12:01:41',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,15,NULL,NULL),(12,1,'740899501560','UNIDAD CENTRAL DE PROCESO - CPU',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,258,3,'CIUDAD UNIVERSITARIA','NU',NULL,NULL,NULL,0,'2021-12-21 10:19:31',263,'2021-12-21 10:19:31',NULL,NULL,NULL,NULL,1,NULL,'2021-12-07','2021-12-31',NULL,'2021-12-01','2021-12-28'),(13,2,NULL,'VASO DE PRECIPITACION',NULL,NULL,'KINDEX',NULL,NULL,NULL,'250 mL',1,1,1,258,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-21 10:51:25',263,'2021-12-21 10:51:25',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,10,NULL,NULL),(14,1,'111111','BALANZA DE PRECISION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,1,258,15,'EEMY','BJ',NULL,NULL,NULL,0,'2021-12-21 10:55:11',263,'2021-12-21 11:56:22',NULL,'2021-12-21 11:56:22',263,'Deterioro',1,NULL,NULL,NULL,NULL,NULL,NULL),(15,3,NULL,'ACIDO CLORHÍDRICO',NULL,NULL,'MERCK',NULL,NULL,'37 %','FRASCO DE 2.5L',4,3,2500,258,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-21 11:06:08',263,'2021-12-21 11:06:08',NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL),(16,3,NULL,'CLORURO DE MAGNESIO',NULL,NULL,'MERCK',NULL,NULL,'99 %','FRASCO DE 500 GRAMOS',4,8,500,1,NULL,NULL,NULL,NULL,NULL,NULL,0,'2021-12-21 11:16:04',1,'2021-12-21 11:16:04',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_equipo_seguridad` */

DROP TABLE IF EXISTS `tb_equipo_seguridad`;

CREATE TABLE `tb_equipo_seguridad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_seguridad` varchar(45) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL COMMENT '1 Individual\n2 Colectivo',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tb_equipo_seguridad` */

insert  into `tb_equipo_seguridad`(`id`,`equipo_seguridad`,`tipo`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'GUARDAPOLVO','EPP Individual','2021-12-17 06:07:18',1,'2021-12-17 06:07:18',NULL,NULL,NULL,NULL),(2,'LENTES','EPP Individual','2021-12-17 06:07:18',1,NULL,NULL,NULL,NULL,NULL),(3,'COFIA','EPP Individual','2021-12-17 06:07:18',1,NULL,NULL,NULL,NULL,NULL),(4,'GUANTES (PAR)','EPP Individual','2021-12-17 06:07:18',1,'2021-12-20 11:38:34',1,NULL,NULL,NULL),(5,'ZAPATOS DE SEGURIDAD (PAR)','EPP Individual','2021-12-17 06:07:18',1,'2021-12-20 11:37:49',1,NULL,NULL,NULL),(6,'EXTINTOR','EPP Colectivo','2021-12-17 06:08:17',1,'2021-12-20 11:30:00',1,NULL,NULL,NULL),(7,'BOTIQUÍN','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(8,'LAVAOJOS','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(9,'DUCHA DE SEGURIDAD','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(10,'DETECTOR DE HUMO','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(11,'LUCES DE EMERGENCIA','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(12,'KIT ANTIDERRAMES','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(13,'SOLUCIONES AMORTIGUADORAS','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(14,'EXTRACTORES DE POLVO','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(15,'EXTRACTORES DE GASES ','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(16,'LAVADOR DE MANOS','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(17,'DISPENSADOR DE PAPEL TOALLA','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(18,'DISPENSADOR DE JABÓN LÍQUIDO','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL),(19,'DISPENSADOR DE ALCOHOL GEL','EPP Colectivo','2021-12-17 06:08:17',1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_equipo_seguridad_lab` */

DROP TABLE IF EXISTS `tb_equipo_seguridad_lab`;

CREATE TABLE `tb_equipo_seguridad_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_seguridad_id` int(11) NOT NULL,
  `fch_vencimiento` date DEFAULT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_equipo_seg_lab_tb_equipo_seguridad1_idx` (`equipo_seguridad_id`),
  KEY `fk_tb_equipo_seg_lab_tb_laboratorio1_idx` (`laboratorio_id`),
  CONSTRAINT `fk_estb_equipo_seguridad_lab` FOREIGN KEY (`equipo_seguridad_id`) REFERENCES `tb_equipo_seguridad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ltb_equipo_seguridad_lab` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='Equipo de seguridad que tienen los laboratorios';

/*Data for the table `tb_equipo_seguridad_lab` */

insert  into `tb_equipo_seguridad_lab`(`id`,`equipo_seguridad_id`,`fch_vencimiento`,`laboratorio_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`cantidad`,`estado`) values (7,7,NULL,1,'2021-12-17 12:43:53',1,'2021-12-17 12:43:53',NULL,NULL,NULL,'Ninguno',1,'Bueno'),(8,10,NULL,1,'2021-12-17 12:43:53',1,'2021-12-17 12:43:53',NULL,NULL,NULL,NULL,NULL,NULL),(9,6,NULL,1,'2021-12-17 12:43:53',1,'2021-12-17 12:43:53',NULL,NULL,NULL,NULL,1,NULL),(10,4,NULL,1,'2021-12-17 12:43:53',1,'2021-12-17 12:43:53',NULL,NULL,NULL,NULL,12,'BUEN ESTADO'),(11,2,NULL,1,'2021-12-17 12:43:53',1,'2021-12-17 12:43:53',NULL,NULL,NULL,NULL,6,'NUEVAS'),(12,5,NULL,1,'2021-12-17 12:43:54',1,'2021-12-17 12:43:54',NULL,NULL,NULL,NULL,12,NULL),(13,7,NULL,107,'2021-12-17 15:48:40',1,'2021-12-17 15:48:40',NULL,NULL,NULL,'Ninguno',2,'Bueno'),(14,3,NULL,107,'2021-12-17 15:48:40',1,'2021-12-17 15:48:40',NULL,NULL,NULL,NULL,NULL,NULL),(15,7,NULL,258,'2021-12-23 11:55:25',1,'2021-12-23 11:55:25',NULL,NULL,NULL,NULL,3232,NULL),(16,16,NULL,258,'2021-12-23 11:55:25',1,'2021-12-23 11:55:25',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_estado_equipo` */

DROP TABLE IF EXISTS `tb_estado_equipo`;

CREATE TABLE `tb_estado_equipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `comentario` longtext,
  `proveedor_id` int(11) DEFAULT NULL COMMENT 'Mantenimiento',
  `resp_incidente_id` int(11) DEFAULT NULL,
  `resp_baja_id` int(11) DEFAULT NULL,
  `doc_sustento` varchar(45) DEFAULT NULL,
  `fch_posiblemant` date DEFAULT NULL COMMENT 'Fecha posible de retorno de mantenimiento',
  `flg_salidauncp` int(11) DEFAULT NULL COMMENT 'Si el prov. saca el equipo fuera de UNCP',
  `estado` char(2) DEFAULT NULL COMMENT 'OP Operativo, MT Mantenimiento, BJ Baja, IC Incidencia',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_estado_equipo_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_estado_equipo_tb_proveedor1_idx` (`proveedor_id`),
  KEY `fk_tb_estado_equipo_tb_persona1_idx` (`resp_incidente_id`),
  KEY `fk_tb_estado_equipo_tb_persona1_idx1` (`resp_baja_id`),
  CONSTRAINT `fk_eqtb_estado_equipo` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_prtb_estado_equipo` FOREIGN KEY (`proveedor_id`) REFERENCES `tb_proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ptb_estado_equipo` FOREIGN KEY (`resp_baja_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ritb_estado_equipo` FOREIGN KEY (`resp_incidente_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_estado_equipo` */

/*Table structure for table `tb_facultad` */

DROP TABLE IF EXISTS `tb_facultad`;

CREATE TABLE `tb_facultad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_facultad` varchar(100) DEFAULT NULL,
  `organigrama` varchar(45) DEFAULT NULL,
  `status` varchar(2) DEFAULT 'AC',
  `jefe_laboratorio_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_facultad_tb_persona1_idx` (`jefe_laboratorio_id`),
  CONSTRAINT `fk_ptb_facultad` FOREIGN KEY (`jefe_laboratorio_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

/*Data for the table `tb_facultad` */

insert  into `tb_facultad`(`id`,`nom_facultad`,`organigrama`,`status`,`jefe_laboratorio_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'UNIDAD DE LABORATORIO',NULL,'AC',NULL,NULL,NULL,'2021-12-20 12:15:05',NULL,NULL,NULL,NULL),(2,'CIENCIAS DE LA ADMINISTRACIÓN','','AC',NULL,NULL,NULL,'2021-12-20 11:26:42',NULL,NULL,NULL,NULL),(3,'AGRONOMÍA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'ANTROPOLOGÍA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'ARQUITECTURA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'CIENCAS AGRARIAS SATIPO','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'CIENCAS APLICADAS TARMA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'CIENCIAS ACRARIAS SATIPO','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'CIENCIAS AGRARIAS SATIPO','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'CIENCIAS DE LA COMUNICACIÓN','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'CIENCIAS FORESTALES Y DEL AMBIENTE','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'CONTABILIDAD','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'ECONOMÍA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'EDUCACIÓN','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'ENFERMERIA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'INDUSTRIAS ALIMENTARIAS','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'INGENIERIA CIVIL','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'INGENIERIA DE MINAS','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'INGENIERIA DE SISTEMAS','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'INGENIERÍA DE METALÚRGICA Y DE MATERIALES','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'INGENIERÍA ELECTRICA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'INGENIERÍA MECÁNICA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'INGENIERÍA QUIMICA','TESTEO.docx.pdf','AC',NULL,NULL,NULL,'2021-12-17 10:10:24',NULL,NULL,NULL,NULL),(24,'INGENIERÍA Y CIENCIAS HUMANAS JUNIN','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'LABORATORIO DE INVESTIGACIÓN','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'MEDICINA ','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'TRABAJO SOCIAL','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'ZOOTECNIA','','AC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(129,'VICERRECTORADO DE INVESTIGACIÓN',NULL,'AC',NULL,'2021-12-20 11:58:03',NULL,'2021-12-20 11:58:03',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_horario` */

DROP TABLE IF EXISTS `tb_horario`;

CREATE TABLE `tb_horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia_semana` varchar(45) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `info_academica_id` int(11) DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_horario_tb_info_academica1_idx` (`info_academica_id`),
  CONSTRAINT `fk_tb_horario_tb_info_academica1` FOREIGN KEY (`info_academica_id`) REFERENCES `tb_info_academica` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tb_horario` */

insert  into `tb_horario`(`id`,`dia_semana`,`hora`,`info_academica_id`,`hora_fin`) values (2,'Martes','08:00:00',2,'12:30:00'),(3,'Lunes','09:22:00',3,'12:24:00'),(4,'Miercoles','14:23:00',3,'15:23:00'),(8,'Martes','11:15:00',1,'12:45:00'),(9,'Lunes','09:00:00',6,'13:00:00');

/*Table structure for table `tb_horario_archivo` */

DROP TABLE IF EXISTS `tb_horario_archivo`;

CREATE TABLE `tb_horario_archivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `archivo` varchar(45) DEFAULT NULL,
  `laboratorio_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`laboratorio_id`),
  CONSTRAINT `fk_lhorario_archivo` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_horario_archivo` */

/*Table structure for table `tb_info_academica` */

DROP TABLE IF EXISTS `tb_info_academica`;

CREATE TABLE `tb_info_academica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laboratoriodet_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `hra_academica` text,
  `calendario_uso` varchar(255) DEFAULT NULL COMMENT 'Archivo',
  `guia_manual` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `asignatura_id` int(11) NOT NULL,
  `status` char(2) DEFAULT 'AC',
  `aforo` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`laboratoriodet_id`),
  KEY `fk_tb_info_academica_tb_persona1_idx` (`docente_id`),
  KEY `fk_tb_info_academica_tb_asignatura1_idx` (`asignatura_id`),
  CONSTRAINT `fk_ltb_info_academica` FOREIGN KEY (`laboratoriodet_id`) REFERENCES `tb_laboratorio_det` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ptb_info_academica` FOREIGN KEY (`docente_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_academica_tb_asignatura1` FOREIGN KEY (`asignatura_id`) REFERENCES `tb_asignatura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tb_info_academica` */

insert  into `tb_info_academica`(`id`,`laboratoriodet_id`,`docente_id`,`hra_academica`,`calendario_uso`,`guia_manual`,`fecha_inicio`,`fecha_fin`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`asignatura_id`,`status`,`aforo`,`periodo_id`) values (1,1,1,'2 HORAS',NULL,NULL,'2021-10-04','2022-01-28','2021-12-16 21:52:09',55,'2021-12-20 10:07:10',1,NULL,NULL,NULL,1,'AC',50,NULL),(2,2,4,NULL,NULL,NULL,'2021-10-05','2022-01-28','2021-12-17 10:23:14',1,'2021-12-17 10:23:14',NULL,NULL,NULL,NULL,1,'AC',NULL,NULL),(3,21,2,'48 horas',NULL,NULL,'2021-08-03','2021-12-31','2021-12-17 12:23:26',1,'2021-12-17 12:23:26',NULL,NULL,NULL,NULL,1,'AC',NULL,NULL),(4,1,8,NULL,NULL,NULL,NULL,NULL,'2021-12-17 12:23:49',24,'2021-12-17 12:23:49',NULL,NULL,NULL,NULL,1,'AC',NULL,NULL),(5,1,8,NULL,NULL,NULL,NULL,NULL,'2021-12-17 12:24:01',24,'2021-12-17 12:24:01',NULL,NULL,NULL,NULL,1,'AC',NULL,NULL),(6,21,11,'2',NULL,'Manual_3moqXk1DCQ1640278803Buiey.pdf','2021-10-01','2022-01-28','2021-12-17 15:18:43',1,'2021-12-23 12:00:03',1,NULL,NULL,NULL,1,'AC',NULL,4);

/*Table structure for table `tb_info_investigacion` */

DROP TABLE IF EXISTS `tb_info_investigacion`;

CREATE TABLE `tb_info_investigacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laboratoriodet_id` int(11) NOT NULL,
  `cod_proyecto` varchar(45) DEFAULT NULL,
  `nom_proyecto` longtext,
  `responsables` varchar(150) DEFAULT NULL,
  `fuente_finan` varchar(150) DEFAULT NULL,
  `resultado_inv` varchar(45) DEFAULT NULL,
  `horario_inv` varchar(45) DEFAULT NULL,
  `centro_inv` varchar(150) DEFAULT NULL,
  `linea_inv` varchar(150) DEFAULT NULL,
  `monto_otorgar` decimal(12,2) DEFAULT NULL,
  `aseg_calidad` varchar(45) DEFAULT NULL COMMENT 'Aseguramiento de calidad archivo',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `solicitante_id` int(11) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`laboratoriodet_id`),
  CONSTRAINT `fk_ltb_info_investigacion` FOREIGN KEY (`laboratoriodet_id`) REFERENCES `tb_laboratorio_det` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_info_investigacion` */

insert  into `tb_info_investigacion`(`id`,`laboratoriodet_id`,`cod_proyecto`,`nom_proyecto`,`responsables`,`fuente_finan`,`resultado_inv`,`horario_inv`,`centro_inv`,`linea_inv`,`monto_otorgar`,`aseg_calidad`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`solicitante_id`,`status`,`periodo_id`) values (1,2,'COD_001','INNOVACION','1. D\r\n2. F\r\n3.','CANON',NULL,NULL,NULL,NULL,50000.00,NULL,'2021-12-16 21:56:25',55,'2021-12-17 10:15:28',1,NULL,NULL,NULL,3,'AC',NULL),(2,2,'COD_001','PROYECTO INNOVACION','1. \r\n2.\r\n3.','CANON',NULL,NULL,NULL,NULL,52000.00,NULL,'2021-12-17 10:24:56',1,'2021-12-17 10:24:56',NULL,NULL,NULL,NULL,4,'AC',NULL),(3,20,'COD_001','NOMBRE DEL PROYECTO','1. INVESTIGADOR\r\n2. IN\r\n3.','CANON',NULL,NULL,NULL,NULL,52000.00,NULL,'2021-12-17 15:26:54',1,'2021-12-17 15:27:45',NULL,'2021-12-17 15:27:45',1,'DUPLICIDAD',10,'EL',NULL);

/*Table structure for table `tb_info_servicio` */

DROP TABLE IF EXISTS `tb_info_servicio`;

CREATE TABLE `tb_info_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laboratoriodet_id` int(11) NOT NULL,
  `solicitante_id` int(11) NOT NULL,
  `representante_id` int(11) DEFAULT NULL,
  `personal_contacto_id` int(11) DEFAULT NULL,
  `producto` varchar(100) DEFAULT NULL,
  `servicio_solicitado` varchar(45) DEFAULT NULL COMMENT '1 Ensayo\n2 Muestreo\n3 Otros',
  `otro_servicio` varchar(45) DEFAULT NULL COMMENT 'Si servicio_solicitado es 3 Otros',
  `marca` varchar(50) DEFAULT NULL,
  `ds_marca` varchar(45) DEFAULT NULL,
  `ie_marca` varchar(45) DEFAULT NULL,
  `presentacion` varchar(100) DEFAULT NULL,
  `cantidad_muestra` decimal(10,2) DEFAULT NULL,
  `cantidad_lote` decimal(10,2) DEFAULT NULL,
  `identificacion` varchar(100) DEFAULT NULL,
  `fecha_produccion` date DEFAULT NULL,
  `ds_fecha_produccion` varchar(45) DEFAULT NULL,
  `ie_fecha_produccion` varchar(45) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `ds_fecha_vencimiento` date DEFAULT NULL,
  `coordenadas` varchar(100) DEFAULT NULL,
  `ubigeo` varchar(10) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `fuente_origen` varchar(100) DEFAULT 'SI',
  `persona_muestreo_id` int(11) DEFAULT NULL,
  `fecha_muestreo` date DEFAULT NULL,
  `hora_muestreo` time DEFAULT NULL,
  `tipo_envase` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `conservacion` varchar(100) DEFAULT NULL,
  `preservacion` varchar(100) DEFAULT NULL,
  `tipo_muestra` varchar(45) DEFAULT NULL COMMENT 'SUELO, ABONO, PLANTA O AGUA',
  `descripcion_servicio` longtext,
  `tipo_comprobante_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `retencion` decimal(10,2) DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `doc_resultado` varchar(45) DEFAULT NULL,
  `responsable_atencion_id` int(11) DEFAULT NULL,
  `observacion_resultado` longtext,
  `status` char(2) DEFAULT 'AC',
  `observacion` longtext,
  `ie_fecha_vencimiento` date DEFAULT NULL,
  `punto_muestreo` varchar(100) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_info_servicio_laboratorio_det1_idx` (`laboratoriodet_id`),
  KEY `fk_tb_info_servicio_tb_persona1_idx` (`solicitante_id`),
  KEY `fk_tb_info_servicio_tb_persona2_idx` (`representante_id`),
  KEY `fk_tb_info_servicio_tb_persona3_idx` (`personal_contacto_id`),
  KEY `fk_tb_info_servicio_tb_persona4_idx` (`persona_muestreo_id`),
  KEY `fk_tb_info_servicio_tb_persona5_idx` (`responsable_atencion_id`),
  CONSTRAINT `fk_tb_info_servicio_laboratorio_det1` FOREIGN KEY (`laboratoriodet_id`) REFERENCES `tb_laboratorio_det` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_servicio_tb_persona1` FOREIGN KEY (`solicitante_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_servicio_tb_persona2` FOREIGN KEY (`representante_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_servicio_tb_persona3` FOREIGN KEY (`personal_contacto_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_servicio_tb_persona4` FOREIGN KEY (`persona_muestreo_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_info_servicio_tb_persona5` FOREIGN KEY (`responsable_atencion_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='																																																																																																																																																																																									';

/*Data for the table `tb_info_servicio` */

insert  into `tb_info_servicio`(`id`,`laboratoriodet_id`,`solicitante_id`,`representante_id`,`personal_contacto_id`,`producto`,`servicio_solicitado`,`otro_servicio`,`marca`,`ds_marca`,`ie_marca`,`presentacion`,`cantidad_muestra`,`cantidad_lote`,`identificacion`,`fecha_produccion`,`ds_fecha_produccion`,`ie_fecha_produccion`,`fecha_vencimiento`,`ds_fecha_vencimiento`,`coordenadas`,`ubigeo`,`lugar`,`fuente_origen`,`persona_muestreo_id`,`fecha_muestreo`,`hora_muestreo`,`tipo_envase`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`conservacion`,`preservacion`,`tipo_muestra`,`descripcion_servicio`,`tipo_comprobante_id`,`precio`,`retencion`,`fecha_entrega`,`hora_entrega`,`doc_resultado`,`responsable_atencion_id`,`observacion_resultado`,`status`,`observacion`,`ie_fecha_vencimiento`,`punto_muestreo`,`periodo_id`) values (1,1,2,2,1,'a',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10605',NULL,NULL,2,NULL,NULL,NULL,'2021-12-17 10:14:55',NULL,'2021-12-17 10:14:55',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'AC',NULL,NULL,NULL,NULL),(2,9,3,3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'CAJAS','AGUA RESIDUAL',13,'2021-12-10','12:00:00','VIDRIO','2021-12-17 15:43:25',NULL,'2021-12-17 15:43:25',NULL,NULL,NULL,NULL,'TEMPERATURA 6 GRADOS',NULL,'AGUA LIQUIDO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,NULL,'AC','COLOCAR LOS PARAMETROS SOLICITADOS',NULL,'CONCEPCION',NULL),(3,1,2,2,2,'dsfdsfsdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'120114',NULL,NULL,2,'2021-12-03','14:51:00',NULL,'2021-12-23 11:52:12',1,'2021-12-23 11:58:49',NULL,'2021-12-23 11:58:49',1,'dsfsd dsfsdf',NULL,NULL,NULL,NULL,2,34324.00,NULL,NULL,NULL,'RESULTADOxJlgQDjfqQ1640278332kHL7l.pdf',2,NULL,'EL',NULL,NULL,NULL,5);

/*Table structure for table `tb_inventario_data` */

DROP TABLE IF EXISTS `tb_inventario_data`;

CREATE TABLE `tb_inventario_data` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(250) DEFAULT NULL,
  `RUC_ENTIDAD` varchar(250) DEFAULT NULL,
  `NOMBRE_LOCAL` varchar(250) DEFAULT NULL,
  `DEPARTAMENTO` varchar(250) DEFAULT NULL,
  `PROVINCIA` varchar(250) DEFAULT NULL,
  `DISTRITO` varchar(250) DEFAULT NULL,
  `NOMBRE_AREA` varchar(250) DEFAULT NULL,
  `NOMBRE_OFICINA` varchar(250) DEFAULT NULL,
  `TIPO_DOC_IDENTIDAD` varchar(250) DEFAULT NULL,
  `NRO_DOC_IDENT_PERSONAL` varchar(250) DEFAULT NULL,
  `APELLIDO_PATERNO` varchar(250) DEFAULT NULL,
  `APELLIDO_MATERNO` varchar(250) DEFAULT NULL,
  `NOMBRES` varchar(250) DEFAULT NULL,
  `CODIGO_PATRIMONIAL` varchar(250) DEFAULT NULL,
  `DENOMINACION_BIEN` varchar(250) DEFAULT NULL,
  `NRO_DOC_ADQUISICION` varchar(250) DEFAULT NULL,
  `FECHA_ADQUISICION` varchar(250) DEFAULT NULL,
  `bien_valor_adquisicion` varchar(250) DEFAULT NULL,
  `FECHA_DEPRECIACION` varchar(250) DEFAULT NULL,
  `VALOR_NETO` varchar(250) DEFAULT NULL,
  `ESTADO_BIEN` varchar(250) DEFAULT NULL,
  `MARCA` varchar(250) DEFAULT NULL,
  `MODELO` varchar(250) DEFAULT NULL,
  `TIPO` varchar(250) DEFAULT NULL,
  `COLOR` varchar(250) DEFAULT NULL,
  `SERIE` varchar(250) DEFAULT NULL,
  `ANIO_FABRICACION` varchar(250) DEFAULT NULL,
  `OTRAS_CARACT` varchar(250) DEFAULT NULL,
  `CAUSAL_BAJA` varchar(250) DEFAULT NULL,
  `NRO_RESOLUCION_BAJA` varchar(250) DEFAULT NULL,
  `FECHA_BAJA` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tb_inventario_data` */

/*Table structure for table `tb_labo` */

DROP TABLE IF EXISTS `tb_labo`;

CREATE TABLE `tb_labo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sunedu` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `laboratorio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencia` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facultad` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `aforo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tb_labo` */

insert  into `tb_labo`(`id`,`sunedu`,`laboratorio`,`referencia`,`usuario`,`clave`,`facultad`,`aforo`) values (2,'SL01LA01','CENTRO DE CÓMPUTO','PABELLÓN “I” 2DO PISO CIUDAD UNIVERSITARIA','SL01LA01','SL01LA01','ADMINISTRACIÓN DE EMPRESAS',22),(3,'SL01LA02','CENTRO DE CÓMPUTO','PABELLÓN \"E\" 3ER PISO - CIUDAD UNIVERSITARIA','SL01LA02','SL01LA02','ANTROPOLOGÍA',22),(4,'SL01LA03','CENTRO DE CÓMPUTO','PABELLÓN \"F\" 304 CIUDAD UNIVERSITARIA','SL01LA03','SL01LA03','ARQUITECTURA',36),(5,'SL01LA04','LABORATORIO DE HERBARIO Y DENDROCRONOLOGÍA','PABELLÓN \"A\" AULA 207 CIUDAD UNIVERSITARIA','SL01LA04','SL01LA04','CIENCIAS FORESTALES Y DEL AMBIENTE',12),(6,'SL01LA05','LABORATORIO DE BIODIVERSIDAD Y MANEJO FORESTAL','PABELLÓN \"A\" AULA 309 CIUDAD UNIVERSITARIA','SL01LA05','SL01LA05','CIENCIAS FORESTALES Y DEL AMBIENTE',11),(7,'SL01LA06','LABORATORIO DE TECNOLOGÍA DE LA MADERA E INDUSTRIAS FORESTALES','PABELLÓN \"A\" AULA 311 CIUDAD UNIVERSITARIA','SL01LA06','SL01LA06','CIENCIAS FORESTALES Y DEL AMBIENTE',11),(8,'SL01LA07','CENTRO DE CÓMPUTO','PABELLÓN “I” 3° PISO\nCIUDAD UNIVERSITARIA','SL01LA07','SL01LA07','CONTABILIDAD',41),(9,'SL01LA08','CENTRO DE CÓMPUTO','PABELLÓN “I” AULA 307 4° PISO CIUDAD UNIVERSITARIA\n','SL01LA08','SL01LA08','ECONOMÍA',62),(10,'SL01LA09','LABORATORIO DE BIOLOGÍA','PABELLÓN \"C\" AULAS 309 - 310 CIUDAD UNIVERSITARIA','SL01LA09','SL01LA09','EDUCACIÓN',23),(11,'SL01LA10','CENTRO DE CÓMPUTO','PABELLÓN \"B\" AULA 207 CIUDAD UNIVERSITARIA','SL01LA10','SL01LA10','EDUCACIÓN',23),(12,'SL01LA11','LABORATORIO MATERNO INFANTIL Y SALUD DE LA MUJER','PABELLÓN \"G\" 1° PISO CIUDAD UNIVERSITARIA','SL01LA11','SL01LA11','ENFERMERIA',7),(13,'SL01LA12','LABORATORIO DE ANATOMIA','PABELLÓN \"G\"  1° PISO  CIUDAD UNIVERSITARIA','SL01LA12','SL01LA12','ENFERMERIA',5),(14,'SL01LA13','LABORATORIO DE PEDIATRIA Y NEONATOLOGÍA','PABELLÓN \"G\"  2° PISO CIUDAD UNIVERSITARIA','SL01LA13','SL01LA13','ENFERMERIA',6),(15,'SL01LA14','LABORATORIO EN EL CUIDADO DEL ADULTO I','PABELLÓN \"G\" 2° PISO CIUDAD UNIVERSITARIA','SL01LA14','SL01LA14','ENFERMERIA',5),(16,'SL01LA15','LABORATORIO EN EL CUIDADO DEL ADULTO II','PABELLÓN \"G\"  3° PISO CIUDAD UNIVERSITARIA','SL01LA15','SL01LA15','ENFERMERIA',6),(17,'SL01LA16','LABORATORIO EN EL CUIDADO DEL ADULTO III (Emergencia y Cuidados Críticos)','PABELLÓN \"G\" 3° PISO CIUDAD UNIVERSITARIA','SL01LA16','SL01LA16','ENFERMERIA',5),(18,'SL01LA17','CENTRO DE CÓMPUTO','PABELLÓN \"F\" AULA 101 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA17','SL01LA17','INGENIERIA CIVIL',33),(19,'SL01LA18','LABORATORIO DE MECÁNICA DE SUELOS Y DE MATERIALES - CONCRETO - ASFALTO Y PAVIMENTOS','PABELLÓN \"F\" AULA 105 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA18','SL01LA18','INGENIERIA CIVIL',13),(20,'SL01LA19',' INFORMÁTICA APLICADA (CENTRO DE CÓMPUTO)','PABELLÓN \"E\" AULA 102 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA19','SL01LA19','INGENIERIA DE MINAS',35),(21,'SL01LA20','LABORATORIO DE MINERALOGÍA Y PETROLOGIA','PABELLÓN \"E\" AULA 104 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA20','SL01LA20','INGENIERIA DE MINAS',12),(22,'SL01LA21','LABORATORIO DE MECÁNICA DE ROCAS','PABELLÓN \"E\" AULA 105 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA21','SL01LA21','INGENIERIA DE MINAS',12),(23,'SL01LA22','LABORATORIO DE TOPOGRAFÍA','PABELLÓN \"E\" AULA 110 -1ER PISO CIUDAD UNIVERSITARIA','SL01LA22','SL01LA22','INGENIERIA DE MINAS',10),(24,'SL01LA23','LABORATORIO DE COMPUTO Nº 1','BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA','SL01LA23','SL01LA23','INGENIERIA DE SISTEMAS',23),(25,'SL01LA24','LABORATORIO DE COMPUTO Nº 2','BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA','SL01LA24','SL01LA24','INGENIERIA DE SISTEMAS',25),(26,'SL01LA25','LABORATORIO DE COMPUTO Nº 3','BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA','SL01LA25','SL01LA25','INGENIERIA DE SISTEMAS',19),(27,'SL01LA26','LABORATORIO DE MEDICIONES  ELECTRICAS ','PABELLÓN \"C\" SOTANO CIUDAD UNIVERSITARIA ','SL01LA26','SL01LA26','INGENIERÍA ELECTRICA',12),(28,'SL01LA27','LABORATORIO DE  CÓMPUTO','PABELLÓN \"C\" 1er PISO CIUDAD UNIVERSITARIA','SL01LA27','SL01LA27','INGENIERÍA ELECTRICA',25),(29,'SL01LA28','LABORATORIO DE MÁQUINAS ELÉCTRICAS','PABELLÓN DE LABORATORIOS DE INGENIERIA  1° PISO - CIUDAD UNIVERSITARIA ','SL01LA28','SL01LA28','INGENIERÍA ELECTRICA',18),(30,'SL01LA29','LABORATORIO DE ELECTRICIDAD Y ELECTRONICA','PABELLÓN DE LABORATORIOS DE INGENIERIA 2° PISO - CIUDAD UNIVERSITARIA ','SL01LA29','SL01LA29','INGENIERÍA ELECTRICA',12),(31,'SL01LA30','LABORATORIO DE QUÍMICA DE ALIMENTOS','PABELLÓN \"E\"  2DO PISO AULA 203 CIUDAD UNIVERSITARIA','SL01LA30','SL01LA30','INDUSTRIAS ALIMENTARIAS',7),(32,'SL01LA31','LABORATORIO DE TECNOLOGÍA DE ALIMENTOS I','PABELLÓN \"E\" AULA 202 CIUDAD UNIVERSITARIA','SL01LA31','SL01LA31','INDUSTRIAS ALIMENTARIAS',11),(33,'SL01LA32','LABORATORIO DE TECNOLOGÍA DE ALIMENTOS II','PABELLÓN \"E\" 2DO PISO CIUDAD UNIVERSITARIA','SL01LA32','SL01LA32','INDUSTRIAS ALIMENTARIAS',14),(34,'SL01LA33','LABORATORIO DE CONTROL DE CALIDAD','PABELLÓN \"E\" AULA 205 CIUDAD UNIVERSITARIA','SL01LA33','SL01LA33','INDUSTRIAS ALIMENTARIAS',11),(35,'SL01LA34','LABORATORIO DE MICROBIOLOGÍA DE ALIMENTOS','PABELLÓN \"E\" AULA 209 CIUDAD UNIVERSITARIA','SL01LA34','SL01LA34','INDUSTRIAS ALIMENTARIAS',9),(36,'SL01LA35','LABORATORIO DE ANÁLISIS INSTRUMENTAL DE ALIMENTOS','PABELLÓN \"E\" AULA 210 CIUDAD UNIVERSITARIA ','SL01LA35','SL01LA35','INDUSTRIAS ALIMENTARIAS',10),(37,'SL01LA36','LABORATORIO DE INGENIERÍA DE ALIMENTOS','PABELLÓN \"E\" 207 2DO PISO CIUDAD UNIVERSITARIA','SL01LA36','SL01LA36','INDUSTRIAS ALIMENTARIAS',11),(38,'SL01LA37','LABORATORIO DE PROCESOS Y MATERIALES','PABELLÓN DE LABORATORIOS DE INGENIERIA 2° PISO - CIUDAD UNIVERSITARIA','SL01LA37','SL01LA37','INGENIERÍA MECÁNICA',5),(39,'SL01LA38','LABORATORIO DE NEUMÁTICA Y OLEOHIDRAULICA','A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA','SL01LA38','SL01LA38','INGENIERÍA MECÁNICA',12),(40,'SL01LA39','LABORATORIO DE MAQUINAS TERMICAS','A ESPALDAS  DEL PABELLÓN \"B\"  CIUDAD UNIVERSITARIA','SL01LA39','SL01LA39','INGENIERÍA MECÁNICA',13),(41,'SL01LA40','LABORATORIO DE METROLOGÍA','A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA','SL01LA40','SL01LA40','INGENIERÍA MECÁNICA',8),(42,'SL01LA41','CENTRO DE COMPUTO','PABELLÓN \"B\" 2DO PISO - CIUDAD UNIVERSITARIA','SL01LA41','SL01LA41','INGENIERÍA MECÁNICA',30),(43,'SL01LA42','CENTRO DE CÓMPUTO','PABELLÓN \"E\" AULA 204 CIUDAD UNIVERSITARIA','SL01LA42','SL01LA42','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',22),(44,'SL01LA43','UNIDAD DE INVESTIGACIÓN Y EXPERIMENTACIÓN EN SÓLIDOS','A ESPALDAS DEL PABELLÓN \"C\"  AULA 119 CIUDAD UNIVERSITARIA ','SL01LA43','SL01LA43','INGENIERÍA QUIMICA',13),(45,'SL01LA44','OPERACIONES Y PROCESOS UNITARIOS','A ESPALDAS DEL PABELLÓN \"C\" AULA 120 CIUDAD UNIVERSITARIA','SL01LA44','SL01LA44','INGENIERÍA QUIMICA',24),(46,'SL01LA45','TECNOLOGÍA','PABELLÓN \"C\" AULA 107 CIUDAD UNIVERSITARIA','SL01LA45','SL01LA45','INGENIERÍA QUIMICA',24),(47,'SL01LA46','QUÍMICA ORGÁNICA','PABELLÓN \"C\" AULA 110 CIUDAD UNIVERSITARIA','SL01LA46','SL01LA46','INGENIERÍA QUIMICA',24),(48,'SL01LA47','QUÍMICA GENERAL, INORGÁNICA Y ELECTROQUÍMICA','PABELLÓN \"C\" AULA 115 CIUDAD UNIVERSITARIA','SL01LA47','SL01LA47','INGENIERÍA QUIMICA',24),(49,'SL01LA48','FISICOQUÍMICA','PABELLÓN \"C\" AULA 118 CIUDAD UNIVERSITARIA','SL01LA48','SL01LA48','INGENIERÍA QUIMICA',24),(50,'SL01LA49','ANÁLISIS INSTRUMENTAL','PABELLÓN \"C\" AULA 210 CIUDAD UNIVERSITARIA ','SL01LA49','SL01LA49','INGENIERÍA QUIMICA',24),(51,'SL01LA50','QUÍMICA ANALÍTICA','PABELLÓN \"C\" AULA 216 CIUDAD UNIVERSITARIA','SL01LA50','SL01LA50','INGENIERÍA QUIMICA',25),(52,'SL01LA51','CENTRO DE COMPUTO','PABELLÓN \"C\" AULA 218 CIUDAD UNIVERSITARIA','SL01LA51','SL01LA51','INGENIERÍA QUIMICA',36),(53,'SL01LA52','BIOPROCESOS','A ESPALDAS  DEL PABELLON  \"B\" AULA 131 CIUDAD UNIVERSITARIA ','SL01LA52','SL01LA52','INGENIERÍA QUIMICA',12),(54,'SL01LA53','LABORATORIO DE ANFITEATRO DE ANATOMÍA HUMANA','PABELLÓN \"G\" 1ER PISO AULA 104 - CIUDAD UNIVERSITARIA','SL01LA53','SL01LA53','MEDICINA ',27),(55,'SL01LA54','LABORATORIO DE NEUROANATOMÍA','PABELLÓN \"G\" 1ER PISO  AULA 105 - CIUDAD UNIVERSITARIA','SL01LA54','SL01LA54','MEDICINA ',6),(56,'SL01LA55','LABORATORIO DE HISTOLOGÍA','PABELLÓN \"G\" 2DO PISO  AULA 205 - CIUDAD UNIVERSITARIA','SL01LA55','SL01LA55','MEDICINA ',12),(57,'SL01LA56','LABORATORIO DE MICROBIOLOGÍA Y PARASITOLOGÍA','PABELLÓN \"G\" 3ER PISO  AULA 305 - CIUDAD UNIVERSITARIA','SL01LA56','SL01LA56','MEDICINA ',15),(58,'SL01LA57','CENTRO DE COMPUTO','PABELLÓN \"G\" 2DO PISO  AULA 203 -  CIUDAD UNIVERSITARIA','SL01LA57','SL01LA57','MEDICINA ',23),(59,'SL01LA58','LABORATORIO DE INVESTIGACIÓN DE AGUAS','PABELLÓN \"C\" 3ER PISO CIUDAD UNIVERSITARIA','SL01LA58','SL01LA58','LABORATORIO DE INVESTIGACIÓN',21),(60,'SL01LA59','LABORATORIO DE SANIDAD ANIMAL','PABELLÓN \"C\" 3ER PISO CIUDAD UNIVERSITARIA','SL01LA59','SL01LA59','ZOOTECNIA',23),(61,'SL01LA60','CENTRO DE COMPUTO','PABELLÓN \"A\" 2DO PISO AULA 206 - CIUDAD UNIVERSITARIA','SL01LA60','SL01LA60','ZOOTECNIA',21),(62,'SL01LA61','LABORATORIO DE MICROBIOLOGÍA','PABELLÓN \"C\" AULA 219 CIUDAD UNIVERSITARIA','SL01LA61','SL01LA61','ZOOTECNIA',21),(63,'SL01LA62','PROCESAMIENTO DE MINERALES','PABELLÓN DE LABORATORIOS DE INGENIERIA 3° PISO - CIUDAD UNIVERSITARIA','SL01LA62','SL01LA62','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',15),(64,'SL01LA63','LABORATORIO DE TOPOGRAFÍA','PABELLÓN \"F\"  1° PISO -CIUDAD UNIVERSITARIA\n','SL01LA63','SL01LA63','INGENIERIA CIVIL',3),(65,'SL01LA64','CENTRO DE CÓMPUTO','PABELLÓN \"A\" 2° PISO -CIUDAD UNIVERSITARIA','SL01LA64','SL01LA64','TRABAJO SOCIAL',13),(66,'SL03LA01','METALOGRAFÍA Y TRATAMIENTOS TÉRMICOS ','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA ','SL03LA01','SL03LA01','INGENIERÍA DE METALÚRGICA Y DE MATERIALES ',8),(67,'SL03LA02','LABORATORIO METALÚRGICO DEL ORO Y LA PLATA','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03LA02','SL03LA02','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',9),(68,'SL03LA03','QUÍMICA CUANTITATIVA','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03LA03','SL03LA03','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',10),(69,'SL03LA04','QUÍMICA CUALITATIVA Y ORGÁNICA','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03LA04','SL03LA04','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',10),(70,'SL03LA05','QUIMICA GENERAL E INORGÁNICA','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03LA05','SL03LA05','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',10),(71,'F01L01LA01','CENTRO DE COMPUTO','PABELLÓN “I”  AULA 301 ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA01','F01L01LA01','AGRONOMÍA',39),(72,'F01L01LA02','LABORATORIO DE ANÁLISIS DE SUELOS, AGUAS Y PLANTAS','PABELLÓN “I”  PRIMER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA02','F01L01LA02','AGRONOMÍA',10),(73,'F01L01LA03','LABORATORIO DE MICROBIOLOGÍA DE SUELOS I','PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA03','F01L01LA03','AGRONOMÍA',8),(74,'F01L01LA04','LABORATORIO DE BIOLOGÍA MOLECULAR Y GENÉTICA','PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA04','F01L01LA04','AGRONOMÍA',8),(75,'F01L01LA05','LABORATORIO DE BIOQUÍMICA','PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA05','F01L01LA05','AGRONOMÍA',8),(76,'F01L01LA06','LABORATORIO DE ENTOMOLOGÍA','PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA06','F01L01LA06','AGRONOMÍA',5),(77,'F01L01LA07','LABORATORIO DE ANÁLISIS DE SEMILLAS','PABELLÓN “I” 4TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA07','F01L01LA07','AGRONOMÍA',5),(78,'F01L01LA08','LABORATORIO DE CULTIVO DE TEJIDOS VEGETALES I','PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA08','F01L01LA08','AGRONOMÍA',15),(79,'F01L01LA09','QUÍMICA GENERAL Y ORGÁNICA','PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA09','F01L01LA09','AGRONOMÍA',9),(80,'F01L01LA10','DIAGNISTICO MOLECULAR -SANIDAD VEGETAL','A ESPALDAS DEL PABELLÓN “I”  ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA10','F01L01LA10','AGRONOMÍA',10),(81,'F01L01LA11','LABORATORIO DE MICROBIOLOGÍA DE SUELOS II','PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA11','F01L01LA11','AGRONOMÍA',8),(82,'F01L01LA12','LABORATORIO DE MICROBIOLOGÍA DE SUELOS III','PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA12','F01L01LA12','AGRONOMÍA',8),(83,'F01L01LA13','LABORATORIO DE CULTIVO DE TEJIDOS VEGETALES II','PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01LA13','F01L01LA13','AGRONOMÍA',10),(84,'F01L02LA01','LABORATORIO DE FITOPATOLOGÍA','PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-3°PISO ','F01L02LA01','F01L02LA01','AGRONOMÍA',12),(85,'F01L02LA02','BOTÁNICA Y FISIOLOGÍA VEGETAL','PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-3°PISO ','F01L02LA02','F01L02LA02','AGRONOMÍA',12),(86,'F01L02LA03','LABORATORIO DE INVESTIGACIÓN I DE INDUSTRIAS ALIMENTARIAS','PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO ','F01L02LA03','F01L02LA03','INDUSTRIAS ALIMENTARIAS',15),(87,'F01L02LA04','LABORATORIO DE NUTRICIÓN ANIMAL','PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-1ER PISO AMBIENTE N°4','F01L02LA04','F01L02LA04','ZOOTECNIA',15),(88,'F01L02LA05','LABORATORIO DE INVESTIGACIÓN II DE INDUSTRIAS ALIMENTARIAS','PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO ','F01L02LA05','F01L02LA05','INDUSTRIAS ALIMENTARIAS',15),(89,'F01L02LA06','LABORATORIO DE INVESTIGACIÓN III DE INDUSTRIAS ALIMENTARIAS','PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO ','F01L02LA06','F01L02LA06','INDUSTRIAS ALIMENTARIAS',15),(90,'F02L01LA01','CENTRO DE CÓMPUTO','PABELLÓN \"B\" 3ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA01','F02L01LA01','CIENCAS APLICADAS TARMA',50),(91,'F02L01LA02','LABORATORIO DE LÁCTEOS Y FRUTAS','PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA02','F02L01LA02','CIENCAS APLICADAS TARMA',14),(92,'F02L01LA03','LABORATORIO DE PANIFICACIÓN','PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA ','F02L01LA03','F02L01LA03','CIENCAS APLICADAS TARMA',9),(93,'F02L01LA04','LABORATORIO DE CEREALES','PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA ','F02L01LA04','F02L01LA04','CIENCAS APLICADAS TARMA',8),(94,'F02L01LA05','LABORATORIO DE MICROBIOLOGÍA Y BIOLOGÍA','PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA05','F02L01LA05','CIENCAS APLICADAS TARMA',8),(95,'F02L01LA06','LABORATORIO DE INSTRUMENTACIÓN','PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA06','F02L01LA06','CIENCAS APLICADAS TARMA',9),(96,'F02L01LA07','LABORATORIO DE QUÍMICA Y MEDIO AMBIENTE','PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA HAY ','F02L01LA07','F02L01LA07','CIENCAS APLICADAS TARMA',10),(97,'F02L01LA08','ÁREA DE ALIMENTOS Y BEBIDAS - COCINA','PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA08','F02L01LA08','CIENCAS APLICADAS TARMA',17),(98,'F02L01LA09','ÁREA DE ALIMENTOS Y BEBIDAS - RESTAURANTE - BAR','PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA09','F02L01LA09','CIENCAS APLICADAS TARMA',18),(99,'F02L01LA10','ÁREA MULTIFUNCIONAL','PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA10','F02L01LA10','CIENCAS APLICADAS TARMA',110),(100,'F02L01LA11','ÁREA - HOTEL','PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA','F02L01LA11','F02L01LA11','CIENCAS APLICADAS TARMA',22),(101,'F03L01LA01','LABORATORIO DE ANÁLISIS DE SUELOS, AGUAS Y PLANTAS','PABELLÓN \"C\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO','F03L01LA01','F03L01LA01','CIENCAS AGRARIAS SATIPO',10),(102,'F03L01LA02','LABORATORIO DE ESTACION AGROMETEREOLOGICA','PENTAGONITO PABELLÓN \"A\" 1ER PISO  CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO ','F03L01LA02','F03L01LA02','CIENCIAS ACRARIAS SATIPO',5),(103,'F03L01LA03','LABORATORIO DE BROMATOLOGÍA','PABELLÓN ADMINISTRATIVO 2DO PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO','F03L01LA03','F03L01LA03','CIENCIAS ACRARIAS SATIPO',5),(104,'F03L01LA04','LABORATORIO DE HERVARIOS Y ANÁLISIS DE LA MADERA','PENTAGONITO PABELLÓN \"A\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO ','F03L01LA04','F03L01LA04','CIENCIAS ACRARIAS SATIPO',9),(105,'F03L01LA05','PROPAGACIÓN DE PLANTAS','PABELLÓN \"C\" ADMINISTRATIVO 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO','F03L01LA05','F03L01LA05','CIENCIAS ACRARIAS SATIPO',8),(106,'F03L01LA06','TECNOLOGÍA DE ALIMENTOS Y CONTROL DE CALIDAD','PABELLÓN \"D\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO','F03L01LA06','F03L01LA06','CIENCIAS ACRARIAS SATIPO',6),(107,'F04L01LA01','BIOLOGIA Y QUIMICA','PABELLÓN \"B\" 202\n1ER PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN','F04L01LA01','F04L01LA01','INGENIERÍA Y CIENCIAS HUMANAS JUNIN',28),(108,'F04L01LA02','CENTRO DE CÓMPUTO','PABELLÓN \"A\" 207 - 208\nSEGUNDO PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN','F04L01LA02','F04L01LA02','INGENIERÍA Y CIENCIAS HUMANAS JUNIN',33),(109,'SL01TA01','TALLER DE TV','PABELLÓN \"A\" 3ER PISO CIUDAD UNIVERSITARIA','SL01TA01','SL01TA01','CIENCIAS DE LA COMUNICACIÓN',14),(110,'SL01TA02','TALLER DE RADIO','PABELLÓN \"A\" 3ER PISO CIUDAD UNIVERSITARIA','SL01TA02','SL01TA02','CIENCIAS DE LA COMUNICACIÓN',15),(111,'SL01TA03','TALLER DE MULTIMEDIOS','PABELLÓN \"A\" 2DO PISO CIUDAD UNIVERSITARIA','SL01TA03','SL01TA03','CIENCIAS DE LA COMUNICACIÓN',27),(112,'SL01TA04','TALLER DE MAQUINAS Y HERRAMIENTAS','A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA','SL01TA04','SL01TA04','INGENIERIA MECANICA',22),(113,'SL01TA05','TALLER AUTOMOTRIZ','PABELLÓN DE LABORATORIOS DE INGENIERIA - CIUDAD UNIVERSITARIA','SL01TA05','SL01TA05','INGENIERÍA MECÁNICA',23),(114,'SL01TA06','TALLER DE DISEÑO ','PABELLÓN \"F\" AULA 203-CIUDAD UNIVERSITRARIA','SL01TA06','SL01TA06','ARQUITECTURA',46),(115,'SL01TA07','TALLER DE DISEÑO ','PABELLÓN \"F\" AULA 204-CIUDAD UNIVERSITRARIA','SL01TA07','SL01TA07','ARQUITECTURA',36),(116,'SL01TA08','TALLER DE DISEÑO','PABELLÓN \"F\" AULA 206-CIUDAD UNIVERSITRARIA','SL01TA08','SL01TA08','ARQUITECTURA',33),(117,'SL01TA09','TALLER DE DISEÑO','PABELLÓN \"F\" AULA 207-CIUDAD UNIVERSITRARIA','SL01TA09','SL01TA09','ARQUITECTURA',40),(118,'SL01TA10','TALLER DE DISEÑO ','PABELLÓN \"F\" AULA 302-CIUDAD UNIVERSITRARIA','SL01TA10','SL01TA10','ARQUITECTURA',18),(119,'SL01TA11','TALLER DE DISEÑO','PABELLÓN \"F\" AULA 303-CIUDAD UNIVERSITRARIA','SL01TA11','SL01TA11','ARQUITECTURA',23),(120,'SL01TA12','TALLER DE DISEÑO','PABELLÓN \"F\" AULA 305-CIUDAD UNIVERSITRARIA','SL01TA12','SL01TA12','ARQUITECTURA',33),(121,'SL01TA13','TALLER DE DISEÑO','PABELLÓN \"F\" AULA 306-CIUDAD UNIVERSITRARIA','SL01TA13','SL01TA13','ARQUITECTURA',33),(122,'SL03TA01',' FUNDICIÓN','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03TA01','SL03TA01','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',22),(123,'SL03TA02','SOLDADURA','PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA','SL03TA02','SL03TA02','INGENIERÍA DE METALÚRGICA Y DE MATERIALES',23),(124,'F01L02TA01','TALLER DE MECANIZACIÓN AGRÍCOLA','PABELLÓN “I”  ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L02TA01','F01L02TA01','AGRONOMÍA',20),(125,'F01L01TA01','GABINETE TOPOGRAFIA','PABELLÓN “I” 5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO','F01L01TA01','F01L01TA01','AGRONOMÍA',7),(126,'F03L01TA01','CENTRO DE ENSEÑANZA APRENDIZAJE DE FRUTAS, PANIFICACIÓN Y LÁCTEOS','PABELLÓN \"A\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO','F03L01TA01','F03L01TA01','CIENCIAS AGRARIAS SATIPO',11),(127,'F04L01TA01','TALLER DE PROCESOS AGROINDUSTRIALES ','PABELLÓN \"B\" 203\nPRIMER PISO  FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN','F04L01TA01','F04L01TA01','INGENIERÍA Y CIENCIAS HUMANAS JUNIN',28),(128,'F04L01TA02','TALLER DE PANADERIA ','PABELLÓN \"B\" 104\nPRIMER PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN','F04L01TA02','F04L01TA02','INGENIERÍA Y CIENCIAS HUMANAS JUNIN',41);

/*Table structure for table `tb_laboratorio` */

DROP TABLE IF EXISTS `tb_laboratorio`;

CREATE TABLE `tb_laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_sunedu` varchar(45) DEFAULT NULL,
  `nombre_lab` varchar(100) DEFAULT NULL,
  `decripcion_lab` longtext,
  `num_aula` varchar(45) DEFAULT NULL,
  `piso` varchar(45) DEFAULT NULL,
  `pabellon` varchar(45) DEFAULT NULL,
  `horario_atencion` varchar(45) DEFAULT NULL,
  `aforo` varchar(45) DEFAULT NULL,
  `area_total` varchar(45) DEFAULT NULL,
  `area_libre` varchar(45) DEFAULT NULL,
  `area_ocupada` varchar(45) DEFAULT NULL,
  `foto_laboratorio` varchar(250) DEFAULT NULL,
  `organigrama` varchar(250) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  `facultad_id` int(11) NOT NULL,
  `resolucion_creacion` varchar(250) DEFAULT NULL,
  `flg_internet` tinyint(1) DEFAULT '0',
  `flg_tacho_peligroso` tinyint(1) DEFAULT '0',
  `flg_tacho_biocont` tinyint(1) DEFAULT '0',
  `flg_recipiente_rl` tinyint(1) DEFAULT '0',
  `tipo_almacen_id` int(11) DEFAULT NULL COMMENT '0 Ninguno\n1 Almacen de espacio individual\n2 Almacen compartido con laboratorio',
  `categoria_lab` int(11) DEFAULT NULL COMMENT '1 Almacen General\n2 Almacen Laboratorio\n3 Laboratorios',
  `created_at` datetime DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `tipos_de_ensenanza` longtext,
  `observaciones_lab` longtext,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`facultad_id`),
  KEY `fk_tb_laboratorio_tb_tipo_almacen1_idx` (`tipo_almacen_id`),
  CONSTRAINT `fk_atb_laboratorio` FOREIGN KEY (`tipo_almacen_id`) REFERENCES `tb_tipo_almacen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ftb_laboratorio` FOREIGN KEY (`facultad_id`) REFERENCES `tb_facultad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8 COMMENT='Información General';

/*Data for the table `tb_laboratorio` */

insert  into `tb_laboratorio`(`id`,`cod_sunedu`,`nombre_lab`,`decripcion_lab`,`num_aula`,`piso`,`pabellon`,`horario_atencion`,`aforo`,`area_total`,`area_libre`,`area_ocupada`,`foto_laboratorio`,`organigrama`,`status`,`facultad_id`,`resolucion_creacion`,`flg_internet`,`flg_tacho_peligroso`,`flg_tacho_biocont`,`flg_recipiente_rl`,`tipo_almacen_id`,`categoria_lab`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`ubicacion`,`tipos_de_ensenanza`,`observaciones_lab`) values (1,'4456','ALMACEN GENERAL',NULL,'405','PRIMER PISO','PABELLON  \"B\"',NULL,'60','45 M2','22 M2','65 M2',NULL,NULL,'AC',1,NULL,1,1,1,1,0,NULL,NULL,NULL,'2021-12-17 11:57:42',1,NULL,NULL,NULL,NULL,NULL,NULL),(2,'SL01LA01','Laboratorio de Informática',NULL,NULL,'SEGUNDO PISO','PABELLON  \"I\"',NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',2,NULL,1,1,1,0,0,3,NULL,NULL,'2021-12-17 12:21:51',4,NULL,NULL,NULL,'PABELLÓN “I” 2DO PISO CIUDAD UNIVERSITARIA',NULL,NULL),(3,'SL01LA02','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',4,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" 3ER PISO - CIUDAD UNIVERSITARIA',NULL,NULL),(4,'SL01LA03','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'36',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" 304 CIUDAD UNIVERSITARIA',NULL,NULL),(5,'SL01LA04','LABORATORIO DE HERBARIO Y DENDROCRONOLOGÍA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',11,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" AULA 207 CIUDAD UNIVERSITARIA',NULL,NULL),(6,'SL01LA05','LABORATORIO DE BIODIVERSIDAD Y MANEJO FORESTAL',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',11,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" AULA 309 CIUDAD UNIVERSITARIA',NULL,NULL),(7,'SL01LA06','LABORATORIO DE TECNOLOGÍA DE LA MADERA E INDUSTRIAS FORESTALES',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',11,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" AULA 311 CIUDAD UNIVERSITARIA',NULL,NULL),(8,'SL01LA07','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'41',NULL,NULL,NULL,NULL,NULL,'AC',12,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 3° PISO\nCIUDAD UNIVERSITARIA',NULL,NULL),(9,'SL01LA08','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'62',NULL,NULL,NULL,NULL,NULL,'AC',13,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” AULA 307 4° PISO CIUDAD UNIVERSITARIA\n',NULL,NULL),(10,'SL01LA09','LABORATORIO DE BIOLOGÍA',NULL,'309 - 310','TERCERO','C',NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',14,NULL,0,0,0,0,0,3,NULL,NULL,'2021-12-17 12:33:28',12,NULL,NULL,NULL,'PABELLÓN \"C\" AULAS 309 - 310 CIUDAD UNIVERSITARIA','ENSEÑANZA-APRENDIZAJE DE LAS ASIGNATURAS DE BIOLOGÍA',NULL),(11,'SL01LA10','CENTRO DE CÓMPUTO',NULL,'213','2','B',NULL,'28',NULL,NULL,NULL,NULL,NULL,'AC',14,NULL,1,0,0,0,0,3,NULL,NULL,'2021-12-17 12:15:45',13,NULL,NULL,NULL,'PABELLÓN \"B\" AULA 213 CIUDAD UNIVERSITARIA',NULL,NULL),(12,'SL01LA11','LABORATORIO MATERNO INFANTIL Y SALUD DE LA MUJER',NULL,NULL,NULL,NULL,NULL,'7',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 1° PISO CIUDAD UNIVERSITARIA',NULL,NULL),(13,'SL01LA12','LABORATORIO DE ANATOMIA',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\"  1° PISO  CIUDAD UNIVERSITARIA',NULL,NULL),(14,'SL01LA13','LABORATORIO DE PEDIATRIA Y NEONATOLOGÍA','Laboratorio de Neonatologia se encuentra el recién Nacido con la servo cuna para realizar los cuidados inmediatos así mismo se encuentra el simulador de BB y niño  para simular lel cuidado  de l paciente con diferentes patologías','205','Segundo piso','G',NULL,'6',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,'2021-12-17 15:46:41',16,NULL,NULL,NULL,'PABELLÓN \"G\"  2° PISO CIUDAD UNIVERSITARIA',NULL,NULL),(15,'SL01LA14','LABORATORIO EN EL CUIDADO DEL ADULTO I',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 2° PISO CIUDAD UNIVERSITARIA',NULL,NULL),(16,'SL01LA15','LABORATORIO EN EL CUIDADO DEL ADULTO II',NULL,NULL,NULL,NULL,NULL,'6',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\"  3° PISO CIUDAD UNIVERSITARIA',NULL,NULL),(17,'SL01LA16','LABORATORIO EN EL CUIDADO DEL ADULTO III (Emergencia y Cuidados Críticos)',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',15,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 3° PISO CIUDAD UNIVERSITARIA',NULL,NULL),(18,'SL01LA17','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,'AC',17,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 101 -1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(19,'SL01LA18','LABORATORIO DE MECÁNICA DE SUELOS Y DE MATERIALES - CONCRETO - ASFALTO Y PAVIMENTOS',NULL,NULL,NULL,NULL,NULL,'13',NULL,NULL,NULL,NULL,NULL,'AC',17,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 105 -1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(20,'SL01LA19',' INFORMÁTICA APLICADA (CENTRO DE CÓMPUTO)',NULL,NULL,NULL,NULL,NULL,'35',NULL,NULL,NULL,NULL,NULL,'AC',18,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 102 -1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(21,'SL01LA20','LABORATORIO DE MINERALOGÍA Y PETROLOGIA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',18,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 104 -1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(22,'SL01LA21','LABORATORIO DE MECÁNICA DE ROCAS','Laboratorio de enseñanza-aprendizaje con fines académicos, abocado a ensayos en rocas (esfuerzo y deformación)','105','1er','E',NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',18,NULL,1,0,0,0,0,3,NULL,NULL,'2021-12-17 11:58:01',24,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 105 -1ER PISO CIUDAD UNIVERSITARIA','Esfuerzos de compresión: Uniaxial y triaxial\r\nDeformación: Módulo de Young y coeficiente de Poisson',NULL),(23,'SL01LA22','LABORATORIO DE TOPOGRAFÍA',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',18,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 110 -1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(24,'SL01LA23','LABORATORIO DE COMPUTO Nº 1','Laboratorio para la enseñanza de pregrado','LAB01','1','Biblioteca Central',NULL,'25','10','6','4',NULL,NULL,'AC',19,NULL,1,1,1,0,0,3,NULL,NULL,'2021-12-17 12:00:30',26,NULL,NULL,NULL,'BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA','Se hace uso de software para el análisis de datos, programación, diseño, inteligencia artificial.',NULL),(25,'SL01LA24','LABORATORIO DE COMPUTO Nº 2',NULL,NULL,NULL,NULL,NULL,'25',NULL,NULL,NULL,NULL,NULL,'AC',19,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(26,'SL01LA25','LABORATORIO DE COMPUTO Nº 3',NULL,'LAB03','1','BIBLIOTECA',NULL,'19',NULL,NULL,NULL,NULL,NULL,'AC',19,NULL,0,0,0,0,0,3,NULL,NULL,'2021-12-17 11:56:22',28,NULL,NULL,NULL,'BIBLIOTECA CENTRAL 1ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(27,'SL01LA26','LABORATORIO DE MEDICIONES  ELECTRICAS ',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',21,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" SOTANO CIUDAD UNIVERSITARIA ',NULL,NULL),(28,'SL01LA27','LABORATORIO DE  CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'25',NULL,NULL,NULL,NULL,NULL,'AC',21,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" 1er PISO CIUDAD UNIVERSITARIA',NULL,NULL),(29,'SL01LA28','LABORATORIO DE MÁQUINAS ELÉCTRICAS',NULL,NULL,NULL,NULL,NULL,'18',NULL,NULL,NULL,NULL,NULL,'AC',21,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INGENIERIA  1° PISO - CIUDAD UNIVERSITARIA ',NULL,NULL),(30,'SL01LA29','LABORATORIO DE ELECTRICIDAD Y ELECTRONICA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',21,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INGENIERIA 2° PISO - CIUDAD UNIVERSITARIA ',NULL,NULL),(31,'SL01LA30','LABORATORIO DE QUÍMICA DE ALIMENTOS',NULL,NULL,NULL,NULL,NULL,'7',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\"  2DO PISO AULA 203 CIUDAD UNIVERSITARIA',NULL,NULL),(32,'SL01LA31','LABORATORIO DE TECNOLOGÍA DE ALIMENTOS I',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 202 CIUDAD UNIVERSITARIA',NULL,NULL),(33,'SL01LA32','LABORATORIO DE TECNOLOGÍA DE ALIMENTOS II',NULL,NULL,NULL,NULL,NULL,'14',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" 2DO PISO CIUDAD UNIVERSITARIA',NULL,NULL),(34,'SL01LA33','LABORATORIO DE CONTROL DE CALIDAD',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 205 CIUDAD UNIVERSITARIA',NULL,NULL),(35,'SL01LA34','LABORATORIO DE MICROBIOLOGÍA DE ALIMENTOS',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 209 CIUDAD UNIVERSITARIA',NULL,NULL),(36,'SL01LA35','LABORATORIO DE ANÁLISIS INSTRUMENTAL DE ALIMENTOS',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 210 CIUDAD UNIVERSITARIA ',NULL,NULL),(37,'SL01LA36','LABORATORIO DE INGENIERÍA DE ALIMENTOS',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" 207 2DO PISO CIUDAD UNIVERSITARIA',NULL,NULL),(38,'SL01LA37','LABORATORIO DE PROCESOS Y MATERIALES',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INGENIERIA 2° PISO - CIUDAD UNIVERSITARIA',NULL,NULL),(39,'SL01LA38','LABORATORIO DE NEUMÁTICA Y OLEOHIDRAULICA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA',NULL,NULL),(40,'SL01LA39','LABORATORIO DE MAQUINAS TERMICAS',NULL,NULL,NULL,NULL,NULL,'13',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS  DEL PABELLÓN \"B\"  CIUDAD UNIVERSITARIA',NULL,NULL),(41,'SL01LA40','LABORATORIO DE METROLOGÍA',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA',NULL,NULL),(42,'SL01LA41','CENTRO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,'30',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 2DO PISO - CIUDAD UNIVERSITARIA',NULL,NULL),(43,'SL01LA42','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"E\" AULA 204 CIUDAD UNIVERSITARIA',NULL,NULL),(44,'SL01LA43','UNIDAD DE INVESTIGACIÓN Y EXPERIMENTACIÓN EN SÓLIDOS',NULL,NULL,NULL,NULL,NULL,'13',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS DEL PABELLÓN \"C\"  AULA 119 CIUDAD UNIVERSITARIA ',NULL,NULL),(45,'SL01LA44','OPERACIONES Y PROCESOS UNITARIOS',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS DEL PABELLÓN \"C\" AULA 120 CIUDAD UNIVERSITARIA',NULL,NULL),(46,'SL01LA45','TECNOLOGÍA',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 107 CIUDAD UNIVERSITARIA',NULL,NULL),(47,'SL01LA46','QUÍMICA ORGÁNICA',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 110 CIUDAD UNIVERSITARIA',NULL,NULL),(48,'SL01LA47','QUÍMICA GENERAL, INORGÁNICA Y ELECTROQUÍMICA',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 115 CIUDAD UNIVERSITARIA',NULL,NULL),(49,'SL01LA48','FISICOQUÍMICA',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 118 CIUDAD UNIVERSITARIA',NULL,NULL),(50,'SL01LA49','ANÁLISIS INSTRUMENTAL',NULL,NULL,NULL,NULL,NULL,'24',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 210 CIUDAD UNIVERSITARIA ',NULL,NULL),(51,'SL01LA50','QUÍMICA ANALÍTICA',NULL,NULL,NULL,NULL,NULL,'25',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 216 CIUDAD UNIVERSITARIA',NULL,NULL),(52,'SL01LA51','CENTRO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,'36',NULL,NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 218 CIUDAD UNIVERSITARIA',NULL,NULL),(53,'SL01LA52','BIOPROCESOS','En este laboratorio se desarrollan las practicas de la asignatura de ingeniería de bioprocesos de las carreras profesionales de Ingeniería Química e Ingeniería Química Ambiental','131','PRIMER PISO','PABELLON  \"B\"',NULL,'12',NULL,NULL,NULL,'FOTOS LABORATORIO.pdf',NULL,'AC',23,NULL,1,1,1,0,0,3,NULL,NULL,'2021-12-16 21:12:14',55,NULL,NULL,NULL,'A ESPALDAS  DEL PABELLON  \"B\" AULA 131 CIUDAD UNIVERSITARIA',NULL,NULL),(54,'SL01LA53','LABORATORIO DE ANFITEATRO DE ANATOMÍA HUMANA',NULL,NULL,NULL,NULL,NULL,'27',NULL,NULL,NULL,NULL,NULL,'AC',26,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 1ER PISO AULA 104 - CIUDAD UNIVERSITARIA',NULL,NULL),(55,'SL01LA54','LABORATORIO DE NEUROANATOMÍA',NULL,NULL,NULL,NULL,NULL,'6',NULL,NULL,NULL,NULL,NULL,'AC',26,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 1ER PISO  AULA 105 - CIUDAD UNIVERSITARIA',NULL,NULL),(56,'SL01LA55','LABORATORIO DE HISTOLOGÍA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',26,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 2DO PISO  AULA 205 - CIUDAD UNIVERSITARIA',NULL,NULL),(57,'SL01LA56','LABORATORIO DE MICROBIOLOGÍA Y PARASITOLOGÍA',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',26,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 3ER PISO  AULA 305 - CIUDAD UNIVERSITARIA',NULL,NULL),(58,'SL01LA57','CENTRO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,'23',NULL,NULL,NULL,NULL,NULL,'AC',26,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"G\" 2DO PISO  AULA 203 -  CIUDAD UNIVERSITARIA',NULL,NULL),(59,'SL01LA58','LABORATORIO DE INVESTIGACIÓN DE AGUAS','DEPENDENCIA DE VICERRECTORADO DE INVESTIGACIÓN',NULL,'3ER','C',NULL,'21','174',NULL,'174',NULL,NULL,'AC',1,NULL,1,1,1,1,0,3,NULL,NULL,'2021-12-17 15:04:26',61,NULL,NULL,NULL,'CIUDAD UNIVERSITARIA','ENSAYOS FISICOQUÍMICOS Y MICROBIOLÓGICOS DE AGUAS','LABORATORIO DE INVESTIGACIÓN Y SERVICIOS'),(60,'SL01LA59','LABORATORIO DE SANIDAD ANIMAL',NULL,NULL,NULL,NULL,NULL,'23',NULL,NULL,NULL,NULL,NULL,'AC',28,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" 3ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(61,'SL01LA60','CENTRO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,'21',NULL,NULL,NULL,NULL,NULL,'AC',28,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 2DO PISO AULA 206 - CIUDAD UNIVERSITARIA',NULL,NULL),(62,'SL01LA61','LABORATORIO DE MICROBIOLOGÍA',NULL,NULL,NULL,NULL,NULL,'21',NULL,NULL,NULL,NULL,NULL,'AC',28,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" AULA 219 CIUDAD UNIVERSITARIA',NULL,NULL),(63,'SL01LA62','PROCESAMIENTO DE MINERALES',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INGENIERIA 3° PISO - CIUDAD UNIVERSITARIA',NULL,NULL),(64,'SL01LA63','LABORATORIO DE TOPOGRAFÍA',NULL,NULL,NULL,NULL,NULL,'3',NULL,NULL,NULL,NULL,NULL,'AC',17,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\"  1° PISO -CIUDAD UNIVERSITARIA\n',NULL,NULL),(65,'SL01LA64','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'13',NULL,NULL,NULL,NULL,NULL,'AC',27,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 2° PISO -CIUDAD UNIVERSITARIA',NULL,NULL),(66,'SL03LA01','METALOGRAFÍA Y TRATAMIENTOS TÉRMICOS ',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA ',NULL,NULL),(67,'SL03LA02','LABORATORIO METALÚRGICO DEL ORO Y LA PLATA',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(68,'SL03LA03','QUÍMICA CUANTITATIVA',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(69,'SL03LA04','QUÍMICA CUALITATIVA Y ORGÁNICA',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(70,'SL03LA05','QUIMICA GENERAL E INORGÁNICA',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(71,'F01L01LA01','CENTRO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,'39',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  AULA 301 ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(72,'F01L01LA02','LABORATORIO DE ANÁLISIS DE SUELOS, AGUAS Y PLANTAS',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  PRIMER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(73,'F01L01LA03','LABORATORIO DE MICROBIOLOGÍA DE SUELOS I',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(74,'F01L01LA04','LABORATORIO DE BIOLOGÍA MOLECULAR Y GENÉTICA',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(75,'F01L01LA05','LABORATORIO DE BIOQUÍMICA',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(76,'F01L01LA06','LABORATORIO DE ENTOMOLOGÍA',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(77,'F01L01LA07','LABORATORIO DE ANÁLISIS DE SEMILLAS',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 4TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(78,'F01L01LA08','LABORATORIO DE CULTIVO DE TEJIDOS VEGETALES I',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(79,'F01L01LA09','QUÍMICA GENERAL Y ORGÁNICA',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 3ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(80,'F01L01LA10','DIAGNISTICO MOLECULAR -SANIDAD VEGETAL',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS DEL PABELLÓN “I”  ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(81,'F01L01LA11','LABORATORIO DE MICROBIOLOGÍA DE SUELOS II',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(82,'F01L01LA12','LABORATORIO DE MICROBIOLOGÍA DE SUELOS III',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”   2DO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(83,'F01L01LA13','LABORATORIO DE CULTIVO DE TEJIDOS VEGETALES II',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(84,'F01L02LA01','LABORATORIO DE FITOPATOLOGÍA',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-3°PISO ',NULL,NULL),(85,'F01L02LA02','BOTÁNICA Y FISIOLOGÍA VEGETAL',NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-3°PISO ',NULL,NULL),(86,'F01L02LA03','LABORATORIO DE INVESTIGACIÓN I DE INDUSTRIAS ALIMENTARIAS','Laboratorio para la investigación ubicada el la estación Mantaro','01','1','i',NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,'2021-12-17 12:09:21',88,NULL,NULL,NULL,'PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(87,'F01L02LA04','LABORATORIO DE NUTRICIÓN ANIMAL',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',28,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INVESTIGACIÓN EEAEM-1ER PISO AMBIENTE N°4',NULL,NULL),(88,'F01L02LA05','LABORATORIO DE INVESTIGACIÓN II DE INDUSTRIAS ALIMENTARIAS',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO ',NULL,NULL),(89,'F01L02LA06','LABORATORIO DE INVESTIGACIÓN III DE INDUSTRIAS ALIMENTARIAS',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',16,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 1ER PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO ',NULL,NULL),(90,'F02L01LA01','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'50',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 3ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(91,'F02L01LA02','LABORATORIO DE LÁCTEOS Y FRUTAS',NULL,NULL,NULL,NULL,NULL,'14',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(92,'F02L01LA03','LABORATORIO DE PANIFICACIÓN',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA ',NULL,NULL),(93,'F02L01LA04','LABORATORIO DE CEREALES',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 1ER PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA ',NULL,NULL),(94,'F02L01LA05','LABORATORIO DE MICROBIOLOGÍA Y BIOLOGÍA',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(95,'F02L01LA06','LABORATORIO DE INSTRUMENTACIÓN',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(96,'F02L01LA07','LABORATORIO DE QUÍMICA Y MEDIO AMBIENTE',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 2DO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA HA',NULL,NULL),(97,'F02L01LA08','ÁREA DE ALIMENTOS Y BEBIDAS - COCINA',NULL,NULL,NULL,NULL,NULL,'17',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(98,'F02L01LA09','ÁREA DE ALIMENTOS Y BEBIDAS - RESTAURANTE - BAR',NULL,NULL,NULL,NULL,NULL,'18',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(99,'F02L01LA10','ÁREA MULTIFUNCIONAL',NULL,NULL,NULL,NULL,NULL,'110',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(100,'F02L01LA11','ÁREA - HOTEL',NULL,NULL,NULL,NULL,NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',7,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 4TO PISO CARRETERA CENTRAL KM 4.5, POMACHACA, FACULTAD DE CIENCIAS APLICADAS - TARMA',NULL,NULL),(101,'F03L01LA01','LABORATORIO DE ANÁLISIS DE SUELOS, AGUAS Y PLANTAS',NULL,NULL,NULL,NULL,NULL,'10',NULL,NULL,NULL,NULL,NULL,'AC',6,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO',NULL,NULL),(102,'F03L01LA02','LABORATORIO DE ESTACION AGROMETEREOLOGICA',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',8,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PENTAGONITO PABELLÓN \"A\" 1ER PISO  CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARI',NULL,NULL),(103,'F03L01LA03','LABORATORIO DE BROMATOLOGÍA',NULL,NULL,NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,'AC',8,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN ADMINISTRATIVO 2DO PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS',NULL,NULL),(104,'F03L01LA04','LABORATORIO DE HERVARIOS Y ANÁLISIS DE LA MADERA',NULL,NULL,NULL,NULL,NULL,'9',NULL,NULL,NULL,NULL,NULL,'AC',8,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PENTAGONITO PABELLÓN \"A\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIA',NULL,NULL),(105,'F03L01LA05','PROPAGACIÓN DE PLANTAS',NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,NULL,NULL,'AC',8,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"C\" ADMINISTRATIVO 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRA',NULL,NULL),(106,'F03L01LA06','TECNOLOGÍA DE ALIMENTOS Y CONTROL DE CALIDAD',NULL,NULL,NULL,NULL,NULL,'6',NULL,NULL,NULL,NULL,NULL,'AC',8,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"D\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO',NULL,NULL),(107,'F04L01LA01','BIOLOGIA Y QUIMICA',NULL,NULL,NULL,NULL,NULL,'28',NULL,NULL,NULL,NULL,NULL,'AC',24,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 202\n1ER PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN',NULL,NULL),(108,'F04L01LA02','CENTRO DE CÓMPUTO',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,'AC',24,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 207 - 208\nSEGUNDO PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN',NULL,NULL),(109,'SL01TA01','TALLER DE TV',NULL,NULL,NULL,NULL,NULL,'14',NULL,NULL,NULL,NULL,NULL,'AC',10,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 3ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(110,'SL01TA02','TALLER DE RADIO',NULL,NULL,NULL,NULL,NULL,'15',NULL,NULL,NULL,NULL,NULL,'AC',10,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 3ER PISO CIUDAD UNIVERSITARIA',NULL,NULL),(111,'SL01TA03','TALLER DE MULTIMEDIOS',NULL,NULL,NULL,NULL,NULL,'27',NULL,NULL,NULL,NULL,NULL,'AC',10,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 2DO PISO CIUDAD UNIVERSITARIA',NULL,NULL),(112,'SL01TA04','TALLER DE MAQUINAS Y HERRAMIENTAS',NULL,NULL,NULL,NULL,NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A ESPALDAS  DEL PABELLÓN \"C\"  CIUDAD UNIVERSITARIA',NULL,NULL),(113,'SL01TA05','TALLER AUTOMOTRIZ',NULL,NULL,NULL,NULL,NULL,'23',NULL,NULL,NULL,NULL,NULL,'AC',22,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN DE LABORATORIOS DE INGENIERIA - CIUDAD UNIVERSITARIA',NULL,NULL),(114,'SL01TA06','TALLER DE DISEÑO ',NULL,NULL,NULL,NULL,NULL,'46',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 203-CIUDAD UNIVERSITRARIA',NULL,NULL),(115,'SL01TA07','TALLER DE DISEÑO ',NULL,NULL,NULL,NULL,NULL,'36',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 204-CIUDAD UNIVERSITRARIA',NULL,NULL),(116,'SL01TA08','TALLER DE DISEÑO',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 206-CIUDAD UNIVERSITRARIA',NULL,NULL),(117,'SL01TA09','TALLER DE DISEÑO',NULL,NULL,NULL,NULL,NULL,'40',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 207-CIUDAD UNIVERSITRARIA',NULL,NULL),(118,'SL01TA10','TALLER DE DISEÑO ',NULL,NULL,NULL,NULL,NULL,'18',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 302-CIUDAD UNIVERSITRARIA',NULL,NULL),(119,'SL01TA11','TALLER DE DISEÑO',NULL,NULL,NULL,NULL,NULL,'23',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 303-CIUDAD UNIVERSITRARIA',NULL,NULL),(120,'SL01TA12','TALLER DE DISEÑO',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 305-CIUDAD UNIVERSITRARIA',NULL,NULL),(121,'SL01TA13','TALLER DE DISEÑO',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,'AC',5,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"F\" AULA 306-CIUDAD UNIVERSITRARIA',NULL,NULL),(122,'SL03TA01',' FUNDICIÓN',NULL,NULL,NULL,NULL,NULL,'22',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(123,'SL03TA02','SOLDADURA',NULL,NULL,NULL,NULL,NULL,'23',NULL,NULL,NULL,NULL,NULL,'AC',20,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PLANTA PILOTO METALURGICA DE YAURIS-PIO PATA',NULL,NULL),(124,'F01L02TA01','TALLER DE MECANIZACIÓN AGRÍCOLA',NULL,NULL,NULL,NULL,NULL,'20',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I”  ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(125,'F01L01TA01','GABINETE TOPOGRAFIA',NULL,NULL,NULL,NULL,NULL,'7',NULL,NULL,NULL,NULL,NULL,'AC',3,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN “I” 5TO PISO ESTACION EXPERIMENTAL AGROPECUARIA - EL MANTARO',NULL,NULL),(126,'F03L01TA01','CENTRO DE ENSEÑANZA APRENDIZAJE DE FRUTAS, PANIFICACIÓN Y LÁCTEOS',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,'AC',9,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"A\" 1ER PISO CARRETERA MARGINAL KM 4.5, RÍO NEGRO, FACULTAD DE CIENCIAS AGRARIAS - SATIPO',NULL,NULL),(127,'F04L01TA01','TALLER DE PROCESOS AGROINDUSTRIALES ',NULL,NULL,NULL,NULL,NULL,'28',NULL,NULL,NULL,NULL,NULL,'AC',24,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 203\nPRIMER PISO  FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN',NULL,NULL),(128,'F04L01TA02','TALLER DE PANADERIA ',NULL,NULL,NULL,NULL,NULL,'41',NULL,NULL,NULL,NULL,NULL,'AC',24,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PABELLÓN \"B\" 104\nPRIMER PISO FACULTAD DE INGENIERIA Y CIENCIAS HUMANAS - JUNIN',NULL,NULL),(129,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'AC',1,NULL,0,0,0,0,0,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(257,'0001','LABORATORIO DE QUIMICA AMBIENTAL','.','131','1','C',NULL,'10','100','.','.',NULL,NULL,'AC',23,NULL,0,0,0,0,NULL,2,'2021-12-20 12:38:05',NULL,'2021-12-20 12:38:05',NULL,NULL,NULL,NULL,'PAB C','.',NULL),(258,'0','ALMACEN ABC',NULL,'0','0','0',NULL,'0','0',NULL,NULL,NULL,NULL,'AC',23,NULL,0,0,0,0,NULL,2,'2021-12-21 10:14:51',NULL,'2021-12-21 10:14:51',NULL,NULL,NULL,NULL,'.',NULL,NULL);

/*Table structure for table `tb_laboratorio_det` */

DROP TABLE IF EXISTS `tb_laboratorio_det`;

CREATE TABLE `tb_laboratorio_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laboratorio_id` int(11) NOT NULL,
  `tipolaboratorio_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`tipolaboratorio_id`),
  KEY `fk_idx1` (`laboratorio_id`),
  CONSTRAINT `fk_ltb_laboratorio_det` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tltb_laboratorio_det` FOREIGN KEY (`tipolaboratorio_id`) REFERENCES `tb_tipo_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `tb_laboratorio_det` */

insert  into `tb_laboratorio_det`(`id`,`laboratorio_id`,`tipolaboratorio_id`,`created_at`,`id_usuarioreg`,`updated_at`) values (1,53,1,'2021-12-16 21:14:54',55,'2021-12-16 21:14:54'),(2,53,3,'2021-12-16 21:15:00',55,'2021-12-16 21:15:00'),(3,53,2,'2021-12-16 21:57:19',55,'2021-12-16 21:57:19'),(4,103,1,'2021-12-17 10:00:54',105,'2021-12-17 10:00:54'),(5,30,1,'2021-12-17 10:04:49',32,'2021-12-17 10:04:49'),(6,101,1,'2021-12-17 10:11:01',103,'2021-12-17 10:11:01'),(7,101,3,'2021-12-17 10:11:02',103,'2021-12-17 10:11:02'),(9,84,1,'2021-12-17 10:18:43',86,'2021-12-17 10:18:43'),(10,84,3,'2021-12-17 10:18:59',86,'2021-12-17 10:18:59'),(11,103,5,'2021-12-17 10:25:39',105,'2021-12-17 10:25:39'),(12,103,2,'2021-12-17 10:25:39',105,'2021-12-17 10:25:39'),(13,103,3,'2021-12-17 10:25:40',105,'2021-12-17 10:25:40'),(14,103,4,'2021-12-17 10:25:41',105,'2021-12-17 10:25:41'),(15,103,6,'2021-12-17 10:25:46',105,'2021-12-17 10:25:46'),(17,24,4,'2021-12-17 12:09:40',26,'2021-12-17 12:09:40'),(18,24,1,'2021-12-17 12:09:42',26,'2021-12-17 12:09:42'),(19,86,3,'2021-12-17 12:10:06',88,'2021-12-17 12:10:06'),(20,86,1,'2021-12-17 12:10:21',88,'2021-12-17 12:10:21'),(21,51,1,'2021-12-17 12:10:21',1,'2021-12-17 12:10:21'),(23,22,1,'2021-12-17 12:10:27',24,'2021-12-17 12:10:27'),(26,51,3,'2021-12-17 12:11:44',1,'2021-12-17 12:11:44'),(27,51,2,'2021-12-17 12:11:51',1,'2021-12-17 12:11:51'),(28,11,1,'2021-12-17 12:21:17',13,'2021-12-17 12:21:17'),(29,10,1,'2021-12-17 12:27:16',12,'2021-12-17 12:27:16'),(30,50,2,'2021-12-17 15:04:42',52,'2021-12-17 15:04:42'),(31,70,1,'2021-12-17 15:06:07',72,'2021-12-17 15:06:07'),(32,59,3,'2021-12-17 15:09:02',61,'2021-12-17 15:09:02'),(33,59,2,'2021-12-17 15:09:03',61,'2021-12-17 15:09:03'),(34,62,1,'2021-12-17 15:09:04',64,'2021-12-17 15:09:04'),(37,69,1,'2021-12-17 15:10:00',71,'2021-12-17 15:10:00'),(38,14,1,'2021-12-17 15:10:54',16,'2021-12-17 15:10:54'),(39,56,1,'2021-12-17 15:16:44',58,'2021-12-17 15:16:44');

/*Table structure for table `tb_lote_equipo` */

DROP TABLE IF EXISTS `tb_lote_equipo`;

CREATE TABLE `tb_lote_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote` varchar(45) DEFAULT NULL,
  `fch_fabricacion` date DEFAULT NULL,
  `fch_vencimiento` date DEFAULT NULL,
  `cantidad_lote` decimal(10,3) DEFAULT NULL,
  `cantidad_lote_min` int(11) DEFAULT NULL,
  `equipo_id` int(11) NOT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `status_lote` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`),
  KEY `fk_tb_lote_equipo_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_lote_equipo_tb_laboratorio1_idx` (`laboratorio_id`),
  CONSTRAINT `fk_tb_lote_equipo_tb_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_lote_equipo_tb_laboratorio1` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tb_lote_equipo` */

insert  into `tb_lote_equipo`(`id`,`lote`,`fch_fabricacion`,`fch_vencimiento`,`cantidad_lote`,`cantidad_lote_min`,`equipo_id`,`laboratorio_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status_lote`) values (1,'1','2021-12-01','2021-12-01',1.000,1,3,1,'2021-12-17 10:20:46',1,'2021-12-17 10:28:19',1,NULL,NULL,NULL,'AC'),(2,NULL,NULL,NULL,250.000,250,5,1,'2021-12-17 10:36:50',1,'2021-12-17 10:36:50',NULL,NULL,NULL,NULL,'AC'),(3,'0005','2021-10-17','2022-02-17',5.000,5,6,1,'2021-12-17 10:39:50',1,'2021-12-17 10:39:50',NULL,NULL,NULL,NULL,'AC'),(4,'1',NULL,NULL,1.000,1,3,51,'2021-12-17 11:20:21',53,'2021-12-17 11:20:21',NULL,NULL,NULL,NULL,'AC'),(5,NULL,NULL,NULL,10.000,10,8,1,'2021-12-17 12:36:04',1,'2021-12-17 12:36:04',NULL,NULL,NULL,NULL,'AC'),(6,'0005',NULL,NULL,9.850,985,9,1,'2021-12-17 12:42:58',1,'2021-12-21 14:34:43',264,NULL,NULL,NULL,'AC'),(7,NULL,NULL,NULL,45.000,45,10,1,'2021-12-17 15:47:14',1,'2021-12-17 15:47:14',NULL,NULL,NULL,NULL,'AC'),(8,NULL,NULL,NULL,10.000,10,11,1,'2021-12-20 12:01:41',1,'2021-12-20 12:01:41',NULL,NULL,NULL,NULL,'AC'),(9,NULL,NULL,NULL,14.000,14,13,258,'2021-12-21 10:51:25',263,'2021-12-21 11:47:05',263,NULL,NULL,NULL,'AC'),(10,'001',NULL,'2022-12-16',1.000,2500,15,258,'2021-12-21 11:06:08',263,'2021-12-21 11:06:08',NULL,NULL,NULL,NULL,'AC'),(11,'002',NULL,'2021-12-14',2.000,1000,16,1,'2021-12-21 11:16:04',1,'2021-12-21 11:30:20',264,NULL,NULL,NULL,'AC'),(12,'0012',NULL,NULL,5.000,12500,15,1,'2021-12-21 11:28:09',264,'2021-12-21 11:28:09',NULL,NULL,NULL,NULL,'AC'),(13,'002',NULL,'2021-12-14',0.800,400,16,258,'2021-12-21 11:31:20',263,'2021-12-21 11:44:43',263,NULL,NULL,NULL,'AC'),(14,'002',NULL,'2021-12-14',0.200,100,16,258,'2021-12-21 11:44:43',263,'2021-12-21 11:44:43',NULL,NULL,NULL,NULL,'AC'),(15,NULL,NULL,NULL,0.000,0,13,51,'2021-12-21 11:47:05',263,'2021-12-21 11:48:21',263,NULL,NULL,NULL,'AC'),(16,NULL,NULL,NULL,4.000,4,13,258,'2021-12-21 11:47:30',263,'2021-12-21 11:47:30',NULL,NULL,NULL,NULL,'AC'),(17,NULL,NULL,NULL,1.000,1,13,258,'2021-12-21 11:48:21',263,'2021-12-21 11:48:21',NULL,NULL,NULL,NULL,'AC'),(18,'5',NULL,NULL,4.100,410,9,1,'2021-12-21 14:35:25',264,'2021-12-21 14:35:25',NULL,NULL,NULL,NULL,'AC');

/*Table structure for table `tb_movimiento` */

DROP TABLE IF EXISTS `tb_movimiento`;

CREATE TABLE `tb_movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `lote_equipo_id` int(11) DEFAULT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `tipo_movimiento_id` int(11) NOT NULL,
  `cantidad_movimiento` varchar(45) DEFAULT NULL,
  `cantidad_min_movimiento` varchar(45) DEFAULT NULL,
  `stock_lote` decimal(10,3) DEFAULT NULL,
  `stock_equipo_lab` decimal(10,3) DEFAULT NULL,
  `atencion_id` int(11) DEFAULT NULL,
  `detalle_atencion_id` int(11) DEFAULT NULL,
  `recepcion_id` int(11) DEFAULT NULL,
  `detalle_recepcion_id` int(11) DEFAULT NULL,
  `devolucion_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `detalle_devolucion_id` int(11) DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_movimiento_tb_equipo1_idx` (`equipo_id`),
  KEY `fk_tb_movimiento_tb_laboratorio1_idx` (`laboratorio_id`),
  KEY `fk_tb_movimiento_tb_tipo_movimiento1_idx` (`tipo_movimiento_id`),
  KEY `fk_tb_movimiento_tb_detalle_atencion1_idx` (`detalle_atencion_id`),
  KEY `fk_tb_movimiento_tb_atencion1_idx` (`atencion_id`),
  CONSTRAINT `fk_tb_movimiento_tb_atencion1` FOREIGN KEY (`atencion_id`) REFERENCES `tb_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_movimiento_tb_detalle_atencion1` FOREIGN KEY (`detalle_atencion_id`) REFERENCES `tb_detalle_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_movimiento_tb_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `tb_equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_movimiento_tb_laboratorio1` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_movimiento_tb_tipo_movimiento1` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `tb_tipo_movimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `tb_movimiento` */

insert  into `tb_movimiento`(`id`,`equipo_id`,`lote_equipo_id`,`laboratorio_id`,`tipo_movimiento_id`,`cantidad_movimiento`,`cantidad_min_movimiento`,`stock_lote`,`stock_equipo_lab`,`atencion_id`,`detalle_atencion_id`,`recepcion_id`,`detalle_recepcion_id`,`devolucion_id`,`created_at`,`detalle_devolucion_id`,`id_usuarioreg`,`updated_at`) values (1,3,1,1,1,'1','1',1.000,1.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 10:20:46',NULL,1,'2021-12-17 10:20:46'),(2,3,1,1,2,'1.000','1',1.000,1.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 10:24:20',NULL,1,'2021-12-17 10:24:20'),(3,3,1,1,2,'1.000','1',1.000,1.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 10:28:19',NULL,1,'2021-12-17 10:28:19'),(4,5,2,1,1,'250','250',250.000,250.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 10:36:50',NULL,1,'2021-12-17 10:36:50'),(5,6,3,1,1,'5','5',5.000,5.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 10:39:50',NULL,1,'2021-12-17 10:39:50'),(6,3,4,51,1,'1','1',1.000,1.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 11:20:21',NULL,53,'2021-12-17 11:20:21'),(7,8,5,1,1,'10','10',10.000,10.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 12:36:04',NULL,1,'2021-12-17 12:36:04'),(8,9,6,1,1,'10','1000',10.000,10.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 12:42:58',NULL,1,'2021-12-17 12:42:58'),(9,10,7,1,1,'45','45',45.000,45.000,NULL,NULL,NULL,NULL,NULL,'2021-12-17 15:47:14',NULL,1,'2021-12-17 15:47:14'),(10,11,8,1,1,'10','10',10.000,10.000,NULL,NULL,NULL,NULL,NULL,'2021-12-20 12:01:41',NULL,1,'2021-12-20 12:01:41'),(11,13,9,258,1,'19','19',19.000,19.000,NULL,NULL,NULL,NULL,NULL,'2021-12-21 10:51:25',NULL,263,'2021-12-21 10:51:25'),(12,15,10,258,1,'1','2500',1.000,1.000,NULL,NULL,NULL,NULL,NULL,'2021-12-21 11:06:08',NULL,263,'2021-12-21 11:06:08'),(13,16,11,1,1,'3','1500',3.000,3.000,NULL,NULL,NULL,NULL,NULL,'2021-12-21 11:16:04',NULL,1,'2021-12-21 11:16:04'),(14,15,12,1,1,'5','12500',5.000,5.000,NULL,NULL,NULL,NULL,NULL,'2021-12-21 11:28:09',NULL,264,'2021-12-21 11:28:09'),(15,16,11,1,4,'1','500',2.000,2.000,1,1,NULL,NULL,NULL,'2021-12-21 11:30:20',NULL,264,'2021-12-21 11:30:20'),(16,16,13,258,8,'1.000','500',1.000,2.000,NULL,NULL,1,1,NULL,'2021-12-21 11:31:20',NULL,263,'2021-12-21 11:31:20'),(17,16,14,258,4,'0.200','100',0.200,1.000,2,2,NULL,NULL,NULL,'2021-12-21 11:44:43',NULL,263,'2021-12-21 11:44:43'),(18,13,15,258,4,'5.000','5',5.000,14.000,3,3,NULL,NULL,NULL,'2021-12-21 11:47:05',NULL,263,'2021-12-21 11:47:05'),(19,13,16,258,9,'4','4',4.000,22.000,NULL,NULL,NULL,NULL,1,'2021-12-21 11:47:30',1,263,'2021-12-21 11:47:30'),(20,13,17,258,9,'1','1',1.000,20.000,NULL,NULL,NULL,NULL,2,'2021-12-21 11:48:21',2,263,'2021-12-21 11:48:21'),(21,9,6,1,4,'0.15','15',9.850,9.850,4,4,NULL,NULL,NULL,'2021-12-21 14:34:43',NULL,264,'2021-12-21 14:34:43'),(22,9,18,1,3,'4.1','410',4.100,18.050,NULL,NULL,2,2,NULL,'2021-12-21 14:35:25',NULL,264,'2021-12-21 14:35:25');

/*Table structure for table `tb_periodo` */

DROP TABLE IF EXISTS `tb_periodo`;

CREATE TABLE `tb_periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_periodo` */

insert  into `tb_periodo`(`id`,`periodo`) values (4,'2021-I'),(5,'2021-II');

/*Table structure for table `tb_permiso` */

DROP TABLE IF EXISTS `tb_permiso`;

CREATE TABLE `tb_permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_permiso` varchar(50) DEFAULT NULL,
  `nom_permiso` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_permiso` */

insert  into `tb_permiso`(`id`,`cod_permiso`,`nom_permiso`,`created_at`,`updated_at`,`id_usuarioreg`,`id_usuariomod`) values (1,'admin_todo_laboratorio','Administrar todo laboratorio',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_persona` */

DROP TABLE IF EXISTS `tb_persona`;

CREATE TABLE `tb_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento_id` int(11) NOT NULL,
  `num_doc` varchar(15) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `fch_nacimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_persona_tb_tipo_documento1_idx` (`tipo_documento_id`),
  CONSTRAINT `fk_tdtb_persona` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tb_tipo_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `tb_persona` */

insert  into `tb_persona`(`id`,`tipo_documento_id`,`num_doc`,`nombres`,`apellidos`,`correo`,`celular`,`fch_nacimiento`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,1,'20041676','GLADYS MARITZA','AVILA CARHUALLANQUI',NULL,NULL,NULL,'2021-12-16 21:23:15',NULL,'2021-12-16 21:23:15',NULL,NULL,NULL,NULL),(2,1,'12345678','JOSE EDUARDO','POMALAYA VALDEZ',NULL,NULL,NULL,'2021-12-16 21:26:57',NULL,'2021-12-16 21:26:57',NULL,NULL,NULL,NULL),(3,1,'12345679','FELIX','VILLAVICENCIO RAMON',NULL,NULL,NULL,'2021-12-16 21:27:37',NULL,'2021-12-16 21:27:37',NULL,NULL,NULL,NULL),(4,1,'70922818','EDWIN','MAYON SANCHEZ',NULL,NULL,NULL,'2021-12-17 10:22:18',NULL,'2021-12-17 10:22:18',NULL,NULL,NULL,NULL),(5,1,'20091470','DIONICIA','OROCAJA RUTTY',NULL,NULL,NULL,'2021-12-17 12:20:39',NULL,'2021-12-17 12:20:39',NULL,NULL,NULL,NULL),(7,1,'21341565','MIGUEL','AGUILAR CORONACIÓN',NULL,NULL,NULL,'2021-12-17 12:23:16',NULL,'2021-12-17 12:23:16',NULL,NULL,NULL,NULL),(8,1,'20058878','J,','A.P.',NULL,NULL,NULL,'2021-12-17 12:23:26',NULL,'2021-12-17 12:23:26',NULL,NULL,NULL,NULL),(9,1,'42083812','HEIDI MIREILLE','DE LA CRUZ SOLANO',NULL,NULL,NULL,'2021-12-17 15:15:32',NULL,'2021-12-17 15:15:32',NULL,NULL,NULL,NULL),(10,1,'41597917','WILLIAM','LÓPEZ CHÁVEZ',NULL,NULL,NULL,'2021-12-17 15:15:48',NULL,'2021-12-17 15:15:48',NULL,NULL,NULL,NULL),(11,1,'23450812','JOSE CARLOS','AVILA',NULL,NULL,NULL,'2021-12-17 15:17:13',NULL,'2021-12-17 15:17:13',NULL,NULL,NULL,NULL),(12,1,'20436463','JAIME','SALAS',NULL,NULL,NULL,'2021-12-17 15:32:21',NULL,'2021-12-17 15:32:21',NULL,NULL,NULL,NULL),(13,1,'20041676','PEDRO','PEREZ',NULL,NULL,NULL,'2021-12-17 15:38:06',NULL,'2021-12-17 15:38:06',NULL,NULL,NULL,NULL),(14,1,'20041676','FELIX','PELIX',NULL,NULL,NULL,'2021-12-17 15:40:20',NULL,'2021-12-17 15:40:20',NULL,NULL,NULL,NULL),(15,1,'41657368','ISABEL','INGA QUISPE',NULL,NULL,NULL,'2021-12-21 10:53:28',NULL,'2021-12-21 10:53:28',NULL,NULL,NULL,NULL),(16,1,'12345678','CIRO','ZENTENO CUBA',NULL,NULL,NULL,'2021-12-21 11:18:51',NULL,'2021-12-21 11:18:51',NULL,NULL,NULL,NULL),(17,1,'21354687','STEFANY DEYSE','OLORTICO SOTO',NULL,NULL,NULL,'2021-12-21 11:19:59',NULL,'2021-12-21 11:19:59',NULL,NULL,NULL,NULL),(18,1,'12345678','CIRO','ZENTENO CUBA',NULL,NULL,NULL,'2021-12-21 11:23:39',NULL,'2021-12-21 11:23:39',NULL,NULL,NULL,NULL),(19,1,'23232323','JOSE','GUERREROS',NULL,NULL,NULL,'2021-12-21 11:35:01',NULL,'2021-12-21 11:35:01',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_personal` */

DROP TABLE IF EXISTS `tb_personal`;

CREATE TABLE `tb_personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `tipopersonal_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `fch_ingreso` date DEFAULT NULL,
  `fch_cese` date DEFAULT NULL,
  `hoja_vida` varchar(45) DEFAULT NULL,
  `resolucion` varchar(45) DEFAULT NULL,
  `especialidad` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idx` (`persona_id`),
  KEY `fk_idx1` (`laboratorio_id`),
  KEY `fk_idx2` (`tipopersonal_id`),
  KEY `fk_tb_personal_tb_cargo1_idx` (`cargo_id`),
  CONSTRAINT `fk_ctb_personal` FOREIGN KEY (`cargo_id`) REFERENCES `tb_cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ltb_personal` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ptb_personal` FOREIGN KEY (`persona_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ttb_personal` FOREIGN KEY (`tipopersonal_id`) REFERENCES `tb_tipopersonal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tb_personal` */

insert  into `tb_personal`(`id`,`persona_id`,`laboratorio_id`,`tipopersonal_id`,`cargo_id`,`fch_ingreso`,`fch_cese`,`hoja_vida`,`resolucion`,`especialidad`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status`,`periodo_id`) values (1,1,1,1,1,'2021-04-01','2022-01-28',NULL,NULL,'INGENIERO QUIMICO','2021-12-16 21:36:21',55,'2021-12-16 21:36:21',NULL,NULL,NULL,NULL,'AC',NULL),(2,2,1,1,2,'2021-04-18','2022-01-12',NULL,NULL,'INGENIERO QUIMICO','2021-12-16 21:42:58',55,'2021-12-22 10:28:53',1,NULL,NULL,NULL,'AC',NULL),(3,3,1,1,3,'2021-04-01','2022-01-28',NULL,NULL,'INGENIERO QUIMICO','2021-12-16 21:43:51',55,'2021-12-16 21:43:51',NULL,NULL,NULL,NULL,'AC',NULL),(4,2,27,1,3,'2021-10-31','2022-01-06',NULL,NULL,'INGENIERO QUIMICO','2021-12-17 12:21:18',1,'2021-12-17 12:21:18',NULL,NULL,NULL,NULL,'AC',NULL),(5,5,20,2,1,'2019-02-18',NULL,NULL,NULL,'ING. IND. ALIMENTARIAS','2021-12-17 12:23:21',88,'2021-12-17 12:23:21',NULL,NULL,NULL,NULL,'AC',NULL),(6,4,28,2,3,'2021-12-01','2022-01-28',NULL,'RESOL_YiEGd7lxFo1639772097PTyky.pdf','INGENIERO QUIMICO','2021-12-17 15:14:57',1,'2021-12-17 15:14:57',NULL,NULL,NULL,NULL,'AC',NULL),(7,2,1,1,2,NULL,NULL,NULL,NULL,'dsfdsf','2021-12-23 11:50:30',1,'2021-12-23 11:50:52',1,'2021-12-23 11:50:52',1,'dfdsfd','EL',NULL);

/*Table structure for table `tb_programa` */

DROP TABLE IF EXISTS `tb_programa`;

CREATE TABLE `tb_programa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_programa` varchar(150) DEFAULT NULL,
  `cod_programa` varchar(60) DEFAULT NULL,
  `info_academica_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_programa` */

insert  into `tb_programa`(`id`,`nom_programa`,`cod_programa`,`info_academica_id`) values (4,'aa','aa',5),(3,'ss','ss',5);

/*Table structure for table `tb_programa_academico` */

DROP TABLE IF EXISTS `tb_programa_academico`;

CREATE TABLE `tb_programa_academico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programa_academico` varchar(45) DEFAULT NULL,
  `tb_laboratorio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_programa_academico_tb_laboratorio1_idx` (`tb_laboratorio_id`),
  CONSTRAINT `fk_tb_programa_academico_tb_laboratorio1` FOREIGN KEY (`tb_laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_programa_academico` */

/*Table structure for table `tb_proveedor` */

DROP TABLE IF EXISTS `tb_proveedor`;

CREATE TABLE `tb_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(100) DEFAULT NULL,
  `ruc` char(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cel` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_proveedor` */

insert  into `tb_proveedor`(`id`,`proveedor`,`ruc`,`direccion`,`cel`,`correo`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'SISTEMA EIRL','10709228182',NULL,NULL,NULL,'2021-12-21 10:36:23',263,'2021-12-21 10:36:23',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_recepcion` */

DROP TABLE IF EXISTS `tb_recepcion`;

CREATE TABLE `tb_recepcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atencion_id` int(11) DEFAULT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `resp_recepcion_id` int(11) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL COMMENT 'Fecha Pedido',
  `fecha_recepcion` date DEFAULT NULL,
  `numdoc_sustento` varchar(45) DEFAULT NULL,
  `doc_sustento` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_devolucion_tb_atencion1_idx` (`atencion_id`),
  KEY `fk_tb_recepcion_tb_laboratorio1_idx` (`laboratorio_id`),
  KEY `fk_tb_recepcion_tb_persona1_idx` (`proveedor_id`),
  CONSTRAINT `fk_atb_devolucion0` FOREIGN KEY (`atencion_id`) REFERENCES `tb_atencion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_recepcion_tb_laboratorio1` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_recepcion_tb_persona1` FOREIGN KEY (`proveedor_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_recepcion` */

insert  into `tb_recepcion`(`id`,`atencion_id`,`laboratorio_id`,`proveedor_id`,`resp_recepcion_id`,`fecha_solicitud`,`fecha_recepcion`,`numdoc_sustento`,`doc_sustento`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,1,258,NULL,NULL,NULL,'2021-12-21',NULL,NULL,'2021-12-21 11:31:20',263,'2021-12-21 11:31:20',NULL,NULL,NULL,NULL),(2,NULL,1,1,5,'2021-12-01','2021-12-21','111111','Doc_SustentovIhbmKHVnT1640115325.pdf','2021-12-21 14:35:25',264,'2021-12-21 14:35:25',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_requerimiento` */

DROP TABLE IF EXISTS `tb_requerimiento`;

CREATE TABLE `tb_requerimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `laboratorio_origen_id` int(11) NOT NULL COMMENT 'Almacen de laboratorios',
  `laboratorio_dest_id` int(11) NOT NULL COMMENT 'laboratorio',
  `encargado_lab_dest_id` int(11) DEFAULT NULL,
  `investigacion_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `academico_id` int(11) DEFAULT NULL,
  `solicitante_id` int(11) NOT NULL COMMENT 'Docente, estudiante o investigador',
  `fch_requerimiento` date DEFAULT NULL COMMENT 'Para cuando quiere que se atienda',
  `hora_requerimiento` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `nota_requerimiento` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_atencion_tb_laboratorio1_idx` (`laboratorio_origen_id`),
  KEY `fk_tb_atencion_tb_laboratorio2_idx` (`laboratorio_dest_id`),
  KEY `fk_tb_atencion_tb_persona2_idx` (`solicitante_id`),
  CONSTRAINT `fk_ldtb_requerimiento` FOREIGN KEY (`laboratorio_dest_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lotb_requerimiento` FOREIGN KEY (`laboratorio_origen_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ptb_requerimiento` FOREIGN KEY (`solicitante_id`) REFERENCES `tb_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Para estudiantes o decentes que solicitan';

/*Data for the table `tb_requerimiento` */

insert  into `tb_requerimiento`(`id`,`laboratorio_origen_id`,`laboratorio_dest_id`,`encargado_lab_dest_id`,`investigacion_id`,`servicio_id`,`academico_id`,`solicitante_id`,`fch_requerimiento`,`hora_requerimiento`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`nota_requerimiento`) values (1,51,51,2,NULL,NULL,NULL,1,'2021-12-17','11:25:00','2021-12-17 11:25:02',53,'2021-12-17 11:25:02',NULL,NULL,NULL,NULL,NULL),(2,51,51,2,NULL,NULL,NULL,2,'2021-12-17','11:26:44','2021-12-17 11:26:44',53,'2021-12-17 11:26:44',NULL,NULL,NULL,NULL,NULL),(3,51,51,2,NULL,NULL,NULL,2,'2021-12-17','11:28:11','2021-12-17 11:28:11',53,'2021-12-17 11:28:11',NULL,NULL,NULL,NULL,NULL),(4,51,51,2,NULL,NULL,NULL,2,'2021-12-17','11:29:03','2021-12-17 11:29:03',53,'2021-12-17 11:29:03',NULL,NULL,NULL,NULL,NULL),(5,258,258,15,NULL,NULL,NULL,19,'2021-12-21','11:38:27','2021-12-21 11:38:27',263,'2021-12-21 11:38:27',NULL,NULL,NULL,NULL,NULL),(6,258,51,15,NULL,NULL,NULL,15,'2021-12-21','11:46:43','2021-12-21 11:46:43',263,'2021-12-21 11:46:43',NULL,NULL,NULL,NULL,NULL),(7,1,20,4,NULL,NULL,NULL,4,'2021-12-21','14:40:39','2021-12-21 14:40:39',264,'2021-12-21 14:40:39',NULL,NULL,NULL,NULL,'Prueba 1');

/*Table structure for table `tb_software` */

DROP TABLE IF EXISTS `tb_software`;

CREATE TABLE `tb_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_software` varchar(100) DEFAULT NULL,
  `version` varchar(45) DEFAULT NULL,
  `anio_adquisicion` varchar(4) DEFAULT NULL,
  `compatibilidad_so` varchar(45) DEFAULT NULL,
  `fch_ini_vigencia` date DEFAULT NULL,
  `fch_fin_vigencia` date DEFAULT NULL,
  `cant_maquina` int(11) DEFAULT NULL,
  `personal_capacitado` varchar(100) DEFAULT NULL,
  `carta_garantia` varchar(45) DEFAULT NULL,
  `manual_usuario` varchar(45) DEFAULT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  `status` char(2) DEFAULT 'AC',
  PRIMARY KEY (`id`),
  KEY `fk_tb_software_tb_laboratorio1_idx` (`laboratorio_id`),
  CONSTRAINT `fk_ltb_software` FOREIGN KEY (`laboratorio_id`) REFERENCES `tb_laboratorio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_software` */

insert  into `tb_software`(`id`,`nom_software`,`version`,`anio_adquisicion`,`compatibilidad_so`,`fch_ini_vigencia`,`fch_fin_vigencia`,`cant_maquina`,`personal_capacitado`,`carta_garantia`,`manual_usuario`,`laboratorio_id`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`,`status`) values (1,'Antivirus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2021-12-17 10:25:41',1,'2021-12-17 10:25:41',NULL,NULL,NULL,NULL,'AC'),(2,'matlab','5.0','2019','WINDOWS 10','2021-12-01','2022-02-28',1,'juan carlos',NULL,NULL,1,'2021-12-17 10:43:57',1,'2021-12-17 10:43:57',NULL,NULL,NULL,NULL,'AC');

/*Table structure for table `tb_tipo_almacen` */

DROP TABLE IF EXISTS `tb_tipo_almacen`;

CREATE TABLE `tb_tipo_almacen` (
  `id` int(11) NOT NULL,
  `tipo_almacen` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='0 Ninguno\n1 Almacen de espacio individual\n2 Almacen compartido con laboratorio';

/*Data for the table `tb_tipo_almacen` */

insert  into `tb_tipo_almacen`(`id`,`tipo_almacen`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (0,'Ninguno',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1,'Almacen de espacio individual',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Almacen compartido con laboratorio',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_doc_equipo` */

DROP TABLE IF EXISTS `tb_tipo_doc_equipo`;

CREATE TABLE `tb_tipo_doc_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_doc_equipo` varchar(45) DEFAULT NULL COMMENT '1 Instructivo de uso\n2 Certificado de uso',
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_tipo_doc_equipo` */

insert  into `tb_tipo_doc_equipo`(`id`,`tipo_doc_equipo`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (2,'equipo de computo','2021-12-15 12:23:52',1,'2021-12-15 12:23:52',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_doc_especifico` */

DROP TABLE IF EXISTS `tb_tipo_doc_especifico`;

CREATE TABLE `tb_tipo_doc_especifico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_doc_especifico` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tb_tipo_doc_especifico` */

insert  into `tb_tipo_doc_especifico`(`id`,`tipo_doc_especifico`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'Documentos Específicos',NULL,NULL,'2021-12-15 12:25:58',1,NULL,NULL,NULL),(2,'Otros Documentos',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'sdsd','2021-12-23 11:56:05',1,'2021-12-23 11:56:05',NULL,NULL,NULL,NULL),(4,'z<z<','2021-12-23 11:56:10',1,'2021-12-23 11:56:10',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_documento` */

DROP TABLE IF EXISTS `tb_tipo_documento`;

CREATE TABLE `tb_tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `tb_tipo_documento` */

insert  into `tb_tipo_documento`(`id`,`tipo_documento`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'DNI',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'RUC',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_equipo` */

DROP TABLE IF EXISTS `tb_tipo_equipo`;

CREATE TABLE `tb_tipo_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_equipo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Estaba estatica:\n1 Equipo de especialidad\n2 Material\n3 Insumos\n4 Equipo de computo';

/*Data for the table `tb_tipo_equipo` */

insert  into `tb_tipo_equipo`(`id`,`tipo_equipo`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'Equipo de especialidad',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Material',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Insumos',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Equipo de computo',NULL,NULL,'2021-12-15 12:43:41',2,NULL,NULL,NULL),(5,'Máquinas','2021-12-15 12:23:55',1,'2021-12-15 12:23:55',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_fiscalizado` */

DROP TABLE IF EXISTS `tb_tipo_fiscalizado`;

CREATE TABLE `tb_tipo_fiscalizado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_fiscalizado` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='No fiscalizado\nFiscalizado por SUNAT\nFiscalizado por Ministerio de producción';

/*Data for the table `tb_tipo_fiscalizado` */

insert  into `tb_tipo_fiscalizado`(`id`,`tipo_fiscalizado`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'No fiscalizado',NULL,NULL,'2021-12-10 19:38:40',18,NULL,NULL,NULL),(2,'Fiscalizado SUNAT',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Fiscalizado Ministerio de Producción',NULL,NULL,'2021-12-10 19:36:12',18,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_laboratorio` */

DROP TABLE IF EXISTS `tb_tipo_laboratorio`;

CREATE TABLE `tb_tipo_laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_laboratorio` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='1. Enseñanza o académica\n2. Investigación\n3. Servicios\n4. Computo';

/*Data for the table `tb_tipo_laboratorio` */

insert  into `tb_tipo_laboratorio`(`id`,`tipo_laboratorio`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'LABORATORIO DE ENSEÑANZA',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'LABORATORIO DE SERVICIOS',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'LABORATORIO DE INVESTIGACION',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'LABORATORIO DE COMPUTO',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'TALLER DE APOYO TECNICO',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'TALLER DE ENSEÑANZA ',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tb_tipo_movimiento` */

DROP TABLE IF EXISTS `tb_tipo_movimiento`;

CREATE TABLE `tb_tipo_movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1 INVENTARIO INICIAL\n2 REGULARIZACIÓN DEL ALMACEN\n3 INGRESO POR COMPRA\n4 SALIDA POR ATENCION\n5 SALIDA POR ANULACION DE COMPRA\n6 INGRESO POR ANULACION DE VENTA\n7 SALIDA POR ANULACION DE LOTE',
  `tipo_movimiento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `tb_tipo_movimiento` */

insert  into `tb_tipo_movimiento`(`id`,`tipo_movimiento`) values (1,'REGISTRO DE LOTE'),(2,'REGULARIZACIÓN DEL STOCK'),(3,'INGRESO POR COMPRA'),(4,'SALIDA POR ATENCION'),(5,'SALIDA POR ANULACION DE COMPRA'),(6,'INGRESO POR ANULACION DE VENTA'),(7,'ANULACION DE LOTE POR REGULARIZACIÓN DEL STOCK'),(8,'INGRESO POR ATENCIÓN'),(9,'INGRESO POR DEVOLUCIÓN');

/*Table structure for table `tb_tipopersonal` */

DROP TABLE IF EXISTS `tb_tipopersonal`;

CREATE TABLE `tb_tipopersonal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_personal` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='1. Personal Docente\n2. Personal Administrativo\n\nPueden alimentar a su manera';

/*Data for the table `tb_tipopersonal` */

insert  into `tb_tipopersonal`(`id`,`tipo_personal`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'Personal Docente',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Personal Administrativo',NULL,NULL,'2021-12-16 21:35:57',1,NULL,NULL,NULL);

/*Table structure for table `tb_ubigeo` */

DROP TABLE IF EXISTS `tb_ubigeo`;

CREATE TABLE `tb_ubigeo` (
  `ubigeo` int(11) NOT NULL,
  `distrito` varchar(350) COLLATE latin1_spanish_ci DEFAULT NULL,
  `provincia` varchar(350) COLLATE latin1_spanish_ci DEFAULT NULL,
  `departamento` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `poblacion` int(10) DEFAULT NULL,
  `area` int(5) DEFAULT NULL,
  PRIMARY KEY (`ubigeo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tb_ubigeo` */

insert  into `tb_ubigeo`(`ubigeo`,`distrito`,`provincia`,`departamento`,`poblacion`,`area`) values (10101,'CHACHAPOYAS','CHACHAPOYAS','AMAZONAS',28731,135),(10102,'ASUNCION','CHACHAPOYAS','AMAZONAS',288,27),(10103,'BALSAS','CHACHAPOYAS','AMAZONAS',1625,326),(10104,'CHETO','CHACHAPOYAS','AMAZONAS',591,76),(10105,'CHILIQUIN','CHACHAPOYAS','AMAZONAS',711,141),(10106,'CHUQUIBAMBA','CHACHAPOYAS','AMAZONAS',2069,176),(10107,'GRANADA','CHACHAPOYAS','AMAZONAS',385,170),(10108,'HUANCAS','CHACHAPOYAS','AMAZONAS',1305,48),(10109,'LA JALCA','CHACHAPOYAS','AMAZONAS',5505,127),(10110,'LEIMEBAMBA','CHACHAPOYAS','AMAZONAS',4190,462),(10111,'LEVANTO','CHACHAPOYAS','AMAZONAS',873,93),(10112,'MAGDALENA','CHACHAPOYAS','AMAZONAS',795,134),(10113,'MARISCAL CASTILLA','CHACHAPOYAS','AMAZONAS',1006,99),(10114,'MOLINOPAMPA','CHACHAPOYAS','AMAZONAS',2740,344),(10115,'MONTEVIDEO','CHACHAPOYAS','AMAZONAS',589,81),(10116,'OLLEROS','CHACHAPOYAS','AMAZONAS',362,122),(10117,'QUINJALCA','CHACHAPOYAS','AMAZONAS',843,89),(10118,'SAN FRANCISCO DE DAGUAS','CHACHAPOYAS','AMAZONAS',349,47),(10119,'SAN ISIDRO DE MAINO','CHACHAPOYAS','AMAZONAS',706,107),(10120,'SOLOCO','CHACHAPOYAS','AMAZONAS',1318,77),(10121,'SONCHE','CHACHAPOYAS','AMAZONAS',220,117),(10201,'BAGUA','BAGUA','AMAZONAS',25965,75),(10202,'ARAMANGO','BAGUA','AMAZONAS',11032,839),(10203,'COPALLIN','BAGUA','AMAZONAS',6328,106),(10204,'EL PARCO','BAGUA','AMAZONAS',1476,14),(10205,'IMAZA','BAGUA','AMAZONAS',24114,4672),(10206,'LA PECA','BAGUA','AMAZONAS',8006,183),(10301,'JUMBILLA','BONGARA','AMAZONAS',1748,161),(10302,'CHISQUILLA','BONGARA','AMAZONAS',336,177),(10303,'CHURUJA','BONGARA','AMAZONAS',269,31),(10304,'COROSHA','BONGARA','AMAZONAS',1025,47),(10305,'CUISPES','BONGARA','AMAZONAS',895,104),(10306,'FLORIDA','BONGARA','AMAZONAS',8493,196),(10307,'JAZAN','BONGARA','AMAZONAS',9260,89),(10308,'RECTA','BONGARA','AMAZONAS',206,22),(10309,'SAN CARLOS','BONGARA','AMAZONAS',317,99),(10310,'SHIPASBAMBA','BONGARA','AMAZONAS',1786,130),(10311,'VALERA','BONGARA','AMAZONAS',1281,88),(10312,'YAMBRASBAMBA','BONGARA','AMAZONAS',8304,1686),(10401,'NIEVA','CONDORCANQUI','AMAZONAS',28726,4436),(10402,'EL CENEPA','CONDORCANQUI','AMAZONAS',9537,5405),(10403,'RIO SANTIAGO','CONDORCANQUI','AMAZONAS',16686,8107),(10501,'LAMUD','LUYA','AMAZONAS',2300,72),(10502,'CAMPORREDONDO','LUYA','AMAZONAS',7048,378),(10503,'COCABAMBA','LUYA','AMAZONAS',2498,336),(10504,'COLCAMAR','LUYA','AMAZONAS',2284,110),(10505,'CONILA','LUYA','AMAZONAS',2083,228),(10506,'INGUILPATA','LUYA','AMAZONAS',603,123),(10507,'LONGUITA','LUYA','AMAZONAS',1146,64),(10508,'LONYA CHICO','LUYA','AMAZONAS',975,57),(10509,'LUYA','LUYA','AMAZONAS',4404,99),(10510,'LUYA VIEJO','LUYA','AMAZONAS',483,61),(10511,'MARIA','LUYA','AMAZONAS',940,83),(10512,'OCALLI','LUYA','AMAZONAS',4211,171),(10513,'OCUMAL','LUYA','AMAZONAS',4164,369),(10514,'PISUQUIA','LUYA','AMAZONAS',6081,309),(10515,'PROVIDENCIA','LUYA','AMAZONAS',1533,117),(10516,'SAN CRISTOBAL','LUYA','AMAZONAS',690,37),(10517,'SAN FRANCISCO DEL YESO','LUYA','AMAZONAS',820,110),(10518,'SAN JERONIMO','LUYA','AMAZONAS',890,218),(10519,'SAN JUAN DE LOPECANCHA','LUYA','AMAZONAS',513,83),(10520,'SANTA CATALINA','LUYA','AMAZONAS',1893,126),(10521,'SANTO TOMAS','LUYA','AMAZONAS',3562,93),(10522,'TINGO','LUYA','AMAZONAS',1355,105),(10523,'TRITA','LUYA','AMAZONAS',1373,12),(10601,'SAN NICOLAS','RODRIGUEZ DE MENDOZA','AMAZONAS',5224,105),(10602,'CHIRIMOTO','RODRIGUEZ DE MENDOZA','AMAZONAS',2052,161),(10603,'COCHAMAL','RODRIGUEZ DE MENDOZA','AMAZONAS',506,213),(10604,'HUAMBO','RODRIGUEZ DE MENDOZA','AMAZONAS',2598,88),(10605,'LIMABAMBA','RODRIGUEZ DE MENDOZA','AMAZONAS',3002,645),(10606,'LONGAR','RODRIGUEZ DE MENDOZA','AMAZONAS',1624,50),(10607,'MARISCAL BENAVIDES','RODRIGUEZ DE MENDOZA','AMAZONAS',1381,186),(10608,'MILPUC','RODRIGUEZ DE MENDOZA','AMAZONAS',604,45),(10609,'OMIA','RODRIGUEZ DE MENDOZA','AMAZONAS',9562,223),(10610,'SANTA ROSA','RODRIGUEZ DE MENDOZA','AMAZONAS',464,19),(10611,'TOTORA','RODRIGUEZ DE MENDOZA','AMAZONAS',450,20),(10612,'VISTA ALEGRE','RODRIGUEZ DE MENDOZA','AMAZONAS',3725,927),(10701,'BAGUA GRANDE','UTCUBAMBA','AMAZONAS',53537,717),(10702,'CAJARURO','UTCUBAMBA','AMAZONAS',28403,1797),(10703,'CUMBA','UTCUBAMBA','AMAZONAS',8815,300),(10704,'EL MILAGRO','UTCUBAMBA','AMAZONAS',6369,310),(10705,'JAMALCA','UTCUBAMBA','AMAZONAS',8219,387),(10706,'LONYA GRANDE','UTCUBAMBA','AMAZONAS',10377,216),(10707,'YAMON','UTCUBAMBA','AMAZONAS',2877,143),(20101,'HUARAZ','HUARAZ','ANCASH',64109,423),(20102,'COCHABAMBA','HUARAZ','ANCASH',1989,138),(20103,'COLCABAMBA','HUARAZ','ANCASH',800,52),(20104,'HUANCHAY','HUARAZ','ANCASH',2283,208),(20105,'INDEPENDENCIA','HUARAZ','ANCASH',73556,346),(20106,'JANGAS','HUARAZ','ANCASH',4988,62),(20107,'LA LIBERTAD','HUARAZ','ANCASH',1162,160),(20108,'OLLEROS','HUARAZ','ANCASH',2230,230),(20109,'PAMPAS','HUARAZ','ANCASH',1190,351),(20110,'PARIACOTO','HUARAZ','ANCASH',4718,168),(20111,'PIRA','HUARAZ','ANCASH',3763,248),(20112,'TARICA','HUARAZ','ANCASH',5837,116),(20201,'AIJA','AIJA','ANCASH',1873,163),(20202,'CORIS','AIJA','ANCASH',2239,259),(20203,'HUACLLAN','AIJA','ANCASH',616,40),(20204,'LA MERCED','AIJA','ANCASH',2220,158),(20205,'SUCCHA','AIJA','ANCASH',841,78),(20301,'LLAMELLIN','ANTONIO RAYMONDI','ANCASH',3591,95),(20302,'ACZO','ANTONIO RAYMONDI','ANCASH',2176,68),(20303,'CHACCHO','ANTONIO RAYMONDI','ANCASH',1718,73),(20304,'CHINGAS','ANTONIO RAYMONDI','ANCASH',1936,50),(20305,'MIRGAS','ANTONIO RAYMONDI','ANCASH',5338,172),(20306,'SAN JUAN DE RONTOY','ANTONIO RAYMONDI','ANCASH',1642,103),(20401,'CHACAS','ASUNCION','ANCASH',5573,449),(20402,'ACOCHACA','ASUNCION','ANCASH',3222,76),(20501,'CHIQUIAN','BOLOGNESI','ANCASH',3641,187),(20502,'ABELARDO PARDO LEZAMETA','BOLOGNESI','ANCASH',1208,11),(20503,'ANTONIO RAYMONDI','BOLOGNESI','ANCASH',1078,121),(20504,'AQUIA','BOLOGNESI','ANCASH',2513,435),(20505,'CAJACAY','BOLOGNESI','ANCASH',1602,193),(20506,'CANIS','BOLOGNESI','ANCASH',1250,20),(20507,'COLQUIOC','BOLOGNESI','ANCASH',4002,274),(20508,'HUALLANCA','BOLOGNESI','ANCASH',8220,817),(20509,'HUASTA','BOLOGNESI','ANCASH',2571,395),(20510,'HUAYLLACAYAN','BOLOGNESI','ANCASH',1104,126),(20511,'LA PRIMAVERA','BOLOGNESI','ANCASH',911,64),(20512,'MANGAS','BOLOGNESI','ANCASH',567,127),(20513,'PACLLON','BOLOGNESI','ANCASH',1722,210),(20514,'SAN MIGUEL DE CORPANQUI','BOLOGNESI','ANCASH',1241,44),(20515,'TICLLOS','BOLOGNESI','ANCASH',1243,92),(20601,'CARHUAZ','CARHUAZ','ANCASH',15373,198),(20602,'ACOPAMPA','CARHUAZ','ANCASH',2655,15),(20603,'AMASHCA','CARHUAZ','ANCASH',1581,13),(20604,'ANTA','CARHUAZ','ANCASH',2494,43),(20605,'ATAQUERO','CARHUAZ','ANCASH',1377,45),(20606,'MARCARA','CARHUAZ','ANCASH',9304,176),(20607,'PARIAHUANCA','CARHUAZ','ANCASH',1609,12),(20608,'SAN MIGUEL DE ACO','CARHUAZ','ANCASH',2750,123),(20609,'SHILLA','CARHUAZ','ANCASH',3306,128),(20610,'TINCO','CARHUAZ','ANCASH',3240,16),(20611,'YUNGAR','CARHUAZ','ANCASH',3408,45),(20701,'SAN LUIS','CARLOS FERMIN FITZCA','ANCASH',12566,248),(20702,'SAN NICOLAS','CARLOS FERMIN FITZCA','ANCASH',3738,204),(20703,'YAUYA','CARLOS FERMIN FITZCA','ANCASH',5527,175),(20801,'CASMA','CASMA','ANCASH',32824,1205),(20802,'BUENA VISTA ALTA','CASMA','ANCASH',4213,481),(20803,'COMANDANTE NOEL','CASMA','ANCASH',2058,218),(20804,'YAUTAN','CASMA','ANCASH',8383,365),(20901,'CORONGO','CORONGO','ANCASH',1487,151),(20902,'ACO','CORONGO','ANCASH',460,58),(20903,'BAMBAS','CORONGO','ANCASH',537,154),(20904,'CUSCA','CORONGO','ANCASH',2941,426),(20905,'LA PAMPA','CORONGO','ANCASH',1030,95),(20906,'YANAC','CORONGO','ANCASH',708,47),(20907,'YUPAN','CORONGO','ANCASH',1002,85),(21001,'HUARI','HUARI','ANCASH',10283,400),(21002,'ANRA','HUARI','ANCASH',1618,78),(21003,'CAJAY','HUARI','ANCASH',2638,166),(21004,'CHAVIN DE HUANTAR','HUARI','ANCASH',9221,418),(21005,'HUACACHI','HUARI','ANCASH',1876,90),(21006,'HUACCHIS','HUARI','ANCASH',2075,76),(21007,'HUACHIS','HUARI','ANCASH',3509,152),(21008,'HUANTAR','HUARI','ANCASH',3044,162),(21009,'MASIN','HUARI','ANCASH',1706,75),(21010,'PAUCAS','HUARI','ANCASH',1863,140),(21011,'PONTO','HUARI','ANCASH',3349,119),(21012,'RAHUAPAMPA','HUARI','ANCASH',802,10),(21013,'RAPAYAN','HUARI','ANCASH',1793,145),(21014,'SAN MARCOS','HUARI','ANCASH',14781,564),(21015,'SAN PEDRO DE CHANA','HUARI','ANCASH',2814,144),(21016,'UCO','HUARI','ANCASH',1685,52),(21101,'HUARMEY','HUARMEY','ANCASH',24316,2909),(21102,'COCHAPETI','HUARMEY','ANCASH',771,99),(21103,'CULEBRAS','HUARMEY','ANCASH',3661,629),(21104,'HUAYAN','HUARMEY','ANCASH',1065,112),(21105,'MALVAS','HUARMEY','ANCASH',931,168),(21201,'CARAZ','HUAYLAS','ANCASH',26208,245),(21202,'HUALLANCA','HUAYLAS','ANCASH',703,173),(21203,'HUATA','HUAYLAS','ANCASH',1638,70),(21204,'HUAYLAS','HUAYLAS','ANCASH',1466,54),(21205,'MATO','HUAYLAS','ANCASH',2030,106),(21206,'PAMPAROMAS','HUAYLAS','ANCASH',9153,500),(21207,'PUEBLO LIBRE','HUAYLAS','ANCASH',7186,128),(21208,'SANTA CRUZ','HUAYLAS','ANCASH',5164,359),(21209,'SANTO TORIBIO','HUAYLAS','ANCASH',1100,84),(21210,'YURACMARCA','HUAYLAS','ANCASH',1780,566),(21301,'PISCOBAMBA','MARISCAL LUZURIAGA','ANCASH',3774,46),(21302,'CASCA','MARISCAL LUZURIAGA','ANCASH',4507,75),(21303,'ELEAZAR GUZMAN BARRON','MARISCAL LUZURIAGA','ANCASH',1376,97),(21304,'FIDEL OLIVAS ESCUDERO','MARISCAL LUZURIAGA','ANCASH',2249,213),(21305,'LLAMA','MARISCAL LUZURIAGA','ANCASH',1254,49),(21306,'LLUMPA','MARISCAL LUZURIAGA','ANCASH',6321,139),(21307,'LUCMA','MARISCAL LUZURIAGA','ANCASH',3246,75),(21308,'MUSGA','MARISCAL LUZURIAGA','ANCASH',1027,39),(21401,'OCROS','OCROS','ANCASH',1020,225),(21402,'ACAS','OCROS','ANCASH',1024,256),(21403,'CAJAMARQUILLA','OCROS','ANCASH',574,79),(21404,'CARHUAPAMPA','OCROS','ANCASH',826,106),(21405,'COCHAS','OCROS','ANCASH',1442,415),(21406,'CONGAS','OCROS','ANCASH',1220,131),(21407,'LLIPA','OCROS','ANCASH',1739,31),(21408,'SAN CRISTOBAL DE RAJAN','OCROS','ANCASH',624,70),(21409,'SAN PEDRO','OCROS','ANCASH',1951,548),(21410,'SANTIAGO DE CHILCAS','OCROS','ANCASH',382,88),(21501,'CABANA','PALLASCA','ANCASH',2724,144),(21502,'BOLOGNESI','PALLASCA','ANCASH',1303,84),(21503,'CONCHUCOS','PALLASCA','ANCASH',8359,578),(21504,'HUACASCHUQUE','PALLASCA','ANCASH',583,18),(21505,'HUANDOVAL','PALLASCA','ANCASH',1124,109),(21506,'LACABAMBA','PALLASCA','ANCASH',576,63),(21507,'LLAPO','PALLASCA','ANCASH',723,31),(21508,'PALLASCA','PALLASCA','ANCASH',2447,110),(21509,'PAMPAS','PALLASCA','ANCASH',8502,437),(21510,'SANTA ROSA','PALLASCA','ANCASH',1057,291),(21511,'TAUCA','PALLASCA','ANCASH',3172,199),(21601,'POMABAMBA','POMABAMBA','ANCASH',16294,345),(21602,'HUAYLLAN','POMABAMBA','ANCASH',3673,90),(21603,'PAROBAMBA','POMABAMBA','ANCASH',6994,340),(21604,'QUINUABAMBA','POMABAMBA','ANCASH',2414,149),(21701,'RECUAY','RECUAY','ANCASH',4462,149),(21702,'CATAC','RECUAY','ANCASH',4020,1024),(21703,'COTAPARACO','RECUAY','ANCASH',644,175),(21704,'HUAYLLAPAMPA','RECUAY','ANCASH',1305,110),(21705,'LLACLLIN','RECUAY','ANCASH',1806,97),(21706,'MARCA','RECUAY','ANCASH',980,183),(21707,'PAMPAS CHICO','RECUAY','ANCASH',2036,97),(21708,'PARARIN','RECUAY','ANCASH',1373,259),(21709,'TAPACOCHA','RECUAY','ANCASH',464,78),(21710,'TICAPAMPA','RECUAY','ANCASH',2258,146),(21801,'CHIMBOTE','SANTA','ANCASH',214804,1450),(21802,'CACERES DEL PERU','SANTA','ANCASH',4884,487),(21803,'COISHCO','SANTA','ANCASH',15811,10),(21804,'MACATE','SANTA','ANCASH',3425,586),(21805,'MORO','SANTA','ANCASH',7528,399),(21806,'NEPEÑA','SANTA','ANCASH',15589,457),(21807,'SAMANCO','SANTA','ANCASH',4590,146),(21808,'SANTA','SANTA','ANCASH',20532,40),(21809,'NUEVO CHIMBOTE','SANTA','ANCASH',151127,397),(21901,'SIHUAS','SIHUAS','ANCASH',5705,62),(21902,'ACOBAMBA','SIHUAS','ANCASH',2183,151),(21903,'ALFONSO UGARTE','SIHUAS','ANCASH',783,90),(21904,'CASHAPAMPA','SIHUAS','ANCASH',2874,73),(21905,'CHINGALPO','SIHUAS','ANCASH',1058,172),(21906,'HUAYLLABAMBA','SIHUAS','ANCASH',4014,258),(21907,'QUICHES','SIHUAS','ANCASH',2924,148),(21908,'RAGASH','SIHUAS','ANCASH',2642,209),(21909,'SAN JUAN','SIHUAS','ANCASH',6522,212),(21910,'SICSIBAMBA','SIHUAS','ANCASH',1824,82),(22001,'YUNGAY','YUNGAY','ANCASH',21911,275),(22002,'CASCAPARA','YUNGAY','ANCASH',2287,137),(22003,'MANCOS','YUNGAY','ANCASH',6977,63),(22004,'MATACOTO','YUNGAY','ANCASH',1635,47),(22005,'QUILLO','YUNGAY','ANCASH',13798,370),(22006,'RANRAHIRCA','YUNGAY','ANCASH',2707,22),(22007,'SHUPLUY','YUNGAY','ANCASH',2399,166),(22008,'YANAMA','YUNGAY','ANCASH',6969,284),(30101,'ABANCAY','ABANCAY','APURIMAC',56093,288),(30102,'CHACOCHE','ABANCAY','APURIMAC',1213,176),(30103,'CIRCA','ABANCAY','APURIMAC',2506,635),(30104,'CURAHUASI','ABANCAY','APURIMAC',18328,866),(30105,'HUANIPACA','ABANCAY','APURIMAC',4749,427),(30106,'LAMBRAMA','ABANCAY','APURIMAC',5561,524),(30107,'PICHIRHUA','ABANCAY','APURIMAC',4042,373),(30108,'SAN PEDRO DE CACHORA','ABANCAY','APURIMAC',3838,118),(30109,'TAMBURCO','ABANCAY','APURIMAC',9884,54),(30201,'ANDAHUAYLAS','ANDAHUAYLAS','APURIMAC',48547,376),(30202,'ANDARAPA','ANDAHUAYLAS','APURIMAC',6380,212),(30203,'CHIARA','ANDAHUAYLAS','APURIMAC',1350,148),(30204,'HUANCARAMA','ANDAHUAYLAS','APURIMAC',7441,157),(30205,'HUANCARAY','ANDAHUAYLAS','APURIMAC',4632,112),(30206,'HUAYANA','ANDAHUAYLAS','APURIMAC',1058,95),(30207,'KISHUARA','ANDAHUAYLAS','APURIMAC',9282,310),(30208,'PACOBAMBA','ANDAHUAYLAS','APURIMAC',4794,258),(30209,'PACUCHA','ANDAHUAYLAS','APURIMAC',9994,176),(30210,'PAMPACHIRI','ANDAHUAYLAS','APURIMAC',2780,589),(30211,'POMACOCHA','ANDAHUAYLAS','APURIMAC',1042,123),(30212,'SAN ANTONIO DE CACHI','ANDAHUAYLAS','APURIMAC',3237,179),(30213,'SAN JERONIMO','ANDAHUAYLAS','APURIMAC',27665,244),(30214,'SAN MIGUEL DE CHACCRAMPA','ANDAHUAYLAS','APURIMAC',2057,85),(30215,'SANTA MARIA DE CHICMO','ANDAHUAYLAS','APURIMAC',9910,157),(30216,'TALAVERA','ANDAHUAYLAS','APURIMAC',18313,109),(30217,'TUMAY HUARACA','ANDAHUAYLAS','APURIMAC',2415,454),(30218,'TURPO','ANDAHUAYLAS','APURIMAC',4197,123),(30219,'KAQUIABAMBA','ANDAHUAYLAS','APURIMAC',2962,113),(30301,'ANTABAMBA','ANTABAMBA','APURIMAC',3164,603),(30302,'EL ORO','ANTABAMBA','APURIMAC',552,67),(30303,'HUAQUIRCA','ANTABAMBA','APURIMAC',1571,352),(30304,'JUAN ESPINOZA MEDRANO','ANTABAMBA','APURIMAC',2066,624),(30305,'OROPESA','ANTABAMBA','APURIMAC',3110,1171),(30306,'PACHACONAS','ANTABAMBA','APURIMAC',1286,229),(30307,'SABAINO','ANTABAMBA','APURIMAC',1648,176),(30401,'CHALHUANCA','AYMARAES','APURIMAC',5015,329),(30402,'CAPAYA','AYMARAES','APURIMAC',970,84),(30403,'CARAYBAMBA','AYMARAES','APURIMAC',1472,237),(30404,'CHAPIMARCA','AYMARAES','APURIMAC',2160,204),(30405,'COLCABAMBA','AYMARAES','APURIMAC',933,91),(30406,'COTARUSE','AYMARAES','APURIMAC',5326,1737),(30407,'HUAYLLO','AYMARAES','APURIMAC',728,73),(30408,'JUSTO APU SAHUARAURA','AYMARAES','APURIMAC',1292,101),(30409,'LUCRE','AYMARAES','APURIMAC',2159,104),(30410,'POCOHUANCA','AYMARAES','APURIMAC',1177,88),(30411,'SAN JUAN DE CHACÑA','AYMARAES','APURIMAC',856,96),(30412,'SAÑAYCA','AYMARAES','APURIMAC',1441,364),(30413,'SORAYA','AYMARAES','APURIMAC',825,45),(30414,'TAPAIRIHUA','AYMARAES','APURIMAC',2259,160),(30415,'TINTAY','AYMARAES','APURIMAC',3227,143),(30416,'TORAYA','AYMARAES','APURIMAC',1962,168),(30417,'YANACA','AYMARAES','APURIMAC',1193,104),(30501,'TAMBOBAMBA','COTABAMBAS','APURIMAC',11582,715),(30502,'COTABAMBAS','COTABAMBAS','APURIMAC',4237,326),(30503,'COYLLURQUI','COTABAMBAS','APURIMAC',8542,419),(30504,'HAQUIRA','COTABAMBAS','APURIMAC',11802,483),(30505,'MARA','COTABAMBAS','APURIMAC',6695,223),(30506,'CHALLHUAHUACHO','COTABAMBAS','APURIMAC',9908,455),(30601,'CHINCHEROS','CHINCHEROS','APURIMAC',6809,136),(30602,'ANCO_HUALLO','CHINCHEROS','APURIMAC',12477,118),(30603,'COCHARCAS','CHINCHEROS','APURIMAC',2675,109),(30604,'HUACCANA','CHINCHEROS','APURIMAC',10327,479),(30605,'OCOBAMBA','CHINCHEROS','APURIMAC',8316,231),(30606,'ONGOY','CHINCHEROS','APURIMAC',9131,230),(30607,'URANMARCA','CHINCHEROS','APURIMAC',3649,147),(30608,'RANRACANCHA','CHINCHEROS','APURIMAC',5298,74),(30701,'CHUQUIBAMBILLA','GRAU','APURIMAC',5402,426),(30702,'CURPAHUASI','GRAU','APURIMAC',2369,311),(30703,'GAMARRA','GRAU','APURIMAC',3985,350),(30704,'HUAYLLATI','GRAU','APURIMAC',1685,124),(30705,'MAMARA','GRAU','APURIMAC',981,62),(30706,'MICAELA BASTIDAS','GRAU','APURIMAC',1680,105),(30707,'PATAYPAMPA','GRAU','APURIMAC',1121,147),(30708,'PROGRESO','GRAU','APURIMAC',3325,241),(30709,'SAN ANTONIO','GRAU','APURIMAC',366,25),(30710,'SANTA ROSA','GRAU','APURIMAC',716,31),(30711,'TURPAY','GRAU','APURIMAC',769,51),(30712,'VILCABAMBA','GRAU','APURIMAC',1401,7),(30713,'VIRUNDO','GRAU','APURIMAC',1296,114),(30714,'CURASCO','GRAU','APURIMAC',1624,135),(40101,'AREQUIPA','AREQUIPA','AREQUIPA',54095,10),(40102,'ALTO SELVA ALEGRE','AREQUIPA','AREQUIPA',82412,67),(40103,'CAYMA','AREQUIPA','AREQUIPA',91802,236),(40104,'CERRO COLORADO','AREQUIPA','AREQUIPA',148164,173),(40105,'CHARACATO','AREQUIPA','AREQUIPA',9288,85),(40106,'CHIGUATA','AREQUIPA','AREQUIPA',2940,437),(40107,'JACOBO HUNTER','AREQUIPA','AREQUIPA',48326,20),(40108,'LA JOYA','AREQUIPA','AREQUIPA',30233,698),(40109,'MARIANO MELGAR','AREQUIPA','AREQUIPA',52667,29),(40110,'MIRAFLORES','AREQUIPA','AREQUIPA',48677,26),(40111,'MOLLEBAYA','AREQUIPA','AREQUIPA',1868,31),(40112,'PAUCARPATA','AREQUIPA','AREQUIPA',124755,28),(40113,'POCSI','AREQUIPA','AREQUIPA',547,167),(40114,'POLOBAYA','AREQUIPA','AREQUIPA',1477,399),(40115,'QUEQUEÑA','AREQUIPA','AREQUIPA',1376,35),(40116,'SABANDIA','AREQUIPA','AREQUIPA',4136,38),(40117,'SACHACA','AREQUIPA','AREQUIPA',19581,11),(40118,'SAN JUAN DE SIGUAS','AREQUIPA','AREQUIPA',1535,93),(40119,'SAN JUAN DE TARUCANI','AREQUIPA','AREQUIPA',2179,2240),(40120,'SANTA ISABEL DE SIGUAS','AREQUIPA','AREQUIPA',1264,186),(40121,'SANTA RITA DE SIGUAS','AREQUIPA','AREQUIPA',5592,369),(40122,'SOCABAYA','AREQUIPA','AREQUIPA',78135,25),(40123,'TIABAYA','AREQUIPA','AREQUIPA',14768,39),(40124,'UCHUMAYO','AREQUIPA','AREQUIPA',12436,271),(40125,'VITOR','AREQUIPA','AREQUIPA',2345,1532),(40126,'YANAHUARA','AREQUIPA','AREQUIPA',25483,6),(40127,'YARABAMBA','AREQUIPA','AREQUIPA',1125,480),(40128,'YURA','AREQUIPA','AREQUIPA',25367,1918),(40129,'JOSE LUIS BUSTAMANTE Y RIVERO','AREQUIPA','AREQUIPA',76711,11),(40201,'CAMANA','CAMANA','AREQUIPA',14477,11),(40202,'JOSE MARIA QUIMPER','CAMANA','AREQUIPA',4134,16),(40203,'MARIANO NICOLAS VALCARCEL','CAMANA','AREQUIPA',6890,557),(40204,'MARISCAL CACERES','CAMANA','AREQUIPA',6376,593),(40205,'NICOLAS DE PIEROLA','CAMANA','AREQUIPA',6310,387),(40206,'OCOÑA','CAMANA','AREQUIPA',4810,1417),(40207,'QUILCA','CAMANA','AREQUIPA',661,904),(40208,'SAMUEL PASTOR','CAMANA','AREQUIPA',15294,114),(40301,'CARAVELI','CARAVELI','AREQUIPA',3722,756),(40302,'ACARI','CARAVELI','AREQUIPA',3201,771),(40303,'ATICO','CARAVELI','AREQUIPA',4147,3099),(40304,'ATIQUIPA','CARAVELI','AREQUIPA',913,423),(40305,'BELLA UNION','CARAVELI','AREQUIPA',6586,1584),(40306,'CAHUACHO','CARAVELI','AREQUIPA',906,1386),(40307,'CHALA','CARAVELI','AREQUIPA',6756,340),(40308,'CHAPARRA','CARAVELI','AREQUIPA',5368,1497),(40309,'HUANUHUANU','CARAVELI','AREQUIPA',3258,703),(40310,'JAQUI','CARAVELI','AREQUIPA',1256,422),(40311,'LOMAS','CARAVELI','AREQUIPA',1328,445),(40312,'QUICACHA','CARAVELI','AREQUIPA',1881,1037),(40313,'YAUCA','CARAVELI','AREQUIPA',1582,546),(40401,'APLAO','CASTILLA','AREQUIPA',8844,616),(40402,'ANDAGUA','CASTILLA','AREQUIPA',1152,473),(40403,'AYO','CASTILLA','AREQUIPA',396,284),(40404,'CHACHAS','CASTILLA','AREQUIPA',1720,1197),(40405,'CHILCAYMARCA','CASTILLA','AREQUIPA',1243,182),(40406,'CHOCO','CASTILLA','AREQUIPA',1009,905),(40407,'HUANCARQUI','CASTILLA','AREQUIPA',1317,795),(40408,'MACHAGUAY','CASTILLA','AREQUIPA',723,245),(40409,'ORCOPAMPA','CASTILLA','AREQUIPA',9661,729),(40410,'PAMPACOLCA','CASTILLA','AREQUIPA',2713,266),(40411,'TIPAN','CASTILLA','AREQUIPA',522,55),(40412,'UÑON','CASTILLA','AREQUIPA',442,339),(40413,'URACA','CASTILLA','AREQUIPA',7216,696),(40414,'VIRACO','CASTILLA','AREQUIPA',1712,137),(40501,'CHIVAY','CAYLLOMA','AREQUIPA',7688,243),(40502,'ACHOMA','CAYLLOMA','AREQUIPA',908,365),(40503,'CABANACONDE','CAYLLOMA','AREQUIPA',2406,460),(40504,'CALLALLI','CAYLLOMA','AREQUIPA',2003,1542),(40505,'CAYLLOMA','CAYLLOMA','AREQUIPA',3173,1517),(40506,'COPORAQUE','CAYLLOMA','AREQUIPA',1520,114),(40507,'HUAMBO','CAYLLOMA','AREQUIPA',614,717),(40508,'HUANCA','CAYLLOMA','AREQUIPA',1450,377),(40509,'ICHUPAMPA','CAYLLOMA','AREQUIPA',663,74),(40510,'LARI','CAYLLOMA','AREQUIPA',1526,371),(40511,'LLUTA','CAYLLOMA','AREQUIPA',1275,1218),(40512,'MACA','CAYLLOMA','AREQUIPA',723,237),(40513,'MADRIGAL','CAYLLOMA','AREQUIPA',498,160),(40514,'SAN ANTONIO DE CHUCA','CAYLLOMA','AREQUIPA',1547,1538),(40515,'SIBAYO','CAYLLOMA','AREQUIPA',675,284),(40516,'TAPAY','CAYLLOMA','AREQUIPA',545,415),(40517,'TISCO','CAYLLOMA','AREQUIPA',1450,1441),(40518,'TUTI','CAYLLOMA','AREQUIPA',758,240),(40519,'YANQUE','CAYLLOMA','AREQUIPA',2137,1111),(40520,'MAJES','CAYLLOMA','AREQUIPA',62661,1638),(40601,'CHUQUIBAMBA','CONDESUYOS','AREQUIPA',3346,1188),(40602,'ANDARAY','CONDESUYOS','AREQUIPA',670,811),(40603,'CAYARANI','CONDESUYOS','AREQUIPA',3159,1396),(40604,'CHICHAS','CONDESUYOS','AREQUIPA',672,390),(40605,'IRAY','CONDESUYOS','AREQUIPA',646,238),(40606,'RIO GRANDE','CONDESUYOS','AREQUIPA',2751,531),(40607,'SALAMANCA','CONDESUYOS','AREQUIPA',879,1244),(40608,'YANAQUIHUA','CONDESUYOS','AREQUIPA',5820,1055),(40701,'MOLLENDO','ISLAY','AREQUIPA',22389,930),(40702,'COCACHACRA','ISLAY','AREQUIPA',8984,1548),(40703,'DEAN VALDIVIA','ISLAY','AREQUIPA',6619,134),(40704,'ISLAY','ISLAY','AREQUIPA',7124,365),(40705,'MEJIA','ISLAY','AREQUIPA',1037,102),(40706,'PUNTA DE BOMBON','ISLAY','AREQUIPA',6477,757),(40801,'COTAHUASI','LA UNION','AREQUIPA',2937,166),(40802,'ALCA','LA UNION','AREQUIPA',2019,191),(40803,'CHARCANA','LA UNION','AREQUIPA',556,163),(40804,'HUAYNACOTAS','LA UNION','AREQUIPA',2251,935),(40805,'PAMPAMARCA','LA UNION','AREQUIPA',1265,787),(40806,'PUYCA','LA UNION','AREQUIPA',2807,1505),(40807,'QUECHUALLA','LA UNION','AREQUIPA',236,135),(40808,'SAYLA','LA UNION','AREQUIPA',574,71),(40809,'TAURIA','LA UNION','AREQUIPA',323,318),(40810,'TOMEPAMPA','LA UNION','AREQUIPA',826,96),(40811,'TORO','LA UNION','AREQUIPA',808,526),(50101,'AYACUCHO','HUAMANGA','AYACUCHO',113380,82),(50102,'ACOCRO','HUAMANGA','AYACUCHO',10199,387),(50103,'ACOS VINCHOS','HUAMANGA','AYACUCHO',5948,155),(50104,'CARMEN ALTO','HUAMANGA','AYACUCHO',21350,21),(50105,'CHIARA','HUAMANGA','AYACUCHO',7163,497),(50106,'OCROS','HUAMANGA','AYACUCHO',5508,203),(50107,'PACAYCASA','HUAMANGA','AYACUCHO',3192,58),(50108,'QUINUA','HUAMANGA','AYACUCHO',6200,121),(50109,'SAN JOSE DE TICLLAS','HUAMANGA','AYACUCHO',3688,65),(50110,'SAN JUAN BAUTISTA','HUAMANGA','AYACUCHO',50429,18),(50111,'SANTIAGO DE PISCHA','HUAMANGA','AYACUCHO',1799,123),(50112,'SOCOS','HUAMANGA','AYACUCHO',7108,82),(50113,'TAMBILLO','HUAMANGA','AYACUCHO',5715,179),(50114,'VINCHOS','HUAMANGA','AYACUCHO',16710,951),(50115,'JESUS NAZARENO','HUAMANGA','AYACUCHO',18054,17),(50201,'CANGALLO','CANGALLO','AYACUCHO',6747,185),(50202,'CHUSCHI','CANGALLO','AYACUCHO',7965,412),(50203,'LOS MOROCHUCOS','CANGALLO','AYACUCHO',8205,249),(50204,'MARIA PARADO DE BELLIDO','CANGALLO','AYACUCHO',2574,131),(50205,'PARAS','CANGALLO','AYACUCHO',4575,780),(50206,'TOTOS','CANGALLO','AYACUCHO',3720,115),(50301,'SANCOS','HUANCA SANCOS','AYACUCHO',3584,1357),(50302,'CARAPO','HUANCA SANCOS','AYACUCHO',2504,196),(50303,'SACSAMARCA','HUANCA SANCOS','AYACUCHO',1613,634),(50304,'SANTIAGO DE LUCANAMARCA','HUANCA SANCOS','AYACUCHO',2638,645),(50401,'HUANTA','HUANTA','AYACUCHO',47373,355),(50402,'AYAHUANCO','HUANTA','AYACUCHO',14485,1076),(50403,'HUAMANGUILLA','HUANTA','AYACUCHO',4981,77),(50404,'IGUAIN','HUANTA','AYACUCHO',3163,71),(50405,'LURICOCHA','HUANTA','AYACUCHO',4991,140),(50406,'SANTILLANA','HUANTA','AYACUCHO',7168,518),(50407,'SIVIA','HUANTA','AYACUCHO',12345,793),(50408,'LLOCHEGUA','HUANTA','AYACUCHO',14047,783),(50501,'SAN MIGUEL','LA MAR','AYACUCHO',17240,809),(50502,'ANCO','LA MAR','AYACUCHO',16875,1062),(50503,'AYNA','LA MAR','AYACUCHO',10560,315),(50504,'CHILCAS','LA MAR','AYACUCHO',3060,154),(50505,'CHUNGUI','LA MAR','AYACUCHO',7287,1047),(50506,'LUIS CARRANZA','LA MAR','AYACUCHO',1838,212),(50507,'SANTA ROSA','LA MAR','AYACUCHO',11286,399),(50508,'TAMBO','LA MAR','AYACUCHO',20567,315),(50601,'PUQUIO','LUCANAS','AYACUCHO',13813,861),(50602,'AUCARA','LUCANAS','AYACUCHO',5433,880),(50603,'CABANA','LUCANAS','AYACUCHO',4489,405),(50604,'CARMEN SALCEDO','LUCANAS','AYACUCHO',3985,463),(50605,'CHAVIÑA','LUCANAS','AYACUCHO',2018,372),(50606,'CHIPAO','LUCANAS','AYACUCHO',3741,1156),(50607,'HUAC-HUAS','LUCANAS','AYACUCHO',2781,312),(50608,'LARAMATE','LUCANAS','AYACUCHO',1443,781),(50609,'LEONCIO PRADO','LUCANAS','AYACUCHO',1374,1112),(50610,'LLAUTA','LUCANAS','AYACUCHO',1145,492),(50611,'LUCANAS','LUCANAS','AYACUCHO',4089,1209),(50612,'OCAÑA','LUCANAS','AYACUCHO',2914,856),(50613,'OTOCA','LUCANAS','AYACUCHO',3020,718),(50614,'SAISA','LUCANAS','AYACUCHO',906,577),(50615,'SAN CRISTOBAL','LUCANAS','AYACUCHO',2105,407),(50616,'SAN JUAN','LUCANAS','AYACUCHO',1559,47),(50617,'SAN PEDRO','LUCANAS','AYACUCHO',3000,729),(50618,'SAN PEDRO DE PALCO','LUCANAS','AYACUCHO',1371,521),(50619,'SANCOS','LUCANAS','AYACUCHO',7236,1505),(50620,'SANTA ANA DE HUAYCAHUACHO','LUCANAS','AYACUCHO',667,45),(50621,'SANTA LUCIA','LUCANAS','AYACUCHO',914,1031),(50701,'CORACORA','PARINACOCHAS','AYACUCHO',15378,1389),(50702,'CHUMPI','PARINACOCHAS','AYACUCHO',2656,372),(50703,'CORONEL CASTAÑEDA','PARINACOCHAS','AYACUCHO',1872,1089),(50704,'PACAPAUSA','PARINACOCHAS','AYACUCHO',2874,147),(50705,'PULLO','PARINACOCHAS','AYACUCHO',4893,1562),(50706,'PUYUSCA','PARINACOCHAS','AYACUCHO',2076,711),(50707,'SAN FRANCISCO DE RAVACAYCO','PARINACOCHAS','AYACUCHO',753,103),(50708,'UPAHUACHO','PARINACOCHAS','AYACUCHO',2740,577),(50801,'PAUSA','PAUCAR DEL SARA SARA','AYACUCHO',2792,251),(50802,'COLTA','PAUCAR DEL SARA SARA','AYACUCHO',1140,248),(50803,'CORCULLA','PAUCAR DEL SARA SARA','AYACUCHO',455,101),(50804,'LAMPA','PAUCAR DEL SARA SARA','AYACUCHO',2528,281),(50805,'MARCABAMBA','PAUCAR DEL SARA SARA','AYACUCHO',773,120),(50806,'OYOLO','PAUCAR DEL SARA SARA','AYACUCHO',1195,792),(50807,'PARARCA','PAUCAR DEL SARA SARA','AYACUCHO',660,56),(50808,'SAN JAVIER DE ALPABAMBA','PAUCAR DEL SARA SARA','AYACUCHO',538,117),(50809,'SAN JOSE DE USHUA','PAUCAR DEL SARA SARA','AYACUCHO',177,29),(50810,'SARA SARA','PAUCAR DEL SARA SARA','AYACUCHO',731,86),(50901,'QUEROBAMBA','SUCRE','AYACUCHO',2733,282),(50902,'BELEN','SUCRE','AYACUCHO',756,37),(50903,'CHALCOS','SUCRE','AYACUCHO',637,55),(50904,'CHILCAYOC','SUCRE','AYACUCHO',575,30),(50905,'HUACAÑA','SUCRE','AYACUCHO',674,144),(50906,'MORCOLLA','SUCRE','AYACUCHO',1074,289),(50907,'PAICO','SUCRE','AYACUCHO',842,95),(50908,'SAN PEDRO DE LARCAY','SUCRE','AYACUCHO',1021,316),(50909,'SAN SALVADOR DE QUIJE','SUCRE','AYACUCHO',1642,126),(50910,'SANTIAGO DE PAUCARAY','SUCRE','AYACUCHO',747,62),(50911,'SORAS','SUCRE','AYACUCHO',1292,352),(51001,'HUANCAPI','VICTOR FAJARDO','AYACUCHO',1934,240),(51002,'ALCAMENCA','VICTOR FAJARDO','AYACUCHO',2414,116),(51003,'APONGO','VICTOR FAJARDO','AYACUCHO',1403,176),(51004,'ASQUIPATA','VICTOR FAJARDO','AYACUCHO',447,71),(51005,'CANARIA','VICTOR FAJARDO','AYACUCHO',3997,264),(51006,'CAYARA','VICTOR FAJARDO','AYACUCHO',1165,63),(51007,'COLCA','VICTOR FAJARDO','AYACUCHO',1014,64),(51008,'HUAMANQUIQUIA','VICTOR FAJARDO','AYACUCHO',1254,72),(51009,'HUANCARAYLLA','VICTOR FAJARDO','AYACUCHO',1077,163),(51010,'HUAYA','VICTOR FAJARDO','AYACUCHO',3241,157),(51011,'SARHUA','VICTOR FAJARDO','AYACUCHO',2763,378),(51012,'VILCANCHOS','VICTOR FAJARDO','AYACUCHO',2674,500),(51101,'VILCAS HUAMAN','VILCAS HUAMAN','AYACUCHO',8369,220),(51102,'ACCOMARCA','VILCAS HUAMAN','AYACUCHO',982,87),(51103,'CARHUANCA','VILCAS HUAMAN','AYACUCHO',1012,54),(51104,'CONCEPCION','VILCAS HUAMAN','AYACUCHO',3100,229),(51105,'HUAMBALPA','VILCAS HUAMAN','AYACUCHO',2168,162),(51106,'INDEPENDENCIA','VILCAS HUAMAN','AYACUCHO',1593,88),(51107,'SAURAMA','VILCAS HUAMAN','AYACUCHO',1292,89),(51108,'VISCHONGO','VILCAS HUAMAN','AYACUCHO',4697,278),(60101,'CAJAMARCA','CAJAMARCA','CAJAMARCA',246536,379),(60102,'ASUNCION','CAJAMARCA','CAJAMARCA',13365,214),(60103,'CHETILLA','CAJAMARCA','CAJAMARCA',4294,74),(60104,'COSPAN','CAJAMARCA','CAJAMARCA',7887,552),(60105,'ENCAÑADA','CAJAMARCA','CAJAMARCA',24190,631),(60106,'JESUS','CAJAMARCA','CAJAMARCA',14703,296),(60107,'LLACANORA','CAJAMARCA','CAJAMARCA',5363,50),(60108,'LOS BAÑOS DEL INCA','CAJAMARCA','CAJAMARCA',42753,283),(60109,'MAGDALENA','CAJAMARCA','CAJAMARCA',9650,209),(60110,'MATARA','CAJAMARCA','CAJAMARCA',3567,63),(60111,'NAMORA','CAJAMARCA','CAJAMARCA',10637,157),(60112,'SAN JUAN','CAJAMARCA','CAJAMARCA',5195,72),(60201,'CAJABAMBA','CAJABAMBA','CAJAMARCA',30603,190),(60202,'CACHACHI','CAJABAMBA','CAJAMARCA',26794,815),(60203,'CONDEBAMBA','CAJABAMBA','CAJAMARCA',13954,199),(60204,'SITACOCHA','CAJABAMBA','CAJAMARCA',8910,584),(60301,'CELENDIN','CELENDIN','CAJAMARCA',28030,407),(60302,'CHUMUCH','CELENDIN','CAJAMARCA',3196,216),(60303,'CORTEGANA','CELENDIN','CAJAMARCA',8819,230),(60304,'HUASMIN','CELENDIN','CAJAMARCA',13611,445),(60305,'JORGE CHAVEZ','CELENDIN','CAJAMARCA',597,54),(60306,'JOSE GALVEZ','CELENDIN','CAJAMARCA',2545,48),(60307,'MIGUEL IGLESIAS','CELENDIN','CAJAMARCA',5556,249),(60308,'OXAMARCA','CELENDIN','CAJAMARCA',6937,285),(60309,'SOROCHUCO','CELENDIN','CAJAMARCA',9892,166),(60310,'SUCRE','CELENDIN','CAJAMARCA',6073,260),(60311,'UTCO','CELENDIN','CAJAMARCA',1408,100),(60312,'LA LIBERTAD DE PALLAN','CELENDIN','CAJAMARCA',8988,187),(60401,'CHOTA','CHOTA','CAJAMARCA',48698,268),(60402,'ANGUIA','CHOTA','CAJAMARCA',4298,150),(60403,'CHADIN','CHOTA','CAJAMARCA',4111,64),(60404,'CHIGUIRIP','CHOTA','CAJAMARCA',4672,49),(60405,'CHIMBAN','CHOTA','CAJAMARCA',3663,145),(60406,'CHOROPAMPA','CHOTA','CAJAMARCA',2663,206),(60407,'COCHABAMBA','CHOTA','CAJAMARCA',6441,119),(60408,'CONCHAN','CHOTA','CAJAMARCA',7015,156),(60409,'HUAMBOS','CHOTA','CAJAMARCA',9508,246),(60410,'LAJAS','CHOTA','CAJAMARCA',12552,123),(60411,'LLAMA','CHOTA','CAJAMARCA',8061,492),(60412,'MIRACOSTA','CHOTA','CAJAMARCA',3910,420),(60413,'PACCHA','CHOTA','CAJAMARCA',5327,106),(60414,'PION','CHOTA','CAJAMARCA',1575,139),(60415,'QUEROCOTO','CHOTA','CAJAMARCA',8968,300),(60416,'SAN JUAN DE LICUPIS','CHOTA','CAJAMARCA',986,201),(60417,'TACABAMBA','CHOTA','CAJAMARCA',20049,191),(60418,'TOCMOCHE','CHOTA','CAJAMARCA',995,216),(60419,'CHALAMARCA','CHOTA','CAJAMARCA',11222,181),(60501,'CONTUMAZA','CONTUMAZA','CAJAMARCA',8499,347),(60502,'CHILETE','CONTUMAZA','CAJAMARCA',2787,131),(60503,'CUPISNIQUE','CONTUMAZA','CAJAMARCA',1471,288),(60504,'GUZMANGO','CONTUMAZA','CAJAMARCA',3130,50),(60505,'SAN BENITO','CONTUMAZA','CAJAMARCA',3823,486),(60506,'SANTA CRUZ DE TOLED','CONTUMAZA','CAJAMARCA',1056,66),(60507,'TANTARICA','CONTUMAZA','CAJAMARCA',3247,147),(60508,'YONAN','CONTUMAZA','CAJAMARCA',7899,546),(60601,'CUTERVO','CUTERVO','CAJAMARCA',56157,426),(60602,'CALLAYUC','CUTERVO','CAJAMARCA',10321,311),(60603,'CHOROS','CUTERVO','CAJAMARCA',3599,260),(60604,'CUJILLO','CUTERVO','CAJAMARCA',3033,103),(60605,'LA RAMADA','CUTERVO','CAJAMARCA',4855,36),(60606,'PIMPINGOS','CUTERVO','CAJAMARCA',5767,169),(60607,'QUEROCOTILLO','CUTERVO','CAJAMARCA',16988,687),(60608,'SAN ANDRES DE CUTERVO','CUTERVO','CAJAMARCA',5259,124),(60609,'SAN JUAN DE CUTERVO','CUTERVO','CAJAMARCA',2005,65),(60610,'SAN LUIS DE LUCMA','CUTERVO','CAJAMARCA',4041,102),(60611,'SANTA CRUZ','CUTERVO','CAJAMARCA',2936,130),(60612,'SANTO DOMINGO DE LA CAPILLA','CUTERVO','CAJAMARCA',5643,105),(60613,'SANTO TOMAS','CUTERVO','CAJAMARCA',7988,229),(60614,'SOCOTA','CUTERVO','CAJAMARCA',10747,154),(60615,'TORIBIO CASANOVA','CUTERVO','CAJAMARCA',1294,127),(60701,'BAMBAMARCA','HUALGAYOC','CAJAMARCA',81731,449),(60702,'CHUGUR','HUALGAYOC','CAJAMARCA',3603,106),(60703,'HUALGAYOC','HUALGAYOC','CAJAMARCA',16994,229),(60801,'JAEN','JAEN','CAJAMARCA',100450,554),(60802,'BELLAVISTA','JAEN','CAJAMARCA',15361,881),(60803,'CHONTALI','JAEN','CAJAMARCA',10235,427),(60804,'COLASAY','JAEN','CAJAMARCA',10577,603),(60805,'HUABAL','JAEN','CAJAMARCA',7056,83),(60806,'LAS PIRIAS','JAEN','CAJAMARCA',4054,59),(60807,'POMAHUACA','JAEN','CAJAMARCA',10078,803),(60808,'PUCARA','JAEN','CAJAMARCA',7657,228),(60809,'SALLIQUE','JAEN','CAJAMARCA',8656,367),(60810,'SAN FELIPE','JAEN','CAJAMARCA',6218,256),(60811,'SAN JOSE DEL ALTO','JAEN','CAJAMARCA',7192,485),(60812,'SANTA ROSA','JAEN','CAJAMARCA',11466,279),(60901,'SAN IGNACIO','SAN IGNACIO','CAJAMARCA',37436,325),(60902,'CHIRINOS','SAN IGNACIO','CAJAMARCA',14299,352),(60903,'HUARANGO','SAN IGNACIO','CAJAMARCA',20614,906),(60904,'LA COIPA','SAN IGNACIO','CAJAMARCA',20882,417),(60905,'NAMBALLE','SAN IGNACIO','CAJAMARCA',11600,693),(60906,'SAN JOSE DE LOURDES','SAN IGNACIO','CAJAMARCA',21847,1359),(60907,'TABACONAS','SAN IGNACIO','CAJAMARCA',21686,813),(61001,'PEDRO GALVEZ','SAN MARCOS','CAJAMARCA',21345,243),(61002,'CHANCAY','SAN MARCOS','CAJAMARCA',3337,67),(61003,'EDUARDO VILLANUEVA','SAN MARCOS','CAJAMARCA',2292,62),(61004,'GREGORIO PITA','SAN MARCOS','CAJAMARCA',6711,216),(61005,'ICHOCAN','SAN MARCOS','CAJAMARCA',1698,69),(61006,'JOSE MANUEL QUIROZ','SAN MARCOS','CAJAMARCA',3988,109),(61007,'JOSE SABOGAL','SAN MARCOS','CAJAMARCA',15115,583),(61101,'SAN MIGUEL','SAN MIGUEL','CAJAMARCA',15885,354),(61102,'BOLIVAR','SAN MIGUEL','CAJAMARCA',1488,65),(61103,'CALQUIS','SAN MIGUEL','CAJAMARCA',4429,336),(61104,'CATILLUC','SAN MIGUEL','CAJAMARCA',3486,203),(61105,'EL PRADO','SAN MIGUEL','CAJAMARCA',1402,70),(61106,'LA FLORIDA','SAN MIGUEL','CAJAMARCA',2205,58),(61107,'LLAPA','SAN MIGUEL','CAJAMARCA',6035,141),(61108,'NANCHOC','SAN MIGUEL','CAJAMARCA',1538,373),(61109,'NIEPOS','SAN MIGUEL','CAJAMARCA',4058,154),(61110,'SAN GREGORIO','SAN MIGUEL','CAJAMARCA',2293,310),(61111,'SAN SILVESTRE DE COCHAN','SAN MIGUEL','CAJAMARCA',4475,135),(61112,'TONGOD','SAN MIGUEL','CAJAMARCA',4857,156),(61113,'UNION AGUA BLANCA','SAN MIGUEL','CAJAMARCA',3594,171),(61201,'SAN PABLO','SAN PABLO','CAJAMARCA',13591,200),(61202,'SAN BERNARDINO','SAN PABLO','CAJAMARCA',4827,166),(61203,'SAN LUIS','SAN PABLO','CAJAMARCA',1276,43),(61204,'TUMBADEN','SAN PABLO','CAJAMARCA',3604,257),(61301,'SANTA CRUZ','SANTA CRUZ','CAJAMARCA',12250,104),(61302,'ANDABAMBA','SANTA CRUZ','CAJAMARCA',1527,8),(61303,'CATACHE','SANTA CRUZ','CAJAMARCA',10010,567),(61304,'CHANCAYBAÑOS','SANTA CRUZ','CAJAMARCA',3905,126),(61305,'LA ESPERANZA','SANTA CRUZ','CAJAMARCA',2601,59),(61306,'NINABAMBA','SANTA CRUZ','CAJAMARCA',2791,57),(61307,'PULAN','SANTA CRUZ','CAJAMARCA',4492,159),(61308,'SAUCEPAMPA','SANTA CRUZ','CAJAMARCA',1871,31),(61309,'SEXI','SANTA CRUZ','CAJAMARCA',566,192),(61310,'UTICYACU','SANTA CRUZ','CAJAMARCA',1614,42),(61311,'YAUYUCAN','SANTA CRUZ','CAJAMARCA',3595,38),(70101,'CALLAO','CALLAO','CALLAO',406889,50),(70102,'BELLAVISTA','CALLAO','CALLAO',71833,5),(70103,'CARMEN DE LA LEGUA Y REYNOSO','CALLAO','CALLAO',41100,2),(70104,'LA PERLA','CALLAO','CALLAO',58817,3),(70105,'LA PUNTA','CALLAO','CALLAO',3392,1),(70106,'VENTANILLA','CALLAO','CALLAO',428284,77),(70107,'MI PERÚ','CALLAO','CALLAO',60977,3),(80101,'CUSCO','CUSCO','CUSCO',118316,101),(80102,'CCORCA','CUSCO','CUSCO',2235,162),(80103,'POROY','CUSCO','CUSCO',7817,13),(80104,'SAN JERONIMO','CUSCO','CUSCO',47101,89),(80105,'SAN SEBASTIAN','CUSCO','CUSCO',115305,77),(80106,'SANTIAGO','CUSCO','CUSCO',90154,59),(80107,'SAYLLA','CUSCO','CUSCO',5389,24),(80108,'WANCHAQ','CUSCO','CUSCO',63778,5),(80201,'ACOMAYO','ACOMAYO','CUSCO',5552,143),(80202,'ACOPIA','ACOMAYO','CUSCO',2379,70),(80203,'ACOS','ACOMAYO','CUSCO',2338,136),(80204,'MOSOC LLACTA','ACOMAYO','CUSCO',2287,44),(80205,'POMACANCHI','ACOMAYO','CUSCO',9020,268),(80206,'RONDOCAN','ACOMAYO','CUSCO',2379,185),(80207,'SANGARARA','ACOMAYO','CUSCO',3738,86),(80301,'ANTA','ANTA','CUSCO',16703,187),(80302,'ANCAHUASI','ANTA','CUSCO',6947,124),(80303,'CACHIMAYO','ANTA','CUSCO',2285,43),(80304,'CHINCHAYPUJIO','ANTA','CUSCO',4303,395),(80305,'HUAROCONDO','ANTA','CUSCO',5762,220),(80306,'LIMATAMBO','ANTA','CUSCO',9801,513),(80307,'MOLLEPATA','ANTA','CUSCO',2600,356),(80308,'PUCYURA','ANTA','CUSCO',4258,34),(80309,'ZURITE','ANTA','CUSCO',3643,60),(80401,'CALCA','CALCA','CUSCO',23316,336),(80402,'COYA','CALCA','CUSCO',4026,71),(80403,'LAMAY','CALCA','CUSCO',5768,96),(80404,'LARES','CALCA','CUSCO',7210,743),(80405,'PISAC','CALCA','CUSCO',10188,147),(80406,'SAN SALVADOR','CALCA','CUSCO',5622,128),(80407,'TARAY','CALCA','CUSCO',4728,54),(80408,'YANATILE','CALCA','CUSCO',13337,1992),(80501,'YANAOCA','CANAS','CUSCO',9976,288),(80502,'CHECCA','CANAS','CUSCO',6302,505),(80503,'KUNTURKANKI','CANAS','CUSCO',5738,393),(80504,'LANGUI','CANAS','CUSCO',2467,170),(80505,'LAYO','CANAS','CUSCO',6333,481),(80506,'PAMPAMARCA','CANAS','CUSCO',2003,31),(80507,'QUEHUE','CANAS','CUSCO',3606,148),(80508,'TUPAC AMARU','CANAS','CUSCO',2868,117),(80601,'SICUANI','CANCHIS','CUSCO',59894,646),(80602,'CHECACUPE','CANCHIS','CUSCO',5000,938),(80603,'COMBAPATA','CANCHIS','CUSCO',5394,173),(80604,'MARANGANI','CANCHIS','CUSCO',11247,439),(80605,'PITUMARCA','CANCHIS','CUSCO',7506,1092),(80606,'SAN PABLO','CANCHIS','CUSCO',4680,524),(80607,'SAN PEDRO','CANCHIS','CUSCO',2804,56),(80608,'TINTA','CANCHIS','CUSCO',5626,82),(80701,'SANTO TOMAS','CHUMBIVILCAS','CUSCO',26564,1899),(80702,'CAPACMARCA','CHUMBIVILCAS','CUSCO',4596,268),(80703,'CHAMACA','CHUMBIVILCAS','CUSCO',8864,672),(80704,'COLQUEMARCA','CHUMBIVILCAS','CUSCO',8579,451),(80705,'LIVITACA','CHUMBIVILCAS','CUSCO',13357,749),(80706,'LLUSCO','CHUMBIVILCAS','CUSCO',7064,312),(80707,'QUIÑOTA','CHUMBIVILCAS','CUSCO',4895,224),(80708,'VELILLE','CHUMBIVILCAS','CUSCO',8492,761),(80801,'ESPINAR','ESPINAR','CUSCO',33242,736),(80802,'CONDOROMA','ESPINAR','CUSCO',1400,516),(80803,'COPORAQUE','ESPINAR','CUSCO',17846,1544),(80804,'OCORURO','ESPINAR','CUSCO',1606,359),(80805,'PALLPATA','ESPINAR','CUSCO',5542,818),(80806,'PICHIGUA','ESPINAR','CUSCO',3603,274),(80807,'SUYCKUTAMBO','ESPINAR','CUSCO',2768,630),(80808,'ALTO PICHIGUA','ESPINAR','CUSCO',3139,359),(80901,'SANTA ANA','LA CONVENCION','CUSCO',34434,375),(80902,'ECHARATE','LA CONVENCION','CUSCO',44983,22178),(80903,'HUAYOPATA','LA CONVENCION','CUSCO',4698,542),(80904,'MARANURA','LA CONVENCION','CUSCO',6058,177),(80905,'OCOBAMBA','LA CONVENCION','CUSCO',6767,850),(80906,'QUELLOUNO','LA CONVENCION','CUSCO',18089,1731),(80907,'KIMBIRI','LA CONVENCION','CUSCO',16865,987),(80908,'SANTA TERESA','LA CONVENCION','CUSCO',6476,1335),(80909,'VILCABAMBA','LA CONVENCION','CUSCO',21159,2958),(80910,'PICHARI','LA CONVENCION','CUSCO',20316,832),(81001,'PARURO','PARURO','CUSCO',3338,152),(81002,'ACCHA','PARURO','CUSCO',3787,239),(81003,'CCAPI','PARURO','CUSCO',3682,326),(81004,'COLCHA','PARURO','CUSCO',1138,141),(81005,'HUANOQUITE','PARURO','CUSCO',5648,362),(81006,'OMACHA','PARURO','CUSCO',7203,427),(81007,'PACCARITAMBO','PARURO','CUSCO',2012,119),(81008,'PILLPINTO','PARURO','CUSCO',1220,78),(81009,'YAURISQUE','PARURO','CUSCO',2473,124),(81101,'PAUCARTAMBO','PAUCARTAMBO','CUSCO',13190,792),(81102,'CAICAY','PAUCARTAMBO','CUSCO',2701,107),(81103,'CHALLABAMBA','PAUCARTAMBO','CUSCO',11264,725),(81104,'COLQUEPATA','PAUCARTAMBO','CUSCO',10662,463),(81105,'HUANCARANI','PAUCARTAMBO','CUSCO',7634,143),(81106,'KOSÑIPATA','PAUCARTAMBO','CUSCO',5609,3670),(81201,'URCOS','QUISPICANCHI','CUSCO',9254,141),(81202,'ANDAHUAYLILLAS','QUISPICANCHI','CUSCO',5465,85),(81203,'CAMANTI','QUISPICANCHI','CUSCO',2094,3183),(81204,'CCARHUAYO','QUISPICANCHI','CUSCO',3129,297),(81205,'CCATCA','QUISPICANCHI','CUSCO',17944,296),(81206,'CUSIPATA','QUISPICANCHI','CUSCO',4770,244),(81207,'HUARO','QUISPICANCHI','CUSCO',4491,107),(81208,'LUCRE','QUISPICANCHI','CUSCO',4000,119),(81209,'MARCAPATA','QUISPICANCHI','CUSCO',4514,1579),(81210,'OCONGATE','QUISPICANCHI','CUSCO',15614,948),(81211,'OROPESA','QUISPICANCHI','CUSCO',7280,78),(81212,'QUIQUIJANA','QUISPICANCHI','CUSCO',10962,364),(81301,'URUBAMBA','URUBAMBA','CUSCO',20879,162),(81302,'CHINCHERO','URUBAMBA','CUSCO',9763,102),(81303,'HUAYLLABAMBA','URUBAMBA','CUSCO',5228,74),(81304,'MACHUPICCHU','URUBAMBA','CUSCO',8332,374),(81305,'MARAS','URUBAMBA','CUSCO',5794,142),(81306,'OLLANTAYTAMBO','URUBAMBA','CUSCO',11225,583),(81307,'YUCAY','URUBAMBA','CUSCO',3299,24),(90101,'HUANCAVELICA','HUANCAVELICA','HUANCAVELICA',40345,508),(90102,'ACOBAMBILLA','HUANCAVELICA','HUANCAVELICA',4593,747),(90103,'ACORIA','HUANCAVELICA','HUANCAVELICA',36373,533),(90104,'CONAYCA','HUANCAVELICA','HUANCAVELICA',1219,42),(90105,'CUENCA','HUANCAVELICA','HUANCAVELICA',1974,55),(90106,'HUACHOCOLPA','HUANCAVELICA','HUANCAVELICA',2883,337),(90107,'HUAYLLAHUARA','HUANCAVELICA','HUANCAVELICA',752,37),(90108,'IZCUCHACA','HUANCAVELICA','HUANCAVELICA',879,12),(90109,'LARIA','HUANCAVELICA','HUANCAVELICA',1440,64),(90110,'MANTA','HUANCAVELICA','HUANCAVELICA',1848,159),(90111,'MARISCAL CACERES','HUANCAVELICA','HUANCAVELICA',1017,10),(90112,'MOYA','HUANCAVELICA','HUANCAVELICA',2479,95),(90113,'NUEVO OCCORO','HUANCAVELICA','HUANCAVELICA',2676,218),(90114,'PALCA','HUANCAVELICA','HUANCAVELICA',3225,81),(90115,'PILCHACA','HUANCAVELICA','HUANCAVELICA',510,40),(90116,'VILCA','HUANCAVELICA','HUANCAVELICA',3051,309),(90117,'YAULI','HUANCAVELICA','HUANCAVELICA',33440,320),(90118,'ASCENSION','HUANCAVELICA','HUANCAVELICA',12252,428),(90119,'HUANDO','HUANCAVELICA','HUANCAVELICA',7638,196),(90201,'ACOBAMBA','ACOBAMBA','HUANCAVELICA',10058,124),(90202,'ANDABAMBA','ACOBAMBA','HUANCAVELICA',5569,82),(90203,'ANTA','ACOBAMBA','HUANCAVELICA',9407,92),(90204,'CAJA','ACOBAMBA','HUANCAVELICA',2818,86),(90205,'MARCAS','ACOBAMBA','HUANCAVELICA',2381,171),(90206,'PAUCARA','ACOBAMBA','HUANCAVELICA',36713,220),(90207,'POMACOCHA','ACOBAMBA','HUANCAVELICA',3936,55),(90208,'ROSARIO','ACOBAMBA','HUANCAVELICA',7752,97),(90301,'LIRCAY','ANGARAES','HUANCAVELICA',24699,830),(90302,'ANCHONGA','ANGARAES','HUANCAVELICA',7966,75),(90303,'CALLANMARCA','ANGARAES','HUANCAVELICA',764,25),(90304,'CCOCHACCASA','ANGARAES','HUANCAVELICA',2737,107),(90305,'CHINCHO','ANGARAES','HUANCAVELICA',3438,173),(90306,'CONGALLA','ANGARAES','HUANCAVELICA',4109,210),(90307,'HUANCA-HUANCA','ANGARAES','HUANCAVELICA',1746,108),(90308,'HUAYLLAY GRANDE','ANGARAES','HUANCAVELICA',2168,32),(90309,'JULCAMARCA','ANGARAES','HUANCAVELICA',1753,51),(90310,'SAN ANTONIO DE ANTAPARCO','ANGARAES','HUANCAVELICA',7514,34),(90311,'SANTO TOMAS DE PATA','ANGARAES','HUANCAVELICA',2610,139),(90312,'SECCLLA','ANGARAES','HUANCAVELICA',3751,162),(90401,'CASTROVIRREYNA','CASTROVIRREYNA','HUANCAVELICA',3248,921),(90402,'ARMA','CASTROVIRREYNA','HUANCAVELICA',1436,301),(90403,'AURAHUA','CASTROVIRREYNA','HUANCAVELICA',2234,345),(90404,'CAPILLAS','CASTROVIRREYNA','HUANCAVELICA',1440,400),(90405,'CHUPAMARCA','CASTROVIRREYNA','HUANCAVELICA',1207,371),(90406,'COCAS','CASTROVIRREYNA','HUANCAVELICA',912,81),(90407,'HUACHOS','CASTROVIRREYNA','HUANCAVELICA',1676,175),(90408,'HUAMATAMBO','CASTROVIRREYNA','HUANCAVELICA',388,59),(90409,'MOLLEPAMPA','CASTROVIRREYNA','HUANCAVELICA',1659,170),(90410,'SAN JUAN','CASTROVIRREYNA','HUANCAVELICA',473,197),(90411,'SANTA ANA','CASTROVIRREYNA','HUANCAVELICA',2157,646),(90412,'TANTARA','CASTROVIRREYNA','HUANCAVELICA',722,111),(90413,'TICRAPO','CASTROVIRREYNA','HUANCAVELICA',1617,182),(90501,'CHURCAMPA','CHURCAMPA','HUANCAVELICA',5479,133),(90502,'ANCO','CHURCAMPA','HUANCAVELICA',11420,270),(90503,'CHINCHIHUASI','CHURCAMPA','HUANCAVELICA',4786,166),(90504,'EL CARMEN','CHURCAMPA','HUANCAVELICA',2998,76),(90505,'LA MERCED','CHURCAMPA','HUANCAVELICA',1834,72),(90506,'LOCROJA','CHURCAMPA','HUANCAVELICA',4048,81),(90507,'PAUCARBAMBA','CHURCAMPA','HUANCAVELICA',7232,103),(90508,'SAN MIGUEL DE MAYOCC','CHURCAMPA','HUANCAVELICA',1261,26),(90509,'SAN PEDRO DE CORIS','CHURCAMPA','HUANCAVELICA',2823,137),(90510,'PACHAMARCA','CHURCAMPA','HUANCAVELICA',2701,157),(90601,'HUAYTARA','HUAYTARA','HUANCAVELICA',2100,393),(90602,'AYAVI','HUAYTARA','HUANCAVELICA',617,180),(90603,'CORDOVA','HUAYTARA','HUANCAVELICA',2826,103),(90604,'HUAYACUNDO ARMA','HUAYTARA','HUANCAVELICA',467,38),(90605,'LARAMARCA','HUAYTARA','HUANCAVELICA',850,208),(90606,'OCOYO','HUAYTARA','HUANCAVELICA',2436,154),(90607,'PILPICHACA','HUAYTARA','HUANCAVELICA',3688,2176),(90608,'QUERCO','HUAYTARA','HUANCAVELICA',1006,682),(90609,'QUITO-ARMA','HUAYTARA','HUANCAVELICA',775,238),(90610,'SAN ANTONIO DE CUSICANCHA','HUAYTARA','HUANCAVELICA',1658,240),(90611,'SAN FRANCISCO DE SANGAYAICO','HUAYTARA','HUANCAVELICA',580,78),(90612,'SAN ISIDRO','HUAYTARA','HUANCAVELICA',1171,169),(90613,'SANTIAGO DE CHOCORVOS','HUAYTARA','HUANCAVELICA',2887,1146),(90614,'SANTIAGO DE QUIRAHUARA','HUAYTARA','HUANCAVELICA',655,177),(90615,'SANTO DOMINGO DE CAPILLAS','HUAYTARA','HUANCAVELICA',983,257),(90616,'TAMBO','HUAYTARA','HUANCAVELICA',322,227),(90701,'PAMPAS','TAYACAJA','HUANCAVELICA',11166,109),(90702,'ACOSTAMBO','TAYACAJA','HUANCAVELICA',4131,162),(90703,'ACRAQUIA','TAYACAJA','HUANCAVELICA',4984,109),(90704,'AHUAYCHA','TAYACAJA','HUANCAVELICA',5497,105),(90705,'COLCABAMBA','TAYACAJA','HUANCAVELICA',18802,579),(90706,'DANIEL HERNANDEZ','TAYACAJA','HUANCAVELICA',10243,105),(90707,'HUACHOCOLPA','TAYACAJA','HUANCAVELICA',6286,278),(90709,'HUARIBAMBA','TAYACAJA','HUANCAVELICA',7850,364),(90710,'ÑAHUIMPUQUIO','TAYACAJA','HUANCAVELICA',1904,67),(90711,'PAZOS','TAYACAJA','HUANCAVELICA',7230,155),(90713,'QUISHUAR','TAYACAJA','HUANCAVELICA',899,33),(90714,'SALCABAMBA','TAYACAJA','HUANCAVELICA',4619,189),(90715,'SALCAHUASI','TAYACAJA','HUANCAVELICA',3345,117),(90716,'SAN MARCOS DE ROCCHAC','TAYACAJA','HUANCAVELICA',2880,288),(90717,'SURCUBAMBA','TAYACAJA','HUANCAVELICA',4897,271),(90718,'TINTAY PUNCU','TAYACAJA','HUANCAVELICA',12975,448),(100101,'HUANUCO','HUANUCO','HUANUCO',76065,98),(100102,'AMARILIS','HUANUCO','HUANUCO',70286,137),(100103,'CHINCHAO','HUANUCO','HUANUCO',25961,1839),(100104,'CHURUBAMBA','HUANUCO','HUANUCO',29599,558),(100105,'MARGOS','HUANUCO','HUANUCO',15029,286),(100106,'QUISQUI','HUANUCO','HUANUCO',7978,160),(100107,'SAN FRANCISCO DE CAYRAN','HUANUCO','HUANUCO',5141,99),(100108,'SAN PEDRO DE CHAULAN','HUANUCO','HUANUCO',7745,279),(100109,'SANTA MARIA DEL VALLE','HUANUCO','HUANUCO',18248,490),(100110,'YARUMAYO','HUANUCO','HUANUCO',2881,63),(100111,'PILLCO MARCA','HUANUCO','HUANUCO',51515,69),(100201,'AMBO','AMBO','HUANUCO',17138,288),(100202,'CAYNA','AMBO','HUANUCO',3528,156),(100203,'COLPAS','AMBO','HUANUCO',2513,185),(100204,'CONCHAMARCA','AMBO','HUANUCO',6822,108),(100205,'HUACAR','AMBO','HUANUCO',7643,238),(100206,'SAN FRANCISCO','AMBO','HUANUCO',3327,118),(100207,'SAN RAFAEL','AMBO','HUANUCO',12186,441),(100208,'TOMAY KICHWA','AMBO','HUANUCO',4082,43),(100301,'LA UNION','DOS DE MAYO','HUANUCO',6332,169),(100307,'CHUQUIS','DOS DE MAYO','HUANUCO',5894,153),(100311,'MARIAS','DOS DE MAYO','HUANUCO',9538,616),(100313,'PACHAS','DOS DE MAYO','HUANUCO',13039,268),(100316,'QUIVILLA','DOS DE MAYO','HUANUCO',3035,34),(100317,'RIPAN','DOS DE MAYO','HUANUCO',7050,76),(100321,'SHUNQUI','DOS DE MAYO','HUANUCO',2520,33),(100322,'SILLAPATA','DOS DE MAYO','HUANUCO',2549,71),(100323,'YANAS','DOS DE MAYO','HUANUCO',3367,37),(100401,'HUACAYBAMBA','HUACAYBAMBA','HUANUCO',7245,562),(100402,'CANCHABAMBA','HUACAYBAMBA','HUANUCO',3301,186),(100403,'COCHABAMBA','HUACAYBAMBA','HUANUCO',3478,722),(100404,'PINRA','HUACAYBAMBA','HUANUCO',8819,295),(100501,'LLATA','HUAMALIES','HUANUCO',15059,412),(100502,'ARANCAY','HUAMALIES','HUANUCO',1513,118),(100503,'CHAVIN DE PARIARCA','HUAMALIES','HUANUCO',3846,92),(100504,'JACAS GRANDE','HUAMALIES','HUANUCO',5916,223),(100505,'JIRCAN','HUAMALIES','HUANUCO',3569,251),(100506,'MIRAFLORES','HUAMALIES','HUANUCO',3565,97),(100507,'MONZON','HUAMALIES','HUANUCO',28605,1397),(100508,'PUNCHAO','HUAMALIES','HUANUCO',2536,40),(100509,'PUÑOS','HUAMALIES','HUANUCO',4412,97),(100510,'SINGA','HUAMALIES','HUANUCO',3482,162),(100511,'TANTAMAYO','HUAMALIES','HUANUCO',3002,279),(100601,'RUPA-RUPA','LEONCIO PRADO','HUANUCO',63764,369),(100602,'DANIEL ALOMIAS ROBLES','LEONCIO PRADO','HUANUCO',7775,780),(100603,'HERMILIO VALDIZAN','LEONCIO PRADO','HUANUCO',4101,129),(100604,'JOSE CRESPO Y CASTILLO','LEONCIO PRADO','HUANUCO',38423,2791),(100605,'LUYANDO','LEONCIO PRADO','HUANUCO',9851,113),(100606,'MARIANO DAMASO BERAUN','LEONCIO PRADO','HUANUCO',9586,742),(100701,'HUACRACHUCO','MARAÑON','HUANUCO',15793,703),(100702,'CHOLON','MARAÑON','HUANUCO',13643,4087),(100703,'SAN BUENAVENTURA','MARAÑON','HUANUCO',2682,89),(100801,'PANAO','PACHITEA','HUANUCO',24223,1614),(100802,'CHAGLLA','PACHITEA','HUANUCO',11768,638),(100803,'MOLINO','PACHITEA','HUANUCO',14840,238),(100804,'UMARI','PACHITEA','HUANUCO',21398,157),(100901,'PUERTO INCA','PUERTO INCA','HUANUCO',7784,2227),(100902,'CODO DEL POZUZO','PUERTO INCA','HUANUCO',6603,3222),(100903,'HONORIA','PUERTO INCA','HUANUCO',6303,813),(100904,'TOURNAVISTA','PUERTO INCA','HUANUCO',4585,1621),(100905,'YUYAPICHIS','PUERTO INCA','HUANUCO',6154,1932),(101001,'JESUS','LAURICOCHA','HUANUCO',5786,456),(101002,'BAÑOS','LAURICOCHA','HUANUCO',7035,193),(101003,'JIVIA','LAURICOCHA','HUANUCO',2795,62),(101004,'QUEROPALCA','LAURICOCHA','HUANUCO',2944,133),(101005,'RONDOS','LAURICOCHA','HUANUCO',7648,172),(101006,'SAN FRANCISCO DE ASIS','LAURICOCHA','HUANUCO',2173,85),(101007,'SAN MIGUEL DE CAURI','LAURICOCHA','HUANUCO',10286,822),(101101,'CHAVINILLO','YAROWILCA','HUANUCO',5992,208),(101102,'CAHUAC','YAROWILCA','HUANUCO',4635,30),(101103,'CHACABAMBA','YAROWILCA','HUANUCO',3679,17),(101104,'APARICIO POMARES','YAROWILCA','HUANUCO',5594,187),(101105,'JACAS CHICO','YAROWILCA','HUANUCO',2045,69),(101106,'OBAS','YAROWILCA','HUANUCO',5528,125),(101107,'PAMPAMARCA','YAROWILCA','HUANUCO',2071,74),(101108,'CHORAS','YAROWILCA','HUANUCO',3691,62),(110101,'ICA','ICA','ICA',131003,886),(110102,'LA TINGUIÑA','ICA','ICA',35641,81),(110103,'LOS AQUIJES','ICA','ICA',19259,92),(110104,'OCUCAJE','ICA','ICA',3745,1402),(110105,'PACHACUTEC','ICA','ICA',6729,41),(110106,'PARCONA','ICA','ICA',54747,18),(110107,'PUEBLO NUEVO','ICA','ICA',4784,29),(110108,'SALAS','ICA','ICA',23504,657),(110109,'SAN JOSE DE LOS MOLINOS','ICA','ICA',6235,362),(110110,'SAN JUAN BAUTISTA','ICA','ICA',14663,31),(110111,'SANTIAGO','ICA','ICA',29117,2772),(110112,'SUBTANJALLA','ICA','ICA',27706,186),(110113,'TATE','ICA','ICA',4574,7),(110114,'YAUCA DEL ROSARIO','ICA','ICA',986,1263),(110201,'CHINCHA ALTA','CHINCHA','ICA',63671,226),(110202,'ALTO LARAN','CHINCHA','ICA',7387,364),(110203,'CHAVIN','CHINCHA','ICA',1417,426),(110204,'CHINCHA BAJA','CHINCHA','ICA',12323,73),(110205,'EL CARMEN','CHINCHA','ICA',13296,752),(110206,'GROCIO PRADO','CHINCHA','ICA',24049,177),(110207,'PUEBLO NUEVO','CHINCHA','ICA',61078,211),(110208,'SAN JUAN DE YANAC','CHINCHA','ICA',316,439),(110209,'SAN PEDRO DE HUACARPANA','CHINCHA','ICA',1660,206),(110210,'SUNAMPE','CHINCHA','ICA',27496,16),(110211,'TAMBO DE MORA','CHINCHA','ICA',4990,11),(110301,'NAZCA','NAZCA','ICA',26719,1144),(110302,'CHANGUILLO','NAZCA','ICA',1537,957),(110303,'EL INGENIO','NAZCA','ICA',2702,612),(110304,'MARCONA','NAZCA','ICA',12403,1945),(110305,'VISTA ALEGRE','NAZCA','ICA',15419,534),(110401,'PALPA','PALPA','ICA',7195,132),(110402,'LLIPATA','PALPA','ICA',1497,182),(110403,'RIO GRANDE','PALPA','ICA',2268,315),(110404,'SANTA CRUZ','PALPA','ICA',988,254),(110405,'TIBILLO','PALPA','ICA',331,337),(110501,'PISCO','PISCO','ICA',53887,23),(110502,'HUANCANO','PISCO','ICA',1594,900),(110503,'HUMAY','PISCO','ICA',5869,912),(110504,'INDEPENDENCIA','PISCO','ICA',14390,269),(110505,'PARACAS','PISCO','ICA',7009,1427),(110506,'SAN ANDRES','PISCO','ICA',13539,232),(110507,'SAN CLEMENTE','PISCO','ICA',21796,134),(110508,'TUPAC AMARU INCA','PISCO','ICA',17651,56),(120101,'HUANCAYO','HUANCAYO','JUNIN',116953,224),(120104,'CARHUACALLANGA','HUANCAYO','JUNIN',1337,13),(120105,'CHACAPAMPA','HUANCAYO','JUNIN',888,126),(120106,'CHICCHE','HUANCAYO','JUNIN',968,42),(120107,'CHILCA','HUANCAYO','JUNIN',85628,29),(120108,'CHONGOS ALTO','HUANCAYO','JUNIN',1389,702),(120111,'CHUPURO','HUANCAYO','JUNIN',1778,40),(120112,'COLCA','HUANCAYO','JUNIN',2053,111),(120113,'CULLHUAS','HUANCAYO','JUNIN',2247,111),(120114,'EL TAMBO','HUANCAYO','JUNIN',161429,167),(120116,'HUACRAPUQUIO','HUANCAYO','JUNIN',1284,24),(120117,'HUALHUAS','HUANCAYO','JUNIN',4488,14),(120119,'HUANCAN','HUANCAYO','JUNIN',20835,10),(120120,'HUASICANCHA','HUANCAYO','JUNIN',859,52),(120121,'HUAYUCACHI','HUANCAYO','JUNIN',8558,14),(120122,'INGENIO','HUANCAYO','JUNIN',2503,53),(120124,'PARIAHUANCA','HUANCAYO','JUNIN',5941,581),(120125,'PILCOMAYO','HUANCAYO','JUNIN',16443,10),(120126,'PUCARA','HUANCAYO','JUNIN',5063,110),(120127,'QUICHUAY','HUANCAYO','JUNIN',1757,31),(120128,'QUILCAS','HUANCAYO','JUNIN',4186,161),(120129,'SAN AGUSTIN','HUANCAYO','JUNIN',11607,26),(120130,'SAN JERONIMO DE TUNAN','HUANCAYO','JUNIN',10203,22),(120132,'SAÑO','HUANCAYO','JUNIN',4026,13),(120133,'SAPALLANGA','HUANCAYO','JUNIN',12769,124),(120134,'SICAYA','HUANCAYO','JUNIN',7988,41),(120135,'SANTO DOMINGO DE ACOBAMBA','HUANCAYO','JUNIN',7737,878),(120136,'VIQUES','HUANCAYO','JUNIN',2222,6),(120201,'CONCEPCION','CONCEPCION','JUNIN',14756,18),(120202,'ACO','CONCEPCION','JUNIN',1642,38),(120203,'ANDAMARCA','CONCEPCION','JUNIN',4638,505),(120204,'CHAMBARA','CONCEPCION','JUNIN',2868,100),(120205,'COCHAS','CONCEPCION','JUNIN',1829,109),(120206,'COMAS','CONCEPCION','JUNIN',6258,951),(120207,'HEROINAS TOLEDO','CONCEPCION','JUNIN',1222,26),(120208,'MANZANARES','CONCEPCION','JUNIN',1401,17),(120209,'MARISCAL CASTILLA','CONCEPCION','JUNIN',1633,56),(120210,'MATAHUASI','CONCEPCION','JUNIN',5114,23),(120211,'MITO','CONCEPCION','JUNIN',1372,25),(120212,'NUEVE DE JULIO','CONCEPCION','JUNIN',1522,7),(120213,'ORCOTUNA','CONCEPCION','JUNIN',4135,45),(120214,'SAN JOSE DE QUERO','CONCEPCION','JUNIN',6080,312),(120215,'SANTA ROSA DE OCOPA','CONCEPCION','JUNIN',2025,16),(120301,'CHANCHAMAYO','CHANCHAMAYO','JUNIN',24675,761),(120302,'PERENE','CHANCHAMAYO','JUNIN',74699,1520),(120303,'PICHANAQUI','CHANCHAMAYO','JUNIN',68551,1236),(120304,'SAN LUIS DE SHUARO','CHANCHAMAYO','JUNIN',7233,161),(120305,'SAN RAMON','CHANCHAMAYO','JUNIN',27011,623),(120306,'VITOC','CHANCHAMAYO','JUNIN',1866,372),(120401,'JAUJA','JAUJA','JUNIN',14717,9),(120402,'ACOLLA','JAUJA','JUNIN',7343,121),(120403,'APATA','JAUJA','JUNIN',4198,419),(120404,'ATAURA','JAUJA','JUNIN',1161,6),(120405,'CANCHAYLLO','JAUJA','JUNIN',1658,945),(120406,'CURICACA','JAUJA','JUNIN',1645,66),(120407,'EL MANTARO','JAUJA','JUNIN',2541,21),(120408,'HUAMALI','JAUJA','JUNIN',1815,20),(120409,'HUARIPAMPA','JAUJA','JUNIN',867,20),(120410,'HUERTAS','JAUJA','JUNIN',1664,12),(120411,'JANJAILLO','JAUJA','JUNIN',717,32),(120412,'JULCAN','JAUJA','JUNIN',697,19),(120413,'LEONOR ORDOÑEZ','JAUJA','JUNIN',1492,21),(120414,'LLOCLLAPAMPA','JAUJA','JUNIN',1058,110),(120415,'MARCO','JAUJA','JUNIN',1659,29),(120416,'MASMA','JAUJA','JUNIN',2069,15),(120417,'MASMA CHICCHE','JAUJA','JUNIN',777,34),(120418,'MOLINOS','JAUJA','JUNIN',1558,315),(120419,'MONOBAMBA','JAUJA','JUNIN',1101,961),(120420,'MUQUI','JAUJA','JUNIN',966,11),(120421,'MUQUIYAUYO','JAUJA','JUNIN',2216,21),(120422,'PACA','JAUJA','JUNIN',1027,33),(120423,'PACCHA','JAUJA','JUNIN',1841,89),(120424,'PANCAN','JAUJA','JUNIN',1285,11),(120425,'PARCO','JAUJA','JUNIN',1208,34),(120426,'POMACANCHA','JAUJA','JUNIN',1980,284),(120427,'RICRAN','JAUJA','JUNIN',1626,320),(120428,'SAN LORENZO','JAUJA','JUNIN',2447,22),(120429,'SAN PEDRO DE CHUNAN','JAUJA','JUNIN',854,9),(120430,'SAUSA','JAUJA','JUNIN',3009,5),(120431,'SINCOS','JAUJA','JUNIN',4795,233),(120432,'TUNAN MARCA','JAUJA','JUNIN',1196,33),(120433,'YAULI','JAUJA','JUNIN',1353,93),(120434,'YAUYOS','JAUJA','JUNIN',9256,14),(120501,'JUNIN','JUNIN','JUNIN',9893,869),(120502,'CARHUAMAYO','JUNIN','JUNIN',7784,205),(120503,'ONDORES','JUNIN','JUNIN',1965,558),(120504,'ULCUMAYO','JUNIN','JUNIN',5840,994),(120601,'SATIPO','SATIPO','JUNIN',41939,816),(120602,'COVIRIALI','SATIPO','JUNIN',6101,97),(120603,'LLAYLLA','SATIPO','JUNIN',6168,309),(120604,'MAZAMARI','SATIPO','JUNIN',63429,2035),(120605,'PAMPA HERMOSA','SATIPO','JUNIN',10414,947),(120606,'PANGOA','SATIPO','JUNIN',59841,4244),(120607,'RIO NEGRO','SATIPO','JUNIN',28301,488),(120608,'RIO TAMBO','SATIPO','JUNIN',58417,10284),(120701,'TARMA','TARMA','JUNIN',46281,454),(120702,'ACOBAMBA','TARMA','JUNIN',13419,108),(120703,'HUARICOLCA','TARMA','JUNIN',3212,163),(120704,'HUASAHUASI','TARMA','JUNIN',15239,634),(120705,'LA UNION','TARMA','JUNIN',3225,143),(120706,'PALCA','TARMA','JUNIN',5674,328),(120707,'PALCAMAYO','TARMA','JUNIN',9305,169),(120708,'SAN PEDRO DE CAJAS','TARMA','JUNIN',5633,512),(120709,'TAPO','TARMA','JUNIN',5988,153),(120801,'LA OROYA','YAULI','JUNIN',13637,380),(120802,'CHACAPALPA','YAULI','JUNIN',737,186),(120803,'HUAY-HUAY','YAULI','JUNIN',1494,192),(120804,'MARCAPOMACOCHA','YAULI','JUNIN',1287,885),(120805,'MOROCOCHA','YAULI','JUNIN',4432,265),(120806,'PACCHA','YAULI','JUNIN',1669,324),(120807,'SANTA BARBARA DE CARHUACAYAN','YAULI','JUNIN',2292,680),(120808,'SANTA ROSA DE SACCO','YAULI','JUNIN',10421,100),(120809,'SUITUCANCHA','YAULI','JUNIN',990,214),(120810,'YAULI','YAULI','JUNIN',5211,412),(120901,'CHUPACA','CHUPACA','JUNIN',21952,23),(120902,'AHUAC','CHUPACA','JUNIN',5968,72),(120903,'CHONGOS BAJO','CHUPACA','JUNIN',4031,104),(120904,'HUACHAC','CHUPACA','JUNIN',3946,20),(120905,'HUAMANCACA CHICO','CHUPACA','JUNIN',5912,13),(120906,'SAN JUAN DE YSCOS','CHUPACA','JUNIN',2135,26),(120907,'SAN JUAN DE JARPA','CHUPACA','JUNIN',3569,128),(120908,'TRES DE DICIEMBRE','CHUPACA','JUNIN',2092,16),(120909,'YANACANCHA','CHUPACA','JUNIN',3475,762),(130101,'TRUJILLO','TRUJILLO','LA LIBERTAD',318914,39),(130102,'EL PORVENIR','TRUJILLO','LA LIBERTAD',186127,38),(130103,'FLORENCIA DE MORA','TRUJILLO','LA LIBERTAD',41914,3),(130104,'HUANCHACO','TRUJILLO','LA LIBERTAD',68104,318),(130105,'LA ESPERANZA','TRUJILLO','LA LIBERTAD',182494,20),(130106,'LAREDO','TRUJILLO','LA LIBERTAD',35289,491),(130107,'MOCHE','TRUJILLO','LA LIBERTAD',34503,28),(130108,'POROTO','TRUJILLO','LA LIBERTAD',3195,126),(130109,'SALAVERRY','TRUJILLO','LA LIBERTAD',18129,290),(130110,'SIMBAL','TRUJILLO','LA LIBERTAD',4317,389),(130111,'VICTOR LARCO HERRERA','TRUJILLO','LA LIBERTAD',64024,12),(130201,'ASCOPE','ASCOPE','LA LIBERTAD',6677,289),(130202,'CHICAMA','ASCOPE','LA LIBERTAD',15492,897),(130203,'CHOCOPE','ASCOPE','LA LIBERTAD',9413,101),(130204,'MAGDALENA DE CAO','ASCOPE','LA LIBERTAD',3232,156),(130205,'PAIJAN','ASCOPE','LA LIBERTAD',25584,82),(130206,'RAZURI','ASCOPE','LA LIBERTAD',9079,313),(130207,'SANTIAGO DE CAO','ASCOPE','LA LIBERTAD',19660,130),(130208,'CASA GRANDE','ASCOPE','LA LIBERTAD',31174,674),(130301,'BOLIVAR','BOLIVAR','LA LIBERTAD',4838,734),(130302,'BAMBAMARCA','BOLIVAR','LA LIBERTAD',3868,165),(130303,'CONDORMARCA','BOLIVAR','LA LIBERTAD',2063,324),(130304,'LONGOTEA','BOLIVAR','LA LIBERTAD',2232,189),(130305,'UCHUMARCA','BOLIVAR','LA LIBERTAD',2759,234),(130306,'UCUNCHA','BOLIVAR','LA LIBERTAD',815,99),(130401,'CHEPEN','CHEPEN','LA LIBERTAD',48563,289),(130402,'PACANGA','CHEPEN','LA LIBERTAD',23643,586),(130403,'PUEBLO NUEVO','CHEPEN','LA LIBERTAD',14805,271),(130501,'JULCAN','JULCAN','LA LIBERTAD',11662,184),(130502,'CALAMARCA','JULCAN','LA LIBERTAD',5657,208),(130503,'CARABAMBA','JULCAN','LA LIBERTAD',6518,280),(130504,'HUASO','JULCAN','LA LIBERTAD',7253,439),(130601,'OTUZCO','OTUZCO','LA LIBERTAD',27257,444),(130602,'AGALLPAMPA','OTUZCO','LA LIBERTAD',9859,257),(130604,'CHARAT','OTUZCO','LA LIBERTAD',2847,65),(130605,'HUARANCHAL','OTUZCO','LA LIBERTAD',5077,126),(130606,'LA CUESTA','OTUZCO','LA LIBERTAD',687,41),(130608,'MACHE','OTUZCO','LA LIBERTAD',3112,38),(130610,'PARANDAY','OTUZCO','LA LIBERTAD',730,22),(130611,'SALPO','OTUZCO','LA LIBERTAD',6142,196),(130613,'SINSICAP','OTUZCO','LA LIBERTAD',8619,453),(130614,'USQUIL','OTUZCO','LA LIBERTAD',27383,445),(130701,'SAN PEDRO DE LLOC','PACASMAYO','LA LIBERTAD',16519,679),(130702,'GUADALUPE','PACASMAYO','LA LIBERTAD',43965,166),(130703,'JEQUETEPEQUE','PACASMAYO','LA LIBERTAD',3808,49),(130704,'PACASMAYO','PACASMAYO','LA LIBERTAD',27434,35),(130705,'SAN JOSE','PACASMAYO','LA LIBERTAD',12259,179),(130801,'TAYABAMBA','PATAZ','LA LIBERTAD',14586,338),(130802,'BULDIBUYO','PATAZ','LA LIBERTAD',3763,229),(130803,'CHILLIA','PATAZ','LA LIBERTAD',13402,306),(130804,'HUANCASPATA','PATAZ','LA LIBERTAD',6390,242),(130805,'HUAYLILLAS','PATAZ','LA LIBERTAD',3518,92),(130806,'HUAYO','PATAZ','LA LIBERTAD',4373,126),(130807,'ONGON','PATAZ','LA LIBERTAD',1761,1308),(130808,'PARCOY','PATAZ','LA LIBERTAD',21784,323),(130809,'PATAZ','PATAZ','LA LIBERTAD',8804,394),(130810,'PIAS','PATAZ','LA LIBERTAD',1316,270),(130811,'SANTIAGO DE CHALLAS','PATAZ','LA LIBERTAD',2533,129),(130812,'TAURIJA','PATAZ','LA LIBERTAD',3004,130),(130813,'URPAY','PATAZ','LA LIBERTAD',2804,102),(130901,'HUAMACHUCO','SANCHEZ CARRION','LA LIBERTAD',62424,415),(130902,'CHUGAY','SANCHEZ CARRION','LA LIBERTAD',18753,417),(130903,'COCHORCO','SANCHEZ CARRION','LA LIBERTAD',9340,262),(130904,'CURGOS','SANCHEZ CARRION','LA LIBERTAD',8526,98),(130905,'MARCABAL','SANCHEZ CARRION','LA LIBERTAD',16698,234),(130906,'SANAGORAN','SANCHEZ CARRION','LA LIBERTAD',14859,338),(130907,'SARIN','SANCHEZ CARRION','LA LIBERTAD',9945,334),(130908,'SARTIMBAMBA','SANCHEZ CARRION','LA LIBERTAD',13691,397),(131001,'SANTIAGO DE CHUCO','SANTIAGO DE CHUCO','LA LIBERTAD',20372,1078),(131002,'ANGASMARCA','SANTIAGO DE CHUCO','LA LIBERTAD',7266,152),(131003,'CACHICADAN','SANTIAGO DE CHUCO','LA LIBERTAD',7964,269),(131004,'MOLLEBAMBA','SANTIAGO DE CHUCO','LA LIBERTAD',2312,69),(131005,'MOLLEPATA','SANTIAGO DE CHUCO','LA LIBERTAD',2666,69),(131006,'QUIRUVILCA','SANTIAGO DE CHUCO','LA LIBERTAD',14295,552),(131007,'SANTA CRUZ DE CHUCA','SANTIAGO DE CHUCO','LA LIBERTAD',3187,165),(131008,'SITABAMBA','SANTIAGO DE CHUCO','LA LIBERTAD',3412,319),(131101,'CASCAS','GRAN CHIMU','LA LIBERTAD',14187,475),(131102,'LUCMA','GRAN CHIMU','LA LIBERTAD',6896,295),(131103,'COMPIN','GRAN CHIMU','LA LIBERTAD',2118,301),(131104,'SAYAPULLO','GRAN CHIMU','LA LIBERTAD',7908,236),(131201,'VIRU','VIRU','LA LIBERTAD',67228,1084),(131202,'CHAO','VIRU','LA LIBERTAD',40272,1672),(131203,'GUADALUPITO','VIRU','LA LIBERTAD',9588,426),(140101,'CHICLAYO','CHICLAYO','LAMBAYEQUE',291777,50),(140102,'CHONGOYAPE','CHICLAYO','LAMBAYEQUE',17940,723),(140103,'ETEN','CHICLAYO','LAMBAYEQUE',10571,84),(140104,'ETEN PUERTO','CHICLAYO','LAMBAYEQUE',2167,13),(140105,'JOSE LEONARDO ORTIZ','CHICLAYO','LAMBAYEQUE',193232,29),(140106,'LA VICTORIA','CHICLAYO','LAMBAYEQUE',90546,41),(140107,'LAGUNAS','CHICLAYO','LAMBAYEQUE',10234,429),(140108,'MONSEFU','CHICLAYO','LAMBAYEQUE',31847,45),(140109,'NUEVA ARICA','CHICLAYO','LAMBAYEQUE',2338,212),(140110,'OYOTUN','CHICLAYO','LAMBAYEQUE',9854,486),(140111,'PICSI','CHICLAYO','LAMBAYEQUE',9782,53),(140112,'PIMENTEL','CHICLAYO','LAMBAYEQUE',44285,65),(140113,'REQUE','CHICLAYO','LAMBAYEQUE',14942,46),(140114,'SANTA ROSA','CHICLAYO','LAMBAYEQUE',12687,13),(140115,'SAÑA','CHICLAYO','LAMBAYEQUE',12288,311),(140116,'CAYALTI','CHICLAYO','LAMBAYEQUE',15967,163),(140117,'PATAPO','CHICLAYO','LAMBAYEQUE',22452,181),(140118,'POMALCA','CHICLAYO','LAMBAYEQUE',25323,78),(140119,'PUCALA','CHICLAYO','LAMBAYEQUE',8979,177),(140120,'TUMAN','CHICLAYO','LAMBAYEQUE',30194,124),(140201,'FERREÑAFE','FERREÑAFE','LAMBAYEQUE',35360,61),(140202,'CAÑARIS','FERREÑAFE','LAMBAYEQUE',14516,287),(140203,'INCAHUASI','FERREÑAFE','LAMBAYEQUE',15518,438),(140204,'MANUEL ANTONIO MESONES MURO','FERREÑAFE','LAMBAYEQUE',4230,211),(140205,'PITIPO','FERREÑAFE','LAMBAYEQUE',23572,550),(140206,'PUEBLO NUEVO','FERREÑAFE','LAMBAYEQUE',13404,31),(140301,'LAMBAYEQUE','LAMBAYEQUE','LAMBAYEQUE',77234,328),(140302,'CHOCHOPE','LAMBAYEQUE','LAMBAYEQUE',1139,78),(140303,'ILLIMO','LAMBAYEQUE','LAMBAYEQUE',9328,25),(140304,'JAYANCA','LAMBAYEQUE','LAMBAYEQUE',17523,685),(140305,'MOCHUMI','LAMBAYEQUE','LAMBAYEQUE',19158,103),(140306,'MORROPE','LAMBAYEQUE','LAMBAYEQUE',46046,1046),(140307,'MOTUPE','LAMBAYEQUE','LAMBAYEQUE',26409,556),(140308,'OLMOS','LAMBAYEQUE','LAMBAYEQUE',40642,5326),(140309,'PACORA','LAMBAYEQUE','LAMBAYEQUE',7190,89),(140310,'SALAS','LAMBAYEQUE','LAMBAYEQUE',12999,998),(140311,'SAN JOSE','LAMBAYEQUE','LAMBAYEQUE',16172,45),(140312,'TUCUME','LAMBAYEQUE','LAMBAYEQUE',22805,63),(150101,'LIMA','LIMA','LIMA',271814,21),(150102,'ANCON','LIMA','LIMA',0,382),(150103,'ATE','LIMA','LIMA',0,86),(150104,'BARRANCO','LIMA','LIMA',0,984),(150105,'BREÑA','LIMA','LIMA',0,925),(150106,'CARABAYLLO','LIMA','LIMA',0,978),(150107,'CHACLACAYO','LIMA','LIMA',0,428),(150108,'CHORRILLOS','LIMA','LIMA',0,547),(150109,'CIENEGUILLA','LIMA','LIMA',0,80),(150110,'COMAS','LIMA','LIMA',0,894),(150111,'EL AGUSTINO','LIMA','LIMA',0,365),(150112,'INDEPENDENCIA','LIMA','LIMA',0,822),(150113,'JESUS MARIA','LIMA','LIMA',0,589),(150114,'LA MOLINA','LIMA','LIMA',0,646),(150115,'LA VICTORIA','LIMA','LIMA',0,779),(150116,'LINCE','LIMA','LIMA',0,228),(150117,'LOS OLIVOS','LIMA','LIMA',0,229),(150118,'LURIGANCHO','LIMA','LIMA',0,976),(150119,'LURIN','LIMA','LIMA',0,132),(150120,'MAGDALENA DEL MAR','LIMA','LIMA',0,656),(150121,'PUEBLO LIBRE','LIMA','LIMA',0,114),(150122,'MIRAFLORES','LIMA','LIMA',0,932),(150123,'PACHACAMAC','LIMA','LIMA',0,653),(150124,'PUCUSANA','LIMA','LIMA',0,44),(150125,'PUENTE PIEDRA','LIMA','LIMA',0,327),(150126,'PUNTA HERMOSA','LIMA','LIMA',0,609),(150127,'PUNTA NEGRA','LIMA','LIMA',0,934),(150128,'RIMAC','LIMA','LIMA',0,911),(150129,'SAN BARTOLO','LIMA','LIMA',0,699),(150130,'SAN BORJA','LIMA','LIMA',0,928),(150131,'SAN ISIDRO','LIMA','LIMA',0,206),(150132,'SAN JUAN DE LURIGANCHO','LIMA','LIMA',0,91),(150133,'SAN JUAN DE MIRAFLORES','LIMA','LIMA',0,1),(150134,'SAN LUIS','LIMA','LIMA',0,600),(150135,'SAN MARTIN DE PORRES','LIMA','LIMA',0,177),(150136,'SAN MIGUEL','LIMA','LIMA',0,506),(150137,'SANTA ANITA','LIMA','LIMA',0,422),(150138,'SANTA MARIA DEL MAR','LIMA','LIMA',0,608),(150139,'SANTA ROSA','LIMA','LIMA',0,751),(150140,'SANTIAGO DE SURCO','LIMA','LIMA',0,242),(150141,'SURQUILLO','LIMA','LIMA',0,346),(150142,'VILLA EL SALVADOR','LIMA','LIMA',0,14),(150143,'VILLA MARIA DEL TRIUNFO','LIMA','LIMA',0,545),(150201,'BARRANCA','BARRANCA','LIMA',70430,160),(150202,'PARAMONGA','BARRANCA','LIMA',22387,414),(150203,'PATIVILCA','BARRANCA','LIMA',19272,268),(150204,'SUPE','BARRANCA','LIMA',22543,15),(150205,'SUPE PUERTO','BARRANCA','LIMA',11609,519),(150301,'CAJATAMBO','CAJATAMBO','LIMA',2281,582),(150302,'COPA','CAJATAMBO','LIMA',841,204),(150303,'GORGOR','CAJATAMBO','LIMA',2683,308),(150304,'HUANCAPON','CAJATAMBO','LIMA',1030,151),(150305,'MANAS','CAJATAMBO','LIMA',993,282),(150401,'CANTA','CANTA','LIMA',2794,136),(150402,'ARAHUAY','CANTA','LIMA',750,136),(150403,'HUAMANTANGA','CANTA','LIMA',1300,494),(150404,'HUAROS','CANTA','LIMA',776,327),(150405,'LACHAQUI','CANTA','LIMA',878,129),(150406,'SAN BUENAVENTURA','CANTA','LIMA',526,109),(150407,'SANTA ROSA DE QUIVES','CANTA','LIMA',8098,311),(150501,'SAN VICENTE DE CAÑETE','CAÑETE','LIMA',55824,519),(150502,'ASIA','CAÑETE','LIMA',9321,282),(150503,'CALANGO','CAÑETE','LIMA',2377,526),(150504,'CERRO AZUL','CAÑETE','LIMA',8053,119),(150505,'CHILCA','CAÑETE','LIMA',15801,449),(150506,'COAYLLO','CAÑETE','LIMA',1077,600),(150507,'IMPERIAL','CAÑETE','LIMA',39628,52),(150508,'LUNAHUANA','CAÑETE','LIMA',4812,494),(150509,'MALA','CAÑETE','LIMA',34386,131),(150510,'NUEVO IMPERIAL','CAÑETE','LIMA',23130,320),(150511,'PACARAN','CAÑETE','LIMA',1791,255),(150512,'QUILMANA','CAÑETE','LIMA',15200,447),(150513,'SAN ANTONIO','CAÑETE','LIMA',4169,38),(150514,'SAN LUIS','CAÑETE','LIMA',12971,37),(150515,'SANTA CRUZ DE FLORES','CAÑETE','LIMA',2793,96),(150516,'ZUÑIGA','CAÑETE','LIMA',1818,193),(150601,'HUARAL','HUARAL','LIMA',100436,645),(150602,'ATAVILLOS ALTO','HUARAL','LIMA',712,347),(150603,'ATAVILLOS BAJO','HUARAL','LIMA',1173,175),(150604,'AUCALLAMA','HUARAL','LIMA',19502,708),(150605,'CHANCAY','HUARAL','LIMA',61790,155),(150606,'IHUARI','HUARAL','LIMA',2381,473),(150607,'LAMPIAN','HUARAL','LIMA',416,147),(150608,'PACARAOS','HUARAL','LIMA',490,305),(150609,'SAN MIGUEL DE ACOS','HUARAL','LIMA',768,42),(150610,'SANTA CRUZ DE ANDAMARCA','HUARAL','LIMA',1407,216),(150611,'SUMBILCA','HUARAL','LIMA',986,238),(150612,'VEINTISIETE DE NOVIEMBRE','HUARAL','LIMA',440,207),(150701,'MATUCANA','HUAROCHIRI','LIMA',3680,181),(150702,'ANTIOQUIA','HUAROCHIRI','LIMA',1238,415),(150703,'CALLAHUANCA','HUAROCHIRI','LIMA',4080,51),(150704,'CARAMPOMA','HUAROCHIRI','LIMA',1788,231),(150705,'CHICLA','HUAROCHIRI','LIMA',7632,235),(150706,'CUENCA','HUAROCHIRI','LIMA',395,69),(150707,'HUACHUPAMPA','HUAROCHIRI','LIMA',2814,79),(150708,'HUANZA','HUAROCHIRI','LIMA',2674,233),(150709,'HUAROCHIRI','HUAROCHIRI','LIMA',1291,240),(150710,'LAHUAYTAMBO','HUAROCHIRI','LIMA',674,82),(150711,'LANGA','HUAROCHIRI','LIMA',851,76),(150712,'LARAOS','HUAROCHIRI','LIMA',2298,120),(150713,'MARIATANA','HUAROCHIRI','LIMA',1309,171),(150714,'RICARDO PALMA','HUAROCHIRI','LIMA',6103,34),(150715,'SAN ANDRES DE TUPICOCHA','HUAROCHIRI','LIMA',1268,97),(150716,'SAN ANTONIO','HUAROCHIRI','LIMA',5469,525),(150717,'SAN BARTOLOME','HUAROCHIRI','LIMA',2271,42),(150718,'SAN DAMIAN','HUAROCHIRI','LIMA',1183,333),(150719,'SAN JUAN DE IRIS','HUAROCHIRI','LIMA',1772,127),(150720,'SAN JUAN DE TANTARANCHE','HUAROCHIRI','LIMA',471,137),(150721,'SAN LORENZO DE QUINTI','HUAROCHIRI','LIMA',1532,452),(150722,'SAN MATEO','HUAROCHIRI','LIMA',5017,419),(150723,'SAN MATEO DE OTAO','HUAROCHIRI','LIMA',1603,136),(150724,'SAN PEDRO DE CASTA','HUAROCHIRI','LIMA',1303,82),(150725,'SAN PEDRO DE HUANCAYRE','HUAROCHIRI','LIMA',246,40),(150726,'SANGALLAYA','HUAROCHIRI','LIMA',576,91),(150727,'SANTA CRUZ DE COCACHACRA','HUAROCHIRI','LIMA',2477,33),(150728,'SANTA EULALIA','HUAROCHIRI','LIMA',11787,109),(150729,'SANTIAGO DE ANCHUCAYA','HUAROCHIRI','LIMA',522,95),(150730,'SANTIAGO DE TUNA','HUAROCHIRI','LIMA',729,63),(150731,'SANTO DOMINGO DE LOS OLLEROS','HUAROCHIRI','LIMA',4705,577),(150732,'SURCO','HUAROCHIRI','LIMA',1938,107),(150801,'HUACHO','HUAURA','LIMA',58532,711),(150802,'AMBAR','HUAURA','LIMA',2737,941),(150803,'CALETA DE CARQUIN','HUAURA','LIMA',6801,4),(150804,'CHECRAS','HUAURA','LIMA',1781,167),(150805,'HUALMAY','HUAURA','LIMA',28589,7),(150806,'HUAURA','HUAURA','LIMA',35373,481),(150807,'LEONCIO PRADO','HUAURA','LIMA',1980,294),(150808,'PACCHO','HUAURA','LIMA',2189,237),(150809,'SANTA LEONOR','HUAURA','LIMA',1455,375),(150810,'SANTA MARIA','HUAURA','LIMA',33496,135),(150811,'SAYAN','HUAURA','LIMA',24095,1314),(150812,'VEGUETA','HUAURA','LIMA',22031,257),(150901,'OYON','OYON','LIMA',14479,873),(150902,'ANDAJES','OYON','LIMA',1045,158),(150903,'CAUJUL','OYON','LIMA',1036,97),(150904,'COCHAMARCA','OYON','LIMA',1607,258),(150905,'NAVAN','OYON','LIMA',1192,231),(150906,'PACHANGARA','OYON','LIMA',3423,254),(151001,'YAUYOS','YAUYOS','LIMA',2791,332),(151002,'ALIS','YAUYOS','LIMA',1203,141),(151003,'AYAUCA','YAUYOS','LIMA',2203,441),(151004,'AYAVIRI','YAUYOS','LIMA',690,244),(151005,'AZANGARO','YAUYOS','LIMA',532,78),(151006,'CACRA','YAUYOS','LIMA',384,212),(151007,'CARANIA','YAUYOS','LIMA',367,122),(151008,'CATAHUASI','YAUYOS','LIMA',951,126),(151009,'CHOCOS','YAUYOS','LIMA',1194,211),(151010,'COCHAS','YAUYOS','LIMA',419,38),(151011,'COLONIA','YAUYOS','LIMA',1315,319),(151012,'HONGOS','YAUYOS','LIMA',396,122),(151013,'HUAMPARA','YAUYOS','LIMA',188,55),(151014,'HUANCAYA','YAUYOS','LIMA',1330,279),(151015,'HUANGASCAR','YAUYOS','LIMA',570,50),(151016,'HUANTAN','YAUYOS','LIMA',941,512),(151017,'HUAÑEC','YAUYOS','LIMA',484,42),(151018,'LARAOS','YAUYOS','LIMA',762,411),(151019,'LINCHA','YAUYOS','LIMA',917,217),(151020,'MADEAN','YAUYOS','LIMA',808,208),(151021,'MIRAFLORES','YAUYOS','LIMA',448,202),(151022,'OMAS','YAUYOS','LIMA',578,294),(151023,'PUTINZA','YAUYOS','LIMA',481,61),(151024,'QUINCHES','YAUYOS','LIMA',978,116),(151025,'QUINOCAY','YAUYOS','LIMA',540,158),(151026,'SAN JOAQUIN','YAUYOS','LIMA',428,76),(151027,'SAN PEDRO DE PILAS','YAUYOS','LIMA',374,99),(151028,'TANTA','YAUYOS','LIMA',505,343),(151029,'TAURIPAMPA','YAUYOS','LIMA',428,531),(151030,'TOMAS','YAUYOS','LIMA',1127,294),(151031,'TUPE','YAUYOS','LIMA',649,318),(151032,'VIÑAC','YAUYOS','LIMA',1848,157),(151033,'VITIS','YAUYOS','LIMA',630,104),(160101,'IQUITOS','MAYNAS','LORETO',150484,361),(160102,'ALTO NANAY','MAYNAS','LORETO',2784,14526),(160103,'FERNANDO LORES','MAYNAS','LORETO',20225,4546),(160104,'INDIANA','MAYNAS','LORETO',11301,3348),(160105,'LAS AMAZONAS','MAYNAS','LORETO',9885,6690),(160106,'MAZAN','MAYNAS','LORETO',13779,10082),(160107,'NAPO','MAYNAS','LORETO',16286,24643),(160108,'PUNCHANA','MAYNAS','LORETO',91128,1598),(160109,'PUTUMAYO','MAYNAS','LORETO',6187,34972),(160110,'TORRES CAUSANA','MAYNAS','LORETO',5152,7550),(160112,'BELEN','MAYNAS','LORETO',75685,647),(160113,'SAN JUAN BAUTISTA','MAYNAS','LORETO',154696,3166),(160114,'TENIENTE MANUEL CLAVERO','MAYNAS','LORETO',5657,9580),(160201,'YURIMAGUAS','ALTO AMAZONAS','LORETO',72170,2718),(160202,'BALSAPUERTO','ALTO AMAZONAS','LORETO',17436,2939),(160205,'JEBEROS','ALTO AMAZONAS','LORETO',5271,5282),(160206,'LAGUNAS','ALTO AMAZONAS','LORETO',14308,6241),(160210,'SANTA CRUZ','ALTO AMAZONAS','LORETO',4449,1112),(160211,'TENIENTE CESAR LOPEZ ROJAS','ALTO AMAZONAS','LORETO',6587,1521),(160301,'NAUTA','LORETO','LORETO',30086,6782),(160302,'PARINARI','LORETO','LORETO',7264,13167),(160303,'TIGRE','LORETO','LORETO',8421,20174),(160304,'TROMPETEROS','LORETO','LORETO',10745,12472),(160305,'URARINAS','LORETO','LORETO',14716,16040),(160401,'RAMON CASTILLA','MARISCAL RAMON CASTILLA','LORETO',24141,7104),(160402,'PEBAS','MARISCAL RAMON CASTILLA','LORETO',17061,11595),(160403,'YAVARI','MARISCAL RAMON CASTILLA','LORETO',15638,14061),(160404,'SAN PABLO','MARISCAL RAMON CASTILLA','LORETO',16069,5109),(160501,'REQUENA','REQUENA','LORETO',30156,3088),(160502,'ALTO TAPICHE','REQUENA','LORETO',2106,8862),(160503,'CAPELO','REQUENA','LORETO',4454,856),(160504,'EMILIO SAN MARTIN','REQUENA','LORETO',7488,4648),(160505,'MAQUIA','REQUENA','LORETO',8371,4872),(160506,'PUINAHUA','REQUENA','LORETO',6017,6046),(160507,'SAQUENA','REQUENA','LORETO',4927,2114),(160508,'SOPLIN','REQUENA','LORETO',690,4788),(160509,'TAPICHE','REQUENA','LORETO',1211,2047),(160510,'JENARO HERRERA','REQUENA','LORETO',5632,1542),(160511,'YAQUERANA','REQUENA','LORETO',2989,11205),(160601,'CONTAMANA','UCAYALI','LORETO',27273,10852),(160602,'INAHUAYA','UCAYALI','LORETO',2659,657),(160603,'PADRE MARQUEZ','UCAYALI','LORETO',7597,2517),(160604,'PAMPA HERMOSA','UCAYALI','LORETO',10630,7468),(160605,'SARAYACU','UCAYALI','LORETO',16569,6408),(160606,'VARGAS GUERRA','UCAYALI','LORETO',8932,1877),(160701,'BARRANCA','DATEM DEL MARAÑON','LORETO',13608,6803),(160702,'CAHUAPANAS','DATEM DEL MARAÑON','LORETO',8331,4957),(160703,'MANSERICHE','DATEM DEL MARAÑON','LORETO',10370,4315),(160704,'MORONA','DATEM DEL MARAÑON','LORETO',13024,9653),(160705,'PASTAZA','DATEM DEL MARAÑON','LORETO',6363,8444),(160706,'ANDOAS','DATEM DEL MARAÑON','LORETO',12364,12519),(170101,'TAMBOPATA','TAMBOPATA','MADRE DE DIOS',78378,20677),(170102,'INAMBARI','TAMBOPATA','MADRE DE DIOS',10110,4878),(170103,'LAS PIEDRAS','TAMBOPATA','MADRE DE DIOS',5826,7492),(170104,'LABERINTO','TAMBOPATA','MADRE DE DIOS',5091,2815),(170201,'MANU','MANU','MADRE DE DIOS',3118,8609),(170202,'FITZCARRALD','MANU','MADRE DE DIOS',1536,10526),(170203,'MADRE DE DIOS','MANU','MADRE DE DIOS',12810,7754),(170204,'HUEPETUHE','MANU','MADRE DE DIOS',6633,1499),(170301,'IÑAPARI','TAHUAMANU','MADRE DE DIOS',1555,14343),(170302,'IBERIA','TAHUAMANU','MADRE DE DIOS',8836,2556),(170303,'TAHUAMANU','TAHUAMANU','MADRE DE DIOS',3423,3430),(180101,'MOQUEGUA','MARISCAL NIETO','MOQUEGUA',57243,3948),(180102,'CARUMAS','MARISCAL NIETO','MOQUEGUA',5602,2263),(180103,'CUCHUMBAYA','MARISCAL NIETO','MOQUEGUA',2177,69),(180104,'SAMEGUA','MARISCAL NIETO','MOQUEGUA',6496,64),(180105,'SAN CRISTOBAL','MARISCAL NIETO','MOQUEGUA',4058,542),(180106,'TORATA','MARISCAL NIETO','MOQUEGUA',5874,1772),(180201,'OMATE','GENERAL SANCHEZ CERRO','MOQUEGUA',4477,255),(180202,'CHOJATA','GENERAL SANCHEZ CERRO','MOQUEGUA',2573,858),(180203,'COALAQUE','GENERAL SANCHEZ CERRO','MOQUEGUA',1125,247),(180204,'ICHUÑA','GENERAL SANCHEZ CERRO','MOQUEGUA',4826,999),(180205,'LA CAPILLA','GENERAL SANCHEZ CERRO','MOQUEGUA',2213,775),(180206,'LLOQUE','GENERAL SANCHEZ CERRO','MOQUEGUA',1975,255),(180207,'MATALAQUE','GENERAL SANCHEZ CERRO','MOQUEGUA',1187,562),(180208,'PUQUINA','GENERAL SANCHEZ CERRO','MOQUEGUA',2521,593),(180209,'QUINISTAQUILLAS','GENERAL SANCHEZ CERRO','MOQUEGUA',1410,194),(180210,'UBINAS','GENERAL SANCHEZ CERRO','MOQUEGUA',3649,877),(180211,'YUNGA','GENERAL SANCHEZ CERRO','MOQUEGUA',2377,112),(180301,'ILO','ILO','MOQUEGUA',66876,294),(180302,'EL ALGARROBAL','ILO','MOQUEGUA',320,737),(180303,'PACOCHA','ILO','MOQUEGUA',3498,334),(190101,'CHAUPIMARCA','PASCO','PASCO',26085,15),(190102,'HUACHON','PASCO','PASCO',4722,466),(190103,'HUARIACA','PASCO','PASCO',8257,123),(190104,'HUAYLLAY','PASCO','PASCO',11412,1018),(190105,'NINACACA','PASCO','PASCO',3418,541),(190106,'PALLANCHACRA','PASCO','PASCO',4866,72),(190107,'PAUCARTAMBO','PASCO','PASCO',24303,721),(190108,'SAN FRANCISCO DE ASIS DE YARUSYACAN','PASCO','PASCO',9901,122),(190109,'SIMON BOLIVAR','PASCO','PASCO',11913,689),(190110,'TICLACAYAN','PASCO','PASCO',13285,558),(190111,'TINYAHUARCO','PASCO','PASCO',6286,96),(190112,'VICCO','PASCO','PASCO',2292,173),(190113,'YANACANCHA','PASCO','PASCO',30570,156),(190201,'YANAHUANCA','DANIEL ALCIDES CARRION','PASCO',12922,745),(190202,'CHACAYAN','DANIEL ALCIDES CARRION','PASCO',4295,163),(190203,'GOYLLARISQUIZGA','DANIEL ALCIDES CARRION','PASCO',3896,16),(190204,'PAUCAR','DANIEL ALCIDES CARRION','PASCO',1797,108),(190205,'SAN PEDRO DE PILLAO','DANIEL ALCIDES CARRION','PASCO',1823,74),(190206,'SANTA ANA DE TUSI','DANIEL ALCIDES CARRION','PASCO',22945,285),(190207,'TAPUC','DANIEL ALCIDES CARRION','PASCO',4360,49),(190208,'VILCABAMBA','DANIEL ALCIDES CARRION','PASCO',1609,83),(190301,'OXAPAMPA','OXAPAMPA','PASCO',14257,414),(190302,'CHONTABAMBA','OXAPAMPA','PASCO',3504,442),(190303,'HUANCABAMBA','OXAPAMPA','PASCO',6536,1245),(190304,'PALCAZU','OXAPAMPA','PASCO',10710,2868),(190305,'POZUZO','OXAPAMPA','PASCO',9342,1249),(190306,'PUERTO BERMUDEZ','OXAPAMPA','PASCO',28669,10692),(190307,'VILLA RICA','OXAPAMPA','PASCO',20183,786),(200101,'PIURA','PIURA','PIURA',301311,318),(200104,'CASTILLA','PIURA','PIURA',143203,660),(200105,'CATACAOS','PIURA','PIURA',72779,2535),(200107,'CURA MORI','PIURA','PIURA',18639,196),(200108,'EL TALLAN','PIURA','PIURA',4962,106),(200109,'LA ARENA','PIURA','PIURA',37607,168),(200110,'LA UNION','PIURA','PIURA',40613,209),(200111,'LAS LOMAS','PIURA','PIURA',26768,510),(200114,'TAMBO GRANDE','PIURA','PIURA',119086,1447),(200201,'AYABACA','AYABACA','PIURA',38339,1544),(200202,'FRIAS','AYABACA','PIURA',24203,559),(200203,'JILILI','AYABACA','PIURA',2775,99),(200204,'LAGUNAS','AYABACA','PIURA',7251,196),(200205,'MONTERO','AYABACA','PIURA',6683,130),(200206,'PACAIPAMPA','AYABACA','PIURA',24796,970),(200207,'PAIMAS','AYABACA','PIURA',10332,325),(200208,'SAPILLICA','AYABACA','PIURA',12194,271),(200209,'SICCHEZ','AYABACA','PIURA',1897,34),(200210,'SUYO','AYABACA','PIURA',12287,1069),(200301,'HUANCABAMBA','HUANCABAMBA','PIURA',30404,445),(200302,'CANCHAQUE','HUANCABAMBA','PIURA',8235,313),(200303,'EL CARMEN DE LA FRONTERA','HUANCABAMBA','PIURA',13864,653),(200304,'HUARMACA','HUANCABAMBA','PIURA',41238,1938),(200305,'LALAQUIZ','HUANCABAMBA','PIURA',4626,146),(200306,'SAN MIGUEL DE EL FAIQUE','HUANCABAMBA','PIURA',8994,208),(200307,'SONDOR','HUANCABAMBA','PIURA',8564,344),(200308,'SONDORILLO','HUANCABAMBA','PIURA',10758,230),(200401,'CHULUCANAS','MORROPON','PIURA',76214,862),(200402,'BUENOS AIRES','MORROPON','PIURA',7985,246),(200403,'CHALACO','MORROPON','PIURA',8992,149),(200404,'LA MATANZA','MORROPON','PIURA',12761,1036),(200405,'MORROPON','MORROPON','PIURA',14099,171),(200406,'SALITRAL','MORROPON','PIURA',8409,610),(200407,'SAN JUAN DE BIGOTE','MORROPON','PIURA',6566,250),(200408,'SANTA CATALINA DE MOSSA','MORROPON','PIURA',4095,80),(200409,'SANTO DOMINGO','MORROPON','PIURA',7207,190),(200410,'YAMANGO','MORROPON','PIURA',9567,217),(200501,'PAITA','PAITA','PIURA',93147,731),(200502,'AMOTAPE','PAITA','PIURA',2310,61),(200503,'ARENAL','PAITA','PIURA',1006,8),(200504,'COLAN','PAITA','PIURA',12429,123),(200505,'LA HUACA','PAITA','PIURA',11696,596),(200506,'TAMARINDO','PAITA','PIURA',4555,66),(200507,'VICHAYAL','PAITA','PIURA',4761,158),(200601,'SULLANA','SULLANA','PIURA',176804,487),(200602,'BELLAVISTA','SULLANA','PIURA',38071,2),(200603,'IGNACIO ESCUDERO','SULLANA','PIURA',19987,183),(200604,'LANCONES','SULLANA','PIURA',13245,2164),(200605,'MARCAVELICA','SULLANA','PIURA',28876,1647),(200606,'MIGUEL CHECA','SULLANA','PIURA',8639,456),(200607,'QUERECOTILLO','SULLANA','PIURA',25290,282),(200608,'SALITRAL','SULLANA','PIURA',6663,31),(200701,'PARIÑAS','TALARA','PIURA',89877,1122),(200702,'EL ALTO','TALARA','PIURA',7056,479),(200703,'LA BREA','TALARA','PIURA',11817,830),(200704,'LOBITOS','TALARA','PIURA',1646,237),(200705,'LOS ORGANOS','TALARA','PIURA',9411,163),(200706,'MANCORA','TALARA','PIURA',12888,97),(200801,'SECHURA','SECHURA','PIURA',42974,5731),(200802,'BELLAVISTA DE LA UNION','SECHURA','PIURA',4303,15),(200803,'BERNAL','SECHURA','PIURA',7276,70),(200804,'CRISTO NOS VALGA','SECHURA','PIURA',3878,262),(200805,'VICE','SECHURA','PIURA',14108,334),(200806,'RINCONADA LLICUAR','SECHURA','PIURA',3113,19),(210101,'PUNO','PUNO','PUNO',141064,460),(210102,'ACORA','PUNO','PUNO',28189,1937),(210103,'AMANTANI','PUNO','PUNO',4447,163),(210104,'ATUNCOLLA','PUNO','PUNO',5653,159),(210105,'CAPACHICA','PUNO','PUNO',11336,99),(210106,'CHUCUITO','PUNO','PUNO',7012,89),(210107,'COATA','PUNO','PUNO',8034,104),(210108,'HUATA','PUNO','PUNO',10353,129),(210109,'MAÑAZO','PUNO','PUNO',5369,402),(210110,'PAUCARCOLLA','PUNO','PUNO',5135,175),(210111,'PICHACANI','PUNO','PUNO',5324,1639),(210112,'PLATERIA','PUNO','PUNO',7743,249),(210113,'SAN ANTONIO','PUNO','PUNO',3799,337),(210114,'TIQUILLACA','PUNO','PUNO',1790,489),(210115,'VILQUE','PUNO','PUNO',3129,193),(210201,'AZANGARO','AZANGARO','PUNO',28195,721),(210202,'ACHAYA','AZANGARO','PUNO',4479,126),(210203,'ARAPA','AZANGARO','PUNO',7483,337),(210204,'ASILLO','AZANGARO','PUNO',17407,404),(210205,'CAMINACA','AZANGARO','PUNO',3564,147),(210206,'CHUPA','AZANGARO','PUNO',13045,151),(210207,'JOSE DOMINGO CHOQUEHUANCA','AZANGARO','PUNO',5458,67),(210208,'MUÑANI','AZANGARO','PUNO',8180,785),(210209,'POTONI','AZANGARO','PUNO',6456,623),(210210,'SAMAN','AZANGARO','PUNO',14249,337),(210211,'SAN ANTON','AZANGARO','PUNO',9978,513),(210212,'SAN JOSE','AZANGARO','PUNO',5751,397),(210213,'SAN JUAN DE SALINAS','AZANGARO','PUNO',4325,104),(210214,'SANTIAGO DE PUPUJA','AZANGARO','PUNO',5172,319),(210215,'TIRAPATA','AZANGARO','PUNO',3077,200),(210301,'MACUSANI','CARABAYA','PUNO',12869,1017),(210302,'AJOYANI','CARABAYA','PUNO',2079,427),(210303,'AYAPATA','CARABAYA','PUNO',11975,776),(210304,'COASA','CARABAYA','PUNO',15879,3071),(210305,'CORANI','CARABAYA','PUNO',3916,890),(210306,'CRUCERO','CARABAYA','PUNO',9208,854),(210307,'ITUATA','CARABAYA','PUNO',6341,1251),(210308,'OLLACHEA','CARABAYA','PUNO',5566,709),(210309,'SAN GABAN','CARABAYA','PUNO',4109,2042),(210310,'USICAYOS','CARABAYA','PUNO',23448,654),(210401,'JULI','CHUCUITO','PUNO',21462,772),(210402,'DESAGUADERO','CHUCUITO','PUNO',31524,177),(210403,'HUACULLANI','CHUCUITO','PUNO',23188,627),(210404,'KELLUYO','CHUCUITO','PUNO',25415,487),(210405,'PISACOMA','CHUCUITO','PUNO',13608,957),(210406,'POMATA','CHUCUITO','PUNO',16094,401),(210407,'ZEPITA','CHUCUITO','PUNO',18948,525),(210501,'ILAVE','EL COLLAO','PUNO',57905,917),(210502,'CAPAZO','EL COLLAO','PUNO',2203,1043),(210503,'PILCUYO','EL COLLAO','PUNO',12850,153),(210504,'SANTA ROSA','EL COLLAO','PUNO',7735,2698),(210505,'CONDURIRI','EL COLLAO','PUNO',4387,841),(210601,'HUANCANE','HUANCANE','PUNO',18253,387),(210602,'COJATA','HUANCANE','PUNO',4239,880),(210603,'HUATASANI','HUANCANE','PUNO',5371,107),(210604,'INCHUPALLA','HUANCANE','PUNO',3275,297),(210605,'PUSI','HUANCANE','PUNO',6278,147),(210606,'ROSASPATA','HUANCANE','PUNO',5106,305),(210607,'TARACO','HUANCANE','PUNO',14014,197),(210608,'VILQUE CHICO','HUANCANE','PUNO',8290,507),(210701,'LAMPA','LAMPA','PUNO',10420,660),(210702,'CABANILLA','LAMPA','PUNO',5325,385),(210703,'CALAPUJA','LAMPA','PUNO',1473,141),(210704,'NICASIO','LAMPA','PUNO',2666,134),(210705,'OCUVIRI','LAMPA','PUNO',3059,877),(210706,'PALCA','LAMPA','PUNO',2855,497),(210707,'PARATIA','LAMPA','PUNO',8778,746),(210708,'PUCARA','LAMPA','PUNO',5342,526),(210709,'SANTA LUCIA','LAMPA','PUNO',7485,1590),(210710,'VILAVILA','LAMPA','PUNO',4125,162),(210801,'AYAVIRI','MELGAR','PUNO',22397,1017),(210802,'ANTAUTA','MELGAR','PUNO',4516,655),(210803,'CUPI','MELGAR','PUNO',3274,217),(210804,'LLALLI','MELGAR','PUNO',4719,229),(210805,'MACARI','MELGAR','PUNO',8532,692),(210806,'NUÑOA','MELGAR','PUNO',11017,2199),(210807,'ORURILLO','MELGAR','PUNO',10805,397),(210808,'SANTA ROSA','MELGAR','PUNO',7342,804),(210809,'UMACHIRI','MELGAR','PUNO',4384,331),(210901,'MOHO','MOHO','PUNO',15656,506),(210902,'CONIMA','MOHO','PUNO',2909,68),(210903,'HUAYRAPATA','MOHO','PUNO',4258,401),(210904,'TILALI','MOHO','PUNO',2649,52),(211001,'PUTINA','SAN ANTONIO DE PUTIN','PUNO',26628,1034),(211002,'ANANEA','SAN ANTONIO DE PUTIN','PUNO',32285,979),(211003,'PEDRO VILCA APAZA','SAN ANTONIO DE PUTIN','PUNO',2934,143),(211004,'QUILCAPUNCU','SAN ANTONIO DE PUTIN','PUNO',5743,525),(211005,'SINA','SAN ANTONIO DE PUTIN','PUNO',1660,465),(211101,'JULIACA','SAN ROMAN','PUNO',278444,526),(211102,'CABANA','SAN ROMAN','PUNO',4224,193),(211103,'CABANILLAS','SAN ROMAN','PUNO',5374,1275),(211104,'CARACOTO','SAN ROMAN','PUNO',5655,287),(211201,'SANDIA','SANDIA','PUNO',12191,696),(211202,'CUYOCUYO','SANDIA','PUNO',4707,503),(211203,'LIMBANI','SANDIA','PUNO',4274,2422),(211204,'PATAMBUCO','SANDIA','PUNO',3960,474),(211205,'PHARA','SANDIA','PUNO',4844,428),(211206,'QUIACA','SANDIA','PUNO',2374,413),(211207,'SAN JUAN DEL ORO','SANDIA','PUNO',13111,196),(211208,'YANAHUAYA','SANDIA','PUNO',2269,648),(211209,'ALTO INAMBARI','SANDIA','PUNO',9241,1360),(211210,'SAN PEDRO DE PUTINA PUNCO','SANDIA','PUNO',13577,5415),(211301,'YUNGUYO','YUNGUYO','PUNO',27074,175),(211302,'ANAPIA','YUNGUYO','PUNO',3334,121),(211303,'COPANI','YUNGUYO','PUNO',5021,60),(211304,'CUTURAPI','YUNGUYO','PUNO',1214,24),(211305,'OLLARAYA','YUNGUYO','PUNO',5336,27),(211306,'TINICACHI','YUNGUYO','PUNO',1593,4),(211307,'UNICACHI','YUNGUYO','PUNO',3824,6),(220101,'MOYOBAMBA','MOYOBAMBA','SAN MARTIN',83475,2805),(220102,'CALZADA','MOYOBAMBA','SAN MARTIN',4302,116),(220103,'HABANA','MOYOBAMBA','SAN MARTIN',1993,70),(220104,'JEPELACIO','MOYOBAMBA','SAN MARTIN',21164,245),(220105,'SORITOR','MOYOBAMBA','SAN MARTIN',33851,483),(220106,'YANTALO','MOYOBAMBA','SAN MARTIN',3375,72),(220201,'BELLAVISTA','BELLAVISTA','SAN MARTIN',13395,299),(220202,'ALTO BIAVO','BELLAVISTA','SAN MARTIN',7015,5780),(220203,'BAJO BIAVO','BELLAVISTA','SAN MARTIN',19335,1004),(220204,'HUALLAGA','BELLAVISTA','SAN MARTIN',3003,114),(220205,'SAN PABLO','BELLAVISTA','SAN MARTIN',8916,351),(220206,'SAN RAFAEL','BELLAVISTA','SAN MARTIN',7290,99),(220301,'SAN JOSE DE SISA','EL DORADO','SAN MARTIN',11796,275),(220302,'AGUA BLANCA','EL DORADO','SAN MARTIN',2359,177),(220303,'SAN MARTIN','EL DORADO','SAN MARTIN',13022,548),(220304,'SANTA ROSA','EL DORADO','SAN MARTIN',10052,244),(220305,'SHATOJA','EL DORADO','SAN MARTIN',3120,75),(220401,'SAPOSOA','HUALLAGA','SAN MARTIN',11341,513),(220402,'ALTO SAPOSOA','HUALLAGA','SAN MARTIN',3148,1346),(220403,'EL ESLABON','HUALLAGA','SAN MARTIN',3753,126),(220404,'PISCOYACU','HUALLAGA','SAN MARTIN',3830,184),(220405,'SACANCHE','HUALLAGA','SAN MARTIN',2584,150),(220406,'TINGO DE SAPOSOA','HUALLAGA','SAN MARTIN',672,41),(220501,'LAMAS','LAMAS','SAN MARTIN',12434,96),(220502,'ALONSO DE ALVARADO','LAMAS','SAN MARTIN',18862,247),(220503,'BARRANQUITA','LAMAS','SAN MARTIN',5085,1075),(220504,'CAYNARACHI','LAMAS','SAN MARTIN',7899,1287),(220505,'CUÑUMBUQUI','LAMAS','SAN MARTIN',4681,193),(220506,'PINTO RECODO','LAMAS','SAN MARTIN',10663,819),(220507,'RUMISAPA','LAMAS','SAN MARTIN',2481,41),(220508,'SAN ROQUE DE CUMBAZA','LAMAS','SAN MARTIN',1450,645),(220509,'SHANAO','LAMAS','SAN MARTIN',3460,25),(220510,'TABALOSOS','LAMAS','SAN MARTIN',13130,397),(220511,'ZAPATERO','LAMAS','SAN MARTIN',4776,178),(220601,'JUANJUI','MARISCAL CACERES','SAN MARTIN',26364,353),(220602,'CAMPANILLA','MARISCAL CACERES','SAN MARTIN',7642,2160),(220603,'HUICUNGO','MARISCAL CACERES','SAN MARTIN',6481,9799),(220604,'PACHIZA','MARISCAL CACERES','SAN MARTIN',4180,1767),(220605,'PAJARILLO','MARISCAL CACERES','SAN MARTIN',5941,357),(220701,'PICOTA','PICOTA','SAN MARTIN',8094,185),(220702,'BUENOS AIRES','PICOTA','SAN MARTIN',3202,291),(220703,'CASPISAPA','PICOTA','SAN MARTIN',2052,89),(220704,'PILLUANA','PICOTA','SAN MARTIN',713,69),(220705,'PUCACACA','PICOTA','SAN MARTIN',2456,222),(220706,'SAN CRISTOBAL','PICOTA','SAN MARTIN',1375,24),(220707,'SAN HILARION','PICOTA','SAN MARTIN',5458,96),(220708,'SHAMBOYACU','PICOTA','SAN MARTIN',11449,311),(220709,'TINGO DE PONASA','PICOTA','SAN MARTIN',4659,416),(220710,'TRES UNIDOS','PICOTA','SAN MARTIN',5075,352),(220801,'RIOJA','RIOJA','SAN MARTIN',23472,205),(220802,'AWAJUN','RIOJA','SAN MARTIN',11630,475),(220803,'ELIAS SOPLIN VARGAS','RIOJA','SAN MARTIN',13156,159),(220804,'NUEVA CAJAMARCA','RIOJA','SAN MARTIN',45241,332),(220805,'PARDO MIGUEL','RIOJA','SAN MARTIN',22345,1151),(220806,'POSIC','RIOJA','SAN MARTIN',1633,61),(220807,'SAN FERNANDO','RIOJA','SAN MARTIN',3389,75),(220808,'YORONGOS','RIOJA','SAN MARTIN',3587,81),(220809,'YURACYACU','RIOJA','SAN MARTIN',3914,60),(220901,'TARAPOTO','SAN MARTIN','SAN MARTIN',73015,45),(220902,'ALBERTO LEVEAU','SAN MARTIN','SAN MARTIN',673,51),(220903,'CACATACHI','SAN MARTIN','SAN MARTIN',3327,45),(220904,'CHAZUTA','SAN MARTIN','SAN MARTIN',8111,1415),(220905,'CHIPURANA','SAN MARTIN','SAN MARTIN',1794,280),(220906,'EL PORVENIR','SAN MARTIN','SAN MARTIN',2692,452),(220907,'HUIMBAYOC','SAN MARTIN','SAN MARTIN',3444,1228),(220908,'JUAN GUERRA','SAN MARTIN','SAN MARTIN',3117,208),(220909,'LA BANDA DE SHILCAYO','SAN MARTIN','SAN MARTIN',41114,273),(220910,'MORALES','SAN MARTIN','SAN MARTIN',29302,53),(220911,'PAPAPLAYA','SAN MARTIN','SAN MARTIN',2062,888),(220912,'SAN ANTONIO','SAN MARTIN','SAN MARTIN',1340,125),(220913,'SAUCE','SAN MARTIN','SAN MARTIN',15840,98),(220914,'SHAPAJA','SAN MARTIN','SAN MARTIN',1489,235),(221001,'TOCACHE','TOCACHE','SAN MARTIN',25271,1117),(221002,'NUEVO PROGRESO','TOCACHE','SAN MARTIN',11971,819),(221003,'POLVORA','TOCACHE','SAN MARTIN',13684,2311),(221004,'SHUNTE','TOCACHE','SAN MARTIN',1006,1083),(221005,'UCHIZA','TOCACHE','SAN MARTIN',20318,773),(230101,'TACNA','TACNA','TACNA',85228,2429),(230102,'ALTO DE LA ALIANZA','TACNA','TACNA',39180,375),(230103,'CALANA','TACNA','TACNA',3189,117),(230104,'CIUDAD NUEVA','TACNA','TACNA',37671,175),(230105,'INCLAN','TACNA','TACNA',7684,1440),(230106,'PACHIA','TACNA','TACNA',1964,614),(230107,'PALCA','TACNA','TACNA',1669,1433),(230108,'POCOLLAY','TACNA','TACNA',21278,293),(230109,'SAMA','TACNA','TACNA',2604,1135),(230110,'CORONEL GREGORIO ALBARRACIN LANCHIPA','TACNA','TACNA',116497,168),(230201,'CANDARAVE','CANDARAVE','TACNA',3001,1378),(230202,'CAIRANI','CANDARAVE','TACNA',1301,176),(230203,'CAMILACA','CANDARAVE','TACNA',1514,491),(230204,'CURIBAYA','CANDARAVE','TACNA',180,113),(230205,'HUANUARA','CANDARAVE','TACNA',898,90),(230206,'QUILAHUANI','CANDARAVE','TACNA',1201,55),(230301,'LOCUMBA','JORGE BASADRE','TACNA',2601,843),(230302,'ILABAYA','JORGE BASADRE','TACNA',3008,1056),(230303,'ITE','JORGE BASADRE','TACNA',3425,826),(230401,'TARATA','TARATA','TACNA',3252,883),(230402,'HEROES ALBARRACIN','TARATA','TACNA',655,378),(230403,'ESTIQUE','TARATA','TACNA',710,300),(230404,'ESTIQUE-PAMPA','TARATA','TACNA',666,146),(230405,'SITAJARA','TARATA','TACNA',697,234),(230406,'SUSAPAYA','TARATA','TACNA',768,360),(230407,'TARUCACHI','TARATA','TACNA',410,106),(230408,'TICACO','TARATA','TACNA',587,355),(240101,'TUMBES','TUMBES','TUMBES',111683,161),(240102,'CORRALES','TUMBES','TUMBES',23868,127),(240103,'LA CRUZ','TUMBES','TUMBES',9173,66),(240104,'PAMPAS DE HOSPITAL','TUMBES','TUMBES',7050,724),(240105,'SAN JACINTO','TUMBES','TUMBES',8541,585),(240106,'SAN JUAN DE LA VIRGEN','TUMBES','TUMBES',4089,116),(240201,'ZORRITOS','CONTRALMIRANTE VILLA','TUMBES',12313,648),(240202,'CASITAS','CONTRALMIRANTE VILLA','TUMBES',2109,855),(240203,'CANOAS DE PUNTA SAL','CONTRALMIRANTE VILLA','TUMBES',5474,624),(240301,'ZARUMILLA','ZARUMILLA','TUMBES',22257,99),(240302,'AGUAS VERDES','ZARUMILLA','TUMBES',23480,47),(240303,'MATAPALO','ZARUMILLA','TUMBES',2395,389),(240304,'PAPAYAL','ZARUMILLA','TUMBES',5253,206),(250101,'CALLERIA','CORONEL PORTILLO','UCAYALI',154082,11926),(250102,'CAMPOVERDE','CORONEL PORTILLO','UCAYALI',15743,1725),(250103,'IPARIA','CORONEL PORTILLO','UCAYALI',11826,6735),(250104,'MASISEA','CORONEL PORTILLO','UCAYALI',12758,15157),(250105,'YARINACOCHA','CORONEL PORTILLO','UCAYALI',97678,243),(250106,'NUEVA REQUENA','CORONEL PORTILLO','UCAYALI',5538,2249),(250107,'MANANTAY','CORONEL PORTILLO','UCAYALI',80250,1177),(250201,'RAYMONDI','ATALAYA','UCAYALI',34419,14876),(250202,'SEPAHUA','ATALAYA','UCAYALI',8793,7715),(250203,'TAHUANIA','ATALAYA','UCAYALI',8020,7236),(250204,'YURUA','ATALAYA','UCAYALI',2587,8758),(250301,'PADRE ABAD','PADRE ABAD','UCAYALI',25971,4691),(250302,'IRAZOLA','PADRE ABAD','UCAYALI',24833,2736),(250303,'CURIMANA','PADRE ABAD','UCAYALI',8543,1952),(250401,'PURUS','PURUS','UCAYALI',4481,18147);

/*Table structure for table `tb_unidad_medida` */

DROP TABLE IF EXISTS `tb_unidad_medida`;

CREATE TABLE `tb_unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_medida` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_usuarioelim` int(11) DEFAULT NULL,
  `motivo_elim` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tb_unidad_medida` */

insert  into `tb_unidad_medida`(`id`,`unidad_medida`,`created_at`,`id_usuarioreg`,`updated_at`,`id_usuariomod`,`deleted_at`,`id_usuarioelim`,`motivo_elim`) values (1,'UNIDAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'KG','2021-12-17 10:49:37',1,'2021-12-17 10:49:37',NULL,NULL,NULL,NULL),(3,'ML','2021-12-17 10:49:46',1,'2021-12-17 10:49:46',NULL,NULL,NULL,NULL),(4,'FRASCO','2021-12-17 10:49:53',1,'2021-12-17 10:49:53',NULL,NULL,NULL,NULL),(5,'BOLSA','2021-12-17 10:49:59',1,'2021-12-17 10:49:59',NULL,NULL,NULL,NULL),(6,'BOLSA','2021-12-17 10:50:03',1,'2021-12-17 10:50:03',NULL,NULL,NULL,NULL),(7,'CJA','2021-12-17 10:50:10',1,'2021-12-17 10:50:10',NULL,NULL,NULL,NULL),(8,'GRAMOS','2021-12-21 10:44:20',1,'2021-12-21 10:44:33',1,NULL,NULL,NULL),(9,'PAQUETE','2021-12-21 10:45:21',1,'2021-12-21 10:45:21',NULL,NULL,NULL,NULL),(10,'MODULO','2021-12-21 10:46:33',1,'2021-12-21 10:46:33',NULL,NULL,NULL,NULL);

/*Table structure for table `tb_usuario` */

DROP TABLE IF EXISTS `tb_usuario`;

CREATE TABLE `tb_usuario` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sts_usuario` char(2) COLLATE utf8mb4_unicode_ci DEFAULT 'AC',
  `id_usuarioelim` int(11) DEFAULT '0',
  `motivo_elim` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `laboratorio_id` int(11) DEFAULT NULL,
  `fecha_cambioclave` datetime DEFAULT NULL,
  `flg_cambiarclave` tinyint(1) DEFAULT '1' COMMENT '1 Obligar que el usuario cabie su clave, 0 no obligar cambio de clave',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_usuario` */

insert  into `tb_usuario`(`id`,`nombre_usuario`,`email`,`email_verified_at`,`username`,`password`,`remember_token`,`sts_usuario`,`id_usuarioelim`,`motivo_elim`,`deleted_at`,`created_at`,`updated_at`,`laboratorio_id`,`fecha_cambioclave`,`flg_cambiarclave`) values (1,'Administrador General','admin@uncp.edu.pe','2021-12-16 18:23:19','admin','$2y$10$4QCXLDU1HSm.TX4qKLrXveUgXwQhDJ00rtqNRZ0RrPfFulKhSDqjy',NULL,'AC',0,NULL,NULL,NULL,'2021-12-17 09:34:08',NULL,'2021-12-17 09:34:08',0),(2,'Gladys Avila','gavila@uncp.pe',NULL,'labbio','$2y$10$dh/h05Ca0ZUluJR4h1TUX.v.isui.Lh2Ev3/1WPbBMDf37nc0vYDq',NULL,'AC',0,NULL,NULL,'2021-12-16 19:51:06','2021-12-16 19:51:06',1,NULL,1),(3,'OTTO CARLOS','OTSORIANO@uncp.edu.pe',NULL,'UDL','$2y$10$rfBJMOBvLwTd.5NnFRl97OyBCu8xoNGWf/GpCO2AAQatb1.5WdRGS',NULL,'AC',0,NULL,NULL,'2021-12-16 19:54:09','2021-12-16 19:54:09',1,NULL,1),(4,'Usuario','SL01LA01@email.com','2021-12-17 01:25:53','SL01LA01','$2y$10$X/gdaIjL4vAQHRFTaSTxp.5GJFDCDtUMIUR0I5m24RzhOQSCaa27q',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:43:45',2,'2021-12-17 11:43:45',0),(5,'Usuario','SL01LA02@email.com','2021-12-17 01:25:53','SL01LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',3,NULL,1),(6,'Usuario','SL01LA03@email.com','2021-12-17 01:25:53','SL01LA03','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',4,NULL,1),(7,'Usuario','SL01LA04@email.com','2021-12-17 01:25:53','SL01LA04','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',5,NULL,1),(8,'Usuario','SL01LA05@email.com','2021-12-17 01:25:53','SL01LA05','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',6,NULL,1),(9,'Usuario','SL01LA06@email.com','2021-12-17 01:25:53','SL01LA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO','9COzHgyqYWjtTnoPYVFzRvEVhlicRgaFtxkszAsPWyACjwKOsWbzZs0QTjsL','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',7,NULL,1),(10,'Usuario','SL01LA07@email.com','2021-12-17 01:25:53','SL01LA07','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',8,NULL,1),(11,'Usuario','SL01LA08@email.com','2021-12-17 01:25:53','SL01LA08','$2y$10$Cjuw9aF17PUuNVlXJxc4HeIAvHDbfMHw1xKUSUAGGBqGpez.JsH/q',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:13:52',9,'2021-12-17 10:13:52',0),(12,'FREDY WIDMER BETALLELUZ VALENCIA','SL01LA09@email.com','2021-12-17 01:25:53','SL01LA09','$2y$10$p/nUNwvV1mgXFrqBC0kSR.ycBBWIAnc9gVxtloI/05BvjG3TSJueO','b9QzkuGaHLP4S7yBMWBfzHtGLwaD4tveDToIjnrL9NWgRpyiaR8fn7JjESxO','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 12:23:17',10,'2021-12-17 12:23:17',0),(13,'Rafael Marcelino Cantorin Curty','SL01LA10@email.com','2021-12-17 01:25:53','SL01LA10','$2y$10$YVqF11KJj5Qy9ciu9xULyeZI54inA8/biFJ/jHpRlpi23jH6IHso6',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 12:12:52',11,'2021-12-17 12:12:52',0),(14,'Usuario','SL01LA11@email.com','2021-12-17 01:25:53','SL01LA11','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',12,NULL,1),(15,'Usuario','SL01LA12@email.com','2021-12-17 01:25:53','SL01LA12','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',13,NULL,1),(16,'UsuariAmelida Violeta Rupay Aguilar','SL01LA13@email.com','2021-12-17 01:25:53','SL01LA13','$2y$10$5E3YNo8usGk.Squ47jcw4Ohj4Rf3lQpZ.vcyrB5qEh8sIWe.uK/mu',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:54:37',14,'2021-12-17 14:54:37',0),(17,'Usuario','SL01LA14@email.com','2021-12-17 01:25:53','SL01LA14','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',15,NULL,1),(18,'Usuario','SL01LA15@email.com','2021-12-17 01:25:53','SL01LA15','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',16,NULL,1),(19,'Usuario','SL01LA16@email.com','2021-12-17 01:25:53','SL01LA16','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',17,NULL,1),(20,'Usuario','SL01LA17@email.com','2021-12-17 01:25:53','SL01LA17','$2y$10$bce4M8B3IaBKVZFeDMLuWO3WMNUccGAr0Xjo5SnfJjbL4tS70JXm.',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:46:42',18,'2021-12-17 11:46:42',0),(21,'Usuario','SL01LA18@email.com','2021-12-17 01:25:53','SL01LA18','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',19,NULL,1),(22,'Usuario','SL01LA19@email.com','2021-12-17 01:25:53','SL01LA19','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',20,NULL,1),(23,'Usuario','SL01LA20@email.com','2021-12-17 01:25:53','SL01LA20','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',21,NULL,1),(24,'MINASFAIM','SL01LA21@email.com','2021-12-17 01:25:53','SL01LA21','$2y$10$0lX3wPXpyZk/R0PjAzYxH.i1/CUysqQxCW5gQGcz4RIa4UnODjWyC',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:44:50',22,'2021-12-17 11:44:50',0),(25,'Usuario','SL01LA22@email.com','2021-12-17 01:25:53','SL01LA22','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',23,NULL,1),(26,'Usuario','SL01LA23@email.com','2021-12-17 01:25:53','SL01LA23','$2y$10$gt7TOMqJDLpxlQhU7rPk4eGKSjoxisc6aWMaJV3EdQoTMGNScNEba',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:45:21',24,'2021-12-17 11:45:21',0),(27,'Usuario','SL01LA24@email.com','2021-12-17 01:25:53','SL01LA24','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',25,NULL,1),(28,'Usuario','SL01LA25@email.com','2021-12-17 01:25:53','SL01LA25','$2y$10$59N9PLSgVXQn9yFDioYj6O3TOM.rhuFGwO/QyEry7sLl/IHGjqXte',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:42:05',26,'2021-12-17 11:42:05',0),(29,'Usuario','SL01LA26@email.com','2021-12-17 01:25:53','SL01LA26','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',27,NULL,1),(30,'Usuario','SL01LA27@email.com','2021-12-17 01:25:53','SL01LA27','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',28,NULL,1),(31,'Usuario','SL01LA28@email.com','2021-12-17 01:25:53','SL01LA28','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',29,NULL,1),(32,'CICERO','SL01LA29@email.com','2021-12-17 01:25:53','SL01LA29','$2y$10$Lj8Px4JDb10KUlhwXOEhCeOuCjtA3rJUgvbkxoUFFSGS4Yvxg4xYi',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:04:22',30,'2021-12-17 10:04:22',0),(33,'Usuario','SL01LA30@email.com','2021-12-17 01:25:53','SL01LA30','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',31,NULL,1),(34,'Usuario','SL01LA31@email.com','2021-12-17 01:25:53','SL01LA31','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',32,NULL,1),(35,'Usuario','SL01LA32@email.com','2021-12-17 01:25:53','SL01LA32','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',33,NULL,1),(36,'Usuario','SL01LA33@email.com','2021-12-17 01:25:53','SL01LA33','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',34,NULL,1),(37,'Usuario','SL01LA34@email.com','2021-12-17 01:25:53','SL01LA34','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',35,NULL,1),(38,'Usuario','SL01LA35@email.com','2021-12-17 01:25:53','SL01LA35','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',36,NULL,1),(39,'Usuario','SL01LA36@email.com','2021-12-17 01:25:53','SL01LA36','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',37,NULL,1),(40,'Usuario','SL01LA37@email.com','2021-12-17 01:25:53','SL01LA37','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',38,NULL,1),(41,'Usuario','SL01LA38@email.com','2021-12-17 01:25:53','SL01LA38','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',39,NULL,1),(42,'Usuario','SL01LA39@email.com','2021-12-17 01:25:53','SL01LA39','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',40,NULL,1),(43,'Usuario','SL01LA40@email.com','2021-12-17 01:25:53','SL01LA40','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',41,NULL,1),(44,'Usuario','SL01LA41@email.com','2021-12-17 01:25:53','SL01LA41','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',42,NULL,1),(45,'Usuario','SL01LA42@email.com','2021-12-17 01:25:53','SL01LA42','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',43,NULL,1),(46,'Usuario','SL01LA43@email.com','2021-12-17 01:25:53','SL01LA43','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',44,NULL,1),(47,'Usuario','SL01LA44@email.com','2021-12-17 01:25:53','SL01LA44','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',45,NULL,1),(48,'Usuario','SL01LA45@email.com','2021-12-17 01:25:53','SL01LA45','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',46,NULL,1),(49,'Usuario','SL01LA46@email.com','2021-12-17 01:25:53','SL01LA46','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',47,NULL,1),(50,'Usuario','SL01LA47@email.com','2021-12-17 01:25:53','SL01LA47','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',48,NULL,1),(51,'Usuario','SL01LA48@email.com','2021-12-17 01:25:53','SL01LA48','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',49,NULL,1),(52,'Usuario','SL01LA49@email.com','2021-12-17 01:25:53','SL01LA49','$2y$10$gosgV2jK.BsD3jzwuZK/a.KPdlneVpjDcQfBjRE4wY07JnQ1iR8qK',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:48:57',50,'2021-12-17 14:48:57',0),(53,'Usuario','SL01LA50@email.com','2021-12-17 01:25:53','SL01LA50','$2y$10$YSUYGykeqGdvZ52a2s.Kd.ZxhcZH.m6QgifsN2ZQ5xOI8g4J8fRlu','isvao8W3B63ta6JNkZelCIXuwaG4x0gmDipjqbLrWEjD2jl7yjNHmM5drw03','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:53:25',51,'2021-12-17 14:53:25',0),(54,'Usuario','SL01LA51@email.com','2021-12-17 01:25:53','SL01LA51','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',52,NULL,1),(55,'Usuario','SL01LA52@email.com','2021-12-17 01:25:53','SL01LA52','$2y$10$mrEmuMifWZb6JbftOfvZFeYtUSxG.mOGpkkCMPkSecr9wT/WhYXWK',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:01:24',53,'2021-12-17 10:01:24',0),(56,'Usuario','SL01LA53@email.com','2021-12-17 01:25:53','SL01LA53','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',54,NULL,1),(57,'Usuario','SL01LA54@email.com','2021-12-17 01:25:53','SL01LA54','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',55,NULL,1),(58,'Usuario','SL01LA55@email.com','2021-12-17 01:25:53','SL01LA55','$2y$10$qTEGR4d70Mb7Q7mYsSrqueiQmCKMpMKrqIKe6rUMcipABY92EejRS',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:56:04',56,'2021-12-17 14:56:04',0),(59,'Pilar Herrera','SL01LA56@email.com','2021-12-17 01:25:53','SL01LA56','$2y$10$JHS0akR/fst4pkhIYy.Jbef1Eon0AsYPhDER4/jwj0rwYBUzhtcEi',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:31:54',57,'2021-12-17 10:31:54',0),(60,'Usuario','SL01LA57@email.com','2021-12-17 01:25:53','SL01LA57','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',58,NULL,1),(61,'HEIDI M. DE LA CRUZ SOLANO','SL01LA58@email.com','2021-12-17 01:25:53','SL01LA58','$2y$10$3jfRdv8maVo360nYTJ0UaOd65Zh1FHw9zcltPy4ZGaXqXBCobXMSm','Sd9EGrEZtFx7IjgeGAFdCWxcbCIOfmVxmwJP1AuSDaiYVlZG6hxE6VPdeVYp','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:51:27',59,'2021-12-17 14:51:27',0),(62,'Usuario','SL01LA59@email.com','2021-12-17 01:25:53','SL01LA59','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',60,NULL,1),(63,'Usuario','SL01LA60@email.com','2021-12-17 01:25:53','SL01LA60','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',61,NULL,1),(64,'GLEDY CARHUAMACA','SL01LA61@email.com','2021-12-17 01:25:53','SL01LA61','$2y$10$aK4VMv8fxUUTqyGK5NXkZOFJZo1WHpcTtNfdi46.dgn5eDSPZXKC6','Y0lpgihs1pn85USZtGRC0whO5cChJvQABxtDcUTCdFUJNaGxzM0AtQLAdNuU','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:54:22',62,'2021-12-17 14:54:22',0),(65,'Usuario','SL01LA62@email.com','2021-12-17 01:25:53','SL01LA62','$2y$10$Dm3ymWUScQiHL8dGuvA9S.vAtKm.zBad8TOk1EEb9nyXTIQz4jyjy','yMObGW49xIK4alG3Ndbh5E5gN1PQeccNb0tQKzHRZcKwDrrqQlR7d4LuRzqH','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:55:31',63,'2021-12-17 14:55:31',0),(66,'Usuario','SL01LA63@email.com','2021-12-17 01:25:53','SL01LA63','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',64,NULL,1),(67,'Usuario','SL01LA64@email.com','2021-12-17 01:25:53','SL01LA64','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',65,NULL,1),(68,'Usuario','SL03LA01@email.com','2021-12-17 01:25:53','SL03LA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',66,NULL,1),(69,'Usuario','SL03LA02@email.com','2021-12-17 01:25:53','SL03LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',67,NULL,1),(70,'Hever Egoavil','SL03LA03@email.com','2021-12-17 01:25:53','SL03LA03','$2y$10$B3f0pD/U8UfYhSh8F1iaBOLOnWSbJoI14MCLV8CGK4JKShWHbubNG',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 09:59:44',68,'2021-12-17 09:59:43',0),(71,'Jose Luis Guerreros Lazo','SL03LA04@email.com','2021-12-17 01:25:53','SL03LA04','$2y$10$TXk5/FNTarsSPCKvkflgH.TS/Gc6GyF5kcn7EbUdHA1IgSFKaBSe.',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:54:06',69,'2021-12-17 14:54:06',0),(72,'Orlando Pomalaza','SL03LA05@email.com','2021-12-17 01:25:53','SL03LA05','$2y$10$2qKHpvnDe8Sku.H0xFU8vOv45wkpYHOIuSQcvd/rpI46aoqWjZrcm','GMtBaSJQRaJVs0RKbVMS0etiLzH8L5zS6dapFQ59m7Lw2SmLpXPLOWrRFswT','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:56:22',70,'2021-12-17 14:56:22',0),(73,'Usuario','F01L01LA01@email.com','2021-12-17 01:25:53','F01L01LA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',71,NULL,1),(74,'Usuario','F01L01LA02@email.com','2021-12-17 01:25:53','F01L01LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',72,NULL,1),(75,'Usuario','F01L01LA03@email.com','2021-12-17 01:25:53','F01L01LA03','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',73,NULL,1),(76,'Yarleny Huanay Quispe','F01L01LA04@email.com','2021-12-17 01:25:53','F01L01LA04','$2y$10$l3ORwIfXwUPQb3Rq8If4G.M/.2LiCMvc22C1gCKIhHHFI5etLO5Qi',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:49:08',74,'2021-12-17 11:49:08',0),(77,'Usuario','F01L01LA05@email.com','2021-12-17 01:25:53','F01L01LA05','$2y$10$jAu1.bo8CTNA/Hv8mxYXNe8yMjmdWKIzSEmA5ssYsW6xe4EO.OytS','EsQxK2azNU099Xv5XhWEgSbI8VsAmlHZgnGGNNdePluzysXjqMTae09RqlPT','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:58:22',75,'2021-12-17 10:58:22',0),(78,'Usuario','F01L01LA06@email.com','2021-12-17 01:25:53','F01L01LA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',76,NULL,1),(79,'Usuario','F01L01LA07@email.com','2021-12-17 01:25:53','F01L01LA07','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',77,NULL,1),(80,'Usuario','F01L01LA08@email.com','2021-12-17 01:25:53','F01L01LA08','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',78,NULL,1),(81,'Usuario','F01L01LA09@email.com','2021-12-17 01:25:53','F01L01LA09','$2y$10$elFb8P2.7nVTH9jjE2CSW.vpxW0ZiPnGHCnGkcP7/VFfwTja8b32e',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 09:59:31',79,'2021-12-17 09:59:31',0),(82,'Usuario','F01L01LA10@email.com','2021-12-17 01:25:53','F01L01LA10','$2y$10$huz.g4CgAjGPd5/Fzhe1ou0c20bu7ATBoXPQ6Y1imGuGWXshfrRQC',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:02:20',80,'2021-12-17 10:02:20',0),(83,'Usuario','F01L01LA11@email.com','2021-12-17 01:25:53','F01L01LA11','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',81,NULL,1),(84,'Usuario','F01L01LA12@email.com','2021-12-17 01:25:53','F01L01LA12','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',82,NULL,1),(85,'Usuario','F01L01LA13@email.com','2021-12-17 01:25:53','F01L01LA13','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',83,NULL,1),(86,'Usuario','F01L02LA01@email.com','2021-12-17 01:25:53','F01L02LA01','$2y$10$VEeAXOthcbfF8yhl2HbPh.cgKXN1XI.NqjNHimlO5rPIXRFbj3nbq',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 09:56:14',84,'2021-12-17 09:56:14',0),(87,'Usuario','F01L02LA02@email.com','2021-12-17 01:25:53','F01L02LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',85,NULL,1),(88,'Usuario','F01L02LA03@email.com','2021-12-17 01:25:53','F01L02LA03','$2y$10$oy2wyT3FegirplMHuy0jEeVh7sWityWMpAyH3AzFsGmdwuFQMbjqq',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 11:48:58',86,'2021-12-17 11:48:58',0),(89,'Usuario','F01L02LA04@email.com','2021-12-17 01:25:53','F01L02LA04','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',87,NULL,1),(90,'Usuario','F01L02LA05@email.com','2021-12-17 01:25:53','F01L02LA05','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',88,NULL,1),(91,'Usuario','F01L02LA06@email.com','2021-12-17 01:25:53','F01L02LA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',89,NULL,1),(92,'Usuario','F02L01LA01@email.com','2021-12-17 01:25:53','F02L01LA01','$2y$10$HkUnJGZ47OylA2SCJZqSnOFLoufg.g219qsmb.8Cc6RaZ9YTGbTrG','8uRSmPZRMBhZE9QDBfsQKinrHapSdVb8aQmUCSOkAvqRHI6nLYiDfi6CItUR','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 09:49:01',90,'2021-12-17 09:49:01',0),(93,'Usuario','F02L01LA02@email.com','2021-12-17 01:25:53','F02L01LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',91,NULL,1),(94,'Usuario','F02L01LA03@email.com','2021-12-17 01:25:53','F02L01LA03','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',92,NULL,1),(95,'Usuario','F02L01LA04@email.com','2021-12-17 01:25:53','F02L01LA04','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',93,NULL,1),(96,'Usuario','F02L01LA05@email.com','2021-12-17 01:25:53','F02L01LA05','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',94,NULL,1),(97,'Usuario','F02L01LA06@email.com','2021-12-17 01:25:53','F02L01LA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',95,NULL,1),(98,'Usuario','F02L01LA07@email.com','2021-12-17 01:25:53','F02L01LA07','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',96,NULL,1),(99,'Usuario','F02L01LA08@email.com','2021-12-17 01:25:53','F02L01LA08','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',97,NULL,1),(100,'Usuario','F02L01LA09@email.com','2021-12-17 01:25:53','F02L01LA09','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',98,NULL,1),(101,'Usuario','F02L01LA10@email.com','2021-12-17 01:25:53','F02L01LA10','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',99,NULL,1),(102,'Usuario','F02L01LA11@email.com','2021-12-17 01:25:53','F02L01LA11','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',100,NULL,1),(103,'Usuario','F03L01LA01@email.com','2021-12-17 01:25:53','F03L01LA01','$2y$10$ec381qL/rVupbVPYrz0OaOYZ9tpWoa.3BoAZk9jLZHDYQgnjAfYgG','fwcWMK4axZZ5Ry1PwoW4dazhmLOAUtTshVKdSOYfxNbv5udtkGe9hiyMavnr','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 10:09:11',101,'2021-12-17 10:09:10',0),(104,'Usuario','F03L01LA02@email.com','2021-12-17 01:25:53','F03L01LA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',102,NULL,1),(105,'Usuario','F03L01LA03@email.com','2021-12-17 01:25:53','F03L01LA03','$2y$10$gwglfKH6MtpDHFIF5NyDTuBtxpzD2OTAId6KtV80Edln.HaG7g0L.','20K6UvENWwrVpVO792826xmoWLKS96G18Pj2j4PDoL2pnGbxUArI3TKQsg2V','AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 09:53:41',103,'2021-12-17 09:53:41',0),(106,'Usuario','F03L01LA04@email.com','2021-12-17 01:25:53','F03L01LA04','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',104,NULL,1),(107,'Usuario','F03L01LA05@email.com','2021-12-17 01:25:53','F03L01LA05','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',105,NULL,1),(108,'Usuario','F03L01LA06@email.com','2021-12-17 01:25:53','F03L01LA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',106,NULL,1),(109,'Usuario','F04L01LA01@email.com','2021-12-17 01:25:53','F04L01LA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',107,NULL,1),(110,'Hugo Fernando cañari marticorena','F04L01LA02@email.com','2021-12-17 01:25:53','F04L01LA02','$2y$10$qsMd.9vmS.yayzX1uwzbT.NzP5KpMafYLnMjD3avakdoRqOYXkqYC',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 14:49:00',108,'2021-12-17 14:48:59',0),(111,'Usuario','SL01TA01@email.com','2021-12-17 01:25:53','SL01TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',109,NULL,1),(112,'Usuario','SL01TA02@email.com','2021-12-17 01:25:53','SL01TA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',110,NULL,1),(113,'Usuario','SL01TA03@email.com','2021-12-17 01:25:53','SL01TA03','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',111,NULL,1),(114,'Usuario','SL01TA04@email.com','2021-12-17 01:25:53','SL01TA04','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',112,NULL,1),(115,'Usuario','SL01TA05@email.com','2021-12-17 01:25:53','SL01TA05','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',113,NULL,1),(116,'Usuario','SL01TA06@email.com','2021-12-17 01:25:53','SL01TA06','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',114,NULL,1),(117,'Usuario','SL01TA07@email.com','2021-12-17 01:25:53','SL01TA07','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',115,NULL,1),(118,'Usuario','SL01TA08@email.com','2021-12-17 01:25:53','SL01TA08','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',116,NULL,1),(119,'Usuario','SL01TA09@email.com','2021-12-17 01:25:53','SL01TA09','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',117,NULL,1),(120,'Usuario','SL01TA10@email.com','2021-12-17 01:25:53','SL01TA10','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',118,NULL,1),(121,'Usuario','SL01TA11@email.com','2021-12-17 01:25:53','SL01TA11','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',119,NULL,1),(122,'Usuario','SL01TA12@email.com','2021-12-17 01:25:53','SL01TA12','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',120,NULL,1),(123,'Usuario','SL01TA13@email.com','2021-12-17 01:25:53','SL01TA13','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',121,NULL,1),(124,'Usuario','SL03TA01@email.com','2021-12-17 01:25:53','SL03TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',122,NULL,1),(125,'Usuario','SL03TA02@email.com','2021-12-17 01:25:53','SL03TA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',123,NULL,1),(126,'Usuario','F01L02TA01@email.com','2021-12-17 01:25:53','F01L02TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',124,NULL,1),(127,'Usuario','F01L01TA01@email.com','2021-12-17 01:25:53','F01L01TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',125,NULL,1),(128,'Usuario','F03L01TA01@email.com','2021-12-17 01:25:53','F03L01TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',126,NULL,1),(129,'Usuario','F04L01TA01@email.com','2021-12-17 01:25:53','F04L01TA01','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',127,NULL,1),(130,'Usuario','F04L01TA02@email.com','2021-12-17 01:25:53','F04L01TA02','$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',128,NULL,1),(131,'Usuario','','2021-12-17 01:25:53',NULL,'$2y$10$MNHsoAgN6dYDW901T..sPOQzKccemURhY0s0Bpdabt0xMUnYIkEGO',NULL,'AC',0,NULL,NULL,'2021-12-17 01:25:53','2021-12-17 01:25:53',129,NULL,1),(259,'EDISON','admin@gmail.com',NULL,'edison','$2y$10$qgjd8gu7f/Q7YYMeuARAWe9SW1Bh5ma.AMzXLKIP/gvuP3UFnzYLO',NULL,'AC',0,NULL,NULL,'2021-12-20 10:13:33','2021-12-20 10:13:33',107,NULL,1),(261,'EDISON','admin@gmail.com',NULL,'edison','$2y$10$JOe7VwKyaZL8IAcSp96./eLAvrp6GylBnW00Dzu9hKUeWYmq4sc2q',NULL,'AC',0,NULL,NULL,'2021-12-20 10:19:07','2021-12-20 10:19:07',107,NULL,1),(262,'STEFANY','admin@gmail.com',NULL,'laboratorio','$2y$10$282a63aM0wPRzv6chKczceOw7MTh/63ElBjCHB6xEapxnlrnCRT8e',NULL,'AC',0,NULL,NULL,'2021-12-21 09:36:15','2021-12-21 09:36:15',53,NULL,1),(263,'EDWIN MAYON SANCHEZ','admin@gmail.com',NULL,'emayon','$2y$10$hKktos8sIVYqVUqd7c8lLOmlE5s4Ao7J5FcieJw2OTdN38w0jhIBu',NULL,'AC',0,NULL,NULL,'2021-12-21 09:38:09','2021-12-21 10:17:00',258,'2021-12-21 09:39:19',0),(264,'Usuario Almacen','sdsad@sd.sd',NULL,'general','$2y$10$RvLw7X8H.yfPf0ycrkzlsuAVlyIolur3paVM2pBiymnXx23/ikOKu',NULL,'AC',0,NULL,NULL,'2021-12-21 11:27:13','2021-12-21 11:27:36',1,'2021-12-21 11:27:36',0);

/*Table structure for table `tb_usuariopermiso` */

DROP TABLE IF EXISTS `tb_usuariopermiso`;

CREATE TABLE `tb_usuariopermiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) unsigned DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_usuarioreg` int(11) DEFAULT NULL,
  `id_usuariomod` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `tb_usuariopermiso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`),
  CONSTRAINT `tb_usuariopermiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `tb_permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_usuariopermiso` */

insert  into `tb_usuariopermiso`(`id`,`id_usuario`,`id_permiso`,`created_at`,`updated_at`,`id_usuarioreg`,`id_usuariomod`) values (1,1,1,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
