<?php

include("../functions.php");
include_once "includes/sessions.php";

if(isset($_POST['btnedit'])) {

    if (!empty($_POST['itemName']) && !empty($_POST['itemPrice']) ) {

        $menuID = $sqlconnection->real_escape_string($_POST['menuID']);
        $itemID = $sqlconnection->real_escape_string($_POST['itemID']);
        $itemName = $sqlconnection->real_escape_string($_POST['itemName']);
        $itemPrice = $sqlconnection->real_escape_string($_POST['itemPrice']);

        $updateItemQuery = "UPDATE tbl_menuitem SET menuItemName = ?, price = ? WHERE menuID = ? AND itemID = ?";
        $stmt = $sqlconnection->prepare($updateItemQuery);
        $stmt->bind_param("sdii", $itemName, $itemPrice, $menuID, $itemID);

        if ($stmt->execute() === TRUE) {
            header("Location: menu.php"); 
            exit();
        } 

        else {
            echo "Algo ha salido mal!! ";
            echo $stmt->error;
        }

        $stmt->close();
    }
} 

?>