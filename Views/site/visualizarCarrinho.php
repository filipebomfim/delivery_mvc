<section class="carrinho">
    <div class="container">
        <div class="titulo mb-5 p-1">
            <p>Carrinho</p>            
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço Unitário</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($this->dados as $key => $value) { ?>
                <tr>
                    <th scope="row"><?php echo $key+1 ?></th>
                    <td> <img src="<?php echo INCLUDE_PATH?>img/<?php echo $value['item_imagem'] ?>" class="rounded mx-auto d-block" alt="" width="128"></td>
                    <td><?php echo $value['item_nome'] ?></td>
                    <td><?php echo $value['cat_nome'] ?></td>
                    <td><?php echo $value['item_quantidade'] ?></td>
                    <td>R$ <?php echo number_format($value['item_preco'],2,',','.')?></td>
                    <td>
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class='modal-button bx bxs-trash bx-tada-hover'  data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $value['item_id'] ?>"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>R$ <?php echo number_format($this->calcCart(),2,',','.')?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>