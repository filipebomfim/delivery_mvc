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
    }
?>