-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/04/2025 às 21:55
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
-- Banco de dados: `pedro_atividade`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estacao`
--

CREATE TABLE `estacao` (
  `idEstacao` int(11) NOT NULL,
  `NomeEstacao` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estacao`
--

INSERT INTO `estacao` (`idEstacao`, `NomeEstacao`) VALUES
(1, 'Marketing'),
(2, 'Recurso Humanos'),
(3, 'LowCode'),
(4, 'NoCode'),
(5, 'HighCode'),
(6, 'Cloud'),
(7, 'PMO'),
(8, 'Get'),
(9, 'Pca'),
(10, 'Esg'),
(11, 'Web Design'),
(12, 'Sdr'),
(13, 'Bpo'),
(14, 'Inteligência Artificial');

-- --------------------------------------------------------

--
-- Estrutura para tabela `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `RA` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `idResponsavel` int(11) NOT NULL,
  `NomeResponsavel` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `responsavel`
--

INSERT INTO `responsavel` (`idResponsavel`, `NomeResponsavel`) VALUES
(1, 'Pedro Mendes'),
(2, 'Amanda Barreto'),
(3, 'Sara Xavier'),
(4, 'Giovani Dantas'),
(5, 'Pedro Rocha'),
(6, 'Claudia'),
(7, 'Ylla Cafe'),
(8, 'Vanessa Manzano'),
(9, 'Mauro Claro'),
(10, 'Tamirys Soares');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefa`
--

CREATE TABLE `tarefa` (
  `idTarefa` int(11) NOT NULL,
  `TituloTarefa` varchar(225) NOT NULL,
  `DataInicio` date NOT NULL,
  `DataEntrega` date NOT NULL,
  `Descricao` varchar(225) NOT NULL,
  `StatusTarefas` varchar(225) NOT NULL,
  `idResponsavel` int(11) NOT NULL,
  `idEstacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefa`
--

INSERT INTO `tarefa` (`idTarefa`, `TituloTarefa`, `DataInicio`, `DataEntrega`, `Descricao`, `StatusTarefas`, `idResponsavel`, `idEstacao`) VALUES
(4, '1211', '2025-04-03', '2025-04-11', '12123', 'pendente', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estacao`
--
ALTER TABLE `estacao`
  ADD PRIMARY KEY (`idEstacao`);

--
-- Índices de tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`idResponsavel`);

--
-- Índices de tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD PRIMARY KEY (`idTarefa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estacao`
--
ALTER TABLE `estacao`
  MODIFY `idEstacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `idResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tarefa`
--
ALTER TABLE `tarefa`
  MODIFY `idTarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
