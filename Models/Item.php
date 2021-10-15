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

        public function validarImagem($imagem){
            if(($imagem['type'] == 'image/jpeg') ||
              ($imagem['type'] == 'image/jpg') ||
              ($imagem['type'] == 'imagem/png')){
                
                $tamanho = intval($imagem['size'] /1024);
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

        public function uploadFile($imagem){
           
            $formato = explode('.',$imagem['name']);
            $imagemNome = uniqid().'.'.$formato[count($formato)-1];
            if(move_uploaded_file($imagem['tmp_name'],'img/'.$imagemNome)){
                return $imagemNome;
            }else {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = 'Diretório para salvar arquivo não encontrado';
                return false;
            }            
        }

        public function insertItem($item){
            try {
                $sql = $this->conexao->prepare(
                    "INSERT INTO tb_item
                    VALUES (null,?,?,?,?,?,?)"
                );
                $sql->execute(array($item['nome'],$item['descricao'],$item['estoque'],$item['preco'], $item['imagem'], $item['categoria']));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }                
        }

        public function updateItem($id,$descricao,$estoque,$preco,$imagem){
            try {
                $sql = $this->conexao->prepare(
                    "UPDATE tb_item
                    SET item_descricao = ?,
                        item_estoque = ?,
                        item_preco = ?,
                        item_imagem = ?
                    WHERE item_id = ?;"
                );

                $sql->execute(array($descricao,$estoque,$preco,$imagem,$id));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }               
        }

        public function removeItem($item_id){
            try {
                $sql = $this->conexao->prepare(
                    " DELETE FROM tb_item WHERE item_id = ?;"
                );
                $sql->execute(array($item_id));
                return true;
            } catch (\Throwable $th) {
                $_SESSION['status'] = 'erro';
                $_SESSION['status_msg'] = $th;
                return false;
            }                
        }

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
            $sql->execute(array(intval($this->getID())));
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }

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

        public function contarItens(){
            $sql = $this->conexao->prepare(
                "SELECT * FROM `tb_item`"
            );
            $sql->execute();
            return $sql->fetchall(PDO::FETCH_ASSOC);
        }

        public function getCategoriaNome($categoria){
            $cat = new Categoria();
            return $cat->getCategoriaItem($categoria);
        }

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