<?php 
	include("../functions.php");

    if(isset($_SESSION['uid'], $_SESSION['username'], $_SESSION['user_level']) && $_SESSION['user_level'] == "staff") {
    	session_destroy();
        header("Location: login.php");
    } else {
        header("Location: login.php");
    }
?>