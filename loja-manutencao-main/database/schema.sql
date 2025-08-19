-- database/schema.sql

CREATE DATABASE loja_manutencao;
USE loja_manutencao;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    telefone VARCHAR(20),
    email VARCHAR(100)
);

CREATE TABLE equipamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    tipo VARCHAR(50),
    marca VARCHAR(50),
    modelo VARCHAR(50),
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE ordens_servico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipamento_id INT,
    descricao TEXT,
    status ENUM('Aberta', 'Em andamento', 'Concluída', 'Cancelada') DEFAULT 'Aberta',
    data_abertura DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_conclusao DATETIME,
    FOREIGN KEY (equipamento_id) REFERENCES equipamentos(id)
);