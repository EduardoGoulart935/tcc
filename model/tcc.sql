-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/11/2024 às 00:40
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(40) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(40) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  `rua` varchar(40) NOT NULL,
  `pais` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `estado`, `cidade`, `bairro`, `rua`, `pais`) VALUES
(2, '88806-000', 'Sa', 'Criciúma', 'Jardim Angélica', 'Rua Rosita Danovith Finster', 'Brasil'),
(3, '88806-000', 'Sa', 'Criciúma', 'Jardim Angélica', 'Rua Rosita Danovith Finster', 'Brasil'),
(4, '', '', '', '', '', ''),
(5, '88830-000', 'Sa', 'Criciúma', 'Linha Anta', 'Rua Caetano Scremim', 'Brasil'),
(6, '88830000', 'SC', 'Morro da Fumaça', '', '', 'Brasil'),
(7, '88830-000', 'Sa', 'Criciúma', 'Linha Anta', 'Rua Caetano Scremim', 'Brasil'),
(8, '88830-000', 'Sa', 'Morro da Fumaça', 'Barracão', 'Rua Madre Maria Tereza de Jesus', 'Brasil'),
(9, '88830-000', 'Sa', 'Morro da Fumaça', 'Barracão', 'Rua Pedro José Pereira', 'Brasil'),
(10, '88830-000', 'Sa', 'Morro da Fumaça', 'Barracão', 'Rua Pedro José Pereira', 'Brasil'),
(11, '88830-000', 'Sa', 'Jaguaruna', 'test', 'Rua Trinta e Oito', 'Brasil'),
(12, '23232-323', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Trinta e Oito', 'Brasil'),
(13, '23232-323', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Trinta e Oito', 'Brasil'),
(14, '23232-323', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Trinta e Oito', 'Brasil'),
(15, '88830-000', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Doze', 'Brasil'),
(16, '88830-000', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Doze', 'Brasil'),
(17, '88830-000', 'Sa', 'Jaguaruna', 'Barracão', 'Rua Doze', 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `visualizada` enum('N','S') DEFAULT 'N',
  `id_perfil_recebedor` int(11) NOT NULL,
  `id_perfil_solicitante` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `data_hora`, `visualizada`, `id_perfil_recebedor`, `id_perfil_solicitante`, `id_oferta`) VALUES
(1, '2024-10-15 12:07:41', 'N', 11, 10, 10),
(2, '2024-10-15 13:02:30', 'N', 10, 11, 9),
(3, '2024-10-15 13:02:35', 'N', 10, 11, 9),
(4, '2024-10-15 13:02:36', 'N', 10, 11, 9),
(5, '2024-10-15 13:02:37', 'N', 10, 11, 9),
(6, '2024-10-15 13:02:50', 'N', 10, 11, 11),
(7, '2024-10-18 09:53:23', 'N', 10, 13, 9),
(8, '2024-10-18 09:53:25', 'N', 11, 13, 10),
(9, '2024-10-18 09:53:31', 'N', 10, 13, 11),
(10, '2024-10-27 17:47:15', 'N', 11, 10, 10),
(11, '2024-10-30 15:58:16', 'N', 11, 10, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `contato` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('A','I') DEFAULT NULL,
  `nome_foto` varchar(40) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ofertas`
--

INSERT INTO `ofertas` (`id`, `nome`, `descricao`, `categoria`, `contato`, `email`, `status`, `nome_foto`, `id_perfil`) VALUES
(9, 'Coca', '50 ml 5000 Latinhas', 'Alimentos e Bebidas', '(48) 98853-1690', 'edu@gmail.com', 'A', 'coca-cola-zdhicqpwnd6wthl7.jpg', 10),
(10, 'Banana', '2 Pencas de Banana', 'Alimentos e Bebidas', '(48) 95146-5354', 'joao@gmail.com', 'A', 'banana.jfif', 11),
(11, 'test', 'tst', 'Tecnologia', '(48) 98853-0659', 'edu@gmail.com', 'A', 'instagram.png', 10),
(12, 'novo', 'novo ofera', 'Tecnologia', '(48) 98853-1690', 'novo@gmail.com', 'A', 'download.jpg', 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `hora_data` datetime NOT NULL,
  `id_ofertas` int(11) NOT NULL,
  `id_perfil_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `hora_data`, `id_ofertas`, `id_perfil_pedido`) VALUES
(1, '2024-10-15 12:07:41', 10, 10),
(2, '2024-10-15 13:02:29', 9, 11),
(3, '2024-10-15 13:02:34', 9, 11),
(4, '2024-10-15 13:02:35', 9, 11),
(5, '2024-10-15 13:02:36', 9, 11),
(6, '2024-10-15 13:02:50', 11, 11),
(7, '2024-10-18 09:53:23', 9, 13),
(8, '2024-10-18 09:53:25', 10, 13),
(9, '2024-10-18 09:53:30', 11, 13),
(10, '2024-10-27 17:47:14', 10, 10),
(11, '2024-10-30 15:58:16', 10, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contato` varchar(50) NOT NULL,
  `cpf_cnpj` varchar(50) NOT NULL,
  `data_nasc` varchar(10) NOT NULL,
  `foto_perfil` varchar(30) NOT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `id_usuarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perfil`
--

INSERT INTO `perfil` (`id`, `lastName`, `email`, `contato`, `cpf_cnpj`, `data_nasc`, `foto_perfil`, `id_endereco`, `id_usuarios`) VALUES
(10, 'Eduardo', 'edu@gmail.com', '(48) 98853-0659', '115.539.059-83', '2206-12-16', 'robux.jfif', 2, 10),
(11, 'Joao', 'joao@gmail.com', '(48) 98853-1690', '115.897.456-48', '2006-12-16', 'robux.jfif', 3, 11),
(13, 'Novo', 'novo@gmail.com', '(48) 98853-1690', '155.554.999-99', '2006-12-16', '', 5, 13),
(14, '', '', '', '', '', '', NULL, 14),
(15, '', '', '', '', '', '', NULL, 15),
(16, 'eeew', 'sasukedu935115@gmail.com', '(48) 98853-1690', '115.539.059-89', '2012-12-12', '', 6, 16),
(17, 'oi', 'oi@gmail.com', '(48) 23121-3121', '121.212.121-22', '2006-06-11', '', 7, 17),
(18, 'RR2', 'eduardogoulart935@gmail.com', '(11) 12222-2221', '115.539.059-89', '2006-12-16', '', NULL, 18),
(19, 'p', 'p@gmail.com', '(22) 22222-2222', '112.222.222-22', '2123-03-12', '', 8, 19),
(20, 'r', 'mirela@gmail.com', '(48) 98239-2813', '112.222.222-22', '2024-10-27', '', 10, 20),
(21, 'n', 'p@gmail.com', '(55) 44444-4444', '112.222.222-22', '2004-11-13', '', 16, 21),
(22, 'ç', 'a@gmail.com', '(23) 42423-4234', '342.342.342-34', '2024-10-27', '', 17, 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` int(11) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `firstName`, `lastName`, `email`, `password`, `avatar`) VALUES
(10, 'edu', 'Eduardo', 0, '123', NULL),
(11, 'joao', 'Joao', 0, '123', NULL),
(12, '', '', 0, '', NULL),
(13, 'novo', 'Novo', 0, '123', NULL),
(14, '', '', 0, '', NULL),
(15, '', '', 0, '', NULL),
(16, 'ee', 'ee', 0, '123', NULL),
(17, 'oi', 'oi', 0, '123', NULL),
(18, 'RR', 'RR', 0, '123', NULL),
(19, 'p', 'p', 0, '123', NULL),
(20, 'r', 'r', 0, '123', NULL),
(21, 'n', 'n', 0, '123', NULL),
(22, 'ç', 'ç', 0, '123', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil_recebedor` (`id_perfil_recebedor`),
  ADD KEY `id_perfil_solicitante` (`id_perfil_solicitante`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Índices de tabela `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ofertas` (`id_ofertas`),
  ADD KEY `id_perfil_pedido` (`id_perfil_pedido`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_endereco` (`id_endereco`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_perfil_recebedor`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `notificacoes_ibfk_2` FOREIGN KEY (`id_perfil_solicitante`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `notificacoes_ibfk_3` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id`);

--
-- Restrições para tabelas `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_ofertas`) REFERENCES `ofertas` (`id`),
  ADD CONSTRAINT `perfil_pedido_ibfk_1` FOREIGN KEY (`id_perfil_pedido`) REFERENCES `perfil` (`id`);

--
-- Restrições para tabelas `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `id_usuarios` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
