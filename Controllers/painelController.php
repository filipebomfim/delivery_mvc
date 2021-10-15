<?php

    class painelController extends Controller{
        public function index(){
            $dados = array();
            $item = new Item();
            $dados['qtdItens'] = $item->contarItens();
            $log = new Log();
            $dados['log'] = $log->getRegistros();
            $this->carregarTemplate('painel/home',$dados,'painel/templates/header','painel/templates/footer');
        }

        public function calcLucroTotal(){
            $p = new Pedido();
            $pedidos = $p->getPedidos();
            return $p->calcLucroTotal($pedidos);
        }

        public function getVendasHoje(){
            $p = new Pedido();
            $dataHoje = date('Y-m-d');
            return count($p->getPedidosPorDia($dataHoje));
        }
    }
?>