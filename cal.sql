- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 05/10/2016 às 15:27
-- Versão do servidor: 10.1.13-MariaDB
-- Versão do PHP: 5.6.21


--$(this).val($(this).val().replace(new RegExp(/[^0-9.]/, 'g'), ""));
--console.log($(this).val());


--CREATE DATABASE calendario

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_categoria`
--

CREATE TABLE `cadas_categoria` (
  `id_categoria` int(100) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `Situacao` varchar(20) NOT NULL,
  `Espaco` varchar(250) NOT NULL,
  `Validar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_espaco`
--

CREATE TABLE `cadas_espaco` (
  `id_espaco` int(100) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `descricao` text NOT NULL,
  `Cor` varchar(250) NOT NULL,
  `Situacao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_recurso`
--

CREATE TABLE `cadas_recurso` (
  `id_recurso` int(100) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `Descricao` text NOT NULL,
  `Situacao` char(20) NOT NULL,
  `icone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_solicitante`
--

CREATE TABLE `cadas_solicitante` (
  `id_solicitante` int(11) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `CPF` int(11) DEFAULT NULL,
  `CNPJ` varchar(14) DEFAULT NULL,
  `Situacao` varchar(20) NOT NULL,
  `Telefone` varchar(18) NOT NULL,
  `Nome_Contato` varchar(250) NOT NULL,
  `Descricao` text NOT NULL,
  `Endereco` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_usu`
--

CREATE TABLE `cadas_usu` (
  `id_usuario` int(100) NOT NULL,
  `login` varchar(150) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `situacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cadas_usu`
--

INSERT INTO `cadas_usu` (`id_usuario`, `login`, `Nome`, `email`, `perfil`, `situacao`) VALUES
(1, 'rcoliveira', 'Ramon Cardoso de Oliveira', 'rcoliveira@camaracaxias.rs.gov.br', '1', 1),
(7, 'sferrigo', 'Samuel Francisco Ferrigo', 'sferrigo@camaracaxias.rs.gov.br', '1', 1),
(12, 'cfonseca', 'Cristiane da Fonseca', 'cfonseca@camaracaxias.rs.gov.br', '1', 1),
(13, 'rlizot', 'Rejane Lizot', 'rlizot@camaracaxias.rs.gov.br', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_cat_esp`
--

CREATE TABLE `rel_cat_esp` (
  `id_categoria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_esp_user`
--

CREATE TABLE `rel_esp_user` (
  `id_espaco` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_esp`
--

CREATE TABLE `rel_rec_esp` (
  `id_recurso` int(11) NOT NULL,
  `id_espaco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_sol`
--

CREATE TABLE `rel_rec_sol` (
  `id_solicitacao` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_soli`
--

CREATE TABLE `rel_rec_soli` (
  `id_solicitacao` int(11) NOT NULL,
  `id_recurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_usu`
--

CREATE TABLE `rel_rec_usu` (
  `id_recurso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `id_espaco` int(11) NOT NULL,
  `id_solicitante` int(11) NOT NULL,
  `assunto` varchar(250) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `data` date NOT NULL,
  `i_hora` time NOT NULL,
  `f_hora` time NOT NULL,
  `desc` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cadas_categoria`
--
ALTER TABLE `cadas_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `cadas_espaco`
--
ALTER TABLE `cadas_espaco`
  ADD PRIMARY KEY (`id_espaco`);

--
-- Índices de tabela `cadas_recurso`
--
ALTER TABLE `cadas_recurso`
  ADD PRIMARY KEY (`id_recurso`);

--
-- Índices de tabela `cadas_solicitante`
--
ALTER TABLE `cadas_solicitante`
  ADD PRIMARY KEY (`id_solicitante`);

--
-- Índices de tabela `cadas_usu`
--
ALTER TABLE `cadas_usu`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices de tabela `rel_cat_esp`
--
ALTER TABLE `rel_cat_esp`
  ADD PRIMARY KEY (`id_categoria`,`id_user`);

--
-- Índices de tabela `rel_esp_user`
--
ALTER TABLE `rel_esp_user`
  ADD PRIMARY KEY (`id_espaco`,`id_user`);

--
-- Índices de tabela `rel_rec_esp`
--
ALTER TABLE `rel_rec_esp`
  ADD PRIMARY KEY (`id_recurso`,`id_espaco`);

--
-- Índices de tabela `rel_rec_sol`
--
ALTER TABLE `rel_rec_sol`
  ADD PRIMARY KEY (`id_solicitacao`,`id_categoria`);

--
-- Índices de tabela `rel_rec_soli`
--
ALTER TABLE `rel_rec_soli`
  ADD PRIMARY KEY (`id_solicitacao`,`id_recurso`);

--
-- Índices de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_espaco` (`id_espaco`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cadas_categoria`
--
ALTER TABLE `cadas_categoria`
  MODIFY `id_categoria` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `cadas_espaco`
--
ALTER TABLE `cadas_espaco`
  MODIFY `id_espaco` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `cadas_recurso`
--
ALTER TABLE `cadas_recurso`
  MODIFY `id_recurso` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `cadas_solicitante`
--
ALTER TABLE `cadas_solicitante`
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de tabela `cadas_usu`
--
ALTER TABLE `cadas_usu`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
