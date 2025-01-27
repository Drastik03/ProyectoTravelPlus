-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2025 a las 05:00:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenciaviajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Montaña'),
(2, 'Cultural'),
(3, 'Aventura'),
(4, 'Mar y Costa'),
(5, 'Naturaleza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excursion`
--

CREATE TABLE `excursion` (
  `id` int(11) NOT NULL,
  `title` varchar(125) NOT NULL,
  `image_route` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `price` double(5,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre_actividad` VARCHAR(255) NOT NULL,
    `descripcion` TEXT,
    `ubicacion` VARCHAR(255),
    `hora` TIME,
    `precio` DECIMAL(10, 2),
    `imagen` VARCHAR(255),
    `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fecha_actualizacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `usuario_actualizacion` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

---Traslado
CREATE TABLE traslado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(100) NOT NULL,
    destino VARCHAR(100) NOT NULL,
    fecha_recogida DATE NOT NULL,
    hora_recogida TIME NOT NULL,
    cantidad_pasajeros INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Insertar datos en la tabla
INSERT INTO traslado (origen, destino, fecha_recogida, hora_recogida, cantidad_pasajeros, precio)
VALUES 
('Guayaquil', 'Quito', '2025-01-27', '18:59', 4, 123.00);



--
-- Volcado de datos para la tabla `excursion`
--

INSERT INTO `excursion` (`id`, `title`, `image_route`, `description`, `duration`, `price`, `category_id`, `start_date`, `create_at`, `update_at`) VALUES
(17, 'Excursión a la Montaña', 'excursion_678dc1cb0cb000.81028667.jpeg', 'Disfruta de una experiencia única en la montaña con un guía especializado.', 5, 160.50, 1, '2025-01-20', '2025-01-20 03:23:55', '2025-01-20 03:23:55'),
(18, 'Excursión a la Montaña (Nocturno)', 'excursion_678dc2446fe7e4.50909304.jpeg', 'Disfruta de una experiencia única en la montaña, en plena luz de la luna.', 8, 250.45, 3, '2025-01-30', '2025-01-20 03:25:56', '2025-01-20 03:25:56'),
(19, 'Aventura en la Montaña', 'excursion_678dc39e5982f4.48665688.jpeg', 'mbárcate en una emocionante caminata a través de senderos ocultos y bosques encantados. Descubre la majestuosidad de la Montaña Mística, un paraíso natural con vistas panorámicas y cascadas cristalinas.', 14, 500.90, 3, '2025-01-27', '2025-01-20 03:31:42', '2025-01-20 03:31:42'),
(20, 'Exploración de Cuevas Subterráneas', 'excursion_678dc411e095d0.59312315.jpeg', 'Adéntrate en las profundidades de la tierra para explorar antiguas cuevas llenas de estalactitas y estalagmitas. Aprende sobre las formaciones geológicas y las fascinantes historias que albergan estas cavernas subterráneas.', 9, 200.25, 1, '2025-01-21', '2025-01-20 03:33:37', '2025-01-20 03:33:37'),
(21, 'Safari en la Reserva de Vida Silvestre', 'excursion_678dc4b4009907.33766963.jpg', 'Únete a un safari guiado en una reserva natural para observar de cerca la fauna autóctona en su hábitat. Descubre la diversidad de especies mientras recorres paisajes espectaculares en vehículos todo terreno.', 7, 770.99, 3, '2025-01-19', '2025-01-20 03:36:20', '2025-01-20 03:36:20'),
(22, 'Crucero al Atardecer por la Costa Dorada', 'excursion_678dc52b27c0d6.93033824.jpg', 'Disfruta de una relajante excursión en barco al atardecer por la impresionante Costa Dorada. Admira el horizonte mientras el sol se sumerge en el océano y degusta una selección de vinos locales y aperitivos.', 72, 999.99, 2, '2025-01-28', '2025-01-20 03:38:19', '2025-01-20 03:38:19'),
(23, 'Ruta de Senderismo por el Parque Natural', 'excursion_678dc7b630a5e2.30555319.jpg', 'Disfruta de una caminata guiada por los senderos del Parque Natural, donde podrás explorar paisajes de montañas, bosques y ríos. Esta excursión de nivel moderado es ideal para los amantes de la naturaleza que buscan una experiencia tranquila en un entorno protegido. Durante el recorrido, un guía experto compartirá información sobre la flora, fauna y geografía local.', 3, 30.00, 1, '2025-01-28', '2025-01-20 03:49:10', '2025-01-20 03:49:10'),
(24, 'Excursión al Mirador del Valle Verde', 'excursion_678dc8a125f654.41884261.jpg', 'Únete a nosotros para una caminata relajante hacia el Mirador del Valle Verde, donde podrás disfrutar de impresionantes vistas panorámicas del valle y sus alrededores. A lo largo del recorrido, aprenderás sobre la historia local y las especies autóctonas de la zona. Esta excursión es ideal para quienes buscan disfrutar de la naturaleza sin dificultad física extrema.', 3, 0.00, 3, '2025-01-25', '2025-01-20 03:53:05', '2025-01-20 03:53:05');

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`nombre_actividad`, `descripcion`, `ubicacion`, `hora`, `precio`, `imagen`, `usuario_actualizacion`) VALUES
('Trekking en la montaña', 'Recorrido por los senderos más hermosos de la montaña.', 'Parque Nacional', '10:00:00', 50.00, 'imagen1.jpg', 'admin'),
('Buceo en la costa', 'Explora la vida marina en la Costa Azul.', 'Costa Azul', '08:00:00', 100.00, 'imagen2.jpg', 'admin');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`) VALUES
(3, 'admin'),
(2, 'empresa'),
(1, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `rol_id`, `name`, `lastName`, `username`, `password`, `create_at`, `update_at`) VALUES
(48, 1, 'Johan David', 'Veas Noboa', 'pepeperez', '$2y$10$/DG25BkK4w4/YBp53Xg9KuErMOF6ssOQQ0ccnun2M2iHqaqRbzf5W', '2025-01-18 20:27:41', '2025-01-18 20:27:41'),
(71, 1, 'Juan', 'Pérez', 'juan_perez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(72, 2, 'Maria', 'López', 'maria_lopez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(73, 1, 'Carlos', 'Martínez', 'carlos_martinez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(74, 2, 'Ana', 'Gómez', 'ana_gomez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(75, 1, 'Luis', 'Hernández', 'luis_hernandez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(76, 2, 'Pedro', 'Ramírez', 'pedro_ramirez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(77, 1, 'Sofía', 'Díaz', 'sofia_diaz', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(78, 2, 'Laura', 'González', 'laura_gonzalez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(79, 1, 'Daniel', 'Pérez', 'daniel_perez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(80, 2, 'Raúl', 'Vázquez', 'raul_vazquez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(81, 1, 'Sandra', 'Morales', 'sandra_morales', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(82, 2, 'Javier', 'Fernández', 'javier_fernandez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(83, 1, 'María', 'Martínez', 'maria_martinez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(84, 2, 'David', 'Jiménez', 'david_jimenez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(85, 1, 'Mónica', 'González', 'monica_gonzalez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(86, 2, 'José', 'Méndez', 'jose_mendez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(87, 1, 'Rosa', 'Castro', 'rosa_castro', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(88, 2, 'Andrés', 'Rodríguez', 'andres_rodriguez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(89, 1, 'Marcos', 'López', 'marcos_lopez', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11'),
(90, 2, 'Elena', 'Torres', 'elena_torres', 'password123', '2025-01-19 03:30:11', '2025-01-19 03:30:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_rol`
--

CREATE TABLE `user_rol` (
  `user_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_rol`
--

INSERT INTO `user_rol` (`user_id`, `rol_id`) VALUES
(48, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `excursion`
--
ALTER TABLE `excursion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `excursion_category_id_excursion` (`category_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_role_id_user` (`rol_id`);

--
-- Indices de la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD KEY `user_user_id_user` (`user_id`),
  ADD KEY `rol_role_id_rol` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `excursion`
--
ALTER TABLE `excursion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_role_id_user` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user_rol`
--
ALTER TABLE `user_rol`
  ADD CONSTRAINT `rol_role_id_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_user_id_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
