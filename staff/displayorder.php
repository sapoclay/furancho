
<?php
	include("../functions.php");
    include_once 'includes/sessions.php';

	//Mostrar nada si se abre ./displayorder.php
	if(empty($_GET['cmd'])) 
		die(); 

	//Mostrar ordenes en la cocina
	if ($_GET['cmd'] == 'currentorder')	{
		
		$displayOrderQuery =  "
					SELECT O.orderID, M.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,OD.observaciones
					FROM tbl_order O
					LEFT JOIN tbl_orderdetail OD
					ON O.orderID = OD.orderID
					LEFT JOIN tbl_menuitem MI
					ON OD.itemID = MI.itemID
					LEFT JOIN tbl_menu M
					ON MI.menuID = M.menuID
					WHERE O.status 
					IN ( 'Esperando','Preparando','Listo')
				";

			if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
					
				$currentspan = 0;

				//if no order
				if ($orderResult->num_rows == 0) {

					echo "<tr><td class='text-center' colspan='7' >NO HAY ÓRDENES POR AHORA </td></tr>";
				}

				else {
					while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

						$rowspan = getCountID($orderRow["orderID"],"orderID","tbl_orderdetail"); 

						if ($currentspan == 0)
							$currentspan = $rowspan;

						echo "<tr>";

						if ($currentspan == $rowspan) {
							echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
						}

						echo "
							<td>".$orderRow['menuName']."</td>
							<td>".$orderRow['menuItemName']."</td>
							<td class='text-center'>".$orderRow['quantity']."</td>
							<td class='text-center'>".$orderRow['observaciones']."</td>
						";

						if ($currentspan == $rowspan) {

							$color = "badge badge-warning";
							switch ($orderRow['status']) {
								case 'Esperando':
									$color = "badge badge-warning";
									break;
								
								case 'Preparando':
									$color = "badge badge-primary";
									break;

								case 'Listo':
									$color = "badge badge-success";
									break;
							}

							echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";
							
							echo "<td class='text-center' rowspan=".$rowspan.">";

							//opciones basadas en el status de la orden
							switch ($orderRow['status']) {
								case 'Esperando':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-primary' value = 'Preparando'>Preparando</button>";
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-success' value = 'Listo'>Listo</button>";

									break;
								
								case 'Preparando':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-success' value = 'Listo'>Listo</button>";

									break;

								case 'Listo':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-warning' value = 'Finalizado'>Limpiar</button>";

									break;
							}

							echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-danger' value = 'Cancelado'>Cancelar</button></td>";

							echo "</td>";
						}

						echo "</tr>";

						$currentspan--;
					}
				}	
			}
	}

	//display current ready order list in staff index
	if ($_GET['cmd'] == 'currentready') {

		$latestReadyQuery = "SELECT orderID FROM tbl_order WHERE status IN ( 'Finalizado','Listo') ";

		if ($result = $sqlconnection->query($latestReadyQuery)) {

			if ($result->num_rows == 0) {
				echo "<tr><td class='text-center'>Sin órdenes listas para servir. </td></tr>";
			}

            while($latestOrder = $result->fetch_array(MYSQLI_ASSOC)) {
            	echo "<tr><td><i class='fas fa-bullhorn' style='color:green;'></i><b> Orden #".$latestOrder['orderID']."</b> lista para servir.<a href='editstatus.php?orderID=".$latestOrder['orderID']."'><i class='fas fa-check float-right'></i></a></td></tr>";
            }
        }
	}

?>