-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2024 a las 00:39:57
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
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amistades`
--

CREATE TABLE `amistades` (
  `id_relacion_amistad` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_amigo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `amistades`
--

INSERT INTO `amistades` (`id_relacion_amistad`, `id_usuario`, `id_amigo_usuario`) VALUES
(1, 1, 1),
(2, 1, 3),
(4, 2, 3),
(5, 2, 4),
(6, 2, 2),
(8, 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `texto_articulo` varchar(250) DEFAULT NULL,
  `articulo_privado` varchar(250) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `imagen_perfil` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `id_usuario`, `texto_articulo`, `articulo_privado`, `fecha_publicacion`, `imagen_perfil`) VALUES
(1, 2, 'hola quiero comentar que hoy es las fiestas de la universidad ', 'off', '2024-01-17', '2.png'),
(10, 6, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum eaque magni recusandae error minima tempore nobis illum nesciunt, deserunt voluptatem modi veritatis, rerum eum voluptates enim temporibus quod, saepe praesentium.', '0', '2024-02-04', '4.PNG'),
(11, 6, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum eaque magni recusandae error minima tempore nobis illum nesciunt, deserunt voluptatem modi veritatis, rerum eum voluptates enim temporibus quod, saepe praesentium.', '0', '2024-02-04', '3.PNG'),
(12, 6, 'baerb', '1', '2024-02-04', '2.PNG'),
(13, 6, 'hola mundo', '1', '2024-02-04', 'BASO DEA AGUA.jpeg'),
(14, 6, ' hola mundo feliz', '1', '2024-02-04', 'Captura de pantalla 2022-11-02 101904.png'),
(15, 6, 'hola mundo', '0', '2024-02-04', 'descarga.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `texto_mensaje` varchar(250) NOT NULL,
  `archivo_adjunto` varchar(250) NOT NULL,
  `fecha_mensaje` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portada`
--

CREATE TABLE `portada` (
  `id_port` int(11) NOT NULL,
  `descripcion_port` text NOT NULL,
  `fkid_usuario` int(11) NOT NULL,
  `estado_port` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(85) NOT NULL,
  `apellidos` varchar(85) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto_perfil` text DEFAULT NULL,
  `cedula` int(11) NOT NULL,
  `cantidad_hijos` int(11) NOT NULL,
  `estado_civil` varchar(25) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `registro_usu` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `correo`, `fecha_nacimiento`, `foto_perfil`, `cedula`, `cantidad_hijos`, `estado_civil`, `nombre_usuario`, `clave`, `registro_usu`) VALUES
(1, 'sebas', 'sebas', 'sebas@hotmail.com', '2001-11-02', '0', 1754024998, 2, 'Soltero', '25', '$2y$10$4sbWVz6TQ2t7y9VfGcR75.0vFnNBATOAeWH0zmBUCDAxh6zfrJPYW', '2024-01-22'),
(2, 'sebas', 'sebas', 'sebas@hotmail.com', '2001-11-02', '0', 1754024998, 0, 'Viudo', '26', '$2y$10$MM/77XQGON1Dx13WnMw/V.J6JZ7mRGZtUEKoOH4/F491VjlTHUF/a', '2024-01-22'),
(3, 'sds', 'sda', 'sebas@hotmail.com', '2024-01-12', '0', 1754024998, 1, 'Soltero', '27', '$2y$10$fFvW4LqIsPqARzHI.WxsL.gw9joitdJWe/9H1Z3.XFrMjh4ORflwG', '2024-01-22'),
(4, 'sds', 'dsds', 'sds@hotmail.com', '2024-01-06', '0', 2147483647, 2, 'Casado', '12', '$2y$10$srK5ydQ5h4LXtH9N4d5JhO0JfCGZItzwidkDeeAiSooqWW2rUedKi', '2024-01-22'),
(5, 'Sebastian', 'Sarzosa', 'sebas@hotmail.com', '2001-11-02', NULL, 1754024998, 0, 'Soltero', '28', '$2y$10$pyCp1R3HLJrg2rjoxJ6s0eM4b7aAhFTWQNlL15zH/vXrSJAxcQhLu', '2024-01-22'),
(6, 'Romel ', 'Ante', 'avw@gmail.com', '2024-01-19', '2.PNG', 1234567890, 0, 'Soltero', 'romel1', '$2y$10$NbflIt/.Lesqdxg2wHw2qu3/Nfpk8om/hifv50vlDQ6n4UxqwdeDS', '2024-01-22'),
(7, 'Stiven', 'Ante', 'afaf@hotmail.com', '2017-06-07', '0', 550484685, 0, 'Soltero', 'Stiven1', '$2y$10$9I.37LUmGsWDIrWl8serueVtwbY39dBi5jk/./6QRHz8hHg2ZXhl.', '2024-01-22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amistades`
--
ALTER TABLE `amistades`
  ADD PRIMARY KEY (`id_relacion_amistad`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amistades`
--
ALTER TABLE `amistades`
  MODIFY `id_relacion_amistad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
