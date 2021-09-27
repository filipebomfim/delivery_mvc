<?php

    class erroController extends Controller{
        public function index(){
            $dados = array();
            $this->carregarTemplate('painel/404',$dados,'painel/templates/header','painel/templates/footer');
        }
    }
?>