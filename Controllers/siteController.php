<?php

    class siteController extends Controller{

        /*
        - Função: index
        - Parâmetros: Sem paramêtros
        - Objetivo: Chama o template para visualizar a página principal do site.
        */
        public function index(){
            $dados = array();
            $this->carregarTemplate('site/home',$dados,'site/templates/header','site/templates/footer');
        }
    }
?>