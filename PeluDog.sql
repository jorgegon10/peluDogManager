-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2025 a las 23:34:10
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `PeluDog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_compra` int(11) NOT NULL,
  `nombre_compra` varchar(1000) NOT NULL,
  `formaPago` varchar(1000) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `peluqueria` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `nombre_compra` varchar(1000) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `peluqueria` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `nombre_compra`, `precio_compra`, `peluqueria`) VALUES
(1, 'Baño perro mediano', 25, 'Terrier Terrier'),
(2, 'Baño y arreglo perro mediano', 30, 'Terrier Terrier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto`
--

CREATE TABLE `objeto` (
  `id_objeto` int(11) NOT NULL,
  `nombre_objeto` varchar(1000) NOT NULL,
  `cantidad` int(200) NOT NULL,
  `peluqueria` varchar(2000) NOT NULL,
  `imagen` varchar(2000) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `objeto`
--

INSERT INTO `objeto` (`id_objeto`, `nombre_objeto`, `cantidad`, `peluqueria`, `imagen`, `precio`) VALUES
(1, 'Flash Artero', 55, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/flash.jpg', 0),
(3, 'Dentastix', 23, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/dentastix.jpg', 8),
(4, 'prueba', 10, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 10),
(5, 'prueba', 10, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 10),
(6, 'prueba10', 100, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 20),
(7, 'prueba29', 10, 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_perro` varchar(200) NOT NULL,
  `visitas` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL DEFAULT 0.00,
  `descripcion` varchar(10000) NOT NULL,
  `peluqueria` varchar(200) DEFAULT NULL,
  `imagen` varchar(3000) DEFAULT NULL,
  `telefono` int(9) NOT NULL,
  `raza` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_perro`, `visitas`, `precio`, `descripcion`, `peluqueria`, `imagen`, `telefono`, `raza`) VALUES
(33, 'Jacko', 3, 25.00, 'Se porta bien, baño y cepillar bien', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/jacko.jpg', 640209584, 'labrador'),
(34, 'lake', 0, 35.00, '16 mm cuerpo patas a tijera\n2025-03-19 12:58:46 - hola\n2025-03-19 12:58:49 - hola', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/lake.jpeg', 0, '0'),
(35, 'Pepita29', 0, 20.00, 'todo a tijera dejar flequillo\n2025-05-22 19:58:55 - hola\n2025-05-22 19:58:59 - hola\n2025-05-22 19:59:14 - mejorn quitar el flequillo\n2025-05-22 19:59:19 - mejorn quitar el flequillo', 'Terrier Terrier', '/ProyectoPelu/Codigo/app/view/Img/pepita.jpeg', 0, '0'),
(123, 'pepito', 100, 10.00, 'perro\n2025-03-19 12:10:33 - perro perro2\n2025-03-19 12:10:40 - perro perro2\n2025-03-19 12:10:58 - perro\r\n2025-03-19 12:10:33 - perro perro2\r\nperro4\n2025-03-19 12:11:11 - perro\r\n2025-03-19 12:10:33 - perro perro2\r\n2025-03-19 12:10:40 - perro perro2 perro4\n2025-03-19 12:11:26 - perro\r\n2025-03-19 12:10:33 - perro perro2\r\n2025-03-19 12:10:40 - perro perro2 perro4\n2025-03-19 12:14:17 - perro5\n2025-03-19 12:14:21 - perro5\n2025-03-19 12:15:10 - perro5\n2025-03-19 12:15:55 - perro5\n2025-03-19 12:20:43 - perro5\n2025-03-19 12:21:33 - perro5', 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 669816915, 'labrador'),
(124, 'dora', 100, 10.00, 'hola', 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 999999999, 'labrador'),
(126, 'pepito', 10, 25.00, 'eeee', 'Terrier Terrier', '	 /ProyectoFinal/Codigo/app/view/Img/jacko.jpg', 666666666, 'Pastor aleman '),
(131, 'prueba29', 100, 20.00, 'hola', 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 123456789, 'Pastor aleman '),
(132, 'prueba30', 10, 20.00, 'hola', 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 123456789, 'Pastor aleman '),
(133, 'prueba30', 10, 20.00, 'hola', 'Terrier Terrier', '/proyectoPelu/Codigo/app/view/Img/lake.jpeg', 123456789, 'Pastor aleman ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteDia`
--

CREATE TABLE `reporteDia` (
  `id_reporte` int(11) NOT NULL,
  `num_compras` int(11) NOT NULL,
  `total_compras` double NOT NULL,
  `fecha_compras` date NOT NULL,
  `peluqueria` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporteDia`
--

INSERT INTO `reporteDia` (`id_reporte`, `num_compras`, `total_compras`, `fecha_compras`, `peluqueria`) VALUES
(1, 6, 160, '2025-05-23', 'Terrier Terrier'),
(2, 6, 160, '2025-05-23', 'Terrier Terrier'),
(3, 6, 160, '2025-05-23', 'Terrier Terrier'),
(4, 6, 160, '2025-05-23', 'Terrier Terrier'),
(5, 6, 160, '2025-05-23', 'Terrier Terrier'),
(6, 6, 160, '2025-05-23', 'Terrier Terrier'),
(7, 6, 160, '2025-05-23', 'Terrier Terrier'),
(8, 6, 160, '2025-05-23', 'Terrier Terrier'),
(9, 6, 160, '2025-05-23', 'Terrier Terrier'),
(10, 6, 160, '2025-05-23', 'Terrier Terrier'),
(11, 6, 160, '2025-05-23', 'Terrier Terrier'),
(12, 6, 160, '2025-05-23', 'Terrier Terrier'),
(13, 6, 160, '2025-05-23', 'Terrier Terrier'),
(14, 6, 160, '2025-05-23', 'Terrier Terrier'),
(15, 6, 160, '2025-05-23', 'Terrier Terrier'),
(16, 6, 160, '2025-05-23', 'Terrier Terrier'),
(17, 2, 55, '2025-05-23', 'Terrier Terrier'),
(18, 1, 25, '2025-05-23', 'Terrier Terrier'),
(19, 2, 55, '2025-05-26', 'Terrier Terrier'),
(20, 1, 25, '2025-05-28', 'Terrier Terrier'),
(21, 3, 80, '2025-05-29', 'Terrier Terrier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(16) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `peluqueria` varchar(200) NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `apellido1` varchar(500) NOT NULL,
  `apellido2` varchar(500) NOT NULL,
  `puesto` varchar(500) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `correo`, `contraseña`, `direccion`, `peluqueria`, `imagen`, `nombre`, `apellido1`, `apellido2`, `puesto`, `administrador`, `activo`) VALUES
('admin', 'admin2@admin.com', 'admin', 'calle admin', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/user.png', 'Jorge', 'Gonzalez', 'Guimarey', 'CEO', 1, 0),
('admin', 'jorge@jorge', '1234', 'grela de paleo', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/user.png', 'Jorge', 'Gonzalez ', 'Guimarey', 'ceo 2', 1, 1),
('jorge', 'jorge@jorge', '1234', 'grela de paleo', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/user.png', 'Jorge', 'Gonzalez ', 'Guimarey', 'ceo 2', 1, 1),
('jorge2', 'admin2@admin.com', '1234', 'grela de paleo', 'Terrier Terrier', '/ProyectoFinal/Codigo/app/view/Img/user.png', 'Jorge', 'Gonzalez ', 'Guimarey', 'ceo 22', 1, 1),
('pablo_prueba1', 'prueba1@gmail.com', '123', 'sdasds, asd sadsdas, calle 2', '', '/ProyectoFinal/Codigo/app/view/Img/user.png', 'Pablo', 'Guimarey ', 'Guimarey', 'Vicepresidente', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id_objeto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `reporteDia`
--
ALTER TABLE `reporteDia`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`,`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id_objeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `reporteDia`
--
ALTER TABLE `reporteDia`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
