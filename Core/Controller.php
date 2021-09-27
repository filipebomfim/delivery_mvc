<?php 
    class Controller{
        public $dados;

        public function __construct()
        {
            $this->dados = array();
        }

        public function carregarTemplate($nomeView, $dadosModel = array(), $header = 'header',$footer = 'footer')
        {
            $this->dados = $dadosModel;
            require 'Views/'.$header.'.php';
            require 'Views/'.$footer.'.php';
        }

        public function carregarViewnoTemplate($nomeView, $dadosModel = array())
        {
            //extract($dadosModel);
            require 'Views/'.$nomeView.'.php';
        }
    }
?>