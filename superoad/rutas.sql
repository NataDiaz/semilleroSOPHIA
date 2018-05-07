-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2018 a las 15:48:09
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rutas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `califgasolinera`
--

CREATE TABLE `califgasolinera` (
  `idCalifGasolinera` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `PecioGalon` double NOT NULL,
  `idServicio` int(11) NOT NULL,
  `puntuacionPromedio` decimal(10,0) NOT NULL,
  `puntuacionUsuario` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicebienestar`
--

CREATE TABLE `indicebienestar` (
  `idIB` int(11) NOT NULL,
  `PSe` decimal(10,0) NOT NULL,
  `Psa` decimal(10,0) NOT NULL,
  `PA` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `idTipo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `idTipo`) VALUES
(58, 'Titan Plaza', 'Av. BoyacÃ¡ #81a10,Bogota, Colombia', 4.69598, -74.0865, 1),
(59, 'Exito Calle 80', 'Calle 80,Bogota, Colombia', 4.68409, -74.0806, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutaib`
--

CREATE TABLE `rutaib` (
  `idRuta` int(11) NOT NULL,
  `idRutaUsuario` int(11) NOT NULL,
  `idIB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutausuario`
--

CREATE TABLE `rutausuario` (
  `id_ruta` int(11) NOT NULL,
  `idIB` int(11) NOT NULL,
  `origenLat` varchar(20) NOT NULL,
  `origenLng` varchar(20) NOT NULL,
  `destinoLat` varchar(20) NOT NULL,
  `destinoLng` varchar(20) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `dirOrigen` varchar(20) NOT NULL,
  `dirDestino` varchar(20) NOT NULL,
  `distancia` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutausuario`
--

INSERT INTO `rutausuario` (`id_ruta`, `idIB`, `origenLat`, `origenLng`, `destinoLat`, `destinoLng`, `idTipo`, `nombre`, `dirOrigen`, `dirDestino`, `distancia`) VALUES
(0, 1, '4.710988599999999', '-74.072092', '4.7009012', '-74.1145229', 1, '0', 'Troncal Suba, Bogotá', 'diverplaza,Bogota, C', '6.129'),
(0, 1, '4.710988599999999', '-74.072092', '4.7009012', '-74.1145229', 1, '0', 'Troncal Suba, Bogotá', 'diverplaza,Bogota, C', '6.129'),
(0, 1, '4.710988599999999', '-74.072092', '4.7009012', '-74.1145229', 1, '0', 'Troncal Suba, Bogotá', 'diverplaza,Bogota, C', '6.129'),
(0, 1, '4.710988599999999', '-74.072092', '4.7009012', '-74.1145229', 1, '0', 'Troncal Suba, Bogotá', 'diverplaza,Bogota, C', '6.129'),
(0, 1, '4.710988599999999', '-74.072092', '4.7009012', '-74.1145229', 1, '0', 'Troncal Suba, Bogotá', 'diverplaza,Bogota, C', '6.129'),
(0, 1, '0', '0', '0', '0', 1, '0', '', ',Bogota, Colombia', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `descServicio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `descServicio`) VALUES
(1, 'Bueno'),
(2, 'Regular'),
(3, 'Regular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomarker`
--

CREATE TABLE `tipomarker` (
  `idTipo` int(11) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipomarker`
--

INSERT INTO `tipomarker` (`idTipo`, `tipo`) VALUES
(1, 'ruta'),
(2, 'gasolinera');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `califgasolinera`
--
ALTER TABLE `califgasolinera`
  ADD PRIMARY KEY (`idCalifGasolinera`),
  ADD KEY `FK_servicioGas` (`idServicio`),
  ADD KEY `FK_gasolinera` (`idTipo`);

--
-- Indices de la tabla `indicebienestar`
--
ALTER TABLE `indicebienestar`
  ADD PRIMARY KEY (`idIB`);

--
-- Indices de la tabla `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutaib`
--
ALTER TABLE `rutaib`
  ADD PRIMARY KEY (`idRuta`),
  ADD KEY `FK_rutaIB` (`idIB`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `tipomarker`
--
ALTER TABLE `tipomarker`
  ADD PRIMARY KEY (`idTipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `califgasolinera`
--
ALTER TABLE `califgasolinera`
  MODIFY `idCalifGasolinera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `indicebienestar`
--
ALTER TABLE `indicebienestar`
  MODIFY `idIB` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `rutaib`
--
ALTER TABLE `rutaib`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipomarker`
--
ALTER TABLE `tipomarker`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `califgasolinera`
--
ALTER TABLE `califgasolinera`
  ADD CONSTRAINT `FK_gasolinera` FOREIGN KEY (`idTipo`) REFERENCES `tipomarker` (`idTipo`),
  ADD CONSTRAINT `FK_servicioGas` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `rutaib`
--
ALTER TABLE `rutaib`
  ADD CONSTRAINT `FK_rutaIB` FOREIGN KEY (`idIB`) REFERENCES `indicebienestar` (`idIB`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
