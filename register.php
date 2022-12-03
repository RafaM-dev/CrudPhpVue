<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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
<!-- Section: Design Block -->
<section class="text-center" id="app">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Regístrate ahora</h2>
          <form>
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-12 mb-4">
                <div class="form-outline">
                  <input type="text" id="form3Example1" class="form-control" v-model="user.name" />
                  <label class="form-label" for="form3Example1">Nombre</label>
                </div>
              </div>
            </div>

            <!-- Usuario input -->
            <div class="form-outline mb-4">
              <input type="text" id="form3Example3" class="form-control" v-model="user.username" />
              <label class="form-label" for="form3Example3">Usuario</label>
            </div>
            <select v-model="user.rol" class="form-select mb-4" aria-label="Default select example">
              <option disabled selected>Please select one</option>
              <option>Estudiante</option>
              <option>Docente</option>
            </select>
            

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" class="form-control" v-model="user.password" />
              <label class="form-label" for="form3Example4">Contraseña</label>
            </div>

            <!-- Confirm password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example5" class="form-control" v-model="user.confirm_password" />
              <label class="form-label" for="form3Example5">Confirma tu contraseña</label>
            </div>
            

            <!-- Submit button -->
            <button type="submit" @click.prevent="register" class="btn btn-primary btn-block mb-4">
              Registrarse
            </button>

            <!-- Register buttons -->
            <div class="text-center">
              <p>O si tienes una cuenta <a href="./login.php">inicia sesión</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="main.js"></script>
  <!-- MDB -->
  <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"
  ></script>
</body>
</html>
