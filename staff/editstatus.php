<?php
	include("../functions.php");

	if(!isset($_SESSION['uid']) || !isset($_SESSION['username']) || $_SESSION['user_level'] != "staff") {
		header("Location: login.php");
		exit(); // asegurate de que el script no continúe después de redirigir
	}

	if (isset($_POST['status']) && isset($_POST['orderID'])) {
		$status = $sqlconnection->real_escape_string($_POST['status']);
		$orderID = $sqlconnection->real_escape_string($_POST['orderID']);
	
		$addOrderQuery = $sqlconnection->prepare("UPDATE tbl_order SET status = ? WHERE orderID = ?");
		$addOrderQuery->bind_param("si", $status, $orderID);
	
		if ($addOrderQuery->execute()) {
			echo "inserted.";
		} else {
			// error
			echo "Algo ha ido mal al actualizar el status del pedido";
			echo $addOrderQuery->error;
		}
	
		$addOrderQuery->close();
	}

	if (isset($_GET['orderID'])) {
		$status = "Listo";
		$orderID = $sqlconnection->real_escape_string($_GET['orderID']);
	
		$addOrderQuery = $sqlconnection->prepare("UPDATE tbl_order SET status = ? WHERE orderID = ?");
		$addOrderQuery->bind_param("si", $status, $orderID);
	
		if ($addOrderQuery->execute()) {
			echo "inserted.";
			header("Location: index.php");
			exit();
		} else {
			// error
			echo "Algo ha ido mal al actualizar el status del pedido";
			echo $addOrderQuery->error;
		}
	
		$addOrderQuery->close();
	}



?>