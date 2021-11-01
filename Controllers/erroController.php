<?php

    class erroController extends Controller{

        /*
        - Função: index
        - Parâmetros: Sem paramêtros
        - Objetivo: Chama o template para visualizar a página de erro após a tentativa de ir para uma página inexistente.
        */
        public function index(){
            $dados = array();
            $this->carregarTemplate('404/home',$dados,'404/templates/header','404/templates/footer');
        }
    }
?>