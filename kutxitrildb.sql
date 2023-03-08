-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-03-2023 a las 10:52:39
-- Versión del servidor: 10.5.13-MariaDB-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `entreuno_kutxitril`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `username`, `password`) VALUES
(0, 'admin', '1234abcd..');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_menu`
--

INSERT INTO `tbl_menu` (`menuID`, `menuName`) VALUES
(12, 'Empanadas'),
(13, 'Cerdo'),
(14, 'Tortillas'),
(15, 'Pimientos'),
(16, 'Pan'),
(17, 'Postres'),
(18, 'Bebidas'),
(20, 'Menaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menuitem`
--

CREATE TABLE `tbl_menuitem` (
  `itemID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_menuitem`
--

INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `price`) VALUES
(40, 12, 'Mejillones', '5.00'),
(41, 12, 'Carne', '5.00'),
(42, 12, 'Choco', '5.00'),
(44, 13, 'Orejas', '6.50'),
(45, 13, 'Chorizo', '7.00'),
(46, 13, 'Zorza', '5.00'),
(47, 13, 'Rosarios', '7.00'),
(48, 14, 'Tortilla Grande', '7.50'),
(49, 14, 'Tortilla PequeÃ±a', '5.00'),
(50, 15, 'Pimientos de PadrÃ³n', '6.50'),
(51, 16, 'Cesta grande', '2.00'),
(52, 16, 'Cesta pequeÃ±a', '1.00'),
(53, 17, 'Empanada de manzana', '6.00'),
(55, 17, 'Tetilla y Membrillo', '6.00'),
(56, 18, 'Tinto 1L', '3.00'),
(57, 18, 'Blanco 1L', '6.00'),
(58, 18, 'Tinto 1/2L', '2.00'),
(59, 18, 'Blanco 1/2L', '4.00'),
(60, 18, 'Tinto 1 Taza', '1.00'),
(61, 18, 'Blanco 1 Taza', '2.00'),
(62, 18, 'Gaseosa 1/2L', '1.00'),
(63, 18, 'Agua 1L', '2.00'),
(64, 18, 'Agua 1/2L', '1.00'),
(67, 12, 'Sardinas', '5.00'),
(69, 20, 'Tenedores', '0.00'),
(70, 20, 'Cuchillos', '0.00'),
(71, 20, 'Vasos', '0.00'),
(72, 20, 'Tazas', '0.00'),
(73, 20, 'Servilletas', '0.00'),
(74, 20, 'Palillos', '0.00'),
(75, 20, 'PimentÃ³n', '0.00'),
(76, 20, 'Platos', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL,
  `mesa` int(11) NOT NULL,
  `status` text NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_date` date NOT NULL,
  `Camarero` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `mesa`, `status`, `total`, `order_date`, `Camarero`) VALUES
(1, 1, 'Cancelado', '5.00', '2023-03-07', 'Camarero'),
(2, 1, 'Cancelado', '13.00', '2023-03-07', 'Camarero'),
(3, 1, 'Cancelado', '7.50', '2023-03-07', 'Camarero'),
(4, 1, 'Cancelado', '0.00', '2023-03-07', 'Camarero'),
(5, 1, 'Listo', '10.50', '2023-03-07', 'Camarero'),
(6, 2, 'Preparando', '9.50', '2023-03-07', 'Camarero'),
(7, 3, 'Esperando', '13.50', '2023-03-07', 'Camarero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_orderdetail`
--

CREATE TABLE `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_orderdetail`
--

INSERT INTO `tbl_orderdetail` (`orderID`, `orderDetailID`, `itemID`, `quantity`, `observaciones`) VALUES
(1, 175, 40, 1, 'hh'),
(2, 176, 45, 1, '1'),
(2, 177, 73, 1, '2'),
(2, 178, 55, 1, '3'),
(3, 179, 52, 1, ''),
(3, 180, 50, 1, 'fs ds sf d '),
(4, 181, 70, 1, ''),
(5, 182, 50, 1, ''),
(5, 183, 71, 2, ''),
(5, 184, 59, 1, 'Que estÃ© frÃ­o'),
(6, 185, 44, 1, 'Muy pasada'),
(6, 186, 51, 1, ''),
(6, 187, 60, 1, ''),
(7, 188, 48, 1, ''),
(7, 189, 51, 1, ''),
(7, 190, 73, 1, ''),
(7, 191, 61, 2, ''),
(7, 192, 76, 2, ''),
(7, 193, 69, 2, ''),
(7, 194, 70, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_role`
--

CREATE TABLE `tbl_role` (
  `IDRol` int(11) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_role`
--

INSERT INTO `tbl_role` (`IDRol`, `role`) VALUES
(1, 'chef'),
(2, 'Camarer@');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staffID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES
(13, 'Cocinero', '1234abcd..', 'Online', 'chef'),
(14, 'Camarero', '1234abcd..', 'Online', 'Camarer@');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indices de la tabla `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indices de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indices de la tabla `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `itemID` (`itemID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indices de la tabla `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`IDRol`);

--
-- Indices de la tabla `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT de la tabla `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `IDRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staffID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
