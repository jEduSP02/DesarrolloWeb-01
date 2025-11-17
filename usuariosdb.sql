-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2025 a las 03:50:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuariosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `contUsuario` varchar(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`contUsuario`, `nombre`, `correo`, `contraseña`) VALUES
('00001', 'Eduardo Sánchez', 'jesanchez44@utpl.edu.ec', '$2y$10$bIFx3wnXiaTvzoyPatRjgeoj/2lbRcwQlUbHiMj6odyIUjHA/.WiO'),
('00002', 'Daniela Caicedo', 'dcaicedo@utpl.edu.ec', '$2y$10$wPcpGXNIrvMkk2UvhPFdtOZPUlB.IFnMI4JTKyhAVWgx4j.vYMWZK'),
('00003', 'Gabriela Salguero', 'gsalguero@espe.edu.ec', '$2y$10$QOIVi0pQ8D5dDLIqUz84GOB1VKhR7zSnmFgP.kHNDIbHR1IKzTK3u'),
('4', 'Daniel Noboa', 'dnoboa@utpl.edu.ec', '$2y$10$ioodkIRohzX.8Rz/4TcaC..LD5d63jot5qVfa3iBhaFfwe2juStnG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`contUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
