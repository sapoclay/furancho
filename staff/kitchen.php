<?php
include("../functions.php");
include_once 'includes/sessions.php';

if ($_SESSION['user_role'] != "chef") {
  echo ("<script>window.alert('Solo disponible para cocineros!'); window.location.href='index.php';</script>");
  exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Página para la cocina del furancho">
  <meta name="author" content="entreunosyceros.net">

  <title>Cocina - FuranchoDaPigarreira</title>

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
          <li class="breadcrumb-item active">Cocina</li>
        </ol>

        <!-- Contenido de la página -->
        <h1>Panel Administrativo de la Cocina</h1>
        <hr>
        <p>Administrar las órdenes que han sido enviadas por los camareros.</p>

        <?php
          include_once 'includes/listado-ordenes-cocina.php';
        ?>

      </div>

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
    $(document).ready(function() {
      refreshTableOrder();
    });

    function refreshTableOrder() {
      $("#tblBodyCurrentOrder").load("displayorder.php?cmd=currentorder");
    }


    function editStatus(objBtn, orderID) {
      var status = objBtn.value;

      $.ajax({
        url: "editstatus.php",
        type: 'POST',
        data: {
          orderID: orderID,
          status: status
        },

        success: function(output) {
          refreshTableOrder();
        }
      });
    }

    //refresh order current list every 3 secs
    setInterval(function() {
      refreshTableOrder();
    }, 3000);
  </script>

</body>

</html>