-- MySQL Script generated by MySQL Workbench
-- Sun Mar  9 00:18:48 2025
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `biblioteca`.`Libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Libros` (
  `Id_Libros` INT NOT NULL,
  `Titulo` VARCHAR(60) NULL,
  `autor` VARCHAR(60) NULL,
  `ISBN` VARCHAR(45) NULL,
  `Categoria` VARCHAR(45) NULL,
  `Disponibilidad` VARCHAR(45) NULL,
  `Ubicacion_biblioteca` VARCHAR(45) NULL,
  `Resumen` VARCHAR(80) NULL,
  `Portada` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_Libros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Rol` (
  `Id_Rol_Rol` INT NOT NULL,
  `Nombre_rol` VARCHAR(45) NULL,
  PRIMARY KEY (`Id_Rol_Rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Usuarios` (
  `Id_Usuarios` INT NOT NULL,
  `Nombre` VARCHAR(50) NULL,
  `Telefono` VARCHAR(15) NULL,
  `Contrasena` VARCHAR(45) NULL,
  `confirmaContrasena` VARCHAR(45) NULL,
  `IDToken`  VARCHAR(255) NULL,
  `fecha` DATETIME NULL,
  `Correo_electronico` VARCHAR(45) NULL,
  `Estado` VARCHAR(20) NULL,
  `Rol_Id_Rol` INT NOT NULL,
  PRIMARY KEY (`Id_Usuarios`),
  INDEX `fk_Usuarios_Rol_idx` (`Rol_Id_Rol` ASC),
  CONSTRAINT `fk_Usuarios_Rol`
    FOREIGN KEY (`Rol_Id_Rol`)
    REFERENCES `biblioteca`.`Rol` (`Id_Rol_Rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Historial_Prestamos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Historial_Prestamos` (
  `Id_Historial_Prestamos` INT NOT NULL AUTO_INCREMENT,
  `Fecha_prestamo` DATE NULL,
  `Fecha_devolucion` DATE NULL,
  `Libros_Id_Libros` INT NOT NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  PRIMARY KEY (`Id_Historial_Prestamos`),
  INDEX `fk_Historial_Prestamos_Libros1_idx` (`Libros_Id_Libros` ASC),
  INDEX `fk_Historial_Prestamos_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  CONSTRAINT `fk_Historial_Prestamos_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Historial_Prestamos_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `biblioteca`.`Recomendaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Recomendaciones` (
  `Id_Recomendaciones` INT NOT NULL,
  `Fecha_calificacion` DATE NULL,
  `Calificacion` INT NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  `Libros_Id_Libros` INT NOT NULL,
  PRIMARY KEY (`Id_Recomendaciones`, `Usuarios_Id_Usuarios`, `Libros_Id_Libros`),
  INDEX `fk_Recomendaciones_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  INDEX `fk_Recomendaciones_Libros1_idx` (`Libros_Id_Libros` ASC),
  CONSTRAINT `fk_Recomendaciones_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recomendaciones_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Reservas` (
  `Id_Reservas` INT NOT NULL,
  `Fecha_reserva` DATE NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  `Libros_Id_Libros` INT NOT NULL,
  PRIMARY KEY (`Id_Reservas`, `Usuarios_Id_Usuarios`, `Libros_Id_Libros`),
  INDEX `fk_Reservas_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  INDEX `fk_Reservas_Libros1_idx` (`Libros_Id_Libros` ASC),
  CONSTRAINT `fk_Reservas_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reservas_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Comentarios` (
  `Id_Comentarios` INT NOT NULL,
  `Comentario` VARCHAR(45) NULL,
  `Evaluacion` VARCHAR(45) NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  `Libros_Id_Libros` INT NOT NULL,
  PRIMARY KEY (`Id_Comentarios`, `Usuarios_Id_Usuarios`, `Libros_Id_Libros`),
  INDEX `fk_Comentarios_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  INDEX `fk_Comentarios_Libros1_idx` (`Libros_Id_Libros` ASC),
  CONSTRAINT `fk_Comentarios_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comentarios_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Devoluciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Devoluciones` (
  `Id_Devoluciones` INT NOT NULL,
  `Fecha_devolucion` DATE NULL,
  `Historial_Prestamos_Id_Historial_Prestamos` INT NOT NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  PRIMARY KEY (`Id_Devoluciones`, `Usuarios_Id_Usuarios`),
  INDEX `fk_Devoluciones_Historial_Prestamos1_idx` (`Historial_Prestamos_Id_Historial_Prestamos` ASC),
  INDEX `fk_Devoluciones_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  CONSTRAINT `fk_Devoluciones_Historial_Prestamos1`
    FOREIGN KEY (`Historial_Prestamos_Id_Historial_Prestamos`)
    REFERENCES `biblioteca`.`Historial_Prestamos` (`Id_Historial_Prestamos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Devoluciones_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Catalogo_Libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Catalogo_Libros` (
  `Id_Catalogo_Libros` INT NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Libros_Id_Libros` INT NOT NULL,
  PRIMARY KEY (`Id_Catalogo_Libros`, `Libros_Id_Libros`),
  INDEX `fk_Catalogo_Libros_Libros1_idx` (`Libros_Id_Libros` ASC),
  CONSTRAINT `fk_Catalogo_Libros_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Notificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Notificaciones` (
  `Id_Notificaciones` INT NOT NULL,
  `Mensaje` VARCHAR(90) NULL,
  `Fecha_envio` DATE NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  PRIMARY KEY (`Id_Notificaciones`, `Usuarios_Id_Usuarios`),
  INDEX `fk_Notificaciones_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  CONSTRAINT `fk_Notificaciones_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Pedidos` (
  `Id_Pedidos` INT NOT NULL,
  `Fecha_pedidos` DATE NULL,
  `Monto_total` INT NULL,
  `Estado_pedido` VARCHAR(45) NULL,
  `Usuarios_Id_Usuarios` INT NOT NULL,
  PRIMARY KEY (`Id_Pedidos`, `Usuarios_Id_Usuarios`),
  INDEX `fk_Pedidos_Usuarios1_idx` (`Usuarios_Id_Usuarios` ASC),
  CONSTRAINT `fk_Pedidos_Usuarios1`
    FOREIGN KEY (`Usuarios_Id_Usuarios`)
    REFERENCES `biblioteca`.`Usuarios` (`Id_Usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Detalle_Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Detalle_Pedidos` (
  `Id_Detalle_Pedidos` INT NOT NULL,
  `Cantidad` INT NULL,
  `Precio_unitario` INT NULL,
  `Pedidos_Id_Pedidos` INT NOT NULL,
  `Libros_Id_Libros` INT NOT NULL,
  PRIMARY KEY (`Id_Detalle_Pedidos`, `Pedidos_Id_Pedidos`, `Libros_Id_Libros`),
  INDEX `fk_Detalle_Pedidos_Pedidos1_idx` (`Pedidos_Id_Pedidos` ASC),
  INDEX `fk_Detalle_Pedidos_Libros1_idx` (`Libros_Id_Libros` ASC),
  CONSTRAINT `fk_Detalle_Pedidos_Pedidos1`
    FOREIGN KEY (`Pedidos_Id_Pedidos`)
    REFERENCES `biblioteca`.`Pedidos` (`Id_Pedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_Pedidos_Libros1`
    FOREIGN KEY (`Libros_Id_Libros`)
    REFERENCES `biblioteca`.`Libros` (`Id_Libros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Pagos` (
  `Id_Pagos` INT NOT NULL,
  `Fecha_pago` DATE NULL,
  `Monto_pago` INT NULL,
  `Metodo_pago` VARCHAR(45) NULL,
  `Pedidos_Id_Pedidos` INT NOT NULL,
  PRIMARY KEY (`Id_Pagos`, `Pedidos_Id_Pedidos`),
  INDEX `fk_Pagos_Pedidos1_idx` (`Pedidos_Id_Pedidos` ASC),
  CONSTRAINT `fk_Pagos_Pedidos1`
    FOREIGN KEY (`Pedidos_Id_Pedidos`)
    REFERENCES `biblioteca`.`Pedidos` (`Id_Pedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`Envios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`Envios` (
  `Id_Envios` INT NOT NULL,
  `Fecha_envio` DATE NULL,
  `Direccion_envio` VARCHAR(60) NULL,
  `Pedidos_Id_Pedidos` INT NOT NULL,
  PRIMARY KEY (`Id_Envios`, `Pedidos_Id_Pedidos`),
  INDEX `fk_Envios_Pedidos1_idx` (`Pedidos_Id_Pedidos` ASC),
  CONSTRAINT `fk_Envios_Pedidos1`
    FOREIGN KEY (`Pedidos_Id_Pedidos`)
    REFERENCES `biblioteca`.`Pedidos` (`Id_Pedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `biblioteca` ;

-- -----------------------------------------------------
-- Placeholder table for view `biblioteca`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`view1` (`id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `biblioteca`.`view2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`view2` (`id` INT);


/*procedimientos almacenados*/
