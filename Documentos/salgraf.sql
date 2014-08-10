
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.143.157
-- Generation Time: Jul 17, 2014 at 07:15 PM
-- Server version: 5.5.37
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `salgraf`
--

-- --------------------------------------------------------
-- -----------------------------------------------------
-- Schema srijrcscarrillo
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `salgraf` ;
CREATE SCHEMA IF NOT EXISTS `salgraf` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `salgraf` ;
--
-- Table structure for table `Archivo`
--
-- Creation: Jul 07, 2014 at 04:22 PM
--

CREATE TABLE `Archivo` (
  `idArchivo` int(11) NOT NULL AUTO_INCREMENT,
  `ArchivoNombre` varchar(255) NOT NULL,
  `ArchivoGenerado` date DEFAULT NULL,
  `ArchivoDescargado` date DEFAULT NULL,
  `ArchivoProcesado` date DEFAULT NULL,
  `ArchivoStatus` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idArchivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `Autorizados`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Autorizados` (
  `idAutorizados` int(11) NOT NULL AUTO_INCREMENT,
  `AutorizadosFechaHora` datetime DEFAULT NULL,
  `AutorizadosRUC` int(11) DEFAULT NULL,
  `AutorizadosCodigo` int(11) DEFAULT NULL,
  `AutorizadosAdvertencia` varchar(300) DEFAULT NULL,
  `Comprobantes_idComprobantes` int(11) NOT NULL,
  PRIMARY KEY (`idAutorizados`,`Comprobantes_idComprobantes`),
  KEY `fk_Autorizados_Comprobantes1_idx` (`Comprobantes_idComprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ClaveAsignada`
--
-- Creation: Jun 20, 2014 at 11:24 AM
-- Last update: Jun 20, 2014 at 11:33 AM
--

CREATE TABLE `ClaveAsignada` (
  `idClaveAsignada` int(11) NOT NULL AUTO_INCREMENT,
  `ClaveAsignadaDoc` int(2) NOT NULL,
  `ClaveAsignadaNumero` int(8) NOT NULL,
  `ClaveAsignadaTransito` tinyint(1) NOT NULL,
  `ClaveAsignadaUsada` tinyint(1) NOT NULL,
  `ClaveAsignadaFecha` datetime NOT NULL,
  `ClaveAsignadaReferencia` int(8) NOT NULL,
  PRIMARY KEY (`idClaveAsignada`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3002 ;

-- --------------------------------------------------------

--
-- Table structure for table `Comprobantes`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Comprobantes` (
  `idComprobantes` int(11) NOT NULL,
  `ComprobantesNumero` int(11) DEFAULT NULL,
  `ComprobantesRazon` varchar(300) DEFAULT NULL,
  `ComprobantesID` int(11) DEFAULT NULL,
  `ComprobantesFechaEmision` date DEFAULT NULL,
  `ComprobantesGuia` int(11) DEFAULT NULL COMMENT 'ComprobantesGuia Solo se utiliza en las facturas',
  `ComprobantesFacturaModificaTipo` int(11) DEFAULT NULL,
  `ComprobantesFacturaModificaNumero` int(11) DEFAULT NULL,
  `ComprobantesFacRetModificaTipo` int(11) DEFAULT NULL,
  `ComprobantesFacRetModificaNumero` int(11) DEFAULT NULL,
  `ComprobantesEjercicio` int(11) DEFAULT NULL,
  `ComprobantesCodigo` int(11) DEFAULT NULL,
  `ComprobantesVerificador` int(11) DEFAULT NULL,
  `Facturas_idFacturas` int(11) NOT NULL,
  PRIMARY KEY (`idComprobantes`),
  KEY `fk_Comprobantes_Facturas1_idx` (`Facturas_idFacturas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ComprobantesHistoria`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `ComprobantesHistoria` (
  `idHistoria` int(11) NOT NULL AUTO_INCREMENT,
  `HistoriaEstado` varchar(45) DEFAULT NULL,
  `HistoriaMensaje` varchar(45) DEFAULT NULL COMMENT 'En esta tabla se guardara la historia del estado de los comprobantes, se podra acceder a todas las instancias del comprobante',
  `HistoriaFechaEvento` date DEFAULT NULL,
  `Comprobantes_idComprobantes` int(11) NOT NULL,
  PRIMARY KEY (`idHistoria`,`Comprobantes_idComprobantes`),
  KEY `fk_ComprobantesHistoria_Comprobantes1_idx` (`Comprobantes_idComprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Contribuyente`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Contribuyente` (
  `idContribuyente` int(11) NOT NULL AUTO_INCREMENT,
  `ContribuyenteRUC` bigint(13) DEFAULT NULL,
  `ContribuyenteRazon` varchar(300) DEFAULT NULL,
  `ContribuyenteNombreComercial` varchar(300) DEFAULT NULL,
  `ContribuyenteDirMatriz` varchar(300) DEFAULT NULL,
  `ContribuyenteDirEmisor` varchar(300) DEFAULT NULL,
  `ContribuyenteCodEmisor` int(3) unsigned zerofill DEFAULT NULL,
  `ContribuyentePunto` int(3) unsigned zerofill DEFAULT NULL,
  `ContribuyenteResolucion` int(5) DEFAULT NULL,
  `ContribuyenteLlevaContabilidad` varchar(2) DEFAULT NULL,
  `ContribuyenteLogo` longblob,
  `ContribuyenteAmbiente` int(1) DEFAULT NULL,
  `ContribuyenteEmision` int(1) DEFAULT NULL,
  PRIMARY KEY (`idContribuyente`),
  KEY `id_estab_emision` (`ContribuyenteCodEmisor`,`ContribuyentePunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `FacturaDetalle`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `FacturaDetalle` (
  `idFacturaDetalle` int(11) NOT NULL,
  `FacturaDetalleCodigo` varchar(45) DEFAULT NULL,
  `FacturaDetalleAuxiliar` varchar(45) DEFAULT NULL,
  `FacturaDetalleDescripcion` varchar(300) DEFAULT NULL,
  `FacturaDetallePrecioUnitario` decimal(11,2) DEFAULT NULL,
  `FacturaDetalleCantidad` decimal(11,2) DEFAULT NULL,
  `FacturaDetallePrecioTotal` decimal(11,2) DEFAULT NULL,
  `FacturaDetalleDescuento` decimal(11,2) DEFAULT NULL,
  `FacturaDetalleCodImpto` int(11) DEFAULT NULL,
  `FacturaDetallePorcentaje` int(11) DEFAULT NULL,
  `FacturaDetalleBaseImponible` decimal(11,2) DEFAULT NULL,
  `FacturaDetalleValor` decimal(11,2) DEFAULT NULL,
  `FacturaDetalleTarifa` int(11) DEFAULT NULL,
  `FacturaDetalleIdFactura` int(11) DEFAULT NULL,
  `Facturas_idFacturas` int(11) NOT NULL,
  PRIMARY KEY (`idFacturaDetalle`,`Facturas_idFacturas`),
  KEY `fk_FacturaDetalle_Facturas1_idx` (`Facturas_idFacturas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Facturas`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Facturas` (
  `idFacturas` int(11) NOT NULL,
  `FacturasAmbiente` varchar(1) DEFAULT NULL,
  `FacturasTipoEmision` varchar(1) DEFAULT NULL,
  `FacturasRazon` varchar(300) DEFAULT NULL,
  `FacturasComercial` varchar(300) DEFAULT NULL,
  `FacturasRuc` int(11) DEFAULT NULL,
  `FacturasClaveAcceso` varchar(45) DEFAULT NULL,
  `FacturasEstab` varchar(45) DEFAULT NULL,
  `FacturasCodDoc` varchar(2) DEFAULT NULL,
  `FacturasPunto` varchar(3) DEFAULT NULL,
  `FacturasSq` int(11) DEFAULT NULL,
  `FacturasDirMatriz` varchar(300) DEFAULT NULL,
  `FacturasFechaEmision` date DEFAULT NULL,
  `FacturasDirEstab` varchar(300) DEFAULT NULL,
  `FacturasContEsp` varchar(2) DEFAULT NULL,
  `FacturasLlevaContab` varchar(2) DEFAULT NULL,
  `FacturasTipoId` int(11) DEFAULT NULL,
  `FacturasNroId` int(11) DEFAULT NULL,
  `FacturasGuia` varchar(45) DEFAULT NULL,
  `FacturasRazonComprador` varchar(300) DEFAULT NULL,
  `FacturasTotalImpto` decimal(11,2) DEFAULT NULL,
  `FacturasPropina` decimal(11,2) DEFAULT NULL,
  `FacturasImporteTotal` decimal(11,2) DEFAULT NULL,
  `FacturasMoneda` varchar(1) DEFAULT NULL,
  `idComprobantes` int(11) DEFAULT NULL,
  `IDKEY` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idFacturas`,`IDKEY`),
  KEY `fk_Facturas_invoice1_idx` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Guias`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Guias` (
  `idGuias` int(11) NOT NULL,
  `GuiasNumero` int(11) DEFAULT NULL,
  `GuiasRazon` varchar(300) DEFAULT NULL,
  `GuiasID` int(11) DEFAULT NULL,
  `GuiasPartida` varchar(300) DEFAULT NULL,
  `GuiasDestino` varchar(300) DEFAULT NULL COMMENT 'Esta es la direccion del punto de destino',
  `GuiasRazonTransportista` varchar(300) DEFAULT NULL,
  `GuiasTrasnportistaID` int(11) DEFAULT NULL,
  `GuiasPlaca` varchar(20) DEFAULT NULL,
  `GuiasMercaderia` varchar(300) DEFAULT NULL,
  `GuiasCantidad` decimal(13,2) DEFAULT NULL,
  `GuiasMotivo` varchar(300) DEFAULT NULL,
  `GuiasFactura` int(11) DEFAULT NULL COMMENT 'Con este campo se establece la relacion con la factura que se esta utilizando para esta guia de remision',
  `GuiasDeclaracion` int(11) DEFAULT NULL,
  `GuiasInicioTransporte` date DEFAULT NULL,
  `GuiasFinTransporte` date DEFAULT NULL,
  `GuiasRuta` varchar(300) DEFAULT NULL,
  `GuiasEstablecimientoDestino` int(11) DEFAULT NULL,
  `GuiasCodigo` int(11) DEFAULT NULL,
  `GuiasVerificador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idGuias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Impuestos`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Impuestos` (
  `idImpuestos` int(11) NOT NULL,
  `ImpuestosTipoDoc` varchar(2) DEFAULT NULL,
  `ImpuestosNumeroDoc` int(11) DEFAULT NULL,
  `ImpuestosCodigo` int(11) DEFAULT NULL,
  `ImpuestosPorcentaje` int(11) DEFAULT NULL,
  `ImpuestosTarifa` int(11) DEFAULT NULL,
  `ImpuestosBaseImponible` decimal(11,2) DEFAULT NULL,
  `ImpuestosValor` decimal(11,2) DEFAULT NULL,
  `ImpuestosIdFacturas` int(11) DEFAULT NULL,
  `Facturas_idFacturas` int(11) NOT NULL,
  PRIMARY KEY (`idImpuestos`,`Facturas_idFacturas`),
  KEY `fk_Impuestos_Facturas_idx` (`Facturas_idFacturas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `Solicitados`
--
-- Creation: Jun 06, 2014 at 05:10 AM
--

CREATE TABLE `Solicitados` (
  `idSolicitados` int(11) NOT NULL DEFAULT '0',
  `SolicitadosFechaEmision` date DEFAULT NULL,
  `SolicitadosRUC` int(11) DEFAULT NULL,
  `SolicitadosAmbiente` int(11) DEFAULT NULL,
  `SolicitadosSerie` int(11) DEFAULT NULL,
  `SolicitadosNumeroComprobante` int(10) unsigned zerofill DEFAULT NULL,
  `SolicitadosCodigoDelSRI` int(11) DEFAULT NULL,
  `SolicitadosEmision` int(11) DEFAULT NULL,
  `SolicitadosAutoVerificador` int(11) DEFAULT NULL COMMENT 'Esta es la tabla de todos los comprobantes que ya tienen asignados un codigo numerico asignado por el SRI, mas el digito autoverificador, calculado en modulo 11.',
  `Comprobantes_idComprobantes` int(11) NOT NULL,
  PRIMARY KEY (`idSolicitados`,`Comprobantes_idComprobantes`),
  KEY `fk_Solicitados_Comprobantes1_idx` (`Comprobantes_idComprobantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--
-- Creation: Jun 22, 2014 at 06:27 AM
-- Last update: Jul 17, 2014 at 02:57 PM
--

CREATE TABLE `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `UsuariosEmail` varchar(50) NOT NULL,
  `UsuariosPassword` varchar(64) NOT NULL,
  `UsuariosHabilitado` tinyint(1) NOT NULL,
  `UsuariosNombre` varchar(30) NOT NULL,
  `UsuariosApellido` varchar(30) NOT NULL,
  `UsuariosEstado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Autorizados`
--
ALTER TABLE `Autorizados`
  ADD CONSTRAINT `fk_Autorizados_Comprobantes1` FOREIGN KEY (`Comprobantes_idComprobantes`) REFERENCES `Comprobantes` (`idComprobantes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Comprobantes`
--
ALTER TABLE `Comprobantes`
  ADD CONSTRAINT `fk_Comprobantes_Facturas1` FOREIGN KEY (`Facturas_idFacturas`) REFERENCES `Facturas` (`idFacturas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ComprobantesHistoria`
--
ALTER TABLE `ComprobantesHistoria`
  ADD CONSTRAINT `fk_ComprobantesHistoria_Comprobantes1` FOREIGN KEY (`Comprobantes_idComprobantes`) REFERENCES `Comprobantes` (`idComprobantes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `FacturaDetalle`
--
ALTER TABLE `FacturaDetalle`
  ADD CONSTRAINT `fk_FacturaDetalle_Facturas1` FOREIGN KEY (`Facturas_idFacturas`) REFERENCES `Facturas` (`idFacturas`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Constraints for table `Impuestos`
--
ALTER TABLE `Impuestos`
  ADD CONSTRAINT `fk_Impuestos_Facturas` FOREIGN KEY (`Facturas_idFacturas`) REFERENCES `Facturas` (`idFacturas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Solicitados`
--
ALTER TABLE `Solicitados`
  ADD CONSTRAINT `fk_Solicitados_Comprobantes1` FOREIGN KEY (`Comprobantes_idComprobantes`) REFERENCES `Comprobantes` (`idComprobantes`) ON DELETE NO ACTION ON UPDATE NO ACTION;
