<?php
include("../functions.php");

include_once 'includes/sessions.php';

if (empty($_POST['itemID'])) {
	header("Location: order.php");
	exit();
}

if (isset($_POST['sentorder'])) {

	if (isset($_POST['itemID']) && isset($_POST['itemqty'])) {

		$arrItemID = $_POST['itemID'];
		$arrItemQty = $_POST['itemqty'];
		$mesa = $_POST['mesa'];
		$observaciones = $_POST['observaciones'];


		//comprobar que el par de la matriz tenga el mismo número de elemento
		if (count($arrItemID) == count($arrItemQty)) {
			$arrlength = count($arrItemID);

			//añadir un nuevo ID
			$currentOrderID = getLastID("orderID", "tbl_order") + 1;

			insertOrderQuery($currentOrderID, $mesa);

			for ($i = 0; $i < $arrlength; $i++) {
				insertOrderDetailQuery($currentOrderID, $arrItemID[$i], $arrItemQty[$i], $observaciones[$i]);
			}

			updateTotal($currentOrderID);

			// redirección cuando se completa la inserción 
			header("Location: order.php");
			exit();
		} else {
			echo "ERROR al comprobar el par de la matriz";
		}
	}
}



function insertOrderDetailQuery($orderID, $itemID, $quantity, $observaciones)
{
	global $sqlconnection;
	$addOrderQuery = "INSERT INTO tbl_orderdetail (orderID ,itemID ,quantity, observaciones) VALUES (?, ?, ?, ?)";
	
	$stmt = $sqlconnection->prepare($addOrderQuery);
	$stmt->bind_param("ssis", $orderID, $itemID, $quantity, $observaciones);
	
	if ($stmt->execute()) {
		echo "Se ha pasado el pedido a cocina";
	} else {
		echo "Algo ha salido mal!!";
		echo $stmt->error;
	}
	$stmt->close();
}

function insertOrderQuery($orderID, $mesa)
{
	global $sqlconnection;
	$camarero = $_SESSION['username'];

	$addOrderQuery = "INSERT INTO tbl_order (orderID , mesa , status , order_date, Camarero) VALUES (?, ?, 'Esperando', CURDATE(), ?)";
	
	$stmt = $sqlconnection->prepare($addOrderQuery);
	$stmt->bind_param("iss", $orderID, $mesa, $camarero);
	
	if ($stmt->execute()) {
		echo "Se ha pasado el pedido a cocina";
	} else {
		echo "Algo ha salido mal!!";
		echo $stmt->error;
	}
	$stmt->close();
}
