-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para demo
CREATE DATABASE IF NOT EXISTS `demo` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `demo`;

-- Volcando estructura para tabla demo.articulos
CREATE TABLE IF NOT EXISTS `articulos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedidos_id` bigint(20) NOT NULL,
  `productos_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_pedido` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.articulos: ~26 rows (aproximadamente)
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` (`id`, `pedidos_id`, `productos_id`, `cantidad`, `precio_pedido`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 2.70, '2021-02-26 14:03:20', '2021-02-26 14:03:20'),
	(2, 1, 2, 2, 0.75, '2021-02-26 14:03:20', '2021-02-26 14:03:20'),
	(3, 2, 1, 1, 2.70, '2021-02-26 17:49:55', '2021-02-26 17:49:55'),
	(4, 2, 2, 2, 0.75, '2021-02-26 17:49:55', '2021-02-26 17:49:55'),
	(5, 3, 1, 2, 2.70, '2021-02-26 17:56:39', '2021-02-26 17:56:39'),
	(6, 4, 1, 2, 2.70, '2021-03-02 18:59:19', '2021-03-02 18:59:19'),
	(7, 4, 2, 2, 0.75, '2021-03-02 18:59:19', '2021-03-02 18:59:19'),
	(8, 5, 2, 2, 0.75, '2021-03-02 21:27:06', '2021-03-02 21:27:06'),
	(9, 5, 1, 2, 2.70, '2021-03-02 21:27:06', '2021-03-02 21:27:06'),
	(10, 6, 1, 1, 2.70, '2021-03-02 21:52:17', '2021-03-02 21:52:17'),
	(11, 6, 2, 1, 0.75, '2021-03-02 21:52:17', '2021-03-02 21:52:17'),
	(12, 7, 3, 1, 1.75, '2021-03-02 22:28:37', '2021-03-02 22:28:37'),
	(13, 8, 3, 1, 1.75, '2021-03-06 12:34:44', '2021-03-06 12:34:44'),
	(14, 8, 2, 2, 0.75, '2021-03-06 12:34:44', '2021-03-06 12:34:44'),
	(15, 8, 1, 1, 2.70, '2021-03-06 12:34:44', '2021-03-06 12:34:44'),
	(16, 9, 1, 1, 2.70, '2021-03-06 12:45:45', '2021-03-06 12:45:45'),
	(17, 9, 2, 1, 0.75, '2021-03-06 12:45:45', '2021-03-06 12:45:45'),
	(18, 9, 3, 1, 1.75, '2021-03-06 12:45:45', '2021-03-06 12:45:45'),
	(19, 10, 3, 1, 1.75, '2021-03-07 15:53:06', '2021-03-07 15:53:06'),
	(20, 10, 2, 1, 0.75, '2021-03-07 15:53:06', '2021-03-07 15:53:06'),
	(21, 10, 1, 1, 2.70, '2021-03-07 15:53:06', '2021-03-07 15:53:06'),
	(22, 11, 3, 1, 1.75, '2021-03-07 17:59:38', '2021-03-07 17:59:38'),
	(23, 11, 4, 2, 1.20, '2021-03-07 17:59:38', '2021-03-07 17:59:38'),
	(24, 11, 2, 1, 0.75, '2021-03-07 17:59:38', '2021-03-07 17:59:38'),
	(25, 11, 5, 3, 0.95, '2021-03-07 17:59:38', '2021-03-07 17:59:38'),
	(26, 12, 5, 1, 0.95, '2021-03-07 18:24:00', '2021-03-07 18:24:00'),
	(27, 13, 3, 1, 1.75, '2021-03-16 14:24:31', '2021-03-16 14:24:31'),
	(28, 13, 4, 1, 1.20, '2021-03-16 14:24:31', '2021-03-16 14:24:31'),
	(29, 13, 1, 3, 2.70, '2021-03-16 14:24:31', '2021-03-16 14:24:31'),
	(30, 13, 6, 2, 2.50, '2021-03-16 14:24:31', '2021-03-16 14:24:31');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modulo` int(11) NOT NULL DEFAULT '0',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_productos` int(11) DEFAULT NULL,
  `por_defecto` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.categorias: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `modulo`, `file_path`, `imagen`, `num_productos`, `por_defecto`, `deleted_at`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Sin Categorizar', 0, NULL, NULL, 5, 1, NULL, 'sin-categorizar-596', '2021-02-26 13:57:59', '2021-03-02 22:26:54'),
	(2, 'Comida Rapida', 0, NULL, NULL, 1, 0, NULL, 'comida-rapida-218', '2021-03-16 13:52:56', '2021-03-16 13:56:16');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla demo.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_2` text COLLATE utf8mb4_unicode_ci,
  `localidad` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estados_id` bigint(20) unsigned DEFAULT NULL,
  `municipios_id` bigint(20) unsigned DEFAULT NULL,
  `parroquias_id` bigint(20) unsigned DEFAULT NULL,
  `num_pedidos` int(11) DEFAULT NULL,
  `gasto_bs` decimal(5,2) DEFAULT NULL,
  `gasto_dolar` decimal(5,2) DEFAULT NULL,
  `ultima_compra` date DEFAULT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_cedula_unique` (`cedula`),
  KEY `clientes_users_id_foreign` (`users_id`),
  KEY `clientes_estados_id_foreign` (`estados_id`),
  KEY `clientes_municipios_id_foreign` (`municipios_id`),
  KEY `clientes_parroquias_id_foreign` (`parroquias_id`),
  CONSTRAINT `clientes_estados_id_foreign` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE SET NULL,
  CONSTRAINT `clientes_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE SET NULL,
  CONSTRAINT `clientes_parroquias_id_foreign` FOREIGN KEY (`parroquias_id`) REFERENCES `parroquias` (`id`) ON DELETE SET NULL,
  CONSTRAINT `clientes_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.clientes: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `cedula`, `nombre`, `apellidos`, `telefono`, `direccion_1`, `direccion_2`, `localidad`, `codigo_postal`, `estados_id`, `municipios_id`, `parroquias_id`, `num_pedidos`, `gasto_bs`, `gasto_dolar`, `ultima_compra`, `users_id`, `created_at`, `updated_at`) VALUES
	(1, '20025623', 'YONATHAN', 'CASTILLO', '04243386600', 'LA MORERA', 'CANCHA EL MAHOMO', 'SAN JUAN DE LOS MORROS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-02-26 14:04:11', '2021-03-16 14:33:43'),
	(2, '14626739', 'Frank', 'Sierra', '04169309542', 'recidencia cilinia', 'apart. 30-a', 'urb. pueblo nuevo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-02-26 17:54:28', '2021-02-26 17:54:28'),
	(3, '15393449', 'Alvaro José', 'Meléndez Mendez', '04121432800', 'Av. Los puentes número 15-A', NULL, 'Sector centro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2021-03-02 21:55:06', '2021-03-02 21:55:06');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla demo.cuentas
