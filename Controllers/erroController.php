<?php

    class erroController extends Controller{
        public function index(){
            $dados = array();
            $this->carregarTemplate('404/home',$dados,'404/templates/header','404/templates/footer');
        }
    }
?>