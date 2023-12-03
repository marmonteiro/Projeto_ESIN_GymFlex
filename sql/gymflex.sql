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

-- Tabela Pessoa
CREATE TABLE Pessoa (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR(255) NOT NULL,
    morada VARCHAR(255) NOT NULL,
    nif INTEGER UNIQUE,
    nr_telemovel VARCHAR(20) UNIQUE,
    email VARCHAR(255) UNIQUE,
    data_nascimento DATE
);

-- Tabela Membro
CREATE TABLE Membro (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pwd VARCHAR(255) NOT NULL,
    peso DECIMAL NOT NULL,
    altura DECIMAL NOT NULL,
    imc DECIMAL,
    personaltrainer INTEGER,
    nutricionista INTEGER,
    inscricoes_ag INTEGER,
    FOREIGN KEY (id) REFERENCES Pessoa(id),
    FOREIGN KEY (personaltrainer) REFERENCES Personaltrainer(id),
    FOREIGN KEY (nutricionista) REFERENCES Nutricionista(id),
    CHECK (peso > 0),
    CHECK (altura > 0),
    CHECK (imc = peso / (altura * altura))
    --CHECK (TIMEDIFF('now', (SELECT data_nascimento FROM Pessoa WHERE id = Membro.id)) >= '16 years') Idade do membro é superior a 16 anos
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



-- Tabela Treino
CREATE TABLE Treino (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    data DATE,
    hora_entrada TIME,
    hora_saida TIME,
    duracao_t TIME,
    ginasio INTEGER NOT NULL,
    membro INTEGER NOT NULL,
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id),
    FOREIGN KEY (membro) REFERENCES Membro(id),
    UNIQUE (data, hora_entrada),
    CHECK (hora_saida IS NULL OR hora_saida > hora_entrada),
    CHECK (duracao_t = (strftime('%s', hora_saida) - strftime('%s', hora_entrada)))
);



-- Tabela Ginasio
CREATE TABLE Ginasio (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    morada VARCHAR(255) NOT NULL UNIQUE
);


-- Tabela Tipo
CREATE TABLE Tipo_p (
    preco DECIMAL PRIMARY KEY,
    tempo_treino INTEGER NOT NULL,
    quantidade_ag INTEGER NOT NULL,
    CHECK (preco > 0),
    CHECK (tempo_treino > 0),
    CHECK (quantidade_ag >= 0)

);
--falta: quantidade mensal de inscrições em Aulagrupo's de cada membro terá de ser inferior ou igual à quantidade_ag do Tipo de Plano escolhido pelo membro
--falta: soma mensal da duracao_t de cada Membro terá de ser inferior ou igual ao tempo_treino do Tipo de Plano escolhido pelo Membro

CREATE TABLE Plano (
    data_adesao DATE,
    membro INTEGER,
    tipo_p INTEGER,
    FOREIGN KEY (membro) REFERENCES Membro(id),
    FOREIGN KEY (tipo_p) REFERENCES Tipo_p(preco)
    --se um Membro tiver mais que uma data_adesao, então a diferença entre elas terá de ser superior ou igual a 5 meses:
    --CHECK ((SELECT COUNT(*) FROM Plano AS p WHERE p.membro = membro AND julianday('now') - julianday(data_adesao) < 150) <= 1) -- não funciona	
    
);



-- Tabela Aulagrupo
CREATE TABLE Aulagrupo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    qntd_membros INTEGER NOT NULL,
    ginasio INTEGER NOT NULL,
    tipo_ag VARCHAR(255) NOT NULL,
    FOREIGN KEY (tipo_ag) REFERENCES Tipo_ag(nome),
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id),
    CHECK (qntd_membros > 0)
    --CHECK (qntd_membros <= capacidade FROM Tipo_ag WHERE tipo_ag = Aulagrupo.tipo_ag) 
    
);

CREATE TABLE Tipo_ag(
    nome VARCHAR(255) PRIMARY KEY,
    capacidade INT NOT NULL,
    data_ag DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME,
    duracao_ag TIME, -- tou a assumir que cada tipo de aula tem data e horas fixas, acho q é mais simples
    CHECK (hora_fim IS NULL OR hora_fim > hora_inicio),
    CHECK (duracao_ag = (strftime('%s', hora_fim) - strftime('%s', hora_inicio))),
    CHECK (capacidade > 0)
);


