<?php
$alert = '';
//include_once "../includes/header.php";
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-danger" role="alert">
  Ingrese su usuario y su clave
</div>';
    } else {
      require_once "conexion.php";
      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
      $query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo,u.usuario,r.idrol,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.usuario = '$user' AND u.clave = '$clave'");
      mysqli_close($conexion);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $dato['idusuario'];
        $_SESSION['nombre'] = $dato['nombre'];
        $_SESSION['email'] = $dato['correo'];
        $_SESSION['user'] = $dato['usuario'];
        $_SESSION['rol'] = $dato['idrol'];
        $_SESSION['rol_name'] = $dato['rol'];
        header('location: sistema/');
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
              Usuario o Contraseña Incorrecta
            </div>';
        session_destroy();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema de Insumos | Secretaría Administrativa</title>
  <link
      href="sistema/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="sistema/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Custom styles for this template-->
  <link href="sistema/css/style.violet.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
                <div class="p-5">
                <div class="text-center">
                    
                    <div class="text-center">
                    <div class="sidebar-brand-icon rotate-n-15 mb-1">
                      <i class="fas fa-book-medical fa-4x fa-lg"></i><br>
                    </div>
                      <h1 class="h4 text-gray-900 mb-2  mt-2"><br>Sistema de Insumos</h1>
                      <h3 class="h5 text-gray-900 mb-4 mt-1">Sec. Administrativa | HDC</h3>
                    </div>
                </div>
                  
                  <form class="user" method="POST">
                    <?php echo isset($alert) ? $alert : ""; ?>
                    <div class="form-group">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control" placeholder="Usuario" name="usuario"></div>
                    <div class="form-group">
                      <label for="">Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                    </div>

                    <div class="col-auto text-center">
                    <input type="submit" value="Ingresar" class="btn btn-success">
                    <input type="reset" value="Cancelar" class="btn btn-danger">
                  </div>

                    
                   
                  </form>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    

  </div>

  <!-- JavaScript files-->
    <script src="sistema/vendor/jquery/jquery.min.js"></script>
    <script src="sistema/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="sistema/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="sistema/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="sistema/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="sistema/js/front.js"></script>


</body>

</html>
