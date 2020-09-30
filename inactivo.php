<?php 
        //limite 1 hora y media
    $inactivo = 2700;

        if (isset($_SESSION['tiempo'])) {
            $vida_session = time() - $_SESSION['tiempo'];
            if ($vida_session > $inactivo) {
                session_destroy();
                echo '<script> alert("Demasiado tiempo inactivo su sesion caduco, vuelva a iniciar sesion.");</script>';
                echo '<script> window.location="index.php"; </script>';
            }
        }

        $_SESSION['tiempo'] = time();

    ?>