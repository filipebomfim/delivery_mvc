<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    spl_autoload_register(function($arquivo){
        if(file_exists('Controllers/'.$arquivo.'.php')) require 'Controllers/'.$arquivo.'.php';
        else if (file_exists('Models/'.$arquivo.'.php')) require 'Models/'.$arquivo.'.php';
        else if (file_exists('Core/'.$arquivo.'.php')) require 'Core/'.$arquivo.'.php';
    });

    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','sistema_estoque');

    define('CADASTRO',1);
    define('EXCLUSÃO',2);
    define('ALTERAÇÃO',3);
    define('VENDA',4);

    define('INCLUDE_PATH','http://192.168.100.7/portfolio/sistema_estoque/');
    define('BASE_DIR',__DIR__.'/');
?>