CREATE TABLE IF NOT EXISTS `cuentas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rif_cedula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.cuentas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cuentas` DISABLE KEYS */;
INSERT INTO `cuentas` (`id`, `banco`, `tipo`, `numero`, `titular`, `rif_cedula`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'VENEZUELA', 'CORRIENTE', '0102-0253-6942-5258-6331', 'JOE DOE', '35035035', '2021-02-26 13:56:17', '2021-02-26 16:51:03', NULL),
	(2, 'BANESCO', 'CORRIENTE', '0175-0256-3252-1521-1223', 'JOE DOE', '33033033', '2021-02-26 13:56:54', '2021-02-26 16:49:43', NULL),
	(3, '0102', 'PAGO_MOVIL', '04165117072', '', '21605839', '2021-02-26 13:57:22', '2021-02-26 13:57:22', NULL);
/*!40000 ALTER TABLE `cuentas` ENABLE KEYS */;

-- Volcando estructura para tabla demo.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.estados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;

-- Volcando estructura para tabla demo.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla demo.galerias
CREATE TABLE IF NOT EXISTS `galerias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productos_id` bigint(20) unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galerias_productos_id_foreign` (`productos_id`),
  CONSTRAINT `galerias_productos_id_foreign` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.galerias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `galerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `galerias` ENABLE KEYS */;

