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

            echo '<script> window.location="estudiantes.php"; </script>';

        } else if ($tipo > '1') {

            echo '<script> window.location="profesores.php"; </script>';

        } else {

            echo '<script> window.location="logout.php"; </script>';

        }
    }

    mysqli_close($conectar);