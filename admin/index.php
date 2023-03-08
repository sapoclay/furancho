<?php 
  include("../functions.php");

  include_once "includes/sessions.php"

?>

<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel de control de este software para el control de un restaurante/furancho">
    <meta name="author" content="entreunosyceros.net">

    <title>Panel de Control</title>

    <?php
      include_once "includes/links.php";
    ?>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Furancho | Administracion</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <?php
        include_once 'includes/navbar.php';
      ?>

    </nav>

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
          <h1>Panel de Administración</h1>
          <hr>
          <p>Vista General del Sistema.</p>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-utensils"></i>
                  Lista de Pedidos Actuales</div>
                <div class="card-body">
                  <table id="tblCurrentOrder" table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th>Número de Orden</th>
                      <th>Menú</th>
                      <th>Nombre de Ítem</th>
                      <th class='text-center'>Cantidad</th>
                      <th class='text-center'>Estado</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Se refresca automáticamente cada 5 segundos</i></div>
              </div>
            </div>

            <?php
              include_once 'includes/personal.php';
            ?>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Footer -->
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

    <!-- Scripts -->
    <?php
      include_once 'includes/scripts.php';
    ?>


  </body>

</html>