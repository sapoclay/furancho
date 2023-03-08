<?php 
  include("../functions.php");
  include_once 'includes/sessions.php';

  function getStatus () {
      global $sqlconnection;
      $checkOnlineQuery = "SELECT status FROM tbl_staff WHERE staffID = {$_SESSION['uid']}";

      if ($result = $sqlconnection->query($checkOnlineQuery)) {
          
        if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          return $row['status'];
        }
      }

      else {
          echo "Algo ha salido mal en getStatus!";
          echo $sqlconnection->error;
      }
  }

?>

<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel de control de empleados">
    <meta name="author" content="entreunosyceros.net">

    <title>Panel de Control</title>

    <?php
      include_once 'includes/links.php';
    ?>

  </head>

  <body id="page-top">

    <?php 
      include_once 'includes/navbar.php';
    ?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <?php
        include_once 'includes/sidebar.php';
      ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Vista General</li>
          </ol>

          <!-- Page Content -->
          <h1>Panel de Empleado</h1>
          <hr>
          <p>Las gestiones relacionadas con tus tareas están aquí.</p>

          <div class="row">
            <div class="col-lg-9">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-utensils"></i>
                  Las órdenes más recientes listas</div>
                <div class="card-body">
                	<table id="orderTable" class="table table-striped table-bordered width="100%" cellspacing="0">
                	</table>
                </div>
                <div class="card-footer small text-muted"><i>Este listado se actualiza cada tres segundos</i></div>
              </div>
            </div>

            <?php
              include_once 'includes/estado.php';
            ?>
          </div>

        </div>
        <!-- /.container-fluid -->
      
        <!-- include Pié de página-->
       <?php
        include_once 'includes/pie.php';
       ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to top-->
    <?php
      include_once 'includes/scroll-to-top.php';
    ?>

    <!-- Ventana modal de salida-->
    <?php
      include_once 'includes/logout-modal.php';
    ?>

    <!-- Scripts-->
    <?php
      include_once 'includes/vendor-scripts.php';
    ?>

	<script type="text/javascript">

    $( document ).ready(function() {
        refreshTableOrder();
    });

    function refreshTableOrder() {
      $( "#orderTable" ).load( "displayorder.php?cmd=currentready" );
    }

    // Refresca la lista cada 3 segundos
    setInterval(function(){ refreshTableOrder(); }, 3000);

  </script>

  </body>

</html>