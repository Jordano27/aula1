<?php

require('pdo.inc.php');

$user = $_POST['user'] ?? false;
$pass = $_POST['pass'] ?? false;
$email = $_POST['email'] ?? false;
$nome = $_POST['nome'] ?? false;
$ativo = $_POST['ativo'] ?? false;


if(!$user || !$pass || !$email || !$nome ){
    header('location:novo_usuario.php');
    die;
}


$pass = password_hash($pass, PASSWORD_BCRYPT);


$sql = $conex->prepare('INSERT INTO usuarios(username, senha, email, nome, ativo) values (:user, :pass, :email, :nome, :ativo)');

$sql->bindParam(':user', $user);
$sql->bindParam(':pass', $pass);
$sql->bindParam(':email', $email);
$sql->bindParam(':nome', $nome);
$sql->bindParam(':ativo', $ativo);


$sql->execute();

