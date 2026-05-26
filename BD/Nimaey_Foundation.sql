-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2026 a las 13:43:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Nimaey_Foundation`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE `Admin` (
  `id_usuario_admin` varchar(10) NOT NULL,
  `nombre_admin` varchar(30) NOT NULL,
  `correo_admin` varchar(30) NOT NULL,
  `contraseña_admin` varchar(30) NOT NULL,
  `fecha_registro_admin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Beneficiario`
--

CREATE TABLE `Beneficiario` (
  `id_usuario_beneficiario` varchar(10) NOT NULL,
  `nombre_beneficiario` varchar(30) NOT NULL,
  `correo_beneficiario` varchar(30) NOT NULL,
  `contraseña_beneficiario` varchar(30) NOT NULL,
  `fecha_registro_beneficiario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Donación`
--

CREATE TABLE `Donación` (
  `id_donacion` varchar(10) NOT NULL,
  `descripcion_donacion` varchar(50) NOT NULL,
  `tipo_donacion` varchar(30) NOT NULL,
  `fecha_donacion` date NOT NULL,
  `anonima` varchar(10) NOT NULL,
  `id_usuario_beneficiario` varchar(10) NOT NULL,
  `id_usuario_donante` varchar(10) NOT NULL,
  `id_usuario_admin` varchar(10) NOT NULL,
  `id_encuentro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Donante`
--

CREATE TABLE `Donante` (
  `id_usuario_donante` varchar(10) NOT NULL,
  `nombre_donante` varchar(30) NOT NULL,
  `correo_donante` varchar(30) NOT NULL,
  `contraseña_donante` varchar(30) NOT NULL,
  `fecha_registro_donante` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Encuentro_solidario`
--

CREATE TABLE `Encuentro_solidario` (
  `id_encuentro` varchar(10) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` varchar(10) NOT NULL,
  `observacion_entrega` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id_usuario_admin`);

--
-- Indices de la tabla `Beneficiario`
--
ALTER TABLE `Beneficiario`
  ADD PRIMARY KEY (`id_usuario_beneficiario`);

--
-- Indices de la tabla `Donación`
--
ALTER TABLE `Donación`
  ADD PRIMARY KEY (`id_donacion`),
  ADD KEY `id_usuario_beneficiario` (`id_usuario_beneficiario`),
  ADD KEY `id_usuario_donante` (`id_usuario_donante`),
  ADD KEY `id_usuario_admin` (`id_usuario_admin`),
  ADD KEY `id_encuentro` (`id_encuentro`);

--
-- Indices de la tabla `Donante`
--
ALTER TABLE `Donante`
  ADD PRIMARY KEY (`id_usuario_donante`);

--
-- Indices de la tabla `Encuentro_solidario`
--
ALTER TABLE `Encuentro_solidario`
  ADD PRIMARY KEY (`id_encuentro`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Donación`
--
ALTER TABLE `Donación`
  ADD CONSTRAINT `Donación_ibfk_1` FOREIGN KEY (`id_usuario_beneficiario`) REFERENCES `Beneficiario` (`id_usuario_beneficiario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Donación_ibfk_2` FOREIGN KEY (`id_usuario_donante`) REFERENCES `Donante` (`id_usuario_donante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Donación_ibfk_3` FOREIGN KEY (`id_usuario_admin`) REFERENCES `Admin` (`id_usuario_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Donación_ibfk_4` FOREIGN KEY (`id_encuentro`) REFERENCES `Encuentro_solidario` (`id_encuentro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
