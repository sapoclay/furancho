<?php
	require("config.php");
	
	// Crear conexión
	$sqlconnection = new mysqli($servername, $username, $password, $dbname);

	// Comprobar conexión
	$error = $sqlconnection->connect_error ?: null;
	if ($error) {
		die("Connection failed: $error");
	}
?>