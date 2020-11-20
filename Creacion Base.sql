-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema view360
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema view360
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `view360` DEFAULT CHARACTER SET latin1 ;
-- -----------------------------------------------------
-- Schema BovedaDB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BovedaDB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BovedaDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `view360` ;

-- -----------------------------------------------------
-- Table `view360`.`data_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`data_types` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `display_name_singular` VARCHAR(255) NOT NULL,
  `display_name_plural` VARCHAR(255) NOT NULL,
  `icon` VARCHAR(255) NULL DEFAULT NULL,
  `model_name` VARCHAR(255) NULL DEFAULT NULL,
  `policy_name` VARCHAR(255) NULL DEFAULT NULL,
  `controller` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `generate_permissions` TINYINT(1) NOT NULL DEFAULT 0,
  `server_side` TINYINT(4) NOT NULL DEFAULT 0,
  `details` TEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `data_types_name_unique` (`name` ASC) VISIBLE,
  UNIQUE INDEX `data_types_slug_unique` (`slug` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`data_rows`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`data_rows` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_type_id` INT(10) UNSIGNED NOT NULL,
  `field` VARCHAR(255) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(255) NOT NULL,
  `required` TINYINT(1) NOT NULL DEFAULT 0,
  `browse` TINYINT(1) NOT NULL DEFAULT 1,
  `read` TINYINT(1) NOT NULL DEFAULT 1,
  `edit` TINYINT(1) NOT NULL DEFAULT 1,
  `add` TINYINT(1) NOT NULL DEFAULT 1,
  `delete` TINYINT(1) NOT NULL DEFAULT 1,
  `details` TEXT NULL DEFAULT NULL,
  `order` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `data_rows_data_type_id_foreign` (`data_type_id` ASC) VISIBLE,
  CONSTRAINT `data_rows_data_type_id_foreign`
    FOREIGN KEY (`data_type_id`)
    REFERENCES `view360`.`data_types` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 149
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`docs` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1000) NULL DEFAULT NULL,
  `archivo` VARCHAR(1000) NULL DEFAULT NULL,
  `active` INT(11) NULL DEFAULT 1,
  `orderd` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`elb_logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`elb_logs` (
  `timestamp` VARCHAR(40) NOT NULL,
  `
elb_name` VARCHAR(45) NOT NULL,
  `
request_ip` VARCHAR(45) NOT NULL,
  `
request_port` VARCHAR(45) NOT NULL,
  `backend_ip` VARCHAR(45) NOT NULL,
  `
backend_port` VARCHAR(45) NOT NULL,
  `request_processing_time` VARCHAR(45) NOT NULL,
  `
