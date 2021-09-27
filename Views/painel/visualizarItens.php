<div class="conteudo titulo animate__animated animate__fadeInUp">
    <i class='bx bx-show'></i>
    <span>Itens Cadastrados</span>
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


<div class="conteudo ">
    <div class="row">
        <div class="col-md-2   text-center ">
            <div class="filtro">
                <div class="btn-group-vertical d-none d-sm-block">
                        <a href="<?php echo INCLUDE_PATH ?>item/visualizarItens">
                            <button type="button" class="btn btn-outline-primary">Todos</button>
                        </a>

                        <?php 
                            foreach ($this->dados['categorias'] as $key => $value) {
                        ?>
                            <a href="<?php echo INCLUDE_PATH ?>item/visualizarItens/<?php echo $value['cat_id'] ?>">
                                <button type="button" class="btn btn-outline-primary"><?php echo $value['cat_nome'] ?></button>
                            </a>
                        <?php
                            }
                        ?>       
                </div>

                <div class="btn-group-vertical d-block d-sm-none ">
                        <a href="<?php echo INCLUDE_PATH ?>item/visualizarItens">
                            <button type="button" class="btn btn-outline-primary">Todos</button>
                        </a>

                        <?php 
                            foreach ($this->dados['categorias'] as $key => $value) {
                        ?>
                            <a href="<?php echo INCLUDE_PATH ?>item/visualizarItens/<?php echo $value['cat_id'] ?>">
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
                <?php 
                    $animation = 0.2;
                    foreach ($this->dados['itens'] as $key => $value) {
                    $formatPreco = $value['item_preco'];
                    $formatPreco = number_format($formatPreco,2,',','.');
                ?>

                <!-- Modal para Informação -->
                <div class="modal fade info" id="modalInfo<?php echo $value['item_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $value['item_nome'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php echo $value['item_descricao'] ?>
                            </div>
                            <div class="modal-body">
                                <?php echo $value['item_estoque'] ?> no estoque.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div><!-- info -->            

                <!-- Modal para alterar -->
                <div class="modal fade alterar" id="modalAlterar<?php echo $value['item_id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deseja editar o item <?php echo $value['item_nome'] ?>?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="<?php echo INCLUDE_PATH;?>item/editarItem/<?php echo $value['item_id'] ?>">
                                    <button type="submit" name="editar" class="btn btn-primary">Sim, editar</button>
                                </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>                             
                            </div>
                        </div>
                    </div>
                </div><!-- alterar -->

                <!-- Modal para excluir -->
                <div class="modal fade delete" id="modalDelete<?php echo $value['item_id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deseja excluir o item <?php echo $value['item_nome'] ?>?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="<?php echo INCLUDE_PATH;?>item/remove">
                                    <input type="hidden" name="nome" value="<?php echo $value['item_nome'] ?>">
                                    <input type="hidden" name="estoque" value="<?php echo $value['item_estoque'] ?>">
                                    <input type="hidden" name="preco" value="<?php echo $value['item_preco'] ?>">
                                    <input type="hidden" name="categoria" value="<?php echo $value['cat_id'] ?>">
                                    <button type="submit" name="remove" class="btn btn-primary" value="<?php echo $value['item_id'] ?>" >Sim, excluir</button>
                                </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>                             
                            </div>
                        </div>
                    </div>
                </div><!-- delete -->

                <div class="col-6 col-md-6 col-lg-6 col-xl-4" >
                    <div class="item card shadow-sm animate__animated animate__fadeInUp"
                        style="animation-delay: <?php echo $animation?>s;"> 
                        <div  style="background-image: url(<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>);" class="card-img"></div>

                        <div class="card-body d-flex flex-column ">
                            <p class="card-title d-flex justify-content-center"><?php echo $value['item_nome'] ?></p>
                            <p class="card-price d-flex justify-content-center">R$ <?php echo $formatPreco ?></p>
                            <div class=" d-flex justify-content-center align-items-center">
                                <div class="btn-group">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <i class='bx bxs-info-circle bx-tada-hover' data-bs-toggle="modal" data-bs-target="#modalInfo<?php echo $value['item_id'] ?>"></i>
                                </a>

                                <a class="nav-link active" aria-current="page" href="#">
                                    <i class='bx bx-edit bx-tada-hover'  data-bs-toggle="modal" data-bs-target="#modalAlterar<?php echo $value['item_id'] ?>"></i>
                                </a>
                                <a class="nav-link active" aria-current="page" href="#">
                                    <i class='bx bxs-trash bx-tada-hover'  data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $value['item_id'] ?>"></i>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $animation = $animation + 0.3;
                    }
                ?>

                
            </div><!-- row -->
        </div>

    </div><!-- row -->
</div><!-- conteudo-wrapper -->