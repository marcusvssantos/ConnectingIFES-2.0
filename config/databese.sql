-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS `ConnectingIFES_2_0`;

-- Seleção do banco de dados criado
USE `ConnectingIFES_2_0`;

-- Criação da tabela `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fotoPerfil` blob,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `matricula` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `siape` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
