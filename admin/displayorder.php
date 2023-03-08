
<?php
	include("../functions.php");
	include_once "includes/sessions.php";

	if(empty($_GET['cmd'])) 
		die();
	if ($_GET['cmd'] != 'display')	
		die();

	$displayOrderQuery =  "
			SELECT O.orderID, M.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status
			FROM tbl_order O
			LEFT JOIN tbl_orderdetail OD
			ON O.orderID = OD.orderID
			LEFT JOIN tbl_menuitem MI
			ON OD.itemID = MI.itemID
			LEFT JOIN tbl_menu M
			ON MI.menuID = M.menuID
			WHERE O.status 
			IN ( 'preparing','waiting','ready','finish')
		";

	if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
			
		$currentspan = 0;

		//if no order
		if ($orderResult->num_rows == 0) {

			echo "<tr><td class='text-center' colspan='7' >No hay órdenes solicitadas por el momento :) </td></tr>";
		}

		else {
			while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

				//basically count rowspan so no repetitive display id in each table row
				$rowspan = getCountID($orderRow["orderID"],"orderID","tbl_orderdetail"); 

				if ($currentspan == 0)
					$currentspan = $rowspan;

				echo "<tr>";

				if ($currentspan == $rowspan) {
					echo "<td class='text-center' rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
				}

				echo "
					<td>".$orderRow['menuName']."</td>
					<td>".$orderRow['menuItemName']."</td>
					<td class='text-center'>".$orderRow['quantity']."</td>
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
							
						case 'Finalizado':
							$color = "badge badge-success";
							break;
					}

					echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";
				
					echo "</td>";

				}

				echo "</tr>";

				$currentspan--;
			}
		}	
	}

?>