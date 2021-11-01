<?php 

    require_once 'Conexao.php';
    class Item{
        private $conexao;
        private $id,$nome,$descricao,$estoque,$preco,$imagem,$categoria;

        public function __construct()
        {
            $this->conexao = Conexao::getConexao();
        }

        public function getID(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function getEstoque(){
            return $this->estoque;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function setId($dado){
            $this->id = $dado;
        }

        public function setNome($dado){
            $this->nome = $dado;
        }

        public function setDescricao($dado){
            $this->descricao = $dado;
        }

        public function setEstoque($dado){
            $this->estoque = $dado;
        }

        public function setPreco($dado){
            $this->preco = $dado;
        }

        public function setImagem($dado){
            $this->imagem = $dado;
        }

        public function setCategoria($dado){
            $this->categoria = $dado;
        }

        /*
        - Função: validarImagem
        - Parâmetros: Sem parâmetros
        - Objetivo: Valida se o arquivo enviado é realmente uma imagem (formatos JPEG, JPG ou PNG) e se o tamanho dela é menor que 600KB.
        */
        public function validarImagem(){
            if(($this->imagem['type'] == 'image/jpeg') ||
              ($this->imagem['type'] == 'image/jpg') ||
              ($this->imagem['type'] == 'imagem/png')){
                
                $tamanho = intval($this->imagem['size'] /1024);
                if($tamanho < 600) return true;
                else{
                    $_SESSION['status'] = 'erro';
                    $_SESSION['status_msg'] = 'A IMAGEM carregada é maior do que 600KB. Por favor, insira uma imagem com o tamanho adequado.';
                    return false;
                }
            }

            $_SESSION['status'] = 'erro';
            $_SESSION['status_msg'] = 'A IMAGEM carregada não está no formato JPEG, JPG e PNG. Por favor, insira uma imagem no formato correto.';
            return false;
        }

        /*
        - Função: uploadFile
        - Parâmetros: Sem parâmetros
        - Objetivo: Armazena o arquivo carregado em uma pasta dentro do projeto.
        */
        public function uploadFile(){
           
            $formato = explode('.',$this->imagem['name']);
            $imagemNome = uniqid().'.'.$formato[count($formato)-1];
            if(move_uploaded_file($this->imagem['tmp_name'],'img/'.$imagemNome)){
                return $imagemNome;
            }else {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Diretório para salvar arquivo não encontrado';
                return false;
            }            
        }

        /*
        - Função: insertItem
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e armazena as informações do item na tabela tb_item.
        */
        public function insertItem(){
            try {
                $sql = $this->conexao->prepare(
                    "INSERT INTO tb_item
                    VALUES (null,?,?,?,?,?,?)"
                );
                $sql->execute(array($this->nome,$this->descricao,$this->estoque,$this->preco, $this->imagem, $this->categoria));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }                
        }

        /*
        - Função: updateItem
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e atualiza as informações de um objeto específico na tabela tb_item.
        */
        public function updateItem(){
            try {
                $sql = $this->conexao->prepare(
                    "UPDATE tb_item
                    SET item_descricao = ?,
                        item_estoque = ?,
                        item_preco = ?,
                        item_imagem = ?
                    WHERE item_id = ?;"
                );

                $sql->execute(array($this->descricao,$this->estoque,$this->preco,$this->imagem,$this->id));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }               
        }

        /*
        - Função: getItem
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna as informações referente a um item específico nas tabelas tb_item e tb_categoria.
        */
        public function getItem(){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT i.item_id,
                        i.item_nome,
                        i.item_preco,
                        i.item_imagem,
                        i.item_descricao,
                        i.item_estoque,
                        c.cat_id,
                        c.cat_nome
                 FROM tb_item i
                 INNER JOIN tb_categoria c
                 ON i.item_categoria = c.cat_id 
                 WHERE i.item_id = ?               
            ");
            $sql->execute(array(intval($this->id)));
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }

         /*
        - Função: getItem
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna as informações sobre todos os itens, contidas nas tabelas tb_item e tb_categoria.
        */
        public function getItens(){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT i.item_id,
                        i.item_nome,
                        i.item_descricao,
                        i.item_estoque,
                        i.item_preco,
                        i.item_imagem,
                        c.cat_id,
                        c.cat_nome
                 FROM tb_item i
                 INNER JOIN tb_categoria c
                 ON i.item_categoria = c.cat_id                
            ");
            $sql->execute();
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

         /*
        - Função: getItem
        - Parâmetros: ARRAY - itens
        - Objetivo: Conecta-se ao banco de dados e retorna as informações referente a cada um dos itens contidos no carrinho.
        */
        public function getItensCarrinho($itens){
            $dados = array();
            foreach ($itens as $key => $value) {
                $sql = $this->conexao->prepare(
                    "SELECT i.item_id,
                            i.item_nome,
                            i.item_preco,
                            i.item_imagem,
                            i.item_descricao,
                            i.item_estoque,
                            c.cat_nome
                     FROM tb_item i
                     INNER JOIN tb_categoria c
                     ON i.item_categoria = c.cat_id 
                     WHERE c.cat_id = ?               
                ");
                $sql->execute(array($value['item_id']));
                array_push($dados,$sql->fetchall(PDO::FETCH_ASSOC));
            }
            return $dados;
        }

         /*
        - Função: filtrarCategoria
        - Parâmetros: INTEIRO - filtro
        - Objetivo: Conecta-se ao banco de dados e retorna todos os itens referentes a uma categoria específica informada através do valor do filtro.
        */
        public function filtrarCategoria($filtro){
            $dados = array();
            $sql = $this->conexao->prepare(
                "SELECT i.item_id,
                        i.item_nome,
                        i.item_preco,
                        i.item_imagem,
                        i.item_descricao,
                        i.item_estoque,
                        c.cat_nome
                 FROM tb_item i
                 INNER JOIN tb_categoria c
                 ON i.item_categoria = c.cat_id 
                 WHERE c.cat_id = ?               
            ");
            $sql->execute(array($filtro));
            $dados = $sql->fetchall(PDO::FETCH_ASSOC);
            return $dados;
        }

         /*
        - Função: contarItens
        - Parâmetros: Sem parâmetros
        - Objetivo: Conecta-se ao banco de dados e retorna a contagem de todos os itens cadastrados na tabela tb_item.
        */
        public function contarItens(){
            $sql = $this->conexao->prepare(
                "SELECT * FROM `tb_item`"
            );
            $sql->execute();
            return $sql->fetchall(PDO::FETCH_ASSOC);
        }

         /*
        - Função: removerEstoque
        - Parâmetros: INTEIRO - quantidade
        - Objetivo: Conecta-se ao banco de dados e remove um valor específico do estoque de um item específico armazenado no banco.
        */
        public function removerEstoque($quantidade){
                $sql = $this->conexao->prepare(
                    "UPDATE tb_item
                    SET item_estoque = item_estoque - ?
                    WHERE item_id = ?;"
                );

                $sql->execute(array($quantidade,$this->id));
                return; 
        }

    }

?>