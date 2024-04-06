-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS `ConnectingIFES_2_0`;

-- Seleção do banco de dados criado
USE `ConnectingIFES_2_0`;

-- Tabela Usuario
CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    sobrenome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    fotoPerfil BLOB,
    tipo ENUM('aluno', 'professor', 'administrador')
);


-- Tabela Aluno
CREATE TABLE Aluno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(50) UNIQUE,
    senha VARCHAR(100),
    curso VARCHAR(100),
    periodo INT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id)
);

-- Tabela Professor
CREATE TABLE Professor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siape VARCHAR(50) UNIQUE,
    senha VARCHAR(100),
    departamento VARCHAR(100),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id)
);

-- Tabela Administrador
CREATE TABLE Administrador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    senha VARCHAR(100),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(id)
);