-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2018 a las 19:02:15
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_fernando`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section_treatment`
--

CREATE TABLE `section_treatment` (
  `idsectiontreatment` tinyint(4) NOT NULL,
  `image` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `subtitle` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `text` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `type` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1'
  `status` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `section_treatment`
--

INSERT INTO `section_treatment` (`idsectiontreatment`, `image`, `title`, `subtitle`, `text`, `url`, `status`) VALUES
(1, 'img.jpg', 'title 1', 'Fisioterapeuta Ocupacional', '', '', '0'),
(2, 'treatment20180907075247.png', 'title 2234345345345345', 'sdfsdfsfd435345345', 'fskfjhsdkfsdkljf', 'http://localhost:8085/fernando/admin/section/treatment345345', '1'),
(3, 'treatment20180907084810.png', 'title 3', '', 'dssssssssss', '', '1'),
(4, 'img.jpg', 'title 4', '', 'dddddddddddd', '', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `section_treatment`
--
ALTER TABLE `section_treatment`
  ADD PRIMARY KEY (`idsectiontreatment`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `section_treatment`
--
ALTER TABLE `section_treatment`
  MODIFY `idsectiontreatment` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
