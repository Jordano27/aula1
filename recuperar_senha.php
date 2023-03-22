<?php

    require('twig_carregar.php');
    require('pdo.inc.php');
    require('mailer.inc.php');

    $msg = '';

    //Rotina de POST - Recuperar senha
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'] ?? false;
        $sql = $conex->prepare('SELECT * FROM usuarios where username = ?');
        $sql->execute([$username]);
    
        if( $sql->rowCount()){
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);
            $token = uniqid(null, true) . bin2hex(random_bytes(16));
            
            $sql = $conex->prepare('UPDATE usuarios set recuperar_token = :token where id = :id_usr');

            $sql->execute([
                ':token' => $token,
                ':id_usr' => $usuario['id'],
            ]);
            $msg = 'Usuário Encontrado.';

            echo $twig->render('email_recupera_senha.html', [
                    'token' => $token
            ]);
            die;
        } else {
            $msg = 'Usuário não Encontrado.';
        }
    }

    echo $twig->render('recuperar_senha.html', [
        'msg' => $msg,

]);