SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema quickbooks
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema salgraf
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `salgraf` DEFAULT CHARACTER SET utf8 ;
USE `salgraf` ;

-- -----------------------------------------------------
-- Table `salgraf`.`archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`archivo` (
  `idArchivo` INT(11) NOT NULL AUTO_INCREMENT,
  `ArchivoNombre` VARCHAR(255) NOT NULL,
  `ArchivoGenerado` DATE NULL DEFAULT NULL,
  `ArchivoDescargado` DATE NULL DEFAULT NULL,
  `ArchivoProcesado` DATE NULL DEFAULT NULL,
  `ArchivoStatus` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idArchivo`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`facturas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`facturas` (
  `idFacturas` INT(11) NOT NULL,
  `FacturasAmbiente` VARCHAR(1) NULL DEFAULT NULL,
  `FacturasTipoEmision` VARCHAR(1) NULL DEFAULT NULL,
  `FacturasRazon` VARCHAR(300) NULL DEFAULT NULL,
  `FacturasComercial` VARCHAR(300) NULL DEFAULT NULL,
  `FacturasRuc` INT(11) NULL DEFAULT NULL,
  `FacturasClaveAcceso` VARCHAR(45) NULL DEFAULT NULL,
  `FacturasEstab` VARCHAR(45) NULL DEFAULT NULL,
  `FacturasCodDoc` VARCHAR(2) NULL DEFAULT NULL,
  `FacturasPunto` VARCHAR(3) NULL DEFAULT NULL,
  `FacturasSq` INT(11) NULL DEFAULT NULL,
  `FacturasDirMatriz` VARCHAR(300) NULL DEFAULT NULL,
  `FacturasFechaEmision` DATE NULL DEFAULT NULL,
  `FacturasDirEstab` VARCHAR(300) NULL DEFAULT NULL,
  `FacturasContEsp` VARCHAR(2) NULL DEFAULT NULL,
  `FacturasLlevaContab` VARCHAR(2) NULL DEFAULT NULL,
  `FacturasTipoId` INT(11) NULL DEFAULT NULL,
  `FacturasNroId` INT(11) NULL DEFAULT NULL,
  `FacturasGuia` VARCHAR(45) NULL DEFAULT NULL,
  `FacturasRazonComprador` VARCHAR(300) NULL DEFAULT NULL,
  `FacturasTotalImpto` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturasPropina` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturasImporteTotal` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturasMoneda` VARCHAR(1) NULL DEFAULT NULL,
  `idComprobantes` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idFacturas`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`comprobantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`comprobantes` (
  `idComprobantes` INT(11) NOT NULL,
  `ComprobantesNumero` INT(11) NULL DEFAULT NULL,
  `ComprobantesRazon` VARCHAR(300) NULL DEFAULT NULL,
  `ComprobantesID` INT(11) NULL DEFAULT NULL,
  `ComprobantesFechaEmision` DATE NULL DEFAULT NULL,
  `ComprobantesGuia` INT(11) NULL DEFAULT NULL COMMENT 'ComprobantesGuia Solo se utiliza en las facturas',
  `ComprobantesFacturaModificaTipo` INT(11) NULL DEFAULT NULL,
  `ComprobantesFacturaModificaNumero` INT(11) NULL DEFAULT NULL,
  `ComprobantesFacRetModificaTipo` INT(11) NULL DEFAULT NULL,
  `ComprobantesFacRetModificaNumero` INT(11) NULL DEFAULT NULL,
  `ComprobantesEjercicio` INT(11) NULL DEFAULT NULL,
  `ComprobantesCodigo` INT(11) NULL DEFAULT NULL,
  `ComprobantesVerificador` INT(11) NULL DEFAULT NULL,
  `Facturas_idFacturas` INT(11) NOT NULL,
  PRIMARY KEY (`idComprobantes`),
  INDEX `fk_Comprobantes_Facturas1_idx` (`Facturas_idFacturas` ASC),
  CONSTRAINT `fk_Comprobantes_Facturas1`
    FOREIGN KEY (`Facturas_idFacturas`)
    REFERENCES `salgraf`.`facturas` (`idFacturas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`autorizados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`autorizados` (
  `idAutorizados` INT(11) NOT NULL AUTO_INCREMENT,
  `AutorizadosFechaHora` DATETIME NULL DEFAULT NULL,
  `AutorizadosRUC` INT(11) NULL DEFAULT NULL,
  `AutorizadosCodigo` INT(11) NULL DEFAULT NULL,
  `AutorizadosAdvertencia` VARCHAR(300) NULL DEFAULT NULL,
  `Comprobantes_idComprobantes` INT(11) NOT NULL,
  PRIMARY KEY (`idAutorizados`, `Comprobantes_idComprobantes`),
  INDEX `fk_Autorizados_Comprobantes1_idx` (`Comprobantes_idComprobantes` ASC),
  CONSTRAINT `fk_Autorizados_Comprobantes1`
    FOREIGN KEY (`Comprobantes_idComprobantes`)
    REFERENCES `salgraf`.`comprobantes` (`idComprobantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`claveasignada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`claveasignada` (
  `idClaveAsignada` INT(11) NOT NULL AUTO_INCREMENT,
  `ClaveAsignadaDoc` INT(2) NOT NULL,
  `ClaveAsignadaNumero` INT(8) NOT NULL,
  `ClaveAsignadaTransito` TINYINT(1) NOT NULL,
  `ClaveAsignadaUsada` TINYINT(1) NOT NULL,
  `ClaveAsignadaFecha` DATETIME NOT NULL,
  `ClaveAsignadaReferencia` INT(8) NOT NULL,
  PRIMARY KEY (`idClaveAsignada`))
ENGINE = MyISAM
AUTO_INCREMENT = 3002
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`comprobanteshistoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`comprobanteshistoria` (
  `idHistoria` INT(11) NOT NULL AUTO_INCREMENT,
  `HistoriaEstado` VARCHAR(45) NULL DEFAULT NULL,
  `HistoriaMensaje` VARCHAR(45) NULL DEFAULT NULL COMMENT 'En esta tabla se guardara la historia del estado de los comprobantes, se podra acceder a todas las instancias del comprobante',
  `HistoriaFechaEvento` DATE NULL DEFAULT NULL,
  `Comprobantes_idComprobantes` INT(11) NOT NULL,
  PRIMARY KEY (`idHistoria`, `Comprobantes_idComprobantes`),
  INDEX `fk_ComprobantesHistoria_Comprobantes1_idx` (`Comprobantes_idComprobantes` ASC),
  CONSTRAINT `fk_ComprobantesHistoria_Comprobantes1`
    FOREIGN KEY (`Comprobantes_idComprobantes`)
    REFERENCES `salgraf`.`comprobantes` (`idComprobantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`contribuyente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`contribuyente` (
  `idContribuyente` INT(11) NOT NULL AUTO_INCREMENT,
  `ContribuyenteRUC` BIGINT(13) NULL DEFAULT NULL,
  `ContribuyenteRazon` VARCHAR(300) NULL DEFAULT NULL,
  `ContribuyenteNombreComercial` VARCHAR(300) NULL DEFAULT NULL,
  `ContribuyenteDirMatriz` VARCHAR(300) NULL DEFAULT NULL,
  `ContribuyenteDirEmisor` VARCHAR(300) NULL DEFAULT NULL,
  `ContribuyenteCodEmisor` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `ContribuyentePunto` INT(3) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `ContribuyenteResolucion` INT(5) NULL DEFAULT NULL,
  `ContribuyenteLlevaContabilidad` VARCHAR(2) NULL DEFAULT NULL,
  `ContribuyenteLogo` LONGBLOB NULL DEFAULT NULL,
  `ContribuyenteAmbiente` INT(1) NULL DEFAULT NULL,
  `ContribuyenteEmision` INT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idContribuyente`),
  INDEX `id_estab_emision` (`ContribuyenteCodEmisor` ASC, `ContribuyentePunto` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`facturadetalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`facturadetalle` (
  `idFacturaDetalle` INT(11) NOT NULL,
  `FacturaDetalleCodigo` VARCHAR(45) NULL DEFAULT NULL,
  `FacturaDetalleAuxiliar` VARCHAR(45) NULL DEFAULT NULL,
  `FacturaDetalleDescripcion` VARCHAR(300) NULL DEFAULT NULL,
  `FacturaDetallePrecioUnitario` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetalleCantidad` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetallePrecioTotal` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetalleDescuento` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetalleCodImpto` INT(11) NULL DEFAULT NULL,
  `FacturaDetallePorcentaje` INT(11) NULL DEFAULT NULL,
  `FacturaDetalleBaseImponible` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetalleValor` DECIMAL(11,2) NULL DEFAULT NULL,
  `FacturaDetalleTarifa` INT(11) NULL DEFAULT NULL,
  `FacturaDetalleIdFactura` INT(11) NULL DEFAULT NULL,
  `Facturas_idFacturas` INT(11) NOT NULL,
  PRIMARY KEY (`idFacturaDetalle`, `Facturas_idFacturas`),
  INDEX `fk_FacturaDetalle_Facturas1_idx` (`Facturas_idFacturas` ASC),
  CONSTRAINT `fk_FacturaDetalle_Facturas1`
    FOREIGN KEY (`Facturas_idFacturas`)
    REFERENCES `salgraf`.`facturas` (`idFacturas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`guias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`guias` (
  `idGuias` INT(11) NOT NULL,
  `GuiasNumero` INT(11) NULL DEFAULT NULL,
  `GuiasRazon` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasID` INT(11) NULL DEFAULT NULL,
  `GuiasPartida` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasDestino` VARCHAR(300) NULL DEFAULT NULL COMMENT 'Esta es la direccion del punto de destino',
  `GuiasRazonTransportista` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasTrasnportistaID` INT(11) NULL DEFAULT NULL,
  `GuiasPlaca` VARCHAR(20) NULL DEFAULT NULL,
  `GuiasMercaderia` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasCantidad` DECIMAL(13,2) NULL DEFAULT NULL,
  `GuiasMotivo` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasFactura` INT(11) NULL DEFAULT NULL COMMENT 'Con este campo se establece la relacion con la factura que se esta utilizando para esta guia de remision',
  `GuiasDeclaracion` INT(11) NULL DEFAULT NULL,
  `GuiasInicioTransporte` DATE NULL DEFAULT NULL,
  `GuiasFinTransporte` DATE NULL DEFAULT NULL,
  `GuiasRuta` VARCHAR(300) NULL DEFAULT NULL,
  `GuiasEstablecimientoDestino` INT(11) NULL DEFAULT NULL,
  `GuiasCodigo` INT(11) NULL DEFAULT NULL,
  `GuiasVerificador` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idGuias`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`impuestos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`impuestos` (
  `idImpuestos` INT(11) NOT NULL,
  `ImpuestosTipoDoc` VARCHAR(2) NULL DEFAULT NULL,
  `ImpuestosNumeroDoc` INT(11) NULL DEFAULT NULL,
  `ImpuestosCodigo` INT(11) NULL DEFAULT NULL,
  `ImpuestosPorcentaje` INT(11) NULL DEFAULT NULL,
  `ImpuestosTarifa` INT(11) NULL DEFAULT NULL,
  `ImpuestosBaseImponible` DECIMAL(11,2) NULL DEFAULT NULL,
  `ImpuestosValor` DECIMAL(11,2) NULL DEFAULT NULL,
  `ImpuestosIdFacturas` INT(11) NULL DEFAULT NULL,
  `Facturas_idFacturas` INT(11) NOT NULL,
  PRIMARY KEY (`idImpuestos`, `Facturas_idFacturas`),
  INDEX `fk_Impuestos_Facturas_idx` (`Facturas_idFacturas` ASC),
  CONSTRAINT `fk_Impuestos_Facturas`
    FOREIGN KEY (`Facturas_idFacturas`)
    REFERENCES `salgraf`.`facturas` (`idFacturas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`solicitados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`solicitados` (
  `idSolicitados` INT(11) NOT NULL DEFAULT '0',
  `SolicitadosFechaEmision` DATE NULL DEFAULT NULL,
  `SolicitadosRUC` INT(11) NULL DEFAULT NULL,
  `SolicitadosAmbiente` INT(11) NULL DEFAULT NULL,
  `SolicitadosSerie` INT(11) NULL DEFAULT NULL,
  `SolicitadosNumeroComprobante` INT(10) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `SolicitadosCodigoDelSRI` INT(11) NULL DEFAULT NULL,
  `SolicitadosEmision` INT(11) NULL DEFAULT NULL,
  `SolicitadosAutoVerificador` INT(11) NULL DEFAULT NULL COMMENT 'Esta es la tabla de todos los comprobantes que ya tienen asignados un codigo numerico asignado por el SRI, mas el digito autoverificador, calculado en modulo 11.',
  `Comprobantes_idComprobantes` INT(11) NOT NULL,
  PRIMARY KEY (`idSolicitados`, `Comprobantes_idComprobantes`),
  INDEX `fk_Solicitados_Comprobantes1_idx` (`Comprobantes_idComprobantes` ASC),
  CONSTRAINT `fk_Solicitados_Comprobantes1`
    FOREIGN KEY (`Comprobantes_idComprobantes`)
    REFERENCES `salgraf`.`comprobantes` (`idComprobantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`usuarios` (
  `idUsuarios` INT(11) NOT NULL AUTO_INCREMENT,
  `UsuariosEmail` VARCHAR(50) NOT NULL,
  `UsuariosPassword` VARCHAR(64) NOT NULL,
  `UsuariosHabilitado` TINYINT(1) NOT NULL,
  `UsuariosNombre` VARCHAR(30) NOT NULL,
  `UsuariosApellido` VARCHAR(30) NOT NULL,
  `UsuariosEstado` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idUsuarios`))
ENGINE = MyISAM
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `salgraf`.`errores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `salgraf`.`errores` (
  `iderrores` INT NOT NULL AUTO_INCREMENT,
  `erroresTipo` VARCHAR(3) NULL,
  `erroresCodigo` VARCHAR(2) NULL,
  `erroresDescripcion` VARCHAR(150) NULL,
  `erroresAccion` VARCHAR(300) NULL,
  PRIMARY KEY (`iderrores`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
