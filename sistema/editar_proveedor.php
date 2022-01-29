<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['email']) || empty($_POST['CBU'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
  } else {
    $idproveedor = $_GET['id'];
    $proveedor = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $CBU = $_POST['CBU'];

    $sql_update = mysqli_query($conexion, "UPDATE proveedor SET proveedor = '$proveedor', contacto = '$contacto' , telefono = $telefono, direccion = '$direccion', email = '$email', CBU = '$CBU' WHERE codproveedor = $idproveedor");

    if ($sql_update) {
      $alert = '<div class="alert alert-success" role="alert">Proveedor Actualizado correctamente</div>';
    } else {
      $alert = '
      <div class="alert alert-danger" role="alert">
 Error al Actualizar el Proveedor
</div>';
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_proveedor.php");
  mysqli_close($conexion);
}
$idproveedor = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM proveedor WHERE codproveedor = $idproveedor");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_proveedor.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idproveedor = $data['codproveedor'];
    $proveedor = $data['proveedor'];
    $contacto = $data['contacto'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
    $email = $data['email'];
    $CBU = $data['CBU'];
  }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Proveedor</h1>
        <a href="lista_proveedor.php" class="btn btn-info">Regresar</a>
    </div>

  <div class="row">
    <div class="col-lg-6 m-auto">

      <div class="card">
        
        <div class="card-body">
          <?php echo isset($alert) ? $alert : ''; ?>
          <form class="" action="" method="post">
            <input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
            <div class="form-group">
              <label for="proveedor">Proveedor</label>
              <input type="text" placeholder="Ingrese proveedor" name="proveedor" class="form-control" id="proveedor" value="<?php echo $proveedor; ?>">
            </div>
            <div class="form-group">
              <label for="nombre">Contacto</label>
              <input type="text" placeholder="Ingrese contacto" name="contacto" class="form-control" id="contacto" value="<?php echo $contacto; ?>">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono</label>
              <input type="number" placeholder="Ingrese Teléfono" name="telefono" class="form-control" id="telefono" value="<?php echo $telefono; ?>">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección</label>
              <input type="text" placeholder="Ingrese Direccion" name="direccion" class="form-control" id="direccion" value="<?php echo $direccion; ?>">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" placeholder="Ingrese Email" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
              <label for="CBU">CBU</label>
              <input type="text" placeholder="Ingrese CBU" name="CBU" class="form-control" id="CBU" value="<?php echo $CBU; ?>">
            </div>

            <input type="submit" value="Editar Proveedor" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>