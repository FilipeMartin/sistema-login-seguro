-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Fev-2018 às 18:55
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carros`
--

DROP TABLE IF EXISTS `carros`;
CREATE TABLE IF NOT EXISTS `carros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `carro` varchar(100) NOT NULL,
  `placa` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carros`
--

INSERT INTO `carros` (`id`, `id_usuario`, `carro`, `placa`, `telefone`, `senha`) VALUES
(1, 1, 'Vectra', 'LTI8955', '9856525689', '123456'),
(2, 1, 'Honda', 'DFT4525', '985625632', '123456'),
(3, 1, 'Gol', 'DRT98562', '987562356', '565895'),
(4, 1, 'Pálio', 'KUI4587', '987562359', '456256'),
(5, 1, 'Monza', 'OPL4587', '965632568', '568965'),
(6, 1, 'Astra', 'LOI4587', '987565236', '4562368'),
(8, 2, 'Ferrari', 'LTI8955', '9856525689', '123456'),
(9, 2, 'Opala', 'HYT5423', '985623785', '568562'),
(10, 2, 'Astra', 'LOY9865', '987562356', '856289');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `ip`) VALUES
(1, 'login', '$2y$10$fyVNJgmnKeHJbQTXx4sc5Oh9fkFH0jw7nIvPrWpwo6xrGc4fNxEXu', '0b20620c89ae6ac44df88fbfb7c03a1a'),
(2, 'login2', '$2y$10$BKXp4yonDcnb7pIprAh8n.dCNzZuWCOVrzQF.NADo1nL4kXHtd/Ii', '0b20620c89ae6ac44df88fbfb7c03a1a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
