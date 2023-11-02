# ESIN
-- Base de dados do site
PRAGMA foreign_keys = ON;
.headers on
.mode columns

DROP TABLE IF EXISTS Pessoa;
DROP TABLE IF EXISTS Membro; 
DROP TABLE IF EXISTS Funcionario;
DROP TABLE IF EXISTS Personaltrainer;
DROP TABLE IF EXISTS Nutricionista;
DROP TABLE IF EXISTS Treino;
DROP TABLE IF EXISTS Ginasio;


CREATE TABLE Pessoa(
    id INTEGER PRIMARY KEY,
    nome TEXT,
    morada TEXT,
    nif INTEGER,
    nr_telemovel INTEGER,
    email TEXT,
    data_nascimento TEXT 
);

CREATE TABLE Membro(
    id INTEGER REFERENCES Pessoa,
    nr_membro INTEGER PRIMARY KEY,
    peso INTEGER,
    altura INTEGER,
    imc INTEGER,
    personaltrainer TEXT REFERENCES Personaltrainer,
    nutricionista TEXT REFERENCES Nutricionista
);

CREATE TABLE Funcionario(
    id INTEGER REFERENCES Pessoa,
    nr_funcionario INTEGER PRIMARY KEY,
    ginasio TEXT REFERENCES Ginasio
);

CREATE TABLE Personaltrainer(
    nr_funcionario INTEGER PRIMARY KEY
);

CREATE TABLE Nutricionista(
    nr_funcionario INTEGER PRIMARY KEY
);

CREATE TABLE Treino(
    data TEXT,
    hora_entrada INTEGER,
    hora_saida INTEGER,
    duracao_t INTEGER,
    ginasio NAME REFERENCES Ginasio,
    membro NAME REFERENCES Membro,
    PRIMARY KEY(data, hora_entrada)
);

CREATE TABLE Ginasio(
    nome TEXT PRIMARY KEY,
    morada TEXT
);
