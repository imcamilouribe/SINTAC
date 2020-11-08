<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';

    if (isset($_SESSION['usuario'])) {
        //limite 15 min

        $inactivo = 1800;

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

        $res = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$nom'");

        //se inicia ciclo while para imprimir datos en la tabla
        while ($row = mysqli_fetch_row($res)) {
            $tipo = $row[2];
        }

        if ($tipo == 2) {
            echo '<script> alert("Acceso denegado.");</script>';
            session_destroy();
            echo '<script> window.location="index.php"; </script>';

        } else if ($tipo == 3) {
            echo '<script> alert("Acceso denegado.");</script>';
            session_destroy();
            echo '<script> window.location="index.php"; </script>';
        } else {

            //sentencias de consultas
            $resultados = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$nom'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $codigo   = $row[0];
                $apellido = $row[1];
                $nombre   = $row[2];
            }
            mysqli_close($conectar);
            ?>
    <!Doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="Images/logo.png" type="image/x-icon">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Css/css.css">
        <script src="Js/reloj.js"></script>
        <title>Sistema de Información de Tutorías Academicas</title>
    </head>
    <body id="body-inicial">
        <div class="bg-dark" id="menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="estudiantes.php"><img src="images/misc-_user-256.png" alt="USUARIO" class="img-circle" width="auto" height="30"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bienvenido: <?php echo " $nombre" ?>!
                                    </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#"><img src="images/user-512.png" width="15px" height="auto"> Ver Perfil</a>
                                    <a class="dropdown-item" href="#"> <span class="glyphicon glyphicon-search"></span><img src="images/f085-512.png" width="15px" height="auto"> Editar Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"><span class="glyphicon glyphicon-log-out"></span><img src="images/sign-out-128.png" width="15px" height="auto"> Cerrar sesión</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav pull-right">
                            <li class="nav-bar item">
                                <a href="http://www.utbvirtual.edu.co/" class="nav-link dropdown">SAVIO</a>
                            </li>
                            <li class="nav-bar item">
                                <a href="http://www.unitecnologica.edu.co/" class="nav-link dropdown">UTB</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center">
                    <img src="http://www.utb.edu.co/sites/web.unitecnologica.edu.co/files/logo_color_2_1.png" title="Universidad Tecnológica de Bolívar" alt="Universidad Tecnológica de Bolívar" role="presentation">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
                    <h1 id="h1-nombre"><strong> Universidad Tecnológica de Bolívar </strong></h1>
                    <h2 id="h2-id"><small>ID: <?php echo " $codigo" ?></small></h2>
                    <h2 id="h2-usuario"><small>Usuario: <?php echo " $nombre $apellido" ?></small></h2>
                    <h2 id="h2-hora">
                            <?php
    include 'fecha.php';
            ?>
                            <body onload="javascript:reloj()">
                                <div id="contenedor"></div>
                            </body>
                        </h2>
                </div>
                <div class="col-lg-3 d-none d-lg-block text-right">
                    <img src="Images/SINTAC1.png" alt="SINTAC" width="100%" title="SINTAC" role="presentation">
                </div>
            </div>
        </div>
        <br>

        <!-- Menu con logica de usuarios -->
        <?php include 'menu.php';?>

        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <img src="Images/bannersintac1.png" alt="SINTAC" width="100%">
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

        <div class="container">
            <br>
            <div class="row">
                <div id="bloque-presetancion" class="col-md-12">
                    <br>
                    <h5 class="text-center">
            <strong>Sistema de Información de Tutorías Academicas <br> <small><em title="Sistema de Información de Tutorías Academicas">-SINTAC-</em></small>
            </strong>
            </h5>
                    <hr/>

                    <div class="container" id="psin">
                        <p>

                            Este Sistema nos permite llevar un registro de las sesiones que realizan los estudiantes con sus tutores, para que esto quede sistematizado y podamos llevar un control sobre todo lo que se lleva a cabo en cada sesion.
                            <br>
                            <br>
                            <strong>¿Que es una Tutoria?</strong>

                            <br> La <strong>TUTORIA</strong> es la actividad en la que el <strong>TUTOR</strong> y el alumno se reunen fisicamente para revisar el estado academico del estudiante, así como su avance y rendimiento y a partir de esa información el TUTOR da orientaciones y hace recomendaciones al estudiante, las cuales están orientadas a mejorar su desempeño académico
                            <br>

                            <cite><strong>NOTA: </strong>Debemos tener claro que la tutoria NO ES un espacio para atencion u orientacion psicologica, temas que son cubiertos por los programas de Bienestar Universitario.</cite>
                            <br>
                        </p>
                        <hr class="my-4">
                        <p class="text-center">Para tener un buen uso de <strong title="Sistema de Informacion de Tutorias Academicas">SINTAC</strong> lo invitamos a ver un pequeño tutorial de como usar este sistema.
                            <br>
                            <br>
                            <a class="btn btn-outline-success" title="Tutorial" href="#" role="button">Tutorial</a>
                        </p>
                        <br>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="Bootstrap/js/bootstrap.js"></script>
        <br>
        <?php include 'footer.php';?>
    </body>
    </html>
    <?php
    }
    } else {
        echo '<script> alert("por favor iniciar sesión en SINTAC.");</script>';
        echo '<script> window.location="index.php"; </script>';
    }
    mysqli_close($conectar);
    ?>