<?php
    class Categoria{
        private $conexao;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        public function getCategorias(){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT * FROM tb_categoria"
            );
            $sql->execute();
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

        public function getCategoriaNome($cat_id){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT cat_nome FROM tb_categoria
                WHERE cat_id = ?"
            );
            $sql->execute(array(intval($cat_id)));
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }
    }
?>