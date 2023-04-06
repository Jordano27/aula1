<?php

   require ('twig_carregar.php');
   require ('pdo.inc.php'); //conexão banco

      
   
    //rotina de POST - apagar usuário
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      //MODIFICA O USUARIO PARA ATIVO = 0

      $id = $_POST['id'] ?? false;
       
      die;
      if($id){
         
          $sql = $conex-> prepare('UPDATE usuarios SET ativo = 0 WHERE id = ?');
     $sql ->execute([$id]);
      }
         header('location:usuarios.php');
               die;
   }

   //rotina de GET - Mostrar informações na tela

     // Busca usuário no banco para mostrar o nome dele na tela
   

   $id = $_GET['id'] ?? false;
   $sql = $conex->prepare ('SELECT * FROM  usuarios WHERE id = ?');
   $sql -> execute([$id]);
   $usuario = $sql->fetch(PDO::FETCH_ASSOC);
   echo $twig->render('usuario_apagar.html', [
      'usuario' => $usuario,
   ]);
  
             