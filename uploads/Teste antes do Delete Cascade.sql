-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Fev-2017 às 03:55
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alice`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(7) NOT NULL,
  `cat` int(2) NOT NULL,
  `sub_cat` int(7) DEFAULT NULL,
  `public` int(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `refRest` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `cat`, `sub_cat`, `public`, `image`, `refRest`) VALUES
(1, 1, 0, 1, '', 1),
(2, 1, 1, 1, '', 1),
(3, 1, 2, 1, '', 1),
(4, 1, 3, 1, '', 1),
(5, 2, 0, 1, '', 1),
(6, 2, 1, 1, '', 1),
(7, 2, 2, 1, '', 1),
(8, 2, 3, 1, '', 1),
(9, 3, -1, 1, '', 1),
(12, 1, -1, 1, '', 11),
(13, 2, -1, 1, '', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cat_name`
--

CREATE TABLE `cat_name` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `refCat` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cat_name`
--

INSERT INTO `cat_name` (`id`, `name`, `description`, `lang`, `refCat`) VALUES
(1, 'Pizza', 'Categoria pizzas', 'pt', 1),
(2, 'Massa fina', 'Massa fina', 'pt', 2),
(3, 'Massa fofa', 'Massa fofa', 'pt', 3),
(4, 'Vegetariana', 'Pizza vegetariana', 'pt', 4),
(5, 'Sushi', 'Sushi', 'pt', 5),
(6, 'Sashimi', 'Sashimi de peixe fresco', 'pt', 6),
(7, 'Naguiri', 'Naguiri', 'pt', 7),
(8, 'Maki', 'Maki', 'pt', 8),
(9, 'Entradas', 'Entradas diversas', 'pt', 9),
(12, 'Saladas', '', 'pt', 12),
(13, 'Carne', '', 'pt', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `city`
--

CREATE TABLE `city` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `city`
--

INSERT INTO `city` (`id`, `name`, `url_name`) VALUES
(1, 'Aveiro', 'aveiro'),
(2, 'Lisboa', 'lisboa'),
(3, 'Porto', 'porto'),
(4, 'Maia', 'maia'),
(5, 'Cascais', 'cascais'),
(6, 'Seixal', 'seixal'),
(7, 'Almada', 'almada'),
(8, 'Figueira da Foz', 'figueira_da_foz'),
(9, 'Oeiras', 'oeiras'),
(10, 'Linda-a-Velha', 'linda_a_velha'),
(11, 'Sintra', 'sintra'),
(12, 'Odivelas', 'odivelas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comment`
--

