<?php 
    class pedidoController extends Controller{
        public function index(){

        }

        /*
        - Função: addPedido
        - Parâmetros: Sem parâmetros
        - Objetivo: Realiza o cadastro do pedido, armazendo as informações da super global $_SESSION['carrinho'] no banco de dados. Caso o armazenamento ocorra sem problemas, o estoque dos itens que foram no pedido é atualizado no banco.
        */
        public function addPedido(){
            //Verificação para analisar se ainda tem estoque no momento da compra.
            foreach ($_SESSION['carrinho'] as $key => $value) {
                $item = new Item();
                $item->setId($value['item_id']);
                $dados = $item->getItem();
                if($dados['item_estoque']==0){
                    $_SESSION['status'] = 'erro';
                    $_SESSION['status_msg'] = 'Não foi possível concluir seu pedido pois '.$dados['item_nome'].' não possui estoque no momento da compra.';
                    header('Location: '.INCLUDE_PATH_SITE.'carrinho');
                    exit;
                }
            }
            //Tendo estoque, o processo continua
            $pedido = new Pedido();
            $pedido->setItens($_SESSION['carrinho']);
            $pedido->setId(rand(1000,1000000));
            $pedido->setHorario(date('Y-m-d H:i:s'));
            if($pedido->addPedido()){
                foreach ($pedido->getItens() as $key => $value) {
                    $item = new Item();
                    $item->setId($value['item_id']);
                    $item->removerEstoque($value['item_quantidade']);
                }
                unset($_SESSION['carrinho']);
                $_SESSION['status'] = 'sucesso';
                $_SESSION['status_msg'] = 'Pedido cadastrado com sucesso.';
            }else{
                $_SESSION['status'] = 'erro';
            }

            header('Location: '.INCLUDE_PATH_SITE.'carrinho');
            exit;
        }
    }
?>