<section class="cardapio">
    <div class="container">
        <div class="titulo mb-3 p-1">
            <p>Cardápio</p>            
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
                //unset($_SESSION['carrinho']);
            }
        ?>

        <div class="row mt-5">
            <div class="col-md-2 text-center ">
                <div class="filtro">
                    <div class="btn-group-vertical d-none d-sm-block">
                            <a href="<?php echo INCLUDE_PATH_SITE ?>cardapio/filtrarCardapio">
                                <button type="button" class="btn btn-outline-primary">Todos</button>
                            </a>

                            <?php 
                                foreach ($this->dados['categorias'] as $key => $value) {
                            ?>
                                <a href="<?php echo INCLUDE_PATH_SITE?>cardapio/filtrarCardapio/<?php echo $value['cat_id'] ?>">
                                    <button type="button" class="btn btn-outline-primary"><?php echo $value['cat_nome'] ?></button>
                                </a>
                            <?php
                                }
                            ?>       
                    </div>

                    <div class="btn-group-vertical d-block d-sm-none ">
                            <a href="<?php echo INCLUDE_PATH_SITE ?>cardapio/filtrarCardapio">
                                <button type="button" class="btn btn-outline-primary">Todos</button>
                            </a>

                            <?php 
                                foreach ($this->dados['categorias'] as $key => $value) {
                            ?>
                                <a href="<?php echo INCLUDE_PATH_SITE ?>cardapio/filtrarCardapio/<?php echo $value['cat_id'] ?>">
                                    <button type="button" class="btn btn-outline-primary"><?php echo $value['cat_nome'] ?></button>
                                </a>
                            <?php
                                }
                            ?>       
                    </div>
                </div><!-- filtro -->
            </div>



            <div class="itens-cardapio col-md-10">
                <div class="row">

                <?php 
                    foreach($this->dados['itens'] as $key => $value){
                    $formatPreco = $value['item_preco'];
                    $formatPreco = number_format($formatPreco,2,',','.');
                ?>

                <!-- Para estoque zerado -->

                <?php if($value['item_estoque']==0){ ?>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4" >
                    <div class="gray item card shadow-sm animate__animated animate__fadeInUp"> 
                        <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>);" class="card-img"></div>

                        <div class="card-price ps-2">R$ <?php echo $formatPreco?></div>

                        <div class="card-body d-flex flex-column ">
                            <p class="card-title d-flex justify-content-center mb-3"><?php echo $value['item_nome'] ?></p>

                            <p class="card-description mb-3"><?php echo $value['item_descricao'] ?></p>
                            
                        </div>
                        <div class=" mb-3 d-flex justify-content-center align-items-center">
                            <span>Sem estoque</span>
                        </div>
                    </div>
                </div>

                <!-- Para itens com estoque -->
                <?php } else { ?>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4" >
                    <div class="item card shadow-sm animate__animated animate__fadeInUp"> 
                        <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>);" class="card-img"></div>

                        <div class="card-price ps-2">R$ <?php echo $formatPreco?></div>

                        <div class="card-body d-flex flex-column ">
                            <p class="card-title d-flex justify-content-center mb-3"><?php echo $value['item_nome'] ?></p>

                            <p class="card-description mb-3"><?php echo $value['item_descricao'] ?></p>
                            
                        </div>
                        <div class=" mb-3 d-flex justify-content-center align-items-center">
                            <a href="<?php echo INCLUDE_PATH_SITE?>carrinho/addToCart/<?php echo $value['item_id'] ?>">
                                <button class="btn btn-outline">Adicionar ao carrinho</button>
                            </a>                            
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php } ?>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>