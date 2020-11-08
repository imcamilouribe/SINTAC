<?php
  session_start();

  header('Content-Type: text/html; charset=ISO-8859-1; charset=utf-8');

  include 'conexion.php';

  if (isset($_SESSION['usuario'])) {
      echo '<script> window.location="sesion_iniciada.php"; </script>';
  }
  mysqli_close($conectar);
  ?>
  <!Doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Acceso - Sistema de Informacion de Tutorias Academicas</title>
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="Images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="Css/css.css">
  </head>
  <!--Start of Tawk.to Script-->
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
  <!--End of Tawk.to Script-->
  <body id="bodylogin">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form class="form-signin" action="index_contra.php" method="post">
            <div class="text-center mb-4">
              <img class="mb-2" src="Images/SINTAC1.png" alt="" width="auto" height="80">
            </div>
            <hr>
            <h5>
          <strong>Iniciar sesion<br>
          </strong>
          </h5>
            <div class="form-label-group">
              <!--<label for="inputEmail">ID de usuario</label> -->
              <input type="text" name="usuario" class="form-control" placeholder="ID de usuario" required>
              <a id="a11" href="https://tawk.to/chat/5b044119d0f6723da57ec4b8/default/?$_tawk_popout=true&$_tawk_sk=5b0441e6ba7dc7f6178883ea&$_tawk_tk=4704b5f209f1bedef2f8fcd64256f989&v=574" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;">Olvido su ID?</a>
            </div>
            <br>
            <div class="mb-3">

              <button class="btn btn-success btn-block" name="login" type="submit">SIGUIENTE</button>

            </div>
          </form>
        </div>
      </div>
    </div>

  </body>
  </html>