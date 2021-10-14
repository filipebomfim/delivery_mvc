<?php 
    class cardapioController extends Controller{
        public function index(){
            $this->filtrarCardapio();
        }

        public function filtrarCardapio($filtro=0){
            $dados = array();
            $categorias = new Categoria();
            $dados['categorias'] = $categorias->getCategorias();
            $col = array_column($dados['categorias'],"cat_nome");
            array_multisort($col,SORT_ASC,$dados['categorias']);
            $item = new Item();
            if($filtro == 0) $dados['itens'] = $item->getItens();
            else $dados['itens'] = $item->filtrarCategoria($filtro);
            $this->carregarTemplate('site/cardapio',$dados,'site/templates/header','site/templates/footer');
        }
    }
?>