-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2022 a las 20:37:33
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vensi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Audífono', '2022-04-07 03:11:10'),
(2, 'mouse', '2021-01-19 23:03:01'),
(7, 'Memoria', '2021-07-03 18:19:09'),
(8, 'Kit desarmadores', '2021-07-03 18:33:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `name`, `idusuario`, `message`, `created_on`) VALUES
(1, 'admin', 2, 'hola', '2021-01-22 03:32:27'),
(2, 'javi', 18, 'hola', '2021-03-08 20:47:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `servicio` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `compras` int(11) NOT NULL,
  `rfc` text COLLATE utf8_spanish_ci NOT NULL,
  `cfdi` text COLLATE utf8_spanish_ci NOT NULL,
  `ultima_compra` datetime DEFAULT NULL,
  `contratacion` text COLLATE utf8_spanish_ci NOT NULL,
  `mensualidad` text COLLATE utf8_spanish_ci NOT NULL,
  `enero` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `febrero` text COLLATE utf8_spanish_ci NOT NULL,
  `marzo` text COLLATE utf8_spanish_ci NOT NULL,
  `abril` text COLLATE utf8_spanish_ci NOT NULL,
  `mayo` text COLLATE utf8_spanish_ci NOT NULL,
  `junio` text COLLATE utf8_spanish_ci NOT NULL,
  `julio` text COLLATE utf8_spanish_ci NOT NULL,
  `agosto` text COLLATE utf8_spanish_ci NOT NULL,
  `septiembre` text COLLATE utf8_spanish_ci NOT NULL,
  `octubre` text COLLATE utf8_spanish_ci NOT NULL,
  `noviembree` text COLLATE utf8_spanish_ci NOT NULL,
  `diciembre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `servicio`, `telefono`, `direccion`, `compras`, `rfc`, `cfdi`, `ultima_compra`, `contratacion`, `mensualidad`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembree`, `diciembre`) VALUES
(1, 'mostrador', '', '(555) 555-5555', 'conocido', 41, '', '', '2021-03-14 18:41:18', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(2, 'Levi Cruz Pimentel', '', '(953) 414-7397', 'Insurgentes 2 Primera Sección Villa Tejupam ', 2, 'CUPL901126IF7', 'GASTOS EN GENERAL', '0000-00-00 00:00:00', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(3, 'Adrián Armando Bautista Bautista', '', '(553) 254-2377', 'AV. LIC. VICENTE AGUIRRE S/N', 2, '', '', '2021-07-14 22:16:27', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(4, 'Carlos Camilo Cruz López ', '1', '(953) 545-5323', 'ADOLFO LOPEZ MATEOS S/N.', 2, 'HJGS54', '', '0000-00-00 00:00:00', '18/01/2020', '18/01/2021', '08-03-2021 14:34:18', '03-12-2021 20:26:36', '', '', '', '', '', '', '', '', '', ''),
(5, 'Álvaro Alfonso Hernández Juárez', '2', '(555) 324-2323', 'DOMICILIO CONOCIDO S/N, Oaxaca', 0, '', '', NULL, '18/01/2021', '18/01/2021', '19-01-2021 17:50:47', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'Eduardo Camilo Fernández Rodríguez  ', '1', '(953) 421-5612', 'ADOLFO LOPEZ MATEOS', 7, '', '', '2021-12-03 20:10:40', '12/12/2020', '12/01/2021', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(11, 'Carlos José Cruz López ', '2', '(953) 723-8392', 'ADOLFO LOPEZ MATEOS, S/N', 14, '786FGFg87ghas', 'HJG78111', '2021-12-03 19:42:17', '02/01/2021', '02/01/2021', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(15, 'Denis Rodríguez Garcia ', '1', '(123) 545-6432', 'ADOLFO LOPEZ MATEOS, S/N', 8, '786FGFg87ghas', 'gastos', '2021-07-14 22:26:00', '20/01/2021', '20/02/2021', '21-01-2021 21:26:50', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id` int(11) NOT NULL,
  `remitente` text COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `descuento` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meses`
--

CREATE TABLE `meses` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `meses`
--

INSERT INTO `meses` (`id`, `nombre`) VALUES
(1, 'enero'),
(2, 'febrero'),
(3, 'marzo'),
(4, 'abril'),
(5, 'mayo'),
(6, 'junio'),
(7, 'julio'),
(8, 'agosto'),
(9, 'septiembre'),
(10, 'octubre'),
(11, 'noviembre'),
(12, 'diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `servicio` text COLLATE utf8_spanish_ci NOT NULL,
  `importe` float NOT NULL,
  `cambio` text COLLATE utf8_spanish_ci NOT NULL,
  `folio` text COLLATE utf8_spanish_ci NOT NULL,
  `vendedor` int(11) NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `mes`, `cliente`, `fecha`, `servicio`, `importe`, `cambio`, `folio`, `vendedor`, `comentarios`, `sucursal`, `direccion`, `impuesto`, `total`) VALUES
(1, 1, '5', '2021-01-19 23:51:17', '2', 550, '50', '20001', 2, '', 'TAMAZULAPAM', 'Carretera Cristobal Colón 62, San Cipriano', 0, 500),
(2, 1, '15', '2021-01-22 03:28:58', '1', 300, '0', '20002', 2, 'Pago puntual', 'TAMAZULAPAM', 'Carretera Cristobal Colón 62, San Cipriano', 0, 300),
(3, 1, '4', '2021-03-08 20:36:07', '1', 500, '200', '20003', 2, 'pago atrasado ', 'TEJUPAM', 'AV.Insurgentes 2, Sec 1a, TEJUPAM', 0, 300),
(4, 2, '4', '2021-12-04 02:27:15', '1', 300, '0', '20004', 2, '', 'TAMAZULAPAM', 'Carretera Cristobal Colón 62, San Cipriano', 0, 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `nSerie` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `medida` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_ventaa` float NOT NULL,
  `precio_ventaaa` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `nSerie`, `descripcion`, `marca`, `imagen`, `stock`, `medida`, `precio_compra`, `precio_venta`, `precio_ventaa`, `precio_ventaaa`, `ventas`, `fecha`) VALUES
(4, 2, '234532', '', 'mouse inalámbrico ', 'hp', 'vistas/img/productos/234532/199.jpg', 19, 'Pza', 100, 300, 250, 200, 44, '2021-12-04 01:42:16'),
(8, 1, '7506086616942', 'MH-2040BK', 'Audífonos IN EAR', 'MITZU', 'vistas/img/productos/default/anonymous.png', 24, 'Pza', 50, 100, 95, 85, 1, '2021-12-04 01:42:17'),
(10, 8, 'YHQG67886', '08284-FL', 'HIGH QUALITY FOR YOUR LIFE', 'HIGH', 'vistas/img/productos/YHQG67886/280.jpg', 12, 'Pza', 190, 290, 280, 270, 5, '2021-12-04 02:10:39'),
(11, 8, '7508009367028', '750800936702', 'Limpiador de Circuitos y Tarjetas Electrónicas', 'Prolicom', 'vistas/img/productos/default/anonymous.png', 46, 'Pza', 120, 220, 210, 200, 0, '2021-12-04 01:10:53'),
(13, 7, '740617305234', '6607145', 'DataTraveler 70 32GB TYPE C', 'Kingston', 'vistas/img/productos/740617305234/652.png', 53, 'Pza', 120, 220, 210, 200, 5, '2021-08-04 19:17:15'),
(14, 7, '4713218465368', '11780050', 'Adata 16GB UV240 USB', 'Adata', 'vistas/img/productos/4713218465368/656.jpg', 30, 'Pza', 70, 180, 170, 160, 0, '2021-07-03 19:03:17'),
(15, 7, '740617297300', '6606934B', 'CANVAS Select plus 16GB SD', 'Kingston', 'vistas/img/productos/740617297300/753.jpg', 25, 'Pza', 60, 180, 170, 160, 0, '2021-08-03 21:22:53'),
(16, 7, '4712366965836', '11780059', 'Adata 16GB UV210 USB', 'Adata', 'vistas/img/productos/4712366965836/792.jpg', 11, 'Pza', 60, 180, 175, 160, 2, '2021-12-04 02:15:43'),
(17, 7, '4718050609659', '11580111', 'Adata 32GB USB C008', 'Adata', 'vistas/img/productos/4718050609659/116.jpg', 48, 'Pza', 55, 175, 170, 165, 14, '2021-10-12 03:13:01'),
(18, 7, '4713435791905', '11480034', 'Adata 32GB USB C906', 'Adata', 'vistas/img/productos/4713435791905/924.jpg', 10, 'Pza', 55, 180, 170, 160, 31, '2021-12-04 02:12:52'),
(19, 8, '154782425', '5254', 'Adata 32GB AZUL', 'Adata', 'vistas/img/productos/154782425/858.png', 3, '', 59, 70, 65, 60, 0, '2021-12-04 02:16:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id`, `nombre`, `costo`, `fecha`) VALUES
(1, 'Antivirus ', 70, '2021-07-05 21:24:30'),
(4, 'Activación Office', 60, '2021-07-10 04:46:22'),
(5, 'Mantenimiento Correctivo', 300, '2021-10-12 02:47:55'),
(6, 'Cambio de disco duro', 170, '2021-12-04 02:07:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicioc`
--

CREATE TABLE `servicioc` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `servicios` text COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` text COLLATE utf8_spanish_ci NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `totalP` float NOT NULL,
  `totalS` float NOT NULL,
  `codigoV` int(11) NOT NULL,
  `importe` float NOT NULL,
  `cambio` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicioc`
--

INSERT INTO `servicioc` (`id`, `id_vendedor`, `id_cliente`, `codigo`, `id_tecnico`, `productos`, `servicios`, `comentarios`, `sucursal`, `neto`, `total`, `totalP`, `totalS`, `codigoV`, `importe`, `cambio`, `fecha`) VALUES
(16, 2, 4, '10001', 3, '[{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"2\",\"stock\":\"12\",\"precio\":\"180\",\"total\":\"360\"}]', '[{\"id\":\"5\",\"nombre\":\"Mantenimiento Correctivo\",\"precio\":\"300\"},{\"id\":\"1\",\"nombre\":\"Antivirus \",\"precio\":\"70\"}]', '  ', 'TAMAZULAPAM', 730, 730, 360, 370, 10010, 800, 70, '2021-12-02 01:59:39'),
(17, 2, 2, '10002', 18, '[{\"id\":\"9\",\"descripcion\":\"Adata 32GB UV250 USB\",\"cantidad\":\"1\",\"stock\":\"58\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"10\",\"descripcion\":\"HIGH QUALITY FOR YOUR LIFE\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"280\",\"total\":\"280\"}]', '[{\"id\":\"4\",\"nombre\":\"Activación Office\",\"precio\":\"60\"}]', '', 'TAMAZULAPAM', 510, 510, 450, 60, 10011, 550, 40, '2021-12-02 01:53:09'),
(18, 2, 10, '10003', 3, '[{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"180\",\"total\":\"180\"}]', '[{\"id\":\"5\",\"nombre\":\"Mantenimiento Correctivo\",\"precio\":\"300\"},{\"id\":\"1\",\"nombre\":\"Antivirus \",\"precio\":\"70\"}]', ' entraga tal fecha', 'TEJUPAM', 550, 550, 180, 370, 10013, 600, 50, '2021-12-04 02:12:52'),
(19, 2, 15, '10004', 18, '[{\"id\":\"16\",\"descripcion\":\"Adata 16GB UV210 USB\",\"cantidad\":\"2\",\"stock\":\"11\",\"precio\":\"180\",\"total\":\"360\"}]', '[{\"id\":\"4\",\"nombre\":\"Activación Office\",\"precio\":\"60\"},{\"id\":\"5\",\"nombre\":\"Mantenimiento Correctivo\",\"precio\":\"300\"}]', ' ', 'TEJUPAM', 720, 720, 360, 360, 0, 800, 80, '2021-12-04 02:15:43'),
(20, 2, 1, '10005', 2, '[{\"id\":\"19\",\"descripcion\":\"Adata 32GB AZUL\",\"cantidad\":\"0\",\"stock\":\"3\",\"precio\":\"70\",\"total\":\"\"}]', '[{\"id\":\"1\",\"nombre\":\"Antivirus \",\"precio\":\"70\"}]', '', 'TAMAZULAPAM', 140, 140, 70, 70, 10014, 140, 0, '2021-12-04 02:16:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sevicios`
--

CREATE TABLE `sevicios` (
  `idservicio` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `intensidad` float NOT NULL,
  `precio` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sevicios`
--

INSERT INTO `sevicios` (`idservicio`, `nombre`, `intensidad`, `precio`, `fecha`) VALUES
(1, 'internet Básico ', 5, 300, '2021-08-28 21:22:37'),
(2, 'Internet Medio', 0, 500, '2021-01-19 23:50:20'),
(3, 'antivirus ', 6, 70, '2021-08-28 21:22:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soporte`
--

CREATE TABLE `soporte` (
  `id_soporte` int(11) NOT NULL,
  `remitente` text COLLATE utf8_spanish_ci NOT NULL,
  `receptor` text COLLATE utf8_spanish_ci NOT NULL,
  `asunto` text COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `adjuntos` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` text COLLATE utf8_spanish_ci NOT NULL,
  `papelera` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_soporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `soporte`
--

INSERT INTO `soporte` (`id_soporte`, `remitente`, `receptor`, `asunto`, `mensaje`, `adjuntos`, `tipo`, `papelera`, `fecha_soporte`) VALUES
(5, '2', '18', 'Lorem Ipsum', '\r\n              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n            ', '[]', 'enviado', '[]', '2021-12-04 02:36:15'),
(9, '2', '3', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><u style=\"\">¿Por qué lo usamos?</u></h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.<b> El punto de usar Lorem Ipsum</b> es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p><div><br></div>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/873.jpg\",\"vistas\\/img\\/msj\\/2\\/748.pdf\"]', 'papelera', '[\"2\"]', '2021-12-04 02:35:48'),
(10, '2', '18', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><u style=\"\">¿Por qué lo usamos?</u></h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.<b> El punto de usar Lorem Ipsum</b> es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p><div><br></div>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/873.jpg\",\"vistas\\/img\\/msj\\/2\\/748.pdf\"]', 'enviado', '[]', '2021-12-04 02:36:45'),
(11, '2', '20', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\"><u style=\"\">¿Por qué lo usamos?</u></h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.<b> El punto de usar Lorem Ipsum</b> es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p><div><br></div>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/873.jpg\",\"vistas\\/img\\/msj\\/2\\/748.pdf\"]', 'enviado', '[]', '2021-12-04 02:37:03'),
(12, '2', '18', 'Lorem Ipsum', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el<b> Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo.</b></span>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/726.xlsx\",\"vistas\\/img\\/msj\\/2\\/971.jpg\",\"vistas\\/img\\/msj\\/2\\/302.pdf\",\"vistas\\/img\\/msj\\/2\\/355.docx\"]', 'papelera', '[\"2\"]', '2021-12-04 02:35:48'),
(13, '2', '3', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">¿Por qué lo usamos?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido<b> aquí\". Estos textos hacen parecerlo un españo</b>l que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/774.png\",\"vistas\\/img\\/msj\\/2\\/484.xlsx\",\"vistas\\/img\\/msj\\/2\\/978.pdf\",\"vistas\\/img\\/msj\\/2\\/149.docx\"]', 'papelera', '[\"2\"]', '2021-12-04 02:35:48'),
(14, '2', '18', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">¿Por qué lo usamos?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido<b> aquí\". Estos textos hacen parecerlo un españo</b>l que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/774.png\",\"vistas\\/img\\/msj\\/2\\/484.xlsx\",\"vistas\\/img\\/msj\\/2\\/978.pdf\",\"vistas\\/img\\/msj\\/2\\/149.docx\"]', 'papelera', '[\"2\"]', '2021-12-04 02:35:49'),
(15, '2', '20', 'Lorem Ipsum', '<h2 style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">¿Por qué lo usamos?</h2><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido<b> aquí\". Estos textos hacen parecerlo un españo</b>l que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p>\r\n\r\n            ', '[\"vistas\\/img\\/msj\\/2\\/774.png\",\"vistas\\/img\\/msj\\/2\\/484.xlsx\",\"vistas\\/img\\/msj\\/2\\/978.pdf\",\"vistas\\/img\\/msj\\/2\\/149.docx\"]', 'papelera', '[\"2\"]', '2021-12-04 02:35:49'),
(16, '18', '2', 'Lorem Ipsum', 'HOLA', '[]', 'enviado', NULL, '2021-12-04 02:39:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `telefono`, `direccion`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(2, 'admin', 'admin', '$2a$07$asxx54ahLosChavisjppfulnTu0vEycMah4AQTjpFUtTn0AIK7jvu', '(555) 555-5555', 'AVENIDA NIÑOS HEROES NO. 3', 'Administrador', '', 1, '2022-04-04 17:27:32', '2022-04-04 22:27:32'),
(28, 'Javier Medina Lopez', 'luar', '$2a$07$asxx54ahLosChavisjppfuBdSZfixcMk599tZm0LcmNOj4Voma/vW', '(951) 124-4451', 'nochix', 'Administrador', '', 0, '0000-00-00 00:00:00', '2022-01-08 03:52:45'),
(30, 'luar jonathan', 'jonathan', '$2a$07$asxx54ahLosChavisjppfuN9JmLTFjlSh310nZi0wL7BkCK8MUmLW', '(951) 414-7389', 'nochix', 'Administrador', 'vistas/img/usuarios/jonathan/480.jpg', 0, '0000-00-00 00:00:00', '2022-04-07 17:49:25'),
(31, 'luar jonathan', 'jonathan', '$2a$07$asxx54ahLosChavisjppfuN9JmLTFjlSh310nZi0wL7BkCK8MUmLW', '(951) 414-7389', 'nochix', 'Administrador', 'vistas/img/usuarios/jonathan/317.jpg', 0, '0000-00-00 00:00:00', '2022-04-07 17:49:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `sucursal` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `importe` text COLLATE utf8_spanish_ci NOT NULL,
  `cambio` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `comentarios`, `impuesto`, `neto`, `total`, `metodo_pago`, `sucursal`, `fecha`, `importe`, `cambio`) VALUES
(2, '10002', 1, 2, '[{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"2\",\"stock\":\"38\",\"precio\":\"300\",\"total\":\"600\"},{\"id\":\"3\",\"descripcion\":\"audífonos negros diadema  \",\"cantidad\":\"2\",\"stock\":\"28\",\"precio\":\"350\",\"total\":\"700\"}]', '', 0, 1300, 1300, 'Efectivo', 'TAMAZULAPAM', '2021-01-19 23:24:01', '1800', '500'),
(8, '10003', 1, 2, '[{\"id\":\"3\",\"descripcion\":\"audífonos negros diadema  \",\"cantidad\":\"2\",\"stock\":\"19\",\"precio\":\"250\",\"total\":\"500\"},{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"2\",\"stock\":\"27\",\"precio\":\"200\",\"total\":\"400\"}]', '', 0, 900, 900, 'Efectivo', 'TAMAZULAPAM', '2021-01-20 16:56:55', '1000', '100'),
(10, '10005', 1, 2, '[{\"id\":\"3\",\"descripcion\":\"audífonos negros diadema  \",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"350\",\"total\":\"350\"},{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"3\",\"stock\":\"22\",\"precio\":\"300\",\"total\":\"900\"}]', 'Prueba 1', 0, 1250, 1250, 'Efectivo', 'TAMAZULAPAM', '2021-01-22 03:21:02', '1250', '0'),
(11, '10006', 1, 2, '[{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"2\",\"stock\":\"20\",\"precio\":\"250\",\"total\":\"500\"}]', 'Producto a prueba', 0, 500, 500, 'Efectivo', 'TAMAZULAPAM', '2021-03-08 20:28:38', '1000', '500'),
(12, '10007', 1, 2, '[{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"5\",\"stock\":\"17\",\"precio\":\"250\",\"total\":\"1250\"}]', 'productos a prueba', 0, 1250, 1250, 'Efectivo', 'TEJUPAM', '2021-03-15 00:41:18', '3000', '1750'),
(13, '10008', 10, 2, '[{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"5\",\"stock\":\"12\",\"precio\":\"200\",\"total\":\"1000\"}]', 'hola. hola', 0, 1000, 1000, 'Efectivo', 'TAMAZULAPAM', '2021-03-26 05:45:00', '1400', '400'),
(25, '10009', 11, 2, '[{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"2\",\"stock\":\"14\",\"precio\":\"180\",\"total\":\"360\"},{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"2\",\"stock\":\"20\",\"precio\":\"300\",\"total\":\"600\"}]', ' ', 0, 960, 960, 'Efectivo', 'TAMAZULAPAM', '2021-11-13 21:58:09', '1030', '0'),
(26, '10010', 4, 2, '[{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"2\",\"stock\":\"12\",\"precio\":\"180\",\"total\":\"360\"}]', ' ', 0, 360, 360, 'Efectivo', 'TAMAZULAPAM', '2021-12-02 01:59:39', '800', '70'),
(27, '10011', 2, 2, '[{\"id\":\"9\",\"descripcion\":\"Adata 32GB UV250 USB\",\"cantidad\":\"1\",\"stock\":\"58\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"10\",\"descripcion\":\"HIGH QUALITY FOR YOUR LIFE\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"280\",\"total\":\"280\"}]', ' ', 0, 450, 450, 'Efectivo', 'TAMAZULAPAM', '2021-12-02 01:53:09', '550', '40'),
(28, '10012', 11, 2, '[{\"id\":\"4\",\"descripcion\":\"mouse inalámbrico \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"300\",\"total\":\"300\"},{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"8\",\"descripcion\":\"Audífonos IN EAR\",\"cantidad\":\"1\",\"stock\":\"24\",\"precio\":\"100\",\"total\":\"100\"}]', '', 0, 580, 580, 'Efectivo', 'TAMAZULAPAM', '2021-12-04 01:42:17', '600', '20'),
(29, '10013', 10, 2, '[{\"id\":\"18\",\"descripcion\":\"Adata 32GB USB C906\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"180\",\"total\":\"180\"}]', ' ', 0, 180, 180, 'Efectivo', 'TEJUPAM', '2021-12-04 02:12:52', '600', '50'),
(30, '10014', 1, 2, '[{\"id\":\"19\",\"descripcion\":\"Adata 32GB AZUL\",\"cantidad\":\"0\",\"stock\":\"3\",\"precio\":\"70\",\"total\":\"\"}]', ' ', 0, 70, 70, 'Efectivo', 'TAMAZULAPAM', '2021-12-04 02:16:51', '140', '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mes` (`mes`),
  ADD KEY `cliente` (`cliente`(1024)),
  ADD KEY `servicio` (`servicio`(1024)),
  ADD KEY `vendedor` (`vendedor`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicioc`
--
ALTER TABLE `servicioc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sevicios`
--
ALTER TABLE `sevicios`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `soporte`
--
ALTER TABLE `soporte`
  ADD PRIMARY KEY (`id_soporte`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `meses`
--
ALTER TABLE `meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicioc`
--
ALTER TABLE `servicioc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `sevicios`
--
ALTER TABLE `sevicios`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `soporte`
--
ALTER TABLE `soporte`
  MODIFY `id_soporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
