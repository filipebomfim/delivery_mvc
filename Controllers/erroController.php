<?php

    class erroController extends Controller{
        public function index(){
            $this->carregarTemplate('404');
        }
    }
?>