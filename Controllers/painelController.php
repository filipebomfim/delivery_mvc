<?php

    class painelController extends Controller{

        /*
        - Função: index
        - Parâmetros: Sem parâmetros
        - Objetivo: Chama o template para visualizar o home do painel de controle. Informações de data, itens cadastrados, registros e pedidos também são resgatados para serem exibidos nos cards do painel.
        */
        public function index(){
            $dataHoje = date('Y-m-d');
            $dados = array();
            $item = new Item();
            $dados['qtdItens'] = $item->contarItens();
            $log = new Log();
            $dados['log'] = $log->getRegistros();
            array_multisort(array_column($dados['log'], 'log_registro'), SORT_DESC, $dados['log']);
            $pedido = new Pedido();
            $dados['vendas'] = $pedido->getVendasDia($dataHoje);
            array_multisort(array_column($dados['vendas'], 'pedido_horario'), SORT_DESC, $dados['vendas']);
            $dados['pedidos'] = $pedido->getPedidosDia($dataHoje);
            $dados['lucro'] = $pedido->calcLucroTotal($dados['pedidos']);
            $this->carregarTemplate('painel/home',$dados,'painel/templates/header','painel/templates/footer');
        }
    }
?>