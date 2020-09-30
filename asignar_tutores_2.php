<?php 
        if (isset($_POST['asignar_tutor'])) {

        include 'conexion.php';

        if (!empty($_POST['check'])) {
                // Bucle para almacenar y mostrar los valores de casilla de verificación individual marcada.
                foreach ($_POST['check'] as $selected) {

                    $profesores = $_POST['profesores'];

                    $resulta = mysqli_query($conectar, "SELECT * FROM `estudiantes` WHERE `id_alumno` = '$selected'");

                        $sql = "UPDATE `estudiantes` SET `id_tutor_principal`= '$profesores ' WHERE `id_alumno` = '$selected'";

                        if ($conectar->query($sql) == true) {
                            echo '<script> alert("Tutor principal registrado.");</script>';
                            echo '<script> window.location="asignar_tutores.php"; </script>';
                        } else {

                            echo "Error: " . $sql . "<br>" . $conectar->error;

                        }
                    }
                }else {
                echo '<script> alert("Seleccione algun estudiante.");</script>';
                echo '<script> window.location="asignar_tutores.php"; </script>';
            }

                mysqli_close($conectar);
            } else {
                echo '<script> window.location="asignar_tutores.php"; </script>';
            }


     ?>