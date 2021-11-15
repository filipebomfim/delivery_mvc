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

        
        /*
        - Função: addToCart
        - Parâmetros: Sem parâmetros
        - Objetivo: Verifica todos os itens do carrinho (se houver) para adicionar um novo. Caso aquele item já esteja no carrinho, é adicionado +1 em sua quantidade. Caso não esteja, ele é adicionado com a quantidade 1.
        */
        public function addToCart(){
            if(!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();
            if(count($_SESSION['carrinho'])==0) array_unshift($_SESSION['carrinho'],$this->itens);
            else{
                $retorno = false;
                    foreach ($_SESSION['carrinho'] as $key => $value) {
                        if($this->itens['item_id'] == $value['item_id']){
                            $_SESSION['carrinho'][$key]['item_quantidade'] = $_SESSION['carrinho'][$key]['item_quantidade'] + $this->itens['item_quantidade'];
                            $retorno = true;
                            break;
                        }
                    }

                    if($retorno == false) array_unshift($_SESSION['carrinho'],$this->itens); 
            }
        }

        /*
        - Função: calcCart
        - Parâmetros: Sem parâmetros
        - Objetivo: Percorre cada item do carrinho e soma o preço de cada um deles para se obter o valor total daquele carrinho.
        */
        public function calcCart(){
            $valorCarrinho = 0;
            foreach ($this->itens as $key => $value) {
                $valorCarrinho = ($value['item_preco'] * $value['item_quantidade']) + $valorCarrinho;
            }
            return $valorCarrinho;
        }

        /*
        - Função: countItensCart
        - Parâmetros: Sem parâmetros
        - Objetivo: Percorre cada item do carrinho e, a partir da quantidade armazenada, é contado quantos itens unitários o carrinho possui.
        */
        public function countItensCart(){
            $count = 0;
            foreach ($this->itens as $key => $value) {
                $count = $value['item_quantidade'] + $count;
            }

            return $count;
        }
    }
?>