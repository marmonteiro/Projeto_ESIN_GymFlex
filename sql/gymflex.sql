DROP TABLE IF EXISTS Pessoa;
DROP TABLE IF EXISTS Membro;
DROP TABLE IF EXISTS Funcionario;
DROP TABLE IF EXISTS Personaltrainer;
DROP TABLE IF EXISTS Nutricionista;
DROP TABLE IF EXISTS Treino;
DROP TABLE IF EXISTS Ginasio;
DROP TABLE IF EXISTS Plano;
DROP TABLE IF EXISTS Tipo_p;
DROP TABLE IF EXISTS Aulagrupo;
DROP TABLE IF EXISTS Tipo_ag;
DROP TABLE IF EXISTS Inscricao_ag;


-- Tabela Pessoa
CREATE TABLE Pessoa (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    morada TEXT NOT NULL,
    nif INTEGER UNIQUE,
    nr_telemovel INTEGER,
    email TEXT UNIQUE,
    data_nascimento DATE
);

-- Tabela Membro
CREATE TABLE Membro (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pwd TEXT NOT NULL,
    peso DECIMAL NOT NULL,
    altura DECIMAL NOT NULL,
    imc DECIMAL,
    personaltrainer INTEGER,
    nutricionista INTEGER,
    sexo TEXT NOT NULL,
    iban TEXT NOT NULL,
    FOREIGN KEY (id) REFERENCES Pessoa(id) ON DELETE CASCADE,
    FOREIGN KEY (personaltrainer) REFERENCES Personaltrainer(id),
    FOREIGN KEY (nutricionista) REFERENCES Nutricionista(id),
    CHECK (peso > 0),
    CHECK (altura > 0)
);

-- Tabela Funcionario
CREATE TABLE Funcionario (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ginasio INTEGER NOT NULL,
    FOREIGN KEY (id) REFERENCES Pessoa(id),
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id)
);

-- Tabela Personaltrainer
CREATE TABLE Personaltrainer (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    FOREIGN KEY (id) REFERENCES Funcionario(id)
);

-- Tabela Nutricionista
CREATE TABLE Nutricionista (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    FOREIGN KEY (id) REFERENCES Funcionario(id)
);



-- Tabela Treino // n sei oq fazer com esta tabela...
CREATE TABLE Treino (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data DATE,
    hora_entrada TIME,
    hora_saida TIME,
    duracao_t TIME,
    ginasio INTEGER NOT NULL,
    membro INTEGER NOT NULL,
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id),
    FOREIGN KEY (membro) REFERENCES Membro(id) ON DELETE CASCADE,
    UNIQUE (data, hora_entrada),
    CHECK (hora_saida IS NULL OR hora_saida > hora_entrada)
);


-- Tabela Ginasio
CREATE TABLE Ginasio (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    morada TEXT NOT NULL UNIQUE,
    nome TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    nr_telefone INTEGER NOT NULL UNIQUE,
    mapa_url TEXT,
    imagem_url TEXT
);


-- Tabela Tipo
CREATE TABLE Tipo_p (
    nome TEXT PRIMARY KEY,
    preco DECIMAL,
    tempo_treino INTEGER NOT NULL,
    quantidade_ag INTEGER NOT NULL,
    CHECK (preco > 0),
    CHECK (tempo_treino > 0),
    CHECK (quantidade_ag >= 0)

);
--falta: soma mensal da duracao_t de cada Membro terá de ser inferior ou igual ao tempo_treino do Tipo de Plano escolhido pelo Membro

CREATE TABLE Plano (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data_adesao DATE NOT NULL,
    membro INTEGER NOT NULL,
    tipo_p INTEGER NOT NULL,
    FOREIGN KEY (membro) REFERENCES Membro(id) ON DELETE CASCADE,
    FOREIGN KEY (tipo_p) REFERENCES Tipo_p(nome)
    --se um Membro tiver mais que uma data_adesao, então a diferença entre elas terá de ser superior ou igual a 5 meses:
    --CHECK ((SELECT COUNT(*) FROM Plano AS p WHERE p.membro = membro AND julianday('now') - julianday(data_adesao) < 150) <= 1) -- não funciona	
    
);

