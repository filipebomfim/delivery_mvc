<?php 
    class Painel{

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }
    }
?>