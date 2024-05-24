-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS `ConnectingIFES_2_0`;

-- Seleção do banco de dados criado
USE `ConnectingIFES_2_0`;

-- Tabela Usuario
CREATE TABLE Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    sobrenome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    fotoPerfil BLOB,
    tipo ENUM('aluno', 'professor', 'administrador')
);


-- Tabela Aluno
CREATE TABLE Aluno (
    idAluno INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(50) UNIQUE,
    senha VARCHAR(100),
    curso VARCHAR(100),
    periodo INT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(idUsuario)
);

-- Tabela Professor
CREATE TABLE Professor (
    idProfessor INT AUTO_INCREMENT PRIMARY KEY,
    siape VARCHAR(50) UNIQUE,
    senha VARCHAR(100),
    departamento VARCHAR(100),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(idUsuario)
);

-- Tabela Administrador
CREATE TABLE Administrador (
    idAdministrador INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    senha VARCHAR(100),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES Usuario(idUsuario)
);


CREATE TABLE Grupo (
    idGrupo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) UNIQUE
);

CREATE TABLE GrupoAluno (
    grupo_id INT,
    aluno_id INT,
    PRIMARY KEY (grupo_id, aluno_id),
    FOREIGN KEY (grupo_id) REFERENCES Grupo(idGrupo),
    FOREIGN KEY (aluno_id) REFERENCES Aluno(idAluno)
);

CREATE TABLE GrupoProfessor (
    grupo_id INT,
    professor_id INT,
    PRIMARY KEY (grupo_id, professor_id),
    FOREIGN KEY (grupo_id) REFERENCES Grupo(idGrupo),
    FOREIGN KEY (professor_id) REFERENCES Professor(idProfessor)
);

CREATE TABLE Publicacao (
    idPublicacao INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    conteudo VARCHAR(1000),
    imagemPublicacao BLOB,
    dataPublicacao DATETIME,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES Professor(idProfessor)
);

CREATE TABLE PublicacaoGrupo (
    grupo_id INT,
    publicacao_id INT,
    PRIMARY KEY (grupo_id, publicacao_id),
    FOREIGN KEY (grupo_id) REFERENCES Grupo(idGrupo),
    FOREIGN KEY (publicacao_id) REFERENCES Publicacao(idPublicacao)
);

CREATE TABLE Conversa (
    idConversa INT AUTO_INCREMENT PRIMARY KEY,
    usuario1_id INT,
    usuario2_id INT,
    dataInicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario1_id) REFERENCES Usuario(idUsuario),
    FOREIGN KEY (usuario2_id) REFERENCES Usuario(idUsuario)
);


CREATE TABLE Mensagem (
    idMensagem INT AUTO_INCREMENT PRIMARY KEY,
    conversa_id INT,
    remetente_id INT,
    conteudo TEXT,
    dataEnvio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conversa_id) REFERENCES Conversa(idConversa),
    FOREIGN KEY (remetente_id) REFERENCES Usuario(idUsuario)
);