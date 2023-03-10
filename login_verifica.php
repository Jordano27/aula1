<?php
require('pdo.inc.php');
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    //cria aconsulta e aguarda os dados;
    $sql = $conex ->prepare('select * from usuarios where username = :usr');

//adiciona os dados na consulta

$sql->bindParam(':usr', $user);

$sql->execute();

//Se encontrou o usuário;

if ($sql->rowCount()) {
        //echo "login feito com sucesso"

$user  = $sql->fetch(PDO::FETCH_OBJ);

    //verificar se a senha esta correta

    if(!password_verify($pass, $user->senha)){

          
       header('location:login.php?erro=1');
       die;

    }

        //crisr uma sessaõ para armazenar o usuário
        session_start();
        $_SESSION ['user'] = $user->nome;
        header('location:boasvindas.php');
        die;
    } else {
       //falta o login"
       header('location:login.php?erro=1');
       die;
    }