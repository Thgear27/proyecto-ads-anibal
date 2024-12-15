-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 19-11-2024 a las 16:49:01
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `prueba`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `privilegio`
-- 

CREATE TABLE `privilegio` (
  `idPrivilegio` int(11) NOT NULL auto_increment,
  `labelPrivilegio` varchar(100) NOT NULL,
  `pathPrivilegio` varchar(250) NOT NULL,
  `iconPrivilegio` varchar(100) NOT NULL,
  PRIMARY KEY  (`idPrivilegio`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `privilegio`
-- 

INSERT INTO `privilegio` VALUES (1, 'emitir boleta', '../salesModule/indexEmitirBoleta.php', 'emitirBoleta.png');
INSERT INTO `privilegio` VALUES (2, 'emitir proforma', '../salesModule/indexEmitirProforma.php', 'emitirProforma.png');
INSERT INTO `privilegio` VALUES (3, 'registrar despacho', '../salesModule/indexRegistrarDesapcho.php', 'registrarDespacho.png');
INSERT INTO `privilegio` VALUES (4, 'anular boleta', '../salesModule/indexAnularBoleta.php', 'anularBoleta.png');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `preguntaSecreta` varchar(150) NOT NULL,
  `respuestaSecreta` varchar(150) NOT NULL,
  PRIMARY KEY  (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` VALUES ('gato', '12345', 1, 'como se llama mi mascota?', 'perro');
INSERT INTO `usuario` VALUES ('perro', '98765', 1, 'como se llama mi mascota?', 'gato');
INSERT INTO `usuario` VALUES ('rata', '2468', 1, 'como se llama mi mascota?', 'raton');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarioprovilegio`
-- 

CREATE TABLE `usuarioprovilegio` (
  `login` varchar(50) NOT NULL,
  `idPrivilegio` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `usuarioprovilegio`
-- 

INSERT INTO `usuarioprovilegio` VALUES ('gato', 1);
INSERT INTO `usuarioprovilegio` VALUES ('gato', 2);
INSERT INTO `usuarioprovilegio` VALUES ('gato', 3);
INSERT INTO `usuarioprovilegio` VALUES ('gato', 4);
INSERT INTO `usuarioprovilegio` VALUES ('perro', 2);
INSERT INTO `usuarioprovilegio` VALUES ('perro', 4);
INSERT INTO `usuarioprovilegio` VALUES ('rata', 3);
INSERT INTO `usuarioprovilegio` VALUES ('rata', 1);