-- php: qntd_membros corresponde à soma de clientes que se inscreveram numa certa Aulagrupo


INSERT INTO Ginasio (id, morada)
VALUES 
  (1, 'Morada Porto'),
  (2, 'Morada Madeira'),
  (3, 'Morada Amarante');

-- Add mock data to Pessoa table
INSERT INTO Pessoa (nome, morada, nif, nr_telemovel, email, data_nascimento) 
VALUES 
  ('João Silva', 'Rua Principal 123', 123456789, '912345678', 'joao@example.com', '1990-05-20'),
  ('Maria Sousa', 'Avenida Central 456', 987654321, '923456789', 'maria@example.com', '1985-12-15'),
  ('Pedro Almeida', 'Rua das Flores 789', 246813579, '933456789', 'pedro@example.com', '1998-03-10'),
  ('Marta Santos', 'Travessa da Praia 357', 135792468, '944567890', 'marta@example.com', '2001-08-25'),
  ('Carlos Pereira', 'Avenida da Liberdade 789', 567891234, '955678901', 'carlos@example.com', '1980-09-30'),
  ('Ana Rodrigues', 'Rua do Carmo 159', 987123456, '966789012', 'ana@example.com', '1995-06-18'),
  ('Rui Oliveira', 'Praça da República 753', 345678912, '977890123', 'rui@example.com', '1978-11-05'),
  ('Sofia Costa', 'Largo do Rossio 951', 891234567, '988901234', 'sofia@example.com', '1992-04-30'),
  ('Jorge Fernandes', 'Rua do Comércio 246', 678912345, '999012345', 'jorge@example.com', '1987-02-12'),
  ('Inês Marques', 'Avenida dos Aliados 753', 456789123, '910123456', 'ines@example.com', '2000-10-08');

INSERT INTO Funcionario (id, ginasio)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'),1),
  ((SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues'),2),
  ((SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'),3),
  ((SELECT id FROM Pessoa WHERE nome = 'Sofia Costa'),1),
  ((SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes'),2),
  ((SELECT id FROM Pessoa WHERE nome = 'Inês Marques'),3);


  INSERT INTO Personaltrainer (id)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira')),
  ((SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues')),
  ((SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'));

  INSERT INTO Nutricionista (id)
VALUES 
  ((SELECT id FROM Pessoa WHERE nome = 'Sofia Costa')),
  ((SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes')),
  ((SELECT id FROM Pessoa WHERE nome = 'Inês Marques'));


INSERT INTO Membro (pwd, peso, altura, imc, personaltrainer, nutricionista)
VALUES 
  ('0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 70.5, 1.75, (70.5 / (1.75 * 1.75)), (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'), (SELECT id FROM Pessoa WHERE nome = 'Sofia Costa')),
  ('6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4', 65.0, 1.65, (65.0 / (1.65 * 1.65)), (SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues'), (SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes')),
  ('5906ac361a137e2d286465cd6588ebb5ac3f5ae955001100bc41577c3d751764', 68.0, 1.60, (68.0 / (1.60 * 1.60)), (SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'), (SELECT id FROM Pessoa WHERE nome = 'Inês Marques'));




INSERT INTO Tipo_p (preco, tempo_treino, quantidade_ag)
VALUES 
  (20.00, 20, 5),
  (30.00, 40, 10),
  (40.00, 60, 15);

INSERT INTO Plano (data_adesao, membro, tipo_p)
VALUES 
  ('2020-01-01', 1, 20.00),
  ('2020-01-02', 2, 30.00)
  ('2020-01-03', 3, 40.00);

INSERT INTO Tipo_ag (nome, capacidade, data_ag, hora_inicio, hora_fim)
VALUES 
  ('Zumba', 20, '2020-01-01', '10:00:00', '11:00:00'),
  ('Yoga', 15, '2020-01-01', '11:00:00', '12:00:00'),
  ('Pilates', 10, '2020-01-01', '12:00:00', '13:00:00');

INSERT INTO Aulagrupo (qntd_membros, ginasio, tipo_ag)
VALUES 
  (2, 1, 'Zumba'),
  (1, 1, 'Yoga'),
  (1, 2, 'Pilates');