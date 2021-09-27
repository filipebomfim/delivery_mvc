<?php

    class siteController extends Controller{
        public function index(){
            $dados = array();
            $this->carregarTemplate('site/home',$dados,'painel/templates/header','painel/templates/footer');
        }
    }
?>