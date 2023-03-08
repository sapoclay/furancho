<?php
include("../functions.php");
include_once 'includes/sessions.php';

if (isset($_POST['btnStatus']) && isset($_POST['staffid'])) {
    $btnStatus = $sqlconnection->real_escape_string($_POST['btnStatus']);
    $staffID = $sqlconnection->real_escape_string($_POST['staffid']);

    // Actualiza el estado del personal según el botón presionado
    $status = ($btnStatus == "Online") ? "Offline" : "Online";

    $addOrderQuery = "UPDATE tbl_staff SET status = '{$status}' WHERE staffID = {$staffID}";

    if ($sqlconnection->query($addOrderQuery) === TRUE) {
        // Redirige a la página principal si la consulta se ejecuta correctamente
        header("Location: index.php");
    } else {
        // Maneja el error si la consulta no se ejecuta correctamente
        echo "Algo salió mal.";
        echo $sqlconnection->error;
    }
}
?>