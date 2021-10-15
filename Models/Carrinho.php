<?php
    class Carrinho{
        private $conexao;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        public function addToCart($item){
            if(!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();
            $item['item_quantidade'] = 1;
            if(count($_SESSION['carrinho'])==0) array_unshift($_SESSION['carrinho'],$item);
            else{
                $retorno = false;
                    foreach ($_SESSION['carrinho'] as $key => $value) {
                        if($item['item_id'] == $value['item_id']){
                            $_SESSION['carrinho'][$key]['item_quantidade'] = $_SESSION['carrinho'][$key]['item_quantidade'] + 1;
                            $retorno = true;
                            break;
                        }
                    }

                    if($retorno == false) array_unshift($_SESSION['carrinho'],$item); 
            }
        }

        public function calcCart($carrinho){
            $valorCarrinho = 0;
            foreach ($carrinho as $key => $value) {
                $valorCarrinho = ($value['item_preco'] * $value['item_quantidade']) + $valorCarrinho;
            }
            return $valorCarrinho;
        }

        public function countItensCart($carrinho){
            $count = 0;
            foreach ($carrinho as $key => $value) {
                $count = $value['item_quantidade'] + $count;
            }

            return $count;
        }
    }
?>