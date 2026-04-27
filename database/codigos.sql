-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2022 a las 23:24:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quiniela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`id`, `codigo`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'FDPQ928', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(2, 'VOWC184', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(3, 'MJMX503', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(4, 'EBYN608', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(5, 'IRYH090', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(6, 'KBAS200', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(7, 'IDTM952', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(8, 'ZDRQ115', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(9, 'FBVL300', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59'),
(10, 'FBOZ003', 0, '2022-09-22 03:10:59', '2022-09-22 03:10:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
