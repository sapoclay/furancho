<?php
include("../functions.php");

if ((isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['user_level']))) {
  if ($_SESSION['user_level'] == "admin") {
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Acceso a la administración de este software de administración">
  <meta name="author" content="entreunosyceros.net">

  <title>Furancho | Ingreso de Usuario Administrador</title>

  <?php
  include_once 'includes/links.php';
  ?>

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Furancho | Administración</div>
      <div class="card-body">
        <form id="loginform">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus">
              <label for="inputUsername">Usuario</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required="required">
              <label for="inputPassword">Contraseña</label>
            </div>
          </div>
          <div class="form-group">
            <div id="warningbox">
            </div>
            <input type="submit" class="btn btn-primary btn-block" form="loginform" name="btnlogin" value="Acceder" />
        </form>
        <a href="../index.php" class="btn btn-primary btn-block">Volver al Inicio</a>
      </div>
      <div class="card-footer small text-muted"><i>Usuario: <b>admin</b></i><br/>
                                                    <i>Contraseña: 1234abcd..</i><br/>
                                                    
            </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script type="text/javascript">
    $('#loginform').submit(function() {
      $.ajax({
        type: "POST",
        url: 'process.php',
        data: {
          username: $("#inputUsername").val(),
          password: $("#inputPassword").val()
        },
        success: function(data) {
          if (data === 'correct') {
            window.location.replace('index.php');
          } else {
            $("#warningbox").html("<div class='alert alert-danger' role='alert'>" + data + "!</div>");
          }
        }
      });
      return false;
    });
  </script>

</body>

</html>