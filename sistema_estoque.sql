-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Out-2021 às 18:23
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`cat_id`, `cat_nome`) VALUES
(1, 'Hambúrgueres'),
(2, 'Bebidas'),
(3, 'Acompanhamentos'),
(4, 'Sobremesas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item`
--

CREATE TABLE `tb_item` (
  `item_id` int(11) NOT NULL,
  `item_nome` varchar(50) NOT NULL,
  `item_descricao` varchar(150) NOT NULL,
  `item_estoque` int(11) NOT NULL,
  `item_preco` double NOT NULL,
  `item_imagem` varchar(70) DEFAULT NULL,
  `item_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log`
--

CREATE TABLE `tb_log` (
  `log_id` int(11) NOT NULL,
  `log_tipo` int(11) NOT NULL,
  `log_descricao` varchar(255) NOT NULL,
  `log_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log_tipo`
--

CREATE TABLE `tb_log_tipo` (
  `log_tipo_id` int(11) NOT NULL,
  `log_tipo_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_log_tipo`
--

INSERT INTO `tb_log_tipo` (`log_tipo_id`, `log_tipo_nome`) VALUES
(1, 'Cadastro'),
(3, 'Alteração');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

CREATE TABLE `tb_pedido` (
  `pedido_id` int(11) NOT NULL,
  `pedido_horario` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido_itens`
--

CREATE TABLE `tb_pedido_itens` (
  `pi_id` int(11) NOT NULL,
  `pi_pedido_id` int(11) NOT NULL,
  `pi_item_id` int(11) NOT NULL,
  `pi_quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_perfil`
--

CREATE TABLE `tb_perfil` (
  `nome` varchar(50) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Índices para tabela `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_categoria` (`item_categoria`);

--
-- Índices para tabela `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_tipo` (`log_tipo`);

--
-- Índices para tabela `tb_log_tipo`
--
ALTER TABLE `tb_log_tipo`
  ADD PRIMARY KEY (`log_tipo_id`);

--
-- Índices para tabela `tb_pedido`
--
ALTER TABLE `tb_pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Índices para tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `pi_item_id` (`pi_item_id`),
  ADD KEY `pi_pedido_id` (`pi_pedido_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_log_tipo`
--
ALTER TABLE `tb_log_tipo`
  MODIFY `log_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_item`
--
ALTER TABLE `tb_item`
  ADD CONSTRAINT `tb_item_ibfk_1` FOREIGN KEY (`item_categoria`) REFERENCES `tb_categoria` (`cat_id`);

--
-- Limitadores para a tabela `tb_log`
--
ALTER TABLE `tb_log`
  ADD CONSTRAINT `tb_log_ibfk_1` FOREIGN KEY (`log_tipo`) REFERENCES `tb_log_tipo` (`log_tipo_id`);

--
-- Limitadores para a tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  ADD CONSTRAINT `tb_pedido_itens_ibfk_1` FOREIGN KEY (`pi_item_id`) REFERENCES `tb_item` (`item_id`),
  ADD CONSTRAINT `tb_pedido_itens_ibfk_2` FOREIGN KEY (`pi_pedido_id`) REFERENCES `tb_pedido` (`pedido_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
