CREATE DATABASE bc_cc2;
CREATE TABLE IF NOT EXISTS `bd_cc2`.`users` (
  `id` INT NOT NULL COMMENT '',
  `name` VARCHAR(20) NOT NULL COMMENT '',
  `last_name` VARCHAR(20) NOT NULL COMMENT '',
  `email` VARCHAR(30) NOT NULL COMMENT '',
  `password` VARCHAR(20) NOT NULL COMMENT '',
  `cell_phone` VARCHAR(9) NOT NULL COMMENT '',
  `phone` VARCHAR(7) NULL COMMENT '',
  `date_birth` DATE NULL COMMENT '',
  `description` VARCHAR(100) NULL COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd_cc`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`categories` (
  `id` INT NOT NULL COMMENT '',
  `cultural_theme` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_cc`.`workshops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc`.`workshops` (
  `id` INT NOT NULL COMMENT '',
  `amount` DECIMAL(4,2) NOT NULL COMMENT '',
  `start_date` DATETIME NOT NULL COMMENT '',
  `final_date` DATETIME NOT NULL COMMENT '',
  `level` ENUM('Basico', 'Intermedio', 'Avanzado') NOT NULL COMMENT '',
  `wrks_status` ENUM('En curso', 'Cancelado', 'Finalizado') NOT NULL COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  `user_id` INT NULL COMMENT '',
  `category_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_user_id_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_category_id_idx` (`category_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `bd_cc`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd_cc`.`inscribed_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`inscribed_users` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  `iu_status` ENUM('Confirmado','No confirmado') NOT NULL COMMENT '',
  `student_rating` FLOAT NULL COMMENT '',
  `tutor_rating` FLOAT NULL COMMENT '',
  `user_id` INT NULL COMMENT '',
  `wrks_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_user_id_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_wrks_id_idx` (`wrks_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wrks_id`
    FOREIGN KEY (`wrks_id`)
    REFERENCES `bd_cc`.`workshops` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd_cc`.`proposed_workshops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`proposed_workshops` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  `pw_status` ENUM('Activo','Inactivo') NOT NULL COMMENT '',
  `user_id` INT NULL COMMENT '',
  `category_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_user_id_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_category_id_idx` (`category_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `bd_cc`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd_cc`.`ratings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`ratings` (
  `user_id` INT NOT NULL COMMENT '',
  `role` ENUM('Alumno', 'Docente') NOT NULL COMMENT '',
  `final_rating` FLOAT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `role`)  COMMENT '',
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_cc`.`proposal_interested`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`proposal_interested` (
  `id` INT NOT NULL COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  `user_id` INT NULL COMMENT '',
  `pw_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_user_id_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_pw_id_idx` (`pw_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pw_id`
    FOREIGN KEY (`pw_id`)
    REFERENCES `bd_cc`.`proposed_workshops` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_cc`.`discounts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`discounts` (
  `id` INT NOT NULL COMMENT '',
  `final_rating` INT NULL COMMENT '',
  `percentage` FLOAT NULL COMMENT '',
  `discount` FLOAT NULL COMMENT '',
  `wrks_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_wrks_id_idx` (`wrks_id` ASC)  COMMENT '',
  CONSTRAINT `fk_wrks_id`
    FOREIGN KEY (`wrks_id`)
    REFERENCES `bd_cc`.`workshops` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_cc`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`payments` (
  `id` INT NOT NULL COMMENT '',
  `amount` DECIMAL(4,2) NOT NULL COMMENT '',
  `pay_status` ENUM('Pagado', 'No pagado') NOT NULL COMMENT '',
  `created_date` DATETIME NOT NULL COMMENT '',
  `dsct_id` INT NULL COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  `wrks_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_dsct_id_idx` (`dsct_id` ASC)  COMMENT '',
  INDEX `fk_user_id_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_wrks_id_idx` (`wrks_id` ASC)  COMMENT '',
  CONSTRAINT `fk_dsct_id`
    FOREIGN KEY (`dsct_id`)
    REFERENCES `bd_cc`.`discounts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_cc`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wrks_id`
    FOREIGN KEY (`wrks_id`)
    REFERENCES `bd_cc`.`workshops` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `bd_cc2` ;

-- -----------------------------------------------------
-- Table `BD_CC1`.`cultural_theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_cc2`.`cultural_theme` (
  `id` INT NOT NULL COMMENT '',
  `description` VARCHAR(45) NUusuarioLL COMMENT '',
  `category_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_category_id_idx` (`category_id` ASC)  COMMENT '',
  CONSTRAINT `fk_category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `bd_cc`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;