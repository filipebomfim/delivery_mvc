<?php

    class indexController extends Controller{

        /*
        - Função: index
        - Parâmetros: Sem paramêtros
        - Objetivo: Chama o template para visualizar da página principal, onde o usuário escolherá entre entrar no painel ou no site de compras.
        */
        public function index(){
            require 'Views/home.php';
        }
    }
?>