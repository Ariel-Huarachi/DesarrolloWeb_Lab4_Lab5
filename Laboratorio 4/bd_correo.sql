-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 00:13:20
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
-- Base de datos: `bd_correo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE `correos` (
  `id` int(11) NOT NULL,
  `destinatario` varchar(200) NOT NULL,
  `remitente` varchar(100) NOT NULL,
  `asunto` varchar(250) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `destinatario`, `remitente`, `asunto`, `mensaje`, `estado`) VALUES
(86, 'ariel@gmail.com', 'pilotomendez123@gmail.com', 'Laboratorio', '123456789', 2),
(87, 'ariel@gmail.com', 'pilotomendez123@gmail.com', 'Laboratorio', 'Me vale verga', 1),
(89, 'pilotomendez777@gmail.com', 'pilotomendez123@gmail.com', 'Aviso', 'La empresa esta en peligro y necesitamos de la yuda de todos ustedes pedaso de bestias inutiles, cucarachas mal olientes, sanguijuelas chupasangres, mas les vale que se pongan a trabajar lo mas antes posible en este trabajo perros desgraciados es una advertencia muy seria, ya se les estara dejando los requisitos del trabajo adjunto en sus chats', 1),
(90, 'ariel@gmail.com', 'pilotomendez123@gmail.com', 'Aviso', 'La empresa esta en peligro y necesitamos de la yuda de todos ustedes pedaso de bestias inutiles, cucarachas mal olientes, sanguijuelas chupasangres, mas les vale que se pongan a trabajar lo mas antes posible en este trabajo perros desgraciados es una advertencia muy seria, ya se les estara dejando los requisitos del trabajo adjunto en sus chats', 0),
(91, 'ariel@gmail.com', 'ariel@gmail.com', 'juego', 'tenemos una actividad increible, vamos a jugar y luego cañar', 0),
(93, 'pilotomendez777@gmail.com', 'pilotomendez123@gmail.com', 'Aviso', 'Me vale vverga que tengan vacasions, aqui me trabajan porque si y ya', 0),
(94, 'ariel@gmail.com', 'pilotomendez123@gmail.com', 'Aviso', 'Me vale vverga que tengan vacasions, aqui me trabajan porque si y ya', 0),
(95, 'pilotomendez123@gmail.com', 'pilotomendez777@gmail.com', 'Laboratorio', 'Gracias por revisarme el lab numero 4 que quedo increible y fue una experiencia buena para poner en practica todos los conocimientos adquiridos', 0),
(96, 'pilotomendez123@gmail.com', 'pilotomendez777@gmail.com', 'Tarea', 'Esta era una tarea la cual tenia que ser presentada por otro medio pero no nos queda mas opcion que tener que presentarla por este medio', 0),
(97, 'pilotomendez123@gmail.com', 'pilotomendez777@gmail.com', 'Examen', 'Esto quedara en pendiente ya que todavia no esta listo como tal', 2),
(98, 'ariel@gmail.com', 'pilotomendez777@gmail.com', 'Fiesta', 'Querido compañero estas invitado a la fiesta que tengo donde tomaremos muchas bebidas desde una chapaquita hasta un blue label, asi que chochitos quedaremos hijita', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `correo`, `password`, `rol`) VALUES
(1, 'Huesos', 'pilotomendez123@gmail.com', '98fc2c4a28b8c59cd2026605da64eb4ea654c32a', 2),
(2, 'Tilin', 'pilotomendez777@gmail.com', '98fc2c4a28b8c59cd2026605da64eb4ea654c32a', 1),
(3, 'Ariel', 'ariel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(4, 'Pirlo', 'pirlo123@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
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
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
