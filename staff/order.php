<?php
include("../functions.php");

include_once 'includes/sessions.php';

// Verificación del rol de usuario
if ($_SESSION['user_role'] != "Camarer@") {
  echo ("<script>window.alert('¡Solo para camareros!'); window.location.href='index.php';</script>");
  exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Gestor de ordenes a cocina del FuranchoDaPigarreira">
  <meta name="author" content="entreunosyceros.net">

  <title>Pedido a cocina</title>

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
          <li class="breadcrumb-item active">Orden</li>
        </ol>

        <!-- Page Content -->
        <h1>Administración de Órdenes</h1>
        <hr>
        <p>Administración de nuevas órdenes en esta página.</p>

        <?php
          include_once 'includes/tomar-ordenes.php';
        ?>

      </div>
      <!-- /.container-fluid -->

      <!-- Listado de órdenes servidas por el camarero-->
      <?php
      include_once 'includes/listado-ordenes-servidas.php';
      ?>


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

  <script>
    var currentItemID = null;

    function displayItem(id) {
      $.post("displayitem.php", {
        btnMenuID: id
      }, function(output) {
        $("#tblItem").html(output);
      });
    }

    function insertItem() {
      var id = currentItemID;
      var quantity = $("#qty").val();
      var mesa = $("#mesa").val();
      var observaciones = $("#observaciones").val();
      $.post("displayitem.php", {
        btnMenuItemID: id,
        qty: quantity,
        mes: mesa,
        obser: observaciones
      }, function(output) {
        $("#tblOrderList").append(output);
        $("#qtypanel").prop('hidden', true);
      });

      $("#qty").val(1);
    }

    function setQty(id) {
      currentItemID = id;
      $("#qtypanel").prop('hidden', false);
    }

    $(document).on('click', '.deleteBtn', function(event) {
      event.preventDefault();
      $(this).closest('tr').remove();
      return false;
    });
  </script>

  <script>
    setInterval(function() {
      $('#tblCurrentOrder').load('order.php' + ' #tblCurrentOrder');
    }, 10000);

    $(document).ready(function() {
      refreshTableOrder();
    });

    function refreshTableOrder() {
      $("#tblCurrentOrder").load('order.php' + ' #tblCurrentOrder');
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
  </script>

</body>

</html>