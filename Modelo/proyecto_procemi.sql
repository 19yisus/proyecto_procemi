-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2022 a las 06:45:32
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_procemi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ID` int(50) NOT NULL,
  `cargo_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cargo_Estatus` tinyint(1) NOT NULL,
  `cargo_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ID`, `cargo_Nombre`, `cargo_Estatus`, `cargo_Fecha`) VALUES
(1, 'Cargo', 1, '2022-11-02'),
(2, 'Prueba', 1, '2022-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `ID` int(11) NOT NULL,
  `color_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `color_Estatus` tinyint(1) NOT NULL,
  `color_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`ID`, `color_Nombre`, `color_Estatus`, `color_Fecha`) VALUES
(1, 'color', 1, '2022-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `ID` int(11) NOT NULL,
  `empresa_Rif` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Encargado` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_cedulaE` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_telefonoE` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_direccionE` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Ubicacion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_telefono` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Estatus` tinyint(1) NOT NULL,
  `empresa_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`ID`, `empresa_Rif`, `empresa_Encargado`, `empresa_cedulaE`, `empresa_telefonoE`, `empresa_direccionE`, `empresa_Nombre`, `empresa_Ubicacion`, `empresa_telefono`, `empresa_Estatus`, `empresa_Fecha`) VALUES
(1, 'V-27672767', 'Ricardo Fenomeno', '0', '0', '', 'Empresa', 'rubw', '0', 1, '2022-11-02'),
(2, '293829389', 'qwewewe', 'V-2323232323', '0412-2323232', 'qwewewe', 'uweiuwe', 'ueiwue', '0416-2378273', 1, '2022-11-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `ID` int(11) NOT NULL,
  `marca_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `marca_Estatus` tinyint(1) NOT NULL,
  `marca_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`ID`, `marca_Nombre`, `marca_Estatus`, `marca_Fecha`) VALUES
(1, 'marca', 1, '2022-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `ID` int(11) NOT NULL,
  `modelo_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `modelo_Estatus` tinyint(1) NOT NULL,
  `modelo_Fecha` date NOT NULL,
  `ID_Marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`ID`, `modelo_Nombre`, `modelo_Estatus`, `modelo_Fecha`, `ID_Marca`) VALUES
