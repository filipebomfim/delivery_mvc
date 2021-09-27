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
    }
?>