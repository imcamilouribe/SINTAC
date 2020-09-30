<?php
    session_start();

    header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

    include 'conexion.php';

    if (isset($_SESSION['usuario'])) {

        //Destruye la sesion si tiene mucho tiempo inactivo el usuario
        include 'inactivo.php';

        if (isset($_POST["eliminar"])) {

        $id       = $_POST["id"];
        $fecha    = $_POST["fecha"];
        $hora_ini = $_POST["hora_ini"];
        $hora_fin = $_POST["hora_fin"];

        $log = $log = "DELETE FROM `disponibilidad` WHERE `id_tutor` = '$id' AND `fecha` = '$fecha' AND `hora_inicio` = '$hora_ini' AND `hora_fin` = '$hora_fin'";

        $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

                        $logss = $logss = "DELETE FROM `agenda` WHERE `id_tutor` = '$id' AND `fecha` = '$fecha'";

                        $sintac = mysqli_query($conectar, $logss) or die("Algo ha ido mal en la consulta a la base de datos");
                         

        echo '<script> alert("Horario eliminado.");</script>';
        echo '<script> window.location="disponibilidad2.php"; </script>';
    }

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

        } else {

            $resultados = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$nom'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $codigo   = $row[0];
                $apellido = $row[1];
                $nombre   = $row[2];
            }
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
        <?php

            include 'conexion.php';
            
            $fecha_actual = date("Y-m-d");
            $res1 = mysqli_query($conectar, "SELECT * FROM `disponibilidad` WHERE `id_tutor` = '$nom' AND `fecha` >= '$fecha_actual'");

            if (mysqli_num_rows($res1) > 0)
            {

                echo 
                '<br>
                <div class="container">
            <div class="row">
            <div id="bloque-presetancion" class="col-md-12">
            <br>
            <p class="text-center">
            <strong>Horarios agendados<br>
            </strong>
            </p>
            <hr>
               <div id="psin" class="table-responsive text-center">
               <form id="form_max" id="form-desbloqueo" method="post" action="disponibilidad2.php">
                 <table class="table">
                     <thead class="table-secondary">
                         <tr>
                             <th>Id</th>
                             <th scope="col">Fecha</th>
                             <th scope="col">Hora de Inicio</th>
                             <th scope="col">Hora de Fin</th>
                             <th scope="col"></th>
                         </tr>
                     </thead>
                     <tbody>';
                      
                $result = mysqli_query($conectar, "SELECT * FROM `disponibilidad` WHERE `id_tutor` = '$nom' AND `fecha` >= '$fecha_actual'");

                while ($row = mysqli_fetch_row($result)) {

                    echo '
                         <tr>
                             <th scope="row">' . $row[0] . '</th>
                             <td>' . $row[1] . '</td>
                             <td>' . $row[3] . '</td>
                             <td>' . $row[4] . '</td>
                             <td><form class="text-right text-center" id="boton-formulario" action="disponibilidad2.php" method="post">
                             <input type="hidden" name="id" class="form-control" value="' . $row[0] . '">
                             <input type="hidden" name="fecha" class="form-control" value="' . $row[1] . '">
                             <input type="hidden" name="hora_ini" class="form-control" value="' . $row[3] . '">
                             <input type="hidden" name="hora_fin" class="form-control" value="' . $row[4] . '">
                             <button type="submit" class="btn btn-danger" name="eliminar">ELIMINAR</button>
                             </form>
                        </tr>';
                            }
                            echo '</tbody>
                             </table>
                             </form>
                             </div>
                             </div>
                            </div>
                             </div>';
                         }

            ?>

            <br>

            <div class="container">
                <div class="row">
                    <div id="bloque-presetancion" class="col-md-12">
                        <br>
                        <p class="text-center">
                            <strong>Disponibilidad de horario<br>
            </strong>
                        </p>
                        <hr>
                        <div class="table-responsive" id="psin">
                            <table class="table table table-bordered text-center">
                                <thead>
                                    <tr class="table-secondary">
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th id="thdispo"></th>
                                        <form id="form-desbloqueo" method="post" action="disponible2.php">
                                            <th id="th_asignar"><input type="date" class="form-control" name="fechas" required></th>
                                    </tr>
                                </thead>
                                <tbody id="thclick">

                                    <?php
                               
                            $resultado = mysqli_query($conectar, "SELECT * FROM `turnos_profesores`");
                            $turno = 1;
                            //se inicia ciclo while para imprimir datos en la tabla
                            while ($row1 = mysqli_fetch_row($resultado)) {

                            echo '
                            <tr onclick="seleccionar(this,'.$turno.')">
                            <th>'.$row1[1].'</th>
                            <th>'.$row1[2].'</th>
                            <th id="thdispo"> </th>
                            <th id="tablam"><input type="checkbox" name="check[]" value="'.$turno.'" id="chk'.$turno.'"></th>
                            </tr>

                                ';

                                $turno++;   
                                                  }
                            ?>
                                </tbody>
                            </table>
                            <center>
                                <button type="submit" class="btn btn-lg btn-success" name="enviar">REGISTRAR</button>
                            </center>
                            <br>
                            </form>
                        </div>

                        <script>
                            function seleccionar(tr,value){
                                                    $(function(){
                                                        if($("#chk"+value).attr("checked") == "checked"){
                                                            $("#chk"+value).removeAttr("checked");
                                                            $(tr).css("background-color","#FFFFFF");
                            
                                                        }
                                                        else{
                                                            $("#chk"+value).attr("checked","true");
                                                            $(tr).css("background-color","#BEDAE8");
                                                        }
                                                    })
                                                }
                            
                        </script>
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