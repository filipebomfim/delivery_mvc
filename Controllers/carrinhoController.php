<?php 

    class carrinhoController extends Controller{

        public function index(){
            if(isset($_SESSION['carrinho'])) $dados = $_SESSION['carrinho'];
            else $dados = array();
            $this->carregarTemplate('site/visualizarCarrinho',$dados,'site/templates/header','site/templates/footer');
        }

        public function addToCart($item_id){
            $item = new Item();
            $dados = $item->getItem($item_id);
            if($dados['item_estoque']){
                $carrinho = new Carrinho();
                $carrinho->addToCart($dados);              
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
            return $carrinho->calcCart($this->dados);
        }

        public static function CountItensCart(){
            $carrinho = new Carrinho();
            return $carrinho->countItensCart($_SESSION['carrinho']);
        }
    }

?>