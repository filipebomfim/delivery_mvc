<?php 
    class Controller{
        public $dados;

        public function __construct()
        {
            $this->dados = array();
        }

        /*
        - Função: carregarTemplate
        - Parâmetros: ARRAY - dadosModel, STRING - header, STRING - footer
        - Objetivo: Carrega o template informado, juntamente com o caminho do seu header e do seu footer.
        */
        public function carregarTemplate($nomeView, $dadosModel = array(), $header = 'header',$footer = 'footer')
        {
            $this->dados = $dadosModel;
            require 'Views/'.$header.'.php';
            require 'Views/'.$footer.'.php';
        }

        /*
        - Função: carregarViewnoTemplate
        - Parâmetros: STRING - nomeview
        - Objetivo: Carrega o template informado.
        */
        public function carregarViewnoTemplate($nomeView)
        {
            require 'Views/'.$nomeView.'.php';
        }
    }
?>