-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/05/2026 às 15:50
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `checklistprg_db`
--

-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `checklistprg_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `checklistprg_db`;

-- Table: usuarios (users)
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: checklists (reports metadata)
CREATE TABLE IF NOT EXISTS `checklists` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `criador` INT(11) NOT NULL,
  `setor` VARCHAR(20) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `criador` (`criador`),
  CONSTRAINT `fk_checklists_usuario` FOREIGN KEY (`criador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: checklist_items (one row per item/question)
CREATE TABLE IF NOT EXISTS `checklist_items` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `checklist_id` INT(11) NOT NULL,
  `campo` VARCHAR(20) NOT NULL,
  `resposta` ENUM('conforme','nao-conforme','nao-selecionado') NOT NULL DEFAULT 'nao-selecionado',
  `observacao` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checklist_id` (`checklist_id`),
  CONSTRAINT `fk_items_checklist` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table: checklist_photos (multiple photos per item)
CREATE TABLE IF NOT EXISTS `checklist_photos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `checklist_item_id` INT(11) NOT NULL,
  `caminho` VARCHAR(255) DEFAULT NULL,
  `conteudo` LONGBLOB DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `checklist_item_id` (`checklist_item_id`),
  CONSTRAINT `fk_photos_item` FOREIGN KEY (`checklist_item_id`) REFERENCES `checklist_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
