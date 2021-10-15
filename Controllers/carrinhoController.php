<?php 

    class carrinhoController extends Controller{

        public function index(){
            if(isset($_SESSION['carrinho'])) $dados = $_SESSION['carrinho'];
            else $dados = array();
            $this->carregarTemplate('site/visualizarCarrinho',$dados,'site/templates/header','site/templates/footer');
        }

        public function addToCart($item_id){
            $item = new Item();
            $item->setId($item_id);
            $dados = $item->getItem();
            if($dados['item_estoque']){
                $carrinho = new Carrinho();
                $carrinho->setItens($dados);
                $carrinho->addToCart();              
                $_SESSION['status'] = 'sucesso';
                $_SESSION['status_msg'] = 'Item adicionado ao carrinho';
            }else{
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Item não foi adicionado ao carrinho pois não possui estoque';
            }
            header('Location: '.INCLUDE_PATH_SITE.'cardapio');
            exit;
        }

        public function calcCart(){
            $carrinho = new Carrinho();
            $carrinho->setItens($this->dados);
            return $carrinho->calcCart();
        }

        public static function CountItensCart(){
            $carrinho = new Carrinho();
            $carrinho->setItens($_SESSION['carrinho']);
            return $carrinho->countItensCart();
        }

        public function limparCarrinho(){
            unset($_SESSION['carrinho']);
            header('Location: '.INCLUDE_PATH_SITE.'carrinho');
            exit;
        }
    }

?>