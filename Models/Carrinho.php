<?php
    class Carrinho{
        private $conexao;
        private $itens;

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

        public function addToCart(){
            if(!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();
            $this->itens['item_quantidade'] = 1;
            if(count($_SESSION['carrinho'])==0) array_unshift($_SESSION['carrinho'],$this->itens);
            else{
                $retorno = false;
                    foreach ($_SESSION['carrinho'] as $key => $value) {
                        if($this->itens['item_id'] == $value['item_id']){
                            $_SESSION['carrinho'][$key]['item_quantidade'] = $_SESSION['carrinho'][$key]['item_quantidade'] + 1;
                            $retorno = true;
                            break;
                        }
                    }

                    if($retorno == false) array_unshift($_SESSION['carrinho'],$this->itens); 
            }
        }

        public function calcCart(){
            $valorCarrinho = 0;
            foreach ($this->itens as $key => $value) {
                $valorCarrinho = ($value['item_preco'] * $value['item_quantidade']) + $valorCarrinho;
            }
            return $valorCarrinho;
        }

        public function countItensCart(){
            $count = 0;
            foreach ($this->itens as $key => $value) {
                $count = $value['item_quantidade'] + $count;
            }

            return $count;
        }
    }
?>