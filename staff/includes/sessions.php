<?php
// Comprobación de inicio de sesión
if ((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])))
  header("Location: login.php");

// Verificación del nivel de usuario
if ($_SESSION['user_level'] != "staff")
  header("Location: login.php");