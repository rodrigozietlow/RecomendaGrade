-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21/08/2018 às 21:45
-- Versão do servidor: 10.1.35-MariaDB
-- Versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `recomendagrade`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nomeCurso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomePeriodos` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qtPeriodos` tinyint(4) DEFAULT NULL,
  `cargaMinima` double DEFAULT NULL,
  `idCoordenador` int(11) DEFAULT NULL,
  `publico` tinyint(1) DEFAULT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `curso`
--

INSERT INTO `curso` (`id`, `nomeCurso`, `nomePeriodos`, `qtPeriodos`, `cargaMinima`, `idCoordenador`, `publico`, `dataCadastro`) VALUES
(1, 'ADS', 'semestre', 7, 1000, 0, 0, '2018-08-22');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCoordenador` (`idCoordenador`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
