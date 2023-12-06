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
    sexo VARCHAR(1),
    FOREIGN KEY (id) REFERENCES Pessoa(id),
    FOREIGN KEY (personaltrainer) REFERENCES Personaltrainer(id),
    FOREIGN KEY (nutricionista) REFERENCES Nutricionista(id),
    CHECK (peso > 0),
    CHECK (altura > 0)
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
    morada VARCHAR(255) NOT NULL UNIQUE,
    nome VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) UNIQUE,
    nr_telefone VARCHAR(20) UNIQUE,
    mapa_url VARCHAR(255),
    imagem_url VARCHAR(255)
);


-- Tabela Tipo
CREATE TABLE Tipo_p (
    nome VARCHAR(255) PRIMARY KEY,
    preco DECIMAL,
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
    FOREIGN KEY (tipo_p) REFERENCES Tipo_p(nome)
    --se um Membro tiver mais que uma data_adesao, então a diferença entre elas terá de ser superior ou igual a 5 meses:
    --CHECK ((SELECT COUNT(*) FROM Plano AS p WHERE p.membro = membro AND julianday('now') - julianday(data_adesao) < 150) <= 1) -- não funciona	
    
);

-- Tabela Aulagrupo
/* CREATE TABLE Aulagrupo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    qntd_membros INTEGER NOT NULL,
    ginasio INTEGER NOT NULL,
    tipo_ag INTEGER NOT NULL,
    FOREIGN KEY (tipo_ag) REFERENCES Tipo_ag(nome),
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id),
    CHECK (qntd_membros > 0)
    --CHECK (qntd_membros <= capacidade FROM Tipo_ag WHERE tipo_ag = Aulagrupo.tipo_ag) 
    imagem_ag VARCHAR(255)
);


CREATE TABLE Tipo_ag(
    nome VARCHAR(255) NOT NULL UNIQUE PRIMARY KEY,
    capacidade INT NOT NULL,
    dia_semana VARCHAR(255) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME,
    duracao_ag TIME, -- tou a assumir que cada tipo de aula tem data e horas fixas, acho q é mais simples
    CHECK (hora_fim IS NULL OR hora_fim > hora_inicio),
    CHECK (duracao_ag = strftime('%s', hora_fim) - strftime('%s', hora_inicio)),
    CHECK (capacidade > 0),
    imagem_aulagrupo VARCHAR(255)
);
 */

CREATE TABLE Aulagrupo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR(255) NOT NULL,
    data DATE,
    hora_inicio TIME NOT NULL,
    hora_fim TIME,
    duracao_ag TIME,
    capacidade INT NOT NULL,
    pt1 INTEGER NOT NULL,
    pt2 INTEGER NOT NULL,
    ginasio INTEGER NOT NULL,
    FOREIGN KEY (pt1) REFERENCES Personaltrainer(id),
    FOREIGN KEY (pt2) REFERENCES Personaltrainer(id),
    FOREIGN KEY (ginasio) REFERENCES Ginasio(id),
    CHECK (data IS NOT NULL),
    CHECK (hora_fim IS NULL OR hora_fim > hora_inicio),
    CHECK (duracao_ag = strftime('%s', hora_fim) - strftime('%s', hora_inicio)),
    CHECK (capacidade > 0)
);

-- Tabela Inscricao_ag
CREATE TABLE Inscricao_ag (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    qntd_membros INTEGER NOT NULL,
    membro INTEGER NOT NULL,
    aulagrupo INTEGER NOT NULL,
    FOREIGN KEY (membro) REFERENCES Membro(id),
    FOREIGN KEY (aulagrupo) REFERENCES Aulagrupo(id),
    CHECK (qntd_membros >= 0),
    CHECK (qntd_membros <= (SELECT capacidade FROM Aulagrupo WHERE Aulagrupo.id = Inscricao_ag.aulagrupo))
);
-- php: qntd_membros corresponde à soma de clientes que se inscreveram numa certa Aulagrupo


INSERT INTO Ginasio (id, morada, nome, email, nr_telefone, mapa_url, imagem_url)
VALUES 
  (1, 'Rua das Flores nº26', 'GymFlex Porto', 'gymflex.porto@gmail.com', '923524352','imagens/gymflexporto.png','imagens/porto.png'),
  (2, 'Rua 31 de janeiro nº 12', 'GymFlex Amarante','gymflex.amarante@gmail.com','934566789','imagens/gymflexamarante.png','imagens/gymflexamarante.png'),
  (3, 'Rua da Ajuda nº8','GymFlex Madeira','gymflex.madeira@gmail.com','934567890','imagens/gymflexmadeira.png','imagens/madeira.png');

INSERT INTO Pessoa (nome, morada, nif, nr_telemovel, email, data_nascimento) 
VALUES 
  ('João Silva', 'Rua Principal 123', 123456789, '912345678', 'joao@gmail.com', '1990-05-20'),
  ('Maria Sousa', 'Avenida Central 456', 987654321, '923456789', 'maria@hotmail.com', '1985-12-15'),
  ('Pedro Almeida', 'Rua das Flores 789', 246813579, '933456789', 'pedro@gmail.com', '1998-03-10'),
  ('Marta Santos', 'Travessa da Praia 357', 135792468, '944567890', 'marta@gmail.com', '2001-08-25'),
  ('Carlos Pereira', 'Avenida da Liberdade 789', 567891234, '955678901', 'carlos@hotmail.com', '1980-09-30'),
  ('Ana Rodrigues', 'Rua do Carmo 159', 987123456, '966789012', 'ana@gmail.com', '1995-06-18'),
  ('Rui Oliveira', 'Praça da República 753', 345678912, '977890123', 'rui@hotmail.com', '1978-11-05'),
  ('Sofia Costa', 'Largo do Rossio 951', 891234567, '988901234', 'sofia@gmail.com', '1992-04-30'),
  ('Jorge Fernandes', 'Rua do Comércio 246', 678912345, '999012345', 'jorge@gmail.com', '1987-02-12'),
  ('Inês Marques', 'Avenida dos Aliados 753', 456789123, '910123456', 'ines@gmail.com', '2000-10-08');

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


