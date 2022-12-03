<?php
header("Access-Control-Allow-Origin: *");

$_POST = json_decode(file_get_contents('php://input'), true);

$username = $_POST['username'];
$password = $_POST['password'];

$data['error'] = false;
$data['message'] = 'Login exitoso';

require_once "config.php";
 
// Definir variables e inicializar con valores vacíos
$username_err = $password_err = "";
 
// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Comprobar si el nombre de usuario está vacío
    if(empty(trim($_POST["username"])) && empty(trim($_POST["password"]))){
        $data['error'] = true;
        $data['message'] = "Por favor ingrese el usuario y la contraseña";
        echo json_encode($data);
    } else {
        if(empty(trim($_POST["username"]))){
            $data['error'] = true;
            $username_err = "Por favor ingrese su usuario.";
            $data['message'] = $username_err;
            echo json_encode($data);
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Comprobar si la contraseña está vacía
        if(empty(trim($_POST["password"]))){
            $data['error'] = true;
            $password_err = "Por favor ingrese su contraseña.";
            $data['message'] = $password_err;
            echo json_encode($data);
        } else{
            $password = trim($_POST["password"]);
        }
        
        
        // Validar información del usuario
        if(empty($username_err) && empty($password_err)){
            // Preparar la consulta select
            $sql = "SELECT id, name, username, password FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                /* Vincular variables a la declaración preparada como parámetros, s es por la
			    variable de tipo string*/
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Asignar parámetros
                $param_username = $username;
                
                // Intentar ejecutar la declaración preparada
                if(mysqli_stmt_execute($stmt)){
                    // almacenar el resultado de la consulta
                    mysqli_stmt_store_result($stmt);
                    
                    /*Verificar si existe el nombre de usuario, si es así,
				    verificar la contraseña*/
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Vincular las variables del resultado
                        mysqli_stmt_bind_result($stmt, $id, $username, $name,  $hashed_password);
					    //obtener los valores de la consulta
                        if(mysqli_stmt_fetch($stmt)){
						    /*comprueba que la contraseña ingresada sea igual a la 
						    almacenada con hash*/
                            if(password_verify($password, $hashed_password)){
                                // La contraseña es correcta, así que se inicia una nueva sesión
                                session_start();
                                
                                // se almacenan los datos en las variables de la sesión
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                // Redirigir al usuario a la página de inicio
                            } else{
                                // Mostrar un mensaje de error si la contraseña no es válida
                                $data['error'] = true;
                                $password_err = "La contraseña que ha ingresado no es válida.";
                                $data['message'] = $password_err;
                                echo json_encode($data);
                            }
                        }
                    } else{
                        // Mostrar un mensaje de error si el nombre de usuario no existe
                        $data['error'] = true;
                        $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                        $data['message'] = $username_err;
                        echo json_encode($data);
                    }
                } else{
                    $data['error'] = true;
                    $data['message'] = "Algo salió mal, por favor vuelve a intentarlo.";
                    echo json_encode($data);
                }
            // Cerrar la sentencia de consulta
            mysqli_stmt_close($stmt);
            }

        }
        
    }
    
    // Cerrar laconexión
		mysqli_close($link);
}
?>
