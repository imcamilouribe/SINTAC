<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';

    if (isset($_SESSION['usuario'])) {
        //limite 15 min

        $inactivo = 900;

        if (isset($_SESSION['tiempo'])) {
            $vida_session = time() - $_SESSION['tiempo'];
            if ($vida_session > $inactivo) {
                session_destroy();
                echo '<script> alert("Demasiado tiempo inactivo su sesion caduco, vuelva a iniciar sesion.");</script>';
                echo '<script> window.location="index.php"; </script>';
            }
        }

        $_SESSION['tiempo'] = time();
        $nom                = $_SESSION['usuario'];
        //sentencias de consultas

        $res = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$nom'");

        //se inicia ciclo while para imprimir datos en la tabla
        while ($row = mysqli_fetch_row($res)) {
            $tipo = $row[2];

        }

        if ($tipo == '1') {

            $resultados = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$nom'");

        } else {

            $resultados = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$nom'");

        }

        //se inicia ciclo while para imprimir datos en la tabla
        while ($row = mysqli_fetch_row($resultados)) {
            $codigo   = $row[0];
            $apellido = $row[1];
            $nombre   = $row[2];
        }
    }
    mysqli_close($conectar);

    ?>
    <!Doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Acceso - Sistema de Información de Tutorías Academicas</title>
        <!-- Bootstrap core CSS -->
        <link rel="icon" href="Images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="Css/css.css">
    </head>

    <body id="bodylogin">

        <br>
        <br>
        <br>
        <br>


        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-signin" action="logout.php" method="post">
                        <div class="text-center mb-4">
                            <img class="mb-2" src="images/logosintac.png" alt="" width="auto" height="100">
                            <hr>
                            <h1 class="h3 mb-3 font-weight-normal access"><b>Confirmar</b></h1>
                        </div>
                        <p id="psin">Usted ya está en el sistema como
                            <?php echo "$nombre $apellido"; ?> , es necesario cerrar la sesión antes de acceder como un usuario diferente.
                            <p>
                                <div class="text-center">
                                    <button class="btn btn-danger" name="login" type="submit">SALIR</button> <a href="sesion_iniciada2.php" class="btn btn-success" role="button">CANCELAR</a>
                                </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>