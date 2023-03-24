<?php

    require ('twig_carregar.php');
    require('pdo.inc.php');

    $token = $_GET['token'] ?? $_POST['token'] ?? false;

    if(!$token){
        header('location:login.php');
        die;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $password = $_POST['senha'] ?? false;
        $password_confi = $_POST['senha_confirma'] ?? false;
        $password = trim($password);
        $password_confi = trim($password_confi);

        if($password == $password_confi){
            $sql = $conex->prepare('UPDATE usuarios set senha = :senha, recuperar_token = null where recuperar_token = :token');
            $sql->execute([':senha' => password_hash($password, PASSWORD_BCRYPT), ':token' => $token]);

            header('location:login.php?erro=3');
            die;
        } 

        $msg = 'Senhas diferentes, por favor digite novamente';

    }
    
    $sql = $conex->prepare('SELECT * FROM usuarios where recuperar_token = ?');
    $sql->execute([$token]);

    if($sql->rowCount() == 1){
        echo $twig-> render('recuperar_senha_escolher.html', ['token' => $token, 'msg'=>$msg ?? false]);

    } else{
        header('location:login.php');
        die;
    }