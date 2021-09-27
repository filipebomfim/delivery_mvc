<div class="conteudo titulo">
    <i class='bx bx-show'></i>
    <span>Cadastrar Item</span>
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
    <form method="post" action="<?php echo INCLUDE_PATH_PAINEL;?>item/checkInsert" enctype="multipart/form-data" class="container-fluid">
        <div class="row">
            <div class="mb-3 col-8">
                <label for="item" class="form-label">Nome</label>
                <input name = "nome" type="text" class="form-control" id="item" aria-describedby="item">
            </div>   
            <div class="mb-3 col-4">
                <label for="item" class="form-label">Categoria</label>
                <select name = "categoria" class="form-select" id="categoria" aria-label="Default select example">
                    <option selected value="selecione">Selecione</option>
                    <?php 
                        foreach ($this->dados as $key => $value) {
                    ?>
                        <option value="<?php echo $value['cat_id'] ?>"> <?php echo $value['cat_nome'] ?></option>
                    <?php
                        }
                    ?>                    
                </select>
            </div> 
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name = "descricao" class="form-control" id="descricao" rows="3"></textarea>
        </div>

        <div class="mb-3 col-3">
            <label for="estoque" class="form-label">Estoque</label>
            <div class="input-group">
                <div class="input-group-text">+</div>
                <input  name = "estoque" type="number" class="form-control" id="autoSizingInputGroup" min="0" max="1000">
            </div>
        </div>

        <div class="mb-3 col-3">
            <label for="preco" class="form-label">Preço</label>
            <div class="input-group">
                <div class="input-group-text">R$</div>
                <input  name = "preco" type="number" class="form-control" id="autoSizingInputGroup" min="0" max="10000" step="0.01" pattern="^\d*(\.\d{0,2})?$">
            </div>
        </div>
            
        <div class="mb-3 col-6">
            <label for="">Imagem</label>
            <input name = "imagem" class="form-control" type="file" id="formFile">
        </div>
        <div class="mb-3 col-10">
            <button type="submit" name="acao" class="btn btn-primary">Cadastrar</button>
        </div>
        
        </div>
    </form>    
</div>