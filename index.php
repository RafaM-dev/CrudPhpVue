<?php
// Se inicializa la sesión
session_start();
 
/* Se comprueba si el usuario ha iniciado sesión, si no, se redirecciona
 a la página de inicio de sesión (login.php)*/
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Bienvenido</title>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css"
      rel="stylesheet"
    />
	</head>
	<body>
        <main id="app" class="container">
		    <h1 class="text-center">Usuarios inscritos</h1>
		       
            <div class="d-flex justify-content-between mb-2" style="width: 100%">
                <a class="btn btn-success mb-2" href="register.php">Agregar usuarios</a>
                <button class="btn btn-dark" @click="generatePdf">Exportar a PDF</button>
                <button class="btn btn-primary" @click="generateXls">Exportar a Excel</button>
            </div>
            <table class="table" id="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Contraseña</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id" class="table-primary">
                  <th scope="row">{{user.id}}</th>
                  <td>{{user.username}}</td>
                  <td>{{user.name}}</td>
                  <td>{{user.password}}</td>
                  <td>{{user.rol}}</td>
                  <td>
                    <button class="btn btn-danger" @click="deleteUser(user.id)">Eliminar</button>
                    <button @click="showModal(user.id)" type="button" class="btn btn-info" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                      Editar
                    </button>
                  </td>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                          <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                   placeholder="Ingresa el nombre" v-model="user.name" />
                            <label class="form-label" for="form3Example3">Nombre</label>
                          </div>

                          <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                   placeholder="Ingresa el usuario" v-model="user.username" />
                            <label class="form-label" for="form3Example3">Usuario</label>
                          </div>
                          <select v-model="user.rol" class="form-select mb-4" aria-label="Default select example">
                            <option disabled selected>Please select one</option>
                            <option>Estudiante</option>
                            <option>Docente</option>
                          </select>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                          <button type="button" @click.prevent="editUser" class="btn btn-primary">Editar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              </tbody>
            </table>
            <p>
			    <a class="btn btn-info m-1" href="logout.php">Cerrar sesión</a><br>
		    </p>
        </main>
    <script src="https://github.com/m0rtadelo/to-excel/releases/latest/download/to-excel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="./jspdf.plugin.autotable.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> 
    <script src="crud.js"></script>
        <!-- MDB -->
        <script
          type="text/javascript"
          src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"
        ></script>
	</body>
</html>