backend_processing_time` VARCHAR(45) NOT NULL,
  `client_response_time` VARCHAR(45) NULL DEFAULT NULL,
  `elb_response_code` VARCHAR(45) NULL DEFAULT NULL,
  `backend_response_code` VARCHAR(45) NULL DEFAULT NULL,
  `received_bytes` VARCHAR(45) NULL DEFAULT NULL,
  `sent_bytes` VARCHAR(45) NULL DEFAULT NULL,
  `request_verb` VARCHAR(45) NULL DEFAULT NULL,
  `url` VARCHAR(70) NULL DEFAULT NULL,
  `protocol` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` VARCHAR(45) NULL DEFAULT NULL,
  `ssl_cipher` VARCHAR(45) NULL DEFAULT NULL,
  `ssl_protocol` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`timestamp`, `
elb_name`, `
request_ip`, `
request_port`, `backend_ip`, `
backend_port`, `request_processing_time`, `
backend_processing_time`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `view360`.`kpi360`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`kpi360` (
  `fecha` DATETIME NULL DEFAULT NULL,
  `frontal` VARCHAR(45) NULL DEFAULT NULL,
  `codigo` INT(11) NULL DEFAULT NULL,
  `contador_codigo` INT(11) NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `view360`.`kpi3602`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`kpi3602` (
  `fecha` DATETIME NOT NULL,
  `codigo` INT(11) NOT NULL,
  `totales` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`fecha`, `codigo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `view360`.`menus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`menus` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `menus_name_unique` (`name` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`menu_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`menu_items` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `target` VARCHAR(255) NOT NULL DEFAULT '_self',
  `icon_class` VARCHAR(255) NULL DEFAULT NULL,
  `color` VARCHAR(255) NULL DEFAULT NULL,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `order` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `route` VARCHAR(255) NULL DEFAULT NULL,
  `parameters` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `menu_items_menu_id_foreign` (`menu_id` ASC) VISIBLE,
  CONSTRAINT `menu_items_menu_id_foreign`
    FOREIGN KEY (`menu_id`)
    REFERENCES `view360`.`menus` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 38
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`mvnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`mvnos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  `logo` VARCHAR(100) NULL DEFAULT NULL,
  `partnerId` VARCHAR(15) NULL DEFAULT NULL,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 55
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`permissions` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NOT NULL,
  `table_name` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `permissions_key_index` (`key` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 107
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`roles` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `roles_name_unique` (`name` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`permission_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`permission_role` (
  `permission_id` BIGINT(20) UNSIGNED NOT NULL,
  `role_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`),
  INDEX `permission_role_permission_id_index` (`permission_id` ASC) VISIBLE,
  INDEX `permission_role_role_id_index` (`role_id` ASC) VISIBLE,
  CONSTRAINT `permission_role_permission_id_foreign`
    FOREIGN KEY (`permission_id`)
    REFERENCES `view360`.`permissions` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `view360`.`roles` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`settings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NOT NULL,
  `display_name` VARCHAR(255) NOT NULL,
  `value` TEXT NULL DEFAULT NULL,
  `details` TEXT NULL DEFAULT NULL,
  `type` VARCHAR(255) NOT NULL,
  `order` INT(11) NOT NULL DEFAULT 1,
  `group` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `settings_key_unique` (`key` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`translations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`translations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table_name` VARCHAR(255) NOT NULL,
  `column_name` VARCHAR(255) NOT NULL,
  `foreign_key` INT(10) UNSIGNED NOT NULL,
  `locale` VARCHAR(255) NOT NULL,
  `value` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `translations_table_name_column_name_foreign_key_locale_unique` (`table_name` ASC, `column_name` ASC, `foreign_key` ASC, `locale` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 31
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) NULL DEFAULT 'users/default.png',
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `settings` TEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE,
  INDEX `users_role_id_foreign` (`role_id` ASC) VISIBLE,
  CONSTRAINT `users_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `view360`.`roles` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`user_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`user_roles` (
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `role_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  INDEX `user_roles_user_id_index` (`user_id` ASC) VISIBLE,
  INDEX `user_roles_role_id_index` (`role_id` ASC) VISIBLE,
  CONSTRAINT `user_roles_role_id_foreign`
    FOREIGN KEY (`role_id`)
    REFERENCES `view360`.`roles` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `view360`.`users` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwaction_fields`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwaction_fields` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `action_id` INT(11) NULL DEFAULT NULL,
  `fields_id` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 159
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwactions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NULL DEFAULT NULL,
  `config` LONGTEXT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_bin' NULL DEFAULT NULL,
  `typeaction_id` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `list_order` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 67
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwcredential`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwcredential` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vwrole_id` INT(11) NULL DEFAULT NULL,
  `mvno_id` INT(11) NULL DEFAULT NULL,
  `ClientId` VARCHAR(32) NULL DEFAULT NULL,
  `SecretKey` VARCHAR(16) NULL DEFAULT NULL,
  `BE_ID` LONGTEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 370
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwfields`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwfields` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(50) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `vwfields_label_unique` (`label` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 240
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwfile_templates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwfile_templates` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1000) NULL DEFAULT NULL,
  `modulo` VARCHAR(50) NULL DEFAULT NULL,
  `archivo` VARCHAR(1000) NULL DEFAULT NULL,
  `active` INT(11) NULL DEFAULT 1,
  `orderd` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwlogs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwlogs` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vwuser_id` INT(11) NULL DEFAULT NULL,
  `actions` VARCHAR(255) NULL DEFAULT NULL,
  `responses` VARCHAR(255) NULL DEFAULT NULL,
  `action_low` TEXT NULL DEFAULT NULL,
  `resoponse_low` TEXT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 42233
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwpermissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwpermissions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleaction_id` INT(11) NULL DEFAULT NULL,
  `fiel_id` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 48
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwrole` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwrole_action`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwrole_action` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NULL DEFAULT NULL,
  `action_id` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 279
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwtypeaction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwtypeaction` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwusers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwusers` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `vwrole_id` INT(11) NULL DEFAULT NULL,
  `mvno_id` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `password` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `phone` VARCHAR(255) NULL DEFAULT NULL,
  `active` INT(11) NULL DEFAULT 0,
  `last_session_id` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1252
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `view360`.`vwusers2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`vwusers2` (
  `id` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `vwrole_id` INT(11) NULL DEFAULT NULL,
  `mvno_id` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `password` VARCHAR(150) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `phone` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `active` INT(11) NULL DEFAULT 0,
  `last_session_id` VARCHAR(128) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

USE `BovedaDB` ;

-- -----------------------------------------------------
-- Table `BovedaDB`.`docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`docs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1000) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `archivo` VARCHAR(1000) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `active` INT NULL DEFAULT '1',
  `orderd` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`licencias_mvno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`licencias_mvno` (
  `partnerId` INT NOT NULL,
  `total_licencias` INT NULL DEFAULT NULL,
  `total_usuarios` INT NULL DEFAULT NULL,
  `fecha_modificacion_licencias` DATETIME NULL DEFAULT NULL,
  `usuario_modificacion_licencias` VARCHAR(50) NULL DEFAULT NULL,
  UNIQUE INDEX `BE_UNIQUE` (`partnerId` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `BovedaDB`.`mvnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`mvnos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `logo` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `partnerId` VARCHAR(15) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `description` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `primer_password` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`password_resets` (
  `email` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `token` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwactions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `config` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL,
  `typeaction_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `list_order` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwcredential`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwcredential` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vwrole_id` INT NULL DEFAULT NULL,
  `mvno_id` INT NULL DEFAULT NULL,
  `ClientId` VARCHAR(32) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `SecretKey` VARCHAR(16) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `BE_ID` LONGTEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 409
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwfile_templates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwfile_templates` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1000) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `modulo` VARCHAR(50) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `archivo` VARCHAR(1000) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `active` INT NULL DEFAULT '1',
  `orderd` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwlogs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwlogs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `vwuser_id` INT NULL DEFAULT NULL,
  `actions` VARCHAR(1024) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `responses` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `action_low` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `resoponse_low` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 29759
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwpermissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwpermissions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleaction_id` INT NULL DEFAULT NULL,
  `fiel_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 47
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwrole` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `tipo` VARCHAR(30) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `descripcion` VARCHAR(1024) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwrole_action`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwrole_action` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` INT NULL DEFAULT NULL,
  `action_id` INT NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 280
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BovedaDB`.`vwusers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`vwusers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `vwrole_id` INT NULL DEFAULT NULL,
  `mvno_id` INT NULL DEFAULT NULL,
  `email` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `password` VARCHAR(150) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `phone` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `active` INT NULL DEFAULT '0',
  `last_session_id` VARCHAR(128) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `created_by` VARCHAR(45) NULL DEFAULT NULL,
  `ts_idproducto` VARCHAR(50) NULL DEFAULT NULL,
  `ts_moduloid` INT NULL DEFAULT NULL,
  `provision_idproducto` VARCHAR(50) NULL DEFAULT NULL,
  `provision_moduloid` INT NULL DEFAULT NULL,
  `autogestion_moduloid` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `VWUSER1IDX` (`email` ASC) VISIBLE,
  UNIQUE INDEX `VWUSER2IDX` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 1235
DEFAULT CHARACTER SET = latin1;

USE `view360` ;

-- -----------------------------------------------------
-- Placeholder table for view `view360`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `view360`.`usuarios` (`usuario` INT, `email` INT, `rol` INT, `mvno_id` INT, `mvno` INT, `creacion` INT);

-- -----------------------------------------------------
-- View `view360`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `view360`.`usuarios`;
USE `view360`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `view360`.`usuarios` AS select `a`.`name` AS `usuario`,`a`.`email` AS `email`,`b`.`name` AS `rol`,`a`.`mvno_id` AS `mvno_id`,`c`.`name` AS `mvno`,`a`.`created_at` AS `creacion` from ((`view360`.`vwusers` `a` join `view360`.`vwrole` `b`) join `view360`.`mvnos` `c`) where `a`.`vwrole_id` = `b`.`id` and `a`.`mvno_id` = `c`.`id`;
USE `BovedaDB` ;

-- -----------------------------------------------------
-- Placeholder table for view `BovedaDB`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BovedaDB`.`usuarios` (`usuario` INT, `email` INT, `rol` INT, `mvno_id` INT, `mvno` INT, `creacion` INT);

-- -----------------------------------------------------
-- View `BovedaDB`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BovedaDB`.`usuarios`;
USE `BovedaDB`;
CREATE  OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `BovedaDB`.`usuarios` AS select `a`.`name` AS `usuario`,`a`.`email` AS `email`,`b`.`name` AS `rol`,`a`.`mvno_id` AS `mvno_id`,`c`.`name` AS `mvno`,`a`.`created_at` AS `creacion` from ((`BovedaDB`.`vwusers` `a` join `BovedaDB`.`vwrole` `b`) join `BovedaDB`.`mvnos` `c`) where ((`a`.`vwrole_id` = `b`.`id`) and (`a`.`mvno_id` = `c`.`id`));

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