INSERT INTO Membro (pwd, peso, altura, imc, sexo ,personaltrainer, nutricionista)
VALUES 
  ('0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 70.5, 175, (70.5 / (1.75 * 1.75)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'Carlos Pereira'), (SELECT id FROM Pessoa WHERE nome = 'Sofia Costa')),
  ('6cf615d5bcaac778352a8f1f3360d23f02f34ec182e259897fd6ce485d7870d4', 65.0, 165, (65.0 / (1.65 * 1.65)), 'F' , (SELECT id FROM Pessoa WHERE nome = 'Ana Rodrigues'), (SELECT id FROM Pessoa WHERE nome = 'Jorge Fernandes')),
  ('5906ac361a137e2d286465cd6588ebb5ac3f5ae955001100bc41577c3d751764', 68.0, 160, (68.0 / (1.60 * 1.60)), 'M' , (SELECT id FROM Pessoa WHERE nome = 'Rui Oliveira'), (SELECT id FROM Pessoa WHERE nome = 'Inês Marques'));


INSERT INTO Tipo_p (nome, preco, tempo_treino, quantidade_ag)
VALUES 
  ('Básico', 20.00, 15, 5),
  ('Intermédio', 30.00, 30, 10),
  ('Avançado', 40.00, 55, 15);

INSERT INTO Plano (data_adesao, membro, tipo_p)
VALUES 
  ('2020-01-01', 1, 'Básico'),
  ('2020-01-02', 2, 'Intermédio'),
  ('2020-01-03', 3, 'Avançado');

-- Inserir dados na tabela Tipo_ag
INSERT INTO Tipo_ag (nome, capacidade, dia_semana, hora_inicio, hora_fim, duracao_ag, imagem_aulagrupo)
VALUES 
  ('Zumba', 18, 'Sexta-Feira', '17:30', '18:30', strftime('%s', '18:30') - strftime('%s', '17:30'), 'imagens/zumba.jpeg'),
  ('Cycling', 15, 'Segunda-Feira', '10:00', '11:30', strftime('%s', '11:30') - strftime('%s', '10:00'), 'imagens/cycling.jpeg'),
  ('Pilates', 10, 'Terça-Feira', '10:00', '11:30', strftime('%s', '11:30') - strftime('%s', '10:00'), 'imagens/pilates.jpeg'),
  ('Xpress Abs', 15, 'Sábado', '17:30', '18:30', strftime('%s', '18:30') - strftime('%s', '17:30'), 'imagens/xpressabs.jpeg'),
  ('Body Pump', 18, 'Quinta-Feira', '17:30', '18:30', strftime('%s', '18:30') - strftime('%s', '17:30'), 'imagens/bodypump.jpeg'),
  ('Body Step', 15, 'Quarta-Feira', '14:30', '15:30', strftime('%s', '15:30') - strftime('%s', '14:30'), 'imagens/bodystep.jpeg');

-- Inserir dados na tabela Aulagrupo
INSERT INTO Aulagrupo (qntd_membros, ginasio, tipo_ag, imagem_ag)
VALUES 
  (0, 1, 'Zumba', 'imagens/zumba.jpeg'),
  (0, 1, 'Cycling', 'imagens/cycling.jpeg'),
  (0, 1, 'Pilates', 'imagens/pilates.jpeg'),
  (0, 1, 'Xpress Abs', 'imagens/xpressabs.jpeg'),
  (0, 1, 'Body Pump', 'imagens/bodypump.jpeg'),
  (0, 1, 'Body Step', 'imagens/bodystep.jpeg');

/* INSERT INTO Aulagrupo (qntd_membros, ginasio, tipo_ag, imagem_ag)
VALUES 
  (0, 1, 'Zumba','imagens/zumba.jpeg'),
  (0, 1, 'Cycling','imagens/cycling.jpeg'),
  (0, 1, 'Pilates', 'imagens/pilates.jpeg'),
  (0, 1,'Xpress Abs','imagens/xpressabs.jpeg'),
  (0, 1, 'Body Pump', 'imagens/bodypump.jpeg'),
  (0, 1, 'Body Step','imagens/bodystep.jpeg');

INSERT INTO Tipo_ag (nome, capacidade, dia_semana, hora_inicio, hora_fim, imagem_aulagrupo)
VALUES 
  ('Pilates', 10, 'Terça-Feira', '10:00', '11:30', 'imagens/pilates.jpeg'),
  ('Cycling', 15,'Segunda-Feira', '10:00','11:30', 'imagens/cycling.jpeg'),
  ('Body Step', 15,'Quarta-Feira','14:30', '15:30', 'imagens/bodystep.jpeg'),
  ('Body Pump', 18,'Quinta-Feira', '17:30', '18:30', 'imagens/bodypump.jpeg'),
  ('Zumba', 18,'Sexta-Feira', '17:30', '18:30','imagens/zumba.jpeg'),
  /*('Yoga', 20, 'Sexta-Feira', '16:00','17:30'),*/
  ('Xpress Abs', 15,'Sábado', '17:30', '18:30','imagens/xpressabs.jpeg');

 */
