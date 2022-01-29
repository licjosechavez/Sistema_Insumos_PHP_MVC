<?php include_once "includes/header.php";
include "../conexion.php";
$idcliente = $_GET['id'];
//echo $idcliente;
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todo los campos son obligatorios</div>';
  } else {
    //$idcliente = $_GET['id'];
    $dni = $_POST['dni'];
    //echo $dni;
    $nombre = $_POST['nombre'];
    //echo $nombre;
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $result = 0;
    //echo $result;
    if ($dni != 0) {
      $query = mysqli_query($conexion, "SELECT * FROM cliente where dni = '$dni' AND idcliente = $idcliente");
      //$query = mysqli_query($conexion, "SELECT * FROM cliente where (dni = '$dni' AND idcliente != $idcliente)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
      //echo $resul;
    }

    if ($resul >= 1) {
      $alert = '<div class="alert alert-danger" role="alert">El Solicitante ya existe</div>';
    } else {
      if ($dni == '') {
        $dni = 0;
      }
      //echo $dni;
      $sql_update = mysqli_query($conexion, "UPDATE cliente SET dni = '$dni', nombre = '$nombre' , telefono = '$telefono', direccion = '$direccion' WHERE idcliente = $idcliente");
      echo $sql_update;
      if ($sql_update) {
        $alert = '<div class="alert alert-success" role="alert">Solicitante actualizado correctamente</div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">Error al actualizar el Solicitante</div>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_cliente.php");
}
$idcliente = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $idcliente");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_cliente.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcliente = $data['idcliente'];
    $dni = $data['dni'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Solicitante</h1>
        <a href="lista_cliente.php" class="btn btn-info">Regresar</a>
    </div>

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        
        <div class="card-body">
          <form class="" action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
            <div class="form-group">
              <label for="dni">Área</label>
              <input type="text" placeholder="Editar área" name="dni" id="dni" class="form-control" value="<?php echo $dni; ?>">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" placeholder="Ingrese Nombre" name="nombre" class="form-control" id="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="number" placeholder="Ingrese Teléfono" name="telefono" class="form-control" id="telefono" value="<?php echo $telefono; ?>">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input type="text" placeholder="Ingrese Direccion" name="direccion" class="form-control" id="direccion" value="<?php echo $direccion; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Solicitante</button>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>