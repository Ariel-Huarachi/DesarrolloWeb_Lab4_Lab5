-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 00:16:53
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
-- Base de datos: `bd_hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotografiahabitacion`
--

CREATE TABLE `fotografiahabitacion` (
  `id_imagen` int(11) NOT NULL,
  `habitacion_id` int(11) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotografiahabitacion`
--

INSERT INTO `fotografiahabitacion` (`id_imagen`, `habitacion_id`, `fotografia`, `orden`) VALUES
(1, 1, 'individual.jpg', 1),
(2, 2, 'doble.jpg', 1),
(3, 3, 'triple.jpg', 1),
(4, 4, 'familiar.jpg', 1),
(5, 5, 'suite.jpg', 1),
(6, 6, 'presidencial.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `superficie` decimal(10,2) NOT NULL,
  `camas` int(5) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `nombre`, `superficie`, `camas`, `precio`, `tipo_id`) VALUES
(1, 'Solitaria A', 20.00, 1, 100.00, 1),
(2, 'Solitaria B', 22.50, 1, 120.50, 1),
(3, 'Confort Simple', 20.00, 1, 150.00, 1),
(4, 'Dúo Clásica', 23.50, 2, 200.00, 2),
(5, 'Dúo Moderna', 25.00, 2, 250.00, 2),
(6, 'Doble Económica', 21.00, 2, 180.50, 2),
(7, 'Trío Urbana', 30.00, 3, 300.00, 3),
(8, 'Trío Económica', 28.00, 3, 270.80, 3),
(9, 'Familiar Jardín', 50.00, 3, 500.00, 4),
(10, 'Familiar Terraza', 50.00, 3, 500.00, 4),
(11, 'Familiar Deluxe', 50.00, 4, 525.50, 4),
(12, 'Suite Ejecutiva', 70.00, 2, 800.00, 5),
(13, 'Suite Panorámica', 85.50, 3, 950.30, 5),
(14, 'Presidencial Imperial', 105.00, 2, 1112.80, 6),
(15, 'Presidencial Real', 120.40, 2, 1280.00, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numero_habitacion`
--

CREATE TABLE `numero_habitacion` (
  `id_numero` int(11) NOT NULL,
  `piso` int(5) NOT NULL,
  `id_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `numero_habitacion`
--

INSERT INTO `numero_habitacion` (`id_numero`, `piso`, `id_habitacion`) VALUES
(101, 1, 1),
(102, 1, 1),
(103, 1, 1),
(104, 1, 1),
(105, 1, 3),
(106, 1, 3),
(107, 1, 4),
(108, 1, 4),
(109, 1, 4),
(110, 1, 5),
(111, 1, 6),
(112, 1, 6),
(113, 1, 5),
(114, 1, 4),
(115, 1, 4),
(116, 1, 4),
(117, 1, 3),
(118, 1, 3),
(119, 1, 2),
(120, 1, 2),
(121, 1, 2),
(122, 1, 2),
(123, 1, 14),
(124, 1, 15),
(125, 1, 13),
(126, 1, 13),
(127, 1, 12),
(128, 1, 7),
(129, 1, 8),
(130, 1, 8),
(131, 1, 8),
(132, 1, 7),
(133, 1, 9),
(134, 1, 9),
(135, 1, 9),
(136, 1, 9),
(137, 1, 9),
(138, 1, 9),
(139, 1, 9),
(140, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `numero_habitacion` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `numero_habitacion`, `fecha_ingreso`, `fecha_salida`) VALUES
(1, 3, 101, '2025-06-11', '2025-06-12'),
(2, 3, 102, '2025-06-11', '2025-06-15'),
(3, 3, 102, '2025-06-15', '2025-06-17'),
(4, 4, 133, '2025-06-19', '2025-06-21'),
(5, 3, 133, '2025-06-14', '2025-06-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohabitacion`
--

CREATE TABLE `tipohabitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipohabitacion`
--

INSERT INTO `tipohabitacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Individual', 'Ideal para quienes viajan solos y desean privacidad, comodidad y funcionalidad en un espacio acogedor. Equipada con todo lo necesario para una estancia placentera y tranquila.'),
(2, 'Doble', 'Perfecta para parejas o compañeros de viaje. Espaciosa, confortable y diseñada para brindar descanso compartido sin renunciar a la comodidad y el estilo.'),
(3, 'Triple', 'Pensada para familias pequeñas o grupos de amigos. Ofrece armonía entre amplitud y calidez, con camas separadas que garantizan el descanso de todos los huéspedes.'),
(4, 'Familiar', 'Una opción ideal para familias que buscan estar juntas. Espacios amplios, ambientes integrados y servicios pensados para grandes y pequeños por igual.'),
(5, 'Suite', 'Un refugio de lujo y elegancia. La Suite ofrece espacios diferenciados, decoración sofisticada y comodidades premium para quienes buscan una experiencia exclusiva.'),
(6, 'Presidencial', 'La máxima expresión del confort y el lujo. Amplia, lujosa y con servicios personalizados. Diseñada para huéspedes exigentes que buscan una estancia inolvidable.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  `usuario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`, `nivel`, `usuario`) VALUES
(1, 'pilotomendez777@gmail.com', '98fc2c4a28b8c59cd2026605da64eb4ea654c32a', 1, 'alex'),
(2, 'mendez@gmail.com', '98fc2c4a28b8c59cd2026605da64eb4ea654c32a', 2, 'mendez'),
(3, 'pilotomendez123@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'ramiro'),
(4, 'pirlo123@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'Pirlo'),
(6, 'ariel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'Ariel');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotografiahabitacion`
--
ALTER TABLE `fotografiahabitacion`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `habitacion_id` (`habitacion_id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Indices de la tabla `numero_habitacion`
--
ALTER TABLE `numero_habitacion`
  ADD PRIMARY KEY (`id_numero`),
  ADD KEY `fk_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `numero_habitacion` (`numero_habitacion`);

--
-- Indices de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fotografiahabitacion`
--
ALTER TABLE `fotografiahabitacion`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipohabitacion`
--
ALTER TABLE `tipohabitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotografiahabitacion`
--
ALTER TABLE `fotografiahabitacion`
  ADD CONSTRAINT `fotografiahabitacion_ibfk_1` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipohabitacion` (`id`);

--
-- Filtros para la tabla `numero_habitacion`
--
ALTER TABLE `numero_habitacion`
  ADD CONSTRAINT `fk_habitacion` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`numero_habitacion`) REFERENCES `numero_habitacion` (`id_numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
