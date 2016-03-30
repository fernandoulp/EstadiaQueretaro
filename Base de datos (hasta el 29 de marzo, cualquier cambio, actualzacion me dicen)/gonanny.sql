-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2016 at 06:16 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gonanny`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `id_user` bigint(255) NOT NULL AUTO_INCREMENT,
  `name_adm` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `ape1_adm` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `ape2_adm` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email_adm` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cel_adm` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `status_us` int(1) NOT NULL DEFAULT '0',
  `type_us` enum('admin','basic','niñera','familia','') COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id_user`, `name_adm`, `ape1_adm`, `ape2_adm`, `email_adm`, `cel_adm`, `username`, `password`, `status_us`, `type_us`) VALUES
(1, 'Said', 'Vara', 'Chacon', 'saidvara@gmail.com', '', 'saidwn', '123', 1, 'admin'),
(2, 'Luis Fernando', 'Alvarez', 'Munoz', 'fernandoulp@gmail.com', '', 'fernandoulp', '123', 1, 'familia'),
(3, 'Diego', 'Carrillo', 'Silva', 'dacarrillo@gmail.com', '', 'diegon', '123', 1, 'admin'),
(15, 'Alonzo', 'Zamarripa', 'Bringas', 'zamaking@gmail.com', '', 'zamaking', '123', 1, ''),
(17, 'Esteban', 'Reyes ', 'Huerta', 'tebanin@gmail.com', '', 'tebanin', '123', 1, ''),
(19, 'Luis', 'Flores', 'Soto', 'luis@gmail.com', '', 'luis123', 'eee', 1, ''),
(20, 'Gustavo ', 'Sigala', 'Murga', 'gustavo@gmail.com', '', 'gustavo_s', '123', 1, 'basic'),
(21, 'Juan ', 'Chacon', 'Gonzalez', 'juan@gmail.com', '', 'juan_enllo', '123', 0, ''),
(22, 'Oscar', 'Vara', 'Chacon', 'karin.vara@hotmail.com', '', 'karin4', '123', 0, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id_coment` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_coment` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_coment` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `coment` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id_coment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `contacto`
--

INSERT INTO `contacto` (`id_coment`, `nombre_coment`, `email_coment`, `coment`) VALUES
(6, 'Diego', 'diegocarrilllo482@gmail.com', 'test4'),
(7, 'Said', 'diegocarrilllo482@gmail.com', 'Hola como has estado'),
(8, 'hola', 'diegocarrilllo482@gmail.com', 'dadssadd');

-- --------------------------------------------------------

--
-- Table structure for table `us_ninera`
--

CREATE TABLE IF NOT EXISTS `us_ninera` (
  `id_numn` bigint(255) NOT NULL AUTO_INCREMENT,
  `name_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `last_namen` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cumple_n` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `tel_n` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `address_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `password_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `type_n` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id_numn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `us_ninera`
--

INSERT INTO `us_ninera` (`id_numn`, `name_n`, `last_namen`, `cumple_n`, `tel_n`, `address_n`, `email_n`, `password_n`, `status_n`, `type_n`) VALUES
(1, 'Grecia', 'Salazar Ramos', '30/05/1994', '6188035385', 'Gregorio Torres 112 Granjas Graciela', 'grecia_fer94@hotmail.com', 'utd123', '1', 'premium'),
(2, 'Alejandra', 'Padilla', '23/09/1995', '6188776687', 'Jose Gomez #123 Fracc. La cruz', 'alejandra.padilla@gmail.com', 'aaa1', '1', 'premium'),
(3, 'Pamela', 'Contreras', '13/11/1998', '6188776554', 'Juan Gomez #123 Col. Asentamientos Humanos', 'pam.contreras@gmail.com', '123', '1', 'premium'),
(4, 'Julieta', 'Fernandez', '21/01/1992', '6181981223', 'Paseo de los flamingos #344 Fracc. Silvestre Revueltas', 'juli_f@gmail.com', '123', '1', 'premium');

-- --------------------------------------------------------

--
-- Table structure for table `us_padres`
--

CREATE TABLE IF NOT EXISTS `us_padres` (
  `id_nump` bigint(20) NOT NULL AUTO_INCREMENT,
  `name_p` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `last_namep` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `address_p` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `tel_p` bigint(20) DEFAULT NULL,
  `email_p` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password_p` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `type_p` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `status_p` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id_nump`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `us_padres`
--

INSERT INTO `us_padres` (`id_nump`, `name_p`, `last_namep`, `address_p`, `tel_p`, `email_p`, `password_p`, `type_p`, `status_p`) VALUES
(2, 'Fernando', 'Alvarez', 'Av. Paseo de la constitución #92 Col. Constituyentes', 6188766554, 'fernandoulp@gmail.com', '123', 'premium', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
