-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cbl_main
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cbl_main
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cbl_main` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cbl_main` ;

-- -----------------------------------------------------
-- Table `cbl_main`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `category_name` VARCHAR(50) NOT NULL COMMENT '',
  `is_weight` INT(1) NULL DEFAULT 0 COMMENT 'Weight Or Units',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbl_main`.`contract`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`contract` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `category_id` INT NOT NULL DEFAULT 0 COMMENT '',
  `contract_no` VARCHAR(15) NOT NULL COMMENT '',
  `supplier_id` INT NOT NULL COMMENT '',
  `created_date_time` DATETIME NOT NULL COMMENT '',
  `expire_date_time` DATETIME NOT NULL COMMENT '',
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'Price Per KG',
  `total_weight` INT NOT NULL DEFAULT 0 COMMENT 'How Many KG',
  `total_qty` INT NOT NULL DEFAULT 0 COMMENT '',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  `is_received` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_amend` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_payed` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_complete` INT(1) NULL DEFAULT 0 COMMENT '',
  `payed_amount` DECIMAL(10,2) NULL DEFAULT 0 COMMENT 'Price Per KG',
  `sub_contract_id` INT NULL DEFAULT 0 COMMENT '',
  `sub_contract_no` VARCHAR(15) NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbl_main`.`people`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`people` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `code` VARCHAR(45) NOT NULL COMMENT '',
  `first_name` VARCHAR(50) NOT NULL COMMENT '',
  `middle_name` VARCHAR(50) NULL COMMENT 'Optional',
  `last_name` VARCHAR(50) NULL COMMENT '',
  `phone` VARCHAR(60) NULL COMMENT '',
  `email` VARCHAR(60) NULL COMMENT '',
  `web` VARCHAR(45) NULL COMMENT '',
  `street_1` VARCHAR(50) NULL COMMENT '',
  `street_2` VARCHAR(50) NULL COMMENT '',
  `city` VARCHAR(45) NULL COMMENT '',
  `province` VARCHAR(30) NULL COMMENT '',
  `postal_code` VARCHAR(10) NULL COMMENT 'zip/postal',
  `country` VARCHAR(45) NULL COMMENT '',
  `type` INT(2) NOT NULL COMMENT '1-Supplier\n2-Customer\n3-Employee',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  `account_number` VARCHAR(20) NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbl_main`.`received_goods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`received_goods` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `supplier_id` INT NOT NULL COMMENT '',
  `contract_no` VARCHAR(15) NOT NULL COMMENT '',
  `contract_id` INT NOT NULL COMMENT '',
  `category_id` INT NULL COMMENT '',
  `product` VARCHAR(50) NOT NULL COMMENT '',
  `bill_no` VARCHAR(45) NOT NULL COMMENT '',
  `bill_id` INT NULL COMMENT '',
  `received_date_time` DATETIME NOT NULL COMMENT '',
  `exit_date_time` DATETIME NULL COMMENT '',
  `truck_no` VARCHAR(20) NOT NULL COMMENT '',
  `truck_driver` VARCHAR(100) NULL COMMENT '',
  `price` DECIMAL(10,2) NOT NULL COMMENT 'price per kg',
  `first_weight` DECIMAL(10,2) NOT NULL COMMENT '',
  `second_weight` DECIMAL(10,2) NOT NULL COMMENT '',
  `net_weight` DECIMAL(10,2) NOT NULL COMMENT '',
  `wet_weight` DECIMAL(10,2) NOT NULL COMMENT 'net_weight/accepted_qty=wet_weight',
  `total_qty` INT NULL COMMENT '',
  `bad_qty` INT NULL COMMENT '',
  `accepted_qty` INT NULL COMMENT '',
  `w_b_operator` VARCHAR(50) NULL COMMENT '',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  `is_amend` INT(1) NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbl_main`.`weigh_bills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`weigh_bills` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `product` VARCHAR(50) NOT NULL COMMENT '',
  `bill_no` VARCHAR(45) NOT NULL COMMENT '',
  `received_date_time` DATETIME NOT NULL COMMENT '',
  `exit_date_time` DATETIME NOT NULL COMMENT '',
  `truck_no` VARCHAR(20) NOT NULL COMMENT '',
  `truck_driver` VARCHAR(100) NULL COMMENT '',
  `first_weight` DECIMAL(10,2) NOT NULL COMMENT '',
  `second_weight` DECIMAL(10,2) NOT NULL COMMENT '',
  `total_qty` INT NULL COMMENT '',
  `bad_qty` INT NULL COMMENT '',
  `accepted_qty` INT NULL COMMENT '',
  `w_b_operator` VARCHAR(50) NULL COMMENT '',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  `is_cleared` INT(1) NULL DEFAULT 0 COMMENT '',
  `supplier_name` VARCHAR(100) NOT NULL COMMENT '',
  `supplier_code` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cbl_main`.`system_settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cbl_main`.`system_settings` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `value` VARCHAR(45) NULL COMMENT 'Weight Or Units',
  `is_disabled` INT(1) NULL DEFAULT 0 COMMENT '',
  `is_removed` INT(1) NULL DEFAULT 0 COMMENT '',
  `timestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `created_user_id` INT NULL DEFAULT 0 COMMENT '',
  `settings_name` VARCHAR(50) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
