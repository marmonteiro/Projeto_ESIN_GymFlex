
<?php
# TENHO DE VER ISTO MELHORGuardar dados de uma pessoa 
  function insertPerson($email,$name, $birthdate,$phone_number, $password, $enrollment_date) {
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Person (email, name, birthdate, phone_number, password, enrollment_date) VALUES(?,?,?,?,?,?)');
    $stmt->execute(array($email, $name, $birthdate, $phone_number, sha1($password),$enrollment_date));
  }

#Entrar
  function loginSuccess($email, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM Person WHERE email = ? AND password = ?');
    $stmt->execute(array($email, sha1($password)));
    return $stmt->fetch();
  }

#Guardar foto de perfil  
  function saveProfilePic($photo, $id) { 
    move_uploaded_file($photo["tmp_name"], "img/profiles/$id.jpg"); 
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

function getPhotoPersonByEmail($email){
  global $dbh;
  $stmt = $dbh->prepare('SELECT photo from person where email = ?');
  $stmt->execute(array($email));
  return $stmt->fetch()['photo'];
}

function getPhotoPersonById($id){
  global $dbh;
  $stmt = $dbh->prepare('SELECT photo from person where id = ?');
  $stmt->execute(array($id));
  return $stmt->fetch()['photo'];
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

function updateProfilePic($photo, $email){
  global $dbh;
  $stmt = $dbh->prepare('UPDATE Person set photo = ? where email = ?');
  $stmt->execute(array($photo,$email));
}

?>