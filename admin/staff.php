<?php
  include("../functions.php");
  include_once 'includes/sessions.php';

  if (!empty($_POST['role'])) {
    $role = $sqlconnection->real_escape_string($_POST['role']);
    $staffID = $sqlconnection->real_escape_string($_POST['staffID']);

    $updateRoleQuery = "UPDATE tbl_staff SET role = '{$role}'  WHERE staffID = {$staffID}  ";

      if ($sqlconnection->query($updateRoleQuery) === TRUE) {
        echo "";
      } 

      else {
        //handle
        echo "Algo ha salido mal";
        echo $sqlconnection->error;
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="entreunosyceros.net">

    <title>Administración de Empleados</title>
    <?php
      include_once 'includes/links.php';
    ?>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Furancho | Staff</a>

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
              <a href="index.html">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Empleados</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Empleados</h1>
          <hr>
          <p>Administración de Empleados Disponibles.</p>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-user-circle"></i>
                  Lista Actual de Clientes</div>
                <div class="card-body">
                  <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <th>#</th>
                      <th>Usuario</th>
                      <th>Estado</th>
                      <th>Cargo</th>
                      <th class="text-center">Opción</th>
                    </tr>
                    
                      <?php 

                        $displayStaffQuery = "SELECT * FROM tbl_staff";

                        if ($result = $sqlconnection->query($displayStaffQuery)) {

                          if ($result->num_rows == 0) {
                            echo "<td colspan='4'>No hay nadie en el staff.</td>";
                          }

                          $staffno = 1;
                          while($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                          ?>  
                          	<tr class="text-center">
                            	<td><?php echo $staffno++; ?></td>
                            	<td><?php echo $staff['username']; ?></td>

                              <?php

                            	if ($staff['status'] == "Online") {
                                echo "<td><span class=\"badge badge-success\">En línea</span></td>";
                              }

                              if ($staff['status'] == "Offline") {
                                echo "<td><span class=\"badge badge-secondary\">Fuera de línea</span></td>";
                              }

                              ?>

                              <td>
                                <form method="POST">
                                <input type="hidden" name="staffID" value="<?php echo $staff['staffID']; ?>"/>
                                <select name="role" class="form-control" onchange="this.form.submit()">
                                  <?php

                                  $roleQuery = "SELECT role FROM tbl_role";

                                  if ($res = $sqlconnection->query($roleQuery)) {
                                    
                                    if ($res->num_rows == 0) {
                                      echo "no role";
                                    }

                                    while ($role = $res->fetch_array(MYSQLI_ASSOC)) {

                                      if ($role['role'] == $staff['role']) 
                                        echo "<option selected='selected' value='".$staff['role']."'>".ucfirst($staff['role'])."</option>";

                                      else
                                        echo "<option value='".$role['role']."'>".ucfirst($role['role'])."</option>";
                                    }
                                  }

                                  ?>
                                </select>
                                <noscript><input type="submit" value="Enviar"></noscript>
                                </form>
                              </td>

                            	<td class="text-center"><a href="deletestaff.php?staffID=<?php echo $staff['staffID']; ?>" class="btn btn-sm btn-danger">Eliminar</a></td>
                        	</tr>

                          <?php 
                          }

                        }
                        else {
                          echo $sqlconnection->error;
                          echo "Algo ha salido mal.";
                        }

                      ?>

                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Contraseña predeterminada para nuevo usuario : 1234abcd..</i></div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar""></i>
                  Añadir Nuevo Empleado</div>
                <div class="card-body">
                  <form action="addstaff.php" method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    <div class="input-group">
                      <select name="staffrole" class="form-control">
                      <?php

                      $roleQuery = "SELECT role FROM tbl_role";

                      if ($res = $sqlconnection->query($roleQuery)) {
                        
                        if ($res->num_rows == 0) {
                          echo "no role";
                        }

                        while ($role = $res->fetch_array(MYSQLI_ASSOC)) {
                            echo "<option value='".$role['role']."'>".ucfirst($role['role'])."</option>";
                        }
                      }

                      ?>
                      </select>
                      <input type="text" required="required" name="staffname" class="form-control" placeholder="Nuevo Empleado" aria-label="Add" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button type="submit" name="addstaff" class="btn btn-primary">
                          <i class="fas fa-plus"></i>
                        </button> 
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
          include_once 'includes/footer.php'
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
      include_once 'includes/modal-logout.php'
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