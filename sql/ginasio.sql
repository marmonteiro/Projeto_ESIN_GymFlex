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

-- PESSOAS  
   -- PORTO
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (1, "João Andrade", "Rua das Flores, Porto", 200300600,91568090,"joao.andrade@gmail.com","1983-07-21");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (2, "Joana Almeida", "Avenida 25 de abril, Porto", 200300500,923456789,"joana.almeida@hotmail.com", "2000/01/01");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (3, "Maria Teixeira", "Rua de Santa Catarina, Porto", 220310500,910052523,"teixeira.maria2@hotmail.com", "2004/10/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (4, "André Mendonça", "Rua 31 de janeiro, Porto", 270420500,962323456, "amendonca@gmail.com", "2000/05/01");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (5, "Gonçalo Mendes", "Travessa Exterior da Circunvalação, Porto", 320400500,962323999, "goncalo.mendes@gmail.com", "2002/06/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (6, "Francisco Mendes", "Travessa Exterior da Circunvalação, Porto", 320400400,966700820, "francisco.mendes@gmail.com", "2002/06/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (7, "Andreia Silva", "Rua Santa Catarina, Porto", 212121212, 923456789, "andreia.silva@email.com", "1993/08/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (8, "Nuno Santos", "Avenida dos Aliados, Porto", 222222222, 911223344, "nuno.santos@email.com", "1980/01/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (9, "Margarida Costa", "Rua de Cedofeita, Porto", 232323232, 934567890, "margarida.costa@email.com", "1995/06/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (10, "Ricardo Martins", "Rua do Almada, Porto", 242424242, 912345678, "ricardo.martins@email.com", "1985/11/23");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (11, "Catarina Pereira", "Rua da Boavista, Porto", 252525252, 900000001, "catarina.pereira@email.com", "2000/03/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (12, "Pedro Rocha", "Rua de Santa Teresa, Porto", 262626262, 987654321, "pedro.rocha@email.com", "1989/07/20");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (13, "Inês Alves", "Rua do Bonjardim, Porto", 272727272, 923456789, "ines.alves@email.com", "1992/12/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (14, "Rui Silva", "Rua de Cedofeita, Porto", 282828282, 911223344, "rui.silva@email.com", "1983/04/02");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (15, "Marta Gonçalves", "Rua das Flores, Porto", 292929292, 934567890, "marta.goncalves@email.com", "1995/09/24");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (16, "José Rodrigues", "Rua do Carmo, Porto", 303030303, 912345678, "jose.rodrigues@email.com", "1988/02/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (17, "Carolina Santos", "Rua das Carmelitas, Porto", 313131313, 900000001, "carolina.santos@email.com", "2001/06/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (18, "Hugo Pereira", "Praça da Liberdade, Porto", 323232323, 987654321, "hugo.pereira@email.com", "1978/10/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (19, "Ana Oliveira", "Rua de Santo Ildefonso, Porto", 333333333, 923456789, "ana.oliveira@email.com", "1990/05/21");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (20, "Miguel Almeida", "Avenida dos Aliados, Porto", 343434343, 911223344, "miguel.almeida@email.com", "1984/08/04");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (21, "Sofia Santos", "Rua das Taipas, Porto", 353535353, 934567890, "sofia.santos@email.com", "1997/11/16");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (22, "João Rodrigues", "Rua de Santo António, Porto", 363636363, 912345678, "joao.rodrigues@email.com", "1989/02/06");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (23, "Carla Costa", "Rua das Carmelitas, Porto", 373737373, 900000001, "carla.costa@email.com", "2001/06/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (24, "André Sousa", "Rua do Almada, Porto", 345689789, 912345657, "andre.sousa@gmail.com", "2004/07/14");


-- AVEIRO
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (25, "Maria Carvalho", "Mário Sacramento, Aveiro", 270504600, 910578900, "carvalho.maria@gmail.com", "1970/07/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) Values
    (26, "Ana Aguiar", "Rua Clube dos Galitos, Aveiro", 450670890,934567689, "ana.guiar@gmail.com", "2002/05/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (27, "Sara Alves", "Rua da Beira-Mar, Aveiro", 222222222, 923456789, "sara.alves@email.com", "1990/06/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (28, "Ricardo Pereira", "Avenida Dr. Lourenço Peixinho, Ílhavo", 333333333, 911223344, "ricardo.pereira@email.com", "1983/02/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (29, "Marta Gomes", "Rua João Mendonça, Esgueira", 444444444, 934567890, "marta.gomes@email.com", "1995/09/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (30, "António Rocha", "Travessa das Fontainhas, Aveiro", 555555555, 912345678, "antonio.rocha@email.com", "1988/04/23");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (31, "Pedro Oliveira", "Avenida da Beira-Mar, Aveiro", 444555666, 923456789, "pedro.oliveira@email.com", "1982/04/03");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (32, "Rita Oliveira", "Avenida Dr. Lourenço Peixinho, Aveiro", 383838383, 923456789, "rita.oliveira@email.com", "1993/08/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (33, "Francisco Pereira", "Rua João Mendonça, Ílhavo", 393939393, 911223344, "francisco.pereira@email.com", "1980/01/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (34, "Marta Santos", "Rua das Fontainhas, Esgueira", 404040404, 934567890, "marta.santos@email.com", "1995/06/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (35, "Tiago Silva", "Travessa da Misericórdia, Aveiro", 414141414, 912345678, "tiago.silva@email.com", "1985/11/20");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (36, "Catarina Rodrigues", "Rua João Mendonça, Aveiro", 424242424, 900000001, "catarina.rodrigues@email.com", "2000/02/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (37, "João Costa", "Rua das Virtudes, Aveiro", 434343434, 987654321, "joao.costa@email.com", "1989/07/18");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (38, "Mariana Oliveira", "Rua da Caldeiroa, Aveiro", 444444444, 923456789, "mariana.oliveira@email.com", "1992/12/10");


    -- LISBOA
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (39, "Ana Silva", "Rua das Flores, Lisboa", 123456789, 912345678, "ana.silva@email.com", "1990/03/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (40, "Carlos Santos", "Avenida Central, Lisboa", 987654321, 934567890, "carlos.santos@email.com", "1985/11/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (41, "Marta Oliveira", "Praça da Liberdade, Lisboa", 555555555, 900000001, "marta.oliveira@email.com", "2000/07/18");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (42, "Rita Pereira", "Rua do Comércio, Lisboa", 111222333, 987654321, "rita.pereira@email.com", "1995/09/14");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (43, "Sofia Martins", "Praça do Marquês, Lisboa", 777888999, 911223344, "sofia.martins@email.com", "1998/12/22");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (44, "Jorge Silva", "Travessa das Oliveiras, Lisboa", 333444555, 934567890, "jorge.silva@email.com", "1975/06/30");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (45, "Ana Oliveira", "Avenida da Liberdade, Lisboa", 454545454, 923456789, "ana.oliveira@email.com", "1993/08/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (46, "Rui Santos", "Rua Augusta, Lisboa", 464646464, 911223344, "rui.santos@email.com", "1980/01/23");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (47, "Mariana Costa", "Bairro Alto, Lisboa", 474747474, 934567890, "mariana.costa@email.com", "1995/06/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (48, "Diogo Martins", "Baixa-Chiado, Lisboa", 484848484, 912345678, "diogo.martins@email.com", "1985/11/18");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (49, "Catarina Pereira", "Parque das Nações, Lisboa", 494949494, 900000001, "catarina.pereira@email.com", "2000/03/03");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (50, "Hugo Rocha", "Belém, Lisboa", 505050505, 987654321, "hugo.rocha@email.com", "1989/07/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (51, "Inês Almeida", "Alfama, Lisboa", 515151515, 923456789, "ines.almeida@email.com", "1992/12/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (52, "Miguel Silva", "Lapa, Lisboa", 525252525, 911223344, "miguel.silva@email.com", "1983/03/01");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (53, "Sofia Santos", "Campo de Ourique, Lisboa", 535353535, 934567890, "sofia.santos@email.com", "1995/09/22");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (54, "João Rodrigues", "Rossio, Lisboa", 545454545, 912345678, "joao.rodrigues@email.com", "1988/01/31");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (55, "Carla Costa", "Alvalade, Lisboa", 555555555, 900000001, "carla.costa@email.com", "2001/06/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (56, "André Sousa", "Bairro Alto, Lisboa", 565656565, 987654321, "andre.sousa@email.com", "1978/09/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (57, "Rita Oliveira", "Alcântara, Lisboa", 575757575, 923456789, "rita.oliveira@email.com", "1990/05/19");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (58, "Nuno Santos", "Parque Eduardo VII, Lisboa", 585858585, 911223344, "nuno.santos@email.com", "1984/08/02");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (59, "Margarida Costa", "Amoreiras, Lisboa", 595959595, 934567890, "margarida.costa@email.com", "1997/11/14");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (60, "Ricardo Martins", "Areeiro, Lisboa", 606060606, 912345678, "ricardo.martins@email.com", "1989/02/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (61, "Mariana Costa", "Cais do Sodré, Lisboa", 616161616, 900000001, "mariana.costa@email.com", "2001/06/23");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (62, "João Costa", "Santos, Lisboa", 626262626, 987654321, "joao.costa@email.com", "1978/10/06");

    -- BRAGA
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (63, "Mariana Costa", "Rua dos Anjos, Braga", 666777888, 900000001, "mariana.costa@email.com", "1989/08/17");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (64, "Tiago Santos", "Avenida da Boavista, Braga", 222333444, 912345678, "tiago.santos@email.com", "2001/02/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (65, "Carla Ferreira", "Praça dos Leões, Braga", 888999000, 987654321, "carla.ferreira@email.com", "1980/11/01");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (66, "João Almeida", "Rua das Virtudes, Braga", 555666777, 923456789, "joao.almeida@email.com", "1993/05/20");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (67, "Catarina Ramos", "Avenida do Infante, Braga", 111222333, 911223344, "catarina.ramos@email.com", "1997/03/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (68, "Fernando Oliveira", "Travessa das Flores, Braga", 444555666, 934567890, "fernando.oliveira@email.com", "1978/09/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (69, "Inês Pereira", "Rua da Boa Nova, Braga", 777888999, 900000001, "ines.pereira@email.com", "2005/07/09");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (70, "Marta Pereira", "Avenida da Liberdade, Braga", 707070707, 923456789, "marta.pereira@email.com", "1993/08/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (71, "Daniel Silva", "Rua do Souto, Braga", 717171717, 911223344, "daniel.silva@email.com", "1980/01/20");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (72, "Carolina Costa", "Avenida Central, Braga", 727272727, 934567890, "carolina.costa@email.com", "1995/06/02");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (73, "Rui Martins", "Rua do Raio, Braga", 737373737, 912345678, "rui.martins@email.com", "1985/11/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (74, "Mariana Oliveira", "Rua dos Chaos, Braga", 747474747, 900000001, "mariana.oliveira@email.com", "2000/02/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (75, "João Rodrigues", "Largo do Paço, Braga", 757575757, 987654321, "joao.rodrigues@email.com", "1989/07/12");


    -- MADEIRA
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (76, "Manuel Rodrigues", "Rua da Madeira, Funchal", 123456789, 912345678, "manuel.rodrigues@email.com", "1992/08/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (77, "Teresa Freitas", "Avenida do Mar, Machico", 987654321, 934567890, "teresa.freitas@email.com", "1987/12/18");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (78, "Hugo Sousa", "Estrada Regional, Caniçal", 555555555, 900000001, "hugo.sousa@email.com", "1996/03/27");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (79, "Isabel Fernandes", "Caminho das Voltas, Madeira", 111111111, 912345678, "isabel.fernandes@email.com", "1984/11/09");
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (80, "Sofia Pereira", "Estrada Regional, Funchal", 808080808, 923456789, "sofia.pereira@email.com", "1993/08/06");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (81, "Ricardo Costa", "Avenida do Mar, Machico", 818181818, 911223344, "ricardo.costa@email.com", "1980/01/15");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (82, "Marta Santos", "Estrada Regional, Caniçal", 828282828, 934567890, "marta.santos@email.com", "1995/05/28");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (83, "João Silva", "Caminho das Voltas, Porto Santo", 838383838, 912345678, "joao.silva@email.com", "1985/11/10");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (84, "Catarina Oliveira", "Travessa da Lombada, Funchal", 848484848, 900000001, "catarina.oliveira@email.com", "2000/02/20");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (85, "Hugo Martins", "Rua do Gorgulho, Funchal", 858585858, 987654321, "hugo.martins@email.com", "1989/07/08");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (86, "Mariana Rodrigues", "Avenida Sá Carneiro, Funchal", 868686868, 923456789, "mariana.rodrigues@email.com", "1992/12/06");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (87, "Diogo Costa", "Travessa da Rochinha, Câmara de Lobos", 878787878, 911223344, "diogo.costa@email.com", "1984/07/30");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (88, "Ana Oliveira", "Rua da Levada, Ribeira Brava", 888888888, 934567890, "ana.oliveira@email.com", "1997/11/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (89, "Rui Sousa", "Estrada João Gonçalves Zarco, Funchal", 898989898, 912345678, "rui.sousa@email.com", "1989/02/02");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (90, "Carolina Almeida", "Avenida do Mar e das Comunidades, Machico", 909090909, 900000001, "carolina.almeida@email.com", "2001/06/20");

     -- Guimarães
INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (91, "Luisa Carvalho", "Rua de Santo António, Guimarães", 666666666, 923456789, "luisa.carvalho@email.com", "1993/08/19");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (92, "Daniel Fernandes", "Avenida Dom João IV, Guimarães", 777777777, 911223344, "daniel.fernandes@email.com", "1980/01/31");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (93, "Beatriz Lima", "Travessa da Misericórdia, Guimarães", 888888888, 934567890, "beatriz.lima@email.com", "1997/06/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (94, "Miguel Santos", "Rua de São Torcato, Guimarães", 999999999, 912345678, "miguel.santos@email.com", "1985/11/25");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (95, "Catarina Pereira", "Avenida da Liberdade, Guimarães", 101010101, 900000001, "catarina.pereira@email.com", "2000/03/07");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (96, "Rui Martins", "Largo do Toural, Guimarães", 111111111, 987654321, "rui.martins@email.com", "1989/07/22");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (97, "Ana Sousa", "Rua da Caldeiroa, Guimarães", 121212121, 923456789, "ana.sousa@email.com", "1992/12/14");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (98, "Diogo Silva", "Avenida Conde Margaride, Guimarães", 131313131, 911223344, "diogo.silva@email.com", "1983/04/05");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (99, "Mariana Rodrigues", "Travessa da Tapada, Guimarães", 141414141, 934567890, "mariana.rodrigues@email.com", "1995/09/26");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (100, "João Costa", "Rua de São Cristóvão, Guimarães", 151515151, 912345678, "joao.costa@email.com", "1988/02/18");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (101, "Carolina Pereira", "Avenida Alberto Sampaio, Guimarães", 161616161, 900000001, "carolina.pereira@email.com", "2001/06/30");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (102, "Hugo Oliveira", "Travessa da Senhora da Penha, Guimarães", 171717171, 987654321, "hugo.oliveira@email.com", "1978/10/12");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (103, "Inês Almeida", "Rua de São Francisco, Guimarães", 181818181, 923456789, "ines.almeida@email.com", "1990/05/24");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (104, "Paulo Martins", "Avenida D. João IV, Guimarães", 191919191, 911223344, "paulo.martins@email.com", "1984/08/06");

INSERT INTO Pessoa (id, nome, morada, nif, nr_telemovel, email, data_nascimento) VALUES
    (105, "Mafalda Sousa", "Largo Condessa do Juncal, Guimarães", 202020202, 934567890, "mafalda.sousa@email.com", "1997/11/18");

    


-- FUNCIONÁRIOS
    -- PORTO
INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
     (1, 1, "Porto"); 

INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (2, 2, "Porto");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (3, 3, "Porto");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (4, 4, "Porto");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (5, 5, "Porto");

     -- AVEIRO
INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (25, 6, "Aveiro");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) Values
    (26, 7, "Aveiro");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) VALUES
    (27, 8, "Aveiro");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) VALUES
    (28, 9, "Aveiro");

INSERT INTO Funcionario (id, nr_funcionario, ginasio) VALUES
    (29, 10, "Aveiro");
