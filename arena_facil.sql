-- Banco de dados: arena_facil
-- Gerado em 2026-06-24 01:19:18

CREATE DATABASE IF NOT EXISTS `arena_facil` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `arena_facil`;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `reservas`;
DROP TABLE IF EXISTS `quadras`;
DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(200) DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES ('1', 'Rodrigo', 'teste@gmail.com', '$2y$10$Q75lWw5Ye/WzcJCNmpX1.OZD3y7Qq1Aba0NIIV3pDOsb.vi8hIvM6', 'cliente');
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES ('2', 'administrador Arena', 'admin@arenafacil.com', '123', 'proprietario');
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES ('3', 'João Silva', 'joaoteste@gmail.com', '$2y$10$qY.skvU/I7sITjssjkYM4.0fDk5d6w/88fiWJBY3Oj6XqY3hDLwPG', 'proprietario');

CREATE TABLE `quadras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `preco_hora` decimal(10,2) DEFAULT NULL,
  `proprietario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proprietario` (`proprietario_id`),
  CONSTRAINT `fk_proprietario` FOREIGN KEY (`proprietario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('1', 'Arena society 1', 'society', '120.00', NULL);
INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('2', 'Quadra amadeu', 'society', '150.00', NULL);
INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('3', 'Arena flamengo', 'futsal', '90.00', NULL);
INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('4', 'vila belmiro', 'society', '130.00', NULL);
INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('5', 'mineirão', 'society', '110.00', '2');
INSERT INTO `quadras` (`id`, `nome`, `tipo`, `preco_hora`, `proprietario_id`) VALUES ('6', 'campinho dos sem terra ', 'society', '100.00', '3');

CREATE TABLE `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `quadra_id` int NOT NULL,
  `data_reserva` date NOT NULL,
  `horario` time NOT NULL,
  `status` varchar(20) DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `quadra_id` (`quadra_id`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`quadra_id`) REFERENCES `quadras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `reservas` (`id`, `usuario_id`, `quadra_id`, `data_reserva`, `horario`, `status`) VALUES ('1', '1', '1', '2026-06-22', '09:00:00', 'cancelada');
INSERT INTO `reservas` (`id`, `usuario_id`, `quadra_id`, `data_reserva`, `horario`, `status`) VALUES ('2', '1', '5', '2026-06-24', '18:00:00', 'cancelada');
INSERT INTO `reservas` (`id`, `usuario_id`, `quadra_id`, `data_reserva`, `horario`, `status`) VALUES ('3', '1', '6', '2026-06-23', '19:00:00', 'pendente');

SET FOREIGN_KEY_CHECKS=1;
