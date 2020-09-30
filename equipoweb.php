<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';
    $nom = $_SESSION['usuario'];
    $resultados = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$nom'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $codigo   = $row[0];
                $apellido = $row[1];
                $nombre   = $row[2];
            }

            $resultados = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$nom'");

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
        <b><div class="bg-dark" id="menu">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="navbar-brand" href="#"><img src="images/misc-_user-256.png" alt="USUARIO" class="img-circle" width="auto" height="30"></a>
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
                                    <a href="http://perseo.unitecnologica.edu.co" class="nav-link dropdown">SIRIUS</a>
                                </li>
                                <li class="nav-bar item">
                                    <a  href="http://www.utbvirtual.edu.co/" class="nav-link dropdown">SAVIO</a>
                                </li>
                                <li class="nav-bar item">
                                    <a  href="http://www.unitecnologica.edu.co/" class="nav-link dropdown">UTB</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            </b>
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
                            <?php include 'fecha.php';?>
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
        <br>
        <div class="container">
            <div id="bloque-presetancion">
                <div class="container">
                    <br>
                    <div>
                        <h1 class="st-blue"> Equipo Web</h1>
                        <br>
                    </div>
                    <div class="view hm-zoom">
                        <img src="Images/imagen.jpg" class="img-responsive img-fluid" alt="">
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-1" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/imagen.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/mantiavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Juan C. Mantilla</h4>
                                        <hr>
                                        <h5>Jefe de Proyecto<br>Scrum master</h5>

                                    </div>

                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-1" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/edilimg.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/edilavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Edilberto Marrugo Gutiérrez</h4>
                                        <hr>
                                        <h5>Desarrollador web Front-End usando: HTML5, CSS3, JavaScript<br>Back-End: PHP, SQL, MySql<br>CMS: Bootstrap v4.1.</h5>
                                    </div>
                                    <!--/.Front Side-->
                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-2" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/edwinimg.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/edwinavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Edwin López Salgado</h4>
                                        <hr>
                                        <h5>Desarrollador web Front-End usando: HTML5, CSS3, JavaScript<br>CMS: Bootstrap v4.1.<br>y Diseñador Grafico</h5>

                                    </div>
                                    <!--/.Front Side-->



                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-1" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/camiloimg.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/camiloavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Camilo Uribe Navas</h4>
                                        <hr>
                                        <h5>Desarrollador web Front-End usando: HTML5, CSS3, JavaScript<br>CMS: Bootstrap v4.1.</h5>

                                    </div>
                                    <!--/.Front Side-->



                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-1" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/joseimg.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/joseavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Jose Buendia Ramos</h4>
                                        <hr>
                                        <h5>Desarrollador web Front-End usando: HTML5, CSS3, JavaScript<br>CMS: Bootstrap v4.1.</h5>

                                    </div>
                                    <!--/.Front Side-->



                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>
                        <div class="col-md-4">

                            <!--Rotating card-->
                            <div class="card-wrapper">
                                <div id="card-1" class="card-rotating effect__click">

                                    <!--Front Side-->
                                    <div class="face card-rotating__front z-depth-1 text-center" id="psin">
                                        <div class="card-up">
                                            <img src="Images/imagen.jpg" class="img-responsive">
                                        </div>
                                        <div class="avatar"><img src="Images/jorgeavatar.png" class="img-circle img-responsive">
                                        </div>
                                        <h4>Jorge Acosta Bravo</h4>
                                        <hr>
                                        <h5>Desarrollador web Fron-Eend usando: HTML5, CSS3, JavaScript<br>CMS: Bootstrap v4.1.</h5>

                                    </div>
                                    <!--/.Front Side-->



                                </div>
                            </div>
                            <!--/.Rotating card-->
                        </div>

                    </div>
                </div>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="Bootstrap/js/bootstrap.js"></script>
            <br>
            <?php include 'footer.php';?>
    </body>
    </html>