<?php
    session_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <head>
            <link rel="icon" href="Images/logo.png" type="image/x-icon">
            <title>Validando...</title>
            <meta charset="utf-8">
        </head>
    </head>
    <body>
        <?php
    header('Content-Type: text/html; charset=ISO-8859-1; ; charset=utf-8');

    include 'conexion.php';

    if (isset($_POST['login'])) {

        $usuario  = $_POST['usuario'];
        $password = $_POST['password'];

        $log = $log = "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario' AND `contraseña` = '$password'";

        $sintac = mysqli_query($conectar, $log) or die("Algo ha ido mal en la consulta a la base de datos");

        if (mysqli_num_rows($sintac) > 0) {
            $columna = mysqli_fetch_array($sintac);

            //sentencias de consultas
            $resultados = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario'");

            //se inicia ciclo while para imprimir datos en la tabla
            while ($row = mysqli_fetch_row($resultados)) {
                $tipo      = $row[2];
                $intentos  = $row[3];
                $bloqueado = $row[4];
            }

            if ($bloqueado == '1') {

                echo '<script> alert("Su cuenta ha sido suspendida.");</script>';
                echo '<script> window.location="index.php"; </script>';

            } else if ($intentos >= '3') {

                echo '<script> alert("Usted excedio el limite de intentos de acceso permitidos favor pida a un Administrador el desbloqueo de su cuenta.");</script>';
                echo '<script> window.location="index.php"; </script>';

            } else if ($tipo == '1') {
                $_SESSION["usuario"] = $columna['id_usuario'];

                if ($intentos > '0') {$actu = mysqli_query($conectar, "UPDATE `usuarios` SET `intentos`= '0' WHERE `id_usuario` = '$usuario'") or die("Algo ha ido mal en la consulta a la base de datos");}

                echo '<script> window.location="estudiantes.php"; </script>';

            } else if ($tipo == '2' Or $tipo == '3') {
                $_SESSION["usuario"] = $columna['id_usuario'];

                if ($intentos > '0') {$actu = mysqli_query($conectar, "UPDATE `usuarios` SET `intentos`= '0' WHERE `id_usuario` = '$usuario'") or die("Algo ha ido mal en la consulta a la base de datos");}

                echo '<script> window.location="profesores.php"; </script>';

            } 

        } else {

            $comprueba = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario'") or die("Algo ha ido mal en la consulta a la base de datos");

            if (mysqli_num_rows($comprueba) > 0) {
                $columna = mysqli_fetch_array($comprueba);

                $resul = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$usuario'");
                //se inicia ciclo while para imprimir datos en la tabla
                while ($row = mysqli_fetch_row($resul)) {
                    $intent = $row[3];
                }

                $intentotal = $intent + 1;

                $actual = mysqli_query($conectar, "UPDATE `usuarios` SET `intentos`= '$intentotal' WHERE `id_usuario` = '$usuario'") or die("Algo ha ido mal en la consulta a la base de datos");

                echo '<script> alert("Contraseña incorrecta.");</script>';
                echo '<script> window.location="index.php"; </script>';

            } else {

                echo '<script> alert("Este usuario y contraseña no estan registrados.");</script>';
                echo '<script> window.location="index.php"; </script>';

            }

        }
    }
    mysqli_close($conectar);
    ?>
    </body>
    </html>