<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';

    if (isset($_SESSION['usuario'])) {

        //Destruye la sesion si tiene mucho tiempo inactivo el usuario
        include 'inactivo.php';
        $nom = $_SESSION['usuario'];
        //sentencias de consultas

        $res = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$nom'");

        //se inicia ciclo while para imprimir datos en la tabla
        while ($row = mysqli_fetch_row($res)) {
            $tipo = $row[2];
        }

        if ($tipo == 1) {
            echo '<script> alert("Acceso denegado.");</script>';
            session_destroy();
            echo '<script> window.location="index.php"; </script>';

        }else if ($tipo == 2){
            echo '<script> alert("Acceso denegado.");</script>';
            session_destroy();
            echo '<script> window.location="index.php"; </script>';
            
        } else {

            $resultados = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$nom'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $codigo   = $row[0];
                $apellido = $row[1];
                $nombre   = $row[2];
            }

            if (isset($_POST['inactivar'])) {
                $baneo_desbaneo = $_POST['baneo_desbaneo'];
                $inactivar      = $_POST['inactivar'];

                $log = $log = "UPDATE `usuarios` SET `bloqueado`= '1' WHERE `id_usuario` = '$baneo_desbaneo'";

                $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

                echo '<script> alert("Se inactivado el usuario.");</script>';
                echo '<script> window.location="activar_inactivar.php"; </script>';

            } else if (isset($_POST['activar'])) {
                $baneo_desbaneo = $_POST['baneo_desbaneo'];
                $activar        = $_POST['activar'];

                $log = $log = "UPDATE `usuarios` SET `bloqueado`= '0' WHERE `id_usuario` = '$baneo_desbaneo'";

                $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

                echo '<script> alert("Se ha activado el usuario.");</script>';
                echo '<script> window.location="activar_inactivar.php"; </script>';

            } else if (isset($_POST['activar_inactivar'])) {

                $baneo_desbaneo = $_POST['baneo_desbaneo'];

                $log = $log = "SELECT * FROM `usuarios` WHERE `id_usuario` = '$baneo_desbaneo'";

                $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

                if (mysqli_num_rows($sintac) == 0) {
                    $columna = mysqli_fetch_array($sintac);

                    echo '<script> alert("Este usuario no existe.");</script>';
                    echo '<script> window.location="activar_inactivar.php"; </script>';

                } else {

                    //sentencias de consultas
                    $resfull = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$baneo_desbaneo'");

                    //se inicia ciclo while para imprimir datos en la tabla
                    while ($row = mysqli_fetch_row($resfull)) {
                        $tipo      = $row[2];
                        $bloqueado = $row[4];
                    }

                    if ($tipo == '1') {

                        $res_estu = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$baneo_desbaneo'");

                        while ($row = mysqli_fetch_row($res_estu)) {

                            $codigo_estu   = $row[0];
                            $apellido_estu = $row[1];
                            $nombre_estu   = $row[2];
                            $correo_estu   = $row[8];
                            $numero_estu   = $row[9];

                            $codigo_acu   = $codigo_estu;
                            $apellido_acu = $apellido_estu;
                            $nombre_acu   = $nombre_estu;
                            $correo_acu   = $correo_estu;
                            $numero_acu   = $numero_estu;
                        }

                    } else if ($tipo > '1') {

                        $res_prof = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$baneo_desbaneo'");

                        while ($row = mysqli_fetch_row($res_prof)) {
                            $codigo_prof   = $row[0];
                            $apellido_prof = $row[1];
                            $nombre_prof   = $row[2];
                            $correo_prof   = $row[5];
                            $numero_prof   = $row[6];

                            $codigo_acu   = $codigo_prof;
                            $apellido_acu = $apellido_prof;
                            $nombre_acu   = $nombre_prof;
                            $correo_acu   = $correo_prof;
                            $numero_acu   = $numero_prof;
                        }

                    } else {

                        echo '<script> alert("Este usuario no esta registrado.");</script>';
                        echo '<script> window.location="desbloqueoacceso.php"; </script>';
                    }

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
        <b>
            <div class="bg-dark" id="menu">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="navbar-brand" href="profesoresadmin.php"><img src="images/misc-_user-256.png" alt="USUARIO" class="img-circle" width="auto" height="30"></a>
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
        <br>


        <div class="container">
            <div class="row">
                <div id="bloque-presetancion" class="col-md-12">
                    <br>
                    <p class="text-center">
                        <strong>Información del Afectado<br>
            </strong>
                        </strong>
                    </p>
                    <hr>
                    <div class="table-responsive text-center" id="psin">
                        <table class="table">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Nombre completo</th>
                                    <th scope="col">Correo electronico</th>
                                    <th scope="col">Telefono/Extensión</th>
                                    <th scope="col"></th>
                                    <tbody>
                                        <tr>
                                            <?php

                if ($bloqueado == 0) {

                    echo '<tr>
              <th scope="row">' . $codigo_acu . '</th>
              <td>' . $nombre_acu . ' ' . $apellido_acu . '</td>
              <td>' . $correo_acu . '</td>
              <td>' . $numero_acu . '</td>
              <td><form class="text-right" id="boton-formulario" action="activar_inactivar_2.php" method="post">
                             <input type="hidden" name="baneo_desbaneo" class="form-control" value="' . $baneo_desbaneo . '">
                             <button type="submit" class="btn btn-danger" name="inactivar">INACTIVAR</button>
                             </form>
              </tr>';

                } else {

                    echo '<tr>
              <th scope="row">' . $codigo_acu . '</th>
              <td>' . $nombre_acu . ' ' . $apellido_acu . '</td>
              <td>' . $correo_acu . '</td>
              <td>' . $numero_acu . '</td>
              <td><center><form id="boton-formulario" action="activar_inactivar_2.php" method="post">
                         <input type="hidden" name="baneo_desbaneo" class="form-control" value="' . $baneo_desbaneo . '">
                         <button type="submit" class="btn btn-success" name="activar">ACTIVAR</button>
                        </form></center>
              </tr>';

                }
                ?>
                                        </tr>
                                    </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <br>

        <div class="container">
            <div class="row">
                <div id="bloque-presetancion" class="col-md-12">
                    <br>
                    <p class="text-center">
                        <strong>Activar/Inactivar usuarios<br>
            </strong>
                    </p>
                    <hr/>
                    <center>
                        <form id="form-desbloqueo" action="activar_inactivar_2.php" method="post">
                            <div class="text-center mb-4">
                                <img class="mb-2" src="images/bloquear.png" alt="" width="auto" height="80">
                                <hr>
                                <h1 class="h3 mb-3 font-weight-normal access"><b>ACTIVAR/INACTIVAR USUARIOS</b></h1>
                            </div>
                            <div class="form-label-group">
                                <!--<label for="inputEmail">ID de usuario</label> -->
                                <input type="text" name="baneo_desbaneo" class="form-control" placeholder="BUSCAR POR CODIGO" value="<?php echo " $baneo_desbaneo "; ?>" required>
                            </div>
                            <br>
                            <button class="btn btn-lg btn-success btn-block" name="activar_inactivar" type="submit">BUSCAR</button>
                        </form>
                    </center>
                    <br>
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
    <?php
    } else {

                echo '<script> window.location="activar_inactivar.php"; </script>';
            }

        }
    } else {
        echo '<script> alert("Por favor iniciar sesión en SINTAC.");</script>';
        echo '<script> window.location="index.php"; </script>';
    }
    mysqli_close($conectar);
    ?>