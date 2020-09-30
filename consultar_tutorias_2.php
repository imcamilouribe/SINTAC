<?php
  session_start();

  header('Content-Type: text/html; charset=ISO-8859-1 ; charset=utf-8');

  include 'conexion.php';

  if (isset($_SESSION['usuario'])) {

      //Destruye la sesion si tiene mucho tiempo inactivo el usuario
      include 'inactivo.php';

      $nom = $_SESSION['usuario'];

      if (isset($_POST['fecha'])) {

          $fecha_consultar_tutorias = $_POST['fecha_consultar_tutorias'];

          //para convertir la fecha ATE_FORMAT(`fecha`,'%d-%m-%Y')
          $log = $log = "SELECT * FROM `agenda` WHERE `id_tutor` = '$nom' AND `fecha` = '$fecha_consultar_tutorias'";

          $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

          if (mysqli_num_rows($sintac) > 0) {

          } else {

              echo '<script> alert("Usted no tiene tutorias agendadas para esta fecha.");</script>';
              echo '<script> window.location="consultar_tutorias.php"; </script>';
          }
      } else {

          echo '<script> window.location="consultar_tutorias.php"; </script>';
      }

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
            <strong>Tutorías agendadas en la fecha: <?php echo "$fecha_consultar_tutorias"; ?><br>
          </strong>
            </strong>
          </p>
          <hr>
          <div class="table-responsive text-center" id="psin">
            <!-- div de busqueda-->
            <div class="form-group">
              <input type="text" class="form-control pull-right col-md-3" id="search" placeholder="Buscar..">
            </div>
            <table class="table" id="mytable">
              <thead class="table-secondary">
                <tr>
                  <th scope="col">Codigo estudiante</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Codigo profesor</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Hora inicio</th>
                  <th scope="col">Hora fin</th>
                  <th scope="col">Motivo</th>
                  <th scope="col">Resultado</th>
                  <tbody>
                    <tr>
                      <?php
  include 'conexion.php';
          $result = mysqli_query($conectar, "SELECT * FROM `agenda` WHERE `id_tutor` = '$nom' AND `fecha` = '$fecha_consultar_tutorias'");

          //se inicia ciclo while para imprimir datos en la tabla
          while ($row = mysqli_fetch_row($result)) {
              $estu_res    = $row[0];
              $codigo_prof = $row[1];
              $fecha       = $row[2];
              $motivo      = $row[4];
              $resultado   = $row[5];
              $turno       = $row[3];

          }

          $resultados = mysqli_query($conectar, "SELECT * FROM `turnos` WHERE `turno` = '$turno'");

          //se inicia ciclo while para imprimir datos en la tabla
          while ($row2 = mysqli_fetch_row($resultados)) {
              $inicio = $row2[1];
              $fin    = $row2[2];
          }

          $res_estu = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$estu_res'");

          //se inicia ciclo while para imprimir datos en la tabla
          while ($rows = mysqli_fetch_row($res_estu)) {

              $ape = $rows[1];
              $nom = $rows[2];

          }

          echo '
            <tr>
            <th scope="row">' . $estu_res . '</th>
            <td>' . $nom . '</td>
            <td>' . $ape . '</td>

            <td>' . $codigo_prof . '</td>
            <td>' . $fecha . '</td>

            <td>' . $inicio . '</td>
            <td>' . $fin . '</td>

            <td>' . $motivo . '</td>
            <td>' . $resultado . '</td>

            ';
      }

      ?>
                    </tr>
                </tr>
                </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <br>


    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4" id="col">
          <div id="bloque-presetancion">
            <br>
            <p class="text-center">
              <strong>Consultar las tutorías para una fecha especifica<br>
          </strong>
            </p>
            <hr/>

            <center>
              <form id="form_consultar_tutorias" action="consultar_tutorias_2.php" method="post">
                <div class="text-center mb-4">
                  <img class="mb-2" src="images/fechas.png" alt="" width="auto" height="80">
                  <hr>
                  <h1 class="h3 mb-3 font-weight-normal access"><b>FECHA</b></h1>
                </div>
                <div class="form-label-group">
                  <!--<label for="inputEmail">ID de usuario</label> -->
                  <input type="date" name="fecha_consultar_tutorias" value="2018-00-00" class="form-control" required>
                </div>
                <br>


                <button class="btn btn-lg btn-success btn-block" name="fecha" type="submit">CONSULTAR</button>
              </form><br></center>

          </div>
          <!-- /.col-lg-4 -->
        </div>

        <div class="col-lg-4" id="col">
          <div id="bloque-presetancion">
            <br>
            <p class="text-center">
              <strong>Consultar las tutorías para esta semana y las proximas<br>
          </strong>
            </p>
            <hr/>

            <center>
              <form id="form_consultar_tutorias" action="consultar_tutorias_3.php" method="post">
                <div class="text-center mb-4">
                  <img class="mb-2" src="images/calendario.png" alt="" width="auto" height="80">
                  <hr>
                  <h1 class="h3 mb-3 font-weight-normal access"><b>SEMANA</b></h1>
                </div>
                <div class="form-label-group">
                  <!--<label for="inputEmail">ID de usuario</label> -->
                  <input type="date" name="fecha_consultar_tutorias" value="2018-00-00" class="form-control" required>
                </div>
                <br>
                <button class="btn btn-lg btn-success btn-block" name="semana" type="submit">CONSULTAR</button>
              </form>
              <br>
            </center>
          </div>
          <!-- /.col-lg-4 -->
        </div>

        <div class="col-lg-4" id="col">
          <div id="bloque-presetancion">
            <br>
            <p class="text-center">
              <strong>Consultar todas las tutorias que fueron agendadas<br>
          </strong>
            </p>
            <hr/>

            <center>
              <form id="form_consultar_tutorias" action="consultar_tutorias_4.php" method="post">
                <div class="text-center mb-4">
                  <img class="mb-2" src="images/24-horas.png" alt="" width="auto" height="80">
                  <hr>
                  <h1 class="h3 mb-3 font-weight-normal access"><b>TODAS</b></h1>
                </div>
                <br>
                <br>
                <button id="button-consultar" class="btn btn-lg btn-success btn-block" name="todas" type="submit">CONSULTAR</button>
              </form>
              <br>
            </center>
          </div>
        </div>
        <!-- /.col-lg-4 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

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

  } else {
      echo '<script> alert("por favor iniciar sesión en SINTAC.");</script>';
      echo '<script> window.location="index.php"; </script>';
  }
  mysqli_close($conectar);
  ?>