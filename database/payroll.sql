-- ============================================================
--  Payroll System - Database schema
--  MySQL / MariaDB
--
--  Usage (local, XAMPP):
--    1. Start Apache + MySQL in XAMPP.
--    2. Open phpMyAdmin -> create a database named `Payroll`.
--    3. Import this file, or run it from the SQL tab.
--
--  The application connects with the defaults in connection.php
--  (host: localhost, user: root, no password, db: Payroll).
-- ============================================================

CREATE DATABASE IF NOT EXISTS `Payroll`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `Payroll`;

-- ------------------------------------------------------------
-- Admin (application users who can log in)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `id`       INT AUTO_INCREMENT PRIMARY KEY,
  `name`     VARCHAR(100) NOT NULL,
  `mail_id`  VARCHAR(150) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Company
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `company` (
  `company_id`      INT AUTO_INCREMENT PRIMARY KEY,
  `company_name`    VARCHAR(150) NOT NULL,
  `company_address` VARCHAR(255),
  `company_mail`    VARCHAR(150)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Employee
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id`      INT AUTO_INCREMENT PRIMARY KEY,
  `emp_name`    VARCHAR(150) NOT NULL,
  `emp_contact` VARCHAR(20),
  `emp_address` VARCHAR(255),
  `emp_salary`  DECIMAL(12,2),
  `company_id`  INT,
  CONSTRAINT `fk_employee_company`
    FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Designation (pay grades per company)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id`      INT AUTO_INCREMENT PRIMARY KEY,
  `designation_name`    VARCHAR(150) NOT NULL,
  `per_hour_salary`     DECIMAL(12,2),
  `per_month_salary`    DECIMAL(12,2),
  `per_hour_ot_salary`  DECIMAL(12,2),
  `per_month_ot_salary` DECIMAL(12,2),
  `company_id`          INT,
  CONSTRAINT `fk_designation_company`
    FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
