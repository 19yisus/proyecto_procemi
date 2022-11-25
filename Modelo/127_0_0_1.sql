-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2022 a las 08:54:18
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"proyecto_procemi\",\"table\":\"movimiento\"},{\"db\":\"proyecto_procemi\",\"table\":\"movimiento_detalles\"},{\"db\":\"proyecto_procemi\",\"table\":\"personal\"},{\"db\":\"proyecto_procemi\",\"table\":\"user_transaction_cambios\"},{\"db\":\"proyecto_procemi\",\"table\":\"empresa\"},{\"db\":\"proyecto_procemi\",\"table\":\"usuarios\"},{\"db\":\"proyecto_procemi\",\"table\":\"vehiculo\"},{\"db\":\"proyecto_procemi\",\"table\":\"producto\"},{\"db\":\"proyecto_procemi\",\"table\":\"cargo\"},{\"db\":\"proyecto_procemi\",\"table\":\"modelo\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-11-21 07:36:28', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `proyecto_procemi`
--
CREATE DATABASE IF NOT EXISTS `proyecto_procemi` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `proyecto_procemi`;

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
(1, 'mango', 1, '2022-11-19'),
(2, 'qwer', 1, '2022-11-20');

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
(1, 'platiado', 1, '2022-11-20'),
(2, 'rojo', 1, '2022-11-20'),
(3, 'negro', 1, '2022-11-20'),
(4, 'oro', 1, '2022-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `ID` int(11) NOT NULL,
  `empresa_Rif` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Encargado` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_CedulaE` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_TelefonoE` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_DireccionE` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Ubicacion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Telefono` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_Estatus` tinyint(1) NOT NULL,
  `empresa_Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`ID`, `empresa_Rif`, `empresa_Encargado`, `empresa_CedulaE`, `empresa_TelefonoE`, `empresa_DireccionE`, `empresa_Nombre`, `empresa_Ubicacion`, `empresa_Telefono`, `empresa_Estatus`, `empresa_Fecha`) VALUES
(4, 'J-123456789', 'Ricardo', 'J-987654321', '0412-3333333', 'Acaria ', 'Procemi', 'Acarigua', '0412-4548787', 1, '2022-11-20');

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
(1, 'macaxo', 1, '2022-11-20'),
(2, 'marcas', 1, '2022-11-20'),
(3, 'aaaaa', 1, '2022-11-20');

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
(1, 'moswlado', 1, '2022-11-20', 3),
(2, 'qwewew', 1, '2022-11-20', 1);

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
  `status_proceso` enum('R','A','S','D','P') COLLATE utf8_spanish_ci NOT NULL,
  `m_Fecha` datetime NOT NULL,
  `observacion` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`ID`, `ID_Vehiculo`, `ID_Personal`, `ID_Producto`, `ID_Empresa`, `condicion_empresa`, `m_Silo`, `m_Estatus`, `status_proceso`, `m_Fecha`, `observacion`) VALUES
(4, 1, 1, 1, NULL, 'I', '1', 1, 'S', '2022-11-20 22:34:00', ''),
(5, 1, 1, 1, NULL, 'I', 'N', 1, 'P', '2022-11-20 22:42:41', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_detalles`
--

CREATE TABLE `movimiento_detalles` (
  `id_detalle` int(11) NOT NULL,
  `m_Cantidad` int(11) NOT NULL,
  `m_Dano` decimal(4,2) DEFAULT NULL,
  `m_Partido` decimal(4,2) DEFAULT NULL,
  `m_Muestra` int(11) DEFAULT NULL,
  `m_Humedad` decimal(4,2) DEFAULT NULL,
  `m_Impureza` decimal(4,2) DEFAULT NULL,
  `m_PesoLab` decimal(8,2) DEFAULT NULL,
  `m_pesoFinal` decimal(8,2) DEFAULT NULL,
  `m_Total` decimal(8,2) DEFAULT NULL,
  `m_TotalDesc` decimal(10,2) DEFAULT NULL,
  `m_Desc_Humedad` decimal(10,2) DEFAULT NULL,
  `m_Desc_Impureza` decimal(10,2) DEFAULT NULL,
  `m_PesoAcon` decimal(10,2) DEFAULT NULL,
  `m_PesoNeto` int(11) NOT NULL,
  `m_FechaLab` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimiento_detalles`
--

INSERT INTO `movimiento_detalles` (`id_detalle`, `m_Cantidad`, `m_Dano`, `m_Partido`, `m_Muestra`, `m_Humedad`, `m_Impureza`, `m_PesoLab`, `m_pesoFinal`, `m_Total`, `m_TotalDesc`, `m_Desc_Humedad`, `m_Desc_Impureza`, `m_PesoAcon`, `m_PesoNeto`, `m_FechaLab`) VALUES
(4, 10000, '20.00', '20.00', 10, '20.00', '20.00', '40.00', '12.00', NULL, '2724.00', '908.00', '1816.00', '7264.00', 9988, NULL),
(5, 15000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

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
  `personal_Telefono` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personal_Estatus` tinyint(1) NOT NULL,
  `personal_Fecha` date NOT NULL,
  `personal_condicion` enum('I','E') COLLATE utf8_spanish_ci NOT NULL,
  `ID_Cargo` int(11) DEFAULT NULL,
  `ID_Empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`ID`, `personal_Cedula`, `personal_Nombre`, `personal_Apellido`, `personal_Nacionalidad`, `personal_Telefono`, `personal_Correo`, `personal_Direccion`, `personal_Estatus`, `personal_Fecha`, `personal_condicion`, `ID_Cargo`, `ID_Empresa`) VALUES
(1, '27672767', 'Ricardo', 'Fenomeno', 'V', '0412-5848484', 'ricardofenomeno13@gmail.com', 'fenomen', 1, '2022-11-19', 'I', 1, NULL);

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
(1, 'arroz', 1, '2022-11-20'),
(2, 'pasta', 1, '2022-11-20');

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
(2, 4, 'E', '2022-11-20'),
(3, 4, 'U', '2022-11-20'),
(2, 5, 'E', '2022-11-20'),
(3, 4, 'U', '2022-11-21'),
(3, 4, 'A', '2022-11-21'),
(2, 4, 'S', '2022-11-21'),
(2, 4, 'S', '2022-11-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula_user` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `clave_user` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nacionalidad` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Telefono` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Direccion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol_user` enum('R','A','L') COLLATE utf8_spanish_ci NOT NULL,
  `estatus_user` tinyint(1) NOT NULL,
  `fecha_user` date NOT NULL,
  `intentos_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula_user`, `clave_user`, `nombre`, `Nacionalidad`, `Telefono`, `Correo`, `Direccion`, `rol_user`, `estatus_user`, `fecha_user`, `intentos_user`) VALUES
(1, '12345678', '$2y$12$ET7BsjhVu/ow0FxiNmGWFOSeJkwMCCDizzxv7SoOz8/VIobX65Br6', 'administrador', NULL, NULL, NULL, NULL, 'A', 1, '2022-10-29', NULL),
(2, '22222222', '$2y$12$Vc3iuORWjfuDWx5PvSD5pu6JProE1LfjxPpL0N980q25dX565HHrm', 'roberto', 'V', '0412-4645645', 'fasdfadsfadsf@gmai.com', 'fasdfasdfadsf', 'R', 1, '2022-10-30', 0),
(3, '33333333', '$2y$12$ET7BsjhVu/ow0FxiNmGWFOSeJkwMCCDizzxv7SoOz8/VIobX65Br6', 'primer laboratorio', NULL, NULL, NULL, NULL, 'L', 1, '2022-10-30', 1),
(4, '12123123', '$2y$12$ET7BsjhVu/ow0FxiNmGWFOSeJkwMCCDizzxv7SoOz8/VIobX65Br6', 'segundo romanero', NULL, NULL, NULL, NULL, 'R', 1, '2022-10-31', NULL),
(6, '27672767', '$2y$12$ET7BsjhVu/ow0FxiNmGWFOSeJkwMCCDizzxv7SoOz8/VIobX65Br6', 'Ricardo Fenomeno', NULL, NULL, NULL, NULL, 'R', 1, '2022-11-02', 1);

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
(1, '1WE3232', NULL, 'NULL', '250000.00', '2001', 'I', 0, '0.00', 1, 1, NULL, '2022-11-20', 1),
(2, '2E2E2E2', NULL, 'NULL', '60000.00', '2023', 'I', 0, '0.00', 1, 1, NULL, '2022-11-20', 0);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
