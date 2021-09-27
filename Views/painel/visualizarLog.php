<div class="conteudo titulo">
    <i class='bx bx-home-alt'></i>
    <span>Registros</span>
</div>

<div class="conteudo">
    <div class="row">
        <div class="col-md-2 text-center">
            <div class="filtro">
                <div class="btn-group-vertical filtro-log">
                    <a href="<?php echo INCLUDE_PATH ?>log/visualizarLog">
                        <button type="button" class="btn btn-outline-primary">Todos</button>
                    </a>

                    <?php 
                        foreach ($this->dados['tipoLog'] as $key => $value) {
                    ?>
                        <a href="<?php echo INCLUDE_PATH ?>log/visualizarLog/<?php echo $value['log_tipo_id'] ?>">
                            <button type="button" class="btn btn-outline-primary"><?php echo $value['log_tipo_nome'] ?></button>
                        </a>
                    <?php
                        }
                    ?>   
                </div>   
            </div> 
        </div>
        
        
        <table class="table table-sm col-xl-9 col-lg-8 col-md-7 col-sm-11 mx-auto">
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
                    ?>
            </tbody>
        </table>
       
    </div><!-- row -->
</div><!-- conteudo -->