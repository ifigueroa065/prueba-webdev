<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />
    <title>Register</title>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
     
        <!-- FORMULARIO -->
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <?php 
          
          include ("models/conexion.php");
          include ("controllers/registrar_user.php")
          ?>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Registrate</p>
            
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">-</p>
          </div>

          <!-- User input -->
          <div class="form-outline mb-4">
            
          <label class="form-label" for="form3Example3">Nombre de usuario </label>
            <input type="text" name="username" class="form-control form-control-lg"
              placeholder="usuario" />
            
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Contraseña</label>  
          <input type="password" name="password" class="form-control form-control-lg"
              placeholder=" contraseña" />
            
          </div>

          

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="button" class="btn btn-primary btn-lg" name="registro" value="registrar">Registrar</button>
            <button type="button" class="btn btn-primary btn-lg" name="sesion" value="sesionS">Iniciar Sesión</button>
            
           
          </div>

        </form>
      </div>
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="assets/img/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
    </div>
  </div>
  
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2023 | ISAI FIGUEROA | Desarrollador Web.
    </div>
    
 
  </div>
</section>
</body>
</html>