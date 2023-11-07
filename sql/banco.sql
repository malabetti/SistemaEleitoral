DROP DATABASE IF EXISTS eleicao;
CREATE DATABASE eleicao;

USE eleicao;

CREATE TABLE candidatos (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nome_candidato VARCHAR(255) NOT NULL,
    numero_candidato INT NOT NULL,
    desc_candidato VARCHAR(1024) DEFAULT 'CANDIDATO DO GRÊMIO',
    votos INT DEFAULT 0
);

CREATE TABLE votantes (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE estudantes (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nome_estudante VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
	senha VARCHAR(255) NOT NULL
);

INSERT INTO candidatos (nome_candidato, numero_candidato) VALUES
('Ana Maria Torres', '1'),
('Pedro Farias', '2'),
('Joana Fon', '3');