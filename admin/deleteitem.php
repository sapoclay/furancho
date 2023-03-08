<?php

    include("../functions.php");
    include_once "includes/sessions.php";

    //Borrar Item
    if (isset($_GET['menuID']) && isset($_GET['itemID'])) {
        
        $menuID = $_GET['menuID'];
        $itemID = $_GET['itemID'];

        $deleteItemQuery = "DELETE FROM tbl_menuitem WHERE menuID = ? AND itemID = ?";
        
        $stmt = $sqlconnection->prepare($deleteItemQuery);
        $stmt->bind_param("ii", $menuID, $itemID);
        
        if ($stmt->execute()) {
            echo "Borrado con éxito!";
            header("Location: menu.php"); 
            exit();
        } else {
            echo "Algo ha salido mal!!";
            echo $sqlconnection->error;
        }
    }

?>
