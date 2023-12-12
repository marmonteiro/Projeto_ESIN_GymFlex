<?php
#Guardar dados de uma pessoa 
  function insertPessoa($nome,$morada, $nif,$nr_telemovel, $email,$password, $data_nascimento) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Pessoa (nome,morada,nif,nr_telemovel, email, password, data_nascimento) VALUES(?,?,?,?,?,?)');
    $stmt->execute(array($nome,$morada, $nif,$nr_telemovel, $email, sha1($password), $data_nascimento));
  }

#Entrar
  function loginSuccess($email, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Person WHERE email = ? AND password = ?');
    $stmt->execute(array($email, sha1($password)));
    return $stmt->fetch();
  }

#Buscar o nome da pessoa pelo email
function getNamePersonByEmail($email){
    global $dbh;
    $stmt = $dbh->prepare('select name from person where email = ?');
    $stmt->execute(array($email));
    return $stmt->fetch()['name'];
}

function getNamePersonById($id){
  global $dbh;
  $stmt = $dbh->prepare('SELECT name from person where id = ?');
  $stmt->execute(array($id));
  return $stmt->fetch()['name'];
}

#Buscar a senha da pessoa pelo email
function getPassPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('select password from person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['password'];
}

function getLastIdPerson(){
  global $dbh;
  $stmt = $dbh->prepare('SELECT MAX(id) as maxi FROM Person');
  $stmt->execute();
  return $stmt->fetch()['maxi'];
}

function getPhonePersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT phone_number from person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['phone_number'];
}

function getBirthdayPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT birthdate from person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['birthdate'];
}

function getIdPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT id from person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['id'];
}

function updatePassPersonbyEmail($password,$email){       #nao esta a conseguir atualizar na base de dados
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Person set password = ? where email = ?');
  $stmt->execute(array(sha1($password),$email));
}

function updatePersonbyEmail($name,$birthdate,$phone_number,$email){
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Person set name = ?, birthdate =?, phone_number = ? where email = ?');
  $stmt->execute(array($name,$birthdate,$phone_number,$email));
}
