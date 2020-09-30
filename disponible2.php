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

        } else {

            $fechas = $_POST["fechas"];

            $fecha_actual = date("Y-m-d");

            if (($fechas == $fecha_actual) || ($fechas > $fecha_actual)) {

            if (!empty($_POST['check'])) {
                // Bucle para almacenar y mostrar los valores de casilla de verificación individual marcada.
                foreach ($_POST['check'] as $selected) {

                    $resulta = mysqli_query($conectar, "SELECT * FROM `turnos_profesores` WHERE `turno` = '$selected'");

                    //se inicia ciclo while para imprimir datos en la tabla
                    while ($row2 = mysqli_fetch_row($resulta)) {

                        $turno_prof = $row2[0];
                        $hora_inicio = $row2[1];
                        $hora_fin    = $row2[2];
                    }

                    $result = mysqli_query($conectar, "SELECT * FROM `disponibilidad` WHERE `id_tutor` = '$nom' AND `fecha` = '$fechas' AND `hora_inicio` = '$hora_inicio' AND `hora_fin` = '$hora_fin'");

                    if (mysqli_fetch_row($result) > 0) {
                        echo '<script> alert("Esta hora ya esta agendada.");</script>';
                        echo '<script> window.location="disponibilidad2.php"; </script>';
                    } else {
                        $sql = "INSERT INTO `disponibilidad`(`id_tutor`, `fecha`,`tur_prof`, `hora_inicio`, `hora_fin`) VALUES ('$nom','$fechas','$turno_prof','$hora_inicio','$hora_fin')";

                        if ($conectar->query($sql) == true) {
                            echo '<script> alert("Horario agendado.");</script>';
                            echo '<script> window.location="disponibilidad2.php"; </script>';
                        } else {

                            echo "Error: " . $sql . "<br>" . $conectar->error;

                        }
                    }
                }
            } else {
                echo '<script> alert("Seleccione algun horario.");</script>';
                echo '<script> window.location="disponibilidad2.php"; </script>';
            }
        }else{
        echo '<script> alert("No se puede agendar una fecha pasada.");</script>';
        echo '<script> window.location="disponibilidad2.php"; </script>';
    }
    }
    } else {
        echo '<script> alert("por favor iniciar sesión en SINTAC.");</script>';
        echo '<script> window.location="index.php"; </script>';
    }
    mysqli_close($conectar);