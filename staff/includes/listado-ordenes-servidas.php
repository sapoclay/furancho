<!-- listado de ordenes servidas por el camarero -->
<div class="card-body">
    <div class="card-header">
        <i class="fas fa-chart-bar"></i>
        Ordenes en Cocina
    </div>
    <table id="tblCurrentOrder" class="table table-bordered text-center" width="100%" cellspacing="0">
        <thead>
            <th>Opc.</th>
            <th>Producto</th>
            <th class='text-center'>Cant.</th>
            <th class='text-center'>Obser.</th>
            <th class='text-center'>Est.</th>
            <th class='text-center'>Total(€)</th>
            <th class='text-center'>Mesa</th>         
        </thead>

        <tbody id="tblBodyCurrentOrder">
            <?php
            $camarero = $_SESSION['username'];
            $displayOrderQuery =  "
                      SELECT O.orderID, M.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,O.Camarero, O.mesa, OD.observaciones 
                      FROM tbl_order O 
                      LEFT JOIN tbl_orderdetail OD ON O.orderID = OD.orderID 
                      LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID 
                      LEFT JOIN tbl_menu M ON MI.menuID = M.menuID 
                      WHERE Camarero = '{$camarero}' AND O.status 
                      IN ( 'Esperando','Preparando','Listo','Cobrado')";

            if ($orderResult = $sqlconnection->query($displayOrderQuery)) {

                $currentspan = 0;
                $total = 0;

                //if no order
                if ($orderResult->num_rows == 0) {

                    echo "<tr><td class='text-center' colspan='7' >Actualmente no hay pedidos en este momento. </td></tr>";
                } else {
                    while ($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

                        //basically count rowspan so no repetitive display id in each table row
                        $rowspan = getCountID($orderRow["orderID"], "orderID", "tbl_orderdetail");

                        if ($currentspan == 0) {
                            $currentspan = $rowspan;
                            $total = 0;
                        }

                        //get total for each order id
                        $total += ($orderRow['price'] * $orderRow['quantity']);

                        echo "<tr>";

                        if ($currentspan == $rowspan) {
                            if($orderRow['status'] === 'Cobrado'){
                                echo "<td rowspan=" . $rowspan . "><button onclick='editStatus(this," . $orderRow['orderID'] . ")' class='btn btn-outline-danger' value = 'Cancelado' title='Cancela el pedido'>Cancelar</button>";
                            }else{
                                echo "<td rowspan=" . $rowspan . "><p><button onclick='editStatus(this," . $orderRow['orderID'] . ")' class='btn btn-outline-danger' value = 'Cancelado' title='Cancela el pedido'>Cancelar</button></p><br/>
                                <p><button onclick='editStatus(this," . $orderRow['orderID'] . ")' class='btn btn-outline-warning' value = 'Cobrado' title='Cobra el pedido'>Cobrar</button></p></td>";
                            }
                        }

                        echo "
                              <td>" . $orderRow['menuItemName'] . "</td>
                              <td class='text-center'>" . $orderRow['quantity'] . "</td>
                              <td class='text-center'>" . $orderRow['observaciones'] . "</td>
                            ";

                        if ($currentspan == $rowspan) {

                            $color = "badge";

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

                                case 'Cancelado':
                                    $color = "badge badge-danger";
                                    break;

                                case 'Finalizado':
                                    $color = "badge badge-success";
                                    break;

                                case 'Cobrado':
                                    $color = "badge badge-success";
                                    break;
                            }

                            echo "<td class='text-center' rowspan=" . $rowspan . "><span class='{$color}'>" . $orderRow['status'] . "</span></td>";

                            echo "<td rowspan=" . $rowspan . " class='text-center'>" . getSalesTotal($orderRow['orderID']) . "</td>";

                            echo "<td rowspan=" . $rowspan . " class='text-center'>" . $orderRow['mesa'] . "</td>";

                            
                        }

                        echo "</tr>";

                        $currentspan--;
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <div class="card-footer small text-muted"><i>Se actualiza cada tres segundos</i></div>
</div>