<?php
    class itemController extends Controller{
        public function index(){
            $this->visualizarItens();
        }

        /*
        - Função: visualizarItens
        - Parâmetros: INTEIRO - filtro
        - Objetivo: Realiza uma filtragem e exibe os itens referente ao filtro selecionado na parte de visualizar Itens do painel de controle. Os itens são exibidos de forma ordenada, por ordem de estoque e depois pelo alfabeto de A-Z.
        */
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

        /*
        - Função: cadastrarItem
        - Parâmetros: Sem parâmetros
        - Objetivo: Chama o template para cadastrar novos itens no painel de controle. As categorias cadastradas também são resgatadas para serem selecionadas.
        */
        public function cadastrarItem(){
            $categorias = new Categoria();
            $dados = $categorias->getCategorias();
            $this->carregarTemplate('painel/cadastrarItem',$dados,'painel/templates/header','painel/templates/footer');
        }

        /*
        - Função: editarItem
        - Parâmetros: INTEIRO - item_id
        - Objetivo: Chama o template para editar um item a partir do seu id no painel de controle. 
        */
        public function editarItem($item_id){
            $item = new Item();
            $item->setId($item_id);
            $dados = $item->getItem();
            $this->carregarTemplate('painel/editarItem',$dados,'painel/templates/header','painel/templates/footer');
        }

        /*
        - Função: validarFormulário
        - Parâmetros: Sem parâmetros
        - Objetivo: Realiza a validação dos dados do formulário de cadastrar item, a partir das informações dados pelo método POST.
        */
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

        /*
        - Função: checkInsert
        - Parâmetros: Sem parâmetros
        - Objetivo: Salva um novo item criado a partir das informações do método POST no banco de dados e cria um registro sobre as informações cadastradas, o qual também é armazenado no banco.
        */
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
                            $registro = new Log();
                            $registro->setTipo(CADASTRO);
                            $registro->setDescricao('Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome']);
                            $registro->setData(date('Y-m-d H:i:s'));
                            $registro->setRegistro();
                        }
                    }
                    header('Location: '.INCLUDE_PATH_PAINEL.'item/visualizarItens');
                    exit;
                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL.'item/cadastrarItem');
                    exit;
                }

        }

        /*
        - Função: checkUpdate
        - Parâmetros: Sem parâmetros
        - Objetivo: Edita um item existente a partir das informações do método POST no banco de dados e cria um registro sobre as informações alteradas, o qual também é armazenado no banco. O nome e a categoria do item não são atualizadas.
        */
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
                        $registro = new Log;
                        $registro->setTipo(ALTERAÇÃO);
                        $registro->setDescricao('Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome']);
                        $registro->setData(date('Y-m-d H:i:s'));
                        $registro->setRegistro();
                    } 
                }else{
                    $item->setImagem($_FILES['imagem']);
                    if($item->validarImagem()){
                        $item->setImagem($item->uploadFile());
                        if($item->updateItem()){
                            $_SESSION['status'] = 'sucesso';
                            $_SESSION['status_msg'] = 'Item atualizado com sucesso!';
                            $registro = new Log();
                            $registro->setTipo(ALTERAÇÃO);
                            $registro->setDescricao('Nome: '.$item->getNome().',Estoque: '.$item->getEstoque().',Preço: '.$item->getPreco().',Categoria: '.$cat->getCategoriaNome($item->getCategoria())['cat_nome'].',IMAGEM ALTERADA
                            ');
                            $registro->setData(date('Y-m-d H:i:s'));
                            $registro->setRegistro($registro);
                        }                      
                    }
                }
                
                header('Location: '.INCLUDE_PATH_PAINEL.'item/editarItem/'.$item->getId());
                exit;
        }
    }
?>