<?php
	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

if($_SESSION['user_level'] != "admin")
    header("Location: login.php");
?>