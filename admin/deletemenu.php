<?php

if (isset($_POST['deletemenu'])) {

    //Borrar Menu
    if (isset($_POST['menuID'])) {

        $menuID = $_POST['menuID'];

        //Primero borramos todos los elementos del menú
        $deleteMenuItemQuery = "DELETE FROM tbl_menuitem WHERE menuID = ?";

        $stmt = $sqlconnection->prepare($deleteMenuItemQuery);
        $stmt->bind_param("i", $menuID);
        $stmt->execute();
        $stmt->close();

        //Borramos el menú después de eliminar todo el contenido
        $deleteMenuQuery = "DELETE FROM tbl_menu WHERE menuID = ?";

        $stmt = $sqlconnection->prepare($deleteMenuQuery);
        $stmt->bind_param("i", $menuID);

        if ($stmt->execute()) {
            header("Location: menu.php"); 
            exit();
        } else {
            echo "Algo ha salido mal!!";
            echo $sqlconnection->error;
        }

        $stmt->close();
    }
}
?>