-- Tabela Aulagrupo
CREATE TABLE Aulagrupo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data DATE NOT NULL,
    qntd_membros INTEGER NOT NULL,
    ginasio INTEGER NOT NULL,
    tipo_ag INTEGER NOT NULL,
    FOREIGN KEY (tipo_ag) REFERENCES Tipo_ag(nome),
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id)
);


CREATE TABLE Tipo_ag(
    nome TEXT NOT NULL PRIMARY KEY,
    capacidade INTEGER NOT NULL,
    dia_semana TEXT NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME,
    duracao_ag TIME, 
    imagem_ag TEXT,
    CHECK (hora_fim IS NULL OR hora_fim > hora_inicio),
    CHECK (capacidade > 0)
);


-- Tabela Inscricao_ag
CREATE TABLE Inscricao_ag (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    membro INTEGER NOT NULL,
    aulagrupo INTEGER NOT NULL,
    FOREIGN KEY (membro) REFERENCES Membro(id) ON DELETE CASCADE,
    FOREIGN KEY (aulagrupo) REFERENCES Aulagrupo(id)
);





INSERT INTO Ginasio (id, morada, nome, email, nr_telefone, mapa_url, imagem_url)
VALUES 
  (1, 'Rua das Flores nº26', 'GymFlex Porto', 'gymflex.porto@gmail.com', '923524352','imagens/clubes/gymflexporto.png','imagens/clubes/porto.png'),
  (2, 'Rua 31 de janeiro nº 12', 'GymFlex Amarante','gymflex.amarante@gmail.com','934566789','imagens/clubes/gymflexamarante.png','imagens/clubes/amarante.png'),
  (3, 'Rua da Ajuda nº8','GymFlex Madeira','gymflex.madeira@gmail.com','934567890','imagens/clubes/gymflexmadeira.png','imagens/clubes/madeira.png');

INSERT INTO Pessoa (nome, morada, nif, nr_telemovel, email, data_nascimento) 
VALUES 
  ('João Silva', 'Rua Principal 123', 123456789, '912345678', 'joao@gmail.com', '1990-05-20'),
  ('Maria Sousa', 'Avenida Central 456', 987654321, '923456789', 'maria@hotmail.com','1985-12-15'),
  ('Pedro Almeida', 'Rua das Flores 789', 246813579, '933456789', 'pedro@gmail.com', '1998-03-10'),
  ('Marta Santos', 'Travessa da Praia 357', 135792468, '944567890', 'marta@gmail.com', '2001-08-25'),
  ('Carlos Pereira', 'Avenida da Liberdade 789', 567891234, '955678901', 'carlos@hotmail.com', '1980-09-30'),
  ('Ana Rodrigues', 'Rua do Carmo 159', 987123456, '966789012', 'ana@gmail.com', '1995-06-18'),
  ('Rui Oliveira', 'Praça da República 753', 345678912, '977890123', 'rui@hotmail.com', '1978-11-05'),
  ('Sofia Costa', 'Largo do Rossio 951', 891234567, '988901234', 'sofia@gmail.com', '1992-04-30'),
  ('Jorge Fernandes', 'Rua do Comércio 246', 678912345, '999012345', 'jorge@gmail.com', '1987-02-12'),
  ('Inês Marques', 'Avenida dos Aliados 753', 456789123, '910123456', 'ines@gmail.com', '2000-10-08'),
  ('Manuel Pereira', 'Rua das Oliveiras 852', 852369741, '922334455', 'manuel@gmail.com', '1975-07-14'),
  ('Luisa Costa', 'Avenida dos Plátanos 159', 369852147, '933445566', 'luisa@hotmail.com', '1989-09-22'),
  ('André Santos', 'Travessa das Amendoeiras 753', 987654123, '944556677', 'andre@gmail.com', '1993-03-30'),
  ('Teresa Oliveira', 'Rua das Flores 357', 147258369, '955667788', 'teresa@hotmail.com', '1983-11-18'),
  ('Ricardo Fernandes', 'Avenida Central 951', 258369147, '966778899', 'ricardo@gmail.com', '1970-01-25'),
  ('Lara Marques', 'Praça da Liberdade 456', 369147258, 977889900, 'lara@hotmail.com', '1998-12-03'),
  ('Hugo Silva', 'Largo da Sé 753', 951753852, 988990011, 'hugo@gmail.com', '1982-06-09'),
  ('Catarina Rodrigues', 'Rua dos Cedros 852', 753951852, 999011122, 'catarina@hotmail.com', '1997-04-15'),
  ('Daniel Almeida', 'Avenida das Rosas 357', 159753852, 910112233, 'daniel@gmail.com', '2002-08-20'),
  ('Mariana Sousa', 'Travessa das Acácias 753', 753159753, 921122334, 'mariana@hotmail.com', '1991-12-28');


