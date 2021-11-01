<?php
    class Categoria{
        private $conexao;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        /*
        - Função: getCategorias
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna todos os valores armazenados na tabela tb_categoria.
        */
        public function getCategorias(){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT * FROM tb_categoria"
            );
            $sql->execute();
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

        /*
        - Função: getCategoriaNome
        - Parâmetros: INTEIRO - cat_id
        - Objetivo: Conecta-se ao banco de dados e retorna o valor armazenado referente ao nome de uma categoria associoado ao id que foi passado como parâmetro.
        */
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