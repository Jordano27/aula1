<?php

    require('vendor/autoload.php');

    $loader = new \Twig\Loader\FilesystemLoader('./templates');

    $twig = new \Twig\Environment($loader);
      

    $template = $twig->load('teste.html');
    echo $template -> render([

        'nome' => 'Jordano',
        'idade' => 17,
        'titulo' => 'Título',
        
    ]);

