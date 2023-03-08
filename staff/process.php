<?php 
    include("../functions.php");

    // Comprobación de entrada de nombre de usuario y contraseña
    
    if (isset($_POST['username']) && isset($_POST['password'])) {

        // Prevenir inyección SQL escapando caracteres especiales
       
        $username = $sqlconnection->real_escape_string($_POST['username']);
        $password = $sqlconnection->real_escape_string($_POST['password']);

         // Sentencia SQL para buscar en la tabla de personal

        $sql = "SELECT * FROM tbl_staff WHERE username ='$username' AND password = '$password'";

        // Ejecutar la consulta SQL

        if ($result = $sqlconnection->query($sql)) {

            // Verificar si se encuentra una fila coincidente en la tabla

            if ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                // Obtener la información del personal

                $uid = $row['staffID'];
                $username = $row['username'];
                $role = $row['role'];
               
                // Establecer las variables de sesión para el personal autenticado

                $_SESSION['uid'] = $uid;
                $_SESSION['username'] = $username;
                $_SESSION['user_level'] = "staff"; // 1 - admin 2 - staff
                $_SESSION['user_role'] = $role;

                echo "correct";
            }

            else {
                echo "Usuario o contraseña incorrectos";
            }

        }

    }
      
?>