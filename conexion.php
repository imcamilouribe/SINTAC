<?php
	// Ejemplo de conexión a base de datos MySQL con PHP.
	//
	// Ejemplo realizado por 

	// Datos de la base de datos
	$usuario     = "root";
	$password    = "";
	$servidor    = "localhost";
	$basededatos = "sintac";

	// creación de la conexión a la base de datos con mysql_connect()
	$conectar = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al servidor de Base de datos");

	// Selección del a base de datos a utilizar
	$db = mysqli_select_db($conectar, $basededatos) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");

	// cerrar conexión de base de datos
	//mysqli_close( $conectar );