<?php

    class siteController extends Controller{
        public function index(){
            $dados = array();
            $this->carregarTemplate('site/home',$dados,'site/templates/header','site/templates/footer');
        }
    }
?>