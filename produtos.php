<?php

    require('vendor/autoload.php');

    $loader = new \Twig\Loader\FilesystemLoader('./templates');

    $twig = new \Twig\Environment($loader);
      

    $template = $twig->load('produtos.html');

    $produtos = [
        [
            'nome' => 'chinelo',
            'preço' => 30,
        ],

        [
            'nome' => 'camiseta',
            'preço' => 50,         
        ],

        [
            'nome' => 'Boné',
            'preço' => 39.9,         
        ],
        
        [
            'nome' => 'Air Jordan',
            'preço' => 699.99,         
        ]
    ];
    echo $template -> render([

        'titulo' => 'Produtos',
        'produtos' => $produtos,
        
    ]);
