<?php
    include 'conexion.php';
    $res = mysqli_query($conectar, "SELECT * FROM `usuarios` WHERE `id_usuario` = '$nom'");

    //se inicia ciclo while para imprimir datos en la tabla
    while ($row = mysqli_fetch_row($res)) {
        $tipo = $row[2];
    }
    echo '<b><div id="menu" class="bg-light container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">';
    if ($tipo == '1') {

        $us   = 'ESTUDIANTE';
        $href = 'estudiantes.php';
    } else if ($tipo == '2') {

        $us   = 'DOCENTE';
        $href = 'profesores.php';
    } else if ($tipo == '3') {

        $us   = 'DOCENTE/ADMIN';
        $href = 'profesores.php';
    }

    echo '<a class="navbar-brand" href="' . $href . '">' . $us . '</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>';

    if ($tipo == '1') {

        echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" href="agendar_tutoria_estu.php">Agendar una tutoria<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="cancelar_estu.php">Cancelar tutoria<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="consultar_historial_tutorias_estu.php">Consultar historial de tutorias<span class="sr-only">(current)</span></a>
            </li>';

    } else if ($tipo > '1') {

        echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Horarios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="disponibilidad2.php">Ingresar su disponibilidad de tiempo</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tutorías
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="registrar_resultado_tutoria.php">Registrar el resultado de una tutoria</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="cancelar_tutorias.php">Cancelar una tutoria específica</a>
            </div>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="consultar_tutorias.php">Consultar/Historial/Listado<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="estudiantes_asignados.php">Estudiantes Asignados<span class="sr-only">(current)</span></a>
            </li>';
    }

    if ($tipo == '3') {

        echo '<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tutores/Usuarios
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="desbloqueoacceso.php">Desbloqueo de acceso</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="activar_inactivar.php">Activar/Inactivar</a>
            </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="asignar_tutores.php">Asignar Tutores<span class="sr-only">(current)</span></a>
            </li>';
    }

    echo '</ul>
           </div>
           </div>
           </nav>
           </div></b>';