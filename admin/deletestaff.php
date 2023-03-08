<?php

include("../functions.php");
include_once "includes/sessions.php";

//Deleting Item
if (isset($_GET['staffID'])) {
	
	$del_staffID = $_GET['staffID'];

	$deleteStaffQuery = "DELETE FROM tbl_staff WHERE staffID = ?";

	$stmt = $sqlconnection->prepare($deleteStaffQuery);
	$stmt->bind_param("i", $del_staffID);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		echo "Borrado con éxito!";
		header("Location: staff.php"); 
		exit();
	} 

	else {
		//handle
		echo "Algo ha salido mal!!";
		echo $stmt->error;
	}
	
}

?>