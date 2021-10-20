<?php
    class itemController extends Controller{
        public function index(){
            $this->visualizarItens();
        }

        public function visualizarItens($filtro = 0){
            $dados = array();
            $categorias = new Categoria();
            $dados['categorias'] = $categorias->getCategorias();
            $col = array_column($dados['categorias'],"cat_nome");
            array_multisort($col,SORT_ASC,$dados['categorias']);
            $item = new Item();
            if($filtro == 0) {
                $dados['itens'] = $item->getItens();
                $dados['titulo'] = 'Itens Cadastrados - Todos os Itens';
            }else{
                $dados['itens'] = $item->filtrarCategoria($filtro);
                $dados['titulo'] = 'Itens Cadastrados - ' .$categorias->getCategoriaNome($filtro)['cat_nome'];
            }
            if(!empty($dados['itens'])){

                foreach ($dados['itens'] as $key => $value) {
                    if($value['item_estoque'] == 0) $estoque[$key] = 0;
                    else $estoque[$key] = 1;
                }

                array_multisort($estoque,  SORT_DESC,
                                array_column($dados['itens'], 'item_nome'), SORT_ASC,
                                $dados['itens']);
            }
            $this->carregarTemplate('painel/visualizarItens',$dados,'painel/templates/header','painel/templates/footer');
        }

        public function cadastrarItem(){
            $categorias = new Categoria();
            $dados = $categorias->getCategorias();
            $this->carregarTemplate('painel/cadastrarItem',$dados,'painel/templates/header','painel/templates/footer');
        }

        public function editarItem($item_id){
            $item = new Item();
            $item->setId($item_id);
            $dados = $item->getItem();
            $this->carregarTemplate('painel/editarItem',$dados,'painel/templates/header','painel/templates/footer');
        }

        public function validarFormulario(){
            if($_POST['nome'] == ''){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Insira um NOME para o Item';
                return false;
            } else if($_POST['descricao']==''){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Insira um DESCRIÇÃO para o Item';
                return false;
            } else if($_POST['preco'] == ''){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Insira um PREÇO para o Item';
                return false;
            } else if($_POST['categoria']=='selecione'){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Selecione uma CATEGORIA para o Item';
                return false;
            } else if($_POST['estoque']=='quantidade'){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Selecione uma QUANTIDADE para o Item';
                return false;
            }else if ($_FILES['imagem']['name'] ==''){
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Carregue uma IMAGEM para o Item';
                return false;
            } else{
                return true;
            }
        }

        public function remove(){
            if(isset($_POST['remove'])){
                $item = new Item();
                $cat = new Categoria();
                $item->setNome($_POST['nome']);
                $item->setEstoque($_POST['estoque']);
                $item->setPreco($_POST['preco']);
                $item->setCategoria($_POST['categoria']);
                if($item->removeItem($_POST['remove'])){
                    $_SESSION['status'] = 'sucesso';
                    $_SESSION['status_msg'] = 'Item removido com sucesso!';
                    $registro = array();
                    $registro['tipo'] = EXCLUSÃO;
                    $registro['descricao'] = 'Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome'].'
                    ';
                    $log = new Log();
                    $log->setRegistro($registro);
                }

                header('Location: '.INCLUDE_PATH_PAINEL.'item/visualizarItens');
                exit;
            }else{
                header('Location: '.INCLUDE_PATH_PAINEL.'painel');
                exit;
            }
         
        }

        public function checkInsert(){
                if($this->validarFormulario()){
                    $item = new Item();
                    $cat = new Categoria();
                    $item->setNome($_POST['nome']);
                    $item->setDescricao($_POST['descricao']);
                    $item->setEstoque($_POST['estoque']);

                    $formatPreco = $_POST['preco'];
                    $formatPreco = str_replace(',','.',$formatPreco);
                    
                    $item->setPreco($formatPreco);            
                    $item->setCategoria($_POST['categoria']);
                    $item->setImagem($_FILES['imagem']);

                    if($item->validarImagem()){
                        $item->setImagem($item->uploadFile());
                        if($item->insertItem()){
                            $_SESSION['status'] = 'sucesso';
                            $_SESSION['status_msg'] = 'Item cadastrado com sucesso!';
                            $registro = array();
                            $registro['tipo'] = CADASTRO;
                            $registro['descricao'] = 'Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome'].'
                            ';
                            $log = new Log();
                            $log->setRegistro($registro);
                        }
                    }
                    header('Location: '.INCLUDE_PATH_PAINEL.'item/visualizarItens');
                    exit;
                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL.'painel');
                    exit;
                }

        }


        public function checkUpdate(){
                $item = new Item();
                $cat = new Categoria();
                $item->setNome($_POST['nome']);
                $item->setCategoria($_POST['cat']);
                $item->setDescricao($_POST['descricao']);
                $item->setEstoque($_POST['estoque']);
                $item->setPreco($_POST['preco']);
                $item->setId($_POST['id']);
                if ($_FILES['imagem']['name'] =='') {                
                    $item->setImagem($_POST['old_imagem']);
                    if($item->updateItem()){
                        $_SESSION['status'] = 'sucesso';
                        $_SESSION['status_msg'] = 'Item atualizado com sucesso!';
                        $registro = array();
                        $registro['tipo'] = ALTERAÇÃO;
                        $registro['descricao'] = 'Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome'].'
                        ';
                        $log = new Log();
                        $log->setRegistro($registro);
                    } 
                }else{
                    $item->setImagem($_FILES['imagem']);
                    if($item->validarImagem()){
                        $item->setImagem($item->uploadFile());
                        if($item->updateItem()){
                            $_SESSION['status'] = 'sucesso';
                            $_SESSION['status_msg'] = 'Item atualizado com sucesso!';
                            $registro = array();
                            $registro['tipo'] = ALTERAÇÃO;
                            $registro['descricao'] = 'Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome'].',IMAGEM ALTERADA
                            ';
                            $log = new Log();
                            $log->setRegistro($registro);
                        }                      
                    }
                }
                
                header('Location: '.INCLUDE_PATH_PAINEL.'item/editarItem/'.$item->getId());
                exit;
        }
    }
?>