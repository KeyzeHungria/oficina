-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema oficina
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema oficina
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `oficina` DEFAULT CHARACTER SET utf8 ;
USE `oficina` ;

-- -----------------------------------------------------
-- Table `oficina`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(300) NOT NULL DEFAULT '',
  `telefone` VARCHAR(15) NOT NULL DEFAULT '',
  `email` VARCHAR(45) NOT NULL DEFAULT '',
  `logradouro` VARCHAR(45) NOT NULL DEFAULT '',
  `numero` VARCHAR(10) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL DEFAULT '',
  `complemento` VARCHAR(45) NULL DEFAULT '',
  `cep` VARCHAR(9) NOT NULL DEFAULT '',
  `cpf` VARCHAR(14) NOT NULL DEFAULT '',
  `data_de_nascimento` DATETIME NOT NULL,
  `cidade` VARCHAR(45) NOT NULL DEFAULT '',
  `estado` CHAR(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`idcliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`funcionario` (
  `idfuncionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(300) NOT NULL DEFAULT '',
  `tipo_funcionario` VARCHAR(45) NOT NULL DEFAULT '',
  `telefone` VARCHAR(15) NOT NULL DEFAULT '',
  `email` VARCHAR(45) NOT NULL DEFAULT '',
  `logradouro` VARCHAR(45) NOT NULL DEFAULT '',
  `numero` VARCHAR(10) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL DEFAULT '',
  `complemento` VARCHAR(45) NULL DEFAULT '',
  `cep` VARCHAR(9) NOT NULL DEFAULT '',
  `cpf` VARCHAR(14) NOT NULL DEFAULT '',
  `data_de_nascimento` DATETIME NOT NULL,
  `cidade` VARCHAR(45) NOT NULL DEFAULT '',
  `estado` CHAR(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`idfuncionario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`veiculo` (
  `idveiculo` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(45) NOT NULL DEFAULT '',
  `ano` YEAR NOT NULL,
  `placa` VARCHAR(8) NOT NULL DEFAULT '',
  `chassi` VARCHAR(17) NOT NULL DEFAULT '',
  `marca` VARCHAR(45) NOT NULL DEFAULT '',
  `idcliente` INT NOT NULL,
  PRIMARY KEY (`idveiculo`),
  INDEX `fk_veiculo_cliente1_idx` (`idcliente` ASC) VISIBLE,
  CONSTRAINT `fk_veiculo_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `oficina`.`cliente` (`idcliente`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`agendamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`agendamento` (
  `idagendamento` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `horario` TIME NOT NULL,
  `status_agendamento` VARCHAR(45) NOT NULL DEFAULT 'agendado',
  `idcliente` INT NOT NULL,
  `idveiculo` INT NOT NULL,
  PRIMARY KEY (`idagendamento`),
  INDEX `fk_agendamento_cliente_idx` (`idcliente` ASC) VISIBLE,
  INDEX `fk_agendamento_veiculo1_idx` (`idveiculo` ASC) VISIBLE,
  UNIQUE INDEX `unico_cliente_horario` (`data` ASC, `horario` ASC, `idcliente` ASC) VISIBLE,
  UNIQUE INDEX `unico_veiculo_horario` (`data` ASC, `horario` ASC, `idveiculo` ASC) VISIBLE,
  CONSTRAINT `fk_agendamento_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `oficina`.`cliente` (`idcliente`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agendamento_veiculo1`
    FOREIGN KEY (`idveiculo`)
    REFERENCES `oficina`.`veiculo` (`idveiculo`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`tipo_pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`tipo_pagamento` (
  `idtipo_pagamento` INT NOT NULL AUTO_INCREMENT,
  `nr_parcelas` INT NULL,
  `prazo_primeira` INT NULL,
  `intervalo` INT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `juros` DECIMAL(10,2) NULL,
  PRIMARY KEY (`idtipo_pagamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`servico` (
  `idservico` INT NOT NULL AUTO_INCREMENT,
  `tipo_servico` VARCHAR(45) NOT NULL DEFAULT '',
  `descricao` VARCHAR(450) NOT NULL DEFAULT '',
  `idcliente` INT NOT NULL,
  `idveiculo` INT NOT NULL,
  `status_servico` VARCHAR(45) NOT NULL DEFAULT '',
  `idtipo_pagamento` INT NULL,
  `valor_total` DECIMAL(10,2) NULL,
  `pagamento_gerado` TINYINT(1) NULL DEFAULT 0,
  `mao_obra` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `idagendamento` INT NOT NULL,
  PRIMARY KEY (`idservico`),
  INDEX `fk_servico_cliente1_idx` (`idcliente` ASC) VISIBLE,
  INDEX `fk_servico_veiculo1_idx` (`idveiculo` ASC) VISIBLE,
  INDEX `fk_servico_tipo_pagamento1_idx` (`idtipo_pagamento` ASC) VISIBLE,
  INDEX `fk_servico_agendamento1_idx` (`idagendamento` ASC) VISIBLE,
  CONSTRAINT `fk_servico_cliente1`
    FOREIGN KEY (`idcliente`)
    REFERENCES `oficina`.`cliente` (`idcliente`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servico_veiculo1`
    FOREIGN KEY (`idveiculo`)
    REFERENCES `oficina`.`veiculo` (`idveiculo`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servico_tipo_pagamento1`
    FOREIGN KEY (`idtipo_pagamento`)
    REFERENCES `oficina`.`tipo_pagamento` (`idtipo_pagamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servico_agendamento1`
    FOREIGN KEY (`idagendamento`)
    REFERENCES `oficina`.`agendamento` (`idagendamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL DEFAULT '',
  `quantidade` DECIMAL(10,2) NOT NULL,
  `data_entrada` DATETIME NOT NULL,
  `data_saida` DATETIME NOT NULL,
  `modelo` VARCHAR(45) NOT NULL DEFAULT '',
  `marca` VARCHAR(45) NOT NULL DEFAULT '',
  `ano` YEAR NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `lote` VARCHAR(45) NOT NULL DEFAULT '',
  `data_vencimento` DATETIME NOT NULL,
  PRIMARY KEY (`idproduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`pagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`pagamento` (
  `idpagamento` INT NOT NULL AUTO_INCREMENT,
  `valor_parcela` DECIMAL(10,2) NOT NULL,
  `data_pagamento` DATETIME NOT NULL,
  `status_pagamento` VARCHAR(45) NOT NULL,
  `idservico` INT NOT NULL,
  `valor_pago` DECIMAL(10,2) NULL,
  PRIMARY KEY (`idpagamento`),
  INDEX `fk_pagamento_servico1_idx` (`idservico` ASC) VISIBLE,
  CONSTRAINT `fk_pagamento_servico1`
    FOREIGN KEY (`idservico`)
    REFERENCES `oficina`.`servico` (`idservico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`item_servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`item_servico` (
  `idproduto` INT NOT NULL,
  `idservico` INT NOT NULL,
  `codigo_item` VARCHAR(45) NOT NULL DEFAULT '',
  `qtd_pecas_utilizadas` DECIMAL(10,2) NOT NULL,
  `preco_unitario` DECIMAL(10,2) NOT NULL,
  `subtotal` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`idproduto`, `idservico`),
  INDEX `fk_estoque_has_servico_servico1_idx` (`idservico` ASC) VISIBLE,
  INDEX `fk_estoque_has_servico_estoque1_idx` (`idproduto` ASC) VISIBLE,
  CONSTRAINT `fk_estoque_has_servico_estoque1`
    FOREIGN KEY (`idproduto`)
    REFERENCES `oficina`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estoque_has_servico_servico1`
    FOREIGN KEY (`idservico`)
    REFERENCES `oficina`.`servico` (`idservico`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`servico_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`servico_funcionario` (
  `idservico` INT NOT NULL,
  `idfuncionario` INT NOT NULL,
  PRIMARY KEY (`idservico`, `idfuncionario`),
  INDEX `fk_servico_has_funcionario_funcionario1_idx` (`idfuncionario` ASC) VISIBLE,
  INDEX `fk_servico_has_funcionario_servico1_idx` (`idservico` ASC) VISIBLE,
  CONSTRAINT `fk_servico_has_funcionario_servico1`
    FOREIGN KEY (`idservico`)
    REFERENCES `oficina`.`servico` (`idservico`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servico_has_funcionario_funcionario1`
    FOREIGN KEY (`idfuncionario`)
    REFERENCES `oficina`.`funcionario` (`idfuncionario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oficina`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `oficina`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `senha` VARCHAR(255) NOT NULL DEFAULT '',
  `nome` VARCHAR(300) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(20) NULL DEFAULT 'usuario',
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
