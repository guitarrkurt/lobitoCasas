-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-09-2015 a las 23:25:56
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hospedaje_uni`
--
CREATE DATABASE IF NOT EXISTS `hospedaje_uni` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hospedaje_uni`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(40) NOT NULL,
  `idPersona` int(11) NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  KEY `fk_Administradores_Personas1_idx` (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdministrador`, `usuario`, `clave`, `idPersona`) VALUES
(1, 'nestor', 'c2bdece3d728794ffaffadb893aa9238', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `idPersona` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_Clientes_Personas1_idx` (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `telefono1`, `telefono2`, `idPersona`) VALUES
(1, '2221133992', '', 2),
(2, '2221133992', NULL, 3),
(3, '2223883698', '', 4),
(4, '2229657202', '2221528517', 5),
(6, '2225533509', '', 7),
(7, '2225421616', '5005226', 8),
(8, '5915691', '', 9),
(9, '2441190', '', 10),
(10, '2223345678', '', 11),
(11, '222123456', '', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedajes`
--

CREATE TABLE IF NOT EXISTS `hospedajes` (
  `idHospedaje` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `direccion` varchar(120) NOT NULL,
  `descripcion` text NOT NULL,
  `servicios` text NOT NULL,
  `compartido` tinyint(1) NOT NULL,
  `noPersonas` int(11) DEFAULT NULL,
  `mensualidad` varchar(60) NOT NULL,
  `deposito` float DEFAULT NULL,
  `costosExtras` float DEFAULT NULL,
  `imagenes` varchar(250) NOT NULL,
  `generoHuesped` varchar(45) NOT NULL,
  `disponibilidad` varchar(50) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `long` float NOT NULL,
  `lat` float NOT NULL,
  PRIMARY KEY (`idHospedaje`),
  KEY `fk_Hospedajes_Clientes_idx` (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `hospedajes`
--

INSERT INTO `hospedajes` (`idHospedaje`, `tipo`, `direccion`, `descripcion`, `servicios`, `compartido`, `noPersonas`, `mensualidad`, `deposito`, `costosExtras`, `imagenes`, `generoHuesped`, `disponibilidad`, `idCliente`, `long`, `lat`) VALUES
(1, 'Cuarto', 'Breñal #6346 Fracc. Camino Real', 'Casa para estudiantes con cuartos compartidos o solos, cama individual, closet, espejo de cuerpo completo, buró', 'Agua, luz, internet inalámbrico, vigilancia, gas', 1, 2, '$1000 compartido y $2000 solo', 1000, 0, 'Imagenes/Hospedaje 1/casa.jpg; Imagenes/Hospedaje 1/cama.jpg; Imagenes/Hospedaje 1/closet.jpg; Imagenes/Hospedaje 1/estancia.jpg;', 'Mixto', 'Disponible', 1, 0, 0),
(2, 'Cuarto', 'Río Nazas #5931', 'Departamento con cuartos individuales, cama individual, closet, ropero, buró, TV por cable, sala-comedor, lavadora', 'Agua, luz, internet inalámbrico, gas', 1, NULL, '$1500', 1500, 0, 'Imagenes/Hospedaje 2/casa.jpg; Imagenes/Hospedaje 2/closet.jpg; Imagenes/Hospedaje 2/cama.jpg; Imagenes/Hospedaje 2/closet2.jpg;', 'Femenino', 'Disponible', 2, 0, 0),
(3, 'Cuarto', 'Río Suchiate #6108 Puebla, Pue', 'Renta de 1 cuarto amueblado con todos los servicios', 'Luz, Agua, Gas, Teléfono, Internet', 1, 4, '$1500', 3000, 0, 'Imagenes/Hospedaje 3/casa.jpg;', 'Mixto', 'Disponible', 3, 0, 0),
(4, 'Cuarto', 'Río Suchiate #6109 Puebla, Pue', 'Renta de cuartos, todos los servicios. Costos del internet se dividen entre los huéspedes', 'Agua, luz, gas', 1, 2, '$1200', 2400, 0, 'Imagenes/Hospedaje 4/casa.jpg; ', 'Mixto', 'Disponible', 4, 0, 0),
(6, 'Cuarto', 'Río Usumacinta #5110', 'Renta de cuarto con internet y cable. El gas se compra entre todos.', 'Internet, cable, luz, agua', 1, 2, '$1300', 1300, 0, 'Imagenes/Hospedaje 6/casa.jpg; ', 'Mixto', 'Disponible', 6, 0, 0),
(7, 'Cuarto', 'Río Colorado #6117', '2 recámaras solo o compartido. Opción para pagar por comidas caseras.', 'Internet, luz, gas', 1, 0, '$1500 solo, $1000 por persona si es compartido', 0, 0, 'Imagenes/Hospedaje 7/casa.JPG; Imagenes/Hospedaje 7/cama1.JPG; Imagenes/Hospedaje 7/closet.JPG; Imagenes/Hospedaje 7/cama2.JPG; ', 'Mujeres', 'Disponible', 7, 0, 0),
(8, 'Cuarto', 'Andador C Circunvalación #1843, entre Río Xamapa y Salado', 'Renta de 2 cuartos, cama y closet. El costo de la luz se divide entre el número de personas. Áreas independientes para los huespedes.', 'Agua, luz, internet', 1, 0, '$1100 compartido, $1200 solo', 0, 0, 'Imagenes/Hospedaje 8/casa.JPG; Imagenes/Hospedaje 8/cama.JPG; Imagenes/Hospedaje 8/closet.JPG; ', 'Mixto', 'Disponible', 8, 0, 0),
(9, 'Cuarto', 'Alguacil #16 Fracc. Arboledas de San Ignacio', '3 cuartos para rentar, recámaras amplias, baño compartido, closet y mesa de trabajo', 'Internet, agua caliente, luz, cochea', 1, 2, '$2000 solo, $3000 compartido', 1000, 0, 'Imagenes/Hospedaje 9/casa.JPG; ', 'Mixto', 'Disponible', 9, 0, 0),
(10, 'Recamara', 'Boulevard Valsequillo', 'necesito que sena alumnos', 'agua', 1, 3, '2000', 200, 300, 'Imagenes/Hospedaje10/celula7.bmp; Imagenes/Hospedaje10/adventure_time.png; ', 'hombre', 'si', 10, 0, 0),
(11, 'Residencial', 'Valsequillo #46', 'Solamente que no le guste, parrandear', 'agua,luz,telefono', 1, 3, '1800', 1500, 400, 'Imagenes/Hospedaje11/adventure_time.png; Imagenes/Hospedaje11/celula4.bmp; ', 'Mixtto', 'Disponible', 11, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE IF NOT EXISTS `opiniones` (
  `idOpinion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `comentarios` text NOT NULL,
  `valoracion` float NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `idHospedaje` int(11) NOT NULL,
  `promedio` float NOT NULL,
  PRIMARY KEY (`idOpinion`),
  KEY `fk_Comentarios_Hospedajes1_idx` (`idHospedaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`idOpinion`, `nombre`, `comentarios`, `valoracion`, `fecha`, `idHospedaje`, `promedio`) VALUES
(1, 'juan', 'me agrado el lugar sobre tod el señor', 3.5, '23/09/2015 10:18:24 am', 2, 0),
(2, 'pedro ', 'no se pero le falto un servico a inerne pero de ahi en fuera el propieario es muy amable', 2, '23/09/2015 10:18:56 am', 2, 0),
(3, 'antonio', 'me agrado el lugar sobre todo qu nso daban comida por la mañana', 5, '23/09/2015 10:19:35 am', 2, 0),
(4, 'ulises', 'asdadasdadada', 5, '24/09/2015 07:37:57 am', 9, 0),
(5, 'walberto', 'hola me agrado su hospitalidad', 5, '28/09/2015 05:32:35 pm', 7, 0),
(6, 'asa', 'as', 4.5, '28/09/2015 05:40:34 pm', 8, 0),
(7, 'sdasd', 'asdasdasdasdsada', 1.5, '28/09/2015 06:04:54 pm', 8, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE IF NOT EXISTS `personas` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersona`, `nombre`, `apellidos`, `email`) VALUES
(1, 'nestor', 'Garcia', 'nestor_gfranco@homail.com'),
(2, 'Estela', 'Ruiz', ''),
(3, 'Sandra', 'Roque Gutiérrez', NULL),
(4, 'No', 'especificado', ''),
(5, 'Omar', 'Alberto Rosas', 'omar_alberto@hotmail.com'),
(7, 'Jorge Roberto', 'Pérez Montes', ''),
(8, 'Judith', 'Calderón Díaz', 'calderondiaz@live.com.mx'),
(9, 'Guadalupe', 'Fuentes', ''),
(10, 'Sergio', 'Hernández', 'Sergio_1789@hotmail.com'),
(11, 'Juan ', 'Perez', 'juanito@hotmail.com'),
(12, 'Javier ', 'Hernandez', 'javier@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` varchar(64) NOT NULL,
  `tipo_u` varchar(64) DEFAULT NULL,
  `Nombre_u` varchar(64) NOT NULL,
  `Apellidop_u` varchar(64) NOT NULL,
  `Apellidom_u` varchar(64) NOT NULL,
  `Edad_u` int(3) NOT NULL,
  `Contrasena_u` varchar(64) NOT NULL,
  `Foto_u` varchar(64) NOT NULL,
  `Direccion_u` varchar(128) NOT NULL,
  `Celular_` int(12) NOT NULL,
  `Telefono_` int(12) NOT NULL,
  `Correo_u` varchar(64) NOT NULL,
  `IFE_u` varchar(64) NOT NULL,
  `Lat_u` float NOT NULL,
  `Long_u` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `tipo_u`, `Nombre_u`, `Apellidop_u`, `Apellidom_u`, `Edad_u`, `Contrasena_u`, `Foto_u`, `Direccion_u`, `Celular_`, `Telefono_`, `Correo_u`, `IFE_u`, `Lat_u`, `Long_u`) VALUES
('', '', '', '', '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', 0, 0, '', '', 12, 23),
('sergino', 'Normal', 'luis', 'lozano', 'jurado', 23, 'ad3307eb4ea0693b6c86d45f4f8e4488', 'adventure_time.png', 'fuertes #45', 222333443, 123456, 'serch@hotmail.com', 'celula1.bmp', 12, 23);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `fk_Administradores_Personas1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_Clientes_Personas1` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hospedajes`
--
ALTER TABLE `hospedajes`
  ADD CONSTRAINT `fk_Hospedajes_Clientes` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `fk_Comentarios_Hospedajes1` FOREIGN KEY (`idHospedaje`) REFERENCES `hospedajes` (`idHospedaje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
