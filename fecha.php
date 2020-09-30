<?php
	echo "Fecha: ";
	$date = new DateTime('now', new DateTimeZone('America/Bogota'));
	echo $date->format("d/m/o");