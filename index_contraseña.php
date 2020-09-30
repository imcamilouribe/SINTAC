<?php
  session_start();

  header('Content-Type: text/html; charset=ISO-8859-1; charset=utf-8');

  include 'conexion.php';

  if (isset($_SESSION['usuario'])) {
      echo '<script> window.location="sesion_iniciada.php"; </script>';
  }

  if (isset($_POST['login'])) {

      $usuario = $_POST['usuario'];

      $log = $log = "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario'";

      $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

      if (mysqli_num_rows($sintac) == 0) {
          $columna = mysqli_fetch_array($sintac);

          echo '<script> alert("Este usuario no existe.");</script>';
          echo '<script> window.location="index.php"; </script>';

      } else {

          $resul = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario'");

          //se inicia ciclo while para imprimir datos en la tabla
          while ($row = mysqli_fetch_row($resul)) {
              $tipo = $row[2];
          }

          if ($tipo == '1') {

              $resultado = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$usuario'");

              //se inicia ciclo while para imprimir datos en la tabla
              while ($row2 = mysqli_fetch_row($resultado)) {
                  $nombre = $row2[2];
              }

          } else {

              //sentencias de consultas

              $resultados = mysqli_query($conectar, "SELECT * FROM `profesores` WHERE `id_prof` = '$usuario'");

              //se inicia ciclo while para imprimir datos en la tabla
              while ($row2 = mysqli_fetch_row($resultados)) {
                  $nombre = $row2[2];
              }
          }

      }

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
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
              (function(){
              var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
              s1.async=true;
              s1.src='https://embed.tawk.to/5b044119d0f6723da57ec4b8/default';
              s1.charset='UTF-8';
              s1.setAttribute('crossorigin','*');
              s0.parentNode.insertBefore(s1,s0);
              })();
    
  </script>
  <body id="bodylogin">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form class="form-signin" action="sesion.php" method="post">
            <div class="text-center mb-4">
              <img class="mb-2" src="Images/SINTAC1.png" alt="" width="auto" height="80">
            </div>
            <hr>
            <h5>
          <strong>Hola! <?php echo "$nombre"; ?><br>
          </strong>
          </h5>
            <h5>
          <strong>Escribir contraseña<br>
          </strong>
          </h5>
            <div class="form-label-group">
              <?php echo '<input type="hidden" name="usuario" class="form-control" value="' . $usuario . '">'; ?>
              <!--<label for="inputEmail">ID de usuario</label> -->
              <input type="password" name="password" class="form-control" required>
            </div>
            <a id="a11" href="https://tawk.to/chat/5b044119d0f6723da57ec4b8/default/?$_tawk_popout=true&$_tawk_sk=5b0441e6ba7dc7f6178883ea&$_tawk_tk=4704b5f209f1bedef2f8fcd64256f989&v=574" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;">He olvidado mi contraseña</a>
            <div>
              <br>
              <a id="login_button" href="index.php" class="btn btn-secondary" role="button">ATRÁS</a>
              <button id="login_button" class="btn btn-success " name="login" type="submit">ACCEDER</button>
              <br>

            </div>
          </form>
        </div>
      </div>
    </div>

  </body>
  </html>

  <?php

  } else {
      echo '<script> window.location="index.html"; </script>';
  }
  mysqli_close($conectar);
  ?>