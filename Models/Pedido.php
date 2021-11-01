<?php
    class Pedido{
        private $conexao;
        private $itens;
        private $horario;
        private $id;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        public function getItens(){
            return $this->itens;
        }

        public function setItens($itens){
            $this->itens = $itens;
        }

        public function getHorario(){
            return $this->horario;
        }

        public function setHorario($horario){
            $this->horario = $horario;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        
        /*
        - Função: addPedido
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e armazena as informações acerca de um pedido.
        */
        public function addPedido(){
            try {
                $sql = $this->conexao->prepare(
                    "INSERT INTO tb_pedido
                    VALUES (?,?)"
                );
                $sql->execute(array($this->id, $this->horario));

                foreach ($this->itens as $key => $value) {
                    $sql = $this->conexao->prepare(
                        "INSERT INTO tb_pedido_itens
                         VALUES (null,?,?,?)"
                    );
                    $sql->execute(array($this->id,$value['item_id'],$value['item_quantidade']));
                }                

                return true;
            } catch (\Throwable $th) {
                $_SESSION['status_msg'] = $th;
                return false;
            }
        }

        /*
        - Função: getPedidos
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna todos os pedidos armazenados.
        */
        public function getPedidos(){
                $dados = array();
                $sql = $this->conexao->prepare(
                    "SELECT * FROM tb_item i 
                    INNER JOIN tb_pedido_itens pi 
                    ON i.item_id = pi.pi_item_id
                    INNER JOIN tb_pedido p
                    ON p.pedido_id = pi.pi_pedido_id
                    INNER JOIN tb_categoria c
                    ON c.cat_id = i.item_categoria              
                ");
                $sql->execute();
                $dados = $sql->fetchall(PDO::FETCH_ASSOC);
                return $dados;
        }

        /*
        - Função: calcLucroTotal
        - Parâmetros: ARRAY - pedidos
        - Objetivo: Calcula o lucro obtido a partir da relação entre quantidade x preço, baseado em um array de pedidos informado como parâmetro.
        */
        public function calcLucroTotal($pedidos){
            $lucro = 0;
            foreach ($pedidos as $key => $value) {
                $lucro = ($value['pi_quantidade'] * $value['item_preco']) + $lucro;
            }
            return $lucro;
        }

        /*
        - Função: getPedidosDia
        - Parâmetros: DATE - data
        - Objetivo: Conecta-se ao banco de dados e retorna as informação acerca de todos os pedidos realizados em uma determinada data.
        */
        public function getPedidosDia($data){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT * FROM tb_item i 
                INNER JOIN tb_pedido_itens pi 
                ON i.item_id = pi.pi_item_id
                INNER JOIN tb_pedido p
                ON p.pedido_id = pi.pi_pedido_id
                INNER JOIN tb_categoria c
                ON c.cat_id = i.item_categoria
                where DATE(pedido_horario) = DATE(?)"
            );

            $sql->execute(array($data));
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

        /*
        - Função: getVendasDia
        - Parâmetros: DATE - data
        - Objetivo: Conecta-se ao banco de dados e retorna as informações de pedidos unitários em um determinado dia.
        */
        public function getVendasDia($data){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT p.pedido_id, p.pedido_horario, SUM(i.item_preco * pi.pi_quantidade) AS pedido_precototal

                FROM tb_item i 
                INNER JOIN tb_pedido_itens pi 
                ON i.item_id = pi.pi_item_id
                INNER JOIN tb_pedido p
                ON p.pedido_id = pi.pi_pedido_id
                INNER JOIN tb_categoria c
                ON c.cat_id = i.item_categoria
                where DATE(pedido_horario) = DATE(?)
                GROUP BY p.pedido_id"
            );

            $sql->execute(array($data));
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

    }
?>