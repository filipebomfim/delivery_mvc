<?php 
        if($_SESSION['status'] == 'sucesso') {
            echo '<div class="alert-check alert-success" role="alert">
                    <i class="bx bx-check pe-2"></i>'
                    .$_SESSION['status_msg'].
                '</div>';
        }else if($_SESSION['status'] == 'erro'){
            echo '<div class="alert-check alert-danger" role="alert">
                    <i class="bx bx-error-circle pe-2"></i>'
                    .$_SESSION['status_msg'].
                 '</div>';
        }

        unset($_SESSION['status']);
?>