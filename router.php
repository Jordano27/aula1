<?php

$pagina = $_GET['pagina'] ?? false;
   
echo 'voce chegou ao seu destino</BR>';


require("{$pagina}.php");