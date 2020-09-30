<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';

    if (isset($_SESSION['usuario'])) {

        include 'inactivo.php';

        $nom = $_SESSION['usuario'];
        //Destruye la sesion si tiene mucho tiempo inactivo el usuario
        $validar = 0;

        if (isset($_POST["buscar_profe"])) {                  
                           
        $codig_prof = $_POST["codig_prof"];
         $fechas = $_POST["fechas"];

             $fecha_actual = date("Y-m-d");

            if (($fechas == $fecha_actual) || ($fechas > $fecha_actual)) {
            
            $log = $log = "SELECT * FROM `disponibilidad` WHERE `id_tutor` = '$codig_prof' AND `fecha` = '$fechas'";

            $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

        if (mysqli_num_rows($sintac) > 0) {
            $columna = mysqli_fetch_array($sintac);
             $validar = 1;
                          

        }else{

            echo '<script> alert("El tutor no tiene turnos disponibles en este horario.");</script>';
            echo '<script> window.location="agendar_tutoria_estu.php"; </script>';
        }   
        }else{

             echo '<script> alert("No se puede agendar una fecha inferior a la actual.");</script>';
            echo '<script> window.location="agendar_tutoria_estu.php"; </script>';

        }

    }

    if (isset($_POST["confirmar_reserva"])) {

            $codig_prof_2 = $_POST["codig_prof"];
            $fechas_2 = $_POST["fechas"];
            $turno_2 = $_POST["turno"];
            $motivo = $_POST["motivo"];

            $consultar_reserva = $consultar_reserva = "SELECT * FROM `agenda` WHERE `id_tutor` = '$codig_prof_2' AND `fecha` = '$fechas_2' AND `turno` = '$turno_2'";

            $sintac_2 = mysqli_query($conectar, $consultar_reserva) or die("Algo ha ido mal en la consulta a la base de datos");

            if (mysqli_num_rows($sintac_2) > 0) {
            $columna_2 = mysqli_fetch_array($sintac_2);

            echo '<script> alert("El tutor ya tiene este turno ocupado.");</script>';
            echo '<script> window.location="agendar_tutoria_estu.php"; </script>';
            }else{

            $con_reser = $con_reser = "INSERT INTO `agenda`(`id_estudiante`, `id_tutor`, `fecha`, `turno`, `motivo`, `resultado`) VALUES ('$nom','$codig_prof_2','$fechas_2','$turno_2','$motivo','')";

            $si_2 = mysqli_query($conectar, $con_reser) or die("Algo ha ido mal en la consulta a la base de datos");

            echo '<script> alert("consulta registrada.");</script>';
        } 
    }
        //sentencias de consultas

        $res = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$nom'");

        //se inicia ciclo while para imprimir datos en la tabla
        while ($row = mysqli_fetch_row($res)) {
            $tipo = $row[2];
        }

        if ($tipo > 1) {
            echo '<script> alert("Acceso denegado.");</script>';
            session_destroy();
            echo '<script> window.location="index.php"; </script>';

        } else {

            $resultados = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$nom'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $codigo   = $row[0];
                $apellido = $row[1];
                $nombre   = $row[2];
                $tutor_princi   = $row[14];
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
        <?php 

            if ($validar == 1) {

                echo '<div class="container">
                <div class="row">
            <div id="bloque-presetancion" class="col-md-12">
            <br>
            <p class="text-center">
            <strong>Disponibilidad del tutor en la fecha
                <br>
            </strong>
            </p>
            <hr>

                <div class="table-responsive" id="psin">
                    <form id="form_max" id="form-desbloqueo" method="post" action="agendar_tutoria_estu.php">
                    <table class="table table table-bordered text-center">
                        <thead>
                            <tr class="table-secondary">
                                <th>Turno</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th id="thdispo"></th>
                                <th>Motivo</th>
                                <th>Consultar</th>
                            </tr>
                        </thead>
                        <tbody>';

                             $result = mysqli_query($conectar, "SELECT * FROM `disponibilidad` WHERE `id_tutor` = '$codig_prof' AND `fecha` = '$fechas'");
                            //se inicia ciclo while para imprimir datos en la tabla
                            while ($row12 = mysqli_fetch_row($result)) {

                                $turno = $row12[2];

                                if ($turno == 1) {

                                    include 'reserva.php';

                                }else if ($turno == 2){

                                    include 'reserva.php';
                                }else if ($turno == 3){

                                    include 'reserva.php';
                                }else if ($turno == 4){

                                    include 'reserva.php';
                                }else if ($turno == 5){

                                    include 'reserva.php';
                                }else if ($turno == 6){

                                    include 'reserva.php';
                                }else if ($turno == 7){

                                    include 'reserva.php';
                                }
                                else if ($turno == 8){

                                    include 'reserva.php';
                                }else if ($turno == 9){

                                    include 'reserva.php';
                                }else if ($turno == 10){

                                    include 'reserva.php';
                                }else if ($turno == 11){

                                    include 'reserva.php';
                                }else if ($turno == 12){

                                    include 'reserva.php';
                                }

                            }

                        echo '</tbody>
                       </table>
                    </form>
                <br>
                </div>
            </div>
            </div>
            </div>
            <br>';


            }
             ?>

        <div class="container">
            <div class="row">
                <div id="bloque-presetancion" class="col-md-12">
                    <br>
                    <p class="text-center">
                        <strong>Seleccione el tutor y la fecha  deseados
                <br>
            </strong>
                    </p>
                    <hr>

                    <div class="table-responsive" id="psin">
                        <!-- div de busqueda-->
                        <div class="form-group">
                            <input type="text" class="form-control pull-right col-md-3" id="search" placeholder="Buscar..">
                        </div>
                        <form id="form_max" id="form-desbloqueo" method="post" action="agendar_tutoria_estu.php">
                            <table class="table table table-bordered text-center" id="mytable">
                                <thead>
                                    <tr class="table-secondary">
                                        <th>ID tutor</th>
                                        <th>Nombre tutor</th>
                                        <th id="thdispo"></th>
                                        <th>Fecha</th>
                                        <th>Consultar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                            if (empty(trim($tutor_princi))) {
                                
                                //extrae el codigo y con el consulta
                                $resultado = mysqli_query($conectar, "SELECT * FROM `profesores` ORDER BY `nombres`");
                            //se inicia ciclo while para imprimir datos en la tabla
                            while ($row1 = mysqli_fetch_row($resultado)) {
                            echo '
                            <tr">
                            <th>'.$row1[0].'</th>
                            <th>'.$row1[2].' '.$row1[1].'</th>
                            <th id="thdispo"> </th>
                            <form id="form-desbloqueo" method="post" action="agendar_tutoria_estu.php">
                            <th><input type="date" class="form-control" name="fechas" required></th>
                            <input type="hidden" class="form-control" name="codig_prof" value="'.$row1[0].'">
                            <th><button type="submit" class="btn btn-success" name="buscar_profe">CONSULTAR</button></th>
                             </form>
                            </tr>
                                ';
                            }        
                            }else{

                                //extrae el codigo y con el consulta
                                $resultado = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$tutor_princi'");
                            //se inicia ciclo while para imprimir datos en la tabla
                            while ($row1 = mysqli_fetch_row($resultado)) {
                            echo '
                            <tr">
                            <th>'.$row1[0].'</th>
                            <th>'.$row1[2].' '.$row1[1].'</th>
                            <th id="thdispo"> </th>
                            <form id="form-desbloqueo" method="post" action="agendar_tutoria_estu.php">
                            <th><input type="date" class="form-control" name="fechas" required></th>
                            <input type="hidden" class="form-control" name="codig_prof" value="'.$row1[0].'">
                            <th><button type="submit" class="btn btn-success" name="buscar_profe">CONSULTAR</button></th>
                             </form>
                            </tr>
                                ';
                            }        

                            }

        
                
                            ?>

                                </tbody>
                            </table>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery para buscar en la tabla-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Scripts de busqueda para buscar en la tabla-->
        <script>
            // Write on keyup event of keyword input element
                        $(document).ready(function(){
                        $("#search").keyup(function(){
                        _this = this;
                        // Show only matching TR, hide rest of them
                        $.each($("#mytable tbody tr"), function() {
                        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                        else
                        $(this).show();
                        });
                        });
                        });
            
        </script>
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