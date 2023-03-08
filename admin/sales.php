<?php
  include("../functions.php");
  include_once 'includes/sessions.php';
?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Administración del FuranchoDaPigarreira">
    <meta name="author" content="entreunosyceros.net">

    <title>Ventas | del Furancho</title>

    <?php
      include_once 'includes/links.php';
    ?>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Furancho | DaPigarreira</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <?php
        include_once 'includes/navbar.php'
      ?>

    </nav>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <?php
        include_once 'includes/sidebar.php'
      ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Ventas</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Ventas</h1>
          <hr>
          <p>Todos los datos de venta se encuentran aquí.</p>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Estadística de Ganancias de Ventas
            </div>
            <div class="card-body">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Hoy</td>
                    <td><?php echo getSalesGrandTotal("DAY"); ?> €</td>
                  </tr>
                  <tr>
                    <td>Esta Semana</td>
                    <td><?php echo getSalesGrandTotal("WEEK"); ?> €</td>
                  </tr>
                  <tr>
                    <td>Este Mes</td>
                    <td><?php echo getSalesGrandTotal("MONTH"); ?> €</td>
                  </tr>
                  <tr class="table-info">
                    <td><b>Todo el Tiempo</b></td>
                    <td><b><?php echo getSalesGrandTotal("ALLTIME"); ?> €</b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Lista de Órdenes de Ventas</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th># Orden</th>
                      <th>Nombre</th>
                      <th class='text-center'>Cant.</th>
                      <th class='text-center'>Obser.</th>
                      <th class='text-center'>Est.</th>
                      <th class='text-center'>T. (€)</th>
                      <th class='text-center'>M.</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      <?php 
                      $displayOrderQuery =  "
                        SELECT O.orderID, M.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,MI.price,O.mesa,OD.observaciones
                        FROM tbl_order O
                        LEFT JOIN tbl_orderdetail OD
                        ON O.orderID = OD.orderID
                        LEFT JOIN tbl_menuitem MI
                        ON OD.itemID = MI.itemID
                        LEFT JOIN tbl_menu M
                        ON MI.menuID = M.menuID
                        ";

                      if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
                          
                        $currentspan = 0;
                        $total = 0;

                        //if no order
                        if ($orderResult->num_rows == 0) {

                          echo "<tr><td class='text-center' colspan='7' >Actualmente no hay pedido en este momento. </td></tr>";
                        }

                        else {
                          while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

                            //basically count rowspan so no repetitive display id in each table row
                            $rowspan = getCountID($orderRow["orderID"],"orderID","tbl_orderdetail"); 

                            if ($currentspan == 0) {
                              $currentspan = $rowspan;
                              $total = 0;
                            }

                            //get total for each order id
                            $total += ($orderRow['price']*$orderRow['quantity']);

                            echo "<tr>";

                            if ($currentspan == $rowspan) {
                              echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
                            }

                            echo "
                              <td>".$orderRow['menuItemName']."</td>
                              <td class='text-center'>".$orderRow['quantity']."</td>
                              <td class='text-center'>".$orderRow['observaciones']."</td>
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

                                case 'Pagado':
                                  $color = "badge badge-success";
                                  break;
                              }

                              echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".getSalesTotal($orderRow['orderID'])."</td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['mesa']."</td>";

                            }

                            echo "</tr>";

                            $currentspan--;
                          }
                        }
                        } 
                      ?>
                    </tbody>
              </table>
            </div>
            </div>
          </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
          include_once 'includes/footer.php';
        ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
      include_once 'includes/modal-logout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

  </body>

</html>