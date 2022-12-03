<?php
// se incluye el archivo de configuración
require_once "config.php";
 
// Definir variables e inicializar con valores vacíos

$_POST = json_decode(file_get_contents('php://input'), true);

$username = $_POST['username'];
$name = $_POST['name'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$rol = $_POST['rol'];// -------

$username_err = $password_err = $confirm_password_err = $rol_err = "";// -------

$data['error'] = false;
$data['message'] = 'Login exitoso';
 
// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if (empty(trim($_POST["username"])) ||
      empty(trim($_POST["password"])) ||
      empty(trim($_POST["confirm_password"])) ||
      empty(trim($_POST["name"])) ||
      empty(trim($_POST["rol"]))// -------
    ){
        $data['error'] = true;
        $data['message'] = 'Debes llenar todos los campos';
        echo json_encode($data);
    } else{
        // Preparar la consulta
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // asignar parámetros
            $param_username = trim($_POST["username"]);
            
            // Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                /* almacenar resultado*/
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1 && $password != $confirm_password){
                    $username_err = "Este usuario ya fue tomado y las contraseñas no coinciden";
                    $data['error'] = true;
                    $data['message'] = $username_err;

                    echo json_encode($data);
                } else if(mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este usuario ya fue tomado";
                    $data['error'] = true;
                    $data['message'] = $username_err;

                    echo json_encode($data);
                } else if ($password != $confirm_password){
                    $username_err = "Las contraseñas no coinciden";
                    $data['error'] = true;
                    $data['message'] = $username_err;
                    echo json_encode($data);
                } else {
                    $username = trim($_POST["username"]);
                }
            } else{
                $data['error'] = true;
                $data['message'] = "Al parecer algo salió mal.";
                echo json_encode($data);
            }
        }
         
        // Declaración de cierre
        mysqli_stmt_close($stmt);

        // Verifique los errores de entrada antes de insertar en la base de datos
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($rol_err)){ // --------
            
            // Prepare una declaración de inserción
            $sql = "INSERT INTO users (username, name, password, rol) VALUES (?, ?, ?, ?)";// -------
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Vincular variables a la declaración preparada como parámetros
                mysqli_stmt_bind_param($stmt, "ssss", $param_username,$param_name, $param_password,$param_rol); //-------
                
                // Establecer parámetros
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Crear una contraseña hash
                $param_name = $name;
                $param_rol = $rol;

                // Intentar ejecutar la declaración preparada
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode($data);
                } else{
                    $data['error'] = true;
                    $data['message'] = "Algo salió mal, por favor inténtalo de nuevo.";
                    echo json_encode($data);
                }
            }
             
            // claración de cierre
            mysqli_stmt_close($stmt);
        }
    }
    
    
    // Cerrar la conexión
    mysqli_close($link);
}
?>
