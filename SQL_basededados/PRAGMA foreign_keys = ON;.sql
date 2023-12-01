PRAGMA foreign_keys = ON;
.headers on
.mode columns

DROP TABLE IF EXISTS Pessoa
--DROP TABLE IF EXISTS Ginasio 


CREATE TABLE Pessoa(
    id INTEGER PRIMARY KEY,
    nome TEXT
    morada TEXT
    nif INTEGER
    nr_telemovel INTEGER
    email TEXT
    data_nascimento TEXT 
);
