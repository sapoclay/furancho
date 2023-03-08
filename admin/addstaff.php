<?php 
	include("../functions.php");

	include_once "includes/sessions.php";

	// Añadir un nuevo mientro al staff	
	if (isset($_POST['addstaff'])) {
		if (!empty($_POST['staffname']) && !empty($_POST['staffrole'])) {
			$staffUsername = $sqlconnection->real_escape_string($_POST['staffname']);
			$staffRole = $sqlconnection->real_escape_string($_POST['staffrole']);

			// Preparar la sentencia INSERT con marcadores de posición
			$addStaffQuery = $sqlconnection->prepare("INSERT INTO tbl_staff (username, password, status, role) VALUES (?, ?, ?, ?)");
			$password = "1234abcd..";
			$status = "Offline";
			$addStaffQuery->bind_param("ssss", $staffUsername, $password, $status, $staffRole);

			if ($addStaffQuery->execute()) {
				echo "Añadido!!";
				header("Location: staff.php");
				exit();
			} else {
				echo "Algo ha salido mal!!";
				echo $sqlconnection->error;
			}

			// Cerrar la sentencia preparada
			$addStaffQuery->close();
		}
	}
?>