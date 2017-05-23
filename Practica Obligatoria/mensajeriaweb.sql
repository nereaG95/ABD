-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2017 a las 12:52:09
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mensajeriaweb`
--
CREATE DATABASE IF NOT EXISTS `mensajeriaweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `mensajeriaweb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nombreGrupo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `tipoMusica` enum('Rock and roll','Pop','Rap','Ska','Reggae','Blues','Jazz','clasica','reggaeton','salsa','cumbia','Blues','R&B','Gospel','Soul','Country','Funk') COLLATE utf8_spanish_ci NOT NULL,
  `edadMin` int(11) NOT NULL,
  `edadMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuario`
--

CREATE TABLE `gruposusuario` (
  `idGrupo` int(11) NOT NULL,
  `idUser` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMensaje` int(11) NOT NULL,
  `mensaje` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('comun','personal','grupo','') COLLATE utf8_spanish_ci NOT NULL,
  `emisor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `receptor` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomusicausuarios`
--

CREATE TABLE `tipomusicausuarios` (
  `idUser` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `tipoMusica` enum('Rock and roll','Pop','Rap','Ska','Reggae','Blues','Jazz','clasica','reggaeton','salsa','cumbia','Blues','R&B','Gospel','Soul','Country','Funk') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUser` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`,`nombreGrupo`,`tipoMusica`,`edadMin`,`edadMax`),
  ADD UNIQUE KEY `nombreGrupo` (`nombreGrupo`);

--
-- Indices de la tabla `gruposusuario`
--
ALTER TABLE `gruposusuario`
  ADD PRIMARY KEY (`idGrupo`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMensaje`);

--
-- Indices de la tabla `tipomusicausuarios`
--
ALTER TABLE `tipomusicausuarios`
  ADD PRIMARY KEY (`idUser`,`tipoMusica`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gruposusuario`
--
ALTER TABLE `gruposusuario`
  ADD CONSTRAINT `gruposusuario_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gruposusuario_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipomusicausuarios`
--
ALTER TABLE `tipomusicausuarios`
  ADD CONSTRAINT `tipomusicausuarios_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
