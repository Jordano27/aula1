<?php

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if ($user == 'jordano' && $pass == '3453') {
        //echo "login feito com sucesso"
        //crisr uma sessaõ para armazenar o usuário
        session_start();
        $_SESSION ['user'] = 'Jordano';
        header('location:boasvindas.php');
        die;
    } else {
       //falta o login"
       header('location:login.php?erro=1');
       die;
    }