-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/06/2025 às 15:11
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
-- Banco de dados: `arvores`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admins`
--

CREATE TABLE `admins` (
  `cod` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admins`
--

INSERT INTO `admins` (`cod`, `login`, `senha`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `arvore`
--

CREATE TABLE `arvore` (
  `id` int(11) NOT NULL,
  `nome_cientifico` varchar(255) NOT NULL,
  `nome_popular` varchar(255) DEFAULT NULL,
  `espaco_arvore` varchar(255) DEFAULT NULL,
  `classificacao` varchar(255) DEFAULT NULL,
  `numero_individuos` int(11) DEFAULT NULL,
  `estado_fitossanitario` varchar(255) DEFAULT NULL,
  `estado_tronco` varchar(255) DEFAULT NULL,
  `estado_raizes` varchar(255) DEFAULT NULL,
  `danos_pavimento` varchar(255) DEFAULT NULL,
  `fiacao` varchar(255) DEFAULT NULL,
  `sinalizacao` varchar(255) DEFAULT NULL,
  `dap` decimal(10,2) DEFAULT NULL,
  `bioma` varchar(255) DEFAULT NULL,
  `nativa` varchar(3) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `localizacao` varchar(200) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  `medicinal` tinyint(1) DEFAULT NULL,
  `venenosa` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `arvore`
--

INSERT INTO `arvore` (`id`, `nome_cientifico`, `nome_popular`, `espaco_arvore`, `classificacao`, `numero_individuos`, `estado_fitossanitario`, `estado_tronco`, `estado_raizes`, `danos_pavimento`, `fiacao`, `sinalizacao`, `dap`, `bioma`, `nativa`, `descricao`, `localizacao`, `imagem`, `medicinal`, `venenosa`) VALUES
(7, '', 'Acácia', 'inadequado', 'árvore', NULL, 'Com podridão leve no tronco', 'adequado e sem vandalismo', 'destruição de calçada', '', '', '', 27.50, '', '', '', 'Rua José Calazans Luz', 'img_6840411f268162.95812393.jpg', 0, 0),
(8, '', 'Quaresmeira', 'inadequado', 'árvore', NULL, 'com podridão em alguns galhos e/ou folhas', 'adequado e sem vandalismo', 'destruição de calçada', '', '', '', 37.50, '', '', '', 'Rua José Calazans Luz', 'img_68404175a989f3.45255338.jpg', 0, 0),
(9, '', 'Pata de vaca', 'inadequado', 'árvore', NULL, 'saudável', 'adequado e sem vandalismo', 'destruição de calçada', '', '', '', 37.50, '', '', '', 'Rua José Calazans Luz', 'img_684041a09a8fe4.69299714.jpg', 0, 0),
(12, '', 'Amoreira', 'ausente', 'árvore', NULL, 'saudável', 'adequado e sem vandalismo', 'Normal', '', '', '', 2.50, '', '', '', 'Rua José Calazans Luz', '', 0, 0),
(13, '', NULL, NULL, 'Toco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rua José Calazans Luz', NULL, NULL, NULL),
(15, '', NULL, NULL, 'Herbáceo', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2 espécies herbáceas', 'Rua José Calazans Luz', NULL, NULL, NULL),
(16, 'Tibouchina granulosa', 'Quaresmeira', 'Inadequado (menor que 1 m²)', 'Árvore', NULL, 'Saudável', 'Adequado e sem vandalismo', 'Normal', NULL, NULL, NULL, 22.50, NULL, NULL, 'Copa balanceada, um galho seco', 'Rua José Calazans Luz', NULL, NULL, NULL),
(17, '', NULL, NULL, 'Canteiro vazio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rua José Calazans Luz', NULL, NULL, NULL),
(18, 'Roystonea oleracea', 'Palmeira Imperial', 'Inadequado (menor que 1 m²)', 'Árvore', NULL, 'Saudável', 'Adequado e sem vandalismo', 'Normal', NULL, NULL, NULL, 22.50, NULL, NULL, 'Copa balanceada', 'Rua José Calazans Luz', NULL, NULL, NULL),
(19, '', 'Herbácea não identificada', NULL, 'Herbáceo', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Espécie herbácea presente em canteiro', 'Rua José Calazans Luz', NULL, NULL, NULL),
(20, 'Murraya paniculata', 'Murta', 'Inadequado (menor que 1 m²)', 'Árvore', NULL, 'Saudável, presença de erva-de-pássaro', 'Adequado e sem vandalismo', 'Normal', NULL, NULL, NULL, 22.50, NULL, NULL, 'Copa balanceada', 'Rua José Calazans Luz', NULL, NULL, NULL),
(21, 'Lagerstroemia indica', 'Resedá', 'Inadequado (menor que 1 m²)', 'Árvore', NULL, 'Saudável', 'Adequado e sem vandalismo', 'Normal', NULL, NULL, NULL, 17.50, NULL, NULL, 'Copa balanceada', 'Rua José Calazans Luz', NULL, NULL, NULL),
(22, '', 'Herbácea não identificada', NULL, 'Herbáceo', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Espécie herbácea presente em canteiro', 'Rua José Calazans Luz', NULL, NULL, NULL),
(23, '', 'Ipê Branco', NULL, 'Muda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Muda de Ipê Branco', 'Rua José Calazans Luz', NULL, NULL, NULL),
(24, '', NULL, NULL, 'Herbáceo', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2 espécies herbáceas', 'Rua José Calazans Luz', NULL, NULL, NULL),
(25, 'Tibouchina mutabilis', 'Manacá-da-serra', 'Inadequado (menor que 1 m²)', 'Árvore', NULL, 'Saudável', 'Adequado e sem vandalismo', 'Normal', NULL, NULL, NULL, 35.00, NULL, NULL, 'Copa balanceada', 'Rua José Calazans Luz', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`cod`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices de tabela `arvore`
--
ALTER TABLE `arvore`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `arvore`
--
ALTER TABLE `arvore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
