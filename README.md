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
DROP TABLE IF EXISTS MembroGinasio;
DROP TABLE IF EXISTS Plano;
DROP TABLE IF EXISTS Tipo;
DROP TABLE IF EXISTS Aulagrupo;
DROP TABLE IF EXISTS Inscricao_ag;


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

CREATE TABLE Ginasio(
    nome TEXT PRIMARY KEY,
    morada TEXT
);

CREATE TABLE MembroGinasio(
    membro TEXT REFERENCES Membro,
    ginasio TEXT REFERENCES Ginasio,
    PRIMARY KEY(membro, ginasio) 
);

CREATE TABLE Plano(
    data_adesao TEXT PRIMARY KEY,
    membro TEXT REFERENCES Membro
);

CREATE TABLE Tipo(
    preco INTEGER PRIMARY KEY,
    tempo_treino INTEGER,
    plano TEXT REFERENCES Plano
);

CREATE TABLE Aulagrupo(
    nome TEXT PRIMARY KEY,
    data TEXT,
    hora_inicio INTEGER,
    hora_fim INTEGER,
    duracao_ag INTEGER,
    capacidade INTEGER,
    pt1 TEXT REFERENCES Personaltrainer,
    pt2 TEXT REFERENCES Personaltrainer,
    ginasio TEXT REFERENCES Ginasio
);

CREATE TABLE Inscricao_ag(
    qntd_membros INTEGER,
    membro TEXT REFERENCES Membro,
    aulagrupo TEXT REFERENCES Aulagrupo,
    PRIMARY KEY(membro, aulagrupo)
);
