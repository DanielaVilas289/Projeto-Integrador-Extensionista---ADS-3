CREATE DATABASE projeto
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE projeto;

CREATE TABLE professores (
    id INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    cpf VARCHAR(14),
    endereco VARCHAR(120),
    telefone VARCHAR(100),
    email VARCHAR(100),
    formacao VARCHAR(50),
    especialidade VARCHAR(30),
    experiencia VARCHAR(512),
    PRIMARY KEY (id)
);