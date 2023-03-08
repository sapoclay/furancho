
<?php
	include("../functions.php");
	include_once 'includes/sessions.php';

	/*Muestra el contenido del menú seleccionado*/
	if (isset($_POST['btnMenuID'])) {
		$menuID = $sqlconnection->real_escape_string($_POST['btnMenuID']);
		$menuItemQuery = "SELECT itemID,menuItemName FROM tbl_menuitem WHERE menuID = ?";
		if ($stmt = $sqlconnection->prepare($menuItemQuery)) {
			$stmt->bind_param('i', $menuID);
			if ($stmt->execute()) {
				$stmt->bind_result($itemID, $menuItemName);
				if ($stmt->fetch()) {
					$counter = 0;
					echo "<tr>";
					do {
						echo "<td><button style='margin-bottom:4px;white-space: normal;' class='btn btn-warning' onclick='setQty({$itemID})'>{$menuItemName}</button></td>";
						if (++$counter % 3 === 0) {
							echo "</tr><tr>";
						}
					} while($stmt->fetch());
					echo "</tr>";
				} else {
					echo "<tr><td>No hay nada que mostrar en este menú</td></tr>";
				}
			}
			$stmt->close();
		}
	}

	/*Muestra los platos seleccionados*/
	if (isset($_POST['btnMenuItemID'], $_POST['qty'], $_POST['mes'], $_POST['obser'])) {
		
		$menuItemID = $sqlconnection->real_escape_string($_POST['btnMenuItemID']);
		$quantity = $sqlconnection->real_escape_string($_POST['qty']);
		$mesa = $sqlconnection->real_escape_string($_POST['mes']);
		$observaciones = $sqlconnection->real_escape_string($_POST['obser']);


		$menuItemQuery = "SELECT mi.itemID, mi.menuItemName, mi.price, m.menuName FROM tbl_menuitem mi LEFT JOIN tbl_menu m ON mi.menuID = m.menuID WHERE itemID = ?";
		if ($stmt = $sqlconnection->prepare($menuItemQuery)) {
			$stmt->bind_param('i', $menuItemID);
			if ($stmt->execute()) {
				$stmt->bind_result($itemID, $menuItemName, $price, $menuName);
				if ($stmt->fetch()) {
					echo "
					<tr>
						<input type='hidden' name='itemID[]' value='{$itemID}'/>
						<td><input type='number'  name='mesa' width='5px' class='form-control' value='{$mesa}' readonly/></td>
						<td>{$menuName} : {$menuItemName}</td>
						<td>{$price}</td>
						<td><input type='number' min='1' max='50' name='itemqty[]' width='10px' class='form-control' value='{$quantity}' readonly/></td>
						<td><input type='text'  name='observaciones[]' width='5px' class='form-control' value='{$observaciones}' readonly/></td>
						<td name='priceT'>" . number_format((float)$price * $quantity, 2, '.', '') . "</td>
						<td><button class='btn btn-danger deleteBtn' type='button' onclick='deleteRow()'><i class='fas fa-times'></i></button></td>
					</tr>
					";
					
				}
			}

			else {
				
				echo "No se han recibido datos";
			}
			
		}

	}

	
?>