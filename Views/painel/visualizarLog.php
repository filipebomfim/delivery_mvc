<div class="conteudo titulo animate__animated animate__fadeInUp">
    <i class='bx bx-home-alt'></i>
    <span><?php echo $this->dados['titulo'] ?></span>
</div>

<div class="conteudo animate__animated animate__fadeInUp">
    <div class="row">
        <div class="col-md-2 col-sm-12 text-center mt-4">
            <div class="filtro">
                <div class="btn-group-vertical d-none d-sm-block filtro-log">
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>log/visualizarLog">
                        <button type="button" class="btn btn-outline-primary">Todos</button>
                    </a>

                    <?php 
                        foreach ($this->dados['tipoLog'] as $key => $value) {
                    ?>
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>log/visualizarLog/<?php echo $value['log_tipo_id'] ?>">
                            <button type="button" class="btn btn-outline-primary"><?php echo $value['log_tipo_nome'] ?></button>
                        </a>
                    <?php
                        }
                    ?>   
                </div>   

                <div class="btn-group-vertical d-block d-sm-none filtro-log ">
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>log/visualizarLog">
                        <button type="button" class="btn btn-outline-primary">Todos</button>
                    </a>

                    <?php 
                        foreach ($this->dados['tipoLog'] as $key => $value) {
                    ?>
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>log/visualizarLog/<?php echo $value['log_tipo_id'] ?>">
                            <button type="button" class="btn btn-outline-primary"><?php echo $value['log_tipo_nome'] ?></button>
                        </a>
                    <?php
                        }
                    ?>   
                </div>   
            </div> 
        </div>
        
        <div class="col-xl-9 col-lg-8 col-md-6 col-sm-12 table-responsive mx-auto ">
        <?php if(empty($this->dados['log'])){
                    echo '<div class="d-flex justify-content-center align-items-center" role="alert">
                        <i class="bx bx-x pe-1"></i>
                        Nenhum Item cadastrado!
                    </div>';
                }else{
        ?>
            <table class="table align-middle table-sm">
                <thead class=" table-dark">
                    <tr >
                        <th scope="col">Ação</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Hora</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            foreach ($this->dados['log'] as $key => $value) {
                        ?>
                        <tr>

                        <td><?php echo $value['log_tipo_nome'] ?></td>
                        <td><?php echo $value['log_descricao'] ?></td>
                        <td><?php echo date('d/m/Y H:i:s',strtotime($value['log_registro'])) ?></td>

                        </tr>
                        <?php 
                            }
                }
                        ?>
                </tbody>
            </table>
        </div>
       
       
    </div><!-- row -->
</div><!-- conteudo -->