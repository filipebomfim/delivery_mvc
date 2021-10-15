<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\style_site.css">
    <title>Site Principal</title>
</head>
    <body>

        <header class="menu autohide">
            <div class="container">
                <nav class="row">
                    <div class="col-md-2 d-flex justify-content-center">
                        <a href="<?php echo INCLUDE_PATH_SITE ?>carrinho" class="nav-link nav-item align-middle">
                            <button type="button" class="d-flex justify-content-center carrinho btn btn-primary position-relative">
                                <i class='bx bxs-cart'></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php 
                                        if(isset($_SESSION['carrinho'])) echo carrinhoController::CountItensCart();
                                        else echo '0';
                                    ?>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </a>
                    </div>

                    <ul class="nav col-md-8 d-flex justify-content-center">
                        <li><a href="<?php echo INCLUDE_PATH_SITE?>" class="nav-link px-2 link-secondary">Home</a></li>
                        <li><a href="#" class="nav-link px-2 link-dark">Os melhores</a></li>
                        <li><a href="<?php echo INCLUDE_PATH_SITE?>cardapio" class="nav-link px-2 link-dark">Cardápio</a></li>
                    </ul>

                    <div class="loggout col-md-2 d-flex justify-content-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-flex">
                                <a href="<?php echo INCLUDE_PATH?>" class="nav-link nav-item align-middle">
                                    <i class='bx bx-log-out'></i>
                                    <span class="d-block  d-sm-inline primary">Sair</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    
                </nav>
            </div><!-- container -->
        </header>

            <!--------------------------------------------------->
            <?php 
                $this->carregarViewnoTemplate($nomeView,$dadosModel);
            ?>
            <!--------------------------------------------------->     
