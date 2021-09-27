<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\dashboard.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\style.css">
    <title>Sistema de Estoque</title>
</head>
    <body>
        <div class="wrapper d-flex align-items-stretch">
	        <nav class="sidebar bg-light overflow-auto vh-100 sticky-top" id="sidebar">
		        <div>
                    <div class="perfil mx-auto">
                        <a href="#" class="d-flex flex-column align-items-center text-white text-decoration-none">
                            <img src="<?php echo INCLUDE_PATH?>img/perfil-2.jpg" alt="hugenerd" width="64" height="64" class="rounded-circle">
                            <div class="perfil-txt d-inline-flex flex-column justify-content-center align-items-center">
                                <span>Bem Vindo</span>
                                <span>Administrador</span>
                            </div>  
                        </a>
                    </div><!-- perfil -->
	                <ul class="list-unstyled components mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH?>">
                                <i class='bx bx-home-alt'></i>
                                <span>Home</span>
                            </a>
                        </li>
                         <hr>
                         <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH?>item/visualizarItens">
                                <i class='bx bx-show'></i>
                                <span>Visualizar Itens</span>
                            </a>
                         </li>
                         <hr>
                         <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH?>item/cadastrarItem">
                                <i class='bx bxs-plus-square'></i>
                                <span>Cadastrar Item</span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH?>item/atualizarItem">
                                <i class='bx bx-edit-alt'></i>
                                <span>Cadastrar Categoria</span>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo INCLUDE_PATH?>item/removerItem">
                                <i class='bx bxs-minus-square'></i>
                                <span>Ver Registros</span>
                            </a>
                        </li>
                        <hr>
                    </ul>
                </div>
    	    </nav>

        <!-- Conteúdo  -->
      <div class="conteudo" id="content">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
         
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class='bx bx-menu-alt-left'></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
          
            <div class="confs ml-auto">
              <ul class="nav navbar-nav">
                <li class="nav-item d-flex ">
                    <a href="" class=" mt-1 ps-2 pe-2 nav-link nav-item align-middle ">
                        <i class='bx bx-cog'></i>
                        <span class="ms-1 .d-block d-sm-inline primary">Configurações</span>
                    </a>
                </li>
              </ul>
            </div>
         
        </nav>

        <div class="container">            
            <!--------------------------------------------------->
            <?php 
                $this->carregarViewnoTemplate($nomeView,$dadosModel);
            ?>
            <!--------------------------------------------------->
        </div><!-- container -->


        </div>
    </div>



