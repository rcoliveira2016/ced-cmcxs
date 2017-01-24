-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 04/01/2017 às 14:13
-- Versão do servidor: 10.1.13-MariaDB
-- Versão do PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `calendario`
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

--
-- Fazendo dump de dados para tabela `cadas_categoria`
--

INSERT INTO `cadas_categoria` (`id_categoria`, `Nome`, `Situacao`, `Espaco`, `Validar`) VALUES
(11, 'TransmissÃ£o', '0', '9', 0),
(12, 'Eventos', '1', '10', 1);

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

--
-- Fazendo dump de dados para tabela `cadas_espaco`
--

INSERT INTO `cadas_espaco` (`id_espaco`, `Nome`, `descricao`, `Cor`, `Situacao`) VALUES
(9, 'Anfiteatrogrk', 'sgggf', '#C2185B', '0'),
(10, 'PlenÃ¡rioy', '2rhfffhfgh', '#B6B6B6', '1'),
(11, 'banheiro', 'lalala', '#6A5ACD', '1');

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

--
-- Fazendo dump de dados para tabela `cadas_recurso`
--

INSERT INTO `cadas_recurso` (`id_recurso`, `Nome`, `Descricao`, `Situacao`, `icone`) VALUES
(2, 'asdag', 'asdasg', '1', 'Mml0Zp.png'),
(3, 'tv', 'qweqw', '1', 'DKz6V34K.png'),
(4, 'Notebook', 'Notebook patrimonio XYZ', '1', 'o8VeSQJB8.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadas_solicitante`
--

CREATE TABLE `cadas_solicitante` (
  `id_solicitante` int(11) NOT NULL,
  `Nome` varchar(250) NOT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `CPF` int(11) DEFAULT NULL,
  `CNPJ` varchar(14) DEFAULT NULL,
  `Situacao` varchar(20) DEFAULT NULL,
  `Telefone` varchar(18) NOT NULL,
  `Nome_Contato` varchar(250) DEFAULT NULL,
  `Descricao` text,
  `Endereco` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `cadas_solicitante`
--

INSERT INTO `cadas_solicitante` (`id_solicitante`, `Nome`, `Email`, `CPF`, `CNPJ`, `Situacao`, `Telefone`, `Nome_Contato`, `Descricao`, `Endereco`) VALUES
(8, 'Andrea Tatiana', 'deia@gmail.com', 2147483647, '', '1', '(54)99870059', 'Ramon', 'dqokep', 'guiygi'),
(14, 'Marilia', 'Ma@gmail.com', 231351111, '', '0', '(054)99988447', 'luis', 'bl bla aaliao', 'Lageado Grade'),
(16, '111', '11', 0, '123', '0', '(11)11111111', '1111', '11', '11'),
(17, 'PelÃ©', 'pele@gmail.com', NULL, '0654321321', '1', '(54)31245689', 'Neymar', 'Edson Arantes do Nascimento', 'Santos'),
(18, 'Ramon Cardoso de Oliveira', 'rcoliveira@camaracaxias.rs.gov.br', 111111, NULL, '0', '(111111)111111', 'qqqqq', 'qweqw', 'qeqweqw'),
(19, 'Chaves', 'cheves@gmail.com', 13, NULL, '1', '(54)81352645', 'Chespirito', 'TEste', 'Teste'),
(25, 'wqe', 'qweqw', 0, '', '0', 'qweqw', '', '', '');

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
(10, 'coliveira', 'Caleb Medeiros de Oliveira', 'coliveira@camaracaxias.rs.gov.br', '2', 0),
(11, 'gpinto', 'Gabriele da Silva Pinto', 'gpinto@camaracaxias.rs.gov.br', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_cat_esp`
--

CREATE TABLE `rel_cat_esp` (
  `id_categoria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `rel_cat_esp`
--

INSERT INTO `rel_cat_esp` (`id_categoria`, `id_user`) VALUES
(8, 10),
(9, 1),
(9, 7),
(10, 7),
(11, 1),
(11, 7),
(11, 10),
(12, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_esp_user`
--

CREATE TABLE `rel_esp_user` (
  `id_espaco` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `rel_esp_user`
--

INSERT INTO `rel_esp_user` (`id_espaco`, `id_user`) VALUES
(9, 1),
(9, 7),
(10, 7),
(10, 10),
(11, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_esp`
--

CREATE TABLE `rel_rec_esp` (
  `id_recurso` int(11) NOT NULL,
  `id_espaco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `rel_rec_esp`
--

INSERT INTO `rel_rec_esp` (`id_recurso`, `id_espaco`) VALUES
(2, 9),
(3, 9),
(3, 10);

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

--
-- Fazendo dump de dados para tabela `rel_rec_soli`
--

INSERT INTO `rel_rec_soli` (`id_solicitacao`, `id_recurso`) VALUES
(12, 3),
(22, 2),
(22, 3),
(23, 3),
(27, 2),
(28, 3),
(29, 2),
(29, 3),
(30, 2),
(34, 2),
(35, 2),
(40, 2),
(41, 2),
(44, 3),
(45, 2),
(46, 2),
(48, 3),
(50, 3),
(51, 3),
(52, 3),
(54, 2),
(54, 3),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(59, 3),
(60, 2),
(61, 3),
(62, 2),
(62, 3),
(63, 2),
(63, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 2),
(70, 3),
(71, 2),
(77, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `rel_rec_usu`
--

CREATE TABLE `rel_rec_usu` (
  `id_recurso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `rel_rec_usu`
--

INSERT INTO `rel_rec_usu` (`id_recurso`, `id_usuario`) VALUES
(4, 11),
(3, 1),
(2, 10),
(2, 1),
(2, 7);

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
  `id_user` int(11) NOT NULL,
  `site_camara` int(11) NOT NULL,
  `mostrar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `id_espaco`, `id_solicitante`, `assunto`, `id_categoria`, `data`, `i_hora`, `f_hora`, `desc`, `id_user`, `site_camara`, `mostrar`) VALUES
(12, 10, 17, 'GOLLL', 11, '2016-09-23', '12:55:00', '18:00:00', '1111111', 1, 0, 0),
(13, 9, 18, 'sadasggg', 11, '2016-08-18', '12:55:00', '18:00:00', '11111111', 1, 0, 1),
(16, 10, 19, 'TEste', 12, '2016-08-19', '13:00:00', '14:00:00', 'tedas', 7, 0, 0),
(17, 10, 14, 'Teste', 12, '2016-08-18', '13:00:00', '14:00:00', 'TEste', 7, 0, 0),
(18, 9, 8, 'qweqwe', 12, '2016-08-22', '11:10:00', '11:11:00', ' ', 1, 0, 0),
(19, 9, 8, '1111111111111111', 11, '2016-08-14', '11:11:00', '20:00:00', ' ', 1, 0, 1),
(20, 9, 8, 'sss', 12, '2016-08-25', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(21, 10, 8, '11111111111', 11, '2016-08-24', '09:10:00', '10:00:00', ' ', 1, 0, 0),
(22, 9, 14, 'hhh', 11, '2016-08-27', '11:13:00', '13:00:00', ' 111', 1, 0, 0),
(23, 10, 8, 'tweste', 11, '2016-08-23', '12:00:00', '15:00:00', 'sssssss', 1, 0, 0),
(24, 9, 8, 'qewqe', 11, '2016-08-26', '07:31:00', '07:40:00', '111', 1, 0, 0),
(26, 11, 17, 'hue', 11, '2016-08-23', '12:40:00', '14:00:00', ' ', 1, 0, 0),
(28, 10, 8, '456', 11, '2016-09-06', '11:13:00', '22:22:00', '11', 1, 0, 0),
(39, 10, 18, 'aaa', 12, '2016-09-14', '07:30:00', '18:00:00', ' ', 1, 0, 1),
(43, 10, 8, 'hh', 11, '2016-08-21', '07:00:00', '20:30:00', ' ', 1, 0, 0),
(44, 10, 8, 'kkkk', 11, '2016-08-25', '07:00:00', '07:30:00', ' ', 1, 0, 0),
(45, 9, 8, 'ff', 11, '2016-09-14', '07:20:00', '09:11:00', ' ', 1, 0, 0),
(46, 9, 14, 'nnnn', 12, '2016-09-11', '06:00:00', '18:30:00', ' ', 1, 0, 0),
(47, 11, 8, 'ASA', 12, '2016-09-11', '06:22:00', '17:00:00', ' ', 1, 0, 0),
(48, 10, 14, 'hhjgh', 11, '2016-09-11', '07:30:00', '10:00:00', 'trrr', 1, 0, 0),
(49, 9, 8, 'ff', 11, '2016-09-23', '06:00:00', '07:30:00', ' ', 1, 0, 0),
(50, 10, 17, 'Jogo Copa 70', 11, '2016-10-23', '17:00:00', '18:00:00', 'ytewgsadbf lkasjhd flksadjhf Ã§asdf ', 7, 0, 0),
(51, 10, 18, 'Festa', 12, '2016-10-23', '15:16:00', '16:17:00', 'Festa do Planalto', 1, 1, 1),
(52, 9, 16, 'Passeio', 12, '2016-10-23', '15:00:00', '16:00:00', 'adfasdf', 7, 0, 0),
(53, 11, 14, 'Carte4ado', 12, '2016-10-23', '16:00:00', '17:00:00', 'Em horÃ¡rio indeterminado', 7, 0, 0),
(54, 9, 8, '11', 12, '2016-10-19', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(55, 9, 8, '111', 12, '2016-10-19', '11:00:00', '11:30:00', ' ', 1, 0, 0),
(57, 9, 8, '222', 11, '2016-10-21', '11:11:00', '20:00:00', ' ', 1, 0, 0),
(61, 10, 8, '1111', 11, '2016-10-25', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(62, 9, 8, '1111', 11, '2016-10-21', '11:11:00', '22:22:00', '111', 1, 0, 0),
(63, 9, 8, '12321', 11, '2016-10-21', '11:11:00', '11:11:00', ' ', 1, 0, 0),
(64, 9, 8, '11111', 11, '2016-10-21', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(65, 11, 8, 'ggg', 11, '2016-10-21', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(66, 10, 8, '1111', 11, '2016-10-05', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(67, 10, 8, '111', 12, '2016-10-31', '06:00:00', '07:30:00', ' ', 1, 0, 0),
(68, 10, 8, '12321', 11, '2016-10-27', '11:11:00', '11:13:00', ' ', 1, 0, 0),
(69, 9, 8, 'qwewq', 11, '2016-10-29', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(70, 10, 8, '11111', 11, '2016-10-01', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(71, 9, 14, '123', 11, '2016-10-26', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(72, 11, 8, '11', 11, '2016-10-30', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(73, 11, 8, '1111', 12, '2016-11-25', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(74, 10, 8, '12312312', 11, '2016-10-19', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(75, 11, 14, '1111', 11, '2016-10-29', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(76, 9, 8, '1213', 11, '2016-10-20', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(77, 9, 8, '12313', 11, '2016-12-14', '11:11:00', '22:22:00', ' ', 1, 0, 0),
(78, 9, 8, 'aaaaaaaawwwwww', 12, '2016-12-16', '11:11:00', '22:00:00', ' ', 1, 0, 0),
(79, 9, 14, '12321321', 11, '2016-12-17', '11:11:00', '22:22:00', ' ', 1, 1, 0),
(80, 9, 8, '12321', 11, '2016-12-19', '11:11:00', '22:22:00', ' ', 1, 1, 0),
(81, 9, 8, '1232131', 11, '2016-12-12', '12:11:00', '12:32:00', ' ', 1, 0, 0);

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
  MODIFY `id_solicitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de tabela `cadas_usu`
--
ALTER TABLE `cadas_usu`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
