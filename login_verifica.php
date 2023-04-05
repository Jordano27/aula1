<?php
session_start();
require('pdo.inc.php');
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    //cria aconsulta e aguarda os dados;
    $sql = $conex ->prepare('select * from alunos where nome = :nome ');

//adiciona os dados na consulta

$sql->bindParam(':nome', $user);

$sql->execute();

//Se encontrou o usuário;

if ($sql->rowCount()) {
        //echo "login feito com sucesso"

$user  = $sql->fetch(PDO::FETCH_ASSOC);

    //verificar se a senha esta correta

    if($pass !== (string)$user['idCurso']){
        
       header('location:login.php?erro=1');
       die;

    }

        //crisr uma sessaõ para armazenar o usuário
        
        $_SESSION ['user'] = $user['nome'];
        header('location:boasvindas.php');
        die;
    } else {
       //falta o login"
       die('erro');
       header('location:login.php?erro=1');
       die;
    }