(1, 'modelo', 1, '2022-11-02', 1),
(2, '350', 1, '2022-11-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `ID` int(11) NOT NULL,
  `ID_Vehiculo` int(11) NOT NULL,
  `ID_Personal` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_Empresa` int(11) DEFAULT NULL,
  `condicion_empresa` enum('I','E') COLLATE utf8_spanish_ci NOT NULL,
  `m_Silo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `m_Estatus` tinyint(1) NOT NULL,
  `status_proceso` enum('R','A','S','D') COLLATE utf8_spanish_ci NOT NULL,
  `m_Fecha` date NOT NULL,
  `observacion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`ID`, `ID_Vehiculo`, `ID_Personal`, `ID_Producto`, `ID_Empresa`, `condicion_empresa`, `m_Silo`, `m_Estatus`, `status_proceso`, `m_Fecha`, `observacion`) VALUES
(1, 1, 1, 1, NULL, 'I', '4', 1, 'S', '2022-11-02', NULL),
(2, 1, 1, 1, 1, 'E', 'N', 1, 'A', '2022-11-02', NULL),
(3, 1, 1, 1, 2, 'E', 'N', 1, 'A', '2022-11-03', NULL),
(4, 1, 1, 2, 1, 'E', 'N', 1, 'D', '2022-11-04', 'fasdfasdfasdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_detalles`
--

CREATE TABLE `movimiento_detalles` (
  `id_detalle` int(11) NOT NULL,
  `m_Cantidad` int(11) NOT NULL,
  `m_Dano` int(11) DEFAULT NULL,
  `m_Partido` int(11) DEFAULT NULL,
  `m_Muestra` int(11) DEFAULT NULL,
  `m_Humedad` decimal(4,2) DEFAULT NULL,
  `m_Impureza` decimal(5,2) DEFAULT NULL,
  `m_PesoLab` decimal(8,2) DEFAULT NULL,
  `m_pesoFinal` decimal(8,2) DEFAULT NULL,
  `m_Total` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimiento_detalles`
--

INSERT INTO `movimiento_detalles` (`id_detalle`, `m_Cantidad`, `m_Dano`, `m_Partido`, `m_Muestra`, `m_Humedad`, `m_Impureza`, `m_PesoLab`, `m_pesoFinal`, `m_Total`) VALUES
(1, 195, 10, 10, 10, '5.00', '50.00', '140.00', '100.00', '95.00'),
(2, 350, 20, 25, 10, '1.00', '10.00', '339.00', NULL, NULL),
(3, 1, 1, 1, 1, '1.00', '100.00', '-100.00', NULL, NULL),
(4, 100, NULL, NULL, 10, '0.00', '0.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `ID` int(11) NOT NULL,
  `personal_Cedula` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `personal_Nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Apellido` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Nacionalidad` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Telefono` char(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Estatus` tinyint(1) NOT NULL,
  `personal_Fecha` date NOT NULL,
  `ID_Cargo` int(11) DEFAULT NULL,
  `ID_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`ID`, `personal_Cedula`, `personal_Nombre`, `personal_Apellido`, `personal_Nacionalidad`, `personal_Telefono`, `personal_Correo`, `personal_Direccion`, `personal_Estatus`, `personal_Fecha`, `ID_Cargo`, `ID_Empresa`) VALUES
(1, '27672767', 'Ricardo', 'Fenomeno', 'V', '04245108557', 'ricardofenomeno13@gmail.com', 'urba', 1, '2022-11-02', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(11) NOT NULL,
  `producto_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `producto_Estatus` tinyint(1) NOT NULL,
  `producto_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID`, `producto_Nombre`, `producto_Estatus`, `producto_Fecha`) VALUES
(1, 'producto', 1, '2022-11-02'),
(2, '2323', 1, '2022-11-02'),
(3, 'jsdjskjd', 1, '2022-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_transaction_cambios`
--

CREATE TABLE `user_transaction_cambios` (
  `user_id` int(11) NOT NULL,
  `tran_id` int(11) NOT NULL,
  `des_cambio` enum('E','A','S','U','R') COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user_transaction_cambios`
--

INSERT INTO `user_transaction_cambios` (`user_id`, `tran_id`, `des_cambio`, `fecha`) VALUES
(2, 1, 'E', '2022-11-02'),
(3, 1, 'A', '2022-11-02'),
(2, 1, 'S', '2022-11-02'),
(2, 2, 'E', '2022-11-02'),
(3, 2, 'A', '2022-11-02'),
(2, 3, 'E', '2022-11-03'),
(3, 3, 'U', '2022-11-03'),
(3, 3, 'U', '2022-11-03'),
(3, 3, 'A', '2022-11-04'),
(2, 4, 'E', '2022-11-04'),
(3, 4, 'U', '2022-11-04'),
(3, 4, 'U', '2022-11-04'),
(3, 4, 'R', '2022-11-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula_user` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `clave_user` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol_user` enum('R','A','L') COLLATE utf8_spanish_ci NOT NULL,
  `estatus_user` tinyint(1) NOT NULL,
  `fecha_user` date NOT NULL,
  `intentos_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula_user`, `clave_user`, `nombre`, `rol_user`, `estatus_user`, `fecha_user`, `intentos_user`) VALUES
(1, '12345678', '$2y$12$q0LvFyEgTp2T50Km0Vq6o.11820ln7qPBuT/mVcYpnHZzV5yHUbHS', 'administrador', 'A', 1, '2022-10-29', NULL),
(2, '22222222', '$2y$12$SQRNIjhWMZKYnzWvcT46g.RBrRrWsLFe1OV4vyqNodNovfQaNZWSe', 'primer romanero', 'R', 1, '2022-10-30', NULL),
(3, '33333333', '$2y$12$SQRNIjhWMZKYnzWvcT46g.RBrRrWsLFe1OV4vyqNodNovfQaNZWSe', 'primer laboratorio', 'L', 1, '2022-10-30', NULL),
(4, '12123123', '$2y$12$VIlw7.Lc4MmkuWbmBfHGc.loEpTWpcxx426AygHQ.OlxATu77i/Ha', 'segundo romanero', 'R', 1, '2022-10-31', NULL),
(6, '27672767', '$2y$12$5DQzc4Bt/lLY71e71ftUZOtr416XbNwjAAZRq3Kk890epQF2zrp5q', 'Ricardo Fenomeno', 'R', 1, '2022-11-02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `ID` int(11) NOT NULL,
  `vehiculo_Placa` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `segunda_Placa` char(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rif_dueno` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vehiculo_Peso` decimal(8,2) NOT NULL,
  `vehiculo_Ano` char(4) COLLATE utf8_spanish_ci NOT NULL,
  `condicion` enum('P','E','I') COLLATE utf8_spanish_ci NOT NULL,
  `if_doble` tinyint(1) NOT NULL,
  `Vehiculo_PesoSecundario` decimal(8,2) DEFAULT NULL,
  `ID_Modelo` int(11) DEFAULT NULL,
  `ID_Color` int(11) DEFAULT NULL,
  `ID_Empresa` int(11) DEFAULT NULL,
  `vehiculo_Fecha` date NOT NULL,
  `vehiculo_Estatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`ID`, `vehiculo_Placa`, `segunda_Placa`, `rif_dueno`, `vehiculo_Peso`, `vehiculo_Ano`, `condicion`, `if_doble`, `Vehiculo_PesoSecundario`, `ID_Modelo`, `ID_Color`, `ID_Empresa`, `vehiculo_Fecha`, `vehiculo_Estatus`) VALUES
(1, '2I3O23O', NULL, 'NULL', '1995.00', '2001', 'I', 0, '0.00', 1, 1, NULL, '2022-11-02', 1),
(2, 'YYUY877', 'UU87Y7T', 'NULL', '250.00', '2000', 'E', 0, '300.00', 1, 1, 1, '2022-11-02', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `empresa_Rif` (`empresa_Rif`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Marca_2` (`ID_Marca`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Personal` (`ID_Personal`),
  ADD KEY `ID_Vehiculo` (`ID_Vehiculo`),
  ADD KEY `ID_Empresa` (`ID_Empresa`);

--
-- Indices de la tabla `movimiento_detalles`
--
ALTER TABLE `movimiento_detalles`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `personal_Cedula` (`personal_Cedula`),
  ADD KEY `ID_Cargo` (`ID_Cargo`),
  ADD KEY `ID_Empresa` (`ID_Empresa`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `user_transaction_cambios`
--
ALTER TABLE `user_transaction_cambios`
  ADD KEY `FK_user` (`user_id`),
  ADD KEY `FK_tran` (`tran_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula_user` (`cedula_user`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Color_2` (`ID_Color`),
  ADD KEY `ID_Modelo` (`ID_Modelo`),
  ADD KEY `ID_Empresa` (`ID_Empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`ID_Marca`) REFERENCES `marca` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_4` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_7` FOREIGN KEY (`ID_Vehiculo`) REFERENCES `vehiculo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_8` FOREIGN KEY (`ID_Personal`) REFERENCES `personal` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_9` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresa` (`ID`);

--
-- Filtros para la tabla `movimiento_detalles`
--
ALTER TABLE `movimiento_detalles`
  ADD CONSTRAINT `detalles_movimiento` FOREIGN KEY (`id_detalle`) REFERENCES `movimiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`ID_Cargo`) REFERENCES `cargo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_transaction_cambios`
--
ALTER TABLE `user_transaction_cambios`
  ADD CONSTRAINT `FK_tran` FOREIGN KEY (`tran_id`) REFERENCES `movimiento` (`ID`),
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_2` FOREIGN KEY (`ID_Color`) REFERENCES `color` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_3` FOREIGN KEY (`ID_Modelo`) REFERENCES `modelo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_4` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresa` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
