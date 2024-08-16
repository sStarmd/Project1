-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2024 a las 12:44:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_sena_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes`
--

CREATE TABLE `ambientes` (
  `Id_ambiente` int(11) NOT NULL,
  `nombre_ambiente` varchar(100) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambientes`
--

INSERT INTO `ambientes` (`Id_ambiente`, `nombre_ambiente`, `disponible`) VALUES
(1, '101', 0),
(2, '102', 0),
(3, '103', 0),
(4, '104', 1),
(5, '105', 0),
(6, '106', 0),
(7, '107', 0),
(8, '108', 0),
(9, 'Poli 1', 1),
(10, 'Poli 2', 0),
(11, 'Poli 3', 0),
(12, 'Bosch', 0),
(13, 'Ajedrez', 1),
(14, 'Auditorio', 1),
(15, 'Biblioteca', 0),
(16, 'Automatizacion', 0),
(17, 'Salon de musica', 0),
(18, 'Sala de profesores', 0),
(19, 'Hotel practico', 0),
(20, 'Zona deportiva', 0),
(21, 'Trabajo en alturas', 1),
(22, 'Ambiente temporal', 0),
(23, 'Alcoholes Artesanales', 1),
(24, 'Salon quimica', 0),
(25, 'Bodega de deportes', 0),
(26, 'Aula movil', 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre_perfil` enum('director','instructor','guardas','otros') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `nombre_perfil`) VALUES
(1, 'director'),
(2, 'instructor'),
(3, 'guardas'),
(4, 'otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_entrada`
--

CREATE TABLE `registro_entrada` (
  `id_registro` int(11) NOT NULL,
  `fecha_hora_entrada` datetime DEFAULT current_timestamp(),
  `nombre_completo_sale` varchar(200) DEFAULT NULL,
  `nombre_completo_entra` varchar(200) DEFAULT NULL,
  `novedades` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_ambiente` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_entrada`
--

INSERT INTO `registro_entrada` (`id_registro`, `fecha_hora_entrada`, `nombre_completo_sale`, `nombre_completo_entra`, `novedades`, `id_usuario`, `id_ambiente`, `id_perfil`) VALUES
(1, '2024-07-04 19:16:00', 'Ana Gómez', '', 'Hubo novedad de 2 computadores dañados', 1, 1, NULL),
(2, '2024-07-10 19:08:42', 'Pedro', 'Juanita', 'mause dañado en computador 15', 10, 2, NULL),
(4, '2024-07-10 22:54:33', 'Pablo remirez', 'YEDIXON', 'lo que sea ', 11, 2, NULL),
(5, '2024-07-24 04:50:54', 'Angelica', NULL, 'Sin novedad alguna', 10, 4, NULL),
(6, '2024-07-24 04:57:54', 'pablo', 'juanita', 'mause dañado en computador 32', 10, 4, NULL),
(7, '2024-07-24 05:39:18', 'añañin', 'juanita', 'xdxdxd', 10, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado_cuenta` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `id_perfil` int(11) DEFAULT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `nombre_completo`, `contraseña`, `correo`, `fecha_registro`, `estado_cuenta`, `id_perfil`, `es_admin`) VALUES
(1, 'Juan Pérez', '123456', 'juan@example.com', '2024-07-04 19:16:44', 'activo', NULL, 0),
(2, 'María García', 'password', 'maria@example.com', '2024-07-04 19:16:44', 'activo', NULL, 0),
(3, 'Pedro López', 'pass123', 'pedro@example.com', '2024-07-04 19:16:44', 'activo', NULL, 0),
(9, 'Juan', '$2y$10$RoPPCp8LwcibFj3p2VGD8.6RvD1ugY1XK5ATd5bdVJ3T6BDoRdxWi', 'juan@gmail.com', '2024-07-05 17:36:46', 'activo', 2, 0),
(10, 'juanita', '$2y$10$FrUSb25NNlZRAbyfFNy7u.8TYW/Y0tt/L/dpY1GabSsBTn7CcrmK2', 'juanita@gmail.com', '2024-07-10 18:48:34', 'activo', 3, 0),
(11, 'Yedixon', '$2y$10$KdWJ/zLRIZqJhjflGHz8SeZvJLaQFPPPCeQoMq7IjJcBVD1.lY/ga', 'yedixon@gmail.com', '2024-07-10 22:49:02', 'activo', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`Id_ambiente`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `registro_entrada`
--
ALTER TABLE `registro_entrada`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_ambiente` (`id_ambiente`),
  ADD KEY `fk_id_perfil` (`id_perfil`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  MODIFY `Id_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_entrada`
--
ALTER TABLE `registro_entrada`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registro_entrada`
--
ALTER TABLE `registro_entrada`
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`),
  ADD CONSTRAINT `registro_entrada_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`Id_usuario`),
  ADD CONSTRAINT `registro_entrada_ibfk_2` FOREIGN KEY (`id_ambiente`) REFERENCES `ambientes` (`Id_ambiente`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE usuarios ADD COLUMN token VARCHAR(255) NULL;


ALTER TABLE usuarios ADD COLUMN token_expira DATETIME NULL;
