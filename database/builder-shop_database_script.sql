-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema builder_shop
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema builder_shop
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `builder_shop` DEFAULT CHARACTER SET utf8 ;
USE `builder_shop` ;

-- -----------------------------------------------------
-- Table `builder_shop`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `image` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(80) NOT NULL,
  `image` VARCHAR(110) NOT NULL,
  `price` INT NOT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE,
  INDEX `fk_item_category_idx` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_item_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `builder_shop`.`category` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `builder_shop`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(90) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(90) NOT NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `fk_user_role1_idx` (`role_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `builder_shop`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`order_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`order_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `sum` INT NOT NULL,
  `transaction_date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_history_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_order_history_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `builder_shop`.`user` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`order_history_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`order_history_has_item` (
  `order_history_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  `count` INT NOT NULL,
  PRIMARY KEY (`order_history_id`, `item_id`),
  INDEX `fk_order_history_has_item_item1_idx` (`item_id` ASC) VISIBLE,
  INDEX `fk_order_history_has_item_order_history1_idx` (`order_history_id` ASC) VISIBLE,
  CONSTRAINT `fk_order_history_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `builder_shop`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_history_has_item_order_history1`
    FOREIGN KEY (`order_history_id`)
    REFERENCES `builder_shop`.`order_history` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`characteristics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`characteristics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `builder_shop`.`item_has_characteristics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`item_has_characteristics` (
  `item_id` INT NOT NULL,
  `characteristics_id` INT NOT NULL,
  `value` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`item_id`, `characteristics_id`),
  INDEX `fk_item_has_characteristics_characteristics1_idx` (`characteristics_id` ASC) VISIBLE,
  INDEX `fk_item_has_characteristics_item1_idx` (`item_id` ASC) VISIBLE,
  CONSTRAINT `fk_item_has_characteristics_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `builder_shop`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_item_has_characteristics_characteristics1`
    FOREIGN KEY (`characteristics_id`)
    REFERENCES `builder_shop`.`characteristics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `builder_shop`.`user_token`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`user_token` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `token` VARCHAR(256) NOT NULL,
  `time_expired` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_token_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_token_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `builder_shop`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `builder_shop`.`user_has_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `builder_shop`.`user_has_item` (
  `user_id` INT NOT NULL,
  `item_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `item_id`),
  INDEX `fk_user_has_item_item1_idx` (`item_id` ASC) VISIBLE,
  INDEX `fk_user_has_item_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_item_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `builder_shop`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_item_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `builder_shop`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
