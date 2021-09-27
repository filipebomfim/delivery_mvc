
<div class="conteudo titulo">
    <i class='bx bx-show'></i>
    <span>Editar Item</span>
</div>

<?php 
    if(!empty($_SESSION['status'])){
        if($_SESSION['status'] == 'sucesso') {
            echo '<div class="alert alert-success" role="alert">
                    <i class="bx bx-check pe-2"></i>'
                    .$_SESSION['status_msg'].
                '</div>';
        }else if($_SESSION['status'] == 'erro'){
            echo '<div class="alert alert-danger" role="alert">
                    <i class="bx bx-error-circle pe-2"></i>'
                    .$_SESSION['status_msg'].
                 '</div>';
        }

        unset($_SESSION['status']);
    }
?>

<div class="conteudo">
    <form method="post" action="<?php echo INCLUDE_PATH_PAINEL.'item/checkUpdate' ?>" enctype="multipart/form-data" class="container-fluid">
        <div class="row">
            <div class="mb-3 col-8">
                <label for="item" class="form-label">Nome</label>
                <input name = "nome_disabled" type="text" class="form-control" id="nome" aria-describedby="nome" placeholder="<?php echo $this->dados['item_nome']?>" disabled>
            </div>  
            <div class="mb-3 col-4">
                <label for="categoria" class="form-label">Categoria</label>
                <input name = "categoria_disabled" type="text" class="form-control" id="categoria" aria-describedby="categoria" placeholder="<?php echo $this->dados['cat_nome'] ?>" disabled> 
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name = "descricao" class="form-control" id="descricao" rows="3"><?php echo $this->dados['item_descricao'] ?></textarea>
            </div> 
            <div class="mb-3 col-3">
                <label for="estoque" class="form-label">Estoque</label>
                <div class="input-group">
                    <div class="input-group-text">+</div>
                    <input  name = "estoque" type="number" class="form-control" id="autoSizingInputGroup" min="0" max="1000" value="<?php echo $this->dados['item_estoque'] ?>">
                </div>
            </div>
                
                <?php 
                $formatPreco = $this->dados['item_preco'];
                $formatPreco = number_format($formatPreco,2,',','.');
                ?>

            <div class="mb-3 col-3">
                <label for="preco" class="form-label">Preço</label>
                <div class="input-group">
                    <div class="input-group-text">R$</div>
                    <input  name = "preco" type="number" class="form-control" id="autoSizingInputGroup" placeholder="<?php echo $formatPreco ?>" min="0" max="1000" step="0.01" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $this->dados['item_preco'] ?>">
                </div>
            </div>
                <div class="mb-3 col-6">
                    <label for="">Imagem</label>
                    <input name = "imagem" class="form-control" type="file" id="formFile">
                </div>
                <input type="hidden" name="nome" value="<?php echo $this->dados['item_nome'] ?>">
                <input type="hidden" name="cat" value="<?php echo $this->dados['cat_id'] ?>">
                <input type="hidden" name="id" value="<?php echo $this->dados['item_id'] ?>">
                <input type="hidden" name="old_imagem" value="<?php echo $this->dados['item_imagem'] ?>">
                <div class="mb-3 col-10">
                    <button type="submit" name="submit" class="btn btn-primary">Atualizar</button>
                </div>            
        </div>
        
    </form>
     
</div>
