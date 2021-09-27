<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\dashboard.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\style.css">
    <title>Sistema de Estoque</title>
</head>
    <body>

    <div class="wrapper d-flex align-items-stretch">
        <nav class="navbar-dark overflow-auto vh-100 sticky-top" id="sidebar">
            <div class="p-4 pt-5">
                <div class="perfil mx-auto">
                    <a href="#" class="d-flex flex-column mx-auto align-items-center text-white text-decoration-none">
                        <img src="<?php echo INCLUDE_PATH?>img/perfil-2.jpg" alt="hugenerd" width="64" height="64" class="rounded-circle">
                        <div class="perfil-txt d-inline-flex flex-column justify-content-center align-items-center">
                            <span>Bem Vindo</span>
                            <span>Administrador</span>
                        </div>  
                    </a>
                </div><!-- perfil -->
                <ul class="list-unstyled components mb-5">
                    
                    <li>
                        <a href="<?php echo INCLUDE_PATH_PAINEL?>" class="align-middle">
                            <i class='bx bx-home-alt'></i> 
                            <span class="ms-1 .d-block  d-sm-inline primary">Home</span>
                        </a>
                    </li>

                
                    <li>
                        <a href="#itensSubmenu" data-toggle="collapse" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle align-middle">
                            <i class='bx bx-list-ul'></i>
                            <span class=".d-block  d-sm-inline">Itens</span>
                        </a>
                        <ul class="collapse list-unstyled" id="itensSubmenu">
                            <li>
                                <a href="<?php echo INCLUDE_PATH_PAINEL?>item/visualizarItens">
                                    <i class='bx bx-show'></i>
                                    <span class=".d-block d-sm-inline">Visualizar</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo INCLUDE_PATH_PAINEL?>item/cadastrarItem">
                                    <i class='bx bx-plus-circle'></i>
                                    <span class=".d-block  d-sm-inline">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#servicosSubmenu" data-bs-toggle="collapse" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle align-middle">
                            <i class='bx bx-border-all'></i>
                            <span class=".d-block  d-sm-inline">Categorias</span>
                        </a>
                        <ul class="collapse list-unstyled" id="servicosSubmenu">
                            <li>
                                <a href="#">
                                    <i class='bx bx-show'></i>
                                    <span class=".d-block  d-sm-inline">Visualizar</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-plus-circle'></i>
                                    <span class=".d-block  d-sm-inline">Cadastrar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo INCLUDE_PATH ?>home" class="align-middle">
                            <i class='bx bx-line-chart'></i>
                            <span class="ms-1 .d-block  d-sm-inline primary">Estatísticas</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>log/visualizarLog" class="align-middle">
                            <i class='bx bx-notepad'></i>
                            <span class="ms-1 .d-block  d-sm-inline primary">Registros</span>
                        </a>
                    </li>
            </div>
        </nav>

        <!-- Conteúdo  -->
      
      <div id="content">
      
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class='bx bx-menu-alt-left'></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
          
            <div class="loggout ">
              <ul class="nav navbar-nav">
                <li class="nav-item d-flex">
                    <a href="#" class="nav-link nav-item align-middle">
                        <i class='bx bx-log-out'></i>
                        <span class="ms-1 .d-block  d-sm-inline primary">Configurações</span>
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container">
            <!--------------------------------------------------->
            <?php 
                $this->carregarViewnoTemplate($nomeView,$dadosModel);
            ?>
            <!--------------------------------------------------->
        </div><!-- Conteúdo Dinâmico -->       

      </div>
    </div>