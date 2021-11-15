<section class="adicionarItemCarrinho">
    <div class="container">
        <div class="titulo mb-3 p-1 animate__animated animate__fadeInUp">
            <p><?php echo $this->dados['titulo'] ?></p>            
        </div>

        <?php $item = $this->dados['item'] ?>

        
        <form action="<?php echo INCLUDE_PATH_SITE?>/carrinho/addItem/<?php echo $item['item_id'] ?>" method="POST">
            <div class="col-10 col-md-10 col-lg-10 col-xl-4 mx-auto" >
                <div class="card-view shadow-sm animate__animated animate__fadeInUp" style="animation-delay: <?php echo $animation?>s;"> 
                    <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $item['item_imagem'] ?>);" class="card-img"></div>

                    <div class="card-price ps-2 pe-2">R$ <?php echo number_format($item['item_preco'],2,',','.')?></div>

                    <div class="card-body d-flex flex-column ">
                        <p class="card-title d-flex justify-content-center mb-3"><?php echo $item['item_nome'] ?></p>

                        <p class="card-description mb-3"><?php echo $item['item_descricao'] ?></p>
                        
                    </div>
                    <div class="mb-6 col-md-3 col-6 mb-2 mx-auto">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <div class="input-group">
                            <div class="input-group-text">+</div>
                            <input  name = "quantidade" type="number" class="form-control" id="autoSizingInputGroup" min="1" max="<?php echo $item['item_estoque'] ?>" value="1">
                        </div>
                    </div>
                    <div class=" mb-3 ms-2 me-2 d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-outline">Adicionar ao carrinho</button>
                           
                    </div>

                    <div class="cart-mobile">
                        <button type="submit" class="btn btn-outline"> 
                            <i class='bx bxs-cart-add bx-tada' ></i>
                        </button>
                    </div><!-- cart-mobile -->
                </div>
            </div>
        </form>
        
        
    </div>
</section>