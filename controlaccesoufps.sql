-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2019 a las 03:06:08
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlaccesoufps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizacion`
--

CREATE TABLE `autorizacion` (
  `id` int(11) NOT NULL,
  `persona` varchar(20) NOT NULL,
  `autorizadoPor` varchar(20) NOT NULL,
  `entrada` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `horaIni` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autorizacion`
--

INSERT INTO `autorizacion` (`id`, `persona`, `autorizadoPor`, `entrada`, `date`, `horaIni`, `horaFin`) VALUES
(2, '00ff00ff', '212f16d3', 'SA401', '2019-05-20', '00:00:00', '00:00:00'),
(3, '212f16d3', '3d15d01e', 'TE000', '0000-00-00', '08:00:00', '10:00:00'),
(6, '3d15d01e', '3d15d01e', 'SA404', '0000-00-00', '08:00:00', '10:00:00'),
(7, '3d15d01e', '3d15d01e', 'SA401', '2019-05-22', '08:00:00', '10:00:00'),
(8, '3d15d01e', '3d15d01e', 'TE000', '2019-05-24', '08:00:00', '10:00:00'),
(9, '00ff00ff', '3d15d01e', 'TE000', '2019-05-22', '08:00:00', '10:00:00'),
(10, '00ff00ff', '3d15d01e', 'SA404', '2019-05-12', '08:00:00', '10:00:00'),
(11, '3d15d01e', '3d15d01e', 'TE000', '2019-05-23', '08:00:00', '10:00:00'),
(12, '3d15d01e', '3d15d01e', 'SA404', '2019-05-31', '14:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` varchar(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `descripcion`) VALUES
('SA401', 'Salón'),
('SA404', 'Salón'),
('TE000', 'Salón de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identificador`
--

CREATE TABLE `identificador` (
  `rfid` varchar(20) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `identificador`
--

INSERT INTO `identificador` (`rfid`, `isAdmin`, `codigo`, `password`) VALUES
('00ff00ff', 1, '1150003', '0000'),
('212f16d3', 0, '1150002', NULL),
('3d15d01e', 0, '1151345', NULL),
('6254f31f', 0, '1150001', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intento`
--

CREATE TABLE `intento` (
  `id` int(20) NOT NULL,
  `persona` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entrada` varchar(10) NOT NULL,
  `isAutorizado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `intento`
--

INSERT INTO `intento` (`id`, `persona`, `time`, `entrada`, `isAutorizado`) VALUES
(138, '212f16d3', '2019-03-31 17:50:43', 'TE000', 0),
(139, '212f16d3', '2019-03-31 17:50:46', 'TE000', 0),
(140, '212f16d3', '2019-03-31 17:50:49', 'TE000', 0),
(141, '6254f31f', '2019-03-31 17:50:53', 'TE000', 0),
(142, '6254f31f', '2019-03-31 17:50:55', 'TE000', 0),
(143, '6254f31f', '2019-03-31 17:50:58', 'TE000', 0),
(144, '212f16d3', '2019-03-31 17:51:01', 'TE000', 0),
(145, '6254f31f', '2019-03-31 17:51:08', 'TE000', 0),
(146, '212f16d3', '2019-03-31 17:51:11', 'TE000', 0),
(147, '6254f31f', '2019-03-31 17:51:14', 'TE000', 0),
(148, '212f16d3', '2019-03-31 17:51:18', 'TE000', 0),
(149, '212f16d3', '2019-03-31 17:51:20', 'TE000', 0),
(150, '6254f31f', '2019-03-31 17:51:23', 'TE000', 0),
(151, '6254f31f', '2019-03-31 17:51:25', 'TE000', 0),
(153, '212f16d3', '2019-03-31 18:13:34', 'TE000', 0),
(154, '212f16d3', '2019-03-31 18:13:39', 'TE000', 0),
(155, '6254f31f', '2019-03-31 18:14:44', 'TE000', 1),
(156, '6254f31f', '2019-03-31 18:14:50', 'TE000', 1),
(157, '6254f31f', '2019-03-31 18:15:01', 'TE000', 1),
(158, '6254f31f', '2019-03-31 18:15:07', 'TE000', 1),
(159, '6254f31f', '2019-03-31 18:15:37', 'TE000', 0),
(160, '6254f31f', '2019-03-31 18:15:42', 'TE000', 0),
(161, '6254f31f', '2019-03-31 18:15:55', 'TE000', 1),
(162, '6254f31f', '2019-03-31 18:16:00', 'TE000', 1),
(163, '6254f31f', '2019-03-31 18:16:05', 'TE000', 1),
(164, '212f16d3', '2019-03-31 18:16:08', 'TE000', 1),
(165, '212f16d3', '2019-03-31 18:16:16', 'TE000', 1),
(166, '6254f31f', '2019-03-31 18:18:56', 'TE000', 1),
(167, '6254f31f', '2019-03-31 18:19:01', 'TE000', 1),
(168, '6254f31f', '2019-03-31 18:21:34', 'TE000', 1),
(169, '6254f31f', '2019-03-31 18:21:41', 'TE000', 1),
(170, '212f16d3', '2019-03-31 18:21:46', 'TE000', 1),
(171, '212f16d3', '2019-03-31 18:22:05', 'TE000', 0),
(172, '212f16d3', '2019-03-31 18:22:09', 'TE000', 0),
(173, '6254f31f', '2019-03-31 18:22:23', 'TE000', 1),
(174, '212f16d3', '2019-03-31 18:22:27', 'TE000', 1),
(175, '212f16d3', '2019-03-31 18:22:32', 'TE000', 1),
(176, '6254f31f', '2019-03-31 18:22:37', 'TE000', 1),
(177, '6254f31f', '2019-03-31 18:22:41', 'TE000', 1),
(178, '212f16d3', '2019-03-31 18:22:48', 'TE000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `img` varchar(45) DEFAULT 'noImg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`codigo`, `nombre`, `img`) VALUES
('1150001', 'Tarjeta blanca', 'tarjeta'),
('1150002', 'Llavero', 'llavero'),
('1150003', 'Admin', 'admin'),
('1151345', 'El benévolo señor Arciniegas', 'Aprobado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrada` (`entrada`),
  ADD KEY `persona` (`persona`),
  ADD KEY `autorizadoPor` (`autorizadoPor`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `identificador`
--
ALTER TABLE `identificador`
  ADD PRIMARY KEY (`rfid`),
  ADD KEY `codigo` (`codigo`);

--
-- Indices de la tabla `intento`
--
ALTER TABLE `intento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona` (`persona`),
  ADD KEY `entrada` (`entrada`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `intento`
--
ALTER TABLE `intento`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autorizacion`
--
ALTER TABLE `autorizacion`
  ADD CONSTRAINT `autorizacion_ibfk_1` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`id`),
  ADD CONSTRAINT `autorizacion_ibfk_2` FOREIGN KEY (`persona`) REFERENCES `identificador` (`rfid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `autorizacion_ibfk_3` FOREIGN KEY (`autorizadoPor`) REFERENCES `identificador` (`rfid`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `identificador`
--
ALTER TABLE `identificador`
  ADD CONSTRAINT `identificador_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `persona` (`codigo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `intento`
--
ALTER TABLE `intento`
  ADD CONSTRAINT `intento_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `identificador` (`rfid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `intento_ibfk_2` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
