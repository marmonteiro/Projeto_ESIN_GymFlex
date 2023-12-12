<?php
#Guardar dados de uma pessoa duvida faço isto com a tabela pessoa ou melhor com a tabela membro????
  function insertPessoa($nome,$morada, $nif,$nr_telemovel, $email,$password, $data_nascimento) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Pessoa (nome,morada,nif,nr_telemovel, email, password, data_nascimento) VALUES(?,?,?,?,?,?)');
    $stmt->execute(array($nome,$morada, $nif,$nr_telemovel, $email, sha1($password), $data_nascimento));
  }

#Entrar
  function loginSuccess($email, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Pessoa WHERE email = ? AND password = ?');
    $stmt->execute(array($email, sha1($password)));
    return $stmt->fetch();
  }

#Buscar o nome da pessoa pelo email
function getNamePersonByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('SELECT nome FROM pessoa where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['nome'];
}

function getNamePersonById($id){
  global $dbh;
  $stmt = $dbh->prepare('SELECT nome from Pessoa where id = ?');
  $stmt->execute(array($id));
  return $stmt->fetch()['nome'];
}

#Buscar a senha da pessoa pelo email
function getPassPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT password FROM Pessoa where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['password'];
}

function getLastIdPerson(){
  global $dbh;
  $stmt = $dbh->prepare('SELECT MAX(id) as maxi FROM Pessoa');
  $stmt->execute();
  return $stmt->fetch()['maxi'];
}

function getPhonePersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT nr_telemovel from Person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['nr_telemovel'];
}

function getBirthdayPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT data_nascimento from Person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['data_nascimento'];
}

function getIdPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT id from Person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['id'];
}

function updatePassPersonbyEmail($password,$email){       #nao esta a conseguir atualizar na base de dados
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Person set password = ? where email = ?');
  $stmt->execute(array(sha1($password),$email));
}

function updatePersonbyEmail($nome,$data_nascimento,$nr_telemovel,$email){
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Person set nome = ?, data_nascimento =?, nr_telemovel = ? where email = ?');
  $stmt->execute(array($nome,$data_nascimento,$nr_telemovel,$email));
}
