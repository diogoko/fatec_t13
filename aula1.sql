-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 24-Jul-2021 às 14:25
-- Versão do servidor: 8.0.25
-- versão do PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aula1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

DROP TABLE IF EXISTS `cidades`;
CREATE TABLE `cidades` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `pais_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id`, `nome`, `estado`, `pais_id`) VALUES
(1, 'são josé do rio preto', 'sp', 1),
(2, 'bady bassit', 'sp', 1),
(3, 'rio de janeiro', 'rj', 1),
(4, 'curitiba', 'pr', 1),
(5, 'salvador', 'ba', 1),
(6, 'dallas', 'tx', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `cidade_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `nascimento`, `cidade_id`) VALUES
(1, 'Diogo Kollrosss', '2015-07-02', 2),
(2, 'José Maria', '2011-07-05', 3),
(3, 'Teste Inserção 2', '2021-06-29', NULL),
(4, 'Hacker do Bem', '2021-07-14', 5),
(5, 'oeueou', '2021-07-14', NULL),
(6, 'Mais Um', '2021-07-23', 6),
(7, 'uuuu', '2021-07-14', NULL),
(8, 'Diogo', '2021-03-02', NULL),
(9, 'uuuuuuu', '1985-05-15', NULL),
(10, 'lala', '2021-07-13', 4),
(11, 'aaa', '2000-02-01', 2),
(12, 'aoeueo', '2021-12-31', NULL),
(13, 'oeueou', '2021-07-15', NULL),
(14, 'aula 6', '2021-07-04', 3),
(15, 'Insert com query builder', '2021-06-29', NULL),
(16, 'Redirect!', '2021-06-29', NULL),
(17, 'redirect 2', '2021-07-06', NULL),
(18, 'redircet 3', '2021-07-06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id`, `nome`) VALUES
(1, 'brasil'),
(2, 'estados unidos');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cidade_id` (`cidade_id`);

--
-- Índices para tabela `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
