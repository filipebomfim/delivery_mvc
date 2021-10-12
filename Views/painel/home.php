
    <div class="conteudo titulo animate__animated animate__fadeInUp">
        <i class='bx bx-home-alt'></i>
        <span>Home</span>
    </div>
     
        <div class="row mt-3">
            <div class="dbox-wrapper col-lg-4 col-md-12 animate__animated animate__fadeInUp">
                <div class="dbox dbox--color-1">
                    <div class="dbox__body">
                        <div class="row">
                            <div class="dbox-text col-md-8 col-6">
                                <span class="dbox__count">40.000</span>
                                <hr>
                            </div><!-- dbox-text -->     
                            <div class="dbox-icon col-md-4 col-6">
                                <i class='bx bxs-dollar-circle'></i>
                            </div><!-- dbox-icon -->                           
                            <span class="dbox__title ">Lucro com vendas</span>
                        </div><!-- row -->
                    </div>			
                </div><!-- dbox -->
            </div>
            <div class="dbox-wrapper col-lg-4 col-md-12 animate__animated animate__fadeInUp">
                <div class="dbox dbox--color-3">
                    <div class="dbox__body">
                        <div class="row">
                            <div class="dbox-text col-md-8 col-6">
                                <span class="dbox__count"><?php echo count($this->dados['qtdItens'])?></span>
                                <hr>
                            </div><!-- dbox-text -->     
                            <div class="dbox-icon col-md-4 col-6">
                                <i class='bx bxs-food-menu'></i>
                            </div><!-- dbox-icon --> 
                            <span class="dbox__title ">Total de Itens</span>                          
                            
                        </div><!-- row -->
                    </div>			
                </div><!-- dbox -->

            </div>
            <div class="dbox-wrapper col-lg-4 col-md-12 animate__animated animate__fadeInUp">
                <div class="dbox dbox--color-2">
                    <div class="dbox__body">
                        <div class="row">
                            <div class="dbox-text col-md-8 col-6">
                                <span class="dbox__count">40</span>
                                <hr>
                            </div><!-- dbox-text -->     
                            <div class="dbox-icon col-md-4 col-6">
                                <i class='bx bxs-caret-up-circle'></i>
                            </div><!-- dbox-icon -->   
                            <span class="dbox__title ">Vendas em 24 horas</span>                          
                        </div><!-- row -->                            
                    </div>			
                </div><!-- dbox -->
            </div>
        </div><!-- row --> 
    
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="conteudo home-stats animate__animated animate__fadeInUp">
            <div class="subtitulo">
                <i class='bx bx-notepad'></i>
                <span class="d-sm-inline">Últimos Registros</span>
            </div><!-- subtitulo -->
            <table class="table table-sm">
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
                        if($key == 4) break;
                            }
                        ?>
                    
                </tbody>
            </table>
        </div><!-- conteudo -->
    </div>

    <div class="col-xl-6 col-lg-12">
        <div class="conteudo home-stats animate__animated animate__fadeInUp">
            <div class="subtitulo">
                <i class='bx bx-line-chart'></i>
                <span class="d-sm-inline">Vendas do Dia</span>
            </div><!-- subtitulo -->
            <table class="table table-sm">
                <thead class=" table-dark">
                    <tr >
                        <th scope="col">Login</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cargo</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div><!-- conteudo -->
    </div>

</div><!-- row -->


      
    