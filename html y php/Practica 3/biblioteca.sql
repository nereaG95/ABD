-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2017 a las 18:48:19
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idLibro` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `edicion` int(11) NOT NULL,
  `tema` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `publico` enum('todos','adulto','infantil') COLLATE utf8_spanish_ci NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idLibro`, `titulo`, `autor`, `edicion`, `tema`, `publico`, `unidades`) VALUES
(1, 'Harry Potter', 'Jk rowling', 10, 'Ciencia y ficcion', 'todos', 4),
(2, 'pepa pig', 'nerea ', 13, 'dibujos animados', 'infantil', 10),
(3, 'Harry Potter 2', 'Jk rowling', 10, 'ciencia ficcion', 'todos', 20),
(4, 'Harry Potter 3', 'Jk rowling', 10, 'ciencia ficcion', 'todos', 20),
(5, 'Harry Potter 4', 'Jk Rowling', 7, 'ciencia ficcion', 'todos', 15),
(6, 'El libro de la selva', 'anonimo', 15, 'dibujos animados', 'todos', 15),
(7, 'Harry Potter 5', 'jk rowling', 15, 'ciencia', 'todos', 15),
(8, 'harry potter 6', 'jk rowling', 15, 'ciencia y ficcion', 'todos', 20),
(9, 'El señor de los anillos 2', 'anonimo', 3, 'ciencia y ficcion', 'todos', 15),
(10, 'el señor de los anillo 3', 'anonimo', 15, 'cienciA', 'todos', 5),
(11, '3 metros sobre el cielo', 'federico moccia', 4, 'amor', 'todos', 56),
(12, 'tengo ganas de ti', 'federico moccia', 5, 'amor', 'todos', 5),
(13, 'nerea y los 7', 'nerea', 3, 'ciencia', '', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUser` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('adulto','infantil') COLLATE utf8_spanish_ci NOT NULL,
  `sanciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUser`, `pass`, `tipo`, `sanciones`) VALUES
('javierluis', '11111111111', 'adulto', 0),
('jejejeje', '123456', 'adulto', 0),
('jueee', '111111', 'adulto', 0),
('julian', '12222', 'adulto', 0),
('julieta', '11111111', 'adulto', 0),
('julo', '11111', 'adulto', 0),
('lucia', '123456', 'adulto', 0),
('nerea', '12345678', 'adulto', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioslibros`
--

CREATE TABLE `usuarioslibros` (
  `idLibro` int(11) NOT NULL,
  `idUser` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fechaDevolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarioslibros`
--

INSERT INTO `usuarioslibros` (`idLibro`, `idUser`, `fechaEntrega`, `fechaDevolucion`) VALUES
(1, 'javierluis', '2017-06-01 12:06:43', '0000-00-00'),
(1, 'jejejeje', '2017-06-01 12:18:55', '2017-06-15'),
(1, 'julieta', '2017-06-01 12:24:00', '2017-06-22'),
(1, 'julo', '2017-06-01 12:35:22', '2017-06-22'),
(1, 'lucia', '2017-06-01 16:20:27', '2017-06-22'),
(1, 'nerea', '2017-06-01 10:09:37', '2017-06-15'),
(2, 'julo', '2017-06-01 12:45:49', '2017-06-20'),
(2, 'nerea', '2017-06-01 14:42:56', '2017-06-21'),
(3, 'nerea', '2017-06-01 14:43:04', '2017-06-21'),
(4, 'nerea', '2017-06-01 14:43:22', '2017-06-21'),
(5, 'nerea', '2017-06-01 14:43:22', '2017-06-29'),
(6, 'nerea', '2017-06-01 14:43:35', '2017-06-21'),
(7, 'nerea', '2017-06-01 14:43:35', '2017-06-29'),
(8, 'nerea', '2017-06-01 14:43:51', '2017-06-28'),
(9, 'nerea', '2017-06-01 14:43:51', '2017-06-24'),
(10, 'nerea', '2017-06-01 14:43:59', '2017-06-28'),
(11, 'nerea', '2017-06-01 14:43:59', '2017-06-24'),
(12, 'nerea', '2017-06-01 14:44:10', '2017-06-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idLibro`),
  ADD UNIQUE KEY `titulo` (`titulo`,`autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`);

--
-- Indices de la tabla `usuarioslibros`
--
ALTER TABLE `usuarioslibros`
  ADD PRIMARY KEY (`idLibro`,`idUser`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarioslibros`
--
ALTER TABLE `usuarioslibros`
  ADD CONSTRAINT `usuarioslibros_ibfk_1` FOREIGN KEY (`idLibro`) REFERENCES `libros` (`idLibro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioslibros_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