-- Volcando estructura para tabla demo.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pedidos_id` bigint(20) unsigned NOT NULL,
  `cuentas_id` bigint(20) unsigned NOT NULL,
  `referencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` decimal(12,2) DEFAULT NULL,
  `capture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reembolsos_id` bigint(20) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.movimientos: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` (`id`, `pedidos_id`, `cuentas_id`, `referencia`, `monto`, `capture`, `estatus`, `tipo`, `reembolsos_id`, `users_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '5632147', NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-02-26 14:04:11', '2021-02-26 14:04:11'),
	(2, 2, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 2, NULL, '2021-02-26 17:54:28', '2021-02-26 17:54:28'),
	(3, 4, 1, '43256874975', NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-02 19:00:18', '2021-03-02 19:00:18'),
	(4, 5, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-02 21:28:34', '2021-03-02 21:28:34'),
	(5, 6, 1, '521452', NULL, NULL, 0, 'Pago', NULL, 4, NULL, '2021-03-02 21:55:06', '2021-03-02 21:55:06'),
	(6, 7, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-02 22:28:43', '2021-03-02 22:28:43'),
	(7, 8, 1, '52352', NULL, NULL, 0, 'Pago', NULL, 4, NULL, '2021-03-06 12:36:21', '2021-03-06 12:36:21'),
	(8, 9, 3, '525351', NULL, NULL, 0, 'Pago', NULL, 4, NULL, '2021-03-06 12:47:46', '2021-03-06 12:47:46'),
	(9, 11, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-07 17:59:53', '2021-03-07 17:59:53'),
	(10, 12, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-07 18:24:04', '2021-03-07 18:24:04'),
	(11, 13, 0, NULL, NULL, NULL, 0, 'Pago', NULL, 1, NULL, '2021-03-16 14:26:16', '2021-03-16 14:26:16');
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.municipios
CREATE TABLE IF NOT EXISTS `municipios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estados_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipios_estados_id_foreign` (`estados_id`),
  CONSTRAINT `municipios_estados_id_foreign` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.municipios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;

-- Volcando estructura para tabla demo.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabla_id` bigint(20) unsigned DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.parametros: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` (`id`, `nombre`, `tabla_id`, `valor`, `created_at`, `updated_at`) VALUES
	(1, 'precio_dolar', 1, '1805000', '2021-02-26 13:55:02', '2021-02-26 13:55:02'),
	(2, 'telefono_numero', NULL, '(0424) 338.66.00', '2021-02-26 13:55:16', '2021-02-26 13:55:16'),
	(3, 'telefono_texto', NULL, 'Solo Whatsapp', '2021-02-26 13:55:16', '2021-02-26 13:55:16'),
	(4, 'metodo_pago', 1, 'true', '2021-02-26 13:55:22', '2021-02-26 13:55:22'),
	(5, 'metodo_pago', 2, 'true', '2021-02-26 13:55:23', '2021-02-26 13:55:23'),
	(6, 'metodo_pago', 3, 'true', '2021-02-26 13:55:27', '2021-02-26 13:55:27'),
	(8, 'favoritos', 1, '1', '2021-02-26 14:02:38', '2021-02-26 14:02:38'),
	(17, 'favoritos', 1, '2', '2021-03-01 23:27:44', '2021-03-01 23:27:44'),
	(24, 'favoritos', 4, '1', '2021-03-02 21:56:35', '2021-03-02 21:56:35'),
	(27, 'favoritos', 1, '4', '2021-03-02 22:27:49', '2021-03-02 22:27:49'),
	(55, 'carrito', 4, '3', '2021-03-07 18:01:54', '2021-03-07 18:01:54'),
	(56, 'carrito', 4, '3', '2021-03-07 18:02:05', '2021-03-07 18:02:05'),
	(57, 'carrito', 4, '3', '2021-03-07 18:02:14', '2021-03-07 18:02:14'),
	(58, 'carrito', 4, '5', '2021-03-08 16:45:15', '2021-03-08 16:45:15'),
	(59, 'carrito', 4, '5', '2021-03-08 16:45:23', '2021-03-08 16:45:23'),
	(60, 'carrito', 4, '5', '2021-03-08 16:45:49', '2021-03-08 16:45:49'),
	(61, 'carrito', 4, '3', '2021-03-08 19:35:47', '2021-03-08 19:35:47'),
	(68, 'favoritos', 1, '6', '2021-03-16 14:47:37', '2021-03-16 14:47:37'),
	(70, 'favoritos', 1, '3', '2021-03-16 14:50:47', '2021-03-16 14:50:47');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Volcando estructura para tabla demo.parroquias
CREATE TABLE IF NOT EXISTS `parroquias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipios_id` bigint(20) unsigned NOT NULL,
  `estados_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parroquias_municipios_id_foreign` (`municipios_id`),
  KEY `parroquias_estados_id_foreign` (`estados_id`),
  CONSTRAINT `parroquias_estados_id_foreign` FOREIGN KEY (`estados_id`) REFERENCES `estados` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parroquias_municipios_id_foreign` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.parroquias: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parroquias` DISABLE KEYS */;
/*!40000 ALTER TABLE `parroquias` ENABLE KEYS */;

-- Volcando estructura para tabla demo.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla demo.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) unsigned NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `costo_delivery` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) NOT NULL,
  `nota_cliente` text COLLATE utf8mb4_unicode_ci,
  `estatus` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `cedula` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion_1` text COLLATE utf8mb4_unicode_ci,
  `direccion_2` text COLLATE utf8mb4_unicode_ci,
  `localidad` text COLLATE utf8mb4_unicode_ci,
  `ip_cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_users_id_foreign` (`users_id`),
  CONSTRAINT `pedidos_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.pedidos: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`, `users_id`, `subtotal`, `costo_delivery`, `total`, `nota_cliente`, `estatus`, `fecha`, `cedula`, `nombre`, `apellidos`, `telefono`, `direccion_1`, `direccion_2`, `localidad`, `ip_cliente`, `delivery`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 6.90, 1.00, 7.90, 'hola mundo', 1, '2021-02-26', '20025623', 'yonathan', 'castillo', '04243386600', 'la morera', 'cancha el mahomo', 'san juan de los morros', NULL, 'SI', NULL, '2021-02-26 14:03:20', '2021-02-26 14:04:11'),
	(2, 2, 4.20, 1.00, 5.20, NULL, 1, '2021-02-26', '14626739', 'Frank', 'Sierra', '04169309542', 'recidencia cilinia', 'apart. 30-a', 'urb. pueblo nuevo', NULL, 'SI', NULL, '2021-02-26 17:49:54', '2021-02-26 17:54:28'),
	(3, 2, 5.40, 3.00, 8.40, NULL, 0, '2021-02-26', '14626739', 'Frank', 'Sierra', '04169309542', 'recidencia cilinia', 'apart. 30-a', 'urb. pueblo nuevo', NULL, 'SI', NULL, '2021-02-26 17:56:39', '2021-02-26 17:56:39'),
	(4, 1, 6.90, 1.00, 7.90, NULL, 1, '2021-03-02', '20025623', 'yonathan', 'castillo', '04243386600', 'la morera', 'cancha el mahomo', 'san juan de los morros', NULL, 'SI', NULL, '2021-03-02 18:59:19', '2021-03-02 19:00:18'),
	(5, 1, 6.90, 1.00, 7.90, NULL, 1, '2021-03-02', '20025623', 'yonathan', 'castillo', '04243386600', 'la morera', 'cancha el mahomo', 'san juan de los morros', NULL, 'SI', NULL, '2021-03-02 21:27:06', '2021-03-02 21:28:34'),
	(6, 4, 3.45, NULL, 3.45, 'Pago facturs', 1, '2021-03-02', '15393449', 'Alvaro José', 'Meléndez Mendez', '04121432800', 'Av. Los puentes número 15-A', NULL, 'Sector centro', NULL, 'NO', NULL, '2021-03-02 21:52:17', '2021-03-02 21:55:06'),
	(7, 1, 1.75, NULL, 1.75, NULL, 1, '2021-03-02', '20025623', 'yonathan', 'castillo', '04243386600', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-02 22:28:37', '2021-03-02 22:28:43'),
	(8, 4, 5.95, NULL, 5.95, NULL, 1, '2021-03-06', '15393449', 'Alvaro José', 'Meléndez Mendez', '04121432800', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-06 12:34:44', '2021-03-06 12:36:21'),
	(9, 4, 5.20, NULL, 5.20, NULL, 1, '2021-03-06', '15393449', 'Alvaro José', 'Meléndez Mendez', '04121432800', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-06 12:45:45', '2021-03-06 12:47:46'),
	(10, 4, 5.20, NULL, 5.20, NULL, 0, '2021-03-07', '15393449', 'Alvaro José', 'Meléndez Mendez', '04121432800', 'Av. Los puentes número 15-A', NULL, 'Sector centro', NULL, 'NO', NULL, '2021-03-07 15:53:06', '2021-03-07 15:53:06'),
	(11, 1, 7.75, NULL, 7.75, NULL, 1, '2021-03-07', '20025623', 'yonathan', 'castillo', '04243386600', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-07 17:59:38', '2021-03-07 17:59:53'),
	(12, 1, 0.95, NULL, 0.95, NULL, 1, '2021-03-07', '20025623', 'yonathan', 'castillo', '04243386600', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-07 18:24:00', '2021-03-07 18:24:04'),
	(13, 1, 16.05, NULL, 16.05, NULL, 1, '2021-03-16', '20025623', 'yonathan', 'castillo', '04243386600', NULL, NULL, NULL, NULL, 'NO', NULL, '2021-03-16 14:24:30', '2021-03-16 14:26:16');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Volcando estructura para tabla demo.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `categorias_id` bigint(20) unsigned DEFAULT NULL,
  `precio` decimal(12,2) DEFAULT NULL,
  `cant_inventario` int(11) DEFAULT NULL,
  `cant_ventas` int(11) DEFAULT NULL,
  `poca_existencia` int(11) DEFAULT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `und_peso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Kg.',
  `venta_individual` int(11) NOT NULL DEFAULT '0',
  `max_carrito` int(11) DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `visibilidad` int(11) NOT NULL DEFAULT '0',
  `descuento` double(8,2) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_sku_unique` (`sku`),
  KEY `productos_categorias_id_foreign` (`categorias_id`),
  CONSTRAINT `productos_categorias_id_foreign` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.productos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `nombre`, `sku`, `descripcion`, `categorias_id`, `precio`, `cant_inventario`, `cant_ventas`, `poca_existencia`, `peso`, `und_peso`, `venta_individual`, `max_carrito`, `file_path`, `imagen`, `estado`, `visibilidad`, `descuento`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'queso llanero', 'QUESO001', '<p>queso llanero de santa maria<br></p>', 1, 2.70, 100, NULL, 10, 1.00, 'Kg.', 0, 3, NULL, NULL, 1, 0, NULL, 'queso-llanero', NULL, '2021-02-26 14:00:47', '2021-02-26 14:00:47'),
	(2, 'marganina deline', 'VIVERES001', NULL, 1, 0.75, 20, NULL, 3, 0.25, 'Kg.', 0, 3, NULL, NULL, 1, 1, 0.20, 'marganina-deline', NULL, '2021-02-26 14:01:41', '2021-03-16 14:43:37'),
	(3, 'Harina de trigo Robin Hood', 'HT0037262526', NULL, 1, 1.75, 100, NULL, 2, 1.00, 'Kg.', 0, 10, NULL, NULL, 1, 0, NULL, 'harina-de-trigo-robin-hood', NULL, '2021-03-02 22:09:05', '2021-03-04 13:40:59'),
	(4, 'Harina PAN Arroz', 'HA9373727', '<p>Harina mezcla de Arroz PAN</p>', 1, 1.20, 100, NULL, 10, 1.00, 'Kg.', 0, NULL, NULL, NULL, 1, 0, NULL, 'harina-pan-arroz', NULL, '2021-03-02 22:25:49', '2021-03-04 13:38:43'),
	(5, 'Pasta corta Horizonte', 'PC937362', '<p>Pasta corta pluma</p>', 1, 0.95, 100, NULL, 10, 1.00, 'Kg.', 0, NULL, NULL, NULL, 1, 0, NULL, 'pasta-corta-horizonte', NULL, '2021-03-02 22:26:54', '2021-03-04 13:38:05'),
	(6, 'Hamburguesa La Gorda', 'HAMBUEGRA', NULL, 2, 2.50, 100, NULL, 2, 0.70, 'Kg.', 0, NULL, NULL, NULL, 1, 0, NULL, 'hamburguesa-la-gorda', NULL, '2021-03-16 13:56:16', '2021-03-16 12:22:32');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.reembolsos
CREATE TABLE IF NOT EXISTS `reembolsos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rif_cedula` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.reembolsos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reembolsos` DISABLE KEYS */;
/*!40000 ALTER TABLE `reembolsos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.saldos
CREATE TABLE IF NOT EXISTS `saldos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) NOT NULL,
  `pedidos_id` bigint(20) NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.saldos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `saldos` DISABLE KEYS */;
/*!40000 ALTER TABLE `saldos` ENABLE KEYS */;

-- Volcando estructura para tabla demo.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.sessions: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('5j4KDawTxj1j5r8ua5c2frwbBglBVJl3mADQ5cmX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEozdWRxdTRka096NzVmcFhEZlEyb3NTRE1ScDBjcDVqM0FyTVU2aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9kZW1vLnRlc3QvbGFyYXZlbC9wdWJsaWMvYW5kcm9pZC9zdG9yZS8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDJ3ckZsRElxNHhRMHRhTXJlRkwxYS5QYWtZMUllTEZtYy5DMWZKVVpKazAxV3hKaWpVb3MyIjt9', 1615917329),
	('juwqi1V3XjtUOlILuL30YvJeJ0M5ldHiwraZgQDi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidlR4cjFYc2N2R2ZIYTFpano3VUVDWVBMeHFtY1R5WUJOaU1KSXZvSCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDJ3ckZsRElxNHhRMHRhTXJlRkwxYS5QYWtZMUllTEZtYy5DMWZKVVpKazAxV3hKaWpVb3MyIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0ODoiaHR0cDovL2RlbW8udGVzdC9sYXJhdmVsL3B1YmxpYy9hZG1pbi9jYXRlZ29yaWFzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJhbGVydCI7YTowOnt9fQ==', 1615920724),
	('mOmHOJXRkuvhrS1u9MxyPeGBCoJppDHmfxFtBX93', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ0JQTG1saGh4RWs3VlJWcUk4dlRmT3oyaUVFUmZJZThMZk5nc29xWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9kZW1vLnRlc3QvbGFyYXZlbC9wdWJsaWMvYW5kcm9pZC9zdG9yZS8xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDJ3ckZsRElxNHhRMHRhTXJlRkwxYS5QYWtZMUllTEZtYy5DMWZKVVpKazAxV3hKaWpVb3MyIjt9', 1615916489);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Volcando estructura para tabla demo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `role` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `permisos` text COLLATE utf8mb4_unicode_ci,
  `plataforma` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.users: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `status`, `permisos`, `plataforma`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Yonathan Castillo', 'leothan522@gmail.com', NULL, '$2y$10$2wrFlDIq4xQ0taMreFL1a.PakY1IeLFmc.C1fJUZJk01WxJijUos2', '04243386600', NULL, 'RYL2QufKve56n5rFKIhk40mkgCCuUJki3eJ0jtHg9SG9TSLmFcNwlJwCzHTi', NULL, NULL, 100, 1, NULL, '0', NULL, '2020-12-16 01:27:26', '2020-12-16 01:27:26'),
	(2, 'frank.sierra@gmail.com', 'frank.sierra@gmail.com', NULL, '$2y$10$x3oWuC0j5/yMh5t4sjNUjuMqT3ye1SAWBLqL4JkNwOMjLv5zNn9S6', '04169309542', NULL, 'vQG0atrJlrk23Hzs1HNV4SI1h5WeAD72rWR9pLM1U5C5EjVIRPTQCySGx5I0', NULL, NULL, 2, 1, '{"usuarios.index":"true","usuarios.role":"true","usuarios.create":"true","usuarios.store":"true","usuarios.status":"true","usuarios.editar":"true","usuarios.clave":"true","usuarios.edit":"true","clientes.index":"true","clientes.show":"true","clientes.edit":"true","clientes.update":"true","categorias.index":"true","categorias.modulo":"true","categorias.store":"true","categorias.edit":"true","categorias.update":"true","categorias.destroy":"true","productos.index":"true","productos.filtrar":"true","productos.ver":"true","productos.create":"true","productos.store":"true","productos.edit":"true","productos.update":"true","productos.galeria_add":"true","productos.galeria_delete":"true","productos.acciones_lote":"true","productos.destroy":"true","ajustes.index":"true","ajustes.store":"true","horarios.index":"true","horarios.store":"true","configuracion":"true","usuarios.show":"true","usuarios.update":"true","e-commerce":"true","productos":"true"}', '1', NULL, '2021-02-18 00:26:16', '2021-02-26 17:46:30'),
	(3, 'daniel romero', 'danielrs67@yahoo.com', NULL, '$2y$10$89MKKa0rjEamHsHs98G9R.M0Hol4uuy5AJXIg41.1eZAjNjBgOtEW', '4149749373', NULL, 'uFxJ25xXx9ZURte82KzOAaNHuvPAagLImkWiys92xBMUJHXp3t1miLSSQEhJ', NULL, NULL, 2, 1, '{"usuarios.index":"true","usuarios.role":"true","usuarios.create":"true","usuarios.store":"true","usuarios.status":"true","usuarios.editar":"true","usuarios.clave":"true","usuarios.edit":"true","clientes.index":"true","clientes.show":"true","clientes.edit":"true","clientes.update":"true","categorias.index":"true","categorias.modulo":"true","categorias.store":"true","categorias.edit":"true","categorias.update":"true","categorias.destroy":"true","productos.index":"true","productos.filtrar":"true","productos.ver":"true","productos.create":"true","productos.store":"true","productos.edit":"true","productos.update":"true","productos.galeria_add":"true","productos.galeria_delete":"true","productos.acciones_lote":"true","productos.destroy":"true","ajustes.index":"true","ajustes.store":"true","horarios.index":"true","horarios.store":"true","configuracion":"true","usuarios.show":"true","usuarios.update":"true","e-commerce":"true","productos":"true"}', '1', NULL, '2021-02-26 13:53:20', '2021-02-26 17:25:36'),
	(4, 'Alvaro melendez', 'alvarojmmsmi@gmail.com', NULL, '$2y$10$84fFhcZMqmuYBGcqbFqAUOn3z08WGNTmMraIH/8oen0ysLvz5sZKy', '04121432800', NULL, '276SgnmheibbXzLeLS4MG0vO56bu5H2JWGAxDHlXOHxj2rAPMO7Sp2TC5ZWy', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-03-02 21:51:15', '2021-03-02 21:51:15'),
	(5, 'cesar ', 'cesar.melendezm@gmail.com', NULL, '$2y$10$GGi/CNpAr2ejN.WGSCpsE.pUBOAXB0uvMoxnWPBEV54awUZz6EJkG', '992128830', NULL, '4DGAKmU0kMHOpEowIImY2Z6uE3LOZmB92AglZrNL3eIFmvb42eXlp7siR1Wf', NULL, NULL, 0, 1, NULL, '1', NULL, '2021-03-07 14:53:55', '2021-03-07 14:53:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla demo.zonas
CREATE TABLE IF NOT EXISTS `zonas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_delivery` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla demo.zonas: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` (`id`, `nombre`, `precio_delivery`, `created_at`, `updated_at`) VALUES
	(1, 'Centro', 1.00, '2021-02-26 13:55:43', '2021-02-26 13:55:43'),
	(2, 'asogata', 3.00, '2021-02-26 17:56:02', '2021-02-26 17:56:02');
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
