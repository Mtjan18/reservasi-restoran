-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema restaurant_reservation
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema restaurant_reservation
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `restaurant_reservation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
USE `restaurant_reservation` ;

-- -----------------------------------------------------
-- Table `restaurant_reservation`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`user` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'customer') NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `email` (`email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`admin` (
  `employeeId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`employeeId`),
  UNIQUE INDEX `userId` (`userId` ASC) ,
  CONSTRAINT `admin_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `restaurant_reservation`.`user` (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`authentication`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`authentication` (
  `sessionId` VARCHAR(255) NOT NULL,
  `loginTime` DATETIME NOT NULL,
  `userId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`sessionId`),
  INDEX `userId` (`userId` ASC) ,
  CONSTRAINT `authentication_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `restaurant_reservation`.`user` (`userId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`cache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`cache_locks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`customer` (
  `customerId` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NULL DEFAULT NULL,
  `phoneNumber` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`customerId`),
  UNIQUE INDEX `userId` (`userId` ASC) ,
  CONSTRAINT `customer_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `restaurant_reservation`.`user` (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`job_batches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`reservation` (
  `reservationId` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `numOfPeople` INT NOT NULL,
  `bookingCode` VARCHAR(50) NOT NULL,
  `status` ENUM('pending', 'confirmed', 'cancel') NULL DEFAULT 'pending',
  `customerId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`reservationId`),
  UNIQUE INDEX `bookingCode` (`bookingCode` ASC) ,
  INDEX `customerId` (`customerId` ASC) ,
  CONSTRAINT `reservation_ibfk_1`
    FOREIGN KEY (`customerId`)
    REFERENCES `restaurant_reservation`.`customer` (`customerId`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`notifications` (
  `notificationId` INT NOT NULL AUTO_INCREMENT,
  `reservationId` INT NULL DEFAULT NULL,
  `message` TEXT NOT NULL,
  `sentAt` DATETIME NOT NULL,
  `type` ENUM('email', 'SMS', 'app') NOT NULL,
  PRIMARY KEY (`notificationId`),
  INDEX `reservationId` (`reservationId` ASC) ,
  CONSTRAINT `notifications_ibfk_1`
    FOREIGN KEY (`reservationId`)
    REFERENCES `restaurant_reservation`.`reservation` (`reservationId`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`payment` (
  `paymentId` INT NOT NULL AUTO_INCREMENT,
  `reservationId` INT NULL DEFAULT NULL,
  `amount` DOUBLE NOT NULL,
  `method` ENUM('Transfer', 'QRIS', 'Cash') NOT NULL,
  `status` ENUM('paid', 'unpaid', 'refunded') NULL DEFAULT 'unpaid',
  `paymentDate` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`paymentId`),
  UNIQUE INDEX `reservationId` (`reservationId` ASC) ,
  CONSTRAINT `payment_ibfk_1`
    FOREIGN KEY (`reservationId`)
    REFERENCES `restaurant_reservation`.`reservation` (`reservationId`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`table_lists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`table_lists` (
  `tableId` INT NOT NULL AUTO_INCREMENT,
  `tableNumber` INT NOT NULL,
  `capacity` INT NOT NULL,
  `status` ENUM('available', 'reserved', 'unavailable') NULL DEFAULT 'available',
  PRIMARY KEY (`tableId`),
  UNIQUE INDEX `tableNumber` (`tableNumber` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`reservationtable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`reservationtable` (
  `reservationId` INT NOT NULL,
  `tableId` INT NOT NULL,
  `assignedAt` DATETIME NOT NULL,
  PRIMARY KEY (`reservationId`, `tableId`),
  INDEX `tableId` (`tableId` ASC) ,
  CONSTRAINT `reservationtable_ibfk_1`
    FOREIGN KEY (`reservationId`)
    REFERENCES `restaurant_reservation`.`reservation` (`reservationId`),
  CONSTRAINT `reservationtable_ibfk_2`
    FOREIGN KEY (`tableId`)
    REFERENCES `restaurant_reservation`.`table_lists` (`tableId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC) ,
  INDEX `sessions_last_activity_index` (`last_activity` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `restaurant_reservation`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant_reservation`.`users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
