<?php 

    class carrinhoController extends Controller{

        /*
        - Função: index
        - Parâmetros: Sem paramêtros
        - Objetivo: Chama o template para visualizar os informações contidas no carrinho.
        */
        public function index(){
            if(isset($_SESSION['carrinho'])) $dados = $_SESSION['carrinho'];
            else $dados = array();
            $this->carregarTemplate('site/visualizarCarrinho',$dados,'site/templates/header','site/templates/footer');
        }

        public function addToCart($item_id){
            $item = new Item();
            $item->setId($item_id);
            $dados['item'] = $item->getItem();
            $dados['titulo'] = 'Adicionar ao Carrinho';
            $this->carregarTemplate('site/adicionarItemCarrinho',$dados,'site/templates/header','site/templates/footer');
        }

        /*
        - Função: addToCart
        - Parâmetros: INTEIRO - item_id
        - Objetivo: Busca o item a partir do id passado por parâmetro, e caso ele possua estoque no momento da adição é adicionado no carrinho de compras (Super Global $_SESSION['carrinho]).
        */
        public function addItem($item_id){
            $item = new Item();
            $item->setId($item_id);
            $dados = $item->getItem();
            $dados['item_quantidade'] = $_POST['quantidade'];
            if($dados['item_estoque'] && ($dados['item_estoque'] >= $dados['item_quantidade'])){
                $carrinho = new Carrinho();
                $carrinho->setItens($dados);
                $carrinho->addToCart();              
                $_SESSION['status'] = 'sucesso';
                $_SESSION['status_msg'] = 'Item adicionado ao carrinho';
            }else{
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Item não foi adicionado ao carrinho pois não possui estoque suficiente';
            }
            header('Location: '.INCLUDE_PATH_SITE.'cardapio');
            exit;
        }

        /*
        - Função: calcCart
        - Parâmetros: Sem parâmetros
        - Objetivo: Retorna o cálculo do valor total do preço do carrinho de compras.
        */
        public function calcCart(){
            $carrinho = new Carrinho();
            $carrinho->setItens($this->dados);
            return $carrinho->calcCart();
        }

        /*
        - Função: CountItensCart
        - Parâmetros: Nenhum
        - Objetivo: Retorna a contagem de itens totais no carrinho de compras.
        */
        public static function CountItensCart(){
            $carrinho = new Carrinho();
            $carrinho->setItens($_SESSION['carrinho']);
            return $carrinho->countItensCart();
        }

        /*
        - Função: limparCarrinho
        - Parâmetros: Nenhum
        - Objetivo: Limpa todos os itens no carrinho de compras, através da limpeza da super global $_SESSIO['carrinho].
        */
        public function limparCarrinho(){
            unset($_SESSION['carrinho']);
            header('Location: '.INCLUDE_PATH_SITE.'carrinho');
            exit;
        }
    }

?>