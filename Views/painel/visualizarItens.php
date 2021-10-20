<div class="conteudo titulo animate__animated animate__fadeInUp">
    <i class='bx bx-show'></i>
    <span><?php echo $this->dados['titulo'] ?> </span>
</div>

<?php 
    if(!empty($_SESSION['status'])){
        if($_SESSION['status'] == 'sucesso') {
            echo '<div class="alert alert-success animate__animated animate__fadeInUp" role="alert">
                    <i class="bx bx-check pe-2"></i>'
                    .$_SESSION['status_msg'].
                '</div>';
        }else if($_SESSION['status'] == 'erro'){
            echo '<div class="alert alert-danger animate__animated animate__fadeInUp" role="alert">
                    <i class="bx bx-error-circle pe-2"></i>'
                    .$_SESSION['status_msg'].
                 '</div>';
        }

        unset($_SESSION['status']);
    }
?>


<div class="conteudo animate__animated animate__fadeInUp">
    <div class="row">
        <div class="col-md-2 text-center ">
            <div class="filtro">
                <div class="btn-group-vertical d-none d-sm-block">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>item/visualizarItens">
                            <button type="button" class="btn btn-outline-primary">Todos</button>
                        </a>

                        <?php 
                            foreach ($this->dados['categorias'] as $key => $value) {
                        ?>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>item/visualizarItens/<?php echo $value['cat_id'] ?>">
                                <button type="button" class="btn btn-outline-primary"><?php echo $value['cat_nome'] ?></button>
                            </a>
                        <?php
                            }
                        ?>       
                </div>

                <div class="btn-group-vertical d-block d-sm-none ">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>item/visualizarItens">
                            <button type="button" class="btn btn-outline-primary">Todos</button>
                        </a>

                        <?php 
                            foreach ($this->dados['categorias'] as $key => $value) {
                        ?>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>item/visualizarItens/<?php echo $value['cat_id'] ?>">
                                <button type="button" class="btn btn-outline-primary"><?php echo $value['cat_nome'] ?></button>
                            </a>
                        <?php
                            }
                        ?>       
                </div>
            </div><!-- filtro -->
        </div>
        
        <div class="col-md-8 col-lg-9 mx-auto">
            <div class="row listar-itens">
                <?php if(empty($this->dados['itens'])){
                    echo '<div class="d-flex justify-content-center align-items-center" role="alert">
                        <i class="bx bx-x pe-1"></i>
                        Nenhum Item cadastrado!
                    </div>';
                }else{
                     
                    $animation = 0.4;
                    foreach ($this->dados['itens'] as $key => $value) {
                ?>

                <!-- Para itens com estoque -->
                <?php if($value['item_estoque']>0){ ?>

                    <div class="col-6 col-md-6 col-lg-6 col-xl-4" >
                        <div class="item card shadow-sm animate__animated animate__fadeInUp"
                            style="animation-delay: <?php echo $animation?>s;"> 
                            <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>);" class="card-img"></div>

                            <div class="card-estoque ps-2 pe-2"><?php echo $value['item_estoque']?> no estoque</div>

                            <div class="card-body d-flex flex-column ">
                                <p class="card-title d-flex justify-content-center"><?php echo $value['item_nome'] ?></p>
                                <p class="card-price d-flex justify-content-center mb-0">R$ <?php echo number_format($value['item_preco'],2,',','.') ?></p>
                                <div class=" d-flex justify-content-center align-items-center">
                                    <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH_PAINEL;?>item/editarItem/<?php echo $value['item_id'] ?>">
                                        <i class='bx bx-edit bx-tada-hover'></i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- item -->
                    </div>

                    <!-- Para itens sem estoque -->

                <?php }else{ ?>
                    <div class="col-6 col-md-6 col-lg-6 col-xl-4" >
                        <div class="item card shadow-sm animate__animated animate__fadeInUp"
                            style="animation-delay: <?php echo $animation?>s;"> 
                            <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>);" class="card-img gray"></div>

                            <div class="card-estoque sem-estoque ps-2 pe-2">Sem estoque</div>

                            <div class="card-body d-flex flex-column ">
                                <p class="card-title d-flex justify-content-center"><?php echo $value['item_nome'] ?></p>
                                <p class="card-price d-flex justify-content-center mb-0">R$ <?php echo number_format($value['item_preco'],2,',','.') ?></p>
                                <div class=" d-flex justify-content-center align-items-center">
                                    <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH_PAINEL;?>item/editarItem/<?php echo $value['item_id'] ?>">
                                        <i class='bx bx-edit bx-tada-hover'></i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- item -->
                    </div>
                <?php

                    }
                $animation = $animation + 0.3;
                }
            }
                    
                ?>


                
            </div><!-- row -->
        </div>

    </div><!-- row -->
</div><!-- conteudo-wrapper -->