INSERT INTO Funcionario (id, ginasio)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'), 1),
  ((SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues'), 2),
  ((SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'), 3),
  ((SELECT id FROM Pessoa WHERE nome = 'Sofia Costa'), 1),
  ((SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes'), 2),
  ((SELECT id FROM Pessoa WHERE nome = 'Inês Marques'), 3),
  ((SELECT id FROM Pessoa WHERE nome = 'Manuel Pereira'), 1),
  ((SELECT id FROM Pessoa WHERE nome = 'Luisa Costa'), 2),
  ((SELECT id FROM Pessoa WHERE nome = 'André Santos'), 3),
  ((SELECT id FROM Pessoa WHERE nome = 'Teresa Oliveira'), 1),
  ((SELECT id FROM Pessoa WHERE nome = 'Ricardo Fernandes'), 2),
  ((SELECT id FROM Pessoa WHERE nome = 'Lara Marques'), 3);

INSERT INTO Personaltrainer (id)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira')),
  ((SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues')),
  ((SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira')),
  ((SELECT id FROM Pessoa WHERE nome = 'Manuel Pereira')),
  ((SELECT id FROM Pessoa WHERE nome = 'Luisa Costa')),
  ((SELECT id FROM Pessoa WHERE nome = 'André Santos'));

INSERT INTO Nutricionista (id)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Sofia Costa')),
  ((SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes')),
  ((SELECT id FROM Pessoa WHERE nome = 'Inês Marques')),
  ((SELECT id FROM Pessoa WHERE nome = 'Teresa Oliveira')),
  ((SELECT id FROM Pessoa WHERE nome = 'Ricardo Fernandes')),
  ((SELECT id FROM Pessoa WHERE nome = 'Lara Marques'));

INSERT INTO Membro (pwd, peso, altura, imc, sexo ,personaltrainer, nutricionista, iban)
VALUES 
  ('0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 70.5, 175, (70.5 / (1.75 * 1.75)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'), (SELECT id FROM Pessoa WHERE nome = 'Sofia Costa'),'PT38502761940287651290341'),
  ('6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4', 65.0, 165, (65.0 / (1.65 * 1.65)), 'F' , (SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues'), (SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes'),'PT74091283509127350912387'),
  ('5906ac361a137e2d286465cd6588ebb5ac3f5ae955001100bc41577c3d751764', 68.0, 160, (68.0 / (1.60 * 1.60)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'), (SELECT id FROM Pessoa WHERE nome = 'Inês Marques'),'PT15678902347658901234567'),
  ('42f99c0763c83212b6bc55fc40de5a2c6eefc3ebdfc0912c75b52402a72b2a1a', 75.0, 180, (75.0 / (1.80 * 1.80)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'Manuel Pereira'), (SELECT id FROM Pessoa WHERE nome = 'Teresa Oliveira'),'PT23589654785091234567890'),
  ('c0b68fe8e9a7e88aae155fe4f10dc312af18f2542758f1b8f882f544a11e20cc', 60.0, 170, (60.0 / (1.70 * 1.70)), 'F' , (SELECT id FROM Pessoa WHERE nome = 'Luisa Costa'), (SELECT id FROM Pessoa WHERE nome = 'Ricardo Fernandes'),'PT98765432109876543210987'),
  ('9a78a68f68c4586a8959685241fe28a8f94a3e867d6b8591458dfc941d5421d4', 70.0, 175, (70.0 / (1.75 * 1.75)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'André Santos'), (SELECT id FROM Pessoa WHERE nome = 'Lara Marques'),'PT56789012345678901234567');


INSERT INTO Tipo_p (nome, preco, tempo_treino, quantidade_ag)
VALUES 
  ('Básico', 20.00, 15, 5),
  ('Intermédio', 30.00, 30, 10),
  ('Avançado', 40.00, 55, 15);

INSERT INTO Plano (data_adesao, membro, tipo_p)
VALUES 
  ('2023-07-01', (SELECT id FROM Pessoa WHERE nome = 'João Silva'), 'Básico'),
  ('2022-11-02', (SELECT id FROM Pessoa WHERE nome = 'Maria Sousa'), 'Intermédio'),
  ('2023-03-03', (SELECT id FROM Pessoa WHERE nome = 'Pedro Almeida'), 'Avançado'),
  ('2023-01-15', (SELECT id FROM Pessoa WHERE nome = 'Marta Santos'), 'Básico'),
  ('2023-08-20', (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'), 'Intermédio');

-- Inserir dados na tabela Tipo_ag
INSERT INTO Tipo_ag (nome, capacidade, dia_semana, hora_inicio, hora_fim, duracao_ag, imagem_ag)
VALUES 
  ('Cycling', 15, 'Segunda-Feira', '10:00', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:00')) / 3600.0, 'imagens/aulasgrupo/cycling.png'),
  ('Pilates', 10, 'Terça-Feira', '10:00', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:00')) / 3600.0, 'imagens/aulasgrupo/pilates.png'),
  ('Body Step', 15, 'Quarta-Feira', '14:30', '15:30', (strftime('%s', '15:30') - strftime('%s', '14:30')) / 3600.0, 'imagens/aulasgrupo/bodystep.png'),
  ('Body Pump', 20, 'Quinta-Feira', '17:30', '18:30', (strftime('%s', '18:30') - strftime('%s', '17:30')) / 3600.0, 'imagens/aulasgrupo/bodypump.png'),
  ('Zumba', 20, 'Sexta-Feira', '17:30', '18:30', (strftime('%s', '18:30') - strftime('%s', '17:30')) / 3600.0, 'imagens/aulasgrupo/zumba.png'),
  ('Xpress Abs', 15, 'Sábado', '17:30', '18:30', (strftime('%s', '18:30') - strftime('%s', '17:30')) / 3600.0, 'imagens/aulasgrupo/xpressabs.png');


-- Inserir dados na tabela Aulagrupo
INSERT INTO Aulagrupo (data, qntd_membros, ginasio, tipo_ag)
VALUES 
  ('2023-12-25', 15, 1, 'Cycling'),
  ('2023-12-26', 0, 1, 'Pilates'),  
  ('2023-12-27', 0, 1, 'Body Step'),
  ('2023-12-28', 0, 1, 'Body Pump'),
  ('2023-12-29', 0, 1, 'Zumba'),
  ('2023-12-30', 0, 1, 'Xpress Abs'),
  ('2023-12-25', 0, 2, 'Cycling'),
  ('2023-12-26', 0, 2, 'Pilates'),  
  ('2023-12-27', 0, 2, 'Body Step'),
  ('2023-12-28', 0, 2, 'Body Pump'),
  ('2023-12-29', 0, 2, 'Zumba'),
  ('2023-12-30', 0, 2, 'Xpress Abs'),
  ('2023-12-25', 0, 3, 'Cycling'),
  ('2023-12-26', 0, 3, 'Pilates'),  
  ('2023-12-27', 0, 3, 'Body Step'),
  ('2023-12-28', 0, 3, 'Body Pump'),
  ('2023-12-29', 0, 3, 'Zumba'),
  ('2023-12-30', 0, 3, 'Xpress Abs');

-- Inserir dados na tabela Inscricao_ag
INSERT INTO Inscricao_ag (membro, aulagrupo)
VALUES
((SELECT id FROM Pessoa WHERE nome = 'João Silva'), 2);

-- Inserir dados na tabela Treino
  INSERT INTO Treino (data, hora_entrada, hora_saida, duracao_t, ginasio, membro)
VALUES 
  ('2023-12-01', '10:00', '11:00', (strftime('%s', '11:00') - strftime('%s', '10:00')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'João Silva')),
  ('2023-12-07', '09:30', '10:30', (strftime('%s', '10:30') - strftime('%s', '09:30')) / 3600.0, 2, (SELECT id FROM Pessoa WHERE nome = 'João Silva')),
  ('2023-12-14', '11:00', '12:00', (strftime('%s', '12:00') - strftime('%s', '11:00')) / 3600.0, 3, (SELECT id FROM Pessoa WHERE nome = 'João Silva')),
  ('2023-12-20', '10:00', '11:00', (strftime('%s', '11:00') - strftime('%s', '10:00')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'João Silva')),

  ('2023-12-05', '10:30', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:30')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'Maria Sousa')),
  ('2023-12-06', '10:00', '11:00', (strftime('%s', '11:00') - strftime('%s', '10:00')) / 3600.0, 2, (SELECT id FROM Pessoa WHERE nome = 'Maria Sousa')),
  ('2023-12-17', '09:00', '10:00', (strftime('%s', '10:00') - strftime('%s', '09:00')) / 3600.0, 3, (SELECT id FROM Pessoa WHERE nome = 'Maria Sousa')),
  ('2023-12-20', '11:30', '12:30', (strftime('%s', '12:30') - strftime('%s', '11:30')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'Maria Sousa')),

  ('2023-12-04', '09:00', '10:00', (strftime('%s', '10:00') - strftime('%s', '09:00')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'Pedro Almeida')),
  ('2023-12-07', '11:30', '12:30', (strftime('%s', '12:30') - strftime('%s', '11:30')) / 3600.0, 2, (SELECT id FROM Pessoa WHERE nome = 'Pedro Almeida')),
  ('2023-12-09', '08:30', '09:30', (strftime('%s', '09:30') - strftime('%s', '08:30')) / 3600.0, 3, (SELECT id FROM Pessoa WHERE nome = 'Pedro Almeida')),

  ('2023-12-01', '11:30', '12:30', (strftime('%s', '12:30') - strftime('%s', '11:30')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'Marta Santos')),
  ('2023-12-02', '09:00', '10:00', (strftime('%s', '10:00') - strftime('%s', '09:00')) / 3600.0, 2, (SELECT id FROM Pessoa WHERE nome = 'Marta Santos')),
  ('2023-12-03', '10:30', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:30')) / 3600.0, 3, (SELECT id FROM Pessoa WHERE nome = 'Marta Santos')),

  ('2023-12-05', '09:30', '10:30', (strftime('%s', '10:30') - strftime('%s', '09:30')) / 3600.0, 1, (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira')),
  ('2023-12-07', '10:30', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:30')) / 3600.0, 2, (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira')),
  ('2023-12-18', '10:30', '11:30', (strftime('%s', '11:30') - strftime('%s', '10:30')) / 3600.0, 3, (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'));