CREATE TABLE `comment` (
  `id` int(7) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `class` int(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `refRest` int(7) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cuisine_type`
--

CREATE TABLE `cuisine_type` (
  `id` int(7) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cuisine_type`
--

INSERT INTO `cuisine_type` (`id`, `name`) VALUES
(1, 'Sushi'),
(2, 'Pizza'),
(3, 'Espetadas'),
(4, 'Bolos'),
(5, 'Hamburgeres'),
(6, 'Americana'),
(7, 'Europea'),
(8, 'Italiana'),
(9, 'Chinesa'),
(10, 'Mexicana'),
(11, 'Exotica'),
(12, 'Japonesa'),
(13, 'Brasileira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `delivery_price`
--

CREATE TABLE `delivery_price` (
  `id` int(7) NOT NULL,
  `price` varchar(5) NOT NULL,
  `bonus` varchar(5) NOT NULL,
  `discount` varchar(5) NOT NULL,
  `refZona` int(7) NOT NULL,
  `refRest` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `delivery_price`
--

INSERT INTO `delivery_price` (`id`, `price`, `bonus`, `discount`, `refZona`, `refRest`) VALUES
(1, '0', '0', '0', 1, 1),
(2, '5', '50', '100', 2, 1),
(3, '7', '29', '70', 3, 1),
(4, '5', '50', '100', 4, 1),
(5, '10', '50', '50', 5, 1),
(16, '3', '0', '0', 1, 11),
(17, '4', '0', '0', 2, 11),
(18, '3.5', '0', '0', 3, 11),
(19, '4', '0', '0', 4, 11),
(20, '3.5', '0', '0', 5, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extra_product`
--

CREATE TABLE `extra_product` (
  `id` int(7) NOT NULL,
  `price` varchar(10) NOT NULL,
  `refProd` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `extra_product`
--

INSERT INTO `extra_product` (`id`, `price`, `refProd`) VALUES
(1, '0.15', 4),
(2, '0.35', 4),
(3, '0.25', 4),
(4, '0.50', 4),
(5, '0.15', 7),
(6, '0.65', 7),
(7, '0.75', 7),
(8, '0.10', 10),
(9, '0', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extra_product_name`
--

CREATE TABLE `extra_product_name` (
  `id` int(7) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `refExtraProd` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `extra_product_name`
--

INSERT INTO `extra_product_name` (`id`, `name`, `description`, `lang`, `refExtraProd`) VALUES
(1, 'Molho Agri-Doce', '', '', 1),
(2, 'Molho Alho', '', '', 2),
(3, 'Ketchup', '', '', 3),
(4, 'Queijo', '', '', 4),
(5, 'Bacon', '', '', 5),
(6, 'Queijo', '', '', 6),
(7, 'Fiambre', '', '', 7),
(8, 'Limão', '', '', 8),
(9, 'Gelo', '', '', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorite`
--

CREATE TABLE `favorite` (
  `id` int(7) NOT NULL,
  `refRest` int(7) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favorite`
--

INSERT INTO `favorite` (`id`, `refRest`, `refUser`) VALUES
(1, 1, 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `order`
--

CREATE TABLE `order` (
  `id` int(7) NOT NULL,
  `price` varchar(7) NOT NULL,
  `delivery_price` varchar(3) NOT NULL,
  `discount` varchar(7) DEFAULT NULL,
  `date_time` varchar(100) NOT NULL,
  `rest` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `zone` int(3) NOT NULL,
  `address` varchar(250) NOT NULL,
  `comment` text NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `order`
--

INSERT INTO `order` (`id`, `price`, `delivery_price`, `discount`, `date_time`, `rest`, `name`, `phone`, `zone`, `address`, `comment`, `payment_method`, `refUser`) VALUES
(15, '80.4', '3', '0', '2017-01-05 00:00:00', 2, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(16, '80.4', '3', '0', '2017-01-05 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(17, '11.5', '3', '0', '2017-01-06 00:00:00', 4, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(18, '11.5', '3', '0', '2017-01-06 00:00:00', 3, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(19, '11.5', '3', '0', '2017-01-06 00:00:00', 4, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(20, '11.5', '3', '0', '0000-00-00 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(21, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(22, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(23, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(24, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(25, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(26, '11.5', '3', '0', '2017-01-06 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(27, '15', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(28, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(29, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(30, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(31, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(32, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(33, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(34, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(35, '20.5', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(36, '10', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(37, '10', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(38, '24.1', '7', '0', '2017-01-08 00:00:00', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(39, '295.85', '0', '0', '2017/01/08 - 03:51', 1, 'Anton Zverev', '9191919191', 2, 'Rua das pombas', '', '1', 19),
(40, '4.5', '7', '0', '2017/01/09 - 23:35', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19),
(41, '20.5', '7', '0', '2017/01/13 - 00:26', 1, 'Anton Zverev', '9191919191', 3, 'Rua das pombas', '', '0', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_prod`
--

CREATE TABLE `order_prod` (
  `id` int(7) NOT NULL,
  `qnt` int(2) NOT NULL,
  `extras` varchar(100) NOT NULL,
  `refProd` int(7) NOT NULL,
  `refOrder` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `order_prod`
--

INSERT INTO `order_prod` (`id`, `qnt`, `extras`, `refProd`, `refOrder`) VALUES
(1, 1, '', 1, 15),
(2, 9, '', 2, 15),
(3, 2, '1,4,', 4, 15),
(4, 1, '', 1, 16),
(5, 9, '', 2, 16),
(6, 2, '1,4,', 4, 16),
(7, 1, '', 2, 18),
(8, 1, '', 2, 19),
(9, 1, '', 2, 20),
(12, 1, '', 2, 23),
(13, 1, '', 2, 24),
(14, 1, '', 2, 25),
(15, 1, '', 2, 26),
(16, 1, '', 1, 27),
(17, 1, '', 2, 27),
(18, 1, '', 1, 28),
(19, 1, '', 2, 28),
(20, 1, '', 3, 28),
(21, 1, '', 1, 29),
(22, 1, '', 2, 29),
(23, 1, '', 3, 29),
(24, 1, '', 1, 30),
(25, 1, '', 2, 30),
(26, 1, '', 3, 30),
(27, 1, '', 1, 31),
(28, 1, '', 2, 31),
(29, 1, '', 3, 31),
(30, 1, '', 1, 32),
(31, 1, '', 2, 32),
(32, 1, '', 3, 32),
(33, 1, '', 1, 33),
(34, 1, '', 2, 33),
(35, 1, '', 3, 33),
(36, 1, '', 1, 34),
(37, 1, '', 2, 34),
(38, 1, '', 3, 34),
(39, 1, '', 1, 35),
(40, 1, '', 2, 35),
(41, 1, '', 3, 35),
(42, 1, '', 2, 36),
(43, 1, '', 3, 36),
(44, 1, '', 2, 37),
(45, 1, '', 3, 37),
(46, 2, '5,6,7,', 7, 38),
(47, 1, '', 1, 39),
(48, 2, '', 2, 39),
(49, 1, '', 3, 39),
(50, 1, '', 6, 39),
(51, 1, '', 5, 39),
(52, 1, '', 4, 39),
(53, 2, '1,2,4,', 4, 39),
(54, 3, '1,', 4, 39),
(55, 1, '', 9, 39),
(56, 1, '', 8, 39),
(57, 1, '', 7, 39),
(58, 3, '5,6,', 7, 39),
(59, 1, '', 12, 39),
(60, 1, '', 11, 39),
(61, 1, '', 10, 39),
(62, 2, '9,', 10, 39),
(63, 1, '', 15, 39),
(64, 2, '', 14, 39),
(65, 1, '', 13, 39),
(66, 2, '', 17, 39),
(67, 1, '', 16, 39),
(68, 1, '', 2, 40),
(69, 1, '', 1, 41),
(70, 1, '', 2, 41),
(71, 1, '', 3, 41);

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `id` int(7) NOT NULL,
  `extra` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL,
  `refCat` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`id`, `extra`, `public`, `refCat`) VALUES
(1, 0, 1, 2),
(2, 0, 1, 2),
(3, 0, 1, 2),
(4, 1, 1, 3),
(5, 0, 1, 3),
(6, 0, 1, 4),
(7, 1, 1, 6),
(8, 0, 1, 6),
(9, 0, 1, 6),
(10, 1, 1, 7),
(11, 0, 1, 7),
(12, 0, 1, 8),
(13, 0, 1, 9),
(14, 0, 1, 9),
(15, 0, 1, 9),
(16, 0, 1, 9),
(17, 0, 1, 9),
(63, 0, 1, 12),
(64, 0, 1, 12),
(65, 0, 1, 12),
(66, 0, 1, 12),
(67, 0, 1, 13),
(68, 0, 1, 13),
(69, 0, 1, 13),
(70, 0, 1, 13),
(71, 0, 1, 13),
(72, 0, 1, 13),
(73, 0, 1, 13),
(74, 0, 1, 13),
(75, 0, 1, 13),
(76, 0, 1, 13),
(77, 0, 1, 13),
(78, 0, 1, 13),
(79, 0, 1, 13),
(80, 0, 1, 13),
(81, 0, 1, 13),
(82, 0, 1, 13),
(83, 0, 1, 13),
(84, 0, 1, 13),
(85, 0, 1, 13),
(86, 0, 1, 13),
(87, 0, 1, 13),
(88, 0, 1, 13),
(89, 0, 1, 13),
(90, 0, 1, 13),
(91, 0, 1, 13),
(92, 0, 1, 13),
(93, 0, 1, 13),
(94, 0, 1, 13),
(95, 0, 1, 13),
(96, 0, 1, 13),
(97, 0, 1, 13),
(98, 0, 1, 13),
(99, 0, 1, 13),
(100, 0, 1, 13),
(101, 0, 1, 13),
(102, 0, 1, 13),
(103, 0, 1, 13),
(104, 0, 1, 13),
(105, 0, 1, 13),
(106, 0, 1, 13),
(107, 0, 1, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_image`
--

CREATE TABLE `prod_image` (
  `id` int(7) NOT NULL,
  `url` varchar(255) NOT NULL,
  `refProd` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prod_image`
--

INSERT INTO `prod_image` (`id`, `url`, `refProd`) VALUES
(1, 'pizza_margarida.jpg', 1),
(2, 'odin.jpg', 2),
(3, '4_estacoes.jpg', 3),
(4, 'papperoni.jpg', 4),
(5, 'tropical.jpg', 5),
(6, 'vegetariana.jpg', 6),
(7, 'sashimi_atum.jpg', 7),
(8, 'sashimi_salmao.jpg', 8),
(9, 'sashimi_misto.jpg', 9),
(10, 'niguiri_atum.jpg', 10),
(11, 'niguiri_salmao.jpg', 11),
(12, 'maki_salmao.jpg', 12),
(13, 'pao.jpg', 13),
(14, 'sopa.jpg', 14),
(15, 'linguica.jpg', 15),
(16, 'azeitonas.jpg', 16),
(17, 'manteiga.jpg', 17),
(63, 'salada_mista.jpg', 63),
(64, 'salada_do_chefe.jpg', 64),
(65, 'salada_de_palmito.jpg', 65),
(66, 'salada_tropical.jpg', 66),
(67, 'ossinhos_mineira.jpg', 67),
(68, 'secretos_porco_preto.jpg', 68),
(69, 'secretos_porco_preto.jpg', 69),
(70, 'meio_meio_de_novilho.jpg', 70),
(71, 'filet_mignon.jpg', 71),
(72, 'filet_mignon_dourado.jpg', 72),
(73, 'filet_mignon_dourado.jpg', 73),
(74, 'strogonof_de_filet.jpg', 74),
(75, 'contra_filet_carioca.jpg', 75),
(76, 'contra_filet_carioca.jpg', 76),
(77, 'contra_filet_osvaldo_aranha.jpg', 77),
(78, 'contra_filet_osvaldo_aranha.jpg', 78),
(79, 'picanha_brasileira.jpg', 79),
(80, 'picanha_brasileira.jpg', 80),
(81, 'meio_a_meio.jpg', 81),
(82, 'maminha_brasileira.jpg', 82),
(83, 'maminha_brasileira.jpg', 83),
(84, 'ossinhos_mineira.jpg', 84),
(85, 'galeto_carioca.jpg', 85),
(86, 'frango_no_churrasco_simples.jpg', 86),
(87, 'espetada_de_peru_com_bacon.jpg', 87),
(88, 'costeleta_de_porco_gaucha.jpg', 88),
(89, 'costeletas_de_porco_gaucha.jpg', 89),
(90, 'entrecosto_carioca.jpg', 90),
(91, 'entrecosto_carioca.jpg', 91),
(92, 'febras_penafiel.jpg', 92),
(93, 'febras_penafiel.jpg', 93),
(94, 'lombinho_de_porco.jpg', 94),
(95, 'lombinho_de_porco.jpg', 95),
(96, 'tutu_mineira.jpg', 96),
(97, 'tutu_mineira.jpg', 97),
(98, 'churrasco_misto.jpg', 98),
(99, 'picadinho_elis_regina.jpg', 99),
(100, 'filet_mignon.jpg', 100),
(101, 'feijoada_brasileira.jpg', 101),
(102, 'feijoada_brasileira.jpg', 102),
(103, 'galeto_passarinho.jpg', 103),
(104, 'galeto_passarinho.jpg', 104),
(105, 'costeletão_de_novilho.jpg', 105),
(106, 'contra_filet_bordalesa.jpg', 106),
(107, 'contra_filet_bordalesa.jpg', 107);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_name`
--

CREATE TABLE `prod_name` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lang` varchar(5) NOT NULL,
  `refProd` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prod_name`
--

INSERT INTO `prod_name` (`id`, `name`, `description`, `lang`, `refProd`) VALUES
(1, 'Pizza margarida', 'Pizza margarida', 'pt', 1),
(2, 'Pizza odin', 'Pizza odin', 'pt', 2),
(3, 'Pizza 4 estacoes', 'Pizza 4 estacoes', 'pt', 3),
(4, 'Pizza papperoni', 'Pizza papperoni', 'pt', 4),
(5, 'Pizza tropical', 'Pizza tropical', 'pt', 5),
(6, 'Pizza vegetariana', 'Pizza vegetariana', 'pt', 6),
(7, 'Sashimi atum', 'Sashimi atum', 'pt', 7),
(8, 'Sashimi salmao', 'Sashimi salmao', 'pt', 8),
(9, 'Sashimi misto', 'Sashimi misto', 'pt', 9),
(10, 'Niguiri atum', 'Niguiri atum', 'pt', 10),
(11, 'Niguiri salmao', 'Niguiri salmao', 'pt', 11),
(12, 'Maki salmao', 'Maki salmao', 'pt', 12),
(13, 'Pão', 'Pão', 'pt', 13),
(14, 'Sopa', 'Sopa', 'pt', 14),
(15, 'Linguiça', 'Linguiça', 'pt', 15),
(16, 'Azeitonas', 'Azeitonas', 'pt', 16),
(17, 'Manitega', 'Manitega', 'pt', 17),
(63, 'Salada Mista', '', 'pt', 63),
(64, 'Salada do Chefe', '', 'pt', 64),
(65, 'Salada de Palmito', '', 'pt', 65),
(66, 'Salada Tropical', '', 'pt', 66),
(67, 'Ossinhos a Mineira - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 67),
(68, 'Secretos Porco Preto - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 68),
(69, 'Secretos Porco Preto - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 69),
(70, 'Meio a Meio de Novilho', 'Batata frita, arroz e salada ou o acompanhamento da feijoada', 'pt', 70),
(71, 'Filet Mignon - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 71),
(72, 'Filet Mignon Dourado - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 72),
(73, 'Filet Mignon Dourado - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 73),
(74, 'Strogonof de Filet', 'Batata frita, arroz e salada ou o acompanhamento da feijoada', 'pt', 74),
(75, 'Contra Filet à Carioca - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 75),
(76, 'Contra Filet à Carioca - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 76),
(77, 'Contra Filet à Osvaldo Aranha - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 77),
(78, 'Contra Filet à Osvaldo Aranha - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 78),
(79, 'Picanha à Brasileira - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 79),
(80, 'Picanha à Brasileira - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 80),
(81, 'Meio a Meio', 'Batata frita, arroz e salada ou o acompanhamento da feijoada', 'pt', 81),
(82, 'Maminha à Brasileira - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 82),
(83, 'Maminha à Brasileira - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 83),
(84, 'Ossinhos a Mineira - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 84),
(85, 'Galeto à Carioca - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 85),
(86, 'Frango no Churrasco Simples', '', 'pt', 86),
(87, 'Espetada de Peru com Bacon', 'Batata frita, arroz e salada', 'pt', 87),
(88, 'Costeleta de Porco à Gaucha - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 88),
(89, 'Costeletas de Porco à Gaucha - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 89),
(90, 'Entrecosto à Carioca - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 90),
(91, 'Entrecosto à Carioca - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 91),
(92, 'Febras a Penafiel - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 92),
(93, 'Febras a Penafiel - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 93),
(94, 'Lombinho de Porco - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 94),
(95, 'Lombinho de Porco - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 95),
(96, 'Tutu à Mineira - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 96),
(97, 'Tutu à Mineira - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 97),
(98, 'Churrasco Misto', 'Batata frita, arroz e salada ou o acompanhamento da feijoada', 'pt', 98),
(99, 'Picadinho à Elis Regina', '', 'pt', 99),
(100, 'Filet Mignon - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 100),
(101, 'Feijoada a Brasileira - Meia dose', '1 pax', 'pt', 101),
(102, 'Feijoada a Brasileira - Dose', '2 pax', 'pt', 102),
(103, 'Galeto à Passarinho - Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 103),
(104, 'Galeto à Passarinho - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 104),
(105, 'Costeletão de Novilho', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax - Preço por Kg', 'pt', 105),
(106, 'Contra Filet à Bordalesa- Meia Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 1 pax', 'pt', 106),
(107, 'Contra Filet à Bordalesa - Dose', 'Batata frita, arroz e salada ou o acompanhamento da feijoada - 2 pax', 'pt', 107);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prod_type`
--

CREATE TABLE `prod_type` (
  `id` int(7) NOT NULL,
  `name` varchar(30) NOT NULL,
  `refProd` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(7) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url_name` varchar(50) NOT NULL,
  `description` text,
  `extra_info` text,
  `min_price` varchar(5) NOT NULL,
  `delivery_price` varchar(5) NOT NULL DEFAULT '0',
  `delivery_time` int(3) NOT NULL,
  `card_payment` int(1) NOT NULL,
  `special` int(1) NOT NULL,
  `rate` int(1) DEFAULT NULL,
  `num_rate` int(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `gps` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `holiday` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `usercounter` int(6) DEFAULT NULL,
  `startdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `renewdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contract_type` int(1) DEFAULT NULL,
  `public` int(1) NOT NULL,
  `refCity` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `title`, `url_name`, `description`, `extra_info`, `min_price`, `delivery_price`, `delivery_time`, `card_payment`, `special`, `rate`, `num_rate`, `address`, `tel`, `gps`, `schedule`, `holiday`, `logo`, `usercounter`, `startdate`, `enddate`, `renewdate`, `contract_type`, `public`, `refCity`) VALUES
(1, 'Fusões', 'Fusoes - Restaurante moderno', 'fusoes', 'Fusoes description', 'Extra_info', '44', '0', 70, 0, 0, 0, 0, 'Rua João Afonso n17', '961110904', '40.642454, -8.657374', '10:00 - 02:00', '7,3', 'logo.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1),
(2, 'Gatupardo', '', 'gatupardo', 'Gatupardo description', 'Extra_info', '5', '5', 30, 0, 0, 0, 0, 'Rua João Afonso n17', '961110904', '37.100865, -8.35708', '12:00 - 15:00 / 19:00 - 00:00', '7', 'logo.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1),
(3, 'Rz', '', 'rz', 'Rz description', 'Extra_info', '23', '0', 60, 1, 0, 0, 0, 'Rua João Afonso n17', '961110904', '37.100865, -8.35708', '10:00 - 02:00', '7', 'logo.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1),
(4, 'Atelier de moda', '', 'atelier_moda', 'Atelier de moda description', 'Extra_info', '12', '0', 50, 0, 0, 0, 0, 'Rua João Afonso n17', '961110904', '37.100865, -8.35708', '10:00 - 02:00', '7', 'logo.jpg', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1),
(11, 'Galetos Dourados', 'Galetos Dourados', 'galetos_dourados', 'Restaurante brasileiro inaugurado em 1990. Linguiça, picanha e muqueca são alguns dos pratos tipicamente brasileiros servidos neste simpático e tranquilo local. As suas especialidades são o Tutu à Mineira, o picadinho à Élis Regina e o strogonoff.', NULL, '7', '3', 60, 1, 0, NULL, NULL, 'Rua Engº Von Haff, 7 B', '234427401', '40.644725,\r\n		-8.646137', '12:00 - 15:00 / 19:00 - 00:00', '', 'logo.png', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rest_cuisine_type`
--

CREATE TABLE `rest_cuisine_type` (
  `id` int(7) NOT NULL,
  `refRest` int(7) NOT NULL,
  `refCuisine` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `rest_cuisine_type`
--

INSERT INTO `rest_cuisine_type` (`id`, `refRest`, `refCuisine`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 10),
(4, 1, 12),
(5, 2, 1),
(6, 2, 6),
(7, 2, 2),
(8, 2, 11),
(9, 3, 9),
(10, 3, 6),
(11, 3, 3),
(12, 3, 12),
(13, 4, 4),
(14, 4, 5),
(15, 4, 7),
(19, 11, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rest_user`
--

CREATE TABLE `rest_user` (
  `id` int(7) NOT NULL,
  `public` int(1) NOT NULL,
  `refRest` int(7) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `user_id`, `created`) VALUES
(15, '8310dbe8612521a35d9a0a336b670e', 13, '2016-11-10'),
(16, '72096781f5ce15494a427a06991b00', 13, '2016-11-10'),
(17, 'a98ac12dc34812849a886191aca9d4', 13, '2016-11-10'),
(18, '68be047a0d3dc506fdd84e0f27e9c6', 13, '2016-11-10'),
(19, '3b11ee19dc21baa6a32f562721344d', 13, '2016-11-10'),
(20, 'fdf86517d7eace5c0d1c937acf5652', 13, '2016-11-10'),
(21, 'ab04b1426f611328630c95d3cfe2c1', 1, '2016-11-10'),
(22, '4b7af5bd2d1026517f203f379e660f', 15, '2016-11-10'),
(23, '76d5402339cdf5b03633e459573794', 16, '2016-11-14'),
(24, '21c7ccb74832441906d6393fe5d98c', 1, '2016-11-14'),
(25, '410c5bfc191c8bcf849cc448ede7b7', 2, '2016-11-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `last_login` varchar(100) NOT NULL,
  `creation_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `points` int(7) DEFAULT NULL,
  `notifications` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `facebook`, `password`, `tel`, `nif`, `last_login`, `creation_date`, `status`, `points`, `notifications`) VALUES
(1, 'Anton', 'antonza', 'antonza@ua.pt', '', 'sha256:1000:c0T/V+GEBsq4Ejq0MlgUZVgaYX2b8DEs:m1vf3GfeURAG5i96YJoWm319kymvLx/u', '913129148', '247723436', '2016-11-10 02:55:39 AM', '0000-00-00', '', 0, 1),
(14, 'new', '', 'new@ua.pt', '', 'sha256:1000:QSjUuSEG+uCexXh710oTRleg8wj6vAP+:B/HzPHo1WjON4h/8Il3b2TY+R4pDIa1P', '', NULL, '2016-11-10 01:27:58 AM', '0000-00-00', 'pending', NULL, 1),
(17, 'Com tel', '', 'antonza@tel.pt', '', 'sha256:1000:v0bo7FVwvH+v9YPYZrbUXq8GB5H7zTt+:eBEQQS/VWigEDLKt5V0H8n8U76eg4lTh', '', NULL, '2016-11-14 11:43:23 PM', '2016-11-14 11:43:23 PM', 'pending', NULL, 1),
(18, 'mais', '', 'antonza@ua.um', '', 'sha256:1000:oajGJjIqwKWlsPXXB7wO5dzznEBfwjF7:Es4KCxfkH40/vdusbf756Hp4SVMktPWh', '', NULL, '2016/11/15 - 00:00', '2016/11/15 - 00:00', 'pending', NULL, 1),
(19, 'Anton Zverev', '', 'antonza86@gmail.com', '1494612090553904', '', '', NULL, '2017/02/12 - 03:30', '2016/12/04 - 01:53', 'need_confirm', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_address`
--

CREATE TABLE `user_address` (
  `id` int(7) NOT NULL,
  `default_address` tinyint(1) NOT NULL,
  `id_zone` int(3) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_address`
--

INSERT INTO `user_address` (`id`, `default_address`, `id_zone`, `city`, `address`, `refUser`) VALUES
(1, 0, 3, 'Aveiro', 'Rua das pombas', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_commerce`
--

CREATE TABLE `user_commerce` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nif` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_commerce`
--

INSERT INTO `user_commerce` (`id`, `name`, `type`, `username`, `password`, `tel`, `email`, `nif`) VALUES
(1, 'No menu', '1', 'nomenu', '123', '919191919', 'geral@nomenu.pt', '234659874');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_order`
--

CREATE TABLE `user_order` (
  `id` int(7) NOT NULL,
  `delivery_cost` varchar(7) NOT NULL,
  `refUser` int(7) NOT NULL,
  `refOrder` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_phone`
--

CREATE TABLE `user_phone` (
  `id` int(7) NOT NULL,
  `default_phone` tinyint(1) NOT NULL,
  `number` varchar(50) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_phone`
--

INSERT INTO `user_phone` (`id`, `default_phone`, `number`, `refUser`) VALUES
(1, 1, '9191919191', 19),
(2, 1, '123', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_prod`
--

CREATE TABLE `user_prod` (
  `id` int(7) NOT NULL,
  `price` varchar(7) NOT NULL,
  `public` int(1) NOT NULL,
  `refProd` int(7) NOT NULL,
  `refUser` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_prod`
--

INSERT INTO `user_prod` (`id`, `price`, `public`, `refProd`, `refUser`) VALUES
(1, '10.5', 1, 1, 1),
(2, '4.5', 1, 2, 1),
(3, '5.5', 1, 3, 1),
(4, '13', 1, 4, 1),
(5, '10', 1, 5, 1),
(6, '16.5', 1, 6, 1),
(7, '10.5', 1, 7, 1),
(8, '12', 1, 8, 1),
(9, '10.5', 1, 9, 1),
(10, '11', 1, 10, 1),
(11, '10.5', 1, 11, 1),
(12, '10.5', 1, 12, 1),
(13, '5', 1, 13, 1),
(14, '10.5', 1, 14, 1),
(15, '2.5', 1, 15, 1),
(16, '10.5', 1, 16, 1),
(17, '2', 1, 17, 1),
(63, '2.60', 1, 63, 1),
(64, '8.50', 1, 64, 1),
(65, '8.50', 1, 65, 1),
(66, '11.50', 1, 66, 1),
(67, '21.00', 1, 67, 1),
(68, '14.00', 1, 68, 1),
(69, '21.50', 1, 69, 1),
(70, '62.50', 1, 70, 1),
(71, '37.50', 1, 71, 1),
(72, '20.50', 1, 72, 1),
(73, '37.50', 1, 73, 1),
(74, '37.50', 1, 74, 1),
(75, '16.50', 1, 75, 1),
(76, '28.00', 1, 76, 1),
(77, '16.50', 1, 77, 1),
(78, '28.00', 1, 78, 1),
(79, '17.00', 1, 79, 1),
(80, '32.00', 1, 80, 1),
(81, '46.00', 1, 81, 1),
(82, '16.00', 1, 82, 1),
(83, '30.00', 1, 83, 1),
(84, '13.00', 1, 84, 1),
(85, '17.00', 1, 85, 1),
(86, '8.00', 1, 86, 1),
(87, '18.50', 1, 87, 1),
(88, '10.00', 1, 88, 1),
(89, '14.50', 1, 89, 1),
(90, '10.00', 1, 90, 1),
(91, '14.50', 1, 91, 1),
(92, '10.00', 1, 92, 1),
(93, '14.50', 1, 93, 1),
(94, '13.00', 1, 94, 1),
(95, '18.50', 1, 95, 1),
(96, '13.00', 1, 96, 1),
(97, '20.50', 1, 97, 1),
(98, '26.00', 1, 98, 1),
(99, '34.50', 1, 99, 1),
(100, '20.50', 1, 100, 1),
(101, '15.00', 1, 101, 1),
(102, '23.50', 1, 102, 1),
(103, '12.00', 1, 103, 1),
(104, '20.50', 1, 104, 1),
(105, '58.50', 1, 105, 1),
(106, '16.50', 1, 106, 1),
(107, '28.00', 1, 107, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `zona`
--

CREATE TABLE `zona` (
  `id` int(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  `refCity` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `zona`
--

INSERT INTO `zona` (`id`, `name`, `refCity`) VALUES
(1, 'Aveiro', 1),
(2, 'Gafanha de nazare', 1),
(3, 'Ilhavo', 1),
(4, 'Gafanha de encarnaçao', 1),
(5, 'Vagos', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refRest` (`refRest`);

--
-- Indexes for table `cat_name`
--
ALTER TABLE `cat_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refCat` (`refCat`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refRest` (`refRest`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_price`
--
ALTER TABLE `delivery_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refZona` (`refZona`),
  ADD KEY `delivery_price_ibfk_2` (`refRest`);

--
-- Indexes for table `extra_product`
--
ALTER TABLE `extra_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`);

--
-- Indexes for table `extra_product_name`
--
ALTER TABLE `extra_product_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refExtraProd` (`refExtraProd`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refRest` (`refRest`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `order_prod`
--
ALTER TABLE `order_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`),
  ADD KEY `refOrder` (`refOrder`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refCat` (`refCat`);

--
-- Indexes for table `prod_image`
--
ALTER TABLE `prod_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`);

--
-- Indexes for table `prod_name`
--
ALTER TABLE `prod_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`);

--
-- Indexes for table `prod_type`
--
ALTER TABLE `prod_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refCity` (`refCity`);

--
-- Indexes for table `rest_cuisine_type`
--
ALTER TABLE `rest_cuisine_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refRest` (`refRest`),
  ADD KEY `refCuisine` (`refCuisine`);

--
-- Indexes for table `rest_user`
--
ALTER TABLE `rest_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refRest` (`refRest`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `user_commerce`
--
ALTER TABLE `user_commerce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refUser` (`refUser`),
  ADD KEY `refOrder` (`refOrder`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `user_prod`
--
ALTER TABLE `user_prod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refProd` (`refProd`),
  ADD KEY `refUser` (`refUser`);

--
-- Indexes for table `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refCity` (`refCity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `cat_name`
--
ALTER TABLE `cat_name`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `delivery_price`
--
ALTER TABLE `delivery_price`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `extra_product`
--
ALTER TABLE `extra_product`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `extra_product_name`
--
ALTER TABLE `extra_product_name`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `order_prod`
--
ALTER TABLE `order_prod`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `prod_image`
--
ALTER TABLE `prod_image`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
--
-- AUTO_INCREMENT for table `prod_name`
--
ALTER TABLE `prod_name`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
--
-- AUTO_INCREMENT for table `prod_type`
--
ALTER TABLE `prod_type`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rest_cuisine_type`
--
ALTER TABLE `rest_cuisine_type`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `rest_user`
--
ALTER TABLE `rest_user`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_commerce`
--
ALTER TABLE `user_commerce`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_phone`
--
ALTER TABLE `user_phone`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_prod`
--
ALTER TABLE `user_prod`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
--
-- AUTO_INCREMENT for table `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `cat_name`
--
ALTER TABLE `cat_name`
  ADD CONSTRAINT `cat_name_ibfk_1` FOREIGN KEY (`refCat`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`refUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `delivery_price`
--
ALTER TABLE `delivery_price`
  ADD CONSTRAINT `delivery_price_ibfk_1` FOREIGN KEY (`refZona`) REFERENCES `zona` (`id`),
  ADD CONSTRAINT `delivery_price_ibfk_2` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `extra_product`
--
ALTER TABLE `extra_product`
  ADD CONSTRAINT `extra_product_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`);

--
-- Limitadores para a tabela `extra_product_name`
--
ALTER TABLE `extra_product_name`
  ADD CONSTRAINT `extra_product_name_ibfk_1` FOREIGN KEY (`refExtraProd`) REFERENCES `extra_product` (`id`);

--
-- Limitadores para a tabela `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`refUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`refUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `order_prod`
--
ALTER TABLE `order_prod`
  ADD CONSTRAINT `order_prod_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_prod_ibfk_2` FOREIGN KEY (`refOrder`) REFERENCES `order` (`id`);

--
-- Limitadores para a tabela `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`refCat`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `prod_image`
--
ALTER TABLE `prod_image`
  ADD CONSTRAINT `prod_image_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `prod_name`
--
ALTER TABLE `prod_name`
  ADD CONSTRAINT `prod_name_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `prod_type`
--
ALTER TABLE `prod_type`
  ADD CONSTRAINT `prod_type_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`refCity`) REFERENCES `city` (`id`);

--
-- Limitadores para a tabela `rest_cuisine_type`
--
ALTER TABLE `rest_cuisine_type`
  ADD CONSTRAINT `rest_cuisine_type_ibfk_1` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rest_cuisine_type_ibfk_2` FOREIGN KEY (`refCuisine`) REFERENCES `cuisine_type` (`id`);

--
-- Limitadores para a tabela `rest_user`
--
ALTER TABLE `rest_user`
  ADD CONSTRAINT `rest_user_ibfk_1` FOREIGN KEY (`refRest`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `rest_user_ibfk_2` FOREIGN KEY (`refUser`) REFERENCES `user_commerce` (`id`);

--
-- Limitadores para a tabela `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`refUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`refUser`) REFERENCES `user_commerce` (`id`),
  ADD CONSTRAINT `user_order_ibfk_2` FOREIGN KEY (`refOrder`) REFERENCES `order` (`id`);

--
-- Limitadores para a tabela `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `user_phone_ibfk_1` FOREIGN KEY (`refUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `user_prod`
--
ALTER TABLE `user_prod`
  ADD CONSTRAINT `user_prod_ibfk_1` FOREIGN KEY (`refProd`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_prod_ibfk_2` FOREIGN KEY (`refUser`) REFERENCES `user_commerce` (`id`);

--
-- Limitadores para a tabela `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `zona_ibfk_1` FOREIGN KEY (`refCity`) REFERENCES `city` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
