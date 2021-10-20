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
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css\style_index.css">
        <meta name="title" content="Delivery MVC">
        <meta name="description" content="Sistema de estoque alimentado por duas aplicações, onde uma controla o estoque dos produtos e a outra faz a compra.">
        <meta name="keywords" content="site, painel, estoque, mvc">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="Portuguese">
        <meta name="author" content="Filipe Bomfim Santos Furtado">
        <title>Escolha o Sistema</title>
    </head>

    <body>
        <div class="selecao">
            <div class="row">
                <a class="col-md-6 cover" style="background-image: url(<?php echo INCLUDE_PATH?>img/painel_background.jpg" href="<?php echo INCLUDE_PATH_PAINEL?>">
                    <div class="bg-transp"></div>
                    <span>PAINEL</span>
                </a>
                <a class="col-md-6 cover" style="background-image: url(<?php echo INCLUDE_PATH?>img/site_background.jpg" href="<?php echo INCLUDE_PATH_SITE?>">
                    <div class="bg-transp"></div>
                    <span>SITE</span>
                </a>
            </div><!-- row -->
        </div><!-- selecao -